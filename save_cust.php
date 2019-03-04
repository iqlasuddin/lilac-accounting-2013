<?php
if (!isset($_SESSION)) {
    session_start();
}
$info=array();
$cust_address="";
$cust_email="";
include 'elements/connect.php';

if (!empty($_POST['cust_name'])) {
    $cust_name=$_POST['cust_name'];
} else {
    $errorname="Customer Name";
    array_push($info, $errorname);
}
if (!empty($_POST['cust_mobile'])) {
    $cust_mobile=$_POST['cust_mobile'];
} else {
    $errormobile="Customer Mobile Number";
    array_push($info, $errormobile);
}
if (!empty($_POST['cust_addressa'])) {
    $cust_address=$_POST['cust_addressa'];
}
if (!empty($_POST['cust_type'])) {
    $cust_type=$_POST['cust_type'];
} else {
    $errortype="Customer Type";
    array_push($info, $errortype);
}
if (isset($_POST['cust_email'])) {
    $cust_email=$_POST['cust_email'];
}

if (isset($_POST['cust_cname'])) {
    $cust_cname=$_POST['cust_cname'];
}
$cust_addate = date('d/m/Y', time());
$cust_code=$_SESSION['cust_code'];
$_SESSION['cust_code']="";
$cust_cname=$_POST['cust_cname'];
$cust_status=1;

if (count($info)==0) {
    $check_cust="select * from tblcustomer where  cust_name='$cust_name' and cust_mobile='$cust_mobile'";
    $run_checkcust=mysql_num_rows(mysql_query($check_cust));
    
    if ($run_checkcust==0) {
        $query="insert into tblcustomer (cust_code, cust_name, cust_mobile, cust_address, cust_type,cust_addate,cust_status,cust_cname)
	values('$cust_code', '$cust_name', '$cust_mobile','$cust_address', '$cust_type', '$cust_addate', $cust_status,'$cust_cname')" ;
        $insert_cust=mysql_query($query);
    
        if ($insert_cust) {
            if (!empty($cust_email)) {
                mysql_query("update tblcustomer set cust_email='$cust_email' where cust_code='$cust_code'");
            }
            // if (!empty($cust_cname)) {
            // mysql_query("update tblcustomer set cust_cname='$cust_cname' where cust_code='$cust_code'");
            // }
            echo "Customer ".$cust_name." Added";
        } else {
            echo "string";
        }
    } else {
        echo "Customer Already Exist";
    }
} else {
    echo "Please Provide<br/>";
    for ($i=0; $i <count($info) ; $i++) {
        ?>
		<label><?php echo $info[$i]; ?></label>
<?php
    }
}

 ?>