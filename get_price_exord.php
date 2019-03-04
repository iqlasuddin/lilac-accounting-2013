<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'elements/connect.php';
 mysql_real_escape_string($uname=$_SESSION['uname']);
mysql_real_escape_string($itemcode=$_POST['itemcode']);
mysql_real_escape_string($itm_quantity=$_POST['itm_quantity']);
mysql_real_escape_string($ord_code=$_POST['ord_code']);
$exploded=explode('@', $uname);
$tbl=$exploded[0].$ord_code;
$qry="CREATE TABLE IF NOT EXISTS `tblorder_$tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) NOT NULL,
  `ord_code` varchar(25) NOT NULL,
  `p_id` varchar(50) NOT NULL,
  `p_q` varchar(25) NOT NULL,
  `p_rate` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
mysql_query($qry);
$query="select itemname, itemsellingprice from tblstock where itemcode='$itemcode'";
$get_rate=mysql_fetch_array(mysql_query($query));
mysql_real_escape_string($got_rate=$get_rate['itemsellingprice']);
mysql_real_escape_string($price=$itm_quantity*$got_rate);
$query_temp="INSERT INTO tblorder_$tbl(ord_code,user, p_id, p_q, p_rate) VALUES ('$ord_code','$uname', '$itemcode', '$itm_quantity', '$price')";
// "insert into tblorder_temp(p_id, p_q,p_rate,) values ('$itemcode', '$itm_quantity', '$price')";

$temp_query= mysql_query($query_temp);
if ($temp_query) {
    $sl_no=mysql_insert_id(); ?>
	 <tr id="itmtr<?php echo $itemcode; ?>">
	
	<td><?php echo $get_rate['itemname']; ?></td>
	<td class="center"><?php echo $got_rate; ?></td>
	<td><?php echo $itm_quantity; ?></td>
	<td><?php echo $price; ?></td>
	<td><a class=" btn btn-danger removetr" onclick="dltit('<?php echo $itemcode; ?>')"><i class="icon-trash icon-white"></i></a></td>
	
</tr>
<?php
} else {
        ?>
		 <tr id="itmtr<?php echo $itemcode; ?>">
	
	<td><?php echo $get_rate['itemname']; ?></td>
	<td class="center"><?php echo $got_rate; ?></td>
	<td><?php echo $itm_quantity; ?></td>
	<td><?php echo $price; ?></td>
	<td><a class=" btn removetr" onclick="dltit('<?php echo $itemcode; ?>')"  ><i class="icon-trash icon-white"></i></a></td>
	
</tr>
<?php
    }

 ?>

