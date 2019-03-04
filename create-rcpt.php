<?php
include 'elements/connect.php';
if (isset($_POST['rcpt_code'])) {
    $post  =$_POST;
    $date  =$post['date'];
    $rcpt  =$post['rcpt_code'];
    $inv   =$post['inv'];
    $amount=$post['amount'];
    $rcvd  =$post['rcvd'];
    $bal   =$post['bal'];
    $method=$post['method'];
    if ($method == 'cheque') {
        $ch_num ="'" . $post['ch_num'] . "'";
        $ch_date="'" . $post['ch_date'] . "'";
        $ch_bank="'" . $post['ch_bank'] . "'";
    } else {
        $ch_num ='NULL';
        $ch_date='NULL';
        $ch_bank='NULL';
    }
}
$query1="INSERT INTO `tblrcpt`(`id`, `rcpt_code`, `inv_code`, `date`, `amount`, `method`, `ch_num`, `ch_date`, `ch_bank`)
VALUES (NULL,'$rcpt','$inv','$date','$rcvd','$method',$ch_num,$ch_date,$ch_bank)";
$query2="UPDATE tblinvoice SET inv_pending=inv_pending-$rcvd WHERE i_id='$inv'";
if (mysql_query($query1)) {
    if (mysql_query($query2)) {
        echo 1;
    } else {
        echo 'Query2 failed';
    }
} else {
    echo 'Query1 Failed';
}
