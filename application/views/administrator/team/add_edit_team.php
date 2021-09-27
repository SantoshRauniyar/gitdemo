<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Teams</h1>
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
							<form role="form" name="editteamform" id="editteamform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
                            
								<?php if($mode == "edit"){?>
								<input type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />
								<div class="form-group pull-right">
                                	<?php
										if(isset($logo_image))
										{
											if($logo_image != '')
											{
												if(file_exists('assets/upload/team/'.$logo_image))
												{
									?>
									<img src = "<?php echo base_url('assets/upload/team/'.$logo_image);?>" height="100" width="100" />
                                    <?php
												}
											}
										}
									?>
									
								</div>
								<div class="clearfix"></div>
								<?php } ?>
								<div class="form-group">
									<label>Team Title:<strong><font color='red'>*</font></strong></label>
									<input id="team_title" name="team_title" class="form-control" value="<?php if(isset($team_title)){echo $team_title;}?>" >
								</div>
                                <div class="form-group">
                                	<label>Description:<strong><font color='red'>*</font></strong></label>
									<textarea id="description" name="description" class="form-control"><?php if(isset($description)){echo $description;}?></textarea>
                                </div>
								<div class="form-group col-md-6" style="margin-left:0;">
									<label>Select Team Leader:<strong><font color='red'>*</font></strong></label>
									
									<?php
										if(isset($team_leader_id))
										{
											echo form_dropdown("team_leader_id",$userlist,$team_leader_id,"class='form-control'");
										}
										else
										{
											echo form_dropdown("team_leader_id",$userlist,'','class=form-control');
										}
										
									?>
									
									
								</div>
								<div class="form-group col-md-6" style="margin-left:0;">
									<label>Team Logo:<strong><font color='red'>*</font></strong></label>
									<input type="file" id="logo_image" name="logo_image" class="form-control" />									
								</div>
                                <div class="form-group" style="margin-left:0;">
									<label>Select Plan:<strong><font color='red'>*</font></strong></label>
									
									<?php
										if(isset($plan_id))
										{
											echo form_dropdown("plan_id",$planlist,$plan_id,"class='form-control' id='plan_id'");
										}
										else
										{
											echo form_dropdown("plan_id",$planlist,'',"class='form-control' id='plan_id'");
										}
										
									?>
									
									
								</div>
                                <div class="form-group" style="margin-left:0;">
									<label>Features:</label>
                                    <div class="well">
                                    	<?php 
											if($mode == "edit")
											{
                                        		echo $feature;
											}
											else
											{
										?>
                                    	No Plan Selected . Please select any plan .
                                        <?php
											}
										?>
                                    </div>
								</div>
								<div class="clearfix"></div>
								
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