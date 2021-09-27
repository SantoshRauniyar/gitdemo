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

                                    url:'<?= base_url() ?>groups/deldeptlistbypro',
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



                                 






                        })
</script>

<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><br><br></h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Program  Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
						?>
						<h3><b>	Department Delete List</b></h3>
						<form id="Grouplistform" name="Grouplistform" method="post" >
                       

							<div class="row">
								<div class="form-group col-md-4">
									<label>Select Program</label>
									<select class="form-control program" id="programlist">
										<option> Please Select Program</option>
										<?php

											foreach ($programlist as $value) {
						?>
										<option value="<?=  $value->pid ?>"><?= $value->pro_name ?></option>

						<?php
											}

										?>
									</select>
								</div>
								
							</div>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
	
									<th>Department		</th>
									<th>Department Head</th>
									<th>Program</th>
									<th align="center">Actions</th>
								</tr>
							</thead>
							<tbody id="deptlist">
							
                            </tbody>
						</table>
						<?php
							if(isset($userdata['links']))
								echo $userdata['links'];
						?>
						</form>
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