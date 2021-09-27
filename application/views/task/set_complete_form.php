<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"></h1>
      <br>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;color:white;">
					<strong>Task Management</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>

				


						<?php

							$singledata=$singledata[0];
							//echo $singledata->title;

						?>
														<div class="pull-right">

									<div class="row">
											<input type="hidden" value="<?= $singledata->id ?>" name="task_id">
											<?php if($singledata->assign_uid==$this->session->userdata('id') or $this->users_model->is_deptHead($singledata->department))  { ?>

										<?php

												if ($singledata->status!=3 and $singledata->status==4) {
								?>
										

									<div class="form-group col-md-6">
										<p  name="Completed"  class="badge badge-info" style="border-color: #ef0f0f;cursor:pointer; background-color:red;color:white;">Completed</p>
									</div>
<?php }  else {?>

									<div class="form-group col-md-6">
																	<a  href="<?= base_url('task/change_status').'/'.$singledata->id.'/'.'3' ?>"  onclick="return confirm('Are You sure to Completed ?')" class="badge badge-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Complete</a>
									</div>
										<?php } } ?>
								</div>
								<div class="row">
											<input type="hidden" value="<?= $singledata->id ?>" name="task_id">
											<?php if($singledata->created_by==$this->session->userdata('id'))  { ?>

										<?php

												if ($singledata->status==3) {
								?>
										

									<div class="form-group col-md-6">
										<a  href="<?= base_url('task/change_status').'/'.$singledata->id.'/'.'4' ?>"  class="btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Approve</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

										<a  href="<?= base_url('task/change_status').'/'.$singledata->id.'/'.'5' ?>"  class="btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Reject</a>
										
									</div>
<?php }  else {?>

									<div class="form-group col-md-6">
										<a  href="<?= base_url('task/change_status').'/'.$singledata->id.'/'.'6' ?>"  class="btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Abort</a>
									</div>
										<?php } } ?>
								</div>

			
								<hr>
								
							</div>

													<h3><b>Task Details</b></h3>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('task/do_update').'/'.$singledata->id?>" enctype="multipart/form-data">
							
	

								<div class="form-group">
                					<label for="dtp_input3" class="control-label">Task Title<strong><font color='red'>*</font></strong></label>
									<input readonly="" type="text" value="<?= isset($singledata->title)?$singledata->title:"" ?>" class="form-control" name="title">
                					<span class="text-danger"><?= form_error('title')?></span>
           						</div>
           														

           		<div class="form-group">
      					<label for="dtp_input3" class="control-label"> Task Description<strong><font color='red'>*</font></strong></label>
         					<textarea readonly="" name="description"  class=" form-control">
                            <?= isset($singledata->description)?$singledata->description:""?>
                          </textarea>
                	<span class="text-danger"><?= form_error('desc')?></span>
           		</div>
   


           				

           											<div id="assigndetails">
           					<div class="row" >
									<div class="form-group col-md-3">
									<label>Assign to:<strong><font color='red'>*</font></strong></label>
									<select disabled="" class="form-control" name="assign_uid">
												<option hidden="" selected="">Select Please</option>
											<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->id ?>"<?= $singledata->assign_uid==$value->id?"selected":"" ?>><?=$value->user_name ?></option>
										<?php
											}
											?>
									</select>
									<span class="text-danger"><?= form_error('assign_uid') ?></span>
								</div>
           					
									<div class="form-group col-md-3"  >
									<label>Task Follwer(Multiple Select)</label>
									<select disabled="" class="	form-control" name="users[]" multiple="">
												<option hidden="" selected="">Select Please</option>
											<?php
																if(!empty($singledata))
																{
																 $members=explode('-',$singledata->users);
																}
											foreach ($users as $value) {


										?>
											<option value="<?=$value->id ?>" <?php if(!empty($singledata))
																{ foreach($members as $p) { if($value->id == $p){ echo"selected";} }  }?>><?=$value->user_name ?></option>


										<?php
											}


											?>
									</select> 
								</div>
							
									<div class="col-md-3">
										<div class="form-group" >
									<label>Select Program </label>
									<select disabled="" class="	form-control program projetbypro" name="program">
												<option  >Select Please</option>
											<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pid ?>" <?= $singledata->program==$value->pid?"selected":"" ?>><?=$value->pro_name ?></option>


										<?php
											}


											?>
									</select> 
									<span class="text-danger"><?= form_error('program') ?></span>
								</div>
									</div>
									<div class="col-md-3">
										<div class="form-group" >
									<label>Select Department</label>
									<select disabled="" class="form-control dept" name="department" id="dept">
											
										<option hidden="">Select Please</option>
									<?php
											foreach ($dept as $value) {
										?>
											<option value="<?=$value->did ?>" <?= $singledata->department==$value->did?"selected":"" ?>><?=$value->dtitle ?></option>


										<?php
											}
											?>


									</select> 
								</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group" >
									<label>Select Unit</label>
									<select disabled="" class="	form-control " name="unit" id="unit">
											
											<option hidden="">Select Please</option>
									<?php
											foreach ($unit as $value) {
										?>
											<option value="<?=$value->id ?>" <?= $singledata->unit==$value->id?"selected":"" ?>><?=$value->unit_name ?></option>


										<?php
											}
											?>
									</select> 
									<span class="text-danger"><?= form_error('unit') ?></span>
								</div>
									</div>									
									<div class="col-md-2">
										<div class="form-group" >
									<label>Select Project</label>
									
									<select disabled="" class="	form-control proformile" name="project" id="project" title="Please select a project ">
												<option hidden="" selected="">Select Please</option>
											<?php
											foreach ($projects as $value) {
										?>
											<option value="<?=$value->id ?>" <?= $singledata->project==$value->id?"selected":""?> ><?=$value->project_name ?></option>


										<?php
											}


											?>
									</select>
									<span class="text-danger"><?= form_error('project') ?></span> 
								</div>
									</div>
									<div class="col-md-2">
										<div class="form-group" >
									<label>Select Milestone</label>
									<select disabled="" class="	form-control "  name="milestone" id="milestone">
												<option hidden="" selected="">Select Please</option>
											<?php
											foreach ($milestone as $value) {
										?>
											<option value="<?=$value->id  ?>" <?= $singledata->milestone==$value->id?"selected":""?>><?=$value->milestone_title ?></option>


										<?php
											}


											?>
									</select> 
									<span class="text-danger"><?= form_error('milestone') ?></span>
								</div>
									</div>
								
							
									<div class="form-group col-md-2">
										<label>Start Date</label>
										<input readonly="" type="date" value="<?= $singledata->start_date ?>" name="start_date" class="form-control">
										<span class="text-danger"><?= form_error('start_date') ?></span>
									</div>
									<div class="form-group col-md-2">
										<label>End Date</label>
										<input readonly="" type="date" value="<?= $singledata->end_date ?>" name="end_date" class="form-control">
										<span class="text-danger"><?= form_error('end_date') ?></span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group" >
									<label>Budget</label>
									<input readonly="" type="number" value="<?= $singledata->budget ?>" name="budget" class="form-control"> 
									<span class="text-danger"><?= form_error('budget') ?></span>
								</div>
									</div>
										<div class="col-md-3">
										<div class="form-group" >
									<label>Priority</label>
<select disabled="" class="	form-control" name="priority">
	<option hidden="" selected="">Select Please</option>
										<option value="0" <?= $singledata->priority==0?"selected":""?>>Low</option>
										<option value="1" <?= $singledata->priority==1?"selected":""?>>Medium</option>
										<option value="2" <?= $singledata->priority==2?"selected":""?>>High</option>
										<option value="3" <?= $singledata->priority==3?"selected":""?>>Very High</option>
										<option value="4" <?= $singledata->priority==4?"selected":""?>>Urgent</option>
									</select>
									<span class="text-danger"><?= form_error('priority') ?></span>
								</div>
									</div>
								</div>
							
										<!--<div class="form-group center ">
											<br>
										<a href="javascript:void()" class="assign btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Next</a>
									</div>-->
								</div>
							</div></form>


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