<?php
ob_start();
include('elements/connect.php');
check_login();
validate_license();
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title>IQSUITE Accounting Application - Lucky Lilac </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="IQSUITE Accounting Application">
	<meta name="author" content="iqlas.com">

	<!-- The styles -->
	<link id="bs-css" href="css/bootstrap-cerulean.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/charisma-app.css" rel="stylesheet">
	<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet'>
	<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='css/chosen.css' rel='stylesheet'>
	<link href='css/uniform.default.css' rel='stylesheet'>
	<link href='css/colorbox.css' rel='stylesheet'>
	<link href='css/jquery.cleditor.css' rel='stylesheet'>
	<link href='css/jquery.noty.css' rel='stylesheet'>
	<link href='css/noty_theme_default.css' rel='stylesheet'>
	<link href='css/elfinder.min.css' rel='stylesheet'>
	<link href='css/elfinder.theme.css' rel='stylesheet'>
	<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='css/opa-icons.css' rel='stylesheet'>
	<link href='css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="js/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/iqs.png">
		
</head>

<body>
	<?php if (!isset($no_visible_elements) || !$no_visible_elements) {
    ?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index"> Lucky Lilac</a>
					
				
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> Howdy Admin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="admin-tasks">Admin Tasks</a></li>
						<li><a href="logout">Logout</a></li>
						<li class="divider"></li>
						<li><a href="#" onClick="$('#aboutIQ').modal('show');">About IQSUITE</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="http://luckylilac.com" target="_BLANK" >Visit Site</a></li>
						<li>
							<!--<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>-->
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php
} ?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if (!isset($no_visible_elements) || !$no_visible_elements) {
        ?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<li><a class="ajax-link" href="index"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
						
					
						
						<!-- DIRECT INVOICE MANAGEMENT-->
						<li class="nav-header hidden-tablet">INSTANT INVOICE</li>
						<li><a class="ajax-link" href="invoice-add-stepone"><span class="hidden-tablet"> New Instant Invoice </span> </a> </li>
						<li><a class="ajax-link" href="invoice-instant-view"><span class="hidden-tablet"> View Instant Invoices</span> </a> </li>
						<!--END DIRECT INVOICE MANAGEMENT-->
						
						<!-- DIRECT INSTANT RECEIPT-->
						<li class="nav-header hidden-tablet">INSTANT RECEIPT</li>
						<li><a class="ajax-link" href="instant-receipts-view"><span class="hidden-tablet"> View Instant Receipts</span> </a> </li>
						<!--END DIRECT INSTANT RECEIPT-->
						
						<!-- SALES REPORT-->
						<li class="nav-header hidden-tablet">SALES REPORT</li>
						<li><a class="ajax-link" href="sales-report"><span class="hidden-tablet"> Sales Report </span> </a> </li>
						<!--END SALES REPORT-->
						
						<!-- Archives MANAGEMENT-->
						<li class="nav-header hidden-tablet">ARCHIVES</li>
						<li><a class="ajax-link" href="invoice-instant-view-all"><span class="hidden-tablet"> All Invoices </span> </a> </li>
						<li><a class="ajax-link" href="instant-receipts-view-all"><span class="hidden-tablet"> All Receipts</span> </a> </li>
						<li><a class="ajax-link" href="customer-view-all"><span class="hidden-tablet"> All Customers</span> </a> </li>
						<!--END Archives MANAGEMENT-->
						
							<!--STOCK MANAGEMENT-->
						<li class="nav-header hidden-tablet">STOCK MANAGEMENT</li>
						<li><a class="ajax-link" href="stock-entry"><span class="hidden-tablet"> Stock Entry </span> </a> </li>
						<li><a class="ajax-link" href="stock-view"><span class="hidden-tablet"> View Stock </span> </a> </li>
						<!--END STOCK MANAGEMENT-->
						
							<!--CUSTOMER MANAGEMENT-->
						<li class="nav-header hidden-tablet">CUSTOMER MANAGEMENT</li>
						<li><a class="ajax-link" href="customer-add"><span class="hidden-tablet"> Add Customer </span> </a> </li>
						<li><a class="ajax-link" href="customer-view"><span class="hidden-tablet"> View Customers </span> </a> </li>
						<!--END CUSTOMER MANAGEMENT-->
						
								<!--ORDER MANAGEMENT-->
						<li class="nav-header hidden-tablet">ORDER MANAGEMENT</li>
						<li><a class="ajax-link" href="order-add"><span class="hidden-tablet"> New Order </span> </a> </li>
						<li><a class="ajax-link" href="order-view"><span class="hidden-tablet"> View Orders</span> </a> </li>
						<!--END ORDER MANAGEMENT-->
				
						<!-- INVOICE MANAGEMENT-->
						<li class="nav-header hidden-tablet">INVOICE MANAGEMENT</li>
						<li><a class="ajax-link" href="invoice-add"><span class="hidden-tablet"> New Invoice </span> </a> </li>
						<li><a class="ajax-link" href="invoice-view"><span class="hidden-tablet"> View Invoices</span> </a> </li>
						<!--END INVOICE MANAGEMENT-->
						
						<!-- RECEIPT MANAGEMENT-->
						<li class="nav-header hidden-tablet">RECEIPT MANAGEMENT</li>
						<li><a class="ajax-link" href="receipt-add"><span class="hidden-tablet"> New Receipt </span> </a> </li>
						<li><a class="ajax-link" href="receipt-view"><span class="hidden-tablet"> View Receipts</span> </a> </li>
						<!--END RECEIPT MANAGEMENT-->
						


					</ul>
					<!--<label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>-->
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have JavaScript enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php
    } ?>
