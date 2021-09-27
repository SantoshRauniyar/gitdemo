<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
		<title><?php echo $title;?></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
	
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet">
	
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/normalize.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/templatemo_misc.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/templatemo_style.css');?>">
	
		<script src="<?php echo base_url('assets/js/vendor/modernizr-2.6.2.min.js');?>"></script>
		
		<?php  echo $this->assets_load->print_assets('header'); ?>

	</head>
	<body>
        <?php echo $header;?>
	    <?php echo $content;?>
		<?php echo $footer;?>	
    <!-- Core Scripts - Include with every page -->

		<script src="<?php echo base_url('assets/js/vendor/jquery-1.10.1.min.js');?>"></script>
		<script>window.jQuery || document.write('<script src="<?php echo base_url('assets/js/vendor/jquery-1.10.1.min.js');?>"><\/script>')</script>
		<script src="<?php echo base_url('assets/js/jquery.easing-1.3.js');?>"></script>
		<script src="<?php echo base_url('assets/js/bootstrap.js');?>"></script>
		<script src="<?php echo base_url('assets/js/plugins.js');?>"></script>
		<script src="<?php echo base_url('assets/js/main.js');?>"></script>
		<script src="<?php echo base_url('assets/js/assign_easynavi.js');?>"></script>
		<!--  Free HTML5 Template by http://www.templatemo.com -->	
		<?php  echo $this->assets_load->print_assets('footer'); ?>
	
	</body>
</html>

