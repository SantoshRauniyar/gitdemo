<script type="text/javascript">
	
	$(document).ready(function(){

			$('#secondform').hide();
                 //check all order by OID
                   $('.program').change(function()
                    {
                               
                              var pid=$(this).val();
                             // var dname=$(this).attr('dept');
                              

                               $.ajax({

                                    url:'<?= base_url() ?>groups/deptbypro',
                                    method:'get',
                                    data:{pid:pid},

                                    success:function(dept)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#dept').html(dept);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(dept)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })



                                 





                               //project according program

                               $('.projetbypro').change(function()
                    {
                               
                              var pid=$(this).val();
                             // var dname=$(this).attr('dept');
                              

                               $.ajax({

                                    url:'<?= base_url() ?>projects/projectbypro',
                                    method:'get',
                                    data:{pid:pid},

                                    success:function(dept)
                                    {
                                       // alert(dept);
                                           // id='#'+show;
                                        $('#project').html(dept);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(dept)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })


                                                              //project according program

                               $('.proformile').change(function()
                    {
                               
                             var pid=$(this).val();
                            // alert(pid);
                            //var dname=$(this).attr('dept');
                              

                             $.ajax({

                                    url:'<?= base_url() ?>milestone/milebyproject',
                                    method:'get',
                                    data:{pid:pid},

                                    success:function(dept)
                                    {
                                       // alert(dept);
                                           // id='#'+show;
                                        $('#milestone').html(dept);
                                    
                                    },
                                   error:function(dept)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })




                                //here get sction if dept has section otherwise it will be return unit 
                               $('.dept').change(function()
                    {
                               
                              var did=$(this).val();
                             // var dname=$(this).attr('dept');
                             //alert(did);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>section/sectionbydept',
                                    method:'get',
                                    data:{did:did},

                                    success:function(unit)
                                    {
                                       // alert(unit);
                                           // id='#'+show;
                                        $('#section').html(unit);
                                    
                                         console.log(unit);
                                         
                                    },
                                   error:function(unit)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })
                        
                        
                        
                        //all unit by section
                        
                               $('.sec').mouseleave(function()
                    {
                               
                              var sid=$('#getsec').val();
                             // var dname=$(this).attr('dept');
                             
                              

                               $.ajax({

                                    url:'<?= base_url() ?>unit/unitbysec',
                                    method:'get',
                                    data:{sid:sid},

                                    success:function(section)
                                    {
                                        $('#unit').html(section);
                                         console.log(section);
                                    },
                                   error:function(section)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })
                        
  
//period dynamic changes


     //project according program

                               $('.period').change(function()
                    {
                               
                              var id=$(this).val();
                             // var dname=$(this).attr('dept');
                            //  alert(id);
                              if (id==1) {$('#fix').hide()}
                             else if (id==2) {

$('#fix').show();
                              	$('#fix').html("<option>Monday</option><option>Tuesdaay</option><option>WEdnesday</option><option>Thursday</option><option>Friday</option><option>Saturday</option>")
                              }
                              else if (id==3) {

                              	$('#fix').html("<option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option><option value='12'>12</option><option value=''>/option><option value='1'>1</option><option value='1'>1</option><option value='1'>1</option>")
                              }

                               


                        })
                              

                    })


</script>
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
						<h3><b>Task Details</b></h3>
				


						<?php

							$singledata=$singledata[0];
							//echo $singledata->title;

						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('task/do_update').'/'.$singledata->id?>" enctype="multipart/form-data">
								<div id="firstform">
								<div class="row">
								<div class="form-group col-md-5">

                					<label for="dtp_input3" class="control-label">Task Title<strong><font color='red'>*</font></strong></label>

                						<input type="text" value="<?= isset($singledata->title)?$singledata->title:"" ?>" class="form-control" name="title">
                						<span class="text-danger"><?= form_error('title')?></span>



           						</div>
           														<div class="form-group col-md-6">

                					<label for="dtp_input3" class="control-label"> Task Description<strong><font color='red'>*</font></strong></label>

                					<textarea name="description"  class=" form-control">
                            <?= isset($singledata->description)?$singledata->description:""?>
                          </textarea>
                						<span class="text-danger"><?= form_error('desc')?></span>



           						</div>
                    </div>

<div class="row">           					
           					
								<div class="form-group col-md-5">
<span id="second"></span>
                					<label for="dtp_input3" class="control-label">Attach Files<strong><font color='red'>*</font></strong></label>

                						<input type="file" class="form-control" name="file[]" multiple="">
									<span class="text-danger"></span>

           						</div>
           						<!--<div class="form-group col-md-6">
           							<br><a href="javascript:void()"  class="btn btn-info btn1" style="color: :white;background-color: #ef0f0f;border-color:#ef0f0f">Next</a>
           						</div>-->
           					</div>
           				</div>


											<h3><b>Assign Details</b></h3><hr>	
	
							<div id="assigndetails">
           					<div class="row" >
									<div class="form-group col-md-5">
									<label>Assign to:<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="assign_uid">
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
           					</div>
									<div class="form-group" >
									<label>Task Follwer(Multiple Select)</label>
									<select class="	form-control" name="users[]" multiple="">
												<option hidden="" selected="">Select Please</option>
											<?php
										 $members=explode('-',$singledata->users);
											foreach ($users as $value) {


										?>
											<option value="<?=$value->id ?>" <?php  foreach($members as $select){  if($value->id==$select){echo'selected';} } ?> ><?=$value->user_name ?></option>


										<?php
											}


											?>
									</select> 
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group" >
									<label>Select Program </label>
									<select class="	form-control program projetbypro" name="program">
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
									<select class="form-control dept" name="department" id="dept">
											
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
									<?php
									if(!empty($singledata->section))
									{
									    ?>
									
									<div class="col-md-3">
										<div class="form-group" >
										    <span class="sec" id="section">
									<label>Select Section</label>
									<select class="	form-control " name="section" id="getsec">
											
											<option hidden="">Select Please</option>
									<?php
											foreach ($section as $value) {
										?>
											<option value="<?=$value->id ?>" <?= $singledata->section==$value->id?"selected":"" ?>><?=$value->section_name ?></option>


										<?php
											}
											?>
									</select> 
									<span class="text-danger"><?= form_error('section') ?></span>
									</span>
								</div>
									</div><?php } ?>
									<div class="col-md-3">
										<div class="form-group" >
									<label>Select Unit</label>
									<select class="	form-control " name="unit" id="unit">
											
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
								</div>


								<div class="row">
									<div class="col-md-6">
										<div class="form-group" >
									<label>Select Project</label>
									
									<select class="	form-control proformile" name="project" id="project" title="Please select a project ">
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
									<div class="col-md-6">
										<div class="form-group" >
									<label>Select Milestone</label>
									<select class="	form-control "  name="milestone" id="milestone">
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
								</div>
								<div class="row">
									<div class="form-group col-md-6">
										<label>Start Date</label>
										<input type="date" value="<?= $singledata->start_date ?>" name="start_date" class="form-control">
										<span class="text-danger"><?= form_error('start_date') ?></span>
									</div>
									<div class="form-group col-md-6">
										<label>End Date</label>
										<input type="date" value="<?= $singledata->end_date ?>" name="end_date" class="form-control">
										<span class="text-danger"><?= form_error('end_date') ?></span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group" >
									<label>Budget</label>
									<input type="number" value="<?= $singledata->budget ?>" name="budget" class="form-control"> 
									<span class="text-danger"><?= form_error('budget') ?></span>
								</div>
									</div>
										<div class="col-md-4">
										<div class="form-group" >
									<label>Priority</label>
<select class="	form-control" name="priority">
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
							</div>
													
											<!--<div class="container">
												<h3><b>Autocreate Details</b></h3><hr>
												<div class="row">
													<div class="form-group col-md-3">

														<label>Expected Start Date & Time</label>
														<input type="datetime-local" class="form-control" name="starttime">
													</div>
															<div class="form-group col-md-3">

														<label>Expected End Date & Time</label>
														<input type="datetime-local" class="form-control" name="starttime">
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<label>Recurrence Frequency Slection</label>
														<select class="	form-control" name="freq">
															<?php

																for($i=1;$i<=10;$i++)
																	echo "<option value='".$i."'>".$i."</option>";

															?>
														</select>
													</div>
													<div class="col-md-2">
														<label>Applicable</label>
														<input type="checkbox"  name="applicable">
														<select class="period	form-control" name="period">
															<option >Select Period</option>
															<option value="1">Everyday</option>
															<option value="2">Everyweek</option>
															<option value="3">Everymonth</option>
															<option value="4">Everyquarter</option>
															<option value="5">Everyhalfyear</option>
															<option value="6">Everyyear</option>
														</select>
													</div>
													<div class="col-md-3">
														<br>
														<select class="	form-control" name="fix" id="fix">
															<option value="">On</option>
															<option value="">at</option>
														</select>
													</div>
													<div class="col-md-2">
														<label>Start Time</label>
														<input type="time" title="start time" class="form-control" name="starttime">
													</div>
													<div class="col-md-2">
														<label>End Time</label>
														<input type="time" title="end time" class="form-control" name="endtime">
													</div>
												</div>
												<div class="row">
													<label>	Next Task Trigger</label>
													<select class="	form-control" name="nexttask">
														<option>hiii</option>
													</select>
												</div>
											</div>-->

								<div class="form-group col-md-6">

        <br>
                						<input type="submit" value="Next" class="btn btn-info" style="border-color: #ef0f0f;background-color:#ef0f0f;color:white;" name="next">



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