<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <!-- Core CSS - Include with every page -->
    <link href="<?php echo base_url('assets/administrator/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/administrator/font-awesome-4.1.0/css/font-awesome.css');?>" rel="stylesheet">
    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="<?php echo base_url('assets/administrator/css/plugins/morris/morris-0.4.3.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/administrator/css/plugins/timeline/timeline.css');?>" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url('assets/administrator/css/sb-admin.css');?>" rel="stylesheet">
	<script src="<?php echo base_url('assets/administrator/js/jquery-1.10.2.js');?>"></script>
	<script src="<?php echo base_url('assets/administrator/js/vendors/common.js');?>"></script>
	<?php  echo $this->assets_load->print_assets('header'); ?>
</head>
<body>
    <?php echo $header;?>
    <?php echo $content;?>
	<?php //echo $footer;?>

    <!-- Core Scripts - Include with every page -->

	<script type="text/javascript">APPLICATION_URL = "<?php echo base_url();?>";</script>

    <script src="<?php echo base_url('assets/administrator/js/bootstrap.min.js');?>"></script>

    <script src="<?php echo base_url('assets/administrator/js/plugins/metisMenu/jquery.metisMenu.js');?>"></script>



    <!-- Page-Level Plugin Scripts - Dashboard -->

    <script src="<?php echo base_url('assets/administrator/js/plugins/morris/raphael-2.1.0.min.js');?>"></script>

    <script src="<?php echo base_url('assets/administrator/js/plugins/morris/morris.js');?>"></script>



    <!-- SB Admin Scripts - Include with every page -->

    <script src="<?php echo base_url('assets/administrator/js/sb-admin.js');?>"></script>



    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->

    <script src="<?php echo base_url('assets/administrator/js/demo/dashboard-demo.js');?>"></script>


	<?php  echo $this->assets_load->print_assets('footer'); ?>

</body>



</html>

