<?php include 'header.php';
$cust_query='select * from tblcustomer where cust_status=1 order by cust_addate DESC';
if ($got_cust=mysql_query($cust_query)) {
    $total_customers = mysql_num_rows(mysql_query($cust_query));
} else {
    $total_customers='0';
}

$stock_query='select * from tblstock where itemstatus=1 order by itemdate DESC';
if ($got_stock=mysql_query($stock_query)) {
    $total_stock = mysql_num_rows(mysql_query($stock_query));
} else {
    $total_stock='0';
}

$inv_query='select * from tblinvoice order by i_date DESC';
if ($got_inv=mysql_query($inv_query)) {
    $total_invoice = mysql_num_rows(mysql_query($inv_query));
} else {
    $total_invoice='0';
}

$ord_query='select * from tblorder where status=1 order by ord_date DESC';
if ($got_ord=mysql_query($ord_query)) {
    $total_order = mysql_num_rows(mysql_query($ord_query));
} else {
    $total_order='0';
}

?>


			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
			</div>
			
			<?php $daysleft=check_license();
                    if ($daysleft < 45) {
                        if ($daysleft < 45 && $daysleft > 30) {
                            $color='#a500bd';
                        }
                        if ($daysleft < 30 && $daysleft > 15) {
                            $color='#d4c800';
                        }
                        if ($daysleft < 15 && $daysleft >= 1) {
                            $color='#f00000';
                        }
                        if ($daysleft <= 0) {
                            header('location:license-expired');
                        } ?>
				 <marquee behavior="alternate"> <p style="color:<?php echo $color; ?>; font-size:14px;"> <b> IMPORTANT : Only <?php echo check_license(); ?> </b> days left for license renewal. Renew before expiry to avoid disruption of services. </p> </marquee>
			<?php
                    } ?>
			
				
			<div class="sortable row-fluid">
				<a data-rel="tooltip" class="well span3 top-block" href="customer-view">
					<span class="icon32 icon-red icon-user"></span>
					<div>Total Customers  </div>
					<div><?php echo $total_customers; ?></div>
				</a>

				<a data-rel="tooltip" class="well span3 top-block" href="stock-view">
					<span class="icon32 icon-color icon-star-on"></span>
					<div>Total Stock </div>
					<div><?php echo $total_stock; ?></div>
				</a>

				<a data-rel="tooltip" class="well span3 top-block" href="invoice-view">
					<span class="icon32 icon-color icon-cart"></span>
					<div>Sales Invoices </div>
					<div><?php echo $total_invoice; ?></div>
				</a>
				
				<a data-rel="tooltip"  class="well span3 top-block" href="order-view">
					<span class="icon32 icon-color icon-flag"></span>
					<div>Total Orders</div>
					<div><?php echo $total_order; ?></div>
				</a>
				
				
			</div>
			
		
	        <div class="row-fluid sortable">
              <div class="box span4">
                <div class="box-header well" data-original-title="data-original-title">
                  <h2><i class="icon-th"></i> Recently added Stock </h2>
                  
                </div>
                <div class="box-content">
                  <ul class="dashboard-list">
                 <?php
                    $count=1;

                        while ($i=mysql_fetch_object($got_stock)):
                        if ($count <= 5) {
                            $count++; ?>
                    <li> <a href="stock-view-single?icode=<?php echo $i->itemcode?>">  <?php echo $i->itemname . ' - ' . $i->itemquantity . ' ' . $i->itemuom; ?> </a></li>
                   <?php
                        } endwhile; ?>
                  </ul>
                </div>
              </div>
	          <!--/span-->
              <div class="box span4">
                <div class="box-header well" data-original-title="data-original-title">
                  <h2><i class="icon-user"></i> Recently added Customers </h2>
                 
                </div>
                <div class="box-content">
                  <ul class="dashboard-list">
                 <?php
                    $count=1;

                        while ($i=mysql_fetch_object($got_cust)):
                        if ($count <= 5) {
                            $count++; ?>
                    <li> <a href="customer-view-single?ccode=<?php echo $i->cust_code?>">  <?php echo $i->cust_name . ' - ' . $i->cust_mobile; ?> </a></li>
                   <?php
                        } endwhile; ?>
                  </ul>
                </div>
              </div>
	          <!--/span-->
              <div class="box span4">
                <div class="box-header well" data-original-title="data-original-title">
                  <h2><i class="icon-shopping-cart"></i> Recently added Orders </h2>
                  
                </div>
                <div class="box-content">
                  <ul class="dashboard-list">
                 <?php
                    $count=1;

                        while ($i=mysql_fetch_object($got_ord)):
                        if ($count <= 5) {
                            $count++; ?>
                    <li> <a href="view-order?order=<?php echo $i->ord_code?>">  <?php echo $i->cust_name . ' - QAR ' . $i->o_grand; ?> </a></li>
                   <?php
                        } endwhile; ?>
                  </ul>
                </div>
              </div>
	          <!--/span-->
            </div>
			
			
				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-info-sign"></i> IQSuite Lucky Lilac Accounting Business Application</h2>
					<div class="box-icon">
							
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						
				<h3> Support </h3>
				<p> The current application is deployed on local server on request of the client. If you found any bugs/errors please drop a mail to support@iqlas.com</p>
				<h3> License Information </h3>
				<p> This Product is licensed to Lucky Lilac, Doha, Qatar. The license for the application is for the initial period of one calender year till <b> <?php echo $_SESSION['expiry_date']->format('Y-m-d'); ?> </b>. </p>
				
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

				  

		  
       
<?php include 'footer.php'; ?>
