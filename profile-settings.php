<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>					</li>
					<li>
					<a href="#">Global Settings</a></li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Global Settings</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal">
						  <fieldset>
							<legend>Global Application Setup</legend>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Company Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" >
							  </div>
							</div>
							
								<div class="control-group">
							  <label class="control-label" for="date01">Company Tagline</label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" >
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="textarea2">Address</label>
							  <div class="controls">
								<textarea  name="company_address" rows="3"></textarea>
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Landline Number </label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Mobile Number </label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Fax Number </label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Email (Default) </label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" >
							  </div>
							</div>
							
									<div class="control-group">
							  <label class="control-label" for="selectCurrency">Currency</label>
							  <div class="controls">
								<select class="input-xlarge" id="selectCurrency" data-rel="chosen">
									<option selected="selected">...Select Currency...</option>
									<option>AUD</option>
									<option>KWD</option>
									<option>QAR</option>
									<option>INR</option>
									<option>GBP</option>
									<option>USD</option>									
							 	 </select>
								 <a href="#" class="" onclick="$('#addCurrency').modal('show');" data-rel="popover" data-content="If you don't find the your currency, click here to add one" title="Add Currency"><i class="icon icon-color icon-add"> </i></a>
							  </div>
							</div>
							
							
							 <div class="control-group">
								<label class="control-label">Logo (png,jpg)</label>
								<div class="controls">
								  <input type="file">
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label">Favicon (png,jpg)</label>
								<div class="controls">
								  <input type="file">
								</div>
							  </div>
							
									
							<div class="control-group">
							  <label class="control-label" for="date01">Copyright Info </label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" >
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Copyright Link </label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" >
							  </div>
							</div>
							
																										
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Save Settings</button>
							  <button type="reset" class="btn btn-primary noty" data-noty-options='{"text":"Data not saved","layout":"top","type":"error"}'>Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
    
<?php include('footer.php'); ?>
