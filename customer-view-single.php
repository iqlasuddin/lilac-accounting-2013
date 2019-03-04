<?php include 'header.php';
//$usr=$_SESSION['uname'];
//$get_u_details=mysql_fetch_array(mysql_query("select * from tblglobal where user='$usr'"));
?>
<!-- <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script> -->

<?php
if (!isset($_GET['ccode'])) {
    header("location:customer-view.php");
} else {
      $ccode=$_GET['ccode'];
      if ($ccode=='') {
          header("location:customer-view.php");
      }
      $query="select * from tblcustomer where cust_code='".$ccode."'";
      $result=mysql_query($query);
      $customer=mysql_fetch_array($result);

 
      /* echo "<script> alert(". $icode."); </script>";*/ ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Customer </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Customer View </a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#"> <?php echo $ccode." - ".$customer['cust_name']; ?> </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">	
				<div class="box span6">
					<div class="box-header well" data-original-title>
						<h2><?php echo $ccode." - ".$customer['cust_name']." - ".$customer['cust_mobile']; ?></h2>
						
					</div>
					<div class="box-content">
						<table class="table table-bordered">
							  <thead>
								  <tr>
									  <th>Customer Name</th>
									  <th><?php echo $customer['cust_name']; ?></th>
									                                          
								  </tr>
							  </thead>   
							  <tbody>
								<tr>
									<td>Contact</td>
									<td class="center"><?php echo $customer['cust_mobile']; ?></td>
									                                    
								</tr>
								
								<tr>
									<td>Address</td>
									<td class="center"><?php echo $customer['cust_address']; ?></td>
									                                    
								</tr>
								
								<tr>
									<td>Email</td>
									<td class="center"><?php echo $customer['cust_email']; ?></td>
									                                    
								</tr> 
								
								<tr>
									<td>Customer Type</td>
									<td class="center"><?php echo $customer['cust_type']; ?></td>
									                                    
								</tr>
								
								<tr>
									<td>Company Name</td>
									<td class="center"><?php echo $customer['cust_cname']; ?></td>
									                                    
								</tr>
																						                   
							  </tbody>
						 </table> 
						 <a href="customer-view.php" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Back to Customers</a>
						 <a href="customer-update.php?ccode=<?php echo $ccode; ?>" class="btn btn-large btn-primary"><i class="icon-edit icon-white"></i> Edit</a>  
						
					</div>
				</div><!--/span-->
    
<?php
  } //outer else

include('footer.php'); ?>
