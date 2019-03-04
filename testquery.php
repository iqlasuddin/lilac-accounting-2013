<?php
ob_start();
include('elements/connect.php');
$check_qry="select count(*) from tblinvoiceitems where inv_id='60001'";
if ($getcheck=mysql_query($check_qry)) {
    $row=mysql_fetch_array($getcheck);
    echo $count=$row[0];
}
ob_flush();
