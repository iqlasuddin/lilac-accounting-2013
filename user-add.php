<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Users </a><span class="divider">/</span>
					</li>
					<li>
						<a href="user-add.php">Add User  </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> New User Entry </h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="user_addform" name="user_addform" method="post">
						  <fieldset>
							<legend>User Entry Details </legend>
							<div class="control-group">
							  <label class="control-label" for="usr_date">Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker uneditable-input" id="usr_date"  disabled="disabled" name="usr_date" value="<?php echo  $new_game = date('d/m/Y', time());  ?>">
							  </div>
							</div>
														
							  <div class="control-group">
								<label class="control-label" for="first_name">First Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="first_name" type="text"  name="first_name">
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="last_name">Last Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="last_name" type="text"  name="last_name">
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="email_id">Email ID</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="email_id" type="text"  name="email_id">
								</div>
							  </div>
							  
													  
							   <div class="control-group">
								<label class="control-label" for="usr_password">Password</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="txtPassword" type="password"  name="txtPassword" onfocus="this.select();">
								</div>
							  </div>
							  
							  <div class="control-group">
							  <div class="controls">
							  <div id="passwordMatchError" style="color:#FF0000"> </div>
							  </div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="itemName">Retype Password</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="txtRetypePassword" type="password"  name="txtRetypePassword" onblur="checkPasswordMatch();" onfocus="this.select();">
								</div>
							  </div>
							  
							  
							  
					 <script type="text/javascript">
					 function checkPasswordMatch(){
					 //alert(document.getElementById('txtPassword').value);
					 var pwd=document.getElementById('txtPassword').value;
					 var retypepwd=document.getElementById('txtRetypePassword').value;
					 if(pwd != retypepwd){
					 	document.getElementById('passwordMatchError').innerHTML="Entered Passwords do not match.";
						document.getElementById('txtPassword').focus();
						return;
					 }			
					 else{
					 	document.getElementById('passwordMatchError').hide();
					 	return;
					 }
					 }
							 
					 </script>
							  
							  
						<?php
                                 $item=mysql_num_rows(mysql_query("select * from tblcustomer"));
                                  $new_item=$item+1;
                                   $_SESSION['cust_code'] ="CUST". $new_item;
                                   ?>
							  
							<div class="control-group">
								<label class="control-label" for="cont_no">Contact Number</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="cont_no" type="text" name="cont_no" >
								</div>
							  </div>
							  
							 			
							<div class="control-group">
								<label class="control-label">User Type</label>
								<div class="controls">
								 <select class="input-xlarge" id="selectUserType" data-rel="chosen" name="cust_type">
									<option value="">...Select Type...</option>
									<option>User</option>
									<option>Administrator</option>
								</select>
								</div>
							  </div>
							  
							  
							  <div class="control-group">
								<label class="control-label">User Status</label>
								<div class="controls">
								 <select class="input-xlarge" id="selectUserStatus" data-rel="chosen" name="cust_type">
									<option value="">...Select Status...</option>
									<option>Active</option>
									<option>Disabled</option>
								</select>
								</div>
							  </div>
							  
																			
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add User</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    
<?php include('footer.php'); ?>
