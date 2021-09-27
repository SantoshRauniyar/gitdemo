		<script type="text/javascript">
			
 
$(document).ready(function(){






                 //unit head from class onchange Function
                               $('.head').change(function()
                    {
                        var id=$(this).val();
                        var sid=$('#section_list').val();
                        var uid=$('#uid').val();
                        var did=$('#dept_id').val();
                        var pid=$('#program_id').val();
                        
                    


                        $.ajax({

                                    url:'<?= base_url() ?>users/getusers',
                                    method:'get',
                                    data:{uid:uid,did:did,sid:sid,pid:pid,id:id},

                                    success:function(unithead)
                                    {
                                       // alert(unithead);
                                           // id='#'+show;
                                        $('#my').html(unithead);//my on followers box
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(unithead)
                                    {
                                        alert('error occurs');
                                    }


                        })
                    })



                                //check all order by OID
                               $('.sec').change(function()
                    {
                        var sid=$(this).val();
                        var uid=$('#uid').val();
                        var did=$('#dept_id').val();
                        var pid=$('#program_id').val();
                        


                        $.ajax({

                                    url:'<?= base_url() ?>users/getusers',
                                    method:'get',
                                    data:{uid:uid,did:did,sid:sid,pid:pid},

                                    success:function(unithead)
                                    {
                                      // alert(unithead);
                                           // id='#'+show;
                                        $('#my').html(unithead);//followers
                                         $('#uid').html(unithead);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(unithead)
                                    {
                                        alert('error occurs');
                                    }


                        })
                    })





                             // select department according to selected program
                                      $('.program').change(function()
                    {
                       // var dept_uid=$(this).val();
                        var pid=$(this).val();
                        // var dept_uid=$(this).attr('mid');

                        

                       // alert(pid);


                        $.ajax({

                                    url:'<?= base_url() ?>groups/deptbyprogram',
                                    method:'get',
                                    data:{pid:pid},

                                    success:function(departmentlist)
                                    {
                                      //  alert(departmentlist);
                                           // id='#'+show;
                                       // $('#my').html(unithead);
                                         $('#dept_id').html(departmentlist);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(departmentlist)
                                    {
                                        alert('error occurs');
                                    }


                        })
                    })
                    
                      // select section if dept has section according to selected dept
                                      $('.dept').change(function()
                    {
                      
                        var did=$(this).val();
                       // alert(pid);
                        $.ajax({

                                    url:'<?= base_url() ?>groups/sectionbyDept',
                                    method:'get',
                                    data:{did:did},

                                    success:function(sectionlist)
                                    {
                                      // alert(sectionlist);
                                           // id='#'+show;
                                       // $('#my').html(unithead);
                                         $('#section_list').html(sectionlist);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(sectionlist)
                                    {
                                        alert('error occurs');
                                    }


                        })
                    })



                                      // select section if dept has section according to selected dept
                                      $('.sec').change(function()
                    {
                      
                        var sid=$(this).val();
                       // alert(pid);
                        $.ajax({

                                    url:'<?= base_url() ?>unit/unitbysec',
                                    method:'get',
                                    data:{sid:sid},

                                    success:function(unitlist)
                                    {
                                      // alert(sectionlist);
                                           // id='#'+show;
                                       // $('#my').html(unithead);
                                         $('#unit_list').html(unitlist);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(unitlist)
                                    {
                                        alert('error occurs');
                                    }


                        })
                    })

})


		</script>

<div style="padding: 2%">
	<div class="row">
		<div class="col-lg-12" style="">
			<h1 class="page-header"></h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Unit Management</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" >
					<div class="row">
						<div class="container">
								

							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?php if(isset($action)){echo $action; } ?>">


									<div class="row">
		
			<h3 class="page-header"><?php if(isset($title_head)){echo $title_head;}  ?></h3>
		

	<div class="form-group">
									
                  <label>Program:<strong><font color='red'>*</font></strong></label>
						<?php

            if(isset($subunit->program_id) and !empty($subunit->program_id))
                {
             echo form_dropdown('program_id',$programlist,$subunit->program_id,'class="form-control program"') ;
              }
              else
              {
        echo form_dropdown('program_id',$programlist,'','class="form-control program"') ;
              }

             ?>
									<span class="text-danger"><?=  form_error('program_id') ?></span>
								</div>
					
									<div class="form-group">
									<label>Department:<strong><font color='red'>*</font></strong></label>
              <?php

            if(isset($subunit->department_id) and !empty($subunit->department_id))
                {
                  echo form_dropdown('department_id',$departmentlist,$subunit->department_id,' id="dept_id" class="form-control dept"') ;
              }
              else
              {
        echo form_dropdown('department_id',$departmentlist,'',' id="dept_id" class="form-control dept"') ;
              }

             ?>
									<span class="text-danger"><?=  form_error('department_id') ?></span>
									
								</div>
                                                <div class="form-group">
                                                    <label>Section</label>
                                                   <?php

            if(isset($subunit->section_id) and !empty($subunit->section_id))
                {
                  echo form_dropdown('section_id',$sectionlist,$subunit->section_id,' id="section_list" class="form-control sec"') ;
              }
              else
              {
          echo form_dropdown('section_id',$sectionlist,'',' id="section_list" class="form-control sec"') ;
              }

             ?><div class="text text-danger"><?= form_error('section_id') ?></div>
                                                </div>


                                                                                                <div class="form-group">
                                                    <label>Unit</label>
                                                   <?php

            if(isset($subunit->unit_id) and !empty($subunit->unit_id))
                {
                  echo form_dropdown('unit_id',$unitlist,$subunit->unit_id,' id="unit_list" class="form-control unit"') ;
              }
              else
              {
          echo form_dropdown('unit_id',$unitlist,'',' id="unit_list" class="form-control unit"') ;
              }

             ?><div class="text text-danger"><?= form_error('unit_id') ?></div>
                                                </div>
									
														<div class="form-group">
													<label>Sub Unit Name:<strong><font color='red'>*</font></strong></label>
													<input type="text" value="<?= isset($subunit->sub_uname)?$subunit->sub_uname:'' ?>"  name="sub_uname" class="form-control">
													<span class="text-danger"><?=  form_error('sub_uname') ?></span>
						</div>



													<div class="form-group ">
									<label>Sub Unit Head:<strong><font color='red'>*</font></strong></label>
									
																			<?php
											if(isset($subunit->sub_uhead) && !empty($subunit->sub_uhead))
																					
											{
												echo form_dropdown('sub_uhead', $userlist , $subunit->sub_uhead,"id = 'lol' class='form-control '");
											}
                      else
                      {
                echo form_dropdown('sub_uhead', $userlist ,'',"id = 'lol' class='form-control '");
                      }
										?>
									<span class="text-danger"><?=  form_error('sub_head') ?></span>
								</div>

									

								<div class="form-group">
									<input type="submit" value="save" name="submit" class="btn btn-success" style="color:white;background-color: #ef0f0f;border-color:#ef0f0f">
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