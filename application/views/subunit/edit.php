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
                                       alert(sectionlist);
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

})


		</script>

<div style="padding: 2%">
	<div class="row">
		<div class="col-lg-12" style="">
			<h1 class="page-header"><br><br></h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<?php $ulist=$unitlist[0]; ?>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Program Management</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" >
					<div class="row">
						<div class="container">
								

							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('unit/do_update').'/'.$ulist->id ?>">


									<div class="row">
		
			<h3 class="page-header">Edit An Unit</h3>
		

	<div class="form-group">
									<label>Program:<strong><font color='red'>*</font></strong></label>
									<select class="form-control program" name="program" id="program_id">
											
											<?php
											foreach ($program as $value) {
										?>
		<option value="<?=$value->pid ?>" <?= $ulist->program==$value->pro_name?'selected':''?>><?=$value->pro_name ?></option>


										<?php
											}


											?>


									</select>
									<span class="text-danger"><?=  form_error('program') ?></span>
								</div>
					
									<div class="form-group">
									<label>Department:<strong><font color='red'>*</font></strong></label>
									<select class="form-control dept" name="dept" id="dept_id">
									<?php
											foreach ($dept as $value) {
										?>

											<option value="<?=$value->did ?>"<?= $value->did==$ulist->dept?'selected':''?>><?=$value->dtitle ?></option>


										<?php
											}


											?>	
									</select>
									<span class="text-danger"><?=  form_error('dept') ?></span>
									
								</div>
         <div class="form-group">
                                                    <label>Section</label>
                                                    <select name="section_id" class="form-control" id="section_list">
                                                        <option value="">Select  </option>
                                                        <?php
                                                            
                                                            foreach($section as $value)
                                                            {
                                                                ?>
                                                                <option value="<?= $value->id ?>" <?= $value->id==$ulist->section_id?"selected":"Not Applicable" ?>><?= $value->section_name.$ulist->section_id ?></option>
                                                                <?php
                                                            }
                                                        
                                                        ?>
                                                    </select>
                                                </div>
									
														<div class="form-group">
													<label>Unit Name:<strong><font color='red'>*</font></strong></label>
													<input type="text" value="<?= $ulist->unit_name ?>"  name="unit_name" class="form-control">
													<span class="text-danger"><?=  form_error('unit_name') ?></span>
						</div>



													<div class="form-group ">
									<label>Unit Head:<strong><font color='red'>*</font></strong></label>
																	<?php
											if(isset($ulist->uhead) && !empty($ulist->uhead))
																					
											{
												echo form_dropdown('unithead',$userlist,$ulist->uhead,"id = 'lol' class='form-control '");
											}
											
										?>
									<span class="text-danger"><?=  form_error('unithead') ?></span>
								</div>

									

								<div class="form-group">
									<input type="submit" value="Update" name="submit" class="btn btn-success" style="color:white;background-color: #ef0f0f;border-color:#ef0f0f">
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