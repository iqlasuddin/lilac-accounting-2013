<?php
    include('header.php');
    if (isset($_GET['tab']) && isset($_GET['id'])) {
        switch ($_GET['tab']) {
            case 'tblcustomer':
                $return='customer-view';
                $columnname='id';
                break;
            case 'tblstock':
                $return='stock-view';
                $columnname="itemid";
                break;
            case 'tblinvoice_direct':
                $return='invoice-instant-view';
                $columnname="inv_id";
                addtoStock($_GET['id']);
                break;
            default:
                $return='';
                break;
        }
        echo $query="update ". $_GET['tab'] . " set ".$_GET['type']."status=0 where ".$columnname."='". $_GET['id'] . "';";
        mysql_query($query) or die(header("location:$return?id=err"));
        header("location:$return?id=del");
    }
function addtoStock($invoice_no)
{
    $get_qry=mysql_query("select item_name,item_quantity from tblinvoiceitems where inv_id=$invoice_no");
    while ($got_qry=mysql_fetch_array($get_qry)) {
        $item=$got_qry['item_name'];
        $item_qty=$got_qry['item_quantity'];
        $pieces=explode("/", $item);
        if (strlen($pieces[1])>0) {
            $item_code=$pieces[1];
            //echo "update tblstock set `itemquantity`=(`itemquantity` - $item_qty) where `itemcode`='$item_code'";
            mysql_query("update tblstock set `itemquantity`=(`itemquantity` + $item_qty) where `itemcode` = '$item_code'");
        }
    }
}
