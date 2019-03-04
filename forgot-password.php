<?php
$no_visible_elements=true;
include('header-login.php'); ?>

			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Password Recovery </h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						Enter the registered email ID </div>
					<form class="form-horizontal" action="auth.php" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="txtuname" id="username" type="text" value="" />
							</div>
							<div class="clearfix"></div>

							
							<p class="center span5">
							<button type="submit" class="btn btn-primary">Send Reset Link</button>
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
