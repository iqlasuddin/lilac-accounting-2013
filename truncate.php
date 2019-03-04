<?php
include 'elements/connect.php';
$ord_code=$_POST['ord_code'];
$udao=mysql_query("delete from tblorder_temp where ord_code='$ord_code'");
if ($udao) {
    echo 1;
} else {
    echo 2;
}
