
<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Tasks</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color: #ef0f0f;border-color:#ef0f0f;color:white;vertical-align:all;">
					<strong>Department Taskboard </strong>
					<div class="row text-right">
						<div class="container pull-right" ><div class="col-md-4"></div><div class="col-md-2"><a href="#" style="color:<?= $this->uri->segment(3)=="today"?"red":"yellow" ?>;text-decoration: none;font-weight: bold;" id="noti"><h4>Today</h4></a></div><div class="col-md-2"><a href="" style="color:white;text-decoration: none;font-weight: bold;"  id="noti" onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'"><h4>Tomorrow</h4></a></div><div class="col-md-2"><a onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti"><h4>This Week</h4></a></div><div class="col-md-2"><a onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti"><h4>This Month</h4></a></div></div>
			</div>

				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
					<?php 
							$this->load->view('common/errors');
					?>

						<div class="row">
							

							<!--<div class="form-group col-md-2">
								<label>
									Select Department
								</label>
								<select name="department"  id="deptlist" class="department form-control">
									
									<option>Select Please</option>
									

								</select>
							</div>-->


							<!--<div class="form-group col-md-2">
								<label>
									Select Unit
								</label>
								<select name="unit"  id="unitlist" class="unit form-control">
									
									<option>Select Please</option>
									

								</select>
							</div>-->


	<!--<div class="form-group col-md-2">
								<label>
									Select Project
								</label>
								<select name="project"  id="projectlist" class="project form-control">
									
									<option>Select Please</option>
									

								</select>
							</div>-->

								<div class="form-group col-md-2">
								<label>
									Select Milestone
								</label>
								<select name="Milestone"  id="milestonelist" class="milestone form-control">
									
									<option>Select Please</option>
									

								</select>
							</div>

						</div>


						<form id="Tasklistform" name="Tasklistform" method="post" >
                       
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
	<th>Target Completion</th><th>Task Title</th><th>Created By</th><th>Created On</th><th>Priority</th><th>Program</th><th>Project</th><th>Assigned to</th><th>Status</th><th>Action</th>
								</tr>
							</thead>
							<tbody id="settasklist">
							<?php
										foreach ($tasklist as $value) {
											
												?>

													<tr>
														<td><?=$value->end_date ?></td>
														<td><?=$value->title ?></td>
														<td><?=$value->created_by ?></td>
														<td><?=$value->created_at ?></td>
														<td>
															<?php

																switch ($value->priority) {
																	case '0':
																		echo "Low";
																		break;
																		case '1':
																		echo "Medium";
																		break;
																		case '2':
																		echo "High";
																		break;
																		case '3':
																		echo "Very High";
																		break;
																		case '4':
																		echo "Urgent";
																		break;
																	
																}

															?>
														</td>
														<td><?=$value->pro_name ?></td>
														<td><?=$value->project_name ?></td>
														<td><?= $value->user_name?></td>
														<td><?=$value->status==0?"Not Assigned":"Assigned" ?></td>
														<td><a href="" style="color:white;background-color:#ef0f0f;border-color: #ef0f0f" class="	btn btn-info">Open Task</a></td>
													</tr>

										<?php  } ?>

                            </tbody>
						</table>
						<?php if(isset($userdata['links'])){echo $userdata['links'];}?>
						<div id="#task_reassigning_model" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm">
    							<div class="modal-content">
									<div class="modal-header">
        								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        								<h4 class="modal-title">Task Discussion</h4>
      								</div>
      								<div class="modal-body">	
      								</div>
									<div class="modal-footer">
										<div class="input-group">
											<input id="task_id" name="task_id" type="hidden" value="">
											<input id="comment" name="comment" type="text" class="form-control input-sm" placeholder="Type your comment here..." />
											<span class="input-group-btn">
												<button id="send" name="send" type="submit" class="btn btn-warning btn-sm" id="btn-chat">
												Send
												</button>
											</span>
										</div>
      								</div>
	    						</div>
  							</div>
						</div>
						<div id="task_discussion_model" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm">
    							<div class="modal-content">
									<div class="modal-header">
        								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        								<h4 class="modal-title">Task Discussion</h4>
      								</div>
      								<div class="modal-body">	
      								</div>
									<div class="modal-footer">
										<div class="input-group">
											<input id="task_id" name="task_id" type="hidden" value="">
											<input id="comment" name="comment" type="text" class="form-control input-sm" placeholder="Type your comment here..." />
											<span class="input-group-btn">
												<button id="send" name="send" type="submit" class="btn btn-warning btn-sm" id="btn-chat">
												Send
												</button>
											</span>
										</div>
      								</div>
	    						</div>
  							</div>
						</div>
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
