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
                              


$('[data-type="adhaar-number"]').keyup(function() {
  var value = $(this).val();
  value = value.replace(/\W/g, "").split(/(?:([\w]{3}))+([\w]{3})+([\w]{3})+([\d]{5})/g).filter(s => s.length > 0).join("-");
  $(this).val(value);
});

$('[data-type="adhaar-number"]').on("change, blur", function() {
  var value = $(this).val();
  var maxLength = $(this).attr("maxLength");
  if (value.length != maxLength) {
    $(this).addClass("highlight-error");
  } else {
    $(this).removeClass("highlight-error");
  }
});
                    })


</script>
<style type="text/css">
	.highlight-error {
  border-color: red;
}

</style>
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
					 <div class="row">
                                
                      <input type="hidden" value="<?= $production_data->poid ?>" name="task_id">
                               <div class="col-md-3">     <strong><b>Content Production Order</b></strong></div>
                      <?php if($production_data->assign_to==$this->session->userdata('id'))  { ?>

                    <?php

                        if ($production_data->status<3) {
                ?>
                    

                
                   <div class="col-md-2"> <a  href="<?= base_url('task/change_status_to_production').'/'.$production_data->poid.'/'.'3' ?>"  class="btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Mark As Complete</a></div>
            
<?php }  else {?>

                
                   <div class="col-md-2"> <div  name="Completed"  class="btn btn-info" style="opacity:0.4;border-color: #ef0f0f;cursor:pointer; background-color:lightgrey;color:white;">Mark As Completed</div></div>
                
                    <?php } } ?>
              
                
                      <input type="hidden" value="<?= $production_data->poid ?>" name="task_id">
                      <?php if($production_data->created_by==$this->session->userdata('id'))  { ?>

                    <?php

                        if ($production_data->status==3) {
                ?>
                    

                  <div class="col-md-3">
                    <a  href="<?= base_url('task/change_status_to_production').'/'.$production_data->poid.'/'.'4' ?>"  class="btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Approve</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <a  href="<?= base_url('task/change_status_to_production').'/'.$production_data->poid.'/'.'5' ?>"  class="btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Reject</a></div>
                    
        
<?php }  else {?>

                  
                    <a  href="<?= base_url('task/change_status_to_production').'/'.$production_data->poid.'/'.'6' ?>"  class="btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Abort</a>
                
                    <?php } } ?>
                </div>

      
                <hr>
                
              </div>

						<h3><b>Content Production Order</b></h3>
				
							<form role="form" name="editprofileform" id="editprofileform" method="post"  enctype="multipart/form-data">
								<div id="firstform">
												<div class="form-group">
													

													<label>Select Content category</label>
													<select disabled="" class="form-control" name="content_category">
														<option>Select Content Category</option>
														<?php
											foreach ($category as $value) {
										?>
											<option value="<?=$value->cid ?>" <?= $production_data->content_category==$value->cid?"selected":"" ?> ><?=$value->cname ?></option>
										<?php
											}
											?>
													</select>
													<span class="text-danger"><?= form_error('content_category') ?></span>
												</div>

								<div class="form-group">

                					<label for="dtp_input3" class="control-label">Content  Title<strong><font color='red'>*</font></strong></label>

                						<input readonly="" type="text" value="<?= $production_data->title ?>" class="form-control" name="title">
                						<span class="text-danger"><?= form_error('title')?></span>



           						</div>
           						<label>Content Code <strong><font color='red'>*</font></strong></label>
           										<div class="row">

           											<div class="col-md-3">
           												<select disabled="" class="	form-control" name="code_program">
           													<option>Select Program</option>
           													<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pid ?>" <?= $production_data->program==$value->pid?"selected":"" ?>><?=$value->pro_name ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('code_program')?></span>
           											</div>
           											<div class="col-md-3">
           												<select disabled="" class="	form-control" name="audience">
           													<option>Select Target Audience</option>
           													<?php
											foreach ($audience as $value) {
										?>
											<option value="<?=$value->aid ?>" <?= $production_data->target_audience==$value->aid?"selected":"" ?>><?=$value->audi_name ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('audience')?></span>
           											</div>
           											<div class="col-md-3">
           												<select disabled="" class="	form-control" name="content_type">
           													<option>Select Content Type</option>
           																	<?php
											foreach ($content as $value) {
										?>
											<option value="<?=$value->cont_id ?>" <?= $production_data->content_type==$value->cont_id?"selected":"" ?>><?=$value->content_name ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('content_type')?></span>
           											</div>
           											<div class="col-md-3">
           												<input readonly="" type="text" name="secure_code" placeholder="xxx-yyy-zzz-00001" title="try this format" value="<?=$production_data->secure_code ?>" data-type="adhaar-number" maxLength="17" class="form-control">
           											</div>
           											<span class="text-danger"><?= form_error('secure_code')?></span>
           										</div>
           					

           														<div class="form-group">

                					<label for="dtp_input3" class="control-label"> Task Details<strong><font color='red'>*</font></strong></label>

                					<textarea name="task_details" class=" form-control" readonly="">
                            	<?=$production_data->task_details?>
                          </textarea>
                						<span class="text-danger"><?= form_error('task_details')?></span>



           						</div>
                    </div>

         					
           					<div class="form-group">
           						<label>Google Doc Url</label>
           						<input readonly="" type="url" value="<?=$production_data->gu_doc?>" class="form-control" name="gu_doc">
           						<span class="text-danger"><?= form_error('gu_doc')?></span>
           					</div>
								<div class="form-group">
								<span id="second"></span>
                					<label for="dtp_input3" class="control-label">Attachments</label>

                						<input readonly="" type="file" class="form-control" name="file[]" multiple="">
									<span class="text-danger"></span>

           				
           						<!--<div class="form-group col-md-6">
           							<br><a href="javascript:void()"  class="btn btn-info btn1" style="color: :white;background-color: #ef0f0f;border-color:#ef0f0f">Next</a>
           						</div>-->
           					</div>
           			


												
	
						
           					
									<div class="form-group">
									<label>Assign to:></label>
									<select disabled="" class="form-control" name="assign_to">
												<option hidden="" selected="">Select Please</option>
											<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->id ?>" <?= $production_data->assign_to==$value->id?"selected":"" ?>><?=$value->user_name ?></option>
										<?php
											}
											?>
									</select>
									<span class="text-danger"><?= form_error('assign_to') ?></span>
								</div>
           			
									<div class="form-group" >
									<label>Target Completion Date</label>
									
									<input readonly="" type="text"  value="<?= $production_data->end_date ?>" class="form-control" name="end_date">
									<span class="text-danger"><?= form_error('end_date') ?></span>
								</div>
								<div class="row">
									<div class="">&nbsp;&nbsp;&nbsp;&nbsp;<label>Attributes Assignment</label></div>
									<div class="col-md-2">
													
								<select disabled="" class="	form-control program projetbypro" name="program" title="select Program">
												<option  >Select Program</option>
											<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pid ?>" <?= $production_data->program==$value->pid?"selected":"" ?>><?=$value->pro_name ?></option>


										<?php
											}


											?>
									</select> 
									</div>

									<div class="col-md-2">
										<div class="form-group" >
								
									<select disabled="" class="form-control dept" name="department" id="dept" title="Select Department">
											
										<option >Select Department</option>
										<?php
											foreach ($dept as $value) {
										?>
											<option value="<?=$value->did ?> " <?= $production_data->department==$value->did?"selected":"" ?>><?=$value->dtitle ?></option>


										<?php
											}


											?>
									</select> 
								</div>
									</div>
									<div class="col-md-2">
										<div class="form-group" >
									
									<select disabled="" class="	form-control " name="unit" id="unit" title="select unit">
										<option>Select Unit</option>
											
											<?php
											foreach ($unit as $value) {
										?>
											<option value="<?=$value->id ?> " <?= $production_data->unit==$value->id?"selected":"" ?>><?=$value->unit_name ?></option>


										<?php
											}


											?>	
									</select> 
									<span class="text-danger"><?= form_error('unit') ?></span>
								</div>
									</div>
							
									<div class="col-md-2">
										<div class="form-group" >
									
									
									<select disabled="" class="	form-control proformile" name="project" id="project" title="Please select a project ">
												<option hidden="" selected="">Select Project</option>
											<?php
											foreach ($projects as $value) {
										?>
											<option value="<?=$value->id ?>"<?= $production_data->project==$value->id?"selected":"" ?>><?=$value->project_name ?></option>


										<?php
											}


											?>
									</select>
									<span class="text-danger"><?= form_error('project') ?></span> 
								</div>
									</div>
									<div class="col-md-2">
										<div class="form-group" >
									
									<select disabled="" class="	form-control "  name="milestone" id="milestone" title="select milestone">
												<option hidden="" selected="">Select Milestone</option>
											<?php
											foreach ($milestone as $value) {
										?>
											<option value="<?=$value->id  ?>" <?= $production_data->milestone==$value->id?"selected":"" ?>><?=$value->milestone_title ?></option>


										<?php
											}


											?>
									</select> 
									<span class="text-danger"><?= form_error('milestone') ?></span>
								</div>
									</div>
								</div>


								<div class="form-group col-md-6">

        



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