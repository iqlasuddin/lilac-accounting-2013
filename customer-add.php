<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Customers </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Customer Entry </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> New Customer Entry</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="cust_addform">
						  <fieldset>
							<legend>Customer Entry Details</legend>
							<div class="control-group">
							  <label class="control-label" for="date01">Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker uneditable-input" id="date01"  disabled="disabled" name="cust_addate" value="<?php echo  $new_game = date('d/m/Y', time());  ?>">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label">Customer Code</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input" id="cust_code"><?php
                                 $item=mysql_num_rows(mysql_query("select * from tblcustomer"));
                                  $new_item=$item+1;
                                  echo $_SESSION['cust_code'] ="CUST". $new_item;
                                   ?></span>
								</div>
							  </div>
							
							  <div class="control-group">
								<label class="control-label" for="itemName">Customer Name </label>
								<div class="controls">
								  <input class="input-xlarge focused" required="" id="itemName" type="text"  name="cust_name">
								</div>
							  </div>
							  
							<div class="control-group">
								<label class="control-label" for="focusedInput">Contact Number</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" required="" type="text" name="cust_mobile" >
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Email ID</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text"  name="cust_email">
								</div>
							  </div>
							
							<div class="control-group">
							  <label class="control-label" for="textarea2">Address</label>
							  <div class="controls">
								<textarea   rows="3" name="cust_addressa" ></textarea>
							  </div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Customer Type</label>
								<div class="controls">
								 <select class="input-xlarge" id="selectCategory" requried data-rel="chosen" name="cust_type">
									<option value="">...Select Type...</option>
									<option value="Individual">Individual</option>
									<option value="Company">Company</option>
								</select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Company Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text"  name="cust_cname">
								</div>
							  </div>
												
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Customer</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    
<?php include('footer.php'); ?>
