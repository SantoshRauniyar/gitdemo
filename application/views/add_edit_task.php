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
					<strong><?php echo $heading;?></strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" >
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
											<option value="<?=$value->groups_title ?>"><?=$value->groups_title ?></option>


										<?php
											}


											?>	
									</select>
									
								</div>
								<div class="form-group">
									<label>Task:<strong><font color='red'>*</font></strong></label>
									<input id="task" name="task" class="form-control" value="<?php if(isset($task)){echo $task;}?>" >
								</div>
								<div class="form-group">
									<label>Select Task Mode:<strong><font color='red'>*</font></strong></label>
									<?php 
										$modes = array(""=>"Select Task Mode","1"=>"Perent","2"=>"Child");
										if(isset($task_mode))
										{
											echo form_dropdown("task_mode",$modes,$task_mode,"id='task_mode' class='form-control'");
										}
										else
										{
											echo form_dropdown("task_mode",$modes,'',"id='task_mode' class='form-control'");
										}
									?>
								</div>
								<div id="parenttasklist" class="form-group" <?php if(isset($parent_id)){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
									<label>Select Parent Task:<strong><font color='red'>*</font></strong></label>
									<?php
										if(isset($parent_id))
										{
											echo form_dropdown("parent_id",$parent_task_list,$parent_id,"id='parent_id' class='form-control'");
										}
										else
										{
											echo form_dropdown("parent_id",$parent_task_list,'',"id='parent_id' class='form-control'");
										}
									?>
								</div>
								<div class="form-group">
									<label>Select Task Type:<strong><font color='red'>*</font></strong></label>
									<?php 
										if(isset($task_type))
										{
											echo form_dropdown("task_type",$task_type_list,$task_type,"id='task_type' class='form-control'");
										}
										else
										{
											echo form_dropdown("task_type",$task_type_list,'',"id='task_type' class='form-control'");
										}
									?>
								</div>
								<div id="projects" class="form-group col-md-6" style="margin-left:0;<?php if($mode == 'edit' && $task_type == 1){echo 'display:block;';}else{echo 'display:none;';}?>">
									<label>Select Project:<strong><font color='red'>*</font></strong></label>
									<?php
										if(isset($project_id))
										{
											echo form_dropdown("project_id",$projects_list,$project_id,"id= 'project_id' class='form-control' ");
										}
										else
										{
											echo form_dropdown("project_id",$projects_list,'',"id= 'project_id' class='form-control'  ");
										}
									?>
								</div>
								<div id="milestone" class="form-group col-md-6" style="margin-left:0;<?php if($mode == 'edit' && $task_type == 1){echo 'display:block;';}else{echo 'display:none;';}?>">
									<label>Mailestone:<strong><font color='red'>*</font></strong></label>
									<?php 
										if($mode == "edit")
										{
											if(isset($milestone_id))
											{
												echo form_dropdown("milestone_id",$milestonelist,$milestone_id,"id= 'milestone_id' class='form-control' ");
											}
											else
											{
												echo form_dropdown("milestone_id",$milestonelist,'',"id= 'milestone_id' class='form-control' ");
											}
										}
										else
										{
									?>
									<select id="milestone_id" name="milestone_id" class="form-control">
										<option>Select Milestone</option>
									</select>	
									<?php
										}
									?>
								</div>
								<div class="form-group" style="margin-left:0;">
									<label>Assign to:<strong><font color='red'>*</font></strong></label>
									<?php
										print_r($userlist);
									

										//print_r($grouplist);
										$user_group = array("" => "SELECT USER OR GROUP");
										$ulist = array();
										$glist = array();
										if(isset($userlist) && !empty($userlist))
										{
												foreach($userlist as $user)
											{
												$ulist['user_'.$user->id] = $user->user_name;
											}
											$user_group['Users'] = $ulist;
										}
										
										if(isset($goruplist) && !empty($grouplist))
										{
											foreach($grouplist as $group)
											{
												$glist['group_'.$group->id] = $group->group_title;
											}
											$user_group['Groups'] = $glist;
										}
										//print_r($user_group);
										
										if(isset($this->member_id))
										{	
											echo form_dropdown("member_id",$user_group,$member_id,"class='form-control col-md-6'");
										}
										else
										{
											echo form_dropdown("member_id",$user_group,'hello','class=form-control col-md-6');
										}
									?>
								</div>
								<div class="form-group">
									<lable>Select Task Priority:</lable>
									<?php
										 $prioritylist = array(""=>"Select","1"=>"Normal","2"=>"Low","3"=>"Major","4"=>"critical");
										 
										 if(isset($task_priority))
										 {
										 	echo form_dropdown("task_priority",$prioritylist,$task_priority,"class='form-control'");
										 }
										 else 
										 {
										 	echo form_dropdown("task_priority",$prioritylist,'',"class='form-control'");
										 }
									?>
								</div>
								<div class="form-group">
									<label>Task Followers:<strong><font color='red'>*</font></strong></label>
									<?php
										//print_r($userlist);
										//print_r($grouplist);
										//$user_group = array("" => "SELECT USER");
										if(!empty($userlist))
										{
											$ulist = array();
										
											foreach($userlist as $user)
											{
												$ulist[$user->id] = $user->user_name;
											}
											echo form_dropdown("task_followers[]",$ulist,'',"class='form-control' multiple='true'");
										}
										else
										{
											$ulist = array();
											echo form_dropdown("task_followers",$ulist,'',"class='form-control' multiple='true'");
										}
									?>
								</div>

                                <div class="form-group">

									<label>Budget:<strong><font color='red'>*</font></strong></label>

									<input id="budget" name="budget" class="form-control" value="<?php if(isset($budget)){echo $budget;}?>" >

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
								<div class="form-group">
									<label>Recurrence :<strong><font color='red'>*</font></strong></label>
									<?php
										$recurrence_type_list = array(""=>"Select Recurrence Type","1"=>"YES","2"=>"NO");
										
										if(isset($recurrence))
										{
											echo form_dropdown('recurrence',$recurrence_type_list,$recurrence,'id=recurrence class=form-control');
										}
										else
										{
											echo form_dropdown('recurrence',$recurrence_type_list,'2','id=recurrence class=form-control');
										}
									?>
								</div>
								<div class="form-group col-md-6" id="recurrence_start_date" <?php if(isset($recurrence_start_date)){echo "style='display:block;'";}else{echo "style='display:none;'";}?> >
                					<label for="dtp_input1" class="control-label">From Select Start date:<strong><font color='red'>*</font></strong></label>
                					<div class="input-group date form_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input3" data-link-format="yyyy-mm-dd">
                    					<input class="form-control" size="16" type="text" value="<?php if(isset($recurrence_start_date)){echo $recurrence_start_date;}?>" readonly="true">
                    					<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                					</div>
									<input type="hidden" id="dtp_input3" name="recurrence_start_date" value="<?php if(isset($recurrence_start_date)){echo $recurrence_start_date;}?>" /><br/>
           						</div>
								<div class="form-group col-md-6" id="recurrence_end_date" <?php if(isset($recurrence_end_date)){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
                					<label for="dtp_input4" class="control-label">UPTO Select Upto End date:<strong><font color='red'>*</font></strong></label>
                					<div class="input-group date form_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input4" data-link-format="yyyy-mm-dd">
                    					<input class="form-control" size="16" type="text" value="<?php if(isset($recurrence_end_date)){echo $recurrence_end_date;}?>" readonly="true">
                    					<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                					</div>
									<input type="hidden" id="dtp_input4" name="recurrence_end_date" value="<?php if(isset($recurrence_end_date)){echo $recurrence_end_date;}?>" /><br/>
           						</div>
								<div class="form-group col-md-6" id="no_of_recurrence_time" <?php if(isset($no_of_recurrence)){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
									<label>Number of recurrence:<strong><font color='red'>*</font></strong></label>	
									<select id="no_of_recurrence" name="no_of_recurrence" class="form-control">
										<?php
											for($i=1; $i<=10;$i++)
											{
										?>
										<option value=<?php echo $i;?> <?php if(isset($no_of_recurrence) && $no_of_recurrence == $i){echo "selected='selected'";}?>><?php echo $i;?></option>
										<?php
											}
										?>
									</select>
								</div>
								<div class="form-group col-md-6" id="frequency" <?php if(isset($frequency_type)){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
									<label>Frequency Type :<strong><font color='red'>*</font></strong></label>
									<?php
										$frequency_type_list = array(""=>"Select Frequency Type","1"=>"fix","2"=>"Custom");
										
										if(isset($frequency_type))
										{
											echo form_dropdown('frequency_type',$frequency_type_list,$frequency_type,'id=frequency_type class=form-control');
										}
										else
										{
											echo form_dropdown('frequency_type',$frequency_type_list,'','id=frequency_type class=form-control');
										}
									?>		
								</div>
								<div class="form-group" id="fix_recurrence_time" <?php if(isset($fix_time)){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
									<label>Fixed recurring Settings :<strong><font color='red'>*</font></strong></label>
									<?php
										$fix_recurrence_time = array(""=>"Select Fixed recurring ","1"=>"Every hower","2"=>"Every Day","3"=>"Every Week","4"=>"Every Fortnight","5"=>"Every Month","6"=>"Every Half year","7"=>"Every Year");
										
										if(isset($fix_time))
										{
											echo form_dropdown('fix_time',$fix_recurrence_time,$fix_time,'id=fix_time class=form-control');
										}
										else
										{
											echo form_dropdown('fix_time',$fix_recurrence_time,'','id=fix_time class=form-control');
										}
									?>		
								</div>
								<div class="form-group" id="variable_recurrence_time" style="display:none;"></div>
								<div class="form-group">
									<label>Description:<strong><font color='red'>*</font></strong></label>
									<textarea id="description" name="description" class="form-control" ><?php if(isset($description)){echo $description;}?></textarea>
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