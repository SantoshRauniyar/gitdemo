<div style="padding:2%;">
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
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
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
											else 
											{
									?>
									<img src = "<?php echo base_url('assets/administrator/images/images.jpeg');?>" height="100" width="100" />
									<?php	
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
								<!--<div class="form-group col-md-6" style="margin-left:0;">
									<label>Select Team Leader:<strong><font color='red'>*</font></strong></label>
									<input id="team_leader_id" name="team_leader_id" class="form-control" value="<?php if(isset($team_leader_id)){echo $team_leader_id;}?>" >
									<!--<?php
										$team_leader_list = array($this->session->userdata('id')."" => $this->session->userdata('user_name')."");	
										if(isset($team_leader_id))
										{
											echo form_dropdown("team_leader_id",$team_leader_list,$this->session->userdata('id'),"class='form-control'");
										}
										else
										{
											echo form_dropdown("team_leader_id",$team_leader_list,$this->session->userdata('id'),'class=form-control');
										}
										
									?>
									
									
								</div>-->
								<div class="form-group" style="margin-left:0;">
									<label>Team Logo:<strong><font color='red'>*</font></strong></label>
									<input type="file" id="logo_image" name="logo_image" class="form-control" />									
								</div>
                                <!--<div class="form-group" style="margin-left:0;">
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
									
									
								</div>-->
                               <!-- <div class="form-group" style="margin-left:0;">
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
								</div>-->
								<div class="clearfix"></div>
								
								<div class="form-group col-md-6">
									<label>Background Image:</label>
									<input type="file" id="background_image" name="background_image">
								</div>
								<div class="form-group col-md-6">
									<label>Background Color:</label>
									<div class="bfh-colorpicker" data-name="background_color" data-color="<?php if(isset($background_color)){echo $background_color;}?>">
</div>
								</div>
								<div class="form-group col-md-6">
									<label>Panel Heading Color:</label>
									<div class="bfh-colorpicker" data-name="panel_heading_color" data-color="<?php if(isset($panel_heading_color)){echo $panel_heading_color;}?>">
</div>
								</div>
								<div class="form-group col-md-6">
									<label>Panel Body Color:</label>
									<div class="bfh-colorpicker" data-name="panel_body_color" data-color="<?php if(isset($panel_body_color)){echo $panel_body_color;}?>">
</div>
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