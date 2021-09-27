<div style="padding: 2%">
	<div class="row">
		<div class="col-lg-12" style="">
			<h1 class="page-header">Program Management</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<?php $ulist=$sectionlist[0]; ?>
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
						<div class="container">
								

							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('section/do_update').'/'.$ulist->id ?>">


									<div class="row">
		
			<h3 class="page-header">Edit A Section</h3>
		

	<div class="form-group">
									<label>Program:<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="program" disabled>
											
											<?php
											foreach ($program as $value) {
										?>
		<option value="<?=$value->pid ?>" <?= $ulist->program_id==$value->pro_name?'selected':''?>><?=$value->pro_name ?></option>


										<?php
											}


											?>


									</select>
									<span class="text-danger"><?=  form_error('program') ?></span>
								</div>
					
									<div class="form-group">
									<label>Department:<strong><font color='red'>*</font></strong></label>
									<select class="form-control dept" name="dept" id="dept_id" disabled>
									<?php
											foreach ($dept as $value) {
										?>

											<option value="<?=$value->did ?>"<?= $value->did==$ulist->dept_id?'selected':''?>><?=$value->dtitle ?></option>


										<?php
											}


											?>	
									</select>
									<span class="text-danger"><?=  form_error('dept') ?></span>
									
								</div>

									
														<div class="form-group">
													<label>Section Name:<strong><font color='red'>*</font></strong></label>
													<input readonly="" type="text" value="<?= $ulist->section_name ?>"  name="section_name" class="form-control">
													<span class="text-danger"><?=  form_error('section_name') ?></span>
						</div>



													<div class="form-group ">
									<label>Section Head:<strong><font color='red'>*</font></strong></label>
									<select class="form-control head" name="section_head" id="uid" disabled>
											


											<?php

												if(isset($response))
												{
													$users=json_decode($response);
												}

											foreach ($users as $value) {
										?>
											<option value="<?=$value->id ?>" <?= $ulist->section_head==$value->id?'selected':''?>><?=$value->user_name ?></option>


										<?php
											}


											?>


									</select>
								
								</div>

									

								<div class="form-group">
									<a href="<?= base_url().'/section/section_list' ?>" class="btn btn-success" style="color:white;background-color: #ef0f0f;border-color:#ef0f0f">Back</a>
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