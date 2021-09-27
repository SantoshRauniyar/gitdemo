<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Teams</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong><?php echo $heading;?></strong>	
				</div>
				<div class="panel-body" >
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="editteamform" id="editteamform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
							<div class="form-group">
								<label>Select Your Team</label>

								<?php
									if(isset($teamlist) && !empty($teamlist))
									{
										echo form_dropdown("team_id",$teamlist,"","class='form-control' id='team_id'");
									}
								?>
							</div>							
							<div class="col-lg-12" id="subpanel" style="display:none;">
								<div class="panel panel-default">
									<div class="panel-heading">
										<strong>Manage Team By Configuring Features And Functions Hear</strong>
										<button type="submit" id="save" name="save" class="btn btn-primary pull-right" style="margin-top:-7px;">Save Configuration</button>
									</div>
									<div class="panel-body">
										<div class="table-responsive">
											<div class="col-md-4 pull-left" style="margin-top:5px;margin-bottom:5px;">
												<label>Showing Fetures</label>
											</div>
											<div class="col-md-8" style="margin-bottom:5px;">
												<?php
													$features = array("0"=>"Select Fearcher Type","1"=>"Team Feature","2"=>"Group Feature","3"=>"Genral Task Feature");
													echo form_dropdown("feature_id",$features,'1',"class='form-control' id='features'");
												?>
											</div>
											<div class="clearfix"></div>
											<table class="table table-striped table-bordered table-hover" id="dataTables-example" >
												<thead>
													<tr>
														<th>Fetures</th>
														<th>Yes/No</th>
														<th>Description</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody id="team_setting">
													<tr>
														<td>Multi Groups Creation</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("multi_groups_creation",$yesno,"2","id='multi_groups_creation'");
															?>
														</td>
														<td>Description</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Multi Time-Zone Management</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("multi_time_zone",$yesno,"2","id='multi_time_zone'");
															?>
														</td>
														<td>Description</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Multi Currency Management</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("multi_currency",$yesno,"2","id='multi_currency'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Leave Management</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("leave_management",$yesno,"2","id='leave_management'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Rejoin Management</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("rejoin",$yesno,"2","id='rejoin'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>MIS Chart</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("mis_chart",$yesno,"2","id='mis_chart'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Theam Setting</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("theam",$yesno,"2","id='theam'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Limit Member Size</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("limit_member_size",$yesno,"2","id='limit_member_size'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Announcements </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("announcements",$yesno,"2","id='announcements'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
												</tbody>
												<tbody id="group_setting" style="display:none;">
													<tr>
														<td>Groups Creation</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("group_creation",$yesno,"2","id='group_creation'");
															?>
														</td>
														<td>Description</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Sub Groups Creation</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("subgroup_creation",$yesno,"2","id='subgroup_creation'");
															?>
														</td>
														<td>Description</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Group Discussion Board</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("group_discussion_board",$yesno,"2","id='group_discussion_board'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
												</tbody>
												<tbody id="task_settoing" style="display:none;">
													<tr>
														<td>Allow Recurrence Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("recurrence_task",$yesno,"2","id='recurrence_task'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Allow Subsequent Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("subsequent_task",$yesno,"2","id='subsequent_task'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Allow Budget Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("budget_task",$yesno,"2","id='budget_task'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Allow Task Followers</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("task_followers",$yesno,"2","id='task_followers'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Task Approval Management</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("task_approval",$yesno,"2","id='task_approval'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Allow Task Discussion Board</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("task_discussion",$yesno,"2","id='task_discussion'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Allow Auto Aborted Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("auto_abort",$yesno,"2","id='auto_abort'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Allow Subtask</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("subtask",$yesno,"2","id='subtask'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
													<tr>
														<td>Allow Reassigning Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("reassign_task",$yesno,"2","id='reassign_task'");
															?>
														</td>
														<td>Discription</td>
														<td>
															<a href="<?php base_url();?>" class="btn btn-primary">Details</a>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
							</div>
							<!--<div class="col-lg-12">
								<h4 class="page-header">Groups Related Settings</h4>
							</div>
							<div class="form-group col-md-6">
									<label>Groups Creation:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Sub Group Creation:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Group Discussion Board:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="clearfix"></div>
							<div class="col-lg-12">
								<h4 class="page-header">Task Related Settings</h4>
							</div>
							<div class="form-group col-md-6">
									<label>Reassign tasks:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Create Sub tasks:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Approve tasks after Completion:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Task Discussion Board:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Task Reminder Function:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Task followers:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Reassign all tasks of a member to another member:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Auto Abort Tasks:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Budgeted Tasks:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="clearfix"></div>
							
							<div class="col-lg-12">
								<h4 class="page-header">Other Function Settings</h4>
							</div>
							<div class="form-group col-md-6">
									<label>Announcements:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Multi-Time Zone:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Multi Currency:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>MIS Charts:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Theme Selection:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Chat Function:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Configure Auto Created Emails:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Invite members:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Leave application Function:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Rejoin Team:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Limit Member Size:</label>
									<?php // $teamlist['group_creation']; ?>
									<input id="group_creation" name="group_creation" class="" type="checkbox" <?php echo $teamlist['group_creation'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_creation/<?php if($teamlist['group_creation'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>-->
							
						</form>
						</div>
						</div>
						</div>
							<img src="<?php echo base_url('assets/images/loader.gif');?>" id="loader" style="display:none;" />
							