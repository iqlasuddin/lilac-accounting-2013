<?php include('header.php'); ?>
<?php
$usr=$_SESSION['uname'];
$get_u_details=mysql_fetch_array(mysql_query("select * from tblglobal where user='$usr'"));
$q= "select id from tblinvoice";
if (mysql_query($q)<>0) {
    $r=mysql_num_rows(mysql_query($q))+1;
    $invoice='INV'.$r;
} else {
    $invoice='INV1';
}
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
						<a href="#">Invoices </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">New Invoice</a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> New invoice</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
							<legend>Invoice Details</legend>
							<div class="control-group">
							  <label class="control-label" for="date65">Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" disabled="disabled"  id="date65" value="<?php echo date('d/m/Y', time());  ?>" >
							  </div>
							</div>
							<!-- <div class="control-group">
							  <label class="control-label" for="date01">Delivery  Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" >
							  </div>
							</div> -->
							<div class="control-group">
								<label class="control-label">Invoice Number</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input"><?php
                                     echo $invoice;
                                    $exploded=explode('@', $usr);
                                    $tbl=$exploded[0].$invoice;
                                    $delquery=	"DROP TABLE tblorder_$tbl";
                                    mysql_query($delquery);
                                   ?>
								   <input type="text" id="hidden_tblname" value="<?php echo 'tblorder_'.$tbl; ?>" style="display: none;" />
								   <input type="text" id="hidden_invcode" value="<?php echo $invoice; ?>" style="display: none;" />
								   <?php
                                   $deal=mysql_query("select id from tblorder order by id desc limit 1");//SELECT fields FROM table ORDER BY id DESC LIMIT 1;;
                                    $ordr = mysql_fetch_array($deal);
                                    $new_ordr=$ordr[0]+1;
                                    $order= "ORD" . $new_ordr;
                                    ?>
								    <input type="text" id="hidden_ordcode" value="<?php echo $order; ?>" style="display: none;" />
								   
								   </span>
								</div>
							  </div>
							  
														
							  <div class="control-group">
								<label class="control-label" for="itemName">Customer Name </label>
								<div class="controls">
								  <select class="input-xlarge cusrtm" id="invoiceNumber"  data-rel="chosen">
									<option value="">...Select Customer...</option>
									<?php
                                    $query=mysql_query("select * from tblcustomer where cust_status=1");
                                    while ($got_custm=mysql_fetch_array($query)) {
                                        ?>
										<option value=" <?php echo $got_custm['cust_name']." / ".$got_custm['cust_mobile']; ?>"><?php echo $got_custm['cust_name']." / ". $got_custm['cust_mobile']; ?></option>
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
										<option st="<?php echo $got_stock['itemquantity']; ?>" value="<?php echo $got_stock['itemcode']; ?>"><?php echo $got_stock['itemname']; ?></option>
							<?php
                                    }
                                     ?>
								</select>
								<span id="stock_count"></span>
								<!-- <a href="#" class="" onclick="$('#addCategory').modal('show');" data-rel="popover" data-content="Click here to Add New Item" title="Add Item"><i class="icon icon-color icon-add"> </i></a> -->
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="itm_qnty">Quantity</label>
								<div class="controls">
								  <input class="input-xlarge focused itm_qnty" id="itm_qnty" type="text" > 
								  <button class="btn btn-primary"  id="inv_itm">Add Item</button>
								  <img id="ajax_order_inv" style="display: none;" src="img/loading.gif">
								</div>
							  </div>
						  
							  <legend>Items Selected</legend>

							  <table class="table">
							  <thead>
								  <tr>
									  <th>Description</th>
									  <th>Rate[<?php echo $get_u_details['global_currency'];?>]</th>
									  <th>Quantity</th>
									  <th>Amount[<?php echo $get_u_details['global_currency'];?>]</th>
								  </tr>
							  </thead>   
							  <tbody class="itms_appender">
							        
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
									<span class="add-on">%</span><input id="o_disc" class="taxi" size="24" type="text" autocomplete="off" value="0">
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
							  <span class="btn btn-primary" onclick="new_invoice();">Create Invoice</span>
							  <button type="reset" class="btn truncate_tempo">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    <span id="rslt"></span>
<?php include('footer.php'); ?>
