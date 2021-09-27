<div id="page-wrapper">

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">Permission Manager</h1>

		</div>

		<!-- /.col-lg-12 -->

	</div>

	<!-- /.row -->

	<div class="row">

		<div class="col-lg-12">

			<div class="panel panel-default">

				<div class="panel-heading">

					<strong>Set Parmissions</strong>

				</div>

				<!-- /.panel-heading -->

				<div class="panel-body">

					<div class="table-responsive">

						<form id="usersrolelistform" name="usersrolelistform" method="post" action="<?php base_url('administrator/user_role/');?>">
						<?php
							if(isset($userroledata))
							{
						?>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">

							<thead>

								<tr>

									<th>User Role</th>

									<!--<th align="center">User</th>

									<th align="center">Plan</th>

									<th align="center">Team</th>-->

									<th align="center">Group</th>
									
									<th align="center">Project</th>

									<th align="center">Milestone</th>

									<th align="center">Task</th>
									
									<th align="center">Group Task</th>
									
									<th align="center">Actions</th>
								</tr>

							</thead>

							<tbody>
								<?php
										foreach($userroledata['results'] as $data)
										{
										//print_r($data);exit;
								?>
								
								<tr class="odd gradeX">

									<td><?php echo $data->role; ?></td>

									<!--<td align="center">
										<input type="checkbox" id="user" name="user" value="1" <?php if($data->user == 1){echo "checked=checked";}?> onclick = "changestatus('<?php echo base_url();?>','administrator/user_role/changestatus/<?php echo $data->id;?>/user/','usersrolelistform',this);"/>
									</td>
									
									<td align="center">
										<input type="checkbox" id="plan" name="plan" value="1" <?php if($data->plan == 1){echo "checked=checked";}?> onclick = "changestatus('<?php echo base_url();?>','administrator/user_role/changestatus/<?php echo $data->id;?>/plan/','usersrolelistform',this);"/>
									</td>
									
									<td align="center">
										<input type="checkbox" id="team" name="team" value="1" <?php if($data->team == 1){echo "checked=checked";}?> onclick = "changestatus('<?php echo base_url();?>','administrator/user_role/changestatus/<?php echo $data->id;?>/team/','usersrolelistform',this);"/>
									</td>-->
									
									<td align="center">
										<input type="checkbox" id="groups" name="groups" value="1" <?php if($data->groups == 1){echo "checked=checked";}?> onclick = "changestatus('<?php echo base_url();?>','administrator/user_role/changestatus/<?php echo $data->id;?>/groups/','usersrolelistform',this);"/>
									</td>
									
									<td align="center">
										<input type="checkbox" id="project" name="project" value="1" <?php if($data->project == 1){echo "checked=checked";}?> onclick = "changestatus('<?php echo base_url();?>','administrator/user_role/changestatus/<?php echo $data->id;?>/project/','usersrolelistform',this);"/>
									</td>
									
									<td align="center">
										<input type="checkbox" id="milestone" name="milestone" value="1" <?php if($data->milestone == 1){echo "checked=checked";}?> onclick = "changestatus('<?php echo base_url();?>','administrator/user_role/changestatus/<?php echo $data->id;?>/milestone/','usersrolelistform',this);"/>
									</td>
									
									<td align="center">
										<input type="checkbox" id="task" name="task" value="1" <?php if($data->task == 1){echo "checked=checked";}?> onclick = "changestatus('<?php echo base_url();?>','administrator/user_role/changestatus/<?php echo $data->id;?>/task/','usersrolelistform',this);"/>
									</td>
									
									<td align="center">
										<input type="checkbox" id="group_task" name="group_task" value="1" <?php if($data->group_task == 1){echo "checked=checked";}?> onclick = "changestatus('<?php echo base_url();?>','administrator/user_role/changestatus/<?php echo $data->id;?>/group_task/','usersrolelistform',this);"/>
									</td>
									
									<td align="center">
										<a href="<?php echo base_url('administrator/user_role/edit_user_role/'.$data->id);?>">
											<img src="<?php echo base_url('assets/administrator/icons/edit.png');?>" height="18" width="18" title="Edit">
										</a>&nbsp;

										<a id="delete" href="<?php echo base_url('administrator/user_role/single_role_delete/'.$data->id);?>">
											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete">
										</a>
									</td>
								</tr>
								<?php
										}
									
								?>
                            </tbody>

						</table>
						<?php
							}
							else
							{
								echo "No records available.";
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