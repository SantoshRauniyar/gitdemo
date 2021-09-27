<div id="wrapper">
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color:white;margin-bottom: 0">
   	<div class="navbar-header">
      	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
         	<span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="<?php echo base_url('administrator/index');?>"><!--<img src="<?php echo base_url('assets/images/Kizaku%20Logo.png');?>" height="100%" width="100%"/>--><h1>Kizaku</h1></a>
      </div>
		<!-- /.navbar-header -->
		<ul class="nav navbar-top-links navbar-right">
			<li class="dropdown">
				<a id="read_notification" class="dropdown-toggle" data-toggle="dropdown" onclick="change_status('<?php echo base_url('administrator/notification/change_status');?>');">
					<i class="fa fa-bell fa-fw fa-2x" style="position:relative;" >
						<span id="badge" class="badge" style="background-color:red;position:absolute;margin-top:-10px;margin-left:-10px;"></span>
					</i>  <i class="fa fa-caret-down"></i>
				</a>
            <ul id="notification_dialog" class="dropdown-menu dropdown-alerts">
            	 <li>
						<div></div>
                </li>
                <li class="divider"></li>
            </ul>
            <!-- /.dropdown-alerts -->
			</li>
         <!-- /.dropdown -->
         <li class="dropdown">
	         <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	            <i class="fa fa-user fa-fw fa-2x"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
	            <li>
	            	<a href="<?php echo base_url('administrator/myaccount/');?>">
	            		<i class="fa fa-user fa-fw"></i> Edit Profile
	            	</a>
	            </li>
               <li>
               	<a href="<?php echo base_url('administrator/myaccount/change_password/');?>">
               		<i class="fa fa-gear fa-fw"></i> Change Password
               	</a>
               </li>
               <li class="divider"></li>
               <li>
               	<a href="<?php echo base_url('administrator/authentication/logout');?>">
               		<i class="fa fa-sign-out fa-fw"></i> Logout
               	</a>
               </li>
				</ul>
            <!-- /.dropdown-user -->
 			</li>
         <!-- /.dropdown -->
		</ul>
      <!-- /.navbar-top-links -->
      <div class="navbar-default navbar-static-side" role="navigation" style="margin-top:86px !important;background-color:#f5f5f5;">
	      <div class="sidebar-collapse">
	         <ul class="nav" id="side-menu">
	            <li>
	               <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
               </li>
               <li>
	               <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Plans<span class="fa arrow"></span></a>
	               <ul class="nav nav-second-level">
	               	<li>
	                  	<a href="<?php echo base_url('administrator/plan/all');?>">Manage Plans</a>
                     </li>
                     <li>
	                  	<a href="<?php echo base_url('administrator/plan/add_plan');?>">Add Plan</a>
							</li>
						</ul>
						<!-- /.nav-second-level -->
					</li>
               <li>
	               <a href="<?php echo base_url('administrator/users/all');?>"><i class="fa fa-user fa-fw"></i> Users</a>
	               <!--<ul class="nav nav-second-level">
	               	<li>
	                  	<a href="<?php echo base_url('administrator/users/all');?>">Manage Users</a>
							</li>
							<li>
								<a href="<?php echo base_url('administrator/users/add_users');?>">Add Users</a>
							</li>
						</ul>-->
                  <!-- /.nav-second-level -->
					</li>
               <li>
	               <a href="<?php echo base_url('administrator/team/all');?>"><i class="fa fa-users fa-fw"></i> Team Management</a>
                  <!--<ul class="nav nav-second-level">
	                  <li>
	                     <a href="<?php echo base_url('administrator/team/all');?>">Manage Team</a>
                     </li>
                     <li>
	                     <a href="<?php echo base_url('administrator/team/add_team');?>">Add Team</a>
                     </li>
						</ul>
                  <!-- /.nav-second-level -->
					</li>
           		<li>
	               <a href="<?php echo base_url('administrator/groups/all');?>"><i class="fa fa-users fa-fw"></i> Group Management</a>
	               <!--<ul class="nav nav-second-level">
	               	<li>
	                  	<a href="<?php echo base_url('administrator/groups/all');?>">Manage Group</a>
                     </li>
                     <li>
	                     <a href="<?php echo base_url('administrator/groups/add_group');?>">Add Group</a>
                     </li>
                  </ul>-->
                     <!-- /.nav-second-level-->
		         </li>
               <li>
	               <a href="<?php echo base_url('administrator/projects/all');?>"><i class="fa fa-folder-open fa-fw"></i> Project Management</a>
                  <!--<ul class="nav nav-second-level">
	                  <li>
	                     <a href="<?php echo base_url('administrator/projects/all');?>">Manage Project</a>
                     </li>
                     <li>
                        <a href="<?php echo base_url('administrator/projects/add_projects');?>">Add Project</a>
                     </li>
                  </ul>-->
                  <!-- /.nav-second-level -->
					</li>  
					<li>
	               <a href="<?php echo base_url('administrator/milestone/all');?>"><i class="fa fa-list-alt fa-fw"></i> Milestone Management</a>
						<!--<ul class="nav nav-second-level">
	                  <li>
	                     <a href="<?php echo base_url('administrator/milestone/all');?>">Manage Milestones</a>
                     </li>
                     <li>
	                     <a href="<?php echo base_url('administrator/milestone/add_milestone');?>">Add Milestone</a>
                     </li>
                  </ul>-->
                  <!-- /.nav-second-level -->
               </li>
					<!--<li>
	               <a href="#"><i class="fa fa-wrench fa-fw"></i>Task Type Management<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
	                  <li>
	                     <a href="<?php echo base_url('administrator/task_type/all');?>">Manage Task Type</a>
                     </li>
                     <li>
                        <a href="<?php echo base_url('administrator/task_type/add_task_type');?>">Add Task Type</a>
                     </li>
						</ul>
                  <!-- /.nav-second-level 
               </li>-->        
					<li>
               	<a href="<?php echo base_url('administrator/task/all');?>"><i class="fa fa-wrench fa-fw"></i>Tasks<span class="fa arrow"></span></a>
                 <!-- <ul class="nav nav-second-level">
	                  <li>
	                     <a href="<?php echo base_url('administrator/task/all');?>">Manage Tasks</a>
                     </li>
                     <li>
	                     <a href="<?php echo base_url('administrator/task/add_task');?>">Add Task</a>
                     </li>
                  </ul>-->
                  <!-- /.nav-second-level--> 
               </li>                     
					<!--<li>
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
                        </li>-->   
				</ul>
            <!-- /#side-menu -->
			</div>
         <!-- /.sidebar-collapse -->
		</div>
      <!-- /.navbar-static-side -->
	</nav>