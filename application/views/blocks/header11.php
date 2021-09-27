<div id="wrapper">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="navbar-header pull-left">
			<a class="navbar-brand" href="<?php echo base_url();?>" ><img src="<?php echo base_url('assets/images/Kizaku Logo.png');?>"/></a>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".sidebar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>	
		</div>		
       		<!-- /.navbar-header -->
		<ul class="nav navbar-top-links navbar-right">
			 <li class="dropdown">
             	<a id="read_notification" class="dropdown-toggle" data-toggle="dropdown" href="<?php echo base_url('notification/change_status');?>">
					<i class="fa fa-bell fa-fw fa-2x" style="position:relative;" >
						<span id="badge" class="badge" style="background-color:red;position:absolute;margin-top:-10px;margin-left:-10px;"></span>
					</i>  
					<i class="fa fa-caret-down"></i>	
                </a>
                <ul id="notification_dialog" class="dropdown-menu dropdown-alerts">
                </ul>
                    <!-- /.dropdown-alerts -->
			</li>
			<!-- /.dropdown -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw fa-2x"></i>  <i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li><a href="<?php echo base_url('myaccount/');?>"><i class="fa fa-user fa-fw"></i> Edit Profile</a>
					</li>
					<li><a href="<?php echo base_url('myaccount/change_password/');?>"><i class="fa fa-gear fa-fw"></i> Change Password</a>
					</li>
					<li class="divider"></li>
					<li><a href="<?php echo base_url('authentication/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
					</li>
				</ul>
				<!-- /.dropdown-user -->
			</li>
			<!-- /.dropdown -->
		</ul>

            <!-- /.navbar-top-links -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Support Center</a></li>
				<li><a href="#">Video Tutorials</a></li>
				<li><a href="#">Plans</a></li>
				<li><a href="#">Help Book</a></li>
				<li><a href="#">Kizaku University</a></li>
				
			</ul>
		</div>
		
		<ul class="nav navbar-top-links navbar-right">
			<li> 
				<ul class="dropdown-menu dropdown-user">
					<li><a href="<?php echo base_url('myaccount/');?>"><i class="fa fa-user fa-fw"></i> Edit Profile</a></li>
					<li><a href="<?php echo base_url('myaccount/change_password/');?>"><i class="fa fa-gear fa-fw"></i> Change Password</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo base_url('authentication/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
				</ul>
				<!-- /.dropdown-user -->
			</li>
		</ul>
		
		<div class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav" id="side-menu" style="background-color:white !important;">
					<li>
						<a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
					</li>
					<li>
						<a href=""><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="<?php echo base_url('users/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Users</a>
							</li>
							<li>
								<a href="<?php echo base_url('users/add_users');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Users</a>
							</li>
						</ul>
						<!-- /.nav-second-level -->
					</li>
					<li>
						<a href=""><i class="fa fa-users fa-fw"></i> Teams<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
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
					<li>
						<a href=""><i class="fa fa-users fa-fw"></i> My Groups<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="<?php echo base_url('groups/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Groups</a>
							</li>
							<li>
								<a href="<?php echo base_url('groups/add_group');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Group</a>
							</li>
						</ul>
						<!-- /.nav-second-level -->
					</li>
					<li>
						<a href=""><i class="fa fa-list-alt fa-fw"></i> My Projects <span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="<?php echo base_url('projects/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Projects</a>
							</li>
							<li>
								<a href="<?php echo base_url('projects/add_projects');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Project</a>
							</li>
						</ul>
						<!-- /.nav-second-level -->
					</li>
					<li <?php if($this->session->userdata('milestone') == 1){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
						<a href=""><i class="fa fa-list fa-fw"></i> Milestones<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="<?php echo base_url('milestone/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Milestones</a>
							</li>
							<li>
								<a href="<?php echo base_url('milestone/add_milestone');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Milestone</a>
							</li>
						</ul>
						<!-- /.nav-second-level -->
					</li>
					<li <?php if($this->session->userdata('task') == 1){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
						<a href=""><i class="fa fa-tasks fa-fw"></i> Tasks<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<li>
								<a href="<?php echo base_url('task/all');?>"><i class="fa fa-cog fa-fw"></i> Manage Tasks</a>
							</li>
							<li>
								<a href="<?php echo base_url('task/add_task');?>"><i class="fa fa-plus-circle fa-fw"></i> Add Task</a>
							</li>
						</ul>
						<!-- /.nav-second-level -->
					</li>            
					<!-- <li>
						<a href="<?php echo base_url("administrator/task/following_task_list/");?>"><i class="fa fa-wrench fa-fw"></i> Follwing Task<span class="fa arrow"></span></a>
						<!--<ul class="nav nav-second-level">
							<li>
								<a href="<?php echo base_url('task/all');?>">Manage Tasks</a>
							</li>
							<li>
								<a href="<?php echo base_url('task/add_task');?>">Add Task</a>
							</li>
						</ul>
						<!-- /.nav-second-level
					</li> -->        
				</ul>
				<!-- /#side-menu -->
			</div>
            <!-- /.sidebar-collapse -->
		</div>
        <!-- /.navbar-static-side -->
	</nav>