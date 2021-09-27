
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
					<strong>Task Management</strong>
					<div class="row text-right">
						<div class="container pull-right" ><div class="col-md-4"></div><div class="col-md-2"><a href="#" style="color:yellow;text-decoration: none;font-weight: bold;" id="noti"><h4>Today</h4></a></div><div class="col-md-2"><a href="" style="color:white;text-decoration: none;font-weight: bold;" id="noti" onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'"><h4>Tomorrow</h4></a></div><div class="col-md-2"><a onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti"><h4>This Week</h4></a></div><div class="col-md-2"><a onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti"><h4>This Month</h4></a></div></div>
			</div>

				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
					<?php 
							$this->load->view('common/errors');
					?>
						<form id="Tasklistform" name="Tasklistform" method="post" >
                       
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
	<th>Target Completion</th><th>Task Title</th><th>Created By</th><th>Created On</th><th>Priority</th><th>Program</th><th>Project</th><th>Assigned to</th><th>Status</th><th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								
							?>

									<?php

										foreach ($tasklist as $value) {
											
												 $uname='';
										    $user=$this->users_model->get_userdetails_by_id($value->created_by);
										    if(isset($user) and !empty($user))
										    {
										        $uname=$user['first_name'].' '.$user['last_name'];
										    }
										    
											
											
												?>

													<tr <?= $this->users_model->setColorDanger($value->priority); ?>>
														<td><?=$value->end_date ?></td>
														<td><?=$value->title ?></td>
														<td><?=$uname ?></td>
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
																		default:
																		    echo"Low";
																	
																}

															?>
														</td>
														<td><?=$value->pro_name ?></td>
														<td><?=$value->project_name ?></td>
														<td><?= $value->first_name.'  '.$value->last_name?></td>
														<td><?php

																switch ($value->status) {
																	case '0':
																		echo "Not Assigned";
																		break;
																		case '1':
																		echo "Assigned";
																		break;
																		case '2':
																		echo "Opened";
																		break;
																		case '3':
																		echo "Mark As Completed";
																		break;
																		case '4':
																		echo "Approved";
																		break;
																			case '5':
																		echo "Aborted";
																		break;	case '6':
																		echo "Rejected";
																		break;
																	
																}

															?></td>
														<td>											
														
		<?php if($value->assign_uid==$this->session->userdata('id') or $this->users_model->is_deptHead($value->department))  { ?>

										<?php

												if ($value->status!=3 and $value->status==4) {
								?>
										

								
										<p  name="Completed"  class="badge badge-info" style="border-color: #ef0f0f;cursor:pointer; background-color:red;color:white;">Completed</p>
							
<?php }  else  {   



	?>

								<a  href="<?= base_url('task/change_status').'/'.$value->id.'/'.'3' ?>"  onclick="return confirm('Are You sure to Completed ?')" class="badge badge-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Complete</a>
										
						
										<?php } } ?>
						
							
											<input type="hidden" value="<?= $value->id ?>" name="task_id">
											<?php if($value->created_by==$this->session->userdata('id'))  { ?>

										<?php

												if ($value->status==3) {
								?>
										

							
										<a  href="<?= base_url('task/change_status').'/'.$value->id.'/'.'4' ?>"  onclick="return confirm('Are You sure to Approve ?')" class="badge badge-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Approve</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<a  href="<?= base_url('task/change_status').'/'.$value->id.'/'.'5' ?>" onclick="return confirm('Are You sure to Reject ?')"  class="badge badge-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Reject</a>
										
							
<?php }  else {?>

								
										<a  href="<?= base_url('task/change_status').'/'.$value->id.'/'.'6' ?>"  class="badge badge-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;" onclick="return confirm('Are You sure to Reject ?')">Abort</a>
						
										<?php } } ?>
			

			</td>
													</tr>

												<?php

										}

									?>
                            </tbody>
						</table>
						
						

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