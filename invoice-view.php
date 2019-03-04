<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Receipts</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">View Receipts</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i> View Invoices</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th title="Item Name with Code">Invoice No</th>
								  <th title="Category and Code">Customer/Mobile</th>
								  <th>Amount</th>
								  <th title="Cost Price/ Selling Price">Received</th>
								  <th>Pending</th>
								  <th title="Stock Actions">Actions</th>
								</tr>
						  </thead>   
						  <tbody>
						  	<?php
                                $q="SELECT i.id,i.i_id,i.i_date,i.inv_pending,o.o_grand, CONCAT_WS('/',o.cust_name,cus_mobile) as cust, o_discount FROM tblinvoice i, tblorder o WHERE i.o_id=o.ord_code";
                                $run=mysql_query($q);
                                if ($run) {
                                    while ($inv=mysql_fetch_assoc($run)): ?>
								<tr>
									<td><?php echo $inv['i_id']; ?></td>
									<td class="center"><?php echo $inv['cust']; ?></td>
									<td><?php echo $inv['o_grand']; ?></td>
									<td><?php echo(round($inv['o_grand'])-round($inv['inv_pending'])); ?></td>
									<td><?php echo round($inv['inv_pending']); ?></td>
									<td class="center">
										<a class="btn btn-success" title="View Item" href="view-invoice?inv=<?php echo $inv['i_id']; ?>">
											<i class="icon-zoom-in icon-white"></i>  
											                                           
										</a>
																			</td>
								</tr>
								
								
								
							<?php endwhile;
                                }
                            ?>
						  	
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row--><!--/row-->
            <!--/row-->
            <?php include('footer.php'); ?>
