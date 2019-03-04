<?php include('header.php'); ?>
<?php
$query=mysql_query("select * from tblcustomer where cust_status=1 order by cust_code DESC");
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    if ($id=='del') {
        echo '<script> alert("Customer successfully deleted"); </script>';
    } elseif ($id='er') {
        echo '<script> alert("Error in deleting customer, please try again later"); </script>';
    }
}
 ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Customer</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">View Customers </a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i> View Customers </h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th title="Item Name with Code">Name [CODE] </th>
								  <th title="Category and Code">Address</th>
								  <th title="Quantity available in stock">Email ID </th>
								  <th title="Cost Price/ Selling Price">Contact</th>
								  <th title="Stock Actions">Stock Actions</th>
							</tr>
						  </thead>   
						  <tbody>
						  	<?php
                            while ($got_cust=mysql_fetch_array($query)) {
                                ?>
							<tr>
								<td><?php echo $got_cust['cust_name']; ?><?php echo "[".$got_cust['cust_code']."]"; ?></td>
								<td class="center"><?php echo $got_cust['cust_address']; ?></td>
								<td class="center"><?php echo $got_cust['cust_email']; ?></td>
								<td class="center"><?php echo $got_cust['cust_mobile']; ?></td>
								<td class="center">
									<a class="btn btn-success" title="View Customer" href="customer-view-single?ccode=<?php echo $got_cust['cust_code'] ?>">
										<i class="icon-zoom-in icon-white"></i>  
										                                           
									</a>
									<a class="btn btn-info" title="Edit/Update Customer" href="customer-update?ccode=<?php echo $got_cust['cust_code'] ?>">
										<i class="icon-edit icon-white"></i>  
										                                          
									</a>
									<a class="btn btn-danger" title="Delete <?php echo $got_cust['cust_name']; ?>" href="<?php echo 'confirm-delete?del=0XWs9wmet6&id='.$got_cust['id'].'&name='.urlencode($got_cust['cust_name']); ?>">
										<i class="icon-trash icon-white"></i> 
										
									</a>
								</td>
							</tr>	
						<?php
                            }
                            
                             ?>

							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row--><!--/row-->
            <!--/row-->
            <?php include('footer.php'); ?>
