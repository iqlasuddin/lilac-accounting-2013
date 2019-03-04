<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'elements/connect.php';

$itemname = $_POST['itemname'];
$itemcode = $_SESSION['itemcode'];
$_SESSION['itemcode'] = "";
$itemcategory = $_POST['itemSelectCategory'];
$itembrand = $_POST['itembrand'];
$itemuom = $_POST['itemuom'];
$itemquantity = $_POST['itemquantity'];
$itemprice = $_POST['itemprice'];
$itemsellingprice = $_POST['itemsellingprice'];
$itemdate = $_POST['itemdate'];
$itemstatus = 1;
if (!empty($itemname) && !empty($itemcategory) && !empty($itembrand) && !empty($itemuom) && !empty($itemquantity) && !empty($itemprice) && !empty($itemsellingprice)) {
    $countname = mysql_fetch_row(mysql_query("select * from tblstock where itemname='$itemname' and itembrand='$itembrand' and  itemprice='$itemprice' "));
    if (!empty($countname)) {
        echo $itemname."/".$itemcategory. " already exists in the stock";
    } else {
        $query = "INSERT INTO tblstock (itemdate, itemcode, itemname, itemcategory, itembrand, itemuom, itemquantity, itemprice, itemsellingprice, itemstatus)
 VALUES ('$itemdate','$itemcode','$itemname','$itemcategory','$itembrand','$itemuom','$itemquantity','$itemprice','$itemsellingprice','$itemstatus')";
        $insertstock = mysql_query($query);
        if ($insertstock) {
            echo $itemname."/".$itemcategory." has been added to stock with Item Code #".$itemcode ."<br /> 
			Add More? <a href='#' class='btn btn-large btn-primary' onClick='location.reload();'> Yes </a> " ;
        } else {
            echo "Could not update the stock. please try later or contact support@iqsuite.in.";
        }
    }
} else {
    echo "All Fields  Mandatory";
}
