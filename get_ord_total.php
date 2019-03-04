<?php
 if (!isset($_SESSION)) {
     session_start();
 }
include 'elements/connect.php';
 mysql_real_escape_string($uname=$_SESSION['uname']);
$ord_code=$_POST['ord_code'];
$total=0;
$exploded=explode('@', $uname);
$tbl=$exploded[0].$ord_code;
$rowqry="select count(*) as totalrows from tblorder_$tbl where ord_code='$ord_code'";
$gotrow=mysql_fetch_object(mysql_query($rowqry));
if ($gotrow->totalrows>0) {
    $query="select SUM(p_rate) as t from tblorder_$tbl where ord_code='$ord_code'";
    $get_ot=mysql_query($query);
    $got_ot=mysql_fetch_object($get_ot);
    echo $got_ot->t;
} else {
    echo "00.00";
}
