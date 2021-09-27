<div id="page-wrapper">

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">Projects</h1>

		</div>

		<!-- /.col-lg-12 -->

	</div>

	<!-- /.row -->

	<div class="row">

		<div class="col-lg-12">

			<div class="panel panel-default">

				<div class="panel-heading">

					<strong><?php echo $heading;?></strong>	

					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>

				</div>

				<div class="panel-body">

					<div class="row">

						<div class="col-lg-12">

						<?php 

							$this->load->view('common/errors');

						?>

							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">

								<?php if($mode == "edit"){?>

								<input type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />

								

								<div class="clearfix"></div>

								<?php } ?>

								<div class="form-group">

									<label>Project Name:<strong><font color='red'>*</font></strong></label>

									<input id="project_name" name="project_name" class="form-control" value="<?php if(isset($project_name)){echo $project_name;}?>" >

								</div>

								<div class="form-group">

									<label>Description:</label>

									<textarea id="description" name="description" class="form-control" ><?php if(isset($description)){echo $description;}?></textarea>

								</div>

								

								<div class="form-group  col-md-6" style="margin-left:0;">

									<label>Assign_to:<strong><font color='red'>*</font></strong></label>

									

									<?php

										if(isset($leader_id))

										{

											echo form_dropdown("leader_id",$leaderslist,$leader_id,"class='form-control col-md-6'");

										}

										else

										{

											echo form_dropdown("leader_id",$leaderslist,'','class=form-control col-md-6');

										}

										

									?>

									

									

								</div>

								<div class="form-group col-md-6" style="margin-left:0;">

									<label col-md-6>Number of milestone:<strong><font color='red'>*</font></strong></label>

									<input id="no_of_milestone" name="no_of_milestone" class="form-control" value="<?php if(isset($no_of_milestone)){echo $no_of_milestone;}?>" >

								</div>

								<div class="clearfix"></div>

								<!--<div class="form-group">

									<label>Birth Date:<strong><font color='red'>*</font></strong></label>

									<input id="birth_date" name="birth_date" class="form-control" value="" >

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

                    					<input class="form-control" size="16" type="text" value="<?php if(isset($end_date)){echo $end_date;}?>" readonly="true">

                    					<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>

										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>

                					</div>

									<input type="hidden" id="dtp_input2" name="end_date" value="<?php if(isset($end_date)){echo $end_date;}?>" /><br/>

           						</div>

								<div class="form-group">

									<label>Budget:<strong><font color='red'>*</font></strong></label>

									<input id="budget" name="budget" class="form-control" value="<?php if(isset($budget)){echo $budget;}?>" >

								</div>

								

								<input type="submit" class="btn btn-primary" value="<?php if($mode == 'edit'){echo 'Update';}else{echo 'Save';}?>">	

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