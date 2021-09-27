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
					<strong>Marketing Task Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
							if ($this->session->userdata('failedchannel')) {
								echo "Channel not available!!";
							}


						?>
									<h3>	<b><?= isset($heading)?$heading:"" ?></b></h3>
									
						<form id="Grouplistform" name="Grouplistform" method="post" >
                       

						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Qualified Lead ID</th>
									<th>Date & Time</th>
									<th>Priority</th>
									<th>Assign To</th>
									<th>Lead Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
						<?php

													if (!empty($lead_list)){

						?>
								<tr class="odd gradeA">
									<?php
										$sr=1;
										foreach($lead_list as $data) {
													
													?>

										<tr>
										<td><?=$sr ?></td>
										<td><?= $data->qlead_id ?></td>
										<td><?= $data->created_at ?></td>
<td>
										
										<?php  

													switch ($data->priority) {
														

															case 1:
															echo "Low";
															break;
															case 2:
															echo "Medium";
															break;
															case 3:
															echo "High";
															break;
															case 4:
															echo "Urgent";
															break;
																									
														default:
															echo "Not Valid";
															break;
													}
												?>
											</td>
										<td><?= $data->dtitle ?></td>
										<td>
												
												<?php  

													switch ($data->action_on_lead) {
														

															case 1:
															echo "Qualified";
															break;
															case 2:
															echo "Rejected";
															break;
															case 3:
															echo "Edited & Qualified";
															break;
															case 4:
															echo "Blacklisted";
															break;
															case 5:
															echo "Hold";
															break;	
																											
														default:
															echo "not valid";
															break;
													}
												?>


										</td>
									<td>

											<?php

														switch ($view_as) {
															case 'edit_list':
																?>
																<a href="<?= base_url().'task/edit_lead_qualified/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Edit</a>
																<?php
																break;
																case 'delete_list':
																?>
																<a href="<?= base_url().'task/delete_qualified_lead/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Delete</a>
																<?php
																break;
																case 'view_list':
																?>
																<a href="<?= base_url().'task/view_lead_qualified/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >View</a>
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
								
						<?php } ?>
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