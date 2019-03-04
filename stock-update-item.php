<?php include 'header.php';
$usr=$_SESSION['uname'];
$get_u_details=mysql_fetch_array(mysql_query("select * from tblglobal where user='$usr'"));
if (!isset($_GET['icode'])) {
    header("location:stock-view");
} else {
      $icode=$_GET['icode'];
      if (empty($icode)) {
          header("location:stock-view");
      }
      // $_SESSION['updateicode']=$icode;
      $query="select * from tblstock where itemcode='".$icode."'";
      $result=mysql_query($query);
      $stock=mysql_fetch_array($result); ?>

<!-- <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script> -->

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index">Home</a> <span class="divider">/</span>
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
						<h2><i class="icon-edit"></i>Update Stock</h2>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" id="stockupdate" method="post" action="update_stock">
						  <fieldset>
							<legend>Update stock for <?php echo $stock['itemname']; ?></legend>
							<!-- <div class="control-group">
							  <label class="control-label" for="date01">DATE</label>
							  <div class="controls">
								<!-- <input type="text" required class="input-xlarge datepicker" id="date01"  name="itemdate"> 
								<input type="text" required class="input-xlarge uneditable-input" id="itemdate"  name="itemdate" value="<?php echo $stock['itemdate']; ?>" />
								 </div>
							</div> -->
							<div class="control-group">
								<label class="control-label">Item Code</label>
								<div class="controls">
								  <!-- <span class="input-xlarge uneditable-input">ITM0254</span> -->
								  <input type="hidden" required="" name="itemid" value="<?php echo $stock['itemid']; ?>" />
								  <input type="text" class="input-xlarge uneditable-input" disabled="disabled" value="<?php echo $stock['itemcode']; ?>" />
								</div>
							  </div>
							
							  <div class="control-group">
								<label class="control-label" for="itemName">Item Name </label>
								<div class="controls">
								  <input class="input-xlarge focused" name="itemname" id="itemName" type="text" required value="<?php echo $stock['itemname']; ?>" >
								</div>
							  </div>
							  	
								<div class="control-group">
							  <label class="control-label" for="selectCategory">Select Category</label>
							  <div class="controls" >
							  	<span id="selectCategory">
								<select class="input-xlarge" required id="itemSelectCategory" data-rel="chosen" name="itemcategory">
									<?php
                                    $query_cat=mysql_query("select c_name from tblcategory");
      while ($cats=mysql_fetch_array($query_cat)) {
          ?>
										<option <?php echo $cats['c_name']==$stock['itemcategory']?'selected':'' ?> value="<?php echo $cats['c_name']; ?>"><?php echo $cats['c_name']; ?></option>
								<?php
      } ?>

							 	 </select>
							 	 </span>
								 <a href="#" class="" onclick="$('#addCategory').modal('show');" data-rel="popover" data-content="If you don't find the category, click here to add one" title="Add Category"><i class="icon icon-color icon-add"> </i></a>
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Brand</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="focusedInput" type="text" required  name="itembrand" value="<?php echo $stock['itembrand']; ?>">
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="selectUOM">Unit of Measurement </label>
							  <div class="controls">
								<select class="input-xlarge" required id="selectUOM" data-rel="chosen" name="itemuom">
										<?php
                                    $query_uom=mysql_query("select * from tbluom");
      while ($uom=mysql_fetch_array($query_uom)) {
          ?>
										<option value="<?php echo $uom['u_name']; ?>" <?php echo $uom['u_name'] == $stock['itemuom']?'selected':''; ?>><?php echo $uom['u_name']; ?></option>
								<?php
      } ?>
								</select>
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="quantity">Quantity </label>
								<div class="controls">
								  <input class="input-xlarge focused" id="quantity" type="text" required  name="itemquantity" value="<?php echo $stock['itemquantity']; ?>">
								</div>
							  </div>  
							  
							  <div class="control-group">
								<label class="control-label" for="costPrice">Cost Price </label>
								<div class="controls">
								  <div class="input-prepend">
									<span class="add-on">
									<?php
                                     echo $get_u_details['global_currency']; ?>
									</span>
									<input id="costPrice" size="24" type="text" required name="itemprice" value="<?php echo $stock['itemprice']; ?>">
								  </div>
								</div>
							  </div>							  
							  
							  
							  <div class="control-group">
								<label class="control-label" for="sellingPrice">Selling Price </label>
								<div class="controls">
								  <div class="input-prepend input-xlarge">
									<span class="add-on"><?php echo $get_u_details['global_currency']; ?></span>
									<input id="sellingPrice" size="24" type="text" required name="itemsellingprice" value="<?php echo $stock['itemsellingprice']; ?>">
								  </div>
								 </div>
							  </div>
								<div class="control-group">
								<label class="control-label" for="quantity">Product Status</label>
								<div class="controls">
									<label for="r15">Enabled: <input type="radio" name="status" <?php echo $stock['itemstatus']==1?'checked':''; ?>  id="r15" value="1" title="Enabled" /></label>
									<label for="r25">Disabled: <input type="radio" name="status" <?php echo $stock['itemstatus']==0?'checked':''; ?> id="r25" value="0" title="Disabled" /></label>
								</div>
							  </div> 				
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" value="submit" name="submit" id="subit">Update Item</button>
							  <button  type="reset" onclick="window.location='stock-view'" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>


					</div>
				</div><!--/span-->

			</div><!--/row-->
    
<?php
  }
include('footer.php'); ?>
