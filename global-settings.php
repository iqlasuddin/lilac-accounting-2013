<?php include('header.php'); ?>
<?php
$getglobals=mysql_fetch_array(mysql_query("select * from tblglobal"));
$cc=$getglobals['global_currency'];
 ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>					</li>
					<li>
					<a href="global-settings.php">Global Settings</a></li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Global Settings</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="global_form" method="post">
						  <fieldset>
							<legend>Global Application Setup</legend>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Company Name</label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" name="global_cname"  value="<?php if (!empty($getglobals['global_cname'])) {
     echo $getglobals['global_cname'];
 }  ?>">
							  </div>
							</div>
							
								<div class="control-group">
							  <label class="control-label" for="date01">Company Tagline</label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" name="global_ctagline"  value="<?php if (!empty($getglobals['global_ctagline'])) {
     echo $getglobals['global_ctagline'] ;
 }?>">
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="textarea2">Address</label>
							  <div class="controls">
								<textarea rows="3" name="global_caddress"><?php if (!empty($getglobals['global_caddress'])) {
     echo $getglobals['global_caddress'];
 } ?></textarea>
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Landline Number </label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" name="global_clandline"  value="<?php if (!empty($getglobals['global_clandline'])) {
     echo $getglobals['global_clandline'];
 } ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Mobile Number </label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" name="global_mobile"  value="<?php if (!empty($getglobals['global_mobile'])) {
     echo $getglobals['global_mobile'];
 } ?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Fax Number </label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" name="global_fax"  value="<?php if (!empty($getglobals['global_fax'])) {
     echo $getglobals['global_fax'];
 } ?>" >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Email (Default) </label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput"  name="global_email"  value="<?php if (!empty($getglobals['global_email'])) {
     echo $getglobals['global_email'];
 } ?>">
							  </div>
							</div>
							
									<div class="control-group">
							  <label class="control-label" for="selectCurrency">Currency</label>
							  <div class="controls">
								<select class="input-xlarge" id="selectCurrency" data-rel="chosen" name="global_currency">
									<option value="">...Select Currency...</option>
									<?php
                                    $cquery="select * from tblcurrency";
                                    $get_currency=mysql_query($cquery);
                                    while ($got_currency=mysql_fetch_array($get_currency)) {
                                        ?>
										<option <?php if ($cc==$got_currency['currency']) {
                                            echo 'selected="selected"';
                                        } ?>><?php echo $got_currency['currency']; ?></option>
									<?php
                                    }
                                     ?>
									<!-- <option>AUD</option>
									<option>KWD</option>
									<option>QAR</option>
									<option>INR</option>
									<option>GBP</option>
									<option>USD</option>		 -->							
							 	 </select>
								 <!-- <a href="#" class="" onclick="$('#addCurrency').modal('show');" data-rel="popover" data-content="If you don't find the your currency, click here to add one" title="Add Currency"><i class="icon icon-color icon-add"> </i></a> -->
								 
							  </div>
							</div>
							
							
							 <div class="control-group">
								<label class="control-label">Logo (png,jpg)</label>
								<div class="controls">
								  <input type="file" name="global_logo">
								</div>
							  </div>
							  
							   <div class="control-group">
								<label class="control-label">Favicon (png,jpg)</label>
								<div class="controls">
								  <input type="file" name="global_favicon">
								</div>
							  </div>
							
									
							<div class="control-group">
							  <label class="control-label" for="date01">Copyright Info </label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput" name="global_copyinfo"  value="<?php if (!empty($getglobals['global_copyinfo'])) {
                                         echo $getglobals['global_copyinfo'];
                                     } ?>">
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="date01">Website</label>
							  <div class="controls">
								<input type="text" class="input-xlarge focused" id="focusedInput"  name="global_copylink" value="<?php if (!empty($getglobals['global_copylink'])) {
                                         echo $getglobals['global_copylink'];
                                     } ?>">
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
