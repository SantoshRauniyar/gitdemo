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
									<th>Lead ID</th>
									<th>Date & Time</th>
									<th>source</th>
									<th>Lead Name</th>
							    <th>Subject</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
				
								<tr class="odd gradeA">
									<?php
										$sr=1;
										foreach($lead_list as $data) {
													
													?>

										<tr>
										<td><?=$sr ?></td>
							<td><?= empty($data->lead_code)?str_pad($data->id+1, 8, '0', STR_PAD_LEFT):$data->lead_code ?></td>
										<td><?= $data->created_at ?></td>
										<td>
												<?php

													switch ($data->source) {
														case 1:
														echo "Marketing Response Type";
															break;

															case 2:
														echo "Refferal";
															break;

															case 3:
														echo "Websites";
															break;
														
														default:
														echo "Not valid";
															break;
													}

												?>


										</td>
										<td><?= $data->lead_name ?></td>
										<td><?= $data->service_type ?></td>
								
										<td>
												
												<?php  

													switch ($data->status) {
														

															case 0:
															echo "Lead Generated";
															break;
															case 2:
															echo "Qualified";
															break;
															case 3:
															echo "Under Nurture";
															break;
															case 4:
															echo "Converted";
															break;
															case 5:
															echo "Rejected";
															break;	
															case 6:
															echo "Aborted";
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
																<a href="<?= base_url().'task/edit_lead_generation/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Edit</a>
																<?php
																break;
																case 'delete_list':
																?>
																<a href="<?= base_url().'task/delete_lead_generation/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Delete</a>
																<?php
																break;
																case 'view_list':
																?>
																<a href="<?= base_url().'task/view_lead_generation/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >View</a>
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