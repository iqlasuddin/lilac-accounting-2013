<?php include('header.php'); ?>
<?php
$query_ord="select *from tblorder where status='1'";
 ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Order</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">View Orders</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i> View Orders</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th title="Item Name with Code">Order Code</th>
								  <th title="Category and Code">Customer/Contact No.</th>
								  <th title="Quantity available in stock">Total</th>
								  <th title="Cost Price/ Selling Price">Discount</th>
								  <th title="Quantity available in stock">Grand Total</th>
								  <th title="Stock Actions">Order Actions</th>
								</tr>
						  </thead>   
						  <tbody>
						  	<?php
                            $get_ord_details=mysql_query($query_ord);
                        $ttl_ord=mysql_num_rows($get_ord_details);
                        if ($ttl_ord>0) {
                            while ($got_ord_details=mysql_fetch_array($get_ord_details)) {
                                ?>
								<tr>
								<td><?php echo $got_ord_details['ord_code']; ?></td>
								<td class="center"><?php echo $got_ord_details['cust_name']."/".$got_ord_details['cus_mobile']; ?></td>
								<td class="center"><?php echo $got_ord_details['o_total']; ?></td>
								<td class="center"><?php echo $got_ord_details['o_discount']; ?>%</td>
								<td class="center"><?php echo $got_ord_details['o_grand']; ?></td>
								<td class="center">
									<a class="btn btn-success" title="View Order" href="view-order.php?order=<?php echo $got_ord_details['ord_code']; ?>" >
										<i class="icon-zoom-in icon-white"></i>  
									</a>
									
									<?php
                                    if ($got_ord_details['inv_code']=="") {
                                        ?>
										<a class="btn btn-danger" title="Delete Order" onclick="dlt_ord('<?php echo $got_ord_details['ord_code']; ?>')" href="#">
										<i class="icon-trash icon-white"></i> 
									</a>
										<a class="btn btn-inverse creat_inv" title="Create Invoice" href="invoice.php?order=<?php echo $got_ord_details['ord_code']; ?>">
										<i class="icon-share icon-white"></i> 
									</a>
						<?php
                                    } ?>
									
								</td>
							</tr>
								
					<?php
                            }
                        }  ?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row--><!--/row-->
            <!--/row-->
            <span id="rslt"></span>
            <?php include('footer.php'); ?>
