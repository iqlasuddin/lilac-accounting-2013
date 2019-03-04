<?php
include('header.php');
?>
<style type="text/css" media="screen">
	#rpttr {
		border-bottom: 1px dashed purple;
	}
	#rpttr2 {
		display: block;
		height: 20px;
		width: 100%;
		border-bottom: 1px dashed purple;
	}
	#rpttr2 td {
		display: block;
	}
	.lb {
		border-left: 1px solid purple;
	}
	#ttltr h3 {
		text-align: center;
	}
</style>
<style type="text/css" media="print">
	#print_inv {
		display: block !important;
	}

</style>

<?php
// ---------------------------------------------
function convert_number_to_words($number)
{
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    $string = $fraction = null;
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    return $string;
}
// -------------------------------------------------
if (isset($_GET['order'])) {
    mysql_real_escape_string($order=$_GET['order']);
    $o_query="select  * from tblorder where ord_code='$order'";
    $get_o_date=mysql_fetch_array(mysql_query($o_query));
    if (empty($get_o_date['inv_code'])) {
        $inv_q="select i_id from tblinvoice";
        $rskt=mysql_query($inv_q);
        $run_inv_q=mysql_num_rows($rskt);
        if ($run_inv_q==0) {
            $inv_code='INV1';
        } else {
            $tem=$run_inv_q+1;
            $inv_code='INV'.$tem;
        }
    } else {
        $inv_code=$get_o_date['inv_code'];
    } ?>

<div>
	<ul class="breadcrumb">
		<li>
			<a href="#">Home</a><span class="divider">/</span>
		</li>
		<li>
			<a href="#">Receipts</a><span class="divider">/</span>
		</li>
		<li>
			<a href="#">View Receipts</a>
		</li>
	</ul>
</div>
<div class="row-fluid">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> Invoice</h2>
		</div>
		<div class="box-content" id="print_inv">
			<?php mysql_real_escape_string($creat_in = $_GET['order']);
    $custname = mysql_fetch_array(mysql_query("select cust_name from tblorder where ord_code='$creat_in'"));
    $inv_dq = "select tblorder_content.itm_code,tblorder_content.p_quantity,tblorder_content.p_rate,tblorder.ord_code,tblorder.o_grand from tblorder_content inner join tblorder where tblorder_content.ord_code='$creat_in' and tblorder.ord_code='$creat_in' ";
    $run_inv_dq = mysql_query($inv_dq);
    $sam = mysql_num_rows($run_inv_dq); ?>
			<div style="width:100%; height:50px; background-color:pink">
				<div style="height: 100px; width:100px; display: block; background: purple; margin-left: 25px; ">
					<h2 style="color: white; text-align: center;line-height: 50px;">Invoice</h2>
					<h2 style="color: white; text-align: center;line-height: 50px;">فاتورة</h2>
				</div>
			</div>
			<div style="height: 30px;"></div>
			<div style="width: 200px; padding-left: 10px; height: 185px; float: left">
				<div style="height: 40px;"></div>
				<p style="font-style: italic; line-height: 23px;">
					<span style="float: left; width: 60px">Tel:</span><span style="width:80px;float:right; text-align: left">+919739639222</span>
					<br />
					<span style="float: left; width: 60px">Fax:</span><span style="width:80px;float:right; text-align: left">+919739639222</span>
					<br />
					<span style="float: left; width: 60px">Mobile:</span><span style="width:80px;float:right; text-align: left">+919739639222</span>
					<br />
					<span style="float: left; width: 60px">P.O. Box:</span><span style="width:80px;float:right; text-align: left">+919739639222</span>
					<br />
					<span style="float: left; width: 60px">Email:</span><span style="width:80px;float:right; text-align: left">info@luckylilac.com</span>
					<br />
					<span style="float: left; width: 60px">Website:</span><span style="width:80px;float:right; text-align: left">www.luckylilac.com</span>
					<br />
				</p>
			</div>
			<div style="width: 200px; float: left; margin-left: 150px;">
				<img src="img/invoice_ll.png" />
			</div>
			<div style="width: 250px; float: right;">
				<img src="img/invoice_llr.png" />
				<div style="height: 40px;"></div>
				<span style="float: left; width:80px">Invoice No:</span><span style="width:50px; text-align: left"><?php echo $inv_code; ?></span><br />
				<span style="float: left; width: 80px">Date:</span><span style="width:50px; text-align: left"><?php echo $inv_date = date('d/m/Y', time()); ?></span>
				<br />
			</div>
			<div style="height: 5px; float: none; clear: both; width: 100%"></div>
			<label style="">Mr/Mrs<span style="text-align: center; width: 95%; float: right;border-bottom: 1px dotted #383838"><?php echo $custname[0]; ?></span></label>
			<div style="border:  2px solid purple; display: block;">
			<table style="border:  1px solid purple; width: 99%; margin: 5px auto;  text-align: center">
				<thead style="border-bottom: 2px solid purple">
					<tr>
						<th style="width: 8%; border:  1px solid purple;">No.</th>
						<th style="width: 38%; border:  1px solid purple;">Description</th>
						<th style="width: 8%; border:  1px solid purple;">Qty.</th>
						<th style="width: 11%; border:  1px solid purple;">
						<div style="border-bottom: 1px solid purple">
							Unit Price
						</div>
						<div style="float: left; width: 50%; border-right: 1px solid purple">
							Qrs
						</div>
						<div style="width: 49%; float: right">
							Dhms
						</div></th>
						<th style="width: 11%; border:  1px solid purple;">
						<div style="border-bottom: 1px solid purple">
							Amount
						</div>
						<div style="float: left; width: 50%; border-right: 1px solid purple">
							Qrs
						</div>
						<div style="width: 49%; float: right">
							Dhms
						</div></th>
					</tr>
				</thead>
				<tbody>
					<?php
                    $sr=1;
    $ttl=0;
    while ($got_inv=mysql_fetch_array($run_inv_dq)) {
        ?>
						<tr id="rpttr">
						<td><?php  echo $sr; ?></td>
						<td class="lb">
							<?php $ic = $got_inv['itm_code'];
        $pq = "select itemname from tblstock where itemcode='$ic'";
        $ico = mysql_fetch_array(mysql_query($pq));
        echo $ico['itemname']; ?>
							</td>
						<td class="lb"><?php echo $got_inv['p_quantity']; ?></td>
						<td class="lb"><?php echo $got_inv['p_rate']; ?></td>
						<td class="lb"><?php echo $era = $got_inv['p_quantity'] * $got_inv['p_rate'];
        $ttl = $ttl + $era; ?></td>
					</tr>
		<?php $sr = $sr + 1;
    } ?>
					<tr id="ttltr">
						<td></td>
						<td></td>
						<td></td>
						<td><h3>Total:</h3></td>
						<td><h3><?php echo $ttl; ?></h3></td>
					</tr>
				</tbody>
			</table>
			<div style="height: 30px;">
			<label style="width: 100%"><span style="padding-left: 5px"> Total:</span><span style="float: right; width: 5.5%; text-align: right;padding-right: 5px;">:مجموع</span><span style="text-align: center; width: 89%;float: right; border-bottom: 1px dotted #383838"><?php echo convert_number_to_words($ttl); ?></span></label>
			</div>
		
			</div>
			<?php
} else {
    }
            ?>
		</div>
	</div>
	<?php
        
    if (empty($get_o_date['inv_code'])) {
        ?>
		<button class="btn" onclick="save_print('<?php echo $inv_code . "','" . $creat_in . "','" . $ttl; ?>')"> Save &amp; Print</button>
		<button class="btn" onclick="save('<?php echo $inv_code . "','" . $creat_in . "','" . $ttl; ?>')"> Save</button>
		<?php
    }
 ?>
		<button class="btn">Print</button>
		<object></object>
</div>
<?php
include('footer.php');
?>
