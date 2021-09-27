<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $title;?></title>
	
		<!-- Core CSS - Include with every page -->
		<link href="<?php echo base_url('assets/administrator/css/bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/administrator/font-awesome-4.1.0/css/font-awesome.css');?>" rel="stylesheet">
		
		<!-- SB Admin CSS - Include with every page -->
		<link href="<?php echo base_url('assets/administrator/css/sb-admin.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/administrator/css/bootstrap-datetimepicker.min.css');?>" rel="stylesheet">
		
		<script type="text/javascript">APPLICATION_URL = "<?php echo base_url();?>";</script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<strong><?php echo $heading;?></strong>	
							<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
								<?php 
									$this->load->view('common/errors');
								?>
									<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
									<input type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />
								<?php if($mode == "edit"){?>
									
									<div class="form-group pull-right">
										<img src="<?php if(isset($profile_image) && $profile_image != ''){echo base_url('assets/upload/users/'.$profile_image);}else{echo base_url('assets/images/images.jpeg');}?> " height="100" width="100" />
									</div>
									<div class="clearfix"></div>
								<?php } ?>
									<div class="form-group">
										<label>First Name:<strong><font color='red'>*</font></strong></label>
										<input id="first_name" name="first_name" class="form-control" value="<?php if(isset($first_name)){echo $first_name;}?>" >
									</div>
									<div class="form-group">
										<label>Last Name:<strong><font color='red'>*</font></strong></label>
										<input id="last_name" name="last_name" class="form-control" value="<?php if(isset($last_name)){echo $last_name;}?>" >
									</div>
									<div class="form-group">
										<label>User Name:<strong><font color='red'>*</font></strong></label>
										<input id="user_name" name="user_name" class="form-control" value="<?php if(isset($user_name)){echo $user_name;}?>">
									</div>
								<?php if($mode == "Add"){?>
									<div class="form-group">
										<label>Password:<strong><font color='red'>*</font></strong></label>
										<input type="password" id="password" name="password" class="form-control" value="" >
									</div>
									<div class="form-group">
											<label>Confirm Password:<strong><font color='red'>*</font></strong></label>
											<input type="password" id="confirm_password" name="confirm_password" class="form-control" value="" >
									</div>
								<?php } ?>
									<div class="form-group">
										<label for="dtp_input2" class="control-label">Birth Date:</label>
										<div class="input-group date form_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
											<input class="form-control" size="16" type="text" value="<?php if(isset($birth_date)){echo $birth_date;}?>" readonly="true">
											<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<input type="hidden" id="dtp_input2" name="birth_date" value="<?php if(isset($birth_date)){echo $birth_date;}?>" /><br/>
									</div>
									<div class="form-group col-md-6">
										<label>Gender:</label>
										<label class="radio-inline">
											<input type="radio" name="gender" id="gender" value="1" <?php if(isset($gender) && $gender == 1){echo "checked";}?>>Male
										</label>
										<label class="radio-inline">
											<input type="radio" name="gender" id="gender" value="2" <?php if(isset($gender) && $gender == 2){echo "checked";}?>>Female
										</label>
									</div>
									<div class="form-group col-md-6">
										<label>Profile Image:</label>
										<label class="radio-inline">
											<input type="file" id="profile_image" name="profile_image">
										</label>
									</div>
									<div class="form-group">
										<label>Address:</label>
										<textarea id="address" name="address" class="form-control" ><?php if(isset($address)){echo $address;}?></textarea>
									</div>
									<div class="form-group">
										<lable>Country:</label>
										<?php
											if(isset($country_id) && !empty($country_id))
											{
												echo form_dropdown('country_id',$countrylist,$country_id,"id = 'country_id' class='form-control' onchange='getstatelist();'");
											}
											else
											{
												echo form_dropdown('country_id',$countrylist,'',"id = 'country_id' class='form-control' onchange='getstatelist();'");
											}
										?>
									</div>
									<div class="form-group" id="statelist">
										<lable>State:</label>
										<?php
											if(isset($state_id) && !empty($state_id))
											{
												echo form_dropdown('state_id',$statelist,$state_id,"id = 'state_id' class='form-control'");
											}
											else
											{
												echo form_dropdown('state_id',$statelist,'',"id = 'state_id' class='form-control'");
											}
										?>
									</div>
									<div class="form-group" id="citylist"> 
										<lable>City:</label>
										<?php
											if(isset($city_id) && !empty($city_id))
											{
												echo form_dropdown('city_id',$citylist,$city_id,"id = 'city_id' class='form-control'");
											}
											else
											{
												echo form_dropdown('city_id',$citylist,'',"id = 'city_id' class='form-control'");
											}
										?>
									</div>
									
									<div class="form-group">
										<label>Email Address:<strong><font color='red'>*</font></strong></label>
										<input id="email" name="email" class="form-control" value="<?php if(isset($email)){echo $email;}?>" <?php if($mode == "Add"){echo "readonly";}?> >
									</div>
									<div class="form-group">
										<label>Contact Number:</label>
										<input id="contact_no" name="contact_no" class="form-control" value="<?php if(isset($contact_no)){echo $contact_no;}?>" >
									</div>
									<div class="form-group">
										<lable>Select your cuntry time zone :<strong><font color='red'>*</font></strong></lable>
										<?php
											echo timezone_menu('UTC',"form-control","timezone");
										?>
									</div>
<!-- 									<div class="form-group"> -->
<!-- 										<lable>Select Your Plan:</lable> -->
										<?php
// 											if(isset($plan_id))
// 											{
// 												echo form_dropdown("plan_id",$planlist,$plan_id,"class='form-control' id='plan_id'");
// 											}
// 											else 
// 											{
// 												echo form_dropdown("plan_id",$planlist,'',"class='form-control' id='plan_id'");
// 											}
// 										?>
<!-- 									</div> -->
<!-- 									<div class="form-group" style="margin-left:0;">
<!-- 									<label>Features:</label> -->
<!--                                     <div id='features' class="well"> -->
                                    	<?php 
// 											if($mode == "edit")
// 											{
//                                         		echo $feature;
// 											}
// 											else
// 											{
// 										?>
<!--                                     	No Plan Selected . Please select any plan . -->
                                        <?php
// 											}
// 										?>
<!--                                     </div> -->
								</div>
									<input type="submit" class="btn btn-primary" value="<?php if($mode == 'edit'){echo 'Update';}else{echo 'Save';}?>">	
									</form>
								</div>     
							</div>
                    		<!-- /.row (nested) -->
						</div>
                		<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->
		 <!-- Core Scripts - Include with every page -->
	  	<script src="<?php echo base_url('assets/administrator/js/jquery-1.10.2.js');?>"></script>
   		<script src="<?php echo base_url('assets/administrator/js/bootstrap.min.js');?>"></script>
    	<script src="<?php echo base_url('assets/administrator/js/plugins/metisMenu/jquery.metisMenu.js');?>"></script>
	    <!-- SB Admin Scripts - Include with every page -->
	    <script src="<?php echo base_url('assets/administrator/js/sb-admin.js');?>"></script> 
		<script src="<?php echo base_url('assets/administrator/js/bootstrap-datetimepicker.js');?>"></script>
		<script src="<?php echo base_url('assets/administrator/js/bootstrap-datetimepicker.fr.js');?>"></script>
		<script src="<?php echo base_url('assets/js/vendor/registration.js');?>"></script>
	</body>
</html>