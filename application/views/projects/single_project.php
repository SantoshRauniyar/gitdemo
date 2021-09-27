<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Projects</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Projects Management</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
							//print_r($program);
						?>
						 <h3><b>Create a Project </b></h3>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
								<?php if($mode == "edit"){?>


								<input readonly="" type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />

								

								<div class="clearfix"></div>

								<?php } ?>

									<div class="form-group">
										<label>Select Program:</label>
										

											<?php

													if ($mode=='edit') {
														?>

															<select disabled="" name="program_id" class="form-control">
											<?php

											foreach ($program as $value) {
										?>
											<option value="<?=  $value->pid?>" <?php if(isset($program_id)){ echo $res=$value->pid==$program_id?"selected":""; } ?> ><?= $value->pro_name ?></option>
										<?php
											}
											?>
										</select>		
														<?php
													} else 

													{


															?>


																<select disabled="" name="program_id" class="form-control">
											<?php

											foreach ($program as $value) {
										?>
											<option value="<?=  $value->pid?>"  ><?= $value->pro_name ?></option>
										<?php
											}
											?>
										</select>
															<?php



													}

											?>

									</div>




									<div class="form-group">
										<label>Select Project Leader:</label>
										

											<?php

													if ($mode=='edit') {
														?>

															<select disabled="" name="leader_id" class="form-control">
											<?php

											foreach ($leader as $value) {
										?>
											<option value="<?=  $value->id?>" <?php if(isset($leader_id)){ echo $res=$value->id==$leader_id?"selected":""; } ?> ><?= $value->user_name ?></option>
										<?php
											}
											?>
										</select>		
														<?php
													} else 

													{


															?>


																<select disabled="" name="leader_id" class="form-control">
											<?php

											foreach ($leader as $value) {
										?>
											<option value="<?=  $value->id?>"  ><?= $value->user_name ?></option>
										<?php
											}
											?>
										</select>
															<?php



													}

											?>

									</div>

								<div class="form-group">

									<label>Project Name:<strong><font color='red'>*</font></strong></label>

									<input readonly="" id="project_name" name="project_name" class="form-control" value="<?php if(isset($project_name)){echo $project_name;}?>" >

								</div>

								<div class="form-group">

									<label>Project Icon:<strong><font color='red'>*</font></strong></label>
							
									<img width="50px" height="50px" src="<?=base_url('upload/').'/'.$icon ?>">


								</div>

								<div class="form-group">

									<label>Description:</label>

									<textarea readonly="" id="description" name="description" class="form-control" ><?php if(isset($description)){echo $description;}?></textarea>

								</div>

								

<!--								<div class="form-group  col-md-6" style="margin-left:0;">-->

<!-- 									<label>Selete Team For Assign:<strong><font color='red'>*</font></strong></label> -->

									<?php
// 										if(isset($team_id))
// 										{
// 											echo form_dropdown("team_id",$teamlist,$team_id,"class='form-control col-md-6'");
// 										}
// 										else
// 										{
// 											echo form_dropdown("team_id",$teamlist,'','class=form-control col-md-6');
// 										}
// 									?>
<!-- 								</div> -->

								<div class="form-group" style="margin-left:0;">

									<label col-md-6>Number of milestone:<strong><font color='red'>*</font></strong></label>

									<input readonly="" id="no_of_milestone" name="no_of_milestone" class="form-control" value="<?php if(isset($no_of_milestone)){echo $no_of_milestone;}?>" >

								</div>

								<div class="clearfix"></div>

								<!--<div class="form-group">

									<label>Birth Date:<strong><font color='red'>*</font></strong></label>

									<input readonly="" id="birth_date" name="birth_date" class="form-control" value="" >

								</div>-->

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

                    					<input  class="form-control" size="16" type="text" value="<?php if(isset($end_date)){echo $end_date;}?>" readonly="true">

                    					<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>

										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>

                					</div>

									<input type="hidden" id="dtp_input2" name="end_date" value="<?php if(isset($end_date)){echo $end_date;}?>" /><br/>

           						</div>

								<div class="form-group">

									<label>Budget:<strong><font color='red'>*</font></strong></label>

									<input readonly="" id="budget" name="budget" class="form-control" value="<?php if(isset($budget)){echo $budget;}?>" >

								</div>

									
								<div class="form-group">

									<label>Activate Discussions Board of this project?:<strong><font color='red'>*</font></strong></label>

									<select disabled="" class="form-control" name="discuss">
										<option value="1" <?php if(isset($discuss)){echo $discuss==1?'selected':'';}?>>Yes</option>
										<option value="0" <?php if(isset($budget)){echo $discuss==0?'selected':'';}?>>No</option>
									</select>

								</div>
								

								<a readonly="" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;"  href="<?base_url('projects/all_view')?>" class="btn btn-primary">Close</a>

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