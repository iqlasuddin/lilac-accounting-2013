 <?php include('header.php');
if (!isset($_GET['r'])) {
    header('location:receipt-view');
}
$id=$_GET['r'];
$q="SELECT r.instrec_no, r.instrec_inv_no, r.instrec_date, r.instrec_amt, i.cust_name, i.cust_contact, i.grand_total, i.advancepayment, i.balancepayment
FROM tbl_instrec r, tblinvoice_direct i
WHERE r.instrec_inv_no = i.inv_id
AND instrec_no =$id";
$receipt=mysql_fetch_object(mysql_query($q));
?>
					<div class="form-actions">
							 <button class="btn btn-primary" onclick="printInvoice();" > Print Instant Receipt </button>
							 <button class="btn btn-primary" onclick="window.location.href = 'receipt-view';" > Back </button>
							 
					</div>
								
					<div class="box-content">
						<div id="mainInvoiceContent">
						
<style>
body,p{font-family:calibri,arial,sans-serif;}
table{border-bottom: 1px Solid Black;border-right: 1px Solid Black;border-collapse : collapse;}
table td, table th{border-left: 1px Solid Black;border-top: 1px Solid Black;border-bottom:none;border-right:none;}
div{border:0px solid #000;padding:5px;overflow:hidden;}
h1{font-size:26px;font-family:'arial black';}
.clear-float{clear:both;}
.container{height: 865px; width: 625px;}
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
						<div class="container" style="border:0px solid #000;"> 
							
							<div name="logo" style="width:100px; height:125px;float:left;padding:5px;"> <img src="img/logo.png" /> </div> <!--logo-->
							
							<div name="invoice" style="width:300px; height:125px; float:left;"> <h1 style="margin:15px auto auto 92px; font-family:calibri,arial,sans-serif "> INSTANT RECEIPT</h1> 
							<p class="address"> Lucky Lilac, Post Box : 7080, Doha - State of Qatar <br />
							Tel : +974 44438717, Mob : +974 77274445<br />
							Fax : +974 44355454 <br />
							 info@luckylilac.com  | www.luckylilac.com </p>
							</div> <!--invoice-->
							
							<div name="bullets" style="width:150px; height:125px; float:left; padding-left:25px;text-align:right;padding-right:0; font-size:12px;">
							<p><br />
							 Logo Embroidery <br />
						     Supply & Stitching <br />
							 School Uniforms <br />
							 Hospital Uniforms <br />
							 Sports Wear <br />
							 Men/Women Wear <br />
							</p>
							</div> <!--bullets-->
							
							<div class="horizontal-line clear-float"> </div>
							
							<table class="invoice-details"> 
							<tr> 
							<td class="invoice-details-labels"> Receipt No </td>
							<td><?php echo $receipt->instrec_no;?> </td>
							<td class="invoice-details-labels"> Date </td>
							<td><?php echo $receipt->instrec_date;?></td>
							</tr>
				
							</table>
							
							<table width=625 >
							
							<tr > 
							<td > Name </td>
							<td colspan=3><b> <?php echo $receipt->cust_name."/".$receipt->cust_contact;?> </b> </td> 
							</tr>
							
							
							<tr >
							<td> Invoice Number </td> 
							<td ><?php echo $receipt->instrec_inv_no;?>  </td>
							<td> Invoice Amount </td> 
							<td align="right"> <?php echo 'QAR '.$receipt->grand_total;?>  </td>
							</tr>
							
							<tr><td colspan=2 rowspan=3 valign=top> Notes <br /> Lucky Lilac is not responsible <br /> for items after 3 months. </td> 
							<td> Other Payments  </td>
							<?php
                            $total_invoice_amount=$receipt->grand_total;
                            $invoice_pending=$receipt->balancepayment;
                            $current_receipt_amount=$receipt->instrec_amt;
                            $previous_payments=$total_invoice_amount-$invoice_pending-$current_receipt_amount;
                            ?>
							<td align="right"><?php echo 'QAR '. $previous_payments; ?>  </td>
							</tr>
							
							<tr>
							
							<td> Current Payment </td> 
							<td align="right"><b><?php echo 'QAR '.$receipt->instrec_amt;?> </b> </td>
							</tr>
							
							<tr>
							
							<td> Balance </td>
							<td align="right"> <?php echo 'QAR '.$receipt->balancepayment;?></td>
							</tr>
							</table>
							<br />
							<div class="headers"> 
							<span class="blabel invoice-details-labels"> Amount in Words | </span> &nbsp; &nbsp;
							<span id="amountInWords"><?php echo 'QAR '. convert_number_to_words($receipt->instrec_amt) . ' only';;?></span> 
							</div> <!--headers-->
							
							<div class="for-footer"> 
							<p style="float:left" > Accountant Sign </p>
							<p style="float:right"> (Office Copy) </p>
							
							</div> <!--for-footer-->
							<br /> <br />
							<div class="horizontal-line clear-float"> </div>
							<!--====================================================================================-->
							<div name="logo" style="width:100px; height:125px;float:left;padding:5px;"> <img src="img/logo.png" /> </div> <!--logo-->
							
							<div name="invoice" style="width:300px; height:125px; float:left;"> <h1 style="margin:15px auto auto 92px; font-family:calibri,arial,sans-serif "> INSTANT RECEIPT</h1> 
							<p class="address"> Lucky Lilac, Post Box : 7080, Doha - State of Qatar <br />
							Tel : +974 44438717, Mob : +974 77274445<br />
							Fax : +974 44355454 <br />
							 info@luckylilac.com  | www.luckylilac.com </p>
							</div> <!--invoice-->
							
							<div name="bullets" style="width:150px; height:125px; float:left; padding-left:25px;text-align:right;padding-right:0; font-size:12px;">
							<p><br />
							 Logo Embroidery <br />
						     Supply & Stitching <br />
							 School Uniforms <br />
							 Hospital Uniforms <br />
							 Sports Wear <br />
							 Men/Women Wear <br />
							</p>
							</div> <!--bullets-->
							
							<div class="horizontal-line clear-float"> </div>
							
							<table class="invoice-details"> 
							<tr> 
							<td class="invoice-details-labels"> Receipt No </td>
							<td><?php echo $receipt->instrec_no;?> </td>
							<td class="invoice-details-labels"> Date </td>
							<td><?php echo $receipt->instrec_date;?></td>
							</tr>
				
							</table>
							
							<table width=625 >
							
							<tr > 
							<td > Name </td>
							<td colspan=3><b> <?php echo $receipt->cust_name."/".$receipt->cust_contact;?> </b> </td> 
							</tr>
							
							
							<tr >
							<td> Invoice Number </td> 
							<td ><?php echo $receipt->instrec_inv_no;?>  </td>
							<td> Invoice Amount </td> 
							<td align="right"> <?php echo 'QAR '.$receipt->grand_total;?>  </td>
							</tr>
							
							<tr><td colspan=2 rowspan=3 valign=top> Notes <br /> Oryx Doha is not responsible <br /> for items after 3 months. </td> 
							<td> Other Payments  </td>
							<?php
                            $total_invoice_amount=$receipt->grand_total;
                            $invoice_pending=$receipt->balancepayment;
                            $current_receipt_amount=$receipt->instrec_amt;
                            $previous_payments=$total_invoice_amount-$invoice_pending-$current_receipt_amount;
                            ?>
							<td align="right"><?php echo 'QAR '. $previous_payments; ?>  </td>
							</tr>
							
							<tr>
							
							<td> Current Payment </td> 
							<td align="right"><b><?php echo 'QAR '.$receipt->instrec_amt;?> </b> </td>
							</tr>
							
							<tr>
							
							<td> Balance </td>
							<td align="right"> <?php echo 'QAR '.$receipt->balancepayment;?></td>
							</tr>
							</table>
							<br />
							<div class="headers"> 
							<span class="blabel invoice-details-labels"> Amount in Words | </span> &nbsp; &nbsp;
							<span id="amountInWords"><?php echo 'QAR '. convert_number_to_words($receipt->instrec_amt) . ' only';;?></span> 
							</div> <!--headers-->
							
							<div class="for-footer"> 
							<p style="float:left" > Accountant Sign </p>
							<p style="float:right"> (Office Copy) </p>
							
							</div> <!--for-footer-->
							<br /> <br />
							<div class="clear-float"> </div>
							
							<!--------------------------------------------------------------------->
							</div>
					</div>
				</div><!--/span-->

										
<script type="text/javascript">
function printInvoice()
{
	var prtContent=document.getElementById('mainInvoiceContent');
	var WinPrint=window.open('','','letf=0,top=0,width=625,height=865,tollbar=0,scrollbars=0,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
	
}
</script>
<?php include('footer.php'); ?>