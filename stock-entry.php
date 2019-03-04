<?php include 'header.php';
$usr=$_SESSION['uname'];
$get_u_details=mysql_fetch_array(mysql_query("select * from tblglobal where user='$usr'"));
 ?>

<!-- <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script> -->

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Stock </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Stock Entry </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> New Stock Entry</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="stockentry" method="post">
						  <fieldset>
							<legend>Stock Entry Details</legend>
							<div class="control-group">
							  <label class="control-label" for="date01">DATE</label>
							  <div class="controls">
								<!-- <input type="text" class="input-xlarge datepicker" id="date01"  name="itemdate"> -->
								<input type="text" class="input-xlarge uneditable-input" id="itemdate"  name="itemdate" value="<?php echo $new_game = date('d/m/Y', time());  ?>" />
								 </div>
							</div>
							<div class="control-group">
								<label class="control-label">Item Code</label>
								<div class="controls">
								  <!-- <span class="input-xlarge uneditable-input">ITM0254</span> -->
								  <input type="text" class="input-xlarge uneditable-input" disabled="disabled" name="itemcode" value="<?php
                                   $item=mysql_num_rows(mysql_query("select * from tblstock"));
                                  $new_item=$item+1;
                                  echo $_SESSION['itemcode'] ="ITM". $new_item;  ?>" />
								</div>
							  </div>
							
						  	
								<div class="control-group">
							  <label class="control-label" for="selectCategory">Select Category</label>
							  <div class="controls" >
							  	<span id="selectCategory">
								<select class="input-xlarge" id="itemSelectCategory" data-rel="chosen" name="itemSelectCategory">
									<option  value="">...Select Category...</option>
									<?php
                                    $query_cat=mysql_query("select c_name from tblcategory");
                                    while ($cats=mysql_fetch_array($query_cat)) {
                                        ?>
										<option><?php echo $cats['c_name']; ?></option>
								<?php
                                    }
                                     ?>
									
									<!-- <option >Cotton Cloth</option>
									<option>Embroidery Cloth</option>
									<option>Tools</option>
									<option >Nylon Cloth</option>
									<option >Threads</option> -->
							 	 </select>
							 	 </span>
								 <a href="#" class="" onclick="$('#addCategory').modal('show');" data-rel="popover" data-content="If you don't find the category, click here to add one" title="Add Category"><i class="icon icon-color icon-add"> </i></a>
							  </div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="itemName">Item Name </label>
								<div class="controls">
								  <input class="input-xlarge focused" name="itemname" id="itemName" type="text" >
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Brand</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text"  name="itembrand">
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="selectUOM">Unit of Measurement </label>
							  <div class="controls">
								<select class="input-xlarge" id="selectUOM" data-rel="chosen" name="itemuom">
									<option value="">...Select UOM...</option>
										<?php
                                    $query_uom=mysql_query("select * from tbluom");
                                    while ($uom=mysql_fetch_array($query_uom)) {
                                        ?>
										<option><?php echo $uom['u_name']; ?></option>
								<?php
                                    }
                                     ?>
								</select>
							  </div>
							</div>
								 <div class="control-group">
								<label class="control-label" for="quantity">Quantity </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="quantity" type="text"  name="itemquantity">
								</div>
							  </div>  
							  
							  <div class="control-group">
								<label class="control-label" for="costPrice">Cost Price </label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">
									<?php
                                     echo $get_u_details['global_currency'];?>
									
									</span>
									<input id="costPrice" size="24" type="text" name="itemprice">
								  </div>
								</div>
							  </div>							  
							  
							  
							  <div class="control-group">
								<label class="control-label" for="sellingPrice">Selling Price </label>
								<div class="controls">
								  <div class="input-prepend input-xlarge">
									<span class="add-on"><?php echo $get_u_details['global_currency'];?></span><input id="sellingPrice" size="24" type="text" name="itemsellingprice">
								  </div>
								 </div>
							  </div>
												
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" value="submit" name="submit" id="subit">Add Item</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>


					</div>
				</div><!--/span-->

			</div><!--/row-->
    
<?php include('footer.php'); ?>
