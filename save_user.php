<?php
if (!isset($_SESSION)) {
    session_start();
}
$info=array();
include 'elements/connect.php';

if (!empty($_POST['first_name'])) {
    $first_name=$_POST['first_name'];
} else {
    $errorname="User Name";
    array_push($info, $errorname);
}
if (!empty($_POST['email_id'])) {
    $email_id=$_POST['email_id'];
} else {
    $errorname="Email ID";
    array_push($info, $errorname);
}
if (!empty($_POST['txtPassword'])) {
    $txtPassword=$_POST['txtPassword'];
} else {
    $errorname="Password";
    array_push($info, $errorname);
}
if (!empty($_POST['txtRetypePassword']) || $_POST['txtPassword'] <> $_POST['txtRetypePassword']) {
    $txtRetypePassword=$_POST['txtRetypePassword'];
} else {
    $errorname="Passwords do not match";
    array_push($info, $errorname);
}
if (!empty($_POST['cont_no'])) {
    $cont_no=$_POST['cont_no'];
} else {
    $errorname="Contact Number";
    array_push($info, $errorname);
}
if (!empty($_POST['selectUserType'])) {
    $selectUserType=$_POST['selectUserType'];
} else {
    $errorname="User Type";
    array_push($info, $errorname);
}
if (!empty($_POST['selectUserStatus'])) {
    $selectUserStatus=$_POST['selectUserStatus'];
} else {
    $errorname="User Status";
    array_push($info, $errorname);
}

if (!empty($_POST['usr_date'])) {
    $usr_date=$_POST['usr_date'];
} else {
    $usr_date="";
}
if (!empty($_POST['last_name'])) {
    $lastname=$_POST['last_name'];
} else {
    $lastname="";
}


if (!empty($first_name) && !empty($email_id) && !empty($txtPassword) && !empty($txtRetypePassword) && !empty($cont_no) && !empty($selectUserType) && !empty($selectUserStatus)) {
    $check_user="select * from tbllogin where  u_email='$email_id'";
    $run_checkuser=mysql_num_rows(mysql_query($check_user));
    
    if ($run_checkuser==0) {
        $query="insert into tbllogin (`password`, `firstname`, `lastname`, `u_email`, `u_mobile`, `u_address`, `u_type`, `u_status`, `u_adddate`,)
	values('$cust_code', '$cust_name', '$cust_mobile','$cust_address', '$cust_type', '$cust_addate', $cust_status)" ;
        $insert_user=mysql_query($query);
        if ($insert_user) {
            echo "User Added. $email_id shall be used as the username for login";
        } else {
            echo "string";
        }
    } else {
        echo "User account corresponding to $email_id already exists";
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