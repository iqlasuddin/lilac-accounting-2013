<?php
ob_start();
include('elements/connect.php');
$uname = mysql_real_escape_string(stripslashes($_POST['txtuname']));
$password = mysql_real_escape_string(stripslashes($_POST['txtpassword']));
login_authorize($uname, $password);
ob_flush();
