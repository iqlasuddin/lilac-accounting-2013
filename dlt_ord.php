<?php
include 'elements/connect.php';
$ord_code=$_POST['ord_code'];

$q1="update tblorder set status='0' where ord_code='$ord_code'";
$run1=mysql_query($q1);
while ($stock_tobe_reimbursed_qry=mysql_fetch_array(mysql_query("select itm_code,p_quantity from tblorder_content where ord_code='$ord_code'"))) {
    $reimburse_itmcode=$stock_tobe_reimbursed_qry['itm_code'];
    $reimburse_itmqty=$stock_tobe_reimbursed_qry['p_quantity'];
    $stock_quantity_qry=mysql_fetch_array(mysql_query("select itemquantity from tblstock where itemcode='$reimburse_itmcode'"));
    $stock_quantity=$stock_quantity_qry['itemquantity'];
    $updated_stock_quantity=$stock_quantity+$reimburse_itmqty;
    mysql_query("update tblstock set itemquantity=$updated_stock_quantity where itemcode='$reimburse_itmcode'");
    $q2="delete from tblorder_content where ord_code='$ord_code' and itm_code='$reimburse_itmcode'";
    $run2=mysql_query($q2);
}
if ($run1) {
    echo 1;
} else {
     echo 2;
 }
