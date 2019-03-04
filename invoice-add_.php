<?php include('header.php');
$usr=$_SESSION['uname'];
$get_u_details=mysql_fetch_array(mysql_query("select * from tblglobal where user='$usr'"));
$inv_q="select i_id from tblinvoice";
                $rskt=mysql_query($inv_q);
        $run_inv_q=mysql_num_rows($rskt);
                if ($run_inv_q==0) {
                    $inv_code='INV1';
                } else {
                    $tem=$run_inv_q+1;
                    $inv_code='INV'.$tem;
                }

 ?>



			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Invoices </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add New Invoice </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> New Invoice Entry</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
							<legend>Invoice Entry Details</legend>
							<div class="control-group">
							  <label class="control-label" for="date01">Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" >
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label">Invoice Number</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input"><?php echo $inv_code;?></span>
								</div>
							  </div>
							  
														
							  <div class="control-group">
								<label class="control-label" for="itemName">Customer Name </label>
								<div class="controls">
								  <select class="input-xlarge" id="invoiceNumber" data-rel="chosen">
									<option selected="selected">...Select Customer...</option>
									<?php
                                    $query=mysql_query("select * from tblcustomer");
                                    while ($got_custm=mysql_fetch_array($query)) {
                                        ?>
										<option value=" <?php echo $got_custm['cust_mobile']; ?>"><?php echo $got_custm['cust_name']." / ". $got_custm['cust_mobile']; ?></option>
							<?php
                                    }
                                     ?>
								</select>
									<a href="#" class="" onclick="$('#addCustomer').modal('show');" data-rel="popover" data-content="Click here to Add New Customer" title="Add Customer"><i class="icon icon-color icon-add"> </i></a>
								</div>
							  </div>
							  
							  <legend>Items Details</legend>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Item Name / Code</label>
								<div class="controls">
								 <select class="input-xlarge" id="itemDetails" data-rel="chosen">
									<option selected="selected">...Select Item...</option>
									<?php
                                    $query_stock=mysql_query("select * from tblstock");
                                    while ($got_stock=mysql_fetch_array($query_stock)) {
                                        ?>
										<option value="<?php echo $got_stock['itemcode']; ?>"><?php echo $got_stock['itemname']; ?></option>
							<?php
                                    }
                                     ?>
								</select>
								<a href="#" class="" onclick="$('#addCategory').modal('show');" data-rel="popover" data-content="Click here to Add New Item" title="Add Item"><i class="icon icon-color icon-add"> </i></a>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Quantity</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" > 
								  <button class="btn btn-primary">Add Item</button>
								</div>
							  </div>
						  
							  <legend>Items Selected</legend>

							  <table class="table">
							  <thead>
								  <tr>
									  <th>Slno</th>
									  <th>Description</th>
									  <th>Rate[<?php print $get_u_details['global_currency'];?>]</th>
									  <th>Quantity</th>
									  <th>Amount[<?php print $get_u_details['global_currency'];?>]</th>
								  </tr>
							  </thead>   
							  <tbody>
								<tr>
									<td>1</td>
									<td>School Uniform</td>
									<td class="center">800</td>
									<td>2</td>
									<td>1600</td>
								</tr>
								
								
								                          
							  </tbody>
						 </table>
						
						<div class="control-group">
								<label class="control-label" for="focusedInput">Total Amount</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on"><?php print $get_u_details['global_currency'];?></span><input id="costPrice" size="24" type="text" value="11,800">
								 </div>
								 
								</div>
							  </div>
							  
						<div class="control-group">
								<label class="control-label" for="focusedInput">Discount</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">%</span><input id="costPrice" size="24" type="text" value="10">
								  </div>
								</div>
							  </div>
						
													  
						<div class="control-group">
								<label class="control-label" for="focusedInput" >Grand Total</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on"><?php print $get_u_details['global_currency'];?></span><input id="costPrice" size="24" type="text" value="10,620">
								  </div>
								</div>
							  </div>
							 												
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Invoice</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    
<?php include('footer.php'); ?>
