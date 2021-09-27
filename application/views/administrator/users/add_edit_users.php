<div id="page-wrapper">

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">Manage Users</h1>

		</div>

		<!-- /.col-lg-12 -->

	</div>

	<!-- /.row -->

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

								<?php if($mode == "edit"){?>

								<input type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />

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

								<div class="form-group col-md-6" style="margin-left:0;">

									<label col-md-6>User Type:</label>

									

									<?php

										$usertypearray = array("0"=>"Select user type","1"=>"Team Leader","2"=>"Group Manager","3"=>"Group Member");

										if(isset($user_role))

										{

											echo form_dropdown("user_role",$usertypearray,$user_role,"class='form-control col-md-6'");

										}

										else

										{

											echo form_dropdown("user_role",$usertypearray,'','class=form-control col-md-6');

										}

										

									?>

									

									

								</div>

								<!--<div class="form-group">

									<label>Birth Date:<strong><font color='red'>*</font></strong></label>

									<input id="birth_date" name="birth_date" class="form-control" value="" >

								</div>-->

								<div class="form-group col-md-6">

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

									<label>Email Address:<strong><font color='red'>*</font></strong></label>

									<input id="email" name="email" class="form-control" value="<?php if(isset($email)){echo $email;}?>" >

								</div>

								<div class="form-group">

									<label>Contact Number:</label>

									<input id="contact_no" name="contact_no" class="form-control" value="<?php if(isset($contact_no)){echo $contact_no;}?>" >

								</div>
								
								<div class="form-group">
									<lable>Select your cuntry time zone :</lable>
									<?php
										echo timezone_menu('UTC',"form-control","timezone");
									?>
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

</div>

</div>