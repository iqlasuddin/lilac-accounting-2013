<?php
    ob_start();
        if (!isset($_SESSION)) {
            session_start();
        }
    include 'elements/connect.php';
    
    if (!isset($_GET['icode'])) {
        header("location:stock-view.php");
    } else {
          $icode=$_GET['icode'];
          if (empty($icode)) {
              header("location:stock-view.php");
          } ?>

		


<?php

 
  $query="UPDATE tblstock SET 
		itemstatus=0
		where itemcode='".$icode."';";
        
          $updatestock = mysql_query($query);
          if ($updatestock) {
              echo "The item has been deleted";
          } else {
              echo "Could not delete the item. please try later or contact support@iqsuite.in.";
          }
      }
 ?>