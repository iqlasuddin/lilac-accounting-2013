<?php
if (!isset($_GET['order'])) {
    header('location:order-view.php');
}
$ord_code=$_GET['order'];
include('header.php'); ?>
<?php

$usr=$_SESSION['uname'];
$get_u_details=mysql_fetch_array(mysql_query("select * from tblglobal where user='$usr'"));

$get_order=mysql_fetch_array(mysql_query("select * from tblorder where ord_code='$ord_code'"));
$thiscust=$get_order['cust_name'];
$o_details=mysql_query("select * from tblorder_content where ord_code='$ord_code'");
$q="SELECT SUM(p_rate) FROM tblorder_content where ord_code='$ord_code'";
$r=mysql_fetch_array(mysql_query($q));
$cttl=$r['0'];
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
						<h2><i class="icon-edit"></i> New Orders Entry</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
							<legend>Orders Entry Details</legend>
							<div class="control-group">
							  <label class="control-label" for="date65">Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" disabled="disabled"  id="date65" value="<?php echo $get_order['ord_date']; ?>" >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Delivery  Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" value="<?php echo $get_order['ord_delivery'];  ?>" >
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label">Orders Number</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input">
								  	<?php echo $ord_code; ?>
								   <input type="text" id="hidden_ordcode" value="<?php echo $ord_code; ?>" style="display: none;" />
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
										<option <?php if ($thiscust==$got_custm['cust_name']) {
                                            echo 'selected="selected"';
                                        } ?> value=" <?php echo $got_custm['cust_mobile']; ?>"><?php echo $got_custm['cust_name']." / ". $got_custm['cust_mobile']; ?></option>
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
								  <button class="btn btn-primary" id="e_item">Add Item</button>
								</div>
							  </div>
						  
							  <legend>Items Selected</legend>

							  <table class="table">
							  <thead>
								  
									  <th>Description</th>
									  <th>Rate[<?php echo $get_u_details['global_currency'];?>]</th>
									  <th>Quantity</th>
									  <th>Amount[<?php echo $get_u_details['global_currency'];?>]</th>
								
								  
							  </thead>   
							  <tbody class="itms_appender">
							  	<?php
                                
                                while ($get=mysql_fetch_array($o_details)) {
                                    ?>
							  		
							  		<tr id="itmtr<?php echo $get['itm_code']; ?>">
	
	<td><?php $itm=$get['itm_code'];
                                    $q="select  itemname,itemsellingprice from tblstock where itemcode='$itm'";
                                    $r=mysql_fetch_array(mysql_query($q));
                                    echo $r['itemname']; ?></td>
	<td class="center"><?php echo $r['itemsellingprice']; ?></td>
	<td><?php echo $get['p_quantity']; ?></td>
	<td><?php echo $get['p_rate']; ?></td>
	<td><a class=" btn btn-danger removetr" onclick="dltit2('<?php echo $get['itm_code']; ?>')"  ><i class="icon-trash icon-white"></i></a></td>
	
</tr>
							<?php
                                }
                                 ?>
								                          
							  </tbody>
						 </table>
						
						<div class="control-group">
								<label class="control-label" for="focusedInput">Total Amount</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on"><?php echo $get_u_details['global_currency'];?></span><input id="costPrice" class="gtotal" size="24"  disabled="disabled" type="text" value="<?php echo $cttl;  ?>">
									<input id="costPrice" class="gtotal1"  style="display: none" size="24" type="text" value="<?php echo $cttl;?>">
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
									<span class="add-on"><?php echo $get_u_details['global_currency'];?></span><input id="costPrice" class="net_p" disabled="disabled" size="24" type="text" value="<?php echo $cttl;?>">
									<input id="costPrice" class="net_pf" style="display: none" size="24" type="text" value="<?php echo $cttl;?>">
								  </div>
								</div>
							  </div>
							 												
							<div class="form-actions">
							  <span class="btn btn-primary place_order">Update Orders</span>
							  <button type="reset" class="btn truncate_tempo">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    <span id="rslt"></span>
<?php include('footer.php'); ?>
