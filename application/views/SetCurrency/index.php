<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Currency List</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong><?= isset($heading)?$heading:"" ?> </strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
							
						?>
									
									
						<form id="Grouplistform" name="Grouplistform" method="post" >
                       

						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Currency Name</th>
									<th>Currency Value</th>
									
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
				
								<tr class="odd gradeA">
									<?php
										$sr=1;
									
										foreach($currencylist as $data) {
													
													?>

										<tr>
										<td><?=$sr ?></td>
											
										<td><?= $data->cname ?></td>
										<td><?= $data->cur_data ?></td>
									<td>

											<?php

														switch ($view_as) {
															case 'editlist':
																?>
																<a href="<?= base_url().'Currency/edit/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Edit</a>
																<?php
																break;
																case 'deletelist':
																?>
																<a href="<?= base_url().'Currency/destroy/'.$data->id ?>" onclick="return confirm('Are you sure to delete ?')"    class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Delete</a>
																<?php
																break;
																case 'viewlist':
																?>
																<a href="<?= base_url().'Currency/view_assign/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >View</a>
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