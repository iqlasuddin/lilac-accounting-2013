<?php
ob_start();
include('elements/connect.php');
user_logout();
ob_flush();
