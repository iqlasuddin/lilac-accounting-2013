
<?php include('header.php'); ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index">Home</a> <span class="divider">/</span>
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
						<form class="form-horizontal" action="invoice-process.php" method="post">
						  <fieldset>
							<legend>Invoice Entry Details</legend>
							
							
							<div class="control-group">
							  <label class="control-label" for="invoice-date">Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge" name="txt-invoice-date" id="invoice-date" value="<?php echo date('m/d/Y', time());  ?>" readonly>
							  </div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="txt-invoice-no">Invoice Number </label>
								<div class="controls">
							 <input class="input-xlarge focused"  disabled="disabled" id="temp-invoice-no" name="temp-invoice-no" type="text" value="<?php echo get_invoice_id(); ?>" >
							<input type="hidden" name="txt-invoice-no" value="<?php echo get_invoice_id(); ?>" />
							 <!--hidden field for acutal data post-->
							</div>
							  </div>
								
								<div class="control-group">
								<label class="control-label" for="itemName">Customer Name </label>
								<div class="controls">
								  <select class="input-xlarge cusrtm click_fill_cust" id="cust_name" name="cust_name"  data-rel="chosen">
									<option value="">...Select Customer...</option>
									<?php
                                    $query=mysql_query("select * from tblcustomer where cust_status=1");
                                    while ($got_custm=mysql_fetch_object($query)) {
                                        ?>
										<option value=" <?php echo $got_custm->cust_name."/".$got_custm->cust_mobile; ?>"><?php echo $got_custm->cust_name." / ". $got_custm->cust_mobile; ?></option>
							<?php
                                    }
                                     ?>
								</select>
									<a href="#" class="" onclick="$('#addCustomer').modal('show');" data-rel="popover" data-content="Click here to Add New Customer" title="Add Customer"><i class="icon icon-color icon-add"> </i></a>
								</div>
							  </div>
							  
								
							  <div class="control-group">
								<label class="control-label" for="txt-cust-name">Customer Name </label>
								<div class="controls">
							 <input class="input-xlarge focused" id="txt-cust-name" name="txt-cust-name" type="text" >
							</div>
							  </div>
							  
							  	  <div class="control-group">
								<label class="control-label" for="txt-cust-contact">Customer Contact </label>
								<div class="controls">
							 <input class="input-xlarge focused" id="txt-cust-contact" name="txt-cust-contact" type="text" autocomplete="off" >
							</div>
							  </div>
							  
							  <input type="hidden" name="hdn-invoice-step" value="invoice-step-one" />
							  
							
							
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Create Invoice</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    

<?php include('footer.php'); ?>

