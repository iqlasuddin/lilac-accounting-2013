<?php include('header.php'); ?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Instant Invoices</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">View Instant Invoices</a>
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
								  <th>Invoice No</th>
								  <th>Customer/Mobile</th>
								  <th>Amount</th>
								  <th>Received</th>
								  <th>Pending</th>
								  <th>Actions</th>
								</tr>
						  </thead>   
						  <tbody>
						  	<?php
                                $get_dummy_invoice_numbers=mysql_query("select inv_id from tblinvoice_direct WHERE grand_total is null or grand_total=0");
                                if ($get_dummy_invoice_numbers) {
                                    while ($got_dummy=mysql_fetch_array($get_dummy_invoice_numbers)) {
                                        $dummy_no=$got_dummy['inv_id'];
                                        mysql_query("DELETE FROM tblinvoiceitems where inv_id=$dummy_no;");
                                        mysql_query("DELETE FROM tblinvoice_direct WHERE inv_id=$dummy_no;");
                                    }
                                }
                                $q="SELECT * FROM tblinvoice_direct WHERE status=1 ORDER BY inv_id ASC";
                                $run=mysql_query($q);
                                if ($run) {
                                    while ($inv=mysql_fetch_array($run)): ?>
								<tr>
									<td><?php echo $inv['inv_id']; ?></td>
									<td class="center"><?php echo $inv['cust_name']; ?>/<?php echo $inv['cust_contact'] ?></td>
									<td><?php echo $inv['total']; ?></td>
									<td><?php echo round($inv['advancepayment']); ?></td>
									<td><?php echo $balance_payment=round($inv['balancepayment']); ?></td>
									<td class="center">
										<a class="btn btn-success" title="View Item" href="invoice-add-stepthree?inv=<?php echo $inv['inv_id']; ?>">
											<i class="icon-zoom-in icon-white"></i>  
											                                           
										</a>

										<a class="btn btn-danger" title="Delete instant invoice" href="<?php echo 'confirm-delete?del=iWg74jGesX&id='.$inv['inv_id'].'&name='.urlencode($inv['cust_name']); ?>">
											<i class="icon-trash icon-white"></i>  
											                                           
										</a>

										<?php if ($balance_payment>0) {
                                        ?>
										<a class="btn btn-warning" title="Make balance payment" href="<?php echo "instant-receipt?inv=".$inv['inv_id'].""; ?>">
											<i class="icon-share icon-white"></i>  
											                                           
										</a>
										<?php
                                    } ?>

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
