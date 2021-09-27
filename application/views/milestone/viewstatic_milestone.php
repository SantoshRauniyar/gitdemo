<div style="padding: 2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Milestone</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Milestones Management</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
						<h3><b>Create a Milestone</b></h3>
												<form role="form" name="editprofileform" id="editprofileform" method="post"  enctype="multipart/form-data">
								<?php if($mode == "edit"){?>
								<input readonly="" type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />
								
								<div class="clearfix"></div>
								<?php } ?>
								<div class="form-group">
									<label>Milestone Title:<strong><font color='red'>*</font></strong></label>
									<input readonly="" id="milestone_title" name="milestone_title" class="form-control" value="<?php if(isset($milestone_title)){echo $milestone_title;}?>" >
								</div>
								<div class="form-group" style="margin-left:0;">
									<label>Project Name:<strong><font color='red'>*</font></strong></label>
									
									<?php
										if(isset($project_id))
										{
											echo form_dropdown("project_id",$projectlist,$project_id,"class='form-control col-md-6' disabled=''");
										}
										else
										{
											echo form_dropdown("project_id",$projectlist,'','class=form-control col-md-6');
										}
										
									?>
									
									
								</div>
								<div class="form-group">
									<label>Description:<strong><font color='red'>*</font></strong></label>
									<textarea id="description" name="description"  readonly="" class="form-control" ><?php if(isset($description)){echo $description;}?></textarea>
								</div>
								<div class="form-group">
									<label>Budget:<strong><font color='red'>*</font></strong></label>
									<input readonly="" id="budget" name="budget" class="form-control" value="<?php if(isset($budget)){echo $budget;}?>" >
								</div>
								
								<div class="clearfix"></div>
								

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