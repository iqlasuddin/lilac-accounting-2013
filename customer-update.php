<?php include 'header.php';
if (!isset($_GET['ccode'])) {
    header("location:customer-view");
} else {
      $ccode=$_GET['ccode'];
      if (empty($ccode)) {
          header("location:customer-view");
      }
      $_SESSION['updateccode']=$ccode;
      $query="select * from tblcustomer where cust_code='".$ccode."'";
      $result=mysql_query($query);
      $customer=mysql_fetch_array($result);
      $noaddcustomermodel='';
  }
 ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Customers </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Customer Update </a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#"><?php echo $customer['cust_name']." - ".$customer['cust_code']; ?> </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Update Customer for - <?php echo $customer['cust_name']." - ".$customer['cust_code']; ?></h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="cust_updateform">
						  <fieldset>
							<legend>Customer Update Details</legend>
							<div class="control-group">
							  <label class="control-label" for="date01">Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker uneditable-input" id="date01"  disabled="disabled" name="cust_addate" value="<?php echo  $customer['cust_addate'];  ?>">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label">Customer Code</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input" id="cust_code"> <?php echo  $customer['cust_code'];  ?></span>
								</div>
							  </div>
							
							  <div class="control-group">
								<label class="control-label" for="itemName">Customer Name </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="itemName" type="text"  name="cust_name" value="<?php echo  $customer['cust_name']; ?>">
								</div>
							  </div>
							  
							<div class="control-group">
								<label class="control-label" for="focusedInput">Contact Number</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" name="cust_mobile" value="<?php echo  $customer['cust_mobile'];  ?>" >
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Email ID</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text"  name="cust_email" value="<?php echo  $customer['cust_email'];  ?>">
								</div>
							  </div>
							
							<div class="control-group">
							  <label class="control-label" for="textarea2">Address</label>
							  <div class="controls">
								<textarea   rows="3" name="cust_addressa" > <?php echo  $customer['cust_address'];  ?></textarea>
							  </div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Customer Type</label>
								<div class="controls">
								 <select class="input-xlarge" id="selectCategory" data-rel="chosen" name="cust_type">
									<option <?php echo  $customer['cust_type']=='Individual'?'selected=""':'';?> value="Individual">Individual</option>
									<option <?php echo  $customer['cust_type']=='Company'?'selected=""':'';?> value="Company">Company</option>
								</select>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Company Name</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text"  name="cust_cname" value="<?php echo  $customer['cust_cname'];  ?>">
								</div>
							  </div>
												
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Update Customer</button>
							  <button type="reset" class="btn" onClick="window.location='customer-view'" >Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    
<?php include('footer.php'); ?>
