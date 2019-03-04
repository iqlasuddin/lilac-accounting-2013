<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Orders </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add New Order </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> New Order Entry</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
							<legend>Order Entry Details</legend>
							<div class="control-group">
							  <label class="control-label" for="date01">Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" >
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label">Order Code</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input">ORD0254</span>
								</div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Order Title</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" >
								</div>
							  </div>
							
							  <div class="control-group">
								<label class="control-label" for="itemName">Customer Name </label>
								<div class="controls">
								  <select class="input-xlarge" id="selectCustomer" data-rel="chosen">
									<option selected="selected">...Select Customer...</option>
									<option>John Doe</option>
									<option>Jake Jones</option>
									<option>Sully Jake</option>
									<option>Tom Burner</option>
									<option>Will Smith</option>
									<option>Joyce Code</option>
								</select>
									<a href="#" class="" onclick="$('#addCustomer').modal('show');" data-rel="popover" data-content="Click here to Add New Customer " title="Add Customer"><i class="icon icon-color icon-add"> </i></a>
								</div>
							  </div>
							  
							
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Price</label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">QAR</span><input id="costPrice" size="24" type="text">
								  </div>
								</div>
							  </div>
							  
							  <div class="control-group">
							  <label class="control-label" for="date01">Delivery Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="date01" >
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="textarea2">Measurement Sheet</label>
							  <div class="controls">
								<textarea  class="cleditor" name="company_address" rows="3"></textarea>
							  </div>
							</div>
												
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Add Order</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    
<?php include('footer.php'); ?>
