<?php
    session_start();
    $invoice_no=$_SESSION['invoice_no']=$_GET['inv'];
    header("location:invoice-add-steptwo?id=$invoice_no");
