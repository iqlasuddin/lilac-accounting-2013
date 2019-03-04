 <?php include('header.php');
    
    //to delete item from stock
    if (isset($_GET['del']) && isset($_GET['id'])) {
        $id=$_GET['id'];
        $p_key=urldecode($_GET['name']);
        switch ($_GET['del']) {
            case '0XWs9wmet6':
                $entity= "Customer";
                $tbl='tblcustomer';
                break;
            case 'stxuS58e':
                $entity= "Stock";
                $tbl='tblstock';
                break;
            case 'iWg74jGesX':
                $entity="Instant Invoices";
                $tbl="tblinvoice_direct";
                break;
            default:
                break;
        }
    }
 //customer : 0XWs9wmet6
 //stock : stxuS58e
 //instantinvoice: iWg74jGesX
 ?>

<div>
			</div>
			<div class="row-fluid">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-th"></i> Delete Item</h2>
					</div>
					<div class="box-content">
					     <h3> Are you sure you want to delete <?php echo '"'.$p_key.'"'; ?> from the <?php echo $entity; ?> ?</h3>      
					</div>
				</div><!--/span-->
				<a href="<?php
                switch ($_GET['del']) {
                    case '0XWs9wmet6':
                        echo 'customer-view';
                        $type="cust_";
                        break;
                    case 'stxuS58e':
                        echo 'stock-view';
                        $type="item";
                        break;
                    case 'iWg74jGesX':
                        echo 'invoice-instant-view';
                        $type="";
                        break;
                    default:
                        echo 'index';
                        break;
                }?>" class="btn btn-large btn-primary"> <i class="icon-chevron-left icon-white"></i> Cancel</a>
						  <a href="delete-item?tab=<?php echo $tbl; ?>&id=<?php echo $id; ?>&type=<?php echo $type;?>" class="btn btn-large btn-primary"><i class="icon-trash icon-white"></i> Delete</a> 
			
			</div><!--/row--><!--/row-->
            <!--/row-->
            <?php include('footer.php'); ?>

 
 