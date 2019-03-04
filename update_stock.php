<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'elements/connect.php';
$post=$_POST;
$itemid=$post['itemid'];
$itemname = $post['itemname'];
$itemcategory = $post['itemcategory'];
$itembrand = $post['itembrand'];
$itemuom = $post['itemuom'];
$itemquantity = $post['itemquantity'];
$itemprice = $post['itemprice'];
$itemsellingprice = $post['itemsellingprice'];
$itemstatus=$post['status'];

        // echo $q= prepare_query($post);
        $q = "UPDATE `tblstock` SET `itemname`='$itemname',
		`itemcategory`='$itemcategory',
		`itembrand`='$itembrand',
		`itemuom`='$itemuom',
		`itemquantity`='$itemquantity',
		`itemprice`=$itemprice,`itemsellingprice`=$itemsellingprice,
		`itemstatus`=$itemstatus WHERE `itemid`=$itemid";
        /*echo $query="UPDATE tblstock SET
        itemname='".$itemname."',
        itemcategory='".$itemcategory."',
        itembrand='".$itembrand."',
        itemuom='".$itemuom."',
        itemquantity=".$itemquantity.",
        itemprice=".$itemprice.",
        itemsellingprice=".$itemsellingprice."
        where itemid=".$itemid.";";*/
        // $updatestock = mysql_query($query);
        if (mysql_query($q)) {
            echo $itemname."/".$itemcategory." has been updated" ;
        } else {
            echo "Could not update the stock. please try later or contact support@iqsuite.in.";
        }
/*	}

 else {
    echo "All Fields  Mandatory";
}*/
