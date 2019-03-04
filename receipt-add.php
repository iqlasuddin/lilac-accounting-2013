<?php include('header.php');
$rcpt_no=mysql_num_rows(mysql_query("Select id FROM tblrcpt"))+1;
$invoices=mysql_query("Select i_id,i_amount,inv_pending FROM tblinvoice WHERE inv_pending>0");
$rcep_page=1;
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
						<a href="#">Add New Reciept </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> New Reciept Entry</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="new-rcpt">
						  <fieldset>
							<legend>Reciept Entry Details</legend>
							<div class="control-group">
							  <label class="control-label" for="date01">Date</label>
							  <div class="controls">
								<input type="text" name="date" value="<?php echo date("m/d/Y");?>" class="input-xlarge datepicker" id="date01" >
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label">Reciept Number</label>
								<div class="controls">
								  <span id="mashkiriyena" class="input-xlarge uneditable-input">REC<?php echo $rcpt_no; ?></span>
								  <input type="hidden" required="" id="rcpt_code" value="REC<?php echo $rcpt_no; ?>" name="rcpt_code" />
								</div>
							  </div>
							  
														
							  <div class="control-group">
								<label class="control-label" for="itemName">Invoice Number </label>
								<div class="controls">
								  <select name="inv" required class="input-xlarge" id="invoiceNumber" data-rel="chosen">
								  	<option></option>
									<?php while ($i=mysql_fetch_object($invoices)):
                                        echo '<option value="'.$i->i_id.'" amount="'.round($i->i_amount).'" pending="'.round($i->inv_pending).'">'.$i->i_id.'</option>
										';
                                    endwhile; ?>
								</select>
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Invoice Amount</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input name="amount" required="" disabled="" id="costPrice" size="24" type="text">
								  </div>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Recieved Cash</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input name="rcvd" required="" disabled="" id="rcvdcash" size="24" type="text">
								  </div>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Old Balance</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input name="bal" required="" disabled="" id="thooo" size="24" type="tel">
								  </div>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">New Balance</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input name="bal" required="" disabled="" id="balanceamt" size="24" type="text">
								  </div>
								</div>
							  </div>
							  
							  <!-- <div class="control-group">
								<label class="control-label" for="focusedInput">Payment</label>
								<div class="controls">
								 <div class="input-prepend">
									<span class="add-on">QAR</span><input id="costPrice" size="24" type="text">
								  </div>
								</div>
							  </div> -->
							  
							<div class="control-group">
								<label class="control-label" for="itemName">Payment Mode </label>
								<div class="controls method-radios">
								  
								  <label class="radio">
									<input type="radio" required="" name="method" id="optionsRadios1" value="cash" >
									Cash
								  </label>
							
							 <label class="radio">
									<input type="radio" required=""  name="method" id="optionsRadios2" value="cheque" >
									Cheque
								  </label>
								</div>
							  </div>
							  
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Cheque Number</label>
								<div class="controls">
									<input type="text" disabled="" name="ch_num" id="cheque1" class="input-xlarge" />
								</div>
							  </div>

							 <div class="control-group">
								<label class="control-label" for="focusedInput">Cheque Date</label>
								<div class="controls">
									<input type="text" disabled="" name="ch_date" id="cheque2" class="input-xlarge datepicker" />
								</div>
							  </div>
							  
							 <div class="control-group">
								<label class="control-label" for="focusedInput">Bank &amp; Branch</label>
								<div class="controls">
									<input type="text" disabled="" name="ch_bank" id="cheque3" class="input-xlarge" />
								</div>
							  </div>
							  
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
