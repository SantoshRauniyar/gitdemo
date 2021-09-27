
<script type="text/javascript">
	
	$(document).ready(function(){

			$('#secondform').hide();
			
			
			
			                    $('.is_recurring').click(function(){
			                        
			                        
			                        $('#recurrence').toggle('slow');
			                        
			                    });
			
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



                                 	$('.followersByPro').change(function(){


                               		//	alert($(this).val());
                               					uid=$(this).val();
                               	if(uid==""){alert('please select Assign to')}
                               	
                               	else

                               	{
                               				$.ajax({

							                               		url:'<?= base_url() ?>users/taskFollowers',
							                                    method:'post',
							                                    data:{uid:uid},

							                                    success:function(response)
							                                    {
							                                        $('#taskFollowers').html(response);
							                                         console.log(response);
							                                    },
							                                   error:function(response)
							                                    {
							                                        alert('error occurs');
							                                        console.log(response);
							                                    }

							                       });
                               				}


                               	});
  
//period dynamic changes





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
                        
                               $('.sec').change(function()
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



						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('task/do_save1')?>" enctype="multipart/form-data">
								<div id="firstform">
							
								<div class="form-group">

                					<label for="dtp_input3" class="control-label">Task Title<strong><font color='red'>*</font></strong></label>

                						<input type="text" class="form-control" name="title">
                						<span class="text-danger"><?= form_error('title')?></span>



           						</div>
           														<div class="form-group">

                					<label for="dtp_input3" class="control-label"> Task Description<strong><font color='red'>*</font></strong></label>

                					<textarea name="description" class=" form-control"></textarea>
                						<span class="text-danger"><?= form_error('desc')?></span>



           						</div>
            

           					
								<div class="form-group">
<span id="second"></span>
                					<label for="dtp_input3" class="control-label">Attach Files</label>

                						<input type="file" class="form-control" name="file[]" multiple="">
									<span class="text-danger"></span>

           						</div>
           						<!--<div class="form-group col-md-6">
           							<br><a href="javascript:void()"  class="btn btn-info btn1" style="color: :white;background-color: #ef0f0f;border-color:#ef0f0f">Next</a>
           						</div>-->
           					


											<h3><b>Assign Details</b></h3><hr>	
	
							<div id="assigndetails">
           			
									<div class="form-group">
									<label>Assign to:<strong><font color='red'>*</font></strong></label>
									<select class="form-control followersByPro" name="assign_uid">
												<option style="background-color:red;" value="<?= $this->session->userdata('id') ?>" selected="">MySelf </option>
											<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->id ?>"><?= $value->first_name.' '.$value->last_name.' / '.$value->user_role_name ?></option>
										<?php
											}
											?>
									</select>
									<span class="text-danger"><?= form_error('assign_uid') ?></span>
								</div>
           				
									
								<div class="row">
									<div class="col-md-3">
										<div class="form-group" >
									<label>Select Program </label>
									<select class="	form-control program projetbypro " name="program">
												<option  >Select Please</option>
											<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pid ?>"><?=$value->pro_name ?></option>


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
									</select> 
								</div>
									</div>
								    	<div class="col-md-3">
										<div class="form-group" >
									
									<strong >
									    <label>Select Section</label>
									<select class="form-control sec" name="section"  id="section">
											<option hidden="" value="">Select Please</option>
											
									</select>
									</strong>
									<span class="text-danger"><?= form_error('section') ?></span>
								</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group" >
									
									<strong id="unit">
									    									    <label>Select Unit</label>
									   		<select class="form-control" >
									   		    <option hidden="" value="">Select Please</option>
									   		</select>							
									<span class="text-danger"><?= form_error('unit') ?>
									</span>
									</strong>
								</div>
									</div>
								                    
									
									</div>
								</div>
<div class="form-group" >
									<label>Task Followers  ( Multiple Select )</label>
								<?php echo form_multiselect('users[]',$followers,'',' id="taskFollowers" class="form-control"'); ?>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group" >
									<label>Select Project</label>
									
									<select class="	form-control proformile" name="project" id="project" title="Please select a project ">
												<option   value="" selected="">Select Please</option>
											<?php
											foreach ($projects as $value) {
										?>
											<option value="<?=$value->id ?>"><?=$value->project_name ?></option>


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
												<option  value="" selected="">Select Please</option>
											<?php
											foreach ($milestone as $value) {
										?>
											<option value="<?=$value->id  ?>"><?=$value->milestone_title ?></option>


										<?php
											}


											?>
									</select> 
									<span class="text-danger"><?= form_error('milestone') ?></span>
								</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-3">
										<label>Target  Start Date</label>
										<input type="date" name="start_date" max="<?= date('Y-m-d') ?>" class="form-control">
					
										<span class="text-danger"><?= form_error('start_date') ?></span>
									</div>
									<div class="form-group col-md-3">
										<label>Target  Start Time</label>
	
										<input type="time" name="start_time" class="form-control">
										<span class="text-danger"><?= form_error('start_time') ?></span>
									</div>
									<div class="form-group col-md-3">
										<label>Target  End Date</label>
										<input type="date" name="end_date" max="2025-12-31" min="<?= date('Y-m-d') ?>" class="form-control">
										<span class="text-danger"><?= form_error('end_date') ?></span>
									</div>
																		<div class="form-group col-md-3">
										<label>Target  End Time</label>

										<input type="time" name="end_time" class="form-control">
										<span class="text-danger"><?= form_error('end_time') ?></span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group" >
									<label>Pre-approved Budget</label>
									<input type="number" name="budget" placeholder="Pre-approved Budget" class="form-control"> 
									<span class="text-danger"><?= form_error('budget') ?></span>
								</div>
									</div>
																		<div class="col-md-4">
										<div class="form-group" >
									<label>Priority</label>
                                        <select class="	form-control" name="priority">
	                                    <option hidden="" selected="">Select Please</option>
										<option value="0">Low</option>
										<option value="1">Medium</option>
										<option value="2">High</option>
										<option value="3">Very High</option>
										<option value="4">Urgent</option>
									</select>
									<span class="text-danger"><?= form_error('priority') ?></span>
								</div>
								</div>
								<div class="col-md-3">
								    <label>Is Recurring Task ?</label><br>
								    <input type="checkbox" value="1" name="is_recurring" class="is_recurring">
								</div>
								</div>
								
									
				<div id="recurrence" style="display:none">	
						<div class="container">
						
						
									<div class="row">
										<div class="form-group col-md-6">
											<label>Expected Start Date & Time</label>
											<input type="datetime-local" class="form-control" name="rec_start">
										</div>
													
													
									<div class="form-group col-md-6">
										<label>Expected End Date & Time</label>
										<input type="datetime-local" class="form-control" name="rec_end">
									</div>
												</div>
												
							</div>
												
			    </div>
											

								<div class="form-group col-md-6">

        <br>
                						<input type="submit"  class="btn btn-info" style="border-color: #ef0f0f;background-color:#ef0f0f;color:white;"value="Submit"  name="next">



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
