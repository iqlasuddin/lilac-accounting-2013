<?php
 if (!isset($_SESSION)) {
     session_start();
 }
include 'elements/connect.php';
 mysql_real_escape_string($uname=$_SESSION['uname']);
$ord_code=$_POST['inv_code'];
$tbl=$_POST['tbl'];
$total=0;
$query="select SUM(p_rate) as total from $tbl where inv_code='$ord_code'";
$get_ot=mysql_query($query);
echo mysql_fetch_object($get_ot)->total;
exit;
// while ($got_ot=mysql_fetch_array($get_ot)) {
    // $total=$total+$got_ot['p_rate'];
// }
// echo $total;
