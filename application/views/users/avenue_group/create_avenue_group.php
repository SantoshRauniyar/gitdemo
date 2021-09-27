
<div style="padding: 2%">
	<div class="row">
		<div class="col-lg-12" style="">
			<h1 class="page-header">Department Taskboard</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Department Taskboard</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" >
					<div class="row">
						<div class="col-lg-12">
								

						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= $action ?>" enctype="multipart/form-data">	
								<h4><b><?= $heading?></b></h4>
							<div class="form-group">	
									<label>Avenue Group Name:<strong><font color='red'>*</font></strong></label>
			<input type="text" class="form-control" name="group_name"  >
									<span class="text-danger"><?= form_error('group_name') ?></span>
								</div>

								<div class="form-group">
									<label>Select Multiple Avenue</label>
									<select class="form-control" name="avenue_name[]" multiple="" >
										<option value="" hidden="">Select Avenue</option>
										<?php

											foreach ($avenue as $value) {
												?>
													<option value="<?= $value->avenue_name ?>"><?=  $value->avenue_name  ?></option>

												<?php
											}

										?>
									</select>
									<span class="text-danger"><?= form_error('avenue_name') ?></span>

								</div>


								<div class="form-group">
									<label>Remarks</label>
									<textarea class="form-control" rows="5" name="remarks"></textarea>
									<span class="text-danger"><?= form_error('remarks') ?></span>
								</div>
								

           						     	
           						<div class="form-group">
           						
<input type="submit" name="submit"  value="Create Group" class="btn btn-info " style="color:white;background-color: #ef0f0f;border-color: #ef0f0f" >

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