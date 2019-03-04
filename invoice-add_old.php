<?php include('header.php'); ?>
<?php
$usr=$_SESSION['uname'];
$get_u_details=mysql_fetch_array(mysql_query("select * from tblglobal where user='$usr'"));

 ?>
 <style type="text/css" media="screen">
     .full_fixed{
     	height: 100%;
     	width: 100%;
     	position: fixed;
     	background: rgba(0,0,0,0.2);
     	padding: 0;
     	margin: 0;
     }
     .full_fixed div{
     	height: 100%;
     	width: 100%;
     	text-align: center;
     	position: relative;
     	background: none;
     }
 </style>
 <div class="full_fixed">
 	<div>
 		<img src="img/ajax-loaders/ajax-loader.gif"  />
 	</div>
 </div>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Orders </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add New Orders </a>
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
							<legend>Orders Entry Details</legend>
							<div class="control-group">
							  <label class="control-label" for="date01">Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" disabled="disabled"  id="date01" value="<?php echo date('d/m/Y', time());  ?>" >
							  </div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Orders Number</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input"><?php
                                  
                                    $inv_q="select i_id from tblinvoice";
                                                $rskt=mysql_query($inv_q);
                                        $run_inv_q=mysql_num_rows($rskt);
                                                if ($run_inv_q==0) {
                                                    echo	$inv_code='INV1';
                                                } else {
                                                    $tem=$run_inv_q+1;
                                                    echo	$inv_code='INV'.$tem;
                                                }
                                                
                                    $tbl=$usr.$inv_code;
                                    $delquery=	"DROP TABLE tblorder_$tbl";
                                    mysql_query($delquery);
                                   ?>
								   <input type="text" id="hidden_invcode" value="<?php echo $inv_code; ?>" style="display: none;" />
								   <?php
                                    $ordr = mysql_num_rows(mysql_query("select * from tblorder"));
                                    $new_ordr= $ordr + 1;
                                   ?>
								   <input type="text" id="hidden_ordcode" value="<?php echo "ORD" . $new_ordr; ?>" style="display: none;" />
								   </span>
								</div>
							  </div>
							  
														
							  <div class="control-group">
								<label class="control-label" for="itemName">Customer Name </label>
								<div class="controls">
								  <select class="input-xlarge cusrtm" id="invoiceNumber"  data-rel="chosen">
									<option value="">...Select Customer...</option>
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
									<option value="">...Select Item...</option>
									<?php
                                    $query_stock=mysql_query("select * from tblstock");
                                    while ($got_stock=mysql_fetch_array($query_stock)) {
                                        ?>
										<option value="<?php echo $got_stock['itemcode']; ?>"><?php echo $got_stock['itemname']; ?></option>
							<?php
                                    }
                                     ?>
								</select>
								<!-- <a href="#" class="" onclick="$('#addCategory').modal('show');" data-rel="popover" data-content="Click here to Add New Item" title="Add Item"><i class="icon icon-color icon-add"> </i></a> -->
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Quantity</label>
								<div class="controls">
								  <input class="input-xlarge focused itm_qnty" id="focusedInput" type="text" > 
								  <button class="btn btn-primary" onclick="return false;" id="inv_itm">Add Item</button>
								</div>
							  </div>
						  
							  <legend>Items Selected</legend>

							  <table class="table">
							  <thead>
								  <tr>
									  <th>Slno</th>
									  <th>Description</th>
									  <th>Rate[<?php echo $get_u_details['global_currency'];?>]</th>
									  <th>Quantity</th>
									  <th>Amount[<?php echo $get_u_details['global_currency'];?>]</th>
								  </tr>
							  </thead>   
							  <tbody class="itms_appender">
								<!-- <tr>
									<td>1</td>
									<td>School Uniform</td>
									<td class="center">800</td>
									<td>2</td>
									<td>1600</td>
								</tr>
								
								<tr>
									<td>1</td>
									<td>Hospital Uniform</td>
									<td>600</td>
									<td>5</td>
									<td>3000</td>
								</tr>
								
								<tr>
									<td>1</td>
									<td>Army Uniform</td>
									<td>1200</td>
									<td>6</td>
									<td>7200</td>
								</tr> -->
								                          
							  </tbody>
						 </table>
						
						<div class="control-group">
								<label class="control-label" for="focusedInput">Total Amount</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on"><?php echo $get_u_details['global_currency'];?></span><input id="costPrice" class="gtotal" size="24"  disabled="disabled" type="text" value="00.00">
									<input id="costPrice" class="gtotal1"  style="display: none" size="24" type="text" value="00.00">
								 </div>
								 
								</div>
							  </div>
							  
						<div class="control-group">
								<label class="control-label" for="focusedInput">Discount</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">%<?php //echo $get_u_details['global_currency'];?></span><input id="costPrice"  class="taxi" size="24" type="text" autocomplete="off" value="0">
								  </div>
								</div>
							  </div>
						
													  
						<div class="control-group">
								<label class="control-label" for="focusedInput" >Grand Total</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on"><?php echo $get_u_details['global_currency'];?></span><input id="costPrice" class="net_p" disabled="disabled" size="24" type="text" value="00.00">
									<input id="costPrice" class="net_pf" style="display: none" size="24" type="text" value="00.00">
								  </div>
								</div>
							  </div>
							 												
							<div class="form-actions">
							  <span class="btn btn-primary place_order">Place Orders</span>
							  <button type="reset" class="btn truncate_tempo">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    
<?php include('footer.php'); ?>
