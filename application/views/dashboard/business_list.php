
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
					<strong>Business Registrants </strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
							if ($this->session->userdata('failedcountry')) {
								echo "Replies not available!!";
							}
						?>
									<h3>	<b><?= isset($heading)?$heading:"" ?></b></h3>
								Total Business Register	<?= $sr=count($business) ?>
					
                       

						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Registration Time</th>
									<th>Business Name</th>
								<?php if($this->session->userdata('id')==126){ ?>	<th>Owner Name</th>
										<th>Mobile</th><th>Email</th> <?php  } ?>
																	<th>State </th>
									
									<th>City </th>
									<th>Pincode</th>
	
								</tr>
							</thead>
							<tbody>
				
								<tr class="odd gradeA">
									<?php
										//$sr=1;
										foreach($business as $data) {
													
													?>

										<tr>
										<td><?=$sr-- ?></td>
										<td><?=  $data->created_at ?></td>
										<td><?= $data->b_name ?></td>
										<?php if($this->session->userdata('id')==126){ ?>	<td><?= $data->first_name ?></td>
									<td><a href="tel:<?= $data->mobile ?>"><?= $data->mobile ?></a></td>
									<td><a href="mailto:<?= $data->mobile ?>"><?= $data->email ?></a></td> 
								
									<?php } ?>
									
													
										<td><?=  $data->state ?></td>
											<td><?=  $data->city ?></td>

										<td><?= $data->pincode ?></td>
																
																</tr>

													<?php
												
												}


									?>
								
								
						
                            </tbody>
						</table>
					
				
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