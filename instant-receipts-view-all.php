<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Instant Receipts</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">View Instant Receipts</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i> View Instant Receipts</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Receipt No [Invoice No]</th>
								  <th>Customer/Mobile</th>
								  <th>Date</th>
								  <th>Receipt Amount</th>
								  <th>Actions</th>
								</tr>
						  </thead>   
						  <tbody>
						  	<?php

                                $q="SELECT r.instrec_no, r.instrec_inv_no, r.instrec_date, r.instrec_amt, i.cust_name, i.cust_contact
										FROM tbl_instrec r, tblinvoice_direct i
										WHERE r.instrec_inv_no = i.inv_id";
                                $run=mysql_query($q);
                                if ($run) {
                                    while ($inv=mysql_fetch_array($run)): ?>
								<tr>
									<td><?php echo $inv['instrec_no']."/".$inv['instrec_inv_no']; ?></td>
									<td class="center"><?php echo $inv['cust_name']; ?>/<?php echo $inv['cust_contact'] ?></td>
									<td><?php echo $inv['instrec_date']; ?></td>
									<td><?php echo round($inv['instrec_amt']); ?></td>
									<td class="center">
										<a class="btn btn-success" title="View Item" href="instant-receipt-view-single?r=<?php echo $inv['instrec_no']; ?>">
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
