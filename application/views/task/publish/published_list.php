<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Content Category List</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Content Management </strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
							if ($this->session->userdata('failedavenue')) {
								echo "Avenue not available!!";
							}
						?>
									<h3>	<b><?= isset($heading)?$heading:"" ?></b></h3>
									
						<form id="Grouplistform" name="Grouplistform" method="post" >
                       

						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Task ID</th>
									<th>Task Name</th>
									<th>Category</th>
									<th>Channel</th>
									<th>Avenue</th>
									<th>Assign to</th>
									<th>Program</th>
									<th>Status</th>
									<th>Action</th>

									

								</tr>
							</thead>
							<tbody>
				
								<tr class="odd gradeA">
									<?php
										$sr=1;
										foreach($published_list as $data) {
													
													?>

										<tr>
										<td><?=$sr ?></td>
										<td><?= $data->task_id ?></td>
										<td><?=  $data->task_name ?></td>


									<td><?=$data->cname ?></td>
										<td><?= $data->channel_name ?></td>
										
							
										<td><?= $data->group_name ?></td>
										<td><?=  $data->user_name ?></td>
										<td><?=  $data->pro_name ?></td>
										<td><?php

																switch ($data->status) {
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

											<?php

														switch ($view_as) {
															case 'edit_list':
																?>
																<a href="<?= base_url().'task/edit_published_content'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Edit</a>
																<?php
																break;
																case 'delete_list':
																?>
																<a href="<?= base_url().'task/delete_published_content'.'/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Delete</a>
																<?php
																break;
																case 'view_list':
																?>
																<a href="<?= base_url().'task/view_published_content/'.$data->id.'/static_view' ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >View</a>
																<?php
																break;
														
														}



											?>




									</td>
																</tr>

													<?php
													$sr++;
												}


									?>
								</tr>
								
						
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