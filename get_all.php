<?php
ob_start();
include('elements/connect.php');
if (isset($_POST['what'])) {
    $function="get_all_".$_POST['what']."_json";
    echo json_encode($function());
}
function get_all_cust_json()
{
    $q="SELECT cust_mobile as mob,CONCAT_WS('/',cust_name,cust_mobile) as name FROM tblcustomer WHERE cust_status=1";
    $run=mysql_query($q);
    $return=array();
    while ($result=mysql_fetch_array($run)) {
        $return[]=$result;
    }
    return $return;
}
