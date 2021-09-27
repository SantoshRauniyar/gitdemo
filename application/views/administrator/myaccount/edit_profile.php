<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">My Account</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Edit Profile</strong>	
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?php echo base_url('index.php/administrator/myaccount/do_update');?>">
								<input type="hidden" id="id" name="id" value="<?php echo $this->session->userdata('admin_id');?>">
								<div class="form-group">
									<label>User Name:<strong><font color='red'>*</font></strong></label>
									<input id="user_name" name="user_name" class="form-control" value="<?php if(isset($user_name)){echo $user_name;}?>" readonly="true">
								</div>
								<div class="form-group">
									<label>First Name:<strong><font color='red'>*</font></strong></label>
									<input id="first_name" name="first_name" class="form-control" value="<?php if(isset($first_name)){echo $first_name;}?>" >
								</div>
								<div class="form-group">
									<label>Last Name:<strong><font color='red'>*</font></strong></label>
									<input id="last_name" name="last_name" class="form-control" value="<?php if(isset($last_name)){echo $last_name;}?>" >
								</div>
								<div class="form-group">
									<label>Email Address:<strong><font color='red'>*</font></strong></label>
									<input id="email" name="email" class="form-control" value="<?php if(isset($email)){echo $email;}?>" >
								</div>
								<div class="form-group">
									<label>Contact Number:<strong><font color='red'>*</font></strong></label>
									<input id="contact_no" name="contact_no" class="form-control" value="<?php if(isset($contact_no)){echo $contact_no;}?>" >
								</div>
								<input type="submit" class="btn btn-primary" value="Update">	
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