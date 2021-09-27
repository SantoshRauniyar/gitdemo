
<script type="text/javascript">
	
	$(document).ready(function(){

			
                 
                               $('.country').change(function()
                    {
                               
                              var cid=$(this).val();
                             
                             //alert(cid);
                               $.ajax({

                                    url:'<?= base_url() ?>users/get_stateByCountryId',
                                    method:'get',
                                    data:{country:cid},

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


                                 $('.state').change(function()
                    {
                               
                              var sid=$(this).val();
                              var cid=$('#country_id').val();
                             // var dname=$(this).attr('dept');
                             var view_mode='<?= $view_as ?>';
                              
                             //alert(cid);
                               $.ajax({

                                    url:'<?= base_url() ?>users/districtEasyNavigation',
                                    method:'get',
                                    data:{cid:cid,action:view_mode,sid:sid},

                                    success:function(state)
                                    {
                                      console.log(state);
                                        $('#district_list').html(state);
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
			<h1 class="page-header">Content Category List</h1>
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
						
									<h3>	<b><?= isset($heading)?$heading:"" ?></b></h3>
									
						<form id="Grouplistform" name="Grouplistform" method="post" >
                       <br>
                       <div class="row">
                       	<div class="col-md-6">
                       		<select class="form-control country" id="country_id">
                       			<option value="">Select Country</option>
                       			<?php
                       					foreach ($country as $value) {
                       						?>
                       						<option value="<?= $value->id ?>"><?= $value->country ?></option>
                       						<?php
                       					}
                       			?>
                       		</select>
                       	</div>
                       		<div class="col-md-6">
                       		<select class="form-control state" id="state_list">
                       			<option value="">Select State</option>
                       			
                       		</select>
                       	</div>
                       </div>
                       	<br>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Sr.</th>
									<th>District</th>
									<th>State Name</th>
									<th>Country Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="district_list">
				
								
								
						
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