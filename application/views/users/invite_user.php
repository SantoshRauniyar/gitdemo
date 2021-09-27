<div style="padding: 2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Invite Users</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="<?php if($this->session->userdata('panel_heading_color')!=''){echo 'background-color:'.$this->session->userdata('panel_heading_color').' !important;';}?>">
					<strong><?php echo $heading;?></strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" style="<?php if($this->session->userdata('panel_body_color')!=''){echo 'background-color:'.$this->session->userdata('panel_body_color').' !important;';}?>">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="inviteuserform" id="inviteuserform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
								<div id ="control" class="form-group col-md-6" style="padding-left:0 !important;">
									<lable><strong>Invite Team members to join by Email:</strong></lable>
									<input type="text" id="email[]" name="email[]" class="form-control" value="<?php if(isset($email)){echo $email;} ?>">
								</div>
								<div class="form-group col-md-6" style="margin-left:0 !important;">
									<lable>&nbsp;</lable>
									<a id="addcontrol" name="addcontrol" href="#" class="form-control" style="border:none;"><i class="fa fa-plus fa-2x" style="color:red"><font size=5 color=black> Enter more email address</font></i></a>
								</div>
								<div class="clearfix"></div>
								<input type="submit" class="btn btn-primary" value="Submit">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
		
			