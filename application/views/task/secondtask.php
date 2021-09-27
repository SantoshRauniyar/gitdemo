<script type="text/javascript">
	
	$(document).ready(function(){


                 //check all order by OID
                               $('.program').change(function()
                    {
                               
                               var 
                            


                        })

                    })


</script>
<div style="padding: 2%" class="task1">
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
									<label>Assign to:<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="program">
											
											<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->user_name ?>"><?=$value->user_name ?></option>


										<?php
											}


											?>


									</select>
								</div>
								<div class="form-group" >
									<label>Task Follwer(Multiple Select)</label>
									<select class="	form-control" multiple="">
											
											<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->user_name ?>"><?=$value->user_name ?></option>


										<?php
											}


											?>
									</select> 
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group" >
									<label>Select Program </label>
									<select class="	form-control program" name="program">
											
											<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pro_name ?>"><?=$value->pro_name ?></option>


										<?php
											}


											?>
									</select> 
								</div>
									</div>
									<div class="col-md-4">
										<div class="form-group" >
									<label>Select Department</label>
									<select class="	form-control" >
											
											<?php
											foreach ($dept as $value) {
										?>
											<option value="<?=$value->groups_title ?>"><?=$value->groups_title ?></option>


										<?php
											}


											?>
									</select> 
								</div>
									</div>
									<div class="col-md-4">
										<div class="form-group" >
									<label>Select Unit</label>
									<select class="	form-control" >
											
											<?php
											foreach ($unit as $value) {
										?>
											<option value="<?=$value->unit_name ?>"><?=$value->unit_name ?></option>


										<?php
											}


											?>
									</select> 
								</div>
									</div>
								</div>


								<div class="row">
									<div class="col-md-6">
										<div class="form-group" >
									<label>Select Project</label>
									<select class="	form-control" >
											
											<?php
											foreach ($project as $value) {
										?>
											<option value="<?=$value->project_name ?>"><?=$value->project_name ?></option>


										<?php
											}


											?>
									</select> 
								</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" >
									<label>Select Milestone</label>
									<select class="	form-control" >
											
											<?php
											foreach ($milestone as $value) {
										?>
											<option value="<?=$value->milestone_title  ?>"><?=$value->milestone_title ?></option>


										<?php
											}


											?>
									</select> 
								</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group" >
									<label>Budget</label>
									<input type="number" name="budget" class="form-control"> 
								</div>
									</div>
										<div class="col-md-4">
										<div class="form-group" >
									<label>Priority</label>
<select class="	form-control" >
											
											<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->user_name ?>"><?=$value->user_name ?></option>


										<?php
											}


											?>
									</select>
								</div>
									</div>
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
