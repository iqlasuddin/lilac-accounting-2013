<?php
ob_start();
include('elements/connect.php');
session_start();
$invoice_step_no = mysql_real_escape_string(stripslashes($_POST['hdn-invoice-step']));

if ($invoice_step_no=='invoice-step-one') {
    $invoice_date = mysql_real_escape_string(stripslashes($_POST['txt-invoice-date']));
    $invoice_no = mysql_real_escape_string(stripslashes($_POST['txt-invoice-no']));
    $cust_name = mysql_real_escape_string(stripslashes($_POST['txt-cust-name']));
    $cust_contact = mysql_real_escape_string(stripslashes($_POST['txt-cust-contact']));

    //echo "insert into tblinvoice (`inv_id`, `inv_date`, `cust_name`, `cust_contact`) values(".$invoice_no.",".$invoice_date.",'".$cust_name."',".$cust_contact.");";
    $_SESSION['invoice_no']=$invoice_no;
    mysql_query("insert into tblinvoice_direct (`inv_id`, `inv_date`, `cust_name`, `cust_contact`) values('".$invoice_no."','".$invoice_date."','".$cust_name."','".$cust_contact."');") or die("Unable to create invoice, please try after sometime");

    $check_cust="select * from tblcustomer where  cust_name='$cust_name' and cust_mobile='$cust_contact'";
    $run_checkcust=mysql_num_rows(mysql_query($check_cust));
    
    if ($run_checkcust==0) {
        $item=mysql_num_rows(mysql_query("select * from tblcustomer"));
        $new_item=$item+1;
        $cust_id ="CUST". $new_item;
        mysql_query("insert into tblcustomer(`cust_code`,`cust_name`,`cust_mobile`,`cust_status`,`cust_type`) values('$cust_id','$cust_name','$cust_contact',1,'Individual')");
    }
    header("location:invoice-add-steptwo?id=$invoice_no");
}


//Step two--------------------------------------------------------------------------------------------------------
elseif ($invoice_step_no=='invoice-step-two') {
    $invoice_no=$_SESSION['invoice_no'];
    $item_name = mysql_real_escape_string(stripslashes($_POST['txt-item-name']));
    $item_price = mysql_real_escape_string(stripslashes($_POST['txt-item-price']));
    $item_quantity = mysql_real_escape_string(stripslashes($_POST['txt-item-quantity']));

    if ($item_name=='' || $item_price=='' || $item_quantity=='' || $item_price*$item_quantity==0) {
        header("location:invoice-add-steptwo?id=$invoice_no");
    } else {
        $check_qry="select count(*) from tblinvoiceitems where inv_id='$invoice_no'";
        if ($getcheck=mysql_query($check_qry)) {
            $row=mysql_fetch_array($getcheck);
            if ($row[0]>4) {
                header("location:invoice-add-steptwo?id=$invoice_no&err=exc");
            } else {
                mysql_query("insert into  tblinvoiceitems (`inv_id`, `item_name`, `item_rate`, `item_quantity`) values('".$invoice_no."','".$item_name."','".$item_price."','".$item_quantity."');") or die("Unable to create invoice, please try after sometime");
                header("location:invoice-add-steptwo?id=$invoice_no");
            }
        }
    }
} elseif ($invoice_step_no=='invoice-step-three') {
    $invoice_no=$_SESSION['invoice_no'];
    $itemsTotalPrice = mysql_real_escape_string(stripslashes($_POST['txt-itemsTotalPrice']));
    $discount = mysql_real_escape_string(stripslashes($_POST['txt-discount']));
    $pageGrandTotal = mysql_real_escape_string(stripslashes($_POST['txt-pageGrandTotal']));
    $advancePayment = mysql_real_escape_string(stripslashes($_POST['txt-advancePayment']));
    $balancePayment = mysql_real_escape_string(stripslashes($_POST['txt-balancePayment']));

    //if($item_name=='' || $item_price=='' || $item_quantity=='') header("location:invoice-add-stepone.php?er=Start from Step 1");
    if ($pageGrandTotal==0) {
        echo "<script> alert('Please add atleast one item to the invoice'); </script>";
        header("location:invoice-add-steptwo?id=$invoice_no&er=tot");
    }
    //echo
    mysql_query("update tblinvoice_direct set `discount`='$discount',`total`='$itemsTotalPrice',`grand_total`='$pageGrandTotal', `advancepayment`=$advancePayment, `balancepayment`=$balancePayment where `inv_id`='$invoice_no';") or die("Unable to create invoice, please try after sometime");
    if ($advancePayment>0) {
        $instrecno=get_instant_rec_no();
        mysql_query("INSERT INTO `tbl_instrec` VALUES ('$instrecno','$invoice_no',(select inv_date from tblinvoice_direct where inv_id=$invoice_no),$advancePayment);") or die("Error occured please try later");
    }
    deductfromStock_instantInvoice($invoice_no);
    header("location:invoice-add-stepthree?inv=$invoice_no");
}
//--------------------end of step 3 ------------------------------------

else {
}

function deductfromStock_instantInvoice($invoice_no)
{
    //echo $invoice_no;
    $get_qry=mysql_query("select item_name,item_quantity from tblinvoiceitems where inv_id=$invoice_no");
    while ($got_qry=mysql_fetch_array($get_qry)) {
        $item=$got_qry['item_name'];
        $item_qty=$got_qry['item_quantity'];
        $pieces=explode("/", $item);
        if (strlen($pieces[1])>0) {
            $item_code=$pieces[1];
            //echo "update tblstock set `itemquantity`=(`itemquantity` - $item_qty) where `itemcode`='$item_code'";
            mysql_query("update tblstock set `itemquantity`=(`itemquantity` - $item_qty) where `itemcode` = '$item_code'");
        }
    }
}


ob_flush();
