<?php
ob_start();
include('elements/connect.php');
session_start();
$instrecno=mysql_real_escape_string(stripslashes($_POST['inst_rec_no']));
$instrecinv = mysql_real_escape_string(stripslashes($_POST['inst_rec_inv']));
$instrecdate = mysql_real_escape_string(stripslashes($_POST['inst_rec_date']));
$instrec_amt = mysql_real_escape_string(stripslashes($_POST['rec_cash']));

if ($getinstrec=mysql_query("select grand_total,balancepayment from tblinvoice_direct where inv_id = '$instrecinv'")) {
    if ($gotinstrec=mysql_fetch_array($getinstrec)) {
        $grandtotal=$gotinstrec['grand_total'];
        $oldbalance=$gotinstrec['balancepayment'];
        $totalpaid=($grandtotal-$oldbalance)+$instrec_amt;
        /*echo '<br />'.*/$newbalance=$oldbalance-$instrec_amt;
        mysql_query("update tblinvoice_direct set advancepayment=$totalpaid,balancepayment=$newbalance where inv_id='$instrecinv';") /*or print_r(mysql_error());*/ or die("Unable to make payment.please try again later");
        //echo "update tblinvoice_direct set advancepayment=$totalpaid,balancepayment=$newbalance where inv_id=$instrecinv";
        //echo "insert into tbl_instrec('$instrecno','$instrecinv','$instrecdate',$instrec_amt);";
        mysql_query("insert into tbl_instrec values('$instrecno','$instrecinv','$instrecdate',$instrec_amt);") or die("Error occured. Please try again later");
        echo "insert into tbl_instrec values('$instrecno','$instrecinv','$instrecdate',$instrec_amt);";
        header("location:instant-receipt-view-single?r=$instrecno");
    }
}

ob_flush();
