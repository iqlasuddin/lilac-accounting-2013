<?php
include 'elements/connect.php';
function calc($t, $d)
{
    $a=$t/100*$d;
    return $t-$a;
}
$ord=$_POST['ord_code'];
$pid=$_POST['pid'];
$get_order_details="SELECT COUNT(itm_code) as total FROM tblorder_content WHERE ord_code='$ord'";
$cc=mysql_fetch_object(mysql_query($get_order_details));
if ($cc->total==1) {
    echo "1@You Cannot Delete all items in a order";
    exit;
}
$delete=mysql_query("DELETE FROM tblorder_content WHERE ord_code='$ord' AND itm_code='$pid'");
$get_order_total="SELECT SUM(p_rate) as total FROM tblorder_content WHERE ord_code='$ord'";
$ot=mysql_fetch_object(mysql_query($get_order_total))->total;
$discount=msql_fetch_object(mysql_query("SELECT o_discount FROM tblorder WHERE ord_code='$ord'"))->o_discount;
$nt=calc($ot, $discount);
$update_o=mysql_query("UPDATE tblorder SET o_total=$ot, o_grand=$nt WHERE ord_code='$ord'");
// $pq=mysql_fetch_array(mysql_query("select p_rate from tblorder_content where ord_code='$ord' and itm_code='$pid'"));
// $p1=$pq['p_rate'];
// $oq=mysql_fetch_array(mysql_query("select o_total, o_discount, o_grand from tblorder where ord_code='$ord'"));
// $up_t=$oq['o_total']-$p1;
// $up_g=calc($up_t,$oq['o_discount']);
// $uq=mysql_query("update tblorder set o_total=$up_t, o_grand=$up_g");
// $q=mysql_query("delete from tblorder_content where ord_code='$ord' and itm_code='$pid'");
// $echec=mysql_num_rows(mysql_query("select ord_code from tblorder_content"));
if ($update_o) {
    echo "0@$nt";
    exit;
} else {
    echo "1@Error Handling database";
    exit;
}
