<?php
$no_visible_elements=true;
include('header-login.php'); ?>
<style> #alertinfomessage h3{color:#ff0000; font-size:18px; } </style>

			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Welcome to Oryx Fashion Suite </h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info" id="alertinfomessage">
						Enter the Username and Password </div>
					<form class="form-horizontal" action="auth.php" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="txtuname" id="username" type="text" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="txtpassword" id="password" type="password" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
							<a href="#" onClick="document.getElementById('alertinfomessage').innerHTML='<h3>Please drop a mail to support@iqlas.com. The password would be reset and mailed to registred email ID</h3>';"> Forgot Password </a>
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">Login</button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
			<?php include('footer.php'); ?>
			
			
			
			<?php
/*if(isset($_GET['id']))
{
echo $_GET['id'];
}*/
?>
