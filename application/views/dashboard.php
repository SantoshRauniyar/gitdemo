<div  style="background-color:white !important;">
	<div class="row">
		<div class="col-lg-12">
<br>
<br>
<br>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Dashboard Panel</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<?php
					if($this->session->userdata('user_role') =='Captain')
					{
						if($this->session->userdata('team_id') != '')
						{
					?>
					<div class="col-md-4">
						<div class="panel panel-danger">
							<div class="panel-body text-center">
								 <i class="fa fa-user fa-5x"></i>
							</div>
							<div class="panel-footer bgc text-center"><a href="<?php echo base_url('users/all');?>">Users</a></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-danger">
							<div class="panel-body text-center">
								 <i class="fa fa-users fa-5x"></i>
							</div>
							<div class="panel-footer bgc text-center  bgc"><a href="<?php echo base_url('groups/all');?>">Groups</a></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-danger">
							<div class="panel-body text-center">
								<i class="fa fa-folder-open fa-5x"></i>
							</div>
							<div class="panel-footer bgc text-center"><a href="<?php echo base_url('projects/all');?>">Projects</a></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-danger">
							<div class="panel-body text-center">
								<i class="fa fa-list-alt fa-5x"></i>
							</div>
							<div class="panel-footer bgc text-center"><a href="<?php echo base_url('milestone/all');?>">Milestone</a></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-danger">
							<div class="panel-body text-center">
								 <i class="fa fa-tasks fa-5x"></i>
							</div>
							<div class="panel-footer bgc text-center"><a href="<?php echo base_url('task/all');?>">Tasks</a></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-danger">
							<div class="panel-body text-center">
								 <i class="fa fa-sign-out fa-5x"></i>
							</div>
							<div class="panel-footer bgc text-center"><a href="<?php echo base_url();?>">Leave Management</a></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-danger">
							<div class="panel-body text-center">
								 <i class="fa fa-bar-chart-o fa-5x"></i>
							</div>
							<div class="panel-footer bgc text-center"><a href="<?php echo base_url('chart/');?>">MIS Charts</a></div>
						</div>
					</div>
					<?php
						}
						else 
						{
							echo "No Team available.";
						}
							
					}
					else
					{
					?>
						<div class="col-md-4">
							<div class="panel panel-danger">
								<div class="panel-body text-center">
									<i class="fa fa-user fa-5x"></i>
								</div>
								<div class="panel-footer bgc text-center"><a href="<?php echo base_url('groups/group_members');?>"> My Group Users</a></div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-danger">
								<div class="panel-body text-center">
									 <i class="fa fa-tasks fa-5x"></i>
								</div>	
								<div class="panel-footer bgc text-center"><a href="<?php echo base_url('task/all/');?>">Tasks</a></div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-danger">
								<div class="panel-body text-center">
									 <i class="fa fa-sign-out fa-5x"></i>
								</div>
								<div class="panel-footer bgc text-center"><a href="<?php echo base_url();?>">Leave Management</a></div>
							</div>
						</div>
					<?php 
					} 
					?>
					
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->