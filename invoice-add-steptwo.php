<?php include('header.php');
    $invoice_date='';
    $cust_name='';
    $cust_contact='';
    $page_items_total=0;
    $invoice_no = $_SESSION['invoice_no'];
    if (isset($_GET['err'])) {
        echo "<script> alert('Exceeding Limit : Instant invoice can contain only upto 5 items. please try regular invoice instead'); </script>";
    }
//echo "SELECT `inv_date`, `cust_name`, `cust_contact` FROM tblinvoice WHERE inv_id='$invoice_no'";
$query=mysql_query("SELECT `inv_date`, `cust_name`, `cust_contact` FROM tblinvoice_direct WHERE inv_id='$invoice_no'") or die("We encountered some problem in creating this invoice, please try after sometime");
while ($rows=mysql_fetch_array($query)) {
    $invoice_date=$rows['inv_date'];
    $cust_name=$rows['cust_name'];
    $cust_contact=$rows['cust_contact'];
}

$qry_invoice_items=mysql_query("SELECT * FROM tblinvoiceitems WHERE inv_id='$invoice_no'") or die("We encountered some problem in creating this invoice, please try after sometime");
$slno=1;
$fet_item_name="";
$fet_item_price="";
$fet_item_quantity="";

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
						<h2><i class="icon-edit"></i> Invoice Items Entry </h2>
						
					</div>
					<div class="box-content">
						
						 <table class="table" style="width:450px!important">
							  
							  <tbody>
								<tr>
									<td>Invoice Number</td>
									<td>:</td>
									<td><?php echo $invoice_no; ?> </td>
								</tr>
								<tr>
									<td>Invoice Date</td>
									<td>:</td>
									<td><?php echo $invoice_date; ?> </td>
								</tr>
								<tr>
									<td>Customer Name</td>
									<td>:</td>
									<td><?php echo $cust_name; ?> </td>
								</tr>
									<td>Customer Contact</td>
									<td>:</td>
									<td><?php echo $cust_contact; ?> </td>
									
								</tr>
								
								                          
							  </tbody>
						 </table>
						 
						
						 <div class="control-group">
								<label class="control-label" for="focusedInput">Item Name / Code</label>
								<div class="controls">
								 <select class="input-xlarge instantStock" id="itemDetails" data-rel="chosen">
									<option value="">...Select Item...</option>
									<?php
                                    $query_stock=mysql_query("select * from tblstock");
                                    while ($got_stock=mysql_fetch_array($query_stock)) {
                                        ?>
										<option st="<?php echo $got_stock['itemquantity']; ?>" value="<?php echo $got_stock['itemcode']; ?>" pr="<?php echo $got_stock['itemsellingprice']?>"><?php echo $got_stock['itemname']; ?></option>
							<?php
                                    }
                                     ?>
								</select>
								</div>
							  </div>

						
