		<script type="text/javascript">
			
 
$(document).ready(function(){






                 //check all order by OID
                               $('.head').change(function()
                    {
                        var id=$(this).val();
                        var dept_uid=$('#dept_id').val();
                         
                          res=dept_uid.split('-');

                        uid=res[1];

                       // alert(id+uid);

                       // alert(id+dept_uid);


                        $.ajax({

                                    url:'<?= base_url() ?>users/getusers',
                                    method:'get',
                                    data:{uid:id,did:uid},

                                    success:function(unithead)
                                    {
                                       // alert(unithead);
                                           // id='#'+show;
                                        $('#my').html(unithead);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(unithead)
                                    {
                                        alert('error occurs');
                                    }


                        })
                    })



                                //check all order by OID
                               $('.dept').change(function()
                    {
                        var dept_uid=$(this).val();
            


                        $.ajax({

                                    url:'<?= base_url() ?>users/getusers',
                                    method:'get',
                                    data:{did:dept_uid},

                                    success:function(unithead)
                                    {
                                       // alert(unithead);
                                           // id='#'+show;
                                        $('#my').html(unithead);
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
                                       // alert(departmentlist);
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
					<strong>Section Management</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" >
					<div class="row">
						<div class="container">
								<?php 
							$this->load->view('common/errors');
						?>

							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('section/do_save') ?>">


									<div class="row">
		
			<h3 class="page-header">Create Section</h3>
		

	<div class="form-group">
									<label>Program:<strong><font color='red'>*</font></strong></label>
									<select class="form-control program" name="program">
										<option>Select Please</option>
											
											<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pid ?>"><?=$value->pro_name ?></option>


										<?php
											}


											?>


									</select>
									<span class="text-danger"><?=  form_error('program') ?></span>
								</div>
					
									<div class="form-group">
									<label>Department:<strong><font color='red'>*</font></strong></label>
									<select class="form-control dept" name="dept" id="dept_id">
									<option> Select Please</option>
									</select>
									<span class="text-danger"><?=  form_error('dept') ?></span>
									
								</div>

									
														<div class="form-group">
													<label>Section Name:<strong><font color='red'>*</font></strong></label>
													<input type="text"   name="section_name" class="form-control">
													<span class="text-danger"><?=  form_error('section_name') ?></span>
						</div>



													<div class="form-group ">
									<label>Section Head:<strong><font color='red'>*</font></strong></label>
									
									
									
									<?php
											if(isset($userlist) && !empty($userlist))
																					
											{
												echo form_dropdown('section_head',$userlist,'',"id = '' class='form-control '");
											}
										?>
									
									
									<span class="text-danger"><?=  form_error('section_head') ?></span>
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