<?php include('header.php');
if (isset($_GET['inv'])) {
    $invoice_no=$_GET['inv'];
    $invoices=mysql_query("Select * FROM tblinvoice_direct WHERE inv_id=$invoice_no");
}
?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Receipts </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add New Instant Reciept </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> New Instant Reciept Entry</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="instant-receipt-process">
						  <fieldset>
							<legend>Reciept Entry Details</legend>
							
							<div class="control-group">
								<label class="control-label">Instant Receipt Number</label>
								<div class="controls">
								  <input type="text" name="inst_rec_no" readonly value="<?php echo get_instant_rec_no(); ?>" class="input-xlarge"/>
								  
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="date01">Date</label>
							  <div class="controls">
								<input type="text" name="inst_rec_date" value="<?php echo date("m/d/Y");?>" class="input-xlarge" readonly id="date01" >
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label">Invoice Number</label>
								<div class="controls">
								  <input type="text" name="inst_rec_inv" readonly value="<?php echo $invoice_no;?>" class="input-xlarge"/>
								  
								</div>
							  </div>
							<?php while ($i=mysql_fetch_object($invoices)):?>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Invoice Amount</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span>
									<input name="amount" required="" disabled="" id="invoiceamt" size="24" type="text" value="<?php echo $i->grand_total; ?>">
								  </div>
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label" for="focusedInput">Old Balance</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input name="bal" required="" disabled="" id="old_balance" size="24" type="tel" value="<?php echo $i->balancepayment; ?>">
								  </div>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Recieved Cash</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input name="rec_cash" required="required" id="rec_cash"  size="24" type="text" >
								  </div>
								</div>
							  </div>
							  
							 
							  <div class="control-group">
								<label class="control-label" for="focusedInput">New Balance</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input name="bal" disabled="" id="balanceamt" size="24" type="text">
								  </div>
								</div>
							  </div>
							 <?php endwhile ?>
							  
						
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Receipt</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    
<?php include('footer.php'); ?>
