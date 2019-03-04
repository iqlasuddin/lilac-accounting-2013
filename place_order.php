<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'elements/connect.php';
$place_order_success=0;
mysql_real_escape_string($gtotal_t=$_POST['gtotal_t']);
mysql_real_escape_string($gtotal_f=$_POST['gtotal_f']);
mysql_real_escape_string($ord_code=$_POST['ord_code']);
mysql_real_escape_string($dlvr_date=$_POST['dlvr_date']);
mysql_real_escape_string($customr=$_POST['customr']);
mysql_real_escape_string($o_discount=$_POST['o_disc']);
mysql_real_escape_string($uname=$_SESSION['uname']);
$exploded=explode('@', $uname);

mysql_real_escape_string($table=$exploded[0].$ord_code);
$go_for_ord=0;
$get_ord_details="select * from tblorder_$table where ord_code='$ord_code'";
    $run_god=mysql_query($get_ord_details);
    if ($run_god) {
        $go_for_ord=1;
    } else {
        echo "Atleast one item to be entered.";
    }
if ($go_for_ord==1) {
    $ord_date=date('m/d/Y', time());
    mysql_real_escape_string($ord_date);
    //$query_c_name="select cust_name from tblcustomer where cust_mobile= '$customr'";
    //$run_cname=mysql_fetch_array(mysql_query($query_c_name));
    //$cust_name=$run_cname['cust_name'];
    //mysql_real_escape_string($cust_name);

    $cust_details=explode('/', $customr);
    $cust_name=$cust_details[0];
    $cust_cont=$cust_details[1];

    $ord_chk="select * from tblorder where ord_code='$ord_code'";
    $run_ord_chk=mysql_query($ord_chk);
    $ran=mysql_num_rows($run_ord_chk);
    if ($ran==0) {
        $query="INSERT INTO tblorder(ord_code, ord_date, ord_delivery, cust_name, cus_mobile, o_total,o_discount,o_grand,status) 
VALUES ('$ord_code', '$ord_date', '$dlvr_date', '$cust_name', '$cust_cont', '$gtotal_t', '$o_discount',$gtotal_f,'1')";
        $place_order=mysql_query($query);

        if ($place_order) {
            $place_order_success=1;
        }
    } else {
        $place_order_success=1;
    }
}
if ($place_order_success==1) {
    // echo "string";
    // $get_ord_details="select * from tblorder_$table where ord_code='$ord_code'";
    // $run_god=mysql_query($get_ord_details);
    // $got_od=mysql_fetch_array($run_god);
    //echo$fr=count($got_od);
    // $ok=0;
    while ($got_od=mysql_fetch_array($run_god)) {
        $itm_code=$got_od['p_id'];
        $p_q=$got_od['p_q'];
        $p_rate=$got_od['p_rate'];
        mysql_query("INSERT INTO tblorder_content(ord_code, itm_code, p_quantity, p_rate) VALUES ('$ord_code', '$itm_code', '$p_q', '$p_rate')");
            
        $stock_quantity_qry=mysql_fetch_array(mysql_query("select itemquantity from tblstock where itemcode='$itm_code'"));
        $stock_quantity=$stock_quantity_qry['itemquantity'];
        $updated_stock_quantity=$stock_quantity-$p_q;
        mysql_query("update tblstock set itemquantity=$updated_stock_quantity where itemcode='$itm_code'");
    }
    $dlt_used_tbl=mysql_query("DROP TABLE tblorder_$table");
    if ($dlt_used_tbl) {
        echo 'alldone';
    }
}
exit();
 ?>


 