<div style="padding:2%;">
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
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Change Password</strong>	
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php $this->load->view('common/errors');?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?php echo base_url('index.php/myaccount/update_password');?>">
								<!--<input type="hidden" id="id" name="id" value="">-->
								<div class="form-group">
									<label>Old Password:<strong><font color='red'>*</font></strong></label>
									<input type="password" id="old_password" name="old_password" class="form-control">
								</div>
								<div class="form-group">
									<label>New Password:<strong><font color='red'>*</font></strong></label>
									<input type="password" id="new_password" name="new_password" class="form-control">
								</div>
								<div class="form-group">
									<label>Confirm Password:<strong><font color='red'>*</font></strong></label>
									<input type="password" id="confirm_password" name="confirm_password" class="form-control">
								</div>
								
								<input style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;" type="submit" id="submit" name="submit" class="btn btn-primary" value="Update">
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