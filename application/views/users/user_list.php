<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Team</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color: #ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Team Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
					<?php 
							$this->load->view('common/errors');
						?>
							<h3>Team List</h3>
						<form id="userslistform" name="userslistform" method="post" action="<?php base_url('administrator/users/');?>">
						<!-- <a id="multidelete" href="<?php echo base_url('users/delete_multiple');?>" class="btn btn-primary" <?php if(isset($userdata)){}else{echo "disabled='disabled'";}?> style="background-color: #ef0f0f;border-color:#ef0f0f;color:white;">Delete All</a>
                         <a id="addusers" href="<?php echo base_url('users/add_users');?>" class="btn btn-primary" style="background-color: #ef0f0f;border-color:#ef0f0f;color:white;">Add User</a>
                         <a id="inviteuser" href="<?php echo base_url('users/invite_user');?>" class="btn btn-primary" style="background-color: #ef0f0f;border-color:#ef0f0f;color:white;">Invite Users</a>-->
                        <?php
							
								if(isset($userdata))
								{
						?>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>

									<th>Profile Image</th>
									<th>User Name</th>
									<th>Name</th>
						<!-- <th>Team Name</th>-->
									<th>User Role</th>
									<th>Email</th>
									<th>Contact Number</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php
								
									foreach($userdata['results'] as $data)
									{
							?>
								<tr class="odd gradeX">
									
									<td align="center">
										<img src="<?php if($data->profile_image != ''){echo base_url('assets/upload/users/'.$data->profile_image);}else{echo base_url('assets/administrator/images/images.jpeg');}?>" height="25" width="25" />
									</td>
									<td><?php echo $data->user_name;?></td>
									<td class="center"><?php echo $data->first_name." ".$data->last_name;?></td>
									<!-- <td class="center"><?php echo $data->team_name; ?></td>-->
									<td><?php echo $data->user_role_name; ?></td>
									<td><?php echo $data->email;?></td>
									<td><?php echo $data->contact_no;?></td>
									<td>
										<!--<a title="Switching" data-toggle="modal" data-target="#myModal"><i class="fa fa-share fa-lg"></i></a>-->
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
	    										<div class="modal-content">	
													<div class="modal-header">
	        											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        											<h4 class="modal-title" id="myModalLabel">Switch User</h4>
	      											</div>
	      											<form role="form" id="switchuserform" name="switchuserform" method="post" action="<?php echo base_url("users/do_switch_user/");?>">
													<div class="modal-body"> 
														<input type="hidden" id="id" name="id" value="<?php echo $data->id;?>">
														<div class="form-group">
        													<label>Please select team to switch:</label>
													        	<?php
													        		if(isset($teamlist)) 
													        		{
													        			echo form_dropdown("team_id",$teamlist,'',"class='form-control' id='team_id'");
													        		}
													        	?>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<button id="switchusr" type="submit" class="btn btn-primary">Save changes</button>
													</div>
													</form>
												</div>
											</div>
										</div>
										<!--<a href="<?php echo base_url('users/edit_user/'.$data->id);?>">
											<img src="<?php echo base_url('assets/administrator/icons/edit.png');?>" height="18" width="18" title="Edit">
										</a>&nbsp;
										<a id="status" href="<?php echo base_url('users/change_user_status/'.$data->id.'/'.$data->status);?>">
											<img src="<?php if($data->status == 1){echo base_url('assets/administrator/icons/active.png');}else{echo base_url('assets/administrator/icons/inactive.png');}?>" height="18" width="18" title="<?php if($data->status == 1){echo "Inactive";}else{echo "active";}?>">
										</a>&nbsp;
										<a id="delete" href="<?php echo base_url('users/single_delete/'.$data->id);?>">
											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete">
										</a>-->
										<a href="<?php echo base_url('users/edit_user/'.$data->id);?>" class="btn btn-primary" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f">View Details</a>
									</td>
								</tr>
							<?php
									
									}
									
							?>
                            </tbody>
						</table>
						<?php
									echo $userdata['links'];
								}
								else 
								{
									echo "No Record available.";
								}
						?>
						</form>
					</div>
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