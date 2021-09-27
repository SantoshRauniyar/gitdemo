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
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(dept)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })




                                //check all order by OID
                               $('.dept').change(function()
                    {
                               
                              var did=$(this).val();
                             // var dname=$(this).attr('dept');
                             //alert(did);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>unit/unitbydept',
                                    method:'get',
                                    data:{did:did},

                                    success:function(unit)
                                    {
                                      //  alert(unit);
                                           // id='#'+show;
                                        $('#unit').html(unit);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(unit)
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
					<strong>Department Taskboard</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
						<h3><b>Content Production Order</b></h3>
				


						<?php



						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('task/do_save1')?>" enctype="multipart/form-data">
								<div id="firstform">
												<div class="form-group">
													<label>Select Content category</label>
													<select class="form-control" name="cont_category">
														<option>Select Content Category</option>
														<?php
											foreach ($category as $value) {
										?>
											<option value="<?=$value->cid ?>"><?=$value->cname ?></option>
										<?php
											}
											?>
													</select>
													<span class="text-danger"><?= form_error('cont_category') ?></span>
												</div>

								<div class="form-group">

                					<label for="dtp_input3" class="control-label">Content  Title<strong><font color='red'>*</font></strong></label>

                						<input type="text" class="form-control" name="title">
                						<span class="text-danger"><?= form_error('title')?></span>



           						</div>
           										<div class="row">
           											<div class="col-md-3">
           												<select class="	form-control" name="program">
           													<option>Select Program</option>
           													<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pid ?>"><?=$value->pro_name ?></option>
										<?php
											}
											?>
           												</select>
           											</div>
           											<div class="col-md-3">
           												<select class="	form-control" name="program">
           													<option>Select Target Audience</option>
           													<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->id ?>"><?=$value->user_name ?></option>
										<?php
											}
											?>
           												</select>
           											</div>
           											<div class="col-md-3">
           												<select class="	form-control" name="program">
           													<option>Select Content Type</option>
           												</select>
           											</div>
           											<div class="col-md-3">
           												<input type="datetime-local" name="task_dept" class="form-control">
           											</div>
           										</div>
           					

           														<div class="form-group">

                					<label for="dtp_input3" class="control-label"> Task Details<strong><font color='red'>*</font></strong></label>

                					<textarea name="description" class=" form-control">
                            
                          </textarea>
                						<span class="text-danger"><?= form_error('desc')?></span>



           						</div>
                    </div>

         					
           					<div class="form-group">
           						<label>Google Doc Url</label>
           						<input type="file" class="form-control" name="google_doc">
           					</div>
								<div class="form-group">
								<span id="second"></span>
                					<label for="dtp_input3" class="control-label">Attachments</label>

                						<input type="file" class="form-control" name="file[]" multiple="">
									<span class="text-danger"></span>

           				
           						<!--<div class="form-group col-md-6">
           							<br><a href="javascript:void()"  class="btn btn-info btn1" style="color: :white;background-color: #ef0f0f;border-color:#ef0f0f">Next</a>
           						</div>-->
           					</div>
           			


												
	
						
           					
									<div class="form-group">
									<label>Assign to:></label>
									<select class="form-control" name="assign_uid">
												<option hidden="" selected="">Select Please</option>
											<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->id ?>"><?=$value->user_name ?></option>
										<?php
											}
											?>
									</select>
									<span class="text-danger"><?= form_error('assign_uid') ?></span>
								</div>
           				
									<div class="form-group" >
									<label>Task Follwers(Multiple Select) <strong><font color='red'>*</font></strong></label>
									<select class="	form-control" name="users[]" multiple="">
												<option hidden="" selected="">Select Please</option>
											<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->id ?>"><?=$value->user_name ?></option>


										<?php
											}


											?>
									</select> 
								</div>
									<div class="form-group" >
									<label>Target Completion Date</label>
									<input type="datetime-local" class="form-control" name="tar_comp">
									<span class="text-danger"><?= form_error('program') ?></span>
								</div>
								<div class="row">
									<div class="col-md-2">
													<label>Select Program</label>
								<select class="	form-control program projetbypro" name="program">
												<option  >Select Please</option>
											<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pid ?>"><?=$value->pro_name ?></option>


										<?php
											}


											?>
									</select> 
									</div>

									<div class="col-md-2">
										<div class="form-group" >
									<label>Select Department</label>
									<select class="form-control dept" name="department" id="dept">
											
										<option hidden="">Select Please</option>
									</select> 
								</div>
									</div>
									<div class="col-md-2">
										<div class="form-group" >
									<label>Select Unit</label>
									<select class="	form-control " name="unit" id="unit">
											
											
									</select> 
									<span class="text-danger"><?= form_error('unit') ?></span>
								</div>
									</div>
							
									<div class="col-md-2">
										<div class="form-group" >
									<label>Select Project</label>
									
									<select class="	form-control proformile" name="project" id="project" title="Please select a project ">
												<option hidden="" selected="">Select Please</option>
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
									<div class="col-md-2">
										<div class="form-group" >
									<label>Select Milestone</label>
									<select class="	form-control "  name="milestone" id="milestone">
												<option hidden="" selected="">Select Please</option>
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