<script type="text/javascript">
	
	$(document).ready(function(){

			$('#is_text').hide();
      $('#is_video').hide();
      $('#is_image').hide();
      $('#is_keywords').hide();
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
						<h3><b>Content Publish Task</b></h3>
				


						<?php



						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('task/do_save_publish_content')?>" enctype="multipart/form-data">
                  <h4 style="color:#ef0f0f"><b>What to Post ?</b></h4>
								<div id="firstform">
												
           						<label>Select Content Category <strong><font color='red'>*</font></strong></label>
           										<div class="row">

           										
           											<div class="col-md-4">
           												<select class="	form-control" name="cont_cat">
           													<option value="" hidden="">Select Content Category</option>
           													<?php
											foreach ($category as $value) {
										?>
											<option value="<?=$value->cid ?>"><?=$value->cname ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('audience')?></span>
           											</div>
           											<div class="col-md-4">
           												<select class="	form-control" name="content_type">
           													<option value="" hidden="">Select Content Type</option>
           																	<?php
											foreach ($content as $value) {
										?>
											<option value="<?=$value->cont_id ?>"><?=$value->content_name ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('content_type')?></span>
           											</div>
                                  <div class="col-md-4">
                                  <select class=" form-control" name="content_code">
                                    <option value="" hidden="">Select Content Code</option>
                                            <?php
                      foreach ($content as $value) {
                    ?>
                      <option value="<?=$value->cont_id ?>"><?=$value->content_code ?></option>
                    <?php
                      }
                      ?>
                                  </select>
                                  <span class="text-danger"><?= form_error('content_code')?></span>
                                </div>
           								</div>
                          <div class="form-group">
                            <label>Post Publish ID</label>
                            <input type="text" name="task_id" class="form-control">
                            <span class="text-danger"><?= form_error('task_id')?></span>
                          </div>

                                                    <div class="form-group">
                            <label>Post publishing Task Name</label>
                            <input type="text" name="task_name" class="form-control">
                            <span class="text-danger"><?= form_error('task_name')?></span>
                          </div>

                            <div class="form-group">
                              <label style="color:#ef0f0f">Instruction on creating on post ?</label>
                            </div>



                                                      <div class="form-group">
                            <label>Include Text</label> &nbsp;&nbsp;&nbsp;<input type="checkbox" name="is_text" class="is_text">
                            <input type="url" name="is_text" class="form-control" id="is_text" placeholder="Google Drive Link" >
                          </div>



                           <div class="form-group">
                            <label>Include Video</label>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="is_video" class="is_video">
                            <input type="url" name="is_video" class="form-control" id="is_video" placeholder="Google Drive Link" >
                          </div>

                                                     <div class="form-group">
                            <label>Include Image</label>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="is_image" class="is_image">
                            <input type="url" name="is_image" class="form-control" id="is_image" placeholder="Google Drive Link" >
                          </div>

                                                     <div class="form-group">
                            <label>Include Keywords</label>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="is_keywords" class="is_keywords">
                            <input type="url" name="is_keywords" class="form-control" id="is_keywords" placeholder="Google Drive Link" >
                          </div>
           					          
                              <div class="form-group">
                                    <label>Landing Page ?</label>
                                     <input type="radio" value="1" name="is_landing">Yes <input type="radio" value="0" name="is_landing"> No
                                     <span class="text-danger"><?= form_error('is_landing')?></span>
                              </div>

           														<div class="form-group">

                					<label for="dtp_input3" class="control-label">Task Details<strong><font color='red'>*</font></strong></label>

                					<textarea name="task_details" rows="10" class=" form-control"></textarea>
                						<span class="text-danger"><?= form_error('task_details')?></span>



           						</div>

                          <label style="color:#ef0f0f">Where to post ?</label>
                    <div class="row">
                         <div class="col-md-4">
                          <label>Select channel</label>
                           <select class="form-control" name="channel">
                            <option value="" hidden="">Select channel</option>
                              <?php

                                foreach ($channel as $value) {
                                  
                                    ?>
                                      <option value="<?= $value->id ?>"><?=  $value->channel_name ?></option>
                                    <?php

                                }

                              ?>
                        </select>
                         </div> 
                        
                         <div class="col-md-8">
                          <label>Select Avenue Groups</label>
                           <select class="form-control" name="group">
                            <option value="" hidden="">Select Avenue Group</option>
                        <?php

                                foreach ($group_avenue as $value) {
                                  
                                    ?>
                                      <option value="<?= $value->gid ?>"><?=  $value->group_name ?></option>
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
									<select class="form-control" name="assign_to">
												<option hidden="" selected="">Select Please</option>
											<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->id ?>"><?=$value->user_name ?></option>
										<?php
											}
											?>
									</select>
									<span class="text-danger"><?= form_error('assign_to') ?></span>
								</div>
           				
									<div class="form-group" >
									<label>Task Follwers(Multiple Select) <strong><font color='red'>*</font></strong></label>
									<select class="	form-control" name="users[]" multiple="">
												<option     value="" hidden="">Select Please</option>
											<?php
											foreach ($users as $value) {
										?>
											<option value="<?=$value->id ?>"><?=$value->user_name ?></option>


										<?php
											}


											?>
									</select> 
								</div>
                <div class="row">
									<div class="col-md-6" >
									<label>Target Start Date & Time</label>
									<input type="datetime-local" class="form-control" name="start_date">
									<span class="text-danger"><?= form_error('start_date') ?></span>
								</div>

                <div class="col-md-6" >
                  <label>Target Completion Date</label>
                  <input type="datetime-local" class="form-control" name="end_date">
                  <span class="text-danger"><?= form_error('end_date') ?></span>
                </div>
              </div>
							

                                                    <?php
                                                    include_once('assignfields.php');
                                                    ?>
								<div class="form-group col-md-6">

        <br>
                						<input type="submit" value="Update" class="btn btn-info" style="border-color: #ef0f0f;background-color:#ef0f0f;color:white;" name="next">



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