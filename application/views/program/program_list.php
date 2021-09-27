<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"></h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Program Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
						?>
									<h3>	<b>View Programs</b></h3>
									
						<form id="Grouplistform" name="Grouplistform" method="post" >
                       

						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Name</th>
									<th>Prgram Head</th>
								
                                    <th>Icon</th>
                                    <th>Action</th>
								
									
								</tr>
							</thead>
							<tbody>
				
								<tr class="odd gradeA">
									<?php
														$sr=1;
												foreach ($row as $data) {
													
													?>

																<tr>
																			<td><?=$sr ?></td>
																	
																	
																	
																	<td><?= $data['pro_name'] ?></td>
																	<td><?= $data['first_name'].' '.$data['last_name'] ?></td>
																	
                                                                    <td><img src="<?= base_url().'upload/'.$data['icon'] ?>" style="width:100px;height:100px"></td>
																	<td><a href="<?= base_url().'Program/single_program/'.$data['pid'] ?>"   class="btn btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >View Details</a> </td>
																</tr>

													<?php
													$sr++;
												}


									?>
								</tr>
								
						
                            </tbody>
						</table>
						<?php
							if(isset($userdata['links']))
								echo $userdata['links'];
						?>
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