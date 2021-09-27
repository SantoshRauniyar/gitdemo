<div>
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
				<div class="panel-heading"style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong><?php echo $heading;?></strong>	
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="editprivillagesform" id="editprivillagesform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
							<div class="form-group">
								<label>Select Role</label>

								<?php
									if(isset($userrolelist) && !empty($userrolelist))
									{
										echo form_dropdown("user_role",$userrolelist,"","class='form-control' id='user_role'");
									}
								?>		
							</div>							
							<div class="col-lg-12" id="subpanel">
								<div class="panel panel-default">
									<div class="panel-heading">
										<strong>Manage Privillages Features And Functions</strong>
										<button type="submit" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f;" id="save" name="save" class="btn btn-primary pull-right" style="margin-top:-7px;">Save Configuration</button>
									</div>
									<div class="panel-body">
										<div class="table-responsive">
											<div class="col-md-4 pull-left" style="margin-top:5px;margin-bottom:5px;">
												<label>Showing Features</label>
											</div>
											<div class="col-md-4" style="margin-bottom:5px;">
												<?php
													$privillages = array(" "=>"Select Menu ","1"=>"Programs","2"=>"Projects","3"=>"Tasks","4"=>"Team","5"=>"Location","6"=>"H360","7"=>"Haspatal Doctor","8"=>"Partner");
													echo form_dropdown("privillages_id",$privillages,'1',"class='form-control' id='menu'");
												?>
											</div>

												<!---

													____________________________________________________________________________________________
												HEREwe start code for sub menu permission
													______________________________________________________________________________________________
												-->


											<div class="col-md-4"  id="program">
												<?php
													$privillages = array(""=>"Select Privillage type","3"=>"Program","1"=>"Department","4"=>"Unit","60"=>"Section","61"=>"Haspatal Patients");
													echo form_dropdown("privillages_id",$privillages,'1',"class='form-control' id='privillages'");
												?>
											</div>
														<div class="col-md-4" style="margin-bottom:5px;display: none;" id="projects">
												<?php
													$privillages = array(""=>"Select Privillages","5"=>"Project","6"=>"Milestone");
													echo form_dropdown("privillages_id",$privillages,'1',"class='form-control' id='project'");
												?>
											</div>
											<div class="col-md-4" style="margin-bottom:5px;display: none;" id="tasks">
												<?php
													$privillages = array(""=>"Select Privillages","7"=>"General Task","8"=>"Production Task","9"=>"Publish Task","10"=>"Response Recorder","14"=>"Lead Generation","15"=>"Lead Qualification");
													echo form_dropdown("privillages_id",$privillages,'1',"class='form-control' id='task'");
												?>
											</div>
											<div class="col-md-4" style="margin-bottom:5px;display: none;" id="team">
												<?php
													$privillages = array(""=>"Select Privillages","11"=>"Team","12"=>"Member","13"=>"Role","24"=>"Hire","25"=>"Leave","92"=>"Currency","93"=>"Set Currency");
													echo form_dropdown("privillages_id",$privillages,'1',"class='form-control' id='teams'");
												?>
											</div>

											<div class="col-md-4" style="margin-bottom:5px;display: none;" id="locations">
												<?php
													$privillages = array(""=>"Select Privillages","16"=>"Country","17"=>"State","18"=>"City","19"=>"District","20"=>"Pincode","91"=>"City Zone");
													echo form_dropdown("privillages_id",$privillages,'1',"class='form-control' id='location'");
												?>
											</div>



											<div class="col-md-4" style="margin-bottom:5px;display: none;" id="haspatals">
												<?php
													$privillages = array(""=>"Select Privillages","21"=>"Registration","22"=>"Approvals",);
													echo form_dropdown("privillages_id",$privillages,'1',"class='form-control' id='haspatal'");
												?>
											</div>
											
											
										<div class="col-md-4" style="margin-bottom:5px;display: none;" id="doctors">
												<?php
													$privillages = array(""=>"Select Privillages","50"=>"Registration","51"=>"Approvals","52"=>"Pending","53"=>"Rejected");
													echo form_dropdown("privillages_id",$privillages,'1',"class='form-control' id='doctor'");
												?>
											</div>
											
											<!-- Area Partner  -->
											<div class="col-md-4" style="margin-bottom:5px;display: none;" id="partners">
												<?php
													$privillages = array(""=>"Select Privillages","54"=>"Country Partner","55"=>"State Partner","56"=>"District Partner");
													echo form_dropdown("privillages_id",$privillages,'1',"class='form-control' id='partner'");
												?>
											</div>

											

											<div class="clearfix"></div>
											<table class="table table-striped table-bordered table-hover" id="dataTables-example" >
												<thead>
													<tr>
														<th>Fetures</th>
														<th>Yes/No</th>
														<!--<th>Description</th>-->
														<!--<th>Action</th>-->
													</tr>
												</thead>
												<tbody id="group_privillages" style="">
													<tr>
														<td> Create Department</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_group_member",$yesno,"2","id='is_add_group_member'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Delete Department</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_delete_group_member",$yesno,"2","id='is_delete_group_member'");
															?>
														</td>
														
														<td>
															
														</td>
													</tr>
													<tr>													<td>Edit Department</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_group_chat_board",$yesno,"2","id='is_group_chat_board'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Department</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_theam",$yesno,"2","id='is_theam'");
															?>
														</td>
														
															
													</tr>
												</tbody>
												
												<tbody id="section_privillages" style="display:none;">
													<tr>
														<td> Create Section</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_sec",$yesno,"2","id='is_add_sec'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Delete Section</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_sec",$yesno,"2","id='is_del_sec'");
															?>
														</td>
														
														<td>
															
														</td>
													</tr>
													<tr>													<td>Edit Section</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_sec",$yesno,"2","id='is_edit_sec'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Section</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_sec",$yesno,"2","id='is_view_sec'");
															?>
														</td>
														
															
													</tr>
												</tbody>
												
												<tbody id="patients_privillages" style="display:none;">
													<tr>
														<td> Register</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_preg",$yesno,"2","id='is_preg'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Approved</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_pappr",$yesno,"2","id='is_pappr'");
															?>
														</td>
														
														<td>
															
														</td>
													</tr>
													<tr>													<td>Pending</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_ppend",$yesno,"2","id='is_ppend'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Reject</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_prej",$yesno,"2","id='is_prej'");
															?>
														</td>
														
															
													</tr>
												</tbody>
												
												
												<tbody id="task_privillages" style="display:none;">
													<tr>
														<td> Task Create</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_task_create",$yesno,"2","id='is_task_create'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Task Completion</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_complete_task",$yesno,"2","id='is_complete_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Task Approval</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_approve_task",$yesno,"2","id='is_approve_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Reassigning Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_reassign_task",$yesno,"2","id='is_reassign_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Sub-Task Create</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_sub_task",$yesno,"2","id='is_sub_task'");
															?>
														</td>
														
														
													</tr>
													<tr>
														<td> Task Discussion</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_task_discussion",$yesno,"2","id='is_task_discussion'");
															?>
														</td>
														
															
													</tr>
												</tbody>
												<tbody id="program_privillages" style="display:none;">
													<tr>
														<td>Create Program</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_pro",$yesno,"2","id='is_add_pro'");
															?>
														</td>
														
													</tr>
													
													<tr>
														<td>Edit Program</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_pro",$yesno,"2","id='is_edit_pro'");
															?>
														</td>
														
													</tr>
													<tr>
													<tr>
														<td> View Program</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_pro",$yesno,"2","id='is_view_pro'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Delete Program</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_pro",$yesno,"2","id='is_del_pro'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Program Taskboard</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_taskboard_pro",$yesno,"2","id='is_taskboard_pro'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Program Dashboard</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_dashboard_pro",$yesno,"2","id='is_dashboard_pro'");
															?>
														</td>
														
													</tr>
													
												</tbody>
												<tbody id="unit_privillages" style="display:none">
													<tr>
														<td>Create Unit </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_unit",$yesno,"2","id='is_add_unit'");
															?>
														</td>
														
													</tr>
													
													<tr>
														<td>Edit Unit </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_unit",$yesno,"2","id='is_edit_unit'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Delete Unit </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_unit",$yesno,"2","id='is_del_unit'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Unit </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_unit",$yesno,"2","id='is_view_unit'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Unit Taskboard</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_taskboard_unit",$yesno,"2","id='is_taskboard_unit'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Unit Dashboard</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_dashboard_unit",$yesno,"2","id='is_dashboard_unit'");
															?>
														</td>
														
													</tr>
													
												</tbody>
												<!--Project Permission-->
												<tbody id="project_privillages" style="display:none">
													<tr>
														<td> Create Project</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_project",$yesno,"2","id='is_add_project'");
															?>
														</td>
														
													</tr>
													
													<tr>
														<td> Edit Project </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_project",$yesno,"2","id='is_edit_project'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Project </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_project",$yesno,"2","id='is_view_project'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Delete Project </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_project",$yesno,"2","id='is_del_project'");
															?>
														</td>
														
													</tr>
													
													<tr>
														<td> Project Taskboards</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_taskboard_project",$yesno,"2","id='is_taskboard_project'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Project Dashboards</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_dashboard_project",$yesno,"2","id='is_dashboard_project'");
															?>
														</td>
														
													</tr>
												</tbody>

												<!---  MIlestone Permission-->
													<!--Mile Permission-->
												<tbody id="milestone_privillages" style="display:none">
													<tr>
														<td> Milestone Create</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_mile",$yesno,"2","id='is_add_mile'");
															?>
														</td>
														
													</tr>
													
													<tr>
														<td> Milestone Edit</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_mile",$yesno,"2","id='is_edit_mile'");
															?>
														
															
														</td>
													</tr>

													<tr>
														<td> Milestone View</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_mile",$yesno,"2","id='is_view_mile'");
															?>
														</td>
														
													</tr>

													<tr>
														<td> Milestone Delete</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_mile",$yesno,"2","id='is_del_mile'");
															?>
														</td>
														
													</tr>




														<tr>
														<td> Milestone Taskboards</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_taskboard_mile",$yesno,"2","id='is_taskboard_mile'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Milestone Dashboards</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_dashboard_mile",$yesno,"2","id='is_dashboard_mile'");
															?>
														</td>
														
													</tr>



												</tbody>
													
													<!--  General task  Create -->

																<tbody id="gtask_privillages" style="display:none;">
													<tr>
														<td>Create General Task </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_gtask",$yesno,"2","id='is_add_gtask'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Edit General Task </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_gtask",$yesno,"2","id='is_edit_gtask'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View General Task  </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_gtask",$yesno,"2","id='is_view_gtask'");
															?>
														</td>

													</tr>
													<tr>
														<td>Complete General Task </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_comp_gtask",$yesno,"2","id='is_comp_gtask'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Delete General Task  </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_gtask",$yesno,"2","id='is_del_gtask'");
															?>
														</td>
														

													</tr>
													<tr>
														<td>Approve General Task </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_approve_gtask",$yesno,"2","id='is_approve_gtask'");
															?>
														</td>
														
													</tr>
													
													
												</tbody>

												<!-- production permission-->

														<tbody id="mtask_privillages" style="display:none;">
													<tr>
														<td>Create Production Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_mtask",$yesno,"2","id='is_add_mtask'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Edit Production Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_mtask",$yesno,"2","id='is_edit_mtask'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Production Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_mtask",$yesno,"2","id='is_view_mtask'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Complete Production Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_comp_mtask",$yesno,"2","id='is_comp_mtask'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Approve Production Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_approve_mtask",$yesno,"2","id='is_approve_mtask'");
															?>
														</td>

													</tr>
													<tr>
														<td>Abort Production Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_mtask",$yesno,"2","id='is_del_mtask'");
															?>
														</td>
														
													</tr>
													
												</tbody>

												<!-- publish permission-->

														<tbody id="pub_task_privillages" style="display:none;">
													<tr>
														<td>Create Publish Task</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_pub_task",$yesno,"2","id='is_add_pub_task'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit Publish Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_pub_task",$yesno,"2","id='is_edit_pub_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Publish Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_pub_task",$yesno,"2","id='is_view_pub_task'");
															?>
														</td>
														
													</tr>

													<tr>
														<td>Complete Publish Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_comp_pub_task",$yesno,"2","id='is_comp_pub_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Approve Publish Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_approve_pub_task",$yesno,"2","id='is_approve_pub_task'");
															?>
														</td>

													</tr>
													<tr>
														<td>Abort Publish Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_pub_task",$yesno,"2","id='is_del_pub_task'");
															?>
														</td>

													</tr>
													
												</tbody>


												<!--  response recorder permission -->


														<!-- response recorder permission-->

														<tbody id="response_task_privillages" style="display:none;">
													<tr>
														<td>Create Response Recorder Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_response_task",$yesno,"2","id='is_add_response_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Edit Response Recorder Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_response_task",$yesno,"2","id='is_edit_response_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Response Recorder Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_response_task",$yesno,"2","id='is_view_response_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Delete Response Recorder Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_response_task",$yesno,"2","id='is_del_response_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Approve Response Recorder Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_approve_response_task",$yesno,"2","id='is_approve_response_task'");
															?>
														</td>
														
													</tr>
													
													
												</tbody>


												<!--    Team Privillages-->

														<!-- team permission-->

														<tbody id="team_privillages" style="display:none;">
													<tr>
														<td>Create Team</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_team",$yesno,"2","id='is_add_team'");
															?>
														</td>
														
													</tr>
													
														<tr>
														<td>Edit Team </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_team",$yesno,"2","id='is_edit_team'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Team</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_team",$yesno,"2","id='is_view_team'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Delete Team</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_team",$yesno,"2","id='is_del_team'");
															?>
														</td>
														
													</tr>
													
												</tbody>

													<!-- member permission-->

														<tbody id="member_privillages" style="display:none;">
													<tr>
														<td>Create Member</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_member",$yesno,"2","id='is_add_member'");
															?>
														</td>

													</tr>
													
													<tr>
														<td>Edit Member </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_member",$yesno,"2","id='is_edit_member'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Member</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_member",$yesno,"2","id='is_view_member'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Delete Member</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_member",$yesno,"2","id='is_del_member'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Block Member</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_member_block",$yesno,"2","id='is_member_block'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Unblock Member</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_member_unblock",$yesno,"2","id='is_member_unblock'");
															?>
														</td>
														
													</tr>
													
												</tbody>

																	<!-- member permission

														<tbody id="member_privillages" style="display:none;">
													<tr>
														<td> Member  Create</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_member",$yesno,"2","id='is_add_member'");
															?>
														</td>
														
													</tr>
													

													<tr>
														<td>  Member  Delete</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_member",$yesno,"2","id='is_del_member'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Edit Member </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_member",$yesno,"2","id='is_edit_member'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Member  View </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_member",$yesno,"2","id='is_view_member'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>  Member Unblock </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_member_unblock",$yesno,"2","id='is_member_unblock'");
															?>
														</td>
														
													</tr>
													<tr>
														<td> Member  Block </td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_member_block",$yesno,"2","id='is_member_block'");
															?>
														</td>
														
													</tr>
												</tbody>
											 role permission-->

														<tbody id="role_privillages" style="display:none;">
													<tr>
														<td>Create Role</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_role",$yesno,"2","id='is_add_role'");
															?>
														</td>
														
													</tr>
													
																	<tr>
														<td>Edit Role</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_role",$yesno,"2","id='is_edit_role'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Role</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_role",$yesno,"2","id='is_view_role'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Delete Role</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_role",$yesno,"2","id='is_del_role'");
															?>
														</td>
														
													</tr>
													
													
													<!--Assign Permission-->
												<tr>
														<td>Create Assign</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_add_assign",$yesno,"2","id='is_add_assign'");
															?>
														</td>
														
													</tr>
													
																	<tr>
														<td>Edit Assign</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_assign",$yesno,"2","id='is_edit_assign'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Assign</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_assign",$yesno,"2","id='is_view_assign'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>Delete Assign</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_assign",$yesno,"2","id='is_del_assign'");
															?>
														</td>
														
													</tr>
													
												</tbody>




																					<tbody id="lead_generation_task_privillages" style="display:none;">
													<tr>
														<td>Create Lead generation Task</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_lead_gen_task",$yesno,"2","id='is_add_lead_gen_task'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit Lead generation Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_lead_gen_task",$yesno,"2","id='is_edit_lead_gen_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Lead generation Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_lead_gen_task",$yesno,"2","id='is_view_lead_gen_task'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete Lead generation Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_lead_gen_task",$yesno,"2","id='is_del_lead_gen_task'");
															?>
														</td>

													</tr>
													
												</tbody>

																				<tbody id="lead_qualification_task_privillages" style="display:none;">
													<tr>
														<td>Create Lead qualification Task</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_lead_quali_task",$yesno,"2","id='is_add_lead_quali_task'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit Lead qualification Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_lead_quali_task",$yesno,"2","id='is_edit_lead_quali_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Lead qualification Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_lead_quali_task",$yesno,"2","id='is_view_lead_quali_task'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete Lead qualification Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_lead_quali_task",$yesno,"2","id='is_del_lead_quali_task'");
															?>
														</td>

													</tr>
													
												</tbody>
															<tbody id="h360_reg_privillages" style="display:none;">
													<tr>
														<td>View Registration</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_hview_reg",$yesno,"2","id='is_hview_reg'");
															?>
														</td>
														
													</tr>
												</tbody>
													<tbody id="h360_approval_privillages" style="display:none;">
													<tr>
														<td>View Approval</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_hview_approval",$yesno,"2","id='is_hview_approval'");
															?>
														</td>
														
													</tr>
												</tbody>



																					<tbody id="lead_generation_task_privillages" style="display:none;">
													<tr>
														<td>Create Lead generation Task</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_lead_gen_task",$yesno,"2","id='is_add_lead_gen_task'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit Lead generation Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_lead_gen_task",$yesno,"2","id='is_edit_lead_gen_task'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Lead generation Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_lead_gen_task",$yesno,"2","id='is_view_lead_gen_task'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete Lead generation Task</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_lead_gen_task",$yesno,"2","id='is_del_lead_gen_task'");
															?>
														</td>

													</tr>
													
												</tbody>

																				<tbody id="country_privillages" style="display:none;">
													<tr>
														<td>Add Country</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_country",$yesno,"2","id='is_add_country'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit Country</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_country",$yesno,"2","id='is_edit_country'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Country</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_country",$yesno,"2","id='is_view_country'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete COuntry</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_country",$yesno,"2","id='is_del_country'");
															?>
														</td>

													</tr>
													
												</tbody>
												<tbody id="state_privillages" style="display:none;">
													<tr>
														<td>Add State</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_state",$yesno,"2","id='is_add_state'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit State</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_state",$yesno,"2","id='is_edit_state'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View State</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_state",$yesno,"2","id='is_view_state'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete State</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_state",$yesno,"2","id='is_del_state'");
															?>
														</td>

													</tr>
													
												</tbody>

															<tbody id="district_privillages" style="display:none;">
													<tr>
														<td>Add District</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_district",$yesno,"2","id='is_add_district'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit District</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_district",$yesno,"2","id='is_edit_district'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View District</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_district",$yesno,"2","id='is_view_district'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete District</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_district",$yesno,"2","id='is_del_district'");
															?>
														</td>

													</tr>
													
												</tbody>

												<tbody id="city_privillages" style="display:none;">
													<tr>
														<td>Add City</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_city",$yesno,"2","id='is_add_city'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit City</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_city",$yesno,"2","id='is_edit_city'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View City</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_city",$yesno,"2","id='is_view_city'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete City</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_city",$yesno,"2","id='is_del_city'");
															?>
														</td>

													</tr>
													
												</tbody>
												<tbody id="pincode_privillages" style="display:none;">
													<tr>
														<td>Add Pincode</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_pincode",$yesno,"2","id='is_add_pincode'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit Pincode</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_pincode",$yesno,"2","id='is_edit_pincode'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Pincode</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_pincode",$yesno,"2","id='is_view_pincode'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete Pincode</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_pincode",$yesno,"2","id='is_del_pincode'");
															?>
														</td>

													</tr>
													
												</tbody>
												<tbody id="cityzone_privillages" style="display:none;">
													<tr>
														<td>Add cityzone</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_cityzone",$yesno,"2","id='is_add_cityzone'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit cityzone</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_cityzone",$yesno,"2","id='is_edit_cityzone'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View cityzone</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_cityzone",$yesno,"2","id='is_view_cityzone'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete Cityzone</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_cityzone",$yesno,"2","id='is_del_cityzone'");
															?>
														</td>

													</tr>
													
												</tbody>
                                                                <tbody id="hire_privillages" style="display:none;">
													<tr>
														<td>Add Hire</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_hire",$yesno,"2","id='is_hire'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit Hire</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_hire",$yesno,"2","id='is_edit_hire'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Hire</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_hire",$yesno,"2","id='is_view_hire'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete Hire</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_delete_hire",$yesno,"2","id='is_delete_hire'");
															?>
														</td>

													</tr>
													
												</tbody>
												<tbody id="leave_privillages" style="display:none;">
													<tr>
														<td>Take Leave</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_take_leave",$yesno,"2","id='is_take_leave'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit Leave</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_leave",$yesno,"2","id='is_edit_leave'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Leave</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_leave",$yesno,"2","id='is_view_leave'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete Leave</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_delete_leave",$yesno,"2","id='is_delete_leave'");
															?>
														</td>

													</tr>
													
												</tbody>
												
												
												
													<tbody id="h360_reg_privillages" style="display:none;">
													<tr>
														<td>View Registration</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_hview_reg",$yesno,"2","id='is_hview_reg'");
															?>
														</td>
														
													</tr>
												</tbody>
													<tbody id="doctor_appr_privillages" style="display:none;">
													<tr>
														<td>View Approval</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_dr_appr",$yesno,"2","id='is_dr_appr'");
															?>
														</td>
														
													</tr>
												</tbody>
								<tbody id="doctor_reg_privillages" style="display:none;">
													<tr>
														<td>View Registration</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_dr_reg",$yesno,"2","id='is_dr_reg'");
															?>
														</td>
														
													</tr>
												</tbody>
												
												<!--    -->
								<tbody id="doctor_pend_privillages" style="display:none;">
													<tr>
														<td>View Pending</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_dr_pend",$yesno,"2","id='is_dr_pend'");
															?>
														</td>
														
													</tr>
												</tbody>
								<tbody id="doctor_rej_privillages" style="display:none;">
													<tr>
														<td>View Rejected</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_dr_rej",$yesno,"2","id='is_dr_rej'");
															?>
														</td>
														
													</tr>
												</tbody>
												<tbody id="country_partner_privillages" style="display:none;">
													<tr>
														<td>Add Country Partner</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_country_partner",$yesno,"2","id='is_add_country_partner'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit Country Partner</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_country_partner",$yesno,"2","id='is_edit_country_partner'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View Country Partner</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_country_partner",$yesno,"2","id='is_view_country_partner'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete Country Partner</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_country_partner",$yesno,"2","id='is_del_country_partner'");
															?>
														</td>

													</tr>
													
												</tbody>
													<tbody id="state_partner_privillages" style="display:none;">
													<tr>
														<td>Add State Partner</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_state_partner",$yesno,"2","id='is_add_state_partner'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit State Partner</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_state_partner",$yesno,"2","id='is_edit_state_partner'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View State Partner</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_state_partner",$yesno,"2","id='is_view_state_partner'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete State Partner</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_state_partner",$yesno,"2","id='is_del_state_partner'");
															?>
														</td>

													</tr>
													
												</tbody>
												
													<tbody id="district_partner_privillages" style="display:none;">
													<tr>
														<td>Add District Partner</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_district_partner",$yesno,"2","id='is_add_district_partner'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit District Partner</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_district_partner",$yesno,"2","id='is_edit_district_partner'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View District Partner</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_district_partner",$yesno,"2","id='is_view_district_partner'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete District Partner</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_district_partner",$yesno,"2","id='is_del_district_partner'");
															?>
														</td>

													</tr>
													
												</tbody>
												
												<tbody id="setcurrency_privillages" style="display:none;">
													<tr>
														<td>Add setcurrency</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_setcurrency",$yesno,"2","id='is_add_setcurrency'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit setcurrency</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_setcurrency",$yesno,"2","id='is_edit_setcurrency'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View setcurrency</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_setcurrency",$yesno,"2","id='is_view_setcurrency'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete SetCurrency</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_setcurrency",$yesno,"2","id='is_del_setcurrency'");
															?>
														</td>

													</tr>
													
												</tbody>
												<tbody id="currency_privillages" style="display:none;">
													<tr>
														<td>Add currency</td>
														<td>
												<?php
													$yesno = array("1"=>"Yes","2"=>"No");
										echo form_dropdown("is_add_currency",$yesno,"2","id='is_add_currency'");
															?>
														</td>
														
													</tr>
														
														<tr>
														<td> Edit currency</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_edit_currency",$yesno,"2","id='is_edit_currency'");
															?>
														</td>
														
													</tr>
													<tr>
														<td>View currency</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_view_currency",$yesno,"2","id='is_view_currency'");
															?>
														</td>
														
													</tr>

													
													<tr>
														<td>Delete Currency</td>
														<td>
															<?php
																$yesno = array("1"=>"Yes","2"=>"No");
																echo form_dropdown("is_del_currency",$yesno,"2","id='is_del_currency'");
															?>
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
									<label>Groups Create:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Sub Group Create:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Group Discussion Board:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="clearfix"></div>
							<div class="col-lg-12">
								<h4 class="page-header">Task Related Settings</h4>
							</div>
							<div class="form-group col-md-6">
									<label>Reassign tasks:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Create Sub tasks:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Approve tasks after Completion:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Task Discussion Board:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Task Reminder Function:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Task followers:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Reassign all tasks of a member to another member:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Auto Abort Tasks:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Budgeted Tasks:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="clearfix"></div>
							
							<div class="col-lg-12">
								<h4 class="page-header">Other Function Settings</h4>
							</div>
							<div class="form-group col-md-6">
									<label>Announcements:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Multi-Time Zone:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Multi Currency:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>MIS Charts:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Theme Selection:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Chat Function:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Configure Auto Created Emails:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							
							<div class="form-group col-md-6">
									<label>Invite members:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Leave application Function:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Rejoin Team:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>
							<div class="form-group col-md-6">
									<label>Limit Member Size:</label>
									<?php // $teamlist['group_create']; ?>
									<input id="group_create" name="group_create" class="" type="checkbox" <?php echo $teamlist['group_create'] == "1"? "checked" : '';?> onclick="setValue('<?php echo base_url();?>','team/set_configuration/group_create/<?php if($teamlist['group_create'] == 1){echo 0;}else{echo 1;}?> '); ">Yes							
							</div>-->
							
						</form>
						</div>
						</div>
						</div>
							<img src="<?php echo base_url('assets/images/loader.gif');?>" id="loader" style="display:none;" />
							