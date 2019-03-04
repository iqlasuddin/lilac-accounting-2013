<?php include('header.php'); ?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Reports </a><span class="divider">/</span>
					</li>
					<li>
						<a href="#">Sales Report - Selection</a>
					</li>
				</ul>
			</div>

				<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Sales Report</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
						
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="frmReport" id="frmReport" method="post" action="sales-report-view">
						  <fieldset>
							<legend>Report Selection</legend>

							<div class="control-group">
							  <label class="control-label" for="rpt-startdate">Start Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="rpt-startdate" name="rpt-startdate" required>
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="rpt-enddate">End Date</label>
							  <div class="controls">
								<input type="text" class="input-xlarge datepicker" id="rpt-enddate" name="rpt-enddate" required >
							  </div>
							</div>
							
							<div id="rpt-errmsg" style="position:relative; color:red"> </div>
							
							 												
							<div class="form-actions">
							 <button type="submit" name="btnSubmitrpt" class="btn btn-primary">Generate Sales Report</button>
							  <button type="reset" class="btn">Cancel</button>
							 
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->
				
	
			</div><!--/row-->

    <script type="text/javascript" charset="utf-8">
        d="<?php echo date("d");?>";
        m="<?php echo date("m");?>";
        Y="<?php echo date("Y");?>";
				
    </script>
<?php include('footer.php'); ?>
