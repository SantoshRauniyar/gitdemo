<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title><?php echo $title;?></title>
	    <!-- Core CSS - Include with every page -->
	    <link href="<?php echo base_url('assets/administrator/css/bootstrap.min.css');?>" rel="stylesheet">
    	<link href="<?php echo base_url('assets/administrator/font-awesome/css/font-awesome.css');?>" rel="stylesheet">
	    <!-- SB Admin CSS - Include with every page -->
	    <link href="<?php echo base_url('assets/administrator/css/sb-admin.css');?>" rel="stylesheet">
	</head>
	<body>
		<div class="container">
        	<div class="row">
            	<div class="col-md-8 col-md-offset-2">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading">
	                        <h3 class="panel-title"><strong><?php echo $heading;?></strong></h3>
	                    </div>
	                    <div class="panel-body">
							<?php $this->load->view('common/errors');?>
							<button id="closeme" name="closeme" class="btn btn-default" onclick="self.close()">Close Me</button> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Core Scripts - Include with every page -->
   		<script src="<?php echo base_url('assets/administrator/js/jquery-1.10.2.js');?>"></script>
	    <script src="<?php echo base_url('assets/administrator/js/bootstrap.min.js');?>"></script>
    	<script src="<?php echo base_url('assets/administrator/js/plugins/metisMenu/jquery.metisMenu.js');?>"></script>
	    <!-- SB Admin Scripts - Include with every page -->
	    <script src="<?php echo base_url('assets/administrator/js/sb-admin.js');?>"></script>
	    <script type="text/javascript">
//  	    	jQuery('#closeme').click(function (e) {
// 		    	e.preventDefault();

// 		    	//jQuery(document).close();
// 		    	var win = window.open("","_parent");
// 		    	win.close();
//  		    });
	    </script>
	</body>
</html>