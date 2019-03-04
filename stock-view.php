<?php include('header.php');
$query="select * from tblstock where itemstatus=1";
$result=mysql_query($query);
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    if ($id=='del') {
        echo '<script> alert("Item successfully deleted from stock"); </script>';
    } elseif ($id='er') {
        echo '<script> alert("Error in deleting item, please try again later"); </script>';
    }
}
 ?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Stock</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">View Stock</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i> View Stock</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th title="Item Name with Code">Name/Item Code</th>
								  <th title="Category and Brand">Category [Brand]</th>
								  <th title="Quantity available in stock">Quantity</th>
								  <th title="Cost Price">CP/SP</th>
								  <th title="Selling Price">CP/SP</th>
								  <th title="Stock Actions">Stock Actions</th>
								</tr>
						  </thead>   
						  <tbody>
						  	<?php
                            while ($stock=mysql_fetch_array($result)) {
                                ?>
						  		
						  		<tr>
								<td><?php echo  $stock ['itemname'] ."/". $stock['itemcode']; ?></td>
								<td class="center"><?php echo $stock ['itemcategory']."[".$stock['itembrand']."]" ; ?></td>
								<td class="center"><?php echo $stock ['itemquantity'] ." ".$stock ['itemuom']; ?></td>
								<td class="center"><?php echo $stock['itemprice']; ?></td>
								<td><?php echo $stock['itemsellingprice']; ?></td>
								<td class="center">
									<a class="btn btn-success" title="View Item" href="<?php echo 'stock-view-single?icode='.$stock['itemcode']; ?>">
										<i class="icon-zoom-in icon-white"></i>  
										                                           
									</a>
									<a class="btn btn-info" title="Edit/Update Stock" href="<?php echo 'stock-update-item?icode='.$stock['itemcode']; ?>">
										<i class="icon-edit icon-white"></i>  
										                                          
									</a>
									
									<a class="btn btn-danger"  title="Delete <?php echo $stock['itemname']; ?>" href="<?php echo 'confirm-delete?del=stxuS58e&id='.$stock['itemid'].'&name='.urlencode($stock['itemname']); ?>"> 
										<i class="icon-trash icon-white"></i> 
										
									</a>
									
									<!--<a class="btn btn-danger" id="stockdelete"  title="Delete Item" href="<?php //echo 'delete_stock.php?icode='.$stock['itemcode']?>">
										<i class="icon-trash icon-white"></i> 
										
									</a>-->
									
								</td>
							</tr>
						  		
								  
					<?php
                            } 	  ?>
						  	
							
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row--><!--/row-->
            <!--/row-->
            <?php include('footer.php'); ?>
