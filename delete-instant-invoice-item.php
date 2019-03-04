<?php
include('elements/connect.php');
check_login();
if (isset($_GET['id'])) {
    mysql_query("delete from tblinvoiceitems where inv_item_id=".$_GET['id']."");
}
$invoice_no = $_SESSION['invoice_no'];
header("location:invoice-add-steptwo?id=$invoice_no");
?>

