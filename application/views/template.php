<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <!-- Core CSS - Include with every page -->
    <link href="<?php echo base_url('assets/administrator/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/administrator/css/plugins/metisMenu/metisMenu.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/administrator/css/plugins/timeline/timeline.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/administrator/css/sb-admin-2.css');?>" rel="stylesheet">

<!--   dropdown link -->
        <link href="<?php echo base_url('assets/administrator/css/css/stellarnav.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/administrator/css/css/stellarnav.min.css');?>" rel="stylesheet">
 <link href="<?php echo base_url('assets/dashboard/style.css');?>" rel="stylesheet">
    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="<?php echo base_url('assets/administrator/css/plugins/morris/morris-0.4.3.min.css');?>" rel="stylesheet">
    
    <link href="<?php echo base_url('assets/administrator/font-awesome-4.1.0/css/font-awesome.min.css');?>" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    
	
	<?php  echo $this->assets_load->print_assets('header'); ?>
	<script src="<?php echo base_url('assets/administrator/js/jquery-1.10.2.js');?>"></script>
</head>
<body>
    <?php echo $header;?>
    <?php echo $content;?>
	<?php //echo $footer;?>

    <!-- Core Scripts - Include with every page -->

	<script type="text/javascript">APPLICATION_URL = "<?php echo base_url();?>";</script>
    <script src="<?php echo base_url('assets/administrator/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/administrator/js/plugins/metisMenu/metisMenu.min.js');?>"></script>
    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="<?php echo base_url('assets/administrator/js/plugins/morris/raphael-2.1.0.min.js');?>"></script>
    <script src="<?php echo base_url('assets/administrator/js/plugins/morris/morris.js');?>"></script>
    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo base_url('assets/administrator/js/sb-admin-2.js');?>"></script>
    <!--dropdown js library-->
        <script src="<?php echo base_url('assets/administrator/js/js/stellarnav.js');?>"></script>
            <script src="<?php echo base_url('assets/administrator/js/js/stellarnav.min.js');?>"></script>
    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
	<script src="<?php echo base_url('assets/js/vendor/common.js');?>"></script>
	<script src="<?php echo base_url('assets/js/assign_easynavi.js');?>"></script>
	<?php  echo $this->assets_load->print_assets('footer'); ?>

</body>



</html>

