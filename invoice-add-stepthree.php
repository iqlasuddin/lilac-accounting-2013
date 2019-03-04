<?php include('header.php');

    $invoice_date='';
    $cust_name='';
    $cust_contact='';
    $cust_address='';
    $page_items_total=0;
if (isset($_GET['inv'])) {
    $invoice_no = $_GET['inv'];
} else {
    header("location:invoice-instant-view");
}
//echo "SELECT `inv_date`, `cust_name`, `cust_contact` FROM tblinvoice WHERE inv_id='$invoice_no'";
$query=mysql_query("SELECT * FROM tblinvoice_direct WHERE inv_id='$invoice_no'") or die("We encountered some problem in creating this invoice, please try after sometime");
while ($rows=mysql_fetch_array($query)) {
    $invoice_date=$rows['inv_date'];
    $cust_name=$rows['cust_name'];
    $cust_contact=$rows['cust_contact'];
    $discount=$rows['discount'];
    $total=$rows['total'];
    $grand_total=$rows['grand_total'];
    $advancepay=$rows['advancepayment'];
    $balancepay=$rows['balancepayment'];
}


$qry_invoice_items=mysql_query("SELECT * FROM tblinvoiceitems WHERE inv_id='$invoice_no'") or die("We encountered some problem in creating this inoivce, please try after sometime");
$slno=1;
$fet_item_name="";
$fet_item_price="";
$fet_item_quantity="";

?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Invoices </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Add New Invoice </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> New Invoice Entry</h2>
						
					</div>
					<div class="form-actions">
							 <button class="btn btn-primary" onclick="printInvoice();" > Print </button>
							 <a class="btn btn-info" title="Edit the invoice" href="edit-instant-invoice?inv=<?php echo $invoice_no; ?>">
									Edit Invoice	
										                                          
									</a>
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
						<div class="container" style="border:0px solid #000;"> 
							
							<div name="logo" style="width:100px; height:105px;float:left;padding:5px;"> <img src="img/logo.png" /> </div> <!--logo-->
							
							<div name="invoice" style="width:475px; height:105px; float:left;"> <h1 style="margin:15px auto auto 155px; "> INSTANT INVOICE </h1> 
							<p class="address"> Lucky Lilac, Post Box : 7080, Doha - State of Qatar <br />
							Tel : +974 44438717, Mob : +974 77274445 <br />
							Fax : +974 44355454 <br />
							 info@luckylilac.com  | www.luckylilac.com </p>
							</div> <!--invoice-->
							
										
							<div class="clear-float"> </div>
							
							<table class="invoice-details"> 
							<tr> 
							<td class="invoice-details-labels"> Invoice No </td>
							<td> <?php echo $invoice_no ?></td>
							<td class="invoice-details-labels"> Date </td>
							<td>  <?php echo $invoice_date; ?>  </td>
							</tr>
							
							<tr> 
							<td class="invoice-details-labels"> Name </td>
							<td>  <?php echo $cust_name ?>  </td>
							<td class="invoice-details-labels"> Contact No </td>
							<td>  <?php echo $cust_contact ?>  </td>
							</tr>
							
													
							</table>
							
							
							
							<table class="particulars-table">
							
							<tr class="heading">
							<th class="slno align-center" >SLNO</th>
							<th class="particulars align-center">PARTICULARS</th>
							<th class="quantity align-center">QTY</th>
							<th class="rate align-center">RATE</th>
							<th class="amount align-center">AMOUNT</th>
							</tr>
							
							<?php
                            $slno=1;
