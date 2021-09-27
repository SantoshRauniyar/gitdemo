
	<script type="text/javascript">
	
	$(document).ready(function(){

			$('#secondform').hide();
                 //check all order by OID
                               $('.country').change(function()
                    {
                               
                              var cid=$(this).val();
                             // var dname=$(this).attr('dept');
                             var view_mode='<?= $view_as ?>';
                              
                             //alert(cid);
                               $.ajax({

                                    url:'<?= base_url() ?>users/stateEasyNavigation',
                                    method:'get',
                                    data:{cid:cid,action:view_mode},

                                    success:function(state)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#state_list').html(state);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(state)
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
			<h1 class="page-header">Pincode List</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Locations Management </strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
							if ($this->session->userdata('failedcountry')) {
								echo "Replies not available!!";
							}
						?>
									<h3>	<b><?= isset($heading)?$heading:"" ?></b></h3>
									<br>
						<form id="Grouplistform" name="Grouplistform" method="post" >
                       

							<div class="row">
								<div class="col-md-6">
									<select class="form-control country" name="country">
										<option value="">Select Country</option>
										<?php

										foreach ($country as  $value) {
											
											?>
												<option value="<?= $value->id ?>"><?= $value->country ?></option>
											<?php

										}

										?>
									</select>
								</div>
							</div>
								<br>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Sr.</th>
									<th>State Name</th>
									<th>Country Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="state_list">
				
								
								
						
                            </tbody>
						</table>
					
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