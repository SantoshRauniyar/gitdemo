<script type="text/javascript">
	
	$(document).ready(function(){

			$('#is_text').hide();
      $('#is_video').hide();
      $('#is_image').hide();
      //$('#is_keywords').hide();

      <?php  if(!empty($published_data->is_text)){ ?>$('#is_text').show();<?php }  ?>
            <?php  if(!empty($published_data->is_video)){ ?>$('#is_video').show();<?php }  ?>
                  <?php  if(!empty($published_data->is_image)){ ?>$('#is_image').show();<?php }  ?>
                        <?php  if(!empty($published_data->is_keyword)){ ?>$('#is_keywords').show();<?php }  ?>
                 //check all order by OID


                          $('.is_image').click(function(){

                                  $('#is_image').toggle(500);

                          })
                           $('.is_video').click(function(){

                                  $('#is_video').toggle(500);

                          })
                            $('.is_text').click(function(){

                                  $('#is_text').toggle(500);

                          })
                             $('.is_keywords').click(function(){

                                  $('#is_keywords').toggle(500);

                          })

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
                                
                      <input readonly="" type="hidden" value="<?= $published_data->id ?>" name="task_id">
                               <div class="col-md-3">     <strong><b>Content published Order</b></strong></div>
                      <?php if($published_data->assign_to==$this->session->userdata('id'))  { ?>

                    <?php

                        if ($published_data->status<3 and $published_data->status>=2 ) {
                ?>
                    

                
                   <div class="col-md-2"> <a  href="<?= base_url('task/change_status_to_published').'/'.$published_data->id.'/'.'3' ?>"  class="btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Mark As Complete</a></div>
            
<?php }  else {?>

                
                   <div class="col-md-2"> <div  name="Completed"  class="btn btn-info" style="opacity:0.4;border-color: #ef0f0f;cursor:pointer; background-color:lightgrey;color:white;">Mark As Completed</div></div>
                
                    <?php } } ?>
              
                
                      <input readonly="" type="hidden" value="<?= $published_data->id ?>" name="task_id">
                      <?php if($published_data->created_by==$this->session->userdata('id'))  { ?>

                    <?php

                        if ($published_data->status==3  ) {
                ?>
                    

                  <div class="col-md-3">
                    <a  href="<?= base_url('task/change_status_to_published').'/'.$published_data->id.'/'.'4' ?>"  class="btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Approve</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <a  href="<?= base_url('task/change_status_to_published').'/'.$published_data->id.'/'.'5' ?>"  class="btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Reject</a></div>
                    
        
<?php }  else {?>

                  
                    <a  href="<?= base_url('task/change_status_to_published').'/'.$published_data->id.'/'.'6' ?>"  class="btn btn-info" style="border-color: #ef0f0f; background-color:#ef0f0f;color:white;">Abort</a>
                
                    <?php } } ?>
                </div>

						                  <h4 style="color:#ef0f0f"><b>What to Post ?</b></h4>
								<div id="firstform">
												
           						<label>Select Content Category <strong><font color='red'>*</font></strong></label>
           										<div class="row">

           										
           											<div class="col-md-4">
           											<select  disabled="" class="	form-control" name="cont_cat" readonly="">
           													<option value="" hidden="">Select Content Category</option>
           													<?php
											foreach ($category as $value) {
										?>
											<option value="<?=$value->cid ?>"  <?= $published_data->cont_cat==$value->cid?"selected":"" ?>><?=$value->cname ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('audience')?></span>
           											</div>
           											<div class="col-md-4">
           <select  disabled="" class="	form-control" name="content_type" readonly="">
           													<option value="" hidden="">Select Content Type</option>
           			<?php
											foreach ($content as $value) {
										?>
											<option value="<?=$value->cont_id ?>" <?= $published_data->content_type==$value->cont_id?"selected":"" ?>><?=$value->content_name ?></option>
										<?php
											}
											?>
           	</select>
           												<span class="text-danger"><?= form_error('content_type')?></span>
           											</div>
                                  <div class="col-md-4">
                                  <select class=" form-control" name="content_code" readonly="">
                                    <option value="" hidden="">Select Content Code</option>
                                            <?php
                      foreach ($content as $value) {
                    ?>
                      <option value="<?=$value->cont_id ?>" <?= $published_data->content_code==$value->cont_id?"selected":"" ?>><?=$value->content_code ?></option>
                    <?php
                      }
                      ?>
                                  </select>
                                  <span class="text-danger"><?= form_error('content_code')?></span>
                                </div>
           								</div>
                          <div class="form-group">
                            <label>Post publishing Task ID</label>
                            <input readonly="" type="text" name="task_id" value="<?= $published_data->task_id ?>" class="form-control" <?= !empty($static_view)?"readonly=''":"" ?>>
                            <span class="text-danger"><?= form_error('task_id')?></span>
                          </div>

                                                    <div class="form-group">
                            <label>Post publishing Task Name</label>
                            <input readonly="" type="text" value="<?= $published_data->task_name ?>" <?= !empty($static_view)?"readonly=''":"" ?> name="task_name" class="form-control">
                            <span class="text-danger"><?= form_error('task_name')?></span>
                          </div>

                            <div class="form-group">
                              <label style="color:#ef0f0f">Instruction on creating on post ?</label>
                            </div>



                                                      <div class="form-group">
                            <label>Include Text</label> &nbsp;&nbsp;&nbsp;<input readonly="" <?= !empty($published_data->is_text)?"checked":"" ?> type="checkbox" name="is_text" class="is_text">
                            <input readonly="" type="url" <?= !empty($static_view)?"readonly=''":"" ?> name="is_text" class="form-control" id="is_text" value="<?= $published_data->is_text ?>" placeholder="Google Drive Link" >
                          </div>
 


                           <div class="form-group">
                            <label>Include Video</label>&nbsp;&nbsp;&nbsp;<input readonly="" <?= !empty($published_data->is_video)?"checked":"" ?> type="checkbox" name="is_video" class="is_video">
                            <input readonly="" type="url" <?= !empty($static_view)?"readonly=''":"" ?> name="is_video" class="form-control" id="is_video" value="<?= $published_data->is_video ?>" placeholder="Google Drive Link" >
                          </div>

                                                     <div class="form-group">
                            <label>Include Image</label>&nbsp;&nbsp;&nbsp;<input readonly="" type="checkbox" <?= !empty($published_data->is_image)?"checked":"" ?> name="is_image" class="is_image">
                            <input readonly="" type="url" <?= !empty($static_view)?"readonly=''":"" ?> name="is_image" class="form-control" id="is_image" value="<?= $published_data->is_image ?>" placeholder="Google Drive Link" >
                          </div>

                                                     <div class="form-group">
                            <label>Include Keywords</label>&nbsp;&nbsp;&nbsp;<input readonly="" type="checkbox"  <?= !empty($published_data->is_keyword)?"checked":"" ?> class="is_keywords">
                            <input readonly="" type="url" name="is_keywords"  <?= !empty($static_view)?"readonly=''":"" ?> class="form-control" id="is_keywords" value="<?= $published_data->is_keyword ?>" placeholder="Google Drive Link" >
                          </div>
           					          
                              <div class="form-group">
                                    <label>Landing Page ?</label>
                                     <input readonly="" type="radio" <?= !empty($static_view)?"readonly=''":"" ?> <?= (int)$published_data->is_landing>0?"checked":"" ?> name="is_landing">Yes <input readonly="" <?= (int)$published_data->is_landing==0?"checked":"" ?> <?= !empty($static_view)?" readonly=''":"" ?> type="radio" name="is_landing"> No
                                     <span class="text-danger"><?= form_error('is_landing')?></span>
                              </div>

           														<div class="form-group">

                					<label for="dtp_input3" class="control-label">Task Details<strong><font color='red'>*</font></strong></label>

                					<textarea disabled="" name="task_details" rows="10" <?= !empty($static_view)?"readonly=''":"" ?> class=" form-control"><?= $published_data->task_details ?></textarea>
                						<span class="text-danger"><?= form_error('task_details')?></span>



           						</div>

                          <label style="color:#ef0f0f">Where to post ?</label>
                    <div class="row">
                         <div class="col-md-4">
                          <label>Select channel</label>
                           <select class="form-control" name="channel" >
                            <option value="" hidden="">Select channel</option>
                              <?php

                                foreach ($channel as $value) {
                                  
                                    ?>
                                      <option value="<?= $value->id ?>" <?= $published_data->channel==$value->id?"selected":"" ?>><?=  $value->channel_name ?></option>
                                    <?php

                                }

                              ?>
                        </select>
                         </div> 
                        
                         <div class="col-md-8">
                          <label>Select Avenue Groups</label>
                           <select class="form-control" name="group" >
                            <option value="" hidden="">Select Avenue Group</option>
                        <?php

                                foreach ($group_avenue as $value) {
                                  
                                    ?>
                                      <option value="<?= $value->gid ?>" <?= $published_data->avenue_group==$value->gid?"selected":"" ?>><?=  $value->group_name ?></option>
                                    <?php

                                }

                              ?>
                        </select>
                         </div> 
                      </div>
                      <br>
                        <h4 style="color:#ef0f0f"><b>Assign</b></h4>
                        
           			    	<div class="form-group">
									<label>Assign to:</label>
								<select  disabled="" class="form-control" name="assign_to" >
												<option hidden="" selected="">Select Please</option>
											<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->id ?>" <?= $published_data->assign_to==$value->id?"selected":"" ?>><?=$value->user_name ?></option>
										<?php
											}
											?>
									</select>
									<span class="text-danger"><?= form_error('assign_to') ?></span>
								</div>
           				
									<div class="form-group" >
									<label>Task Follwers(Multiple Select) <strong><font color='red'>*</font></strong></label>
								<select  disabled="" class="	form-control" name="users[]" multiple="" readonly="">
												<option     value="" hidden="">Select Please</option>
											<?php
                              $follower=explode('-', $published_data->followers);
											

                       

                          foreach ($users as $value) {
                         
										?>

											<option value="<?=$value->id ?>" <?php  foreach ($follower as $key) {  $key==$value->id?"selected":"";} ?>><?= $value->user_name ?></option>


										<?php
                  }
										

											?>
									</select> 
								</div>
                <div class="row">
									<div class="col-md-6" >
									<label>Target Start Date & Time</label>
									<input readonly="" type="datetime-local" readonly="" value="<?= $published_data->start_date ?>" class="form-control" name="start_date">
									<span class="text-danger"><?= form_error('start_date') ?></span>
								</div>

                <div class="col-md-6" >
                  <label>Target Completion Date</label>
                  <input readonly="" type="datetime-local" readonly="" value="<?= $published_data->end_date ?>" class="form-control" name="end_date">
                  <span class="text-danger"><?= form_error('end_date') ?></span>
                </div>
              </div>
								<div class="row">
									<div class="">&nbsp;&nbsp;&nbsp;&nbsp;<label>Attributes Assignment</label></div>
									<div class="col-md-2">
												<label>Select Program</label>	
								<select class="	form-control program projetbypro" name="program" title="select Program">
												<option  >Select Program</option>
											<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pid ?>"  <?= $published_data->program==$value->pid?"selected":"" ?> ><?=$value->pro_name ?></option>


										<?php
											}


											?>
									</select> 
									</div>

									<div class="col-md-2">
										<div class="form-group" >
								<label>Select Department</label>
								
									<select class="form-control dept" name="department" id="dept" title="Select Department">
											
										<option >Select Department</option>
										
										<?php
										foreach($dept as $row)
										{
										   ?>
										   <option value="<?= $row->did ?>" <?= $published_data->department==$row->did?"selected":"" ?>><?= $row->dtitle ?></option>
										   <?php
										}
										?>
										
									</select> 
								</div>
									</div>
									
									<div class="col-md-2">
										<div class="form-group" >
									
									<span class="sec" id="section">
									    <?php
									if(!empty($published_data->section))
									{?>
									    <label>Select Section</label>
									<select class="form-control" name="section" id="getsec">
										<?php
										foreach($section as $row)
										{
										   ?>
										   <option value="<?= $row->id ?>" <?= $published_data->section==$row->id?"selected":"" ?>><?= $row->section_name ?></option>
										   <?php
										}
										?>
											
									</select>
										<?php } ?>
									</span>
									<span class="text-danger"><?= form_error('section') ?></span>
								</div>
									</div>
								
									<div class="col-md-2">
										<div class="form-group" >
									
									<span id="unit">
									    <label>Select Unit</label>
									   		<select class="form-control">
									   		    <option>Select Unit</option>
									   		    <?php
										foreach($unit as $row)
										{
										   ?>
										   <option value="<?= $row->id ?>" <?= $published_data->unit==$row->id?"selected":"" ?>><?= $row->unit_name ?></option>
										   <?php
										}
										?>
									   		</select>							
									<span class="text-danger"><?= form_error('unit') ?>
									</span>
									</span>
								</div>
									</div>
							
									<div class="col-md-2">
										<div class="form-group" >
									
									<label>Select Project</label>
									<select class="	form-control proformile" name="project" id="project" title="Please select a project ">
												<option hidden="" selected="">Select Project</option>
											<?php
											foreach ($projects as $value) {
										?>
											<option value="<?=$value->id ?>"<?= $published_data->project==$value->id?"selected":"" ?>><?=$value->project_name ?></option>


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
									<select class="	form-control "  name="milestone" id="milestone" title="select milestone">
												<option hidden="" selected="">Select Milestone</option>
											<?php
											foreach ($milestone as $value) {
										?>
											<option value="<?=$value->id  ?>"<?= $published_data->milestone==$value->id?"selected":"" ?>><?=$value->milestone_title ?></option>


										<?php
											}


											?>
									</select> 
									<span class="text-danger"><?= form_error('milestone') ?></span>
								</div>
									</div>
								</div>

                    


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
