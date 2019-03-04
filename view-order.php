<?php include('header.php');
if (!isset($_GET['order'])) {
    header('location:order-view.php');
}
$usr=$_SESSION['uname'];
$get_u_details=mysql_fetch_array(mysql_query("select * from tblglobal where user='$usr'"));

  mysql_real_escape_string($order=$_GET['order']);
                $o_query="select  * from tblorder where ord_code='$order'";
                $get_o_date=mysql_fetch_array(mysql_query($o_query));
                $o_date=$get_o_date['ord_date'];
                $o_delivery_date=$get_o_date['ord_delivery'];
                $custname=$get_o_date['cust_name'];
                $custmobile=$get_o_date['cus_mobile'];
                $inv_dq="select tblorder_content.itm_code,tblorder_content.p_quantity,tblorder_content.p_rate,tblorder.ord_code,tblorder.o_grand from tblorder_content inner join tblorder where tblorder_content.ord_code='$order' and tblorder.ord_code='$order' ";
                $run_inv_dq=mysql_query($inv_dq);
                $sam=mysql_num_rows($run_inv_dq);

?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Orders </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">View Order  </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#"><?php echo $order;?>  </a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Print Order</h2>
						
					</div>
					<div class="form-actions">
							 <button class="btn btn-primary" onclick="printInvoice();" > Print Order </button>
							 <button class="btn btn-primary" onclick="window.location.href = 'order-view.php';" > Back </button>
							 
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
							
							<div name="logo" style="width:100px; height:96px;float:left;padding:15px;"> <img src="img/logo.png" /> </div> <!--logo-->
							
							<div name="invoice" style="width:300px; height:125px; float:left;"> <h1 style="margin:15px auto auto 90px; font-family:calibri,arial,sans-serif "> ORDER - <?php echo $order; ?> </h1> 
							<p class="address"> Lucky Lilac, Post Box : 7080, Doha - State of Qatar <br />
							Tel : +974 44438717, Mob : +974 55862961 <br />
							Fax : +974 44355454 <br />
							 info@luckylilac.com  | www.luckylilac.com </p>
							</div> <!--invoice-->
							
							<div name="bullets" style="width:150px; height:125px; float:left; padding-left:25px;text-align:right;padding-right:0;">
							<p><br />
						     Supply & Stitching <br />
							 School Uniforms <br />
							 Hospital Uniforms <br />
							 Sports Wear <br />
							 Men/Women Wear <br />
							</p>
							</div> <!--bullets-->
							
							<div class="clear-float" style="margin:0px!important; padding:0px!important;"> </div>
							
							<table class="invoice-details"> 
							<tr> 
							<td class="invoice-details-labels"> Order No </td>
							<td> <?php echo $order; ?></td>
							<td class="invoice-details-labels"> Order Date </td>
							<td>  <?php echo $o_date; ?>  </td>
							</tr>
							
							<tr> 
							<td  class="invoice-details-labels"> Name </td>
							<td> <?php echo $custname."/".$custmobile;  ?> </td>
							<td  class="invoice-details-labels"> Delivery Date </td>
							<td> <?php echo $o_delivery_date  ?> </td>
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
                    $sr=1;
                    while ($got_inv=mysql_fetch_array($run_inv_dq)) {
                        ?>							
								<tr>
									<td class="align-center"><?php echo $sr; ?></td>
								 
							 
									<td class="align-left"><?php
                            $ic=$got_inv['itm_code'];
                        $pq="select itemname,itemsellingprice from tblstock where itemcode='$ic'";
                        $ico=mysql_fetch_array(mysql_query($pq));
                        echo $ico['itemname']; ?></td>
							 
							 
									<td class="align-center"><?php echo $got_inv['p_quantity']; ?></td>
									<td class="align-right"><?php echo number_format((float)$ico['itemsellingprice'], 2, '.', ''); ?></td>
									<td class="align-right"><?php echo $amount=number_format((float)($got_inv['p_rate']), 2, '.', ''); ?></td>
								</tr>
							<?php
                            $sr++;
                    } ?>
														
							
<?php $remaining = 5-$sr;
    for ($i=0; $i<=$remaining; $i++) {
        ?>	
 	<tr>
									<td class="align-center"> <?php echo "<span style='color:#fff'> - </style>"; ?> </td>
									<td>  </td>
									<td class="center"> </td>
									<td> </td>
									<td> </td>
								</tr>						 
	
<?php
    }?>						
							<tr>
							<td class="align-left" valign=top colspan=3 rowspan=5> NOTES: <br /> Lilac Fashion is not responsible for items after 3 months. </td>
							<td class="align-right invoice-details-labels"> TOTAL </td>
							<td class="align-right"> <?php echo number_format((float)$get_o_date['o_total'], 2, '.', '') ?></td>
							</tr>
							
							<tr>
							<td class="align-right invoice-details-labels"> DISCOUNT (<?php echo $get_o_date['o_discount']; ?> %) </td>
							<td class="align-right"> <?php  echo number_format((float)(($get_o_date['o_total'] * $get_o_date['o_discount'])/100), 2, '.', '');  ?> </td>
							</tr>
							
							<tr>
							<td class="align-right invoice-details-labels"> NET TOTAL </td>
							<td class="align-right"> <strong> <div id="amountinNumbers"> <?php echo number_format((float)$get_o_date['o_grand'], 2, '.', '') ?> </div> </strong></td>					
							</tr>
												
							
												
						
							</table>
				
							<div class="headers"> 
							<span class="blabel invoice-details-labels"> Amount in Words | </span> &nbsp; &nbsp;
							<span id="amountInWords">  </span> 
							</div> <!--headers-->
							
							<div class="for-footer"> 
													
							</div> <!--for-footer-->
							
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
    var str = '<?php echo $get_u_details['global_currency']; ?> ';
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
	var WinPrint=window.open('','','letf=0,top=0,width=625,height=865,tollbar=0,scrollbars=0,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
	
}
</script>
			
    
<?php include('footer.php'); ?>

