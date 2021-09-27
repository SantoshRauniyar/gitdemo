<div style="padding: 2%">
	<div class="row">
		<div class="col-lg-12" style="">
			<h1 class="page-header">Program Management</h1>
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
					<div

					 class="row">
						<div class="col-lg-12">
								<?php  
								$data=$unitlist[0];
							
							 ?>
							 			<h3>Edit an Unit</h3>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('unit/do_update/'.$data->id) ?>">

						<div class="form-group">
													<label>Unit Name:<strong><font color='red'>*</font></strong></label>
													<input 	 readonly="" type="text" value="<?=$data->unit_name?>"  name="unit_name" class="form-control">
													<span class="text-danger"><?=  form_error('unit_name') ?></span>
						</div>

							<div class="form-group">
									<label>Program:<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="program" disabled="">
											
											<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pro_name ?> " <?= $data->program==$value->pro_name?'selected':''?> ><?=$value->pro_name ?>
												
											</option>


										<?php
											}


											?>


									</select>
									<span class="text-danger"><?=  form_error('program') ?></span>
								</div>
								<div class="form-group">
									<label>Department:<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="dept" disabled="">
									<?php
											foreach ($dept as $value) {
										?>
											<option value="<?=$value->did ?>" <?= $data->dept==$value->did?'selected':''?>><?=$value->dtitle ?></option>


										<?php
											}


											?>	
									</select>
									<span class="text-danger"><?=  form_error('unit_name') ?></span>
									
								</div>
								    
								    <div class="form-group">
								        <label>Unit Head</label>

								       <?php


								  echo form_dropdown('uhead',$userlist,$data->uhead,'class="form-control" disabled=""');

								       ?>
								    </div>
								
								<div class="form-group">
																		<?php	$udata=explode('-',$data->members);
												//print_r($udata); ?>
									<label>Select Members:<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="users[]" multiple="" disabled="">
									<?php


											foreach ($users as $value) {
										?>

											


											<option value="<?=$value->id ?>" <?= $data->members==$value->id?'selected':''?>><?=$value->user_name ?></option>



										<?php
											}


											?>	
									</select>
									<span class="text-danger"><?=  form_error('unit_name') ?></span>
									
								</div>
								<div class="form-group">
									<a href="<?=  base_url('unit/unitlist') ?>" class="btn btn-success" style="color:white;background-color: #ef0f0f;border-color:#ef0f0f">Close</a>
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