while ($item_rows=mysql_fetch_array($qry_invoice_items)) {
    $pieces=explode("/", $item_rows['item_name']);
    $fet_item_name=$pieces[0];
    $fet_item_price=$item_rows['item_rate'];
    $fet_item_quantity=$item_rows['item_quantity']; ?>							
								<tr>
									<td class="align-center"><?php echo $slno; ?></td>
									<td class="align-left"><?php echo $fet_item_name; ?></td>
									<td class="align-center"><?php echo $fet_item_quantity; ?></td>
									<td class="align-right"><?php echo number_format((float)$fet_item_price, 2, '.', ''); ?></td>
									<td class="align-right"><?php echo number_format((float)($fet_item_quantity * $fet_item_price), 2, '.', '');
    $page_items_total += $fet_item_quantity * $fet_item_price; ?></td>
								</tr>
							<?php
                            $slno++;
} ?>
														
							
<?php $remaining = 5-$slno;
    for ($i=0; $i<=$remaining; $i++) {
        ?>	
 	<tr>
									<td class="align-center"> <?php echo "-"; ?> </td>
									<td>  </td>
									<td class="center"> </td>
									<td> </td>
									<td> </td>
								</tr>						 
	
<?php
    }?>						
							<tr>
							<td class="align-left" valign=top colspan=3 rowspan=3> NOTES: <br /> Lilac Fashion is not responsible for items after 3 months. </td> 
							<td class="align-right invoice-details-labels"> SUB TOTAL </td>
							<td class="align-right"> <?php echo number_format((float)$total, 2, '.', '') ?> </td>
							</tr>
							
							<tr> 
							<td class="align-right invoice-details-labels"> DISCOUNT </td>
							<td class="align-right"> <?php echo $discount ?> % </td>
							</tr>
							
							<tr> 
							<td class="align-right invoice-details-labels"><strong>  NET TOTAL  </strong></td>
							<td class="align-right"> <strong> <div id="amountinNumbers"> <?php echo number_format((float)(round($grand_total, 0)), 2, '.', ''); ?> </div> </strong></td>
							</tr>
							
							<tr> 
							<td class="align-left" valign=top colspan=3 rowspan=2> Amount in Words<br> <span id="amountInWords">  </span>  </td>
							<td class="align-right invoice-details-labels"> ADVANCE </td>
							<td class="align-right"> <?php echo number_format((float)$advancepay, 2, '.', '') ?> </td>
							</tr>
							
							<tr> 
							<td class="align-right invoice-details-labels"> BALANCE </td>
							<td class="align-right"> <?php echo number_format((float)$balancepay, 2, '.', '') ?> </td>
							</tr>
							
							</table>
						
							</div>
					</div>
				</div><!--/span-->

			</div><!--/row-->
			</div>

										
<script type="text/javascript">
var s=document.getElementById('amountinNumbers').innerHTML;
//alert(s);

var th = ['', ' Thousand', ' Million', ' Billion', ' Trillion', ' Quadrillion', ' Qintillion'];
var dg = ['Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
var tn = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
var tw = ['Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];


//function toWords(s) {
	s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) {}//document.println('not a number');
    var x = s.indexOf('.');
    if (x == -1) x = s.length;
    if (x > 15) {}//return 'too big';
    var n = s.split('');
    var str = 'QAR ';
    var sk = 0;
    for (var i = 0; i < x; i++) {
        if ((x - i) % 3 == 2) {
            if (n[i] == '1') {
                str += tn[Number(n[i + 1])] + ' ';
                i++;
                sk = 1;
            } else if (n[i] != 0) {
                str += tw[n[i] - 2] + ' ';
                sk = 1;
            }
        } else if (n[i] != 0) {
            str += dg[n[i]] + ' ';
            if ((x - i) % 3 == 0) str += 'hundred ';
            sk = 1;
        }
        if ((x - i) % 3 == 1) {
            if (sk) str += th[(x - i - 1) / 3] + ' ';
            sk = 0;
        }
    }
    if (x != s.length) {
        var y = s.length;
        //str += 'point ';
        //for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
    }
    var AmountinWords = str.replace(/\s+/g, ' ')+' Only';
//	alert(AmountinWords);
	document.getElementById("amountInWords").innerHTML= AmountinWords;
//}

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

