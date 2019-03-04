<?php include('header.php'); ?>
<?php
if (isset($_POST['btnSubmitrpt'])) {
    $startdate=$_POST['rpt-startdate'];
    $enddate=$_POST['rpt-enddate'];
    $slno=1;
    $getrows=mysql_query("select concat(inv_id,'[',inv_date,']') as inv_details,concat(cust_name,'[',cust_contact,']') as customer,grand_total, advancepayment, balancepayment, status from tblinvoice_direct where inv_date>='$startdate' and inv_date<='$enddate' order by inv_id asc");
    $getsums=mysql_query("select sum(grand_total) as 'total', sum(advancepayment) as 'advance', sum(grand_total)-sum(advancepayment) as 'balance' from tblinvoice_direct where inv_date>='$startdate' and inv_date<='$enddate' and status=1;"); ?>	

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="sales-report">Reports </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Sales Report </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Sales Report from <?php echo $startdate; ?> to <?php echo $enddate; ?></h2>
						
					</div>
					<div class="form-actions">
							 <button class="btn btn-primary" onclick="printInvoice();" > Print </button>
					</div>
					<div class="box-content">
						<div id="mainInvoiceContent">
						
<style>
body,p{font-family:calibri,arial,sans-serif;}
table{border-bottom: 1px Solid Black;border-right: 1px Solid Black;border-collapse : collapse;}
table td, table th{border-left: 1px Solid Black;border-top: 1px Solid Black;border-bottom:none;border-right:none;}
div{border:0px solid #000;padding:5px;overflow:hidden;}
h1{font-size:14px;font-family:'arial black';}
.clear-float{clear:both;}
.container{height: 435px; width: 625px;}
.address{font-size:12px;text-align:center;}
.horizontal-line{border-top:3px dotted #000;}
.headers{margin:-2px 0 1px 0;border:1px solid #000;}
.headers span{width:215px;}
.particulars-table{width:625px;border:1px solid #666;margin:5px 0 5px 0;}
.particulars-table .heading{background-color:#CFCFCF;}
.invoice-details{width:625px;border:1px solid #666;margin:5px 0 5px 0;}
.invoice-details-labels{background-color:#cfcfcf;width:75px;}
.align-left{text-align:left;}
.align-right{text-align:right;}
.align-center{text-align:center;}
.slno{width:35px;}
.particulars{width:200px;}
.quantity{width:45px;}
.rate{width:75px;}
.amount{width:105px;}
.footer-notice{font-size:11px; margin-top:-10px; text-align:center;}

</style>
					<h2>Lucky Lilac - Sales Report from <?php echo $startdate; ?> to <?php echo $enddate; ?></h2>
					 	<table class="table table-bordered">
				  <thead>
					  <tr>
						  <th>SLNO</th>
						  <th>Invoice No[Date]</th>
						  <th>Customer/Mobile</th>
						  <th>Invoice Amount[QAR]</th>
						  <th>Paid Amount[QAR]</th>  
						  <th>Balance Amount[QAR]</th>  

						  
					  </tr>
				  </thead>   
				  <tbody>
<?php  while ($got_rows=mysql_fetch_object($getrows)) {
        $strikethru="";
        if ($got_rows->status==0) {
            $strikethru="style='text-decoration:line-through';";
        } ?>
				  <tr <?php echo $strikethru; ?>>
						<td><?php echo $slno; ?></td>
						<td class="center"><?php echo $got_rows->inv_details; ?></td>
						<td class="center"><?php echo $got_rows->customer; ?></td>
						<td style="text-align:right" ><?php echo $got_rows->grand_total; ?></td>
						<td style="text-align:right"><?php echo $got_rows->advancepayment; ?></td>
						<td style="text-align:right"><?php echo $got_rows->balancepayment; ?></td>						
					</tr>
<?php $slno++;
    }
    if ($got_sums=mysql_fetch_object($getsums)) {
        ?>		

				<tr>
				<th colspan=3 style="text-align:right"> Totals </th>
				<th style="text-align:right"><?php echo round($got_sums->total, 2); ?> </th>
				<th style="text-align:right"><?php echo round($got_sums->advance, 2); ?> </th>
				<th style="text-align:right"><?php echo round($got_sums->balance, 2); ?> </th>

				</tr>
<?php
    } ?>
								   
				  </tbody>
			 </table>  
<?php
} ?>

					</div>
				</div><!--/span-->
				
				</div> <!-- invoice content -->
				



			</div><!--/row-->

    <script type="text/javascript" charset="utf-8">
        d="<?php echo date("d");?>";
        m="<?php echo date("m");?>";
        Y="<?php echo date("Y");?>";
		
		function printInvoice()
{
	var prtContent=document.getElementById('mainInvoiceContent');
	var WinPrint=window.open('','','letf=0,top=0,width=625,height=435,tollbar=0,scrollbars=0,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
	
}
				
    </script>
<?php include('footer.php'); ?>
