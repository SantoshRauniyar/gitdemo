<style type="text/css">
	li,a,p{font-family:"Raleway","Helvetica", "Arial", sans-serif;}
	li a{letter-spacing: 1px;font-family: system-ui, system-ui, sans-serif;}
</style>
<div id="wrapper">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:white;height:100px;">
		<div class="container-fluid">
  		  <!-- Brand and toggle get grouped for better mobile display -->
    		<div class="navbar-header">
	      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menubar">
	        			<span class="sr-only">Toggle navigation</span>
	        			<span class="icon-bar"></span>
	        			<span class="icon-bar"></span>
	        			<span class="icon-bar"></span>
	      		</button>
     			<a class="navbar-brand" href="<?php echo base_url();?>" >
					<!--<img src="<?php echo base_url('assets/images/Kizaku Logo.png');?>"/>-->
					<h3 style="margin-top:0px;"><b><i>Kizaku</i></b></h3>
				</a>
			</div>
			<div id="menubar" class="collapse navbar-collapse" role="navigation" style="padding-top:20px;">
				<ul class="nav navbar-nav">
					<?php
						if($this->session->userdata('id') != '')
						{
							if($this->session->userdata('user_role') == "Captain")
							{
					?>
					<li class="active">
						<a href="<?php echo base_url('dashboard'); ?>">My Desk</a>
					</li>
					<li class="dropdown">
						<a href=""  class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Teams</a>
						<ul class="dropdown-menu" role="menu">
							<li>								
								<a href="<?php echo base_url('team/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Teams</a>							
							</li>
							<li>
								<a href="<?php echo base_url('team/team_configuration');?>"><i class="fa fa-wrench fa-fw"></i> Configuration</a>
							</li>
							<li>
								<a href="<?php echo base_url('team/add_team');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Teams</a>
							</li>					
						</ul>						
						<!-- /.nav-second-level -->					
					</li>		
					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Users</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo base_url('user_role/add_role');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Role</a>
							</li>
							<li>
								<a href="<?php echo base_url('user_role/all');?>"><i class="fa fa-cog fa-fw"></i> Manage User Role</a>
							</li>
							<li>
								<a href="<?php echo base_url('user_role/set_privillages/');?>"><i class="fa fa-cog fa-fw"></i>Set Privilages</a>
							</li>
							<li>
								<a href="<?php echo base_url('users/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Users</a>
							</li>
							<li>
								<a href="<?php echo base_url("users/invite_user"); ?>"><i class="fa fa-plus-circle fa-fw"></i> Invite Users</a>
							</li>
							<li>
								<a href="<?php echo base_url('users/add_users');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Users</a>
							</li>
						</ul>
						<!-- /.nav-second-level -->
					</li>
					
					<li class="dropdown"><a href=""  class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Groups</a>						<ul class="dropdown-menu" role="menu">							<li>								<a href="<?php echo base_url('groups/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Groups</a>							</li>							<li>								<a href="<?php echo base_url('groups/add_group');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Groups</a>							</li>						</ul>						<!-- /.nav-second-level -->					</li>
					<li class="dropdown"><a href=""  class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Projects</a>						<ul class="dropdown-menu" role="menu">							<li>								<a href="<?php echo base_url('projects/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Projects</a>							</li>							<li>								<a href="<?php echo base_url('projects/add_projects');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Project</a>							</li>						</ul>						<!-- /.nav-second-level -->					</li>
					<li class="dropdown"><a href=""  class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Milestones</a>						<ul class="dropdown-menu" role="menu">							<li>								<a href="<?php echo base_url('milestone/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Milestone</a>							</li>							<li>								<a href="<?php echo base_url('milestone/add_milestone');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Milestone</a>							</li>						</ul>						<!-- /.nav-second-level -->					</li>
					
					<li class="dropdown">
						<a href=""  class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Tasks</a>
						<ul class="dropdown-menu" role="menu">
							<li>								
								<a href="<?php echo base_url('task/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Task</a>
							</li>
							<li>
								<a href="<?php echo base_url('task/add_task');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Task</a>
							</li>
						</ul>
						<!-- /.nav-second-level -->
					</li>
					<?php
							}
							else if($this->session->userdata('user_role') == "Captain")
							{
					?>
					<li class="active">
						<a href="<?php echo base_url('dashboard'); ?>">My Desk</a>
					</li>
					<li class="dropdown">
						<a href=""  class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Teams</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo base_url('team/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Teams</a>							
							</li>
							<li>
								<a href="<?php echo base_url('team/team_configuration');?>"><i class="fa fa-wrench fa-fw"></i> Configuration</a>
							</li>
							<li>
								<a href="<?php echo base_url('team/add_team');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Teams</a>
							</li>						
						</ul>						
						<!-- /.nav-second-level -->					
					</li>		
					<li class="dropdown">
						<a href="" class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Users</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo base_url('user_role/add_role');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Role</a>
							</li>
							<li>
								<a href="<?php echo base_url('user_role/all');?>"><i class="fa fa-cog fa-fw"></i> Manage User Role</a>
							</li>
							<li>
								<a href="<?php echo base_url('user_role/set_privillages/');?>"><i class="fa fa-cog fa-fw"></i>Set Privilages</a>
							</li>
 							<li>
								<a href="<?php echo base_url('users/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Users</a>
 							</li>
							<li>
								<a href="<?php echo base_url('users/invite_user');?>"><i class="fa fa-cog fa-fw"></i> Invite Users</a>
							</li>
							<li>
								<a href="<?php echo base_url('users/add_users');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Users</a>
							</li>
						</ul>
						<!-- /.nav-second-level -->
					</li>
					
					<li class="dropdown">
						<a href=""  class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Groups</a>						<ul class="dropdown-menu" role="menu">							<li>								<a href="<?php echo base_url('groups/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Groups</a>							</li>							<li>								<a href="<?php echo base_url('groups/add_group');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Groups</a>
					</li>						
					<li class="dropdown">
						<a href=""  class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Projects</a>						<ul class="dropdown-menu" role="menu">							<li>								<a href="<?php echo base_url('projects/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Projects</a>							</li>							<li>								<a href="<?php echo base_url('projects/add_projects');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Project</a>
					</li>
					<li class="dropdown">
						<a href=""  class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Milestones</a>
						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="<?php echo base_url('milestone/all');?>">
									<i class="fa fa-cog fa-fw"></i> Manage Milestone
								</a>
							</li>
							<li>
								<a href="<?php echo base_url('milestone/add_milestone');?>">
									<i class="fa fa-plus-circle fa-fw"></i> Add Milestone
								</a>
							</li>
						</ul>
						<!-- /.nav-second-level -->
					</li>
					<li class="dropdown">
						<a href=""  class="dropdown-toggle" data-toggle="dropdown" style="color:white;">Tasks</a>						<ul class="dropdown-menu" role="menu">							<li>								<a href="<?php echo base_url('task/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Task</a>							</li>							<li>								<a href="<?php echo base_url('task/ad	d_task');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Task</a>							
					</li>
					<?php 
							}
						}
						else 
						{
					?>
  					<li class="active"><a href="<?php echo base_url();?>" style="color:black;font-weight: bold;" id="mnu">Home</a></li>
  					<li><a href="#" style="color:black;font-weight: bold;" id="mnu" >About us</a></li>
  					<li><a href="#" style="color:black;font-weight: bold;" id="mnu" >Services</a></li>
  					<li><a href="#" style="color:black;font-weight: bold;" id="mnu" >Contact us</a></li>
  					<?php
  						}
  					?>
				</ul>
				<?php
					if(!$this->session->userdata('id') != '')
					{
				?>
				<ul class="nav navbar-nav navbar-right">
  					<li><a href="<?php echo base_url('authentication/');?>" style="color:black;font-weight: bold;" id="mnu">Sign In</a></li>
  					<li><a href="<?php echo base_url('authentication/register');?>" style="color:black;font-weight: bold;" id="mnu">Sign Up</a></li>
				</ul>
				<?php
					}
				?>
				<ul class="nav navbar-nav navbar-right" style="margin-top:0 !important;">
					<?php
						if($this->session->userdata('id') != '')
						{
					?>
					<li class="dropdown">
          			<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
          				<img src="<?php echo base_url('assets/upload/users/'.$this->session->userdata('profile_image'));?>" height="25" width="25"/> <?php echo $this->session->userdata('user_name');?><span class="caret"></span>
          			</a>
        			  	<ul class="dropdown-menu" role="menu">
            			<li><a href="<?php echo base_url('myaccount/');?>"><i class="fa fa-user fa-fw"></i> Edit Profile</a></li>
							<li><a href="<?php echo base_url('myaccount/change_password/');?>"><i class="fa fa-gear fa-fw"></i> Change Password</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo base_url('authentication/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
          			</ul>
          		</li>
          		<li><a href="<?php echo base_url('authentication/logout');?>">Sing out</a></li>
					<?php
						}
					?>
       			 
       			 
          	</ul>
			</div>
    	</div>
	</nav>
</div>