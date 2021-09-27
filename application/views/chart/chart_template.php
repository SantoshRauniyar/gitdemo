<html><!DOCTYPE html><html><head>    <meta charset="utf-8">    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <title>Chart Demo</title>    <!-- Core CSS - Include with every page -->    <link href="<?php echo base_url('assets/administrator/css/bootstrap.min.css');?>" rel="stylesheet">    <link href="<?php echo base_url('assets/administrator/css/plugins/metisMenu/metisMenu.min.css');?>" rel="stylesheet">    <link href="<?php echo base_url('assets/administrator/css/plugins/timeline/timeline.css');?>" rel="stylesheet">    <link href="<?php echo base_url('assets/administrator/css/sb-admin.css');?>" rel="stylesheet">    <!-- Page-Level Plugin CSS - Dashboard -->    <link href="<?php echo base_url('assets/administrator/css/plugins/morris/morris.css');?>" rel="stylesheet">    <link href="<?php echo base_url('assets/administrator/font-awesome-4.1.0/css/font-awesome.min.css');?>" rel="stylesheet">    <link href="<?php echo base_url('assets/administrator/css/bootstrap-datetimepicker.min.css');?>" rel="stylesheet">   <!-- SB Admin CSS - Include with every page -->
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'></head><body><?php	echo $this->load->view('blocks/header');?>
<div style="padding:2%">
	<div class="row" style="background-color:#323200;color:white;">
		<div class="col-lg-12">
<br>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<br><br><br>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#323200;color:white;" >
					<strong>MIS Chart Analysis</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="chartform" id="chartform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
							
							<div class="form-group col-md-4">
								<?php
									echo form_dropdown('user_id',$userlist,'',"id='user_id' class='form-control'");									 
								?>
							</div>
							</form>
						</div>
					</div>
                            
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Pie Chart </strong>
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
                				<div class="flot-chart">
                    				<div class="flot-chart-content" id="flot-pie-chart"></div>
								</div>
							</div>
							<!-- /.panel-body -->
						</div>
						<!-- /.panel -->
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
 <!-- jQuery -->
 	
    <script src="<?php echo base_url('assets/administrator/js/jquery.js');?>"></script>
	<script type="text/javascript">APPLICATION_URL = "<?php echo base_url();?>";</script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/administrator/js/bootstrap.min.js');?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('assets/administrator/js/plugins/metisMenu/metisMenu.min.js');?>"></script>

    <!-- Flot Charts JavaScript -->
    <script src="<?php echo base_url('assets/administrator/js/plugins/flot/excanvas.min.js');?>"></script>
    <script src="<?php echo base_url('assets/administrator/js/plugins/flot/jquery.flot.js');?>"></script>
    <script src="<?php echo base_url('assets/administrator/js/plugins/flot/jquery.flot.pie.js');?>"></script>
    <script src="<?php echo base_url('assets/administrator/js/plugins/flot/jquery.flot.resize.js');?>"></script>
    <script src="<?php echo base_url('assets/administrator/js/plugins/flot/jquery.flot.tooltip.min.js');?>"></script>
    <script src='<?php echo base_url('assets/administrator/js/bootstrap-datetimepicker.js');?>'></script>
    <script src='<?php echo base_url('assets/administrator/js/bootstrap-datetimepicker.fr.js');?>'></script>
   
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/administrator/js/sb-admin.js');?>"></script>
    <script src="<?php echo base_url('assets/js/vendor/chart.js');?>"></script>
</body>
</html>