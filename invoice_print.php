<?php
include 'elements/connect.php';
$inv = $_POST['inv'];
$ord = $_POST['ord'];
$ttl = $_POST['ttl'];
$inv_date = date('d/m/Y', time());
$q1 = "INSERT INTO tblinvoice (i_id, o_id, i_amount, i_date,inv_pending) VALUES ('$inv', '$ord', '$ttl', '$inv_date','$ttl')";
$q2 = "update tblorder_content set inv_code= '$inv' where ord_code='$ord'";
mysql_query("update tblorder set inv_code='$inv', inv_date='$inv_date' where ord_code='$ord'");
$q3 = "select * from tblorder_content where ord_code='$ord'";

$run1 = mysql_query($q1);
if ($run1) {
    $run2 = mysql_query($q2);
    if ($run2) {
        $run3 = mysql_query($q3);
        if ($run3) {
            while ($ran3 = mysql_fetch_array($run3)) {
                $itmcd = $ran3['itm_code'];
                $itm_qty = $ran3['p_quantity'];
                $q4 = "select itemquantity from tblstock where itemcode='$itmcd'";
                $csq = mysql_fetch_array(mysql_query($q4));
                $cs = $csq[0] - $itm_qty;
                mysql_query("update tblstock set itemquantity='$cs' where itemcode='$itmcd'");
            }
        } else {
            echo "string3";
        }
    } else {
        echo "string2";
    }
} else {
    echo "string1";
}
