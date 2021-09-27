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
									
						<form rec_id="Grouplistform" name="Grouplistform" method="post" >
                       

						<table class="table table-striped table-bordered table-hover" rec_id="dataTables-example">
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Title</th>
									<th>Response Type</th>
									<th>Avenue</th>
									<th>Reply By</th>

									<th>Action</th>

									

								</tr>
							</thead>
							<tbody>
				
								<tr class="odd gradeA">
									<?php
										$sr=1;
										foreach($recordlist as $data) {
													
													?>

										<tr>
										<td><?=$sr ?></td>
										<td><?= $data->title ?></td>
										<td><?=  $data->type_name ?></td>


									<td><?=$data->avenue_name ?></td>
										<td><?= $data->reply_by ?></td>									

									<td>

											<?php

														switch ($view_as) {
															case 'edit_list':
																?>
																<a href="<?= base_url().'task/edit_response_recorder'.'/'.$data->rec_id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Edit</a>
																<?php
																break;
																case 'delete_list':
																?>
																<a href="<?= base_url().'task/delete_response_recorder'.'/'.$data->rec_id ?>" onclick="return confirm('Are you sure to delete this ?')"  class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Delete</a>
																<?php
																break;
																case 'view_list':
																?>
																<a href="<?= base_url().'task/edit_response_recorder'.'/'.$data->rec_id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >View</a>
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