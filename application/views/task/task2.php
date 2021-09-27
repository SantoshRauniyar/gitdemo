<div style="padding: 2%">
	<div class="row">
		<div class="col-lg-12" style="">
			<h1 class="page-header">Tasks</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Add Task</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" >
					<div class="row">
						<div class="col-lg-12">
								

						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="do_save" enctype="multipart/form-data">
							<div class="form-group">
									<label>Program:<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="program">
											
											<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pid ?>"><?=$value->pro_name ?></option>


										<?php
											}


											?>


									</select>
								</div>
								<div class="form-group">
									<label>Department:<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="dept">
									<?php
											foreach ($dept as $value) {
										?>
											<option value="7"><?=$value->groups_title ?></option>


										<?php
											}


											?>	
									</select>
									
								</div>
									<div class="form-group">
									<label>Project:<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="project">
									<?php
											foreach ($project as $value) {
										?>
					<option value="1"><?=$value->project_name ?></option>


										<?php
											}


											?>	
									</select>
									
								</div>
								<div class="form-group">
									<label>Taks Title</label>
									<input type="text" name="task" class="	form-control">
								</div>
																<div class="form-group">
									<label>Taks Details</label>
									<textarea type="text" name="desc" class="form-control"></textarea> 
								</div>

								<div class="form-group">
									<label>Prioriy:<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="dept">
									<option value="0">Low</option>
																		<option value="1">Medium</option>	
									<option value="2">High</option>

									<option value="3">Urgent</option>
									</select>
									
								</div>
									<div class="form-group col-md-6">
                					<label for="dtp_input1" class="control-label">Start Date:<strong><font color='red'>*</font></strong></label>
                					<div class="input-group date form_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                    					<input class="form-control" size="16" type="text" value="<?php if(isset($start_date)){echo $start_date;}?>" readonly="true">
                    					<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                					</div>
									<input type="hidden" id="dtp_input1" name="start_date" value="<?php if(isset($start_date)){echo $start_date;}?>" /><br/>
           						</div>
								<div class="form-group col-md-6">
                					<label for="dtp_input3" class="control-label">End Date:<strong><font color='red'>*</font></strong></label>
                					<div class="input-group date form_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    					<input class="form-control" size="16" type="text" value="<?php if(isset($end_date)){echo $end_date;}?>" readonly="true">
                    					<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                					</div>
									<input type="hidden" id="dtp_input2" name="end_date" value="<?php if(isset($end_date)){echo $end_date;}?>" /><br/>
           						</div>
           						<div
           						 class="form-group">
           							<label>Budget</label>
           							<input type="number" name="budget" class="form-control">
           						</div>
           						<div>
           							<label>Attached</label>
           							<input type="file" name="file[]" class="form-control" multiple="">
           						</div>
           						<br>	
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