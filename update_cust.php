<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'elements/connect.php';
$ccode=$_SESSION['updateccode'];
$cust_name=$_POST['cust_name'];
$cust_mobile=$_POST['cust_mobile'];
$cust_email=$_POST['cust_email'];
$cust_address=$_POST['cust_addressa'];
$cust_type=$_POST['cust_type'];
$cust_cname=$_POST['cust_cname'];;
// $cust_addate=$_POST['cust_addate'];
    $query="UPDATE tblcustomer SET 
		cust_name='".$cust_name."',
		cust_mobile='".$cust_mobile."',
		cust_email='".$cust_email."',
		cust_address='".$cust_address."',
		cust_type='".$cust_type."',
		cust_cname='".$cust_cname."'
		where cust_code='".$ccode."';";
        $updatecustomer = mysql_query($query);
        if ($updatecustomer) {
            echo $cust_name." details have been updated" ;
        } else {
            echo "Could not update the customer details. please try later or contact support@iqsuite.in.";
        }
