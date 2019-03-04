<?php include('header.php');
$backup_file="";
if (isset($_GET['id'])) {
    $backup_file=urldecode($_GET['id']);
}
?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>					</li>
					<li>
					<a href="#">Admin Tasks</a></li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Admin Tasks </h2>
						
					</div>
					<div class="box-content">
					<form class="form-horizontal" method="post" action="backup-master">
						  <fieldset>
							<legend> Complete Database Backup</legend>
								<p> Click here to take complete database backup. </p>
							<button type="submit" class="btn btn-primary">Proceed to Backup</button>
							</div>
							
							<?php
                                if ($backup_file=="") {
                                    echo '<p> Please click on proceed to backup </p>';
                                } else {
                                    echo '<p> Click here to download the backed up file <a href="'.$backup_file.'"> Download file </a> </p>';
                                }
                            ?>
						  </fieldset>
					</form>   
						
				</div><!--/span-->

			</div><!--/row-->
    
<?php include('footer.php'); ?>
