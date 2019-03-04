<?php
if (!isset($_SESSION)) {
    session_start();
}
include'elements/connect.php';
$item = mysql_num_rows(mysql_query("select * from tblcustomer"));
$new_item = $item + 1;
echo $_SESSION['cust_code'] = "CUST" . $new_item;
