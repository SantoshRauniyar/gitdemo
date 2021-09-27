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
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" >


					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
							$dept=$userdata[0];

						
						?>
								<h3><b>View A Department</b></h3>
							<form role="form" name="editgroupform" id="editgroupform" method="post" action="do_save" enctype="multipart/form-data">
                            		

								 <div id="userlist" class="form-group" style="margin-left:0;">
									<label>Program<strong><font color='red'>*</font></strong></label>
									<input type="text" name="" readonly="" value="<?= $dept->pro_name ?>" class="form-control">	
									<span class="text-danger"><?=  form_error('pid')?></span>							
								</div>
								

								<div class="form-group">
									<label>Department Title</label>
									<input type="text" name="dtitle"  class="form-control" readonly="" value="<?= $dept->dtitle ?>">
									<span class="text-danger"><?=  form_error('dtitle')?></span>
								</div>

                    <div class="form-group">
								            <label>Section</label>
								            <input  type="radio" name="sec" value="1" <?=$dept->is_sec==1?"checked":"" ?> disabled=""> Yes  <input disabled="" type="radio" value="0" name="sec" <?=$dept->is_sec==0?"checked":"" ?>> No
 								        </div>
																		 <div id="userlist" class="form-group" style="margin-left:0;">
									<label> Manager<strong><font color='red'>*</font></strong></label>
									<input type="text" name="" class="form-control" value="<?= $dept->user_name ?>" readonly="">
									<span class="text-danger"><?=  form_error('mid')?></span>								
								</div>

										<div class="form-group">
											<a href="<?= base_url('groups/all') ?>" class="btn btn-info" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">Close</a>
										</div>


							</form>
						</div>     
					</div>
                    <!-- /.row (nested) -->
				</div>
                <!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	</div>
	<!-- /#page-wrapper -->
</div>
</div>