<?php if ($invoice_date=='' && $cust_name=='' && $cust_contact=='') {
                                         header("location:invoice-add-stepone.php?er=Start from Step 1");
                                     } ?>						
						<form class="form-horizontal" action="invoice-process.php" method="post">
						  <fieldset>
						  <table class="table" style="width:450px!important">
							  
							  <tbody>
							  <thead>
							  	<th> Item Name </th>
								<th> Item Price </th>
								<th> Item Quantity </th>
							  </thead>
							  <tbody>
								<tr>
								<td> <input class="input focused" name="txt-item-name" id="inv_itemname" type="text" /> </td>
								<td> <input class="input focused" name="txt-item-price" id="inv_itemprice" type="text" /></td>
								<td> <input class="input focused" name="txt-item-quantity" id="inv_itemqty"  type="text" /></td>
								<td>  <button type="submit" class="btn btn-primary"> ADD </button> </td>
								</tr>
							                      
							  </tbody>
							  </table>
							  	<input type="hidden" name="hdn-invoice-step" value="invoice-step-two" />
						</form>   
						
						  
							

							  <table class="table">
							  <thead>
								  <tr>
									  <th>Slno</th>
									  <th>Description</th>
									  <th>Rate[QAR]</th>
									  <th>Quantity</th>
									  <th>Amount[QAR]</th>
									  <th>Delete</th>
								  </tr>
							  </thead>   
							  <tbody>
								<?php
                                while ($item_rows=mysql_fetch_array($qry_invoice_items)) {
                                    $fet_item_id=$item_rows['inv_item_id'];
                                    $fet_item_name=$item_rows['item_name'];
                                    $fet_item_price=$item_rows['item_rate'];
                                    $fet_item_quantity=$item_rows['item_quantity']; ?>							
								<tr>
									<td><?php echo $slno; ?></td>
									<td><?php echo $fet_item_name; ?></td>
									<td class="center"><?php echo $fet_item_price; ?></td>
									<td><?php echo $fet_item_quantity; ?></td>
									<td><?php echo $fet_item_quantity * $fet_item_price;
                                    $page_items_total += $fet_item_quantity * $fet_item_price; ?></td>
									<td> 
									<a class="btn btn-danger" title="Delete item <?php echo $fet_item_name; ?>" href="<?php echo 'delete-instant-invoice-item?id='.$fet_item_id; ?>">
											<i class="icon-trash icon-white"></i>  
											                                           
										</a>
									
									</td>
								</tr>
							<?php
                            $slno++;
                                } ?>
							</tbody>
						 </table>
						<form class="form-horizontal" action="invoice-process.php" method="post" id="frm_item_details_add">
						<div class="control-group">
								<label class="control-label" for="txt-itemsTotalPrice">Total Amount</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input id="txt-itemsTotalPrice" name="txt-itemsTotalPrice" size="24" type="text" value="<?php echo $page_items_total?>" readonly>
								 </div>
								 
								</div>
							  </div>
							  
						<div class="control-group">
								<label class="control-label" for="focusedInput">Discount(%)</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input id="txt-discount" name="txt-discount" size="24" type="text" value="0" onblur="jsApplyDiscount(this.value);">
								  </div>
								</div>
							  </div>
						
													  
						<div class="control-group">
								<label class="control-label" for="txt-pageGrandTotal" >Grand Total</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input id="txt-pageGrandTotal" class="input-xlarge uneditable-input" name="txt-pageGrandTotal" size="24" type="text" value="<?php echo $page_items_total?>" readonly>
								  </div>
								</div>
							  </div>
							  
							  
							  	<div class="control-group">
								<label class="control-label" for="txt-advancePayment" >Advance Payment</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input id="txt-advancePayment" name="txt-advancePayment" size="24" type="text" value="0" onblur="jsApplyAdvance(this.value);" onkeypress="document.getElementById('txt-balancePayment').value='';">
								  </div>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="txt-balancePayment" >Balance</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input id="txt-balancePayment" name="txt-balancePayment" size="24" type="text" value="<?php echo $page_items_total?>" class="input-xlarge uneditable-input" readonly>
								  </div>
								</div>
							  </div>
							 												
						
						<div class="form-actions">
							  <button type="submit" id="submit_button" class="btn btn-primary">Save &amp; Print</button>
						</div>
						
						<input type="hidden" name="hdn-invoice-step" value="invoice-step-three" />
						
					</form>
					</div>
				</div><!--/span-->

			</div><!--/row-->
    
<?php include('footer.php'); ?>

<script type="text/javascript">
function jsApplyDiscount(discountPercent)
{
	var totalPrice= document.getElementById('txt-itemsTotalPrice').value;
	var finalPrice = totalPrice - (totalPrice * discountPercent / 100);
	document.getElementById('txt-pageGrandTotal').value=finalPrice.toString();
	document.getElementById('txt-balancePayment').value=finalPrice.toString();
}

function jsApplyAdvance(advance)
{
	var grandtotal= document.getElementById('txt-pageGrandTotal').value;
	if(Number(advance)>Number(grandtotal)){
		document.getElementById("txt-advancePayment").value=grandtotal.toString();
		document.getElementById("txt-balancePayment").value='0';
		return;
	}
	var balance = grandtotal - advance;
	
	document.getElementById('txt-balancePayment').value=roundToTwo(balance);
}
function roundToTwo(num){
	return +(Math.round(num + "e+2") + "e-2");
}

</script>
