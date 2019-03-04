<?php
include 'elements/connect.php';
$ord=$_POST['ord_code'];
//$q=mysql_query("select p_rate from tblorder_content where ord_code='$ord'");
// SELECT SUM(column_name) FROM table_name;
$q="SELECT SUM(p_rate) FROM tblorder_content where ord_code='$ord'";
$r=mysql_fetch_array(mysql_query($q));
echo$r['0'];
