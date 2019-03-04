<?php include('header.php'); ?>
<?php
$r=mysql_query("SELECT r.*, CONCAT_WS('/',o.cust_name,o.cus_mobile) as customer FROM tblrcpt r, tblorder o WHERE r.inv_code=o.inv_code");
?>

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
						<h2><i class="icon-th"></i> View Receipts</h2>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th title="Item Name with Code">Receipt No [Invoice No]</th>
								  <th title="Category and Code">Customer</th>
								  <th title="Quantity available in stock">Date</th>
								  <th title="Cost Price/ Selling Price">Receipt Amount</th>
								  <th title="Stock Actions">Actions</th>
								</tr>
						  </thead>   
						  <tbody>
						  	<?php while ($rc=mysql_fetch_object($r)):?>
						  		<tr>
						  			<td><?php echo $rc->rcpt_code;?> [<?php echo $rc->inv_code;?>]</td>
									<td class="center"><?php echo $rc->customer;  ?></td>
									<td class="center"><?php echo $rc->date;?></td>
									<td class="center"><?php echo $rc->amount;?></td>
									<td class="center">
									<a class="btn btn-success" title="View Item" href="receipt?r=<?php echo $rc->id;?>">
										<i class="icon-zoom-in icon-white"></i>  
										                                           
									</a>
								</td>
						  		</tr>
						  	<?php endwhile;?>
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row--><!--/row-->
            <!--/row-->
            <?php include('footer.php'); ?>
<?php
/*
if($data['result']){
     $config = array(
     'protocol' => 'smtp',
     'smtp_host' => 'smtpcorp.com',//smtp.googlemail.com',
     'smtp_port' => 2525,
     'smtp_user' =>'vasanth',
     'smtp_pass' => 'vasanth047',
     'mailtype' => 'html'
     );
     $studentname=$data['result']['first_name'];
     $studentemail=$data['result']['email'];
     $this->load->library('Email', $config);
     $this->email->from('edubreath2014@gmail.com');
     $this->email->to($studentemail);
     $this->email->subject('Hello Regarding Your Admission Number From Edubreath');
     $this->email->message('Hi'." ".$studentname." ".'We Have Sent Admission Number Of You And Your Parents.<br>By Using This As Username Please Sign Up With Edubreath.com.<br> Your Username:'.$admission_no.'<br>Your Parents:'.'p'.$admission_no.'<br> Thank You...');
     $this->email->send();
     redirect('adminstudents/savedparent');
}

*/

 ?>