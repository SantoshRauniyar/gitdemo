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

            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">

                    <div class="panel-heading">

                        <h3 class="panel-title"><strong>Administrator Login</strong></h3>

                    </div>

                    <div class="panel-body">

					<?php $this->load->view('common/errors');?>

                        <form role="form" method="post" action="<?php echo base_url('administrator/authentication/do_login');?>" >

                            <fieldset>

                                <div class="form-group">

                                    <input class="form-control" placeholder="User Name" name="admin_name" type="text" value="<?php if(isset($admin_name)){echo $admin_name;}?>" autofocus>

                                </div>

                                <div class="form-group">

                                    <input class="form-control" placeholder="Password" name="password" type="password" value="<?php if(isset($password)){echo $password;}?>">

                                </div>

                                <div class="checkbox">

                                    <label>

                                        <input name="remember" type="checkbox" <?php if(isset($admin_name)){echo 'checked=checked';}?> >Remember Me

                                    </label>

                                </div>

                                <!-- Change this to a button or input when using this as a form -->

                                <input type="submit" id="login" name="login" value="Login" class="btn btn-lg btn-success btn-block">

                            </fieldset>

                        </form>

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



</body>



</html>

