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
                             
                              
                             //alert(cid);
                               $.ajax({

                                    url:'<?= base_url() ?>users/get_districtByStateId',
                                    method:'get',
                                    data:{state:sid},

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


                                 	$('.district').change(function()
                    {
                               
                              var did=$(this).val();

                             
                              
                             //alert(cid);
                               $.ajax({

                                    url:'<?= base_url() ?>users/get_cityByDistrict',
                                    method:'get',
                                    data:{dist:did},

                                    success:function(city)
                                    {
                                      console.log(city);
                                        $('#city_list').html(city);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(city)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })


                                 	$('.city').change(function()
                    {
                               
                              var city_id=$(this).val();

                             
                              
                             //alert(cid);
                               $.ajax({

                                    url:'<?= base_url() ?>users/pincodeEasyNavigation',
                                    method:'get',
                                    data:{city_id:city_id,action:'<?= $view_as ?>'},

                                    success:function(pincode)
                                    {
                                      console.log(pincode);
                                        $('#pincode_list').html(pincode);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(pincode)
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
			<h1 class="page-header">Pincode  List</h1>
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
                       	<div class="col-md-3">
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
                       		<div class="col-md-3">
                       		<select class="form-control state" id="state_list">
                       			<option value="">Select State</option>
                       			
                       		</select>
                       	</div>
                       	<div class="col-md-3">
                       		<select class="form-control district" id="district_list">
                       			<option value="">Select District</option>
                       			
                       		</select>
                       	</div>
                       	                       	<div class="col-md-3">
                       		<select class="form-control city" id="city_list">
                       			<option value="">Select City</option>
                       			
                       		</select>
                       	</div>
                       </div>
                       	<br>

						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Pincode</th>
									<th>City</th>
									<th>District</th>
									<th>State Name</th>
									<th>Country Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="pincode_list">
				
								
								
						
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