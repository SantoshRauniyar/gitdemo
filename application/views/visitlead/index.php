<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Partner List</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong><?= isset($heading)?$heading.' '.$heading:"" ?> </strong>
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
									<th>Lead Comment</th>
									<th>Shop Pic</th>
									<th>Card Pic</th>
									
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
				
								<tr class="odd gradeA">
									<?php
										$sr=1;
									
										foreach($visited_list as $row) {
													
													?>

										<tr>
										<td><?=$sr ?></td>
										<td><?= $row->lead_comments ?></td>
										<td><img src="<?= base_url('/upload/').'/'.$row->shop_pic ?>"  style="height:50px;width:50px;" class="img img-responsive"></td>
										<td><img src="<?= base_url('/upload/').'/'.$row->card_pic ?>"  style="height:50px;width:50px;" class="img img-responsive"></td>
										
										
										
									<td>

											<?php

														switch ($view_as) {
															case 'editlist':
																?>
																<a href="<?= base_url().'visited_leads/edit/'.$row->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Edit</a>
																<?php
																break;
																case 'deletelist':
																?>
																<a href="<?= base_url().'visited_leads/destroy/'.$row->id ?>" onclick="return confirm('Are you sure to delete ?')"    class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >Delete</a>
																<?php
																break;
																case 'viewlist':
																?>
																<a href="<?= base_url().'visited_leads/view_visited_lead/'.$row->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;" >View</a>
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