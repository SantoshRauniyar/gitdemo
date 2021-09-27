<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Groups</h1>
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
							<form role="form" name="editgroupform" id="editgroupform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
                            
								<?php if($mode == "edit"){?>
								<input type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />
								<div class="clearfix"></div>
								<?php } ?>
								<div class="form-group">
									<label>Group Title:<strong><font color='red'>*</font></strong></label>
									<input id="group_title" name="group_title" class="form-control" value="<?php if(isset($group_title)){echo $group_title;}?>" >
								</div>
                                <div class="form-group">
                                	<label>Description:<strong><font color='red'>*</font></strong></label>
									<textarea id="description" name="description" class="form-control"><?php if(isset($description)){echo $description;}?></textarea>
                                </div>
								<div class="form-group col-md-6" style="margin-left:0;">
									<label>Select Team:<strong><font color='red'>*</font></strong></label>
									
									<?php
										if(isset($team_id))
										{
											echo form_dropdown("team_id",$teamlist,$team_id,"class='form-control'");
										}
										else
										{
											echo form_dropdown("team_id",$teamlist,'','class=form-control');
										}
										
									?>
									
									
								</div>
                                <div class="form-group col-md-6" style="margin-left:0;">
									<label>Select Group Manager:<strong><font color='red'>*</font></strong></label>
									
									<?php
										if(isset($manager_id))
										{
											echo form_dropdown("manager_id",$userlist,$manager_id,"class='form-control'");
										}
										else
										{
											echo form_dropdown("manager_id",$userlist,'','class=form-control');
										}
										
									?>
									
									
								</div>
                                
								<div class="form-group" style="margin-left:0;">
									<label>Select Member:<strong><font color='red'>*</font></strong></label>
									
									<?php
										if(isset($member_id))
										{
											$memlist = array();
											$i= 0;
											foreach($member_id as $mem)
											{
												$memlist[$i] = $mem['member_id'];
												$i++;
											}
											echo form_dropdown("member_id[]",$userlist,$memlist,"class='form-control' id='member_id' multiple");
										}
										else
										{
											echo form_dropdown("member_id[]",$userlist,'',"class='form-control' id='member_id' multiple");
										}
										
									?>
									
									
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