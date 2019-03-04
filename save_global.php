<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'elements/connect.php';
$info=array();
if (!empty($_POST['global_cname'])) {
    $global_cname=$_POST['global_cname'];
} else {
    $global_cname_er="Company Name";
    array_push($info, $global_cname_er);
}

if (!empty($_POST['global_caddress'])) {
    $global_caddress=$_POST['global_caddress'];
} else {
    $global_caddress_er="Company Address";
    array_push($info, $global_caddress_er);
}
if (!empty($_POST['global_mobile'])) {
    $global_mobile=$_POST['global_mobile'];
} else {
    $glaboal_mobile_er="Mobile Number";
    array_push($info, $glaboal_mobile_er);
}
if (!empty($_POST['global_currency'])) {
    $global_currency=$_POST['global_currency'];
} else {
    $global_currency_er=" and Regional Currency";
    array_push($info, $global_currency_er);
}

$user=$_SESSION['uname'];
$global_clandline=$_POST['global_clandline'];
$global_ctagline=$_POST['global_ctagline'];
$global_fax=$_POST['global_fax'];
$global_email=$_POST['global_email'];
$global_copyinfo=$_POST['global_copyinfo'];
$global_copylink=$_POST['global_copylink'];
if (!empty($global_cname) && !empty($global_caddress) && !empty($global_mobile) && !empty($global_currency)) {
    //condition
    $checkuser=mysql_query("select * from tbllogin where username='$user'");
    
    $run_checkuser=mysql_fetch_array($checkuser);
    $newold=$run_checkuser['new'];
    
    if ($newold==1) {
        $global_querry="insert in to tblglobal (user,global_cname,global_caddress,global_mobile,global_currency)
	 values ('$user', '$global_cname', '$global_caddress','$global_mobile','$global_currency')";
    } else {
        $global_querry="update tblglobal set global_cname='$global_cname', global_caddress='$global_caddress', global_mobile='$global_mobile', global_currency='$global_currency' where user='$user'";
    }
    $run_globalqur=mysql_query($global_querry);
    if ($run_globalqur) {
        $change_new=mysql_query("update tbllogin set new='0' where username='$user' ");
        if (!empty($global_clandline)) {
            $upll=mysql_query("update tblglobal set global_clandline='$global_clandline' where user='$user' ");
        }
        if (!empty($global_ctagline)) {
            $upll=mysql_query("update tblglobal set global_ctagline='$global_ctagline' where user='$user' ");
        }
        if (!empty($global_fax)) {
            $upll=mysql_query("update tblglobal set global_fax='$global_fax' where user='$user' ");
        }
        if (!empty($global_email)) {
            $upll=mysql_query("update tblglobal set global_email='$global_email' where user='$user' ");
        }
        if (!empty($global_copyinfo)) {
            $upll=mysql_query("update tblglobal set global_copyinfo='$global_copyinfo' where user='$user' ");
        }
        if (!empty($global_copylink)) {
            $upll=mysql_query("update tblglobal set global_copylink='$global_copylink' where user='$user' ");
        }
        echo 1;
    } else {
        echo "string";
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
 