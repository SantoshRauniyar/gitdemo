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
							$edit=$editlist[0];
						?>
								<h3><b>Edit a Department</b></h3>
							<form role="form" name="editgroupform" id="editgroupform" method="post" action="<?= base_url('groups/do_update').'/'.$edit->did ?>" enctype="multipart/form-data">
                            		

								 <div id="userlist" class="form-group" style="margin-left:0;">
									<label>Select Program<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="pid">
									<?php
									foreach ($programlist as $value) {
										?>
													<option value="<?= $value->pid ?>"  <?= $value->pid==$edit->program_id?"selected":"" ?>><?= $value->pro_name ?></option>
										<?php
										}	
									?>
									</select>	
									<span class="text-danger"><?=  form_error('pid')?></span>							
								</div>

								<div class="form-group">
									<label>Department Title</label>
									<input type="text" name="dtitle" value="<?= $edit->dtitle ?>" class="form-control">
									<span class="text-danger"><?=  form_error('dtitle')?></span>
								</div>


																		 <div id="userlist" class="form-group" style="margin-left:0;">
									<label>Select Manager<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="mid">
									<?php
									foreach ($userlist as $value) {
										?>
													<option value="<?= $value->id ?>"  <?= $value->id==$edit->manager_id?"selected":"" ?>><?= $value->first_name.' '.$value->last_name ?></option>
										<?php
										}	
									?>
									</select>
									<span class="text-danger"><?=  form_error('mid')?></span>								
								</div>

										<div class="form-group">
											<input type="submit" name="submit" class="btn btn-info" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">
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