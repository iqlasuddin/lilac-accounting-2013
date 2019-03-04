<?php
include 'elements/connect.php';
$pid=$_POST['pid'];
$tblname=$_POST['tblname'];
echo $q="DELETE FROM $tblname WHERE p_id='$pid'";
$run=mysql_query($q);

if ($run) {
    echo "string";
} else {
    echo "string2";
}
