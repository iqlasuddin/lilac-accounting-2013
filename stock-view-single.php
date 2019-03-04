<?php include 'header.php';
$usr=$_SESSION['uname'];
$get_u_details=mysql_fetch_array(mysql_query("select * from tblglobal where user='$usr'"));
?>
<!-- <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script> -->

<?php
if (!isset($_GET['icode'])) {
    header("location:stock-view.php");
} else {
      $icode=$_GET['icode'];
      if ($icode=='') {
          header("location:stock-view.php");
      }
      $query="select * from tblstock where itemcode='".$icode."'";
      $result=mysql_query($query);
      $stock=mysql_fetch_array($result);

 
      /* echo "<script> alert(". $icode."); </script>";*/ ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Stock </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Stock View </a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#"> <?php echo $icode." - ".$stock['itemname']; ?> </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">	
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><?php echo $icode." - ".$stock['itemname']." - ".$stock['itemquantity']." ". $stock['itemuom']." in stock"; ?></h2>
						
					</div>
					<div class="box-content">
						<table class="table table-bordered">
							  <thead>
								  <tr>
									  <th>Item Name</th>
									  <th><?php echo $stock['itemname']; ?></th>
									                                          
								  </tr>
							  </thead>   
							  <tbody>
								<tr>
									<td>Category</td>
									<td class="center"><?php echo $stock['itemname']; ?></td>
									                                    
								</tr>
								<tr>
									<td>Brand</td>
									<td class="center"><?php echo $stock['itemcategory']; ?></td>
									                                    
								</tr> 
								
								<tr>
									<td>Quantity in stock</td>
									<td class="center"><?php echo $stock['itemquantity'].' '.$stock['itemuom']; ?></td>
									                                    
								</tr>
								
								<tr>
									<td>Cost Price</td>
									<td class="center"><?php echo $stock['itemprice']." ".$get_u_details['global_currency']; ?></td>
									                                    
								</tr>
								
								<tr>
									<td>Selling Price</td>
									<td class="center"><?php echo $stock['itemsellingprice']." ".$get_u_details['global_currency']; ?></td>
									                                    
								</tr>
								                   
							  </tbody>
						 </table> 
						 <a href="stock-view" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Back to stock</a>
						  <a href="stock-update-item?icode=<?php echo $icode; ?>" class="btn btn-large btn-primary"><i class="icon-edit icon-white"></i> Edit</a>  
						
					</div>
				</div><!--/span-->
    
<?php
  } //outer else

include('footer.php'); ?>
