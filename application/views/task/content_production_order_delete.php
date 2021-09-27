
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
	<th>Target Completion</th><th>Task Title</th><th>Secure Code</th><th>Program</th><th>Project</th><th>Assigned to</th><th>Status</th><th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								
							?>

									<?php

										foreach ($productionlist as $value) {
											
												?>

													<tr>
														<td><?=$value->end_date ?></td>
														<td><?=$value->title ?></td>
												
														
														<td>
												

														<?= $value->secure_code ?>
															
														</td>
														<td><?=$value->pro_name ?></td>
														<td><?=$value->project ?></td>
														<td><?= $value->user_name?></td>
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

											<?php   if($value->created_by==$this->session->userdata('id')) { ?>
															<a href="<?=  base_url('task/production_delete').'/'.$value->poid.'/'.$value->created_by ?>" style="color:white;background-color:#ef0f0f;border-color: #ef0f0f" class="	btn btn-info">Delete</a>
														

														</td>
													</tr>

												<?php

										}
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