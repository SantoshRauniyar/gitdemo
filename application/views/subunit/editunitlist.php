<script type="text/javascript">
	
	$(document).ready(function(){

			$('#secondform').hide();
                 //check all order by OID
                               $('.program').change(function()
                    {
                               
                              var pid=$(this).val();
                             // var dname=$(this).attr('dept');
                              
                            // alert(pid);
                               $.ajax({

                                    url:'<?= base_url() ?>groups/deptbypro',
                                    method:'get',
                                    data:{pid:pid},

                                    success:function(dept)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#deptlist').html(dept);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(dept)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })


                                  $('.dept').change(function()
                    {
                               
                              var did=$(this).val();
                              //var pid=$('#programlist').val();
                             // var dname=$(this).attr('dept');
                              
                            
                               $.ajax({

                                    url:'<?= base_url() ?>section/sectionbydept',
                                    method:'get',
                                    data:{did:did},

                                    success:function(section)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#seclist').html(section);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(section)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })



                                 
                                  	//select unit list  by section

                                  	        $('.sec').change(function()
                    {
                               
                              var sid=$(this).val();

                             // var dname=$(this).attr('dept');
                              
                           //  alert(pid+did);
                               $.ajax({

                                    url:'<?= base_url() ?>unit/uniteditbydept',
                                    method:'get',
                                    data:{sid:sid},

                                    success:function(unit)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#unitlist').html(unit);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(unit)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })





                        })
</script>
<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"></h1>
		</div>
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Unit Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
						?>
					<h3>Edit Unit List</h3>
					<div class="row">
											<div class="form-group col-md-4">
												<label>Select Program</label>
												<select class="form-control program" id="programlist">
																		<option>Select Please</option>
																<?php

																	foreach ($programlist as  $value) {
																		?>

																			<option value="<?= $value->pid ?>"><?= $value->pro_name ?></option>


																		<?php
																	}

																?>


												</select>
											</div>

											<div class="form-group col-md-4">
												<label>Select Department</label>
												<select class="form-control dept" id="deptlist">
																
															<option>Select Please</option>


												</select>
											</div>
						<div class="form-group col-md-4">
								<label>Select Section</label>
								<select class="form-control sec" id="seclist">		
							<option>Select Please</option>
									</select>
											</div>
										</div>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<!-- <th><input type="checkbox" id="checkall" name="checkall" onclick="checkUncheck();"></th>-->
									<th>Unit Name</th>
									<th>Program</th>
									<th>Department</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="unitlist">
						     </tbody>
						</table>
					
			
					</div>
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->