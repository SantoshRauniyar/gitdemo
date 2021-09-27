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


                           $('.audio').mouseleave(function()
                      {
                               
                              
                             var acode=$(this).val();
                             res1=acode.split('-');
                            

                               var pcode=$('#procode').val();
                             res2=pcode.split('-');
                          

                             var tcode=$('#typecode').val();
                             res3=tcode.split('-');
                              
                              
                              secure=res2[1]+'-'+res1[1]+'-'+res3[1];
                              ressecure=secure+'-'+'<?= $secure_code ?>';
                              $('#secure').val(ressecure);
                              // alert('<?= $secure_code ?>');
                               


                        })



                           $('.pro').mouseleave(function()
                      {
                               
                              
                             var acode=$('#audicode').val();
                             res1=acode.split('-');
                        
                              
                               var pcode=$(this).val();
                             res2=pcode.split('-');
                            

                             var tcode=$('#typecode').val();
                             res3=tcode.split('-');
                              
                                  
                          secure=res2[1]+'-'+res1[1]+'-'+res3[1];
                              ressecure=secure+'-'+'<?= $secure_code ?>';
                              $('#secure').val(ressecure);
                              // alert('<?= $secure_code ?>');


                        })

                           $('.type').mouseleave(function()
                      {
                               
                              
                              var acode=$('#audicode').val();
                             res1=acode.split('-');
                              
                              
                               var pcode=$('#procode').val();
                             res2=pcode.split('-');
                          

                             var tcode=$(this).val();
                             res3=tcode.split('-');
                              
                            secure=res2[1]+'-'+res1[1]+'-'+res3[1];
                                ressecure=secure+'-'+'<?= $secure_code ?>';
                              $('#secure').val(ressecure);
                              // alert('<?= $secure_code ?>');


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
						<h3><b>Content Production Order</b></h3>
				


						<?php



						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('task/pro_order_do_save')?>" enctype="multipart/form-data">
								<div id="firstform">
												<div class="form-group">
													

													<label>Select Content category</label>
													<select class="form-control" name="content_category">
														<option>Select Content Category</option>
														<?php
											foreach ($category as $value) {
										?>
											<option value="<?=$value->cid ?>"><?=$value->cname ?></option>
										<?php
											}
											?>
													</select>
													<span class="text-danger"><?= form_error('content_category') ?></span>
												</div>

								<div class="form-group">

                					<label for="dtp_input3" class="control-label">Content  Title<strong><font color='red'>*</font></strong></label>

                						<input type="text" class="form-control" name="title">
                						<span class="text-danger"><?= form_error('title')?></span>



           						</div>
           						<label>Content Code <strong><font color='red'>*</font></strong></label>
           										<div class="row">

           											<div class="col-md-3">
           												<select class="	form-control code_program pro" id="procode" name="code_program">
           											
           													<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pid ?>-<?=$value->pro_code ?>"><?=$value->pro_name ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('code_program')?></span>
           											</div>
           											<div class="col-md-3">
           												<select class="	form-control audio" id="audicode" name="audience">
           									
           													<?php
											foreach ($audience as $value) {
										?>
											<option value="<?=$value->aid ?>-<?= $value->audi_code ?>"><?=$value->audi_name ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('audience')?></span>
           											</div>
           											<div class="col-md-3">
           												<select class="	form-control type" name="content_type" id="typecode">
           												
           																	<?php
											foreach ($content as $value) {
										?>
											<option value="<?=$value->cont_id ?>-<?=$value->content_code ?>"><?=$value->content_name ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('content_type')?></span>
           											</div>
           											<div class="col-md-3">


           												<input type="text" name="secure_code" id="secure" readonly="" value="<?= $secure_code ?>" title="try this format" data-type="adhaar-number" maxLength="17" class="form-control">
           											</div>
           											<span class="text-danger"><?= form_error('secure_code')?></span>
           										</div>
           					

           														<div class="form-group">

                					<label for="dtp_input3" class="control-label"> Task Details<strong><font color='red'>*</font></strong></label>

                					<textarea name="task_details" class=" form-control">
                            
                          </textarea>
                						<span class="text-danger"><?= form_error('task_details')?></span>



           						</div>
                    </div>

         					
           					<div class="form-group">
           						<label>Google Doc Url</label>
           						<input type="url" class="form-control" name="gu_doc">
           						<span class="text-danger"><?= form_error('gu_doc')?></span>
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
									<input type="datetime-local" class="form-control" name="end_date">
									<span class="text-danger"><?= form_error('end_date') ?></span>
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
											<option value="<?=$value->pid ?>"><?=$value->pro_name ?></option>


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
									</select> 
								</div>
									</div>
									<div class="col-md-2">
										<div class="form-group" >
									
									<span class="sec" id="section">
									    <label>Select Section</label>
									<select class="form-control" name="section" id="getsec">
											
											
									</select>
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
									<select class="	form-control "  name="milestone" id="milestone" title="select milestone">
												<option hidden="" selected="">Select Milestone</option>
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