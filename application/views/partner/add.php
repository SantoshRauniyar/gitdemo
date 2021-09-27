 <script type="text/javascript">
 

   $(document).ready(function(){

         $('.country').change(function()
                    {
                               
                             
                               var country=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!country)) {alert("Please Select Country ")}
                              else{
                           //alert(country);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_stateByCountryId',
                                    method:'get',
                                    data:{country:country},

                                    success:function(state)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#statelist').html(state);
                                        $('#district_list').html('<option>Select District</option>');
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(state)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })


                  $('.state').change(function()
                    {
                               
                             
                               var state=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!state)) {alert("Please Select State ")}
                              else{
                        //   alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_districtByStateId',
                                    method:'get',
                                    data:{state:state},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#district_list').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })
                   $('.district').change(function()
                    {
                               
                             
                               var dist=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!dist)) {alert("Please Select State ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_cityByDistrict',
                                    method:'get',
                                    data:{dist:dist},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#city_list').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })



                    $('.comp_country1').change(function()
                    {
                               
                             
                               var comp_country1=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!comp_country1)) {alert("Please Select Country ")}
                              else{
                           //alert(comp_country1);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_stateByCountryId',
                                    method:'get',
                                    data:{country:comp_country1},

                                    success:function(comp_state1)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_statelist1').html(comp_state1);
                                        $('#comp_district_list1').html('<option>Select District</option>');
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(comp_state1)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })



                    $('.comp_state1').change(function()
                    {
                               
                             
                               var comp_state1=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!comp_state1)) {alert("Please Select State ")}
                              else{
                         //  alert(comp_state1);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_districtByStateId',
                                    method:'get',
                                    data:{state:comp_state1},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_district_list1').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })


                        $('.comp_district1').change(function()
                    {
                               
                             
                               var dist=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!dist)) {alert("Please Select State ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_cityByDistrict',
                                    method:'get',
                                    data:{dist:dist},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_city_list1').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })






                          $('.comp_country2').change(function()
                    {
                               
                             
                               var comp_country2=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!comp_country2)) {alert("Please Select Country ")}
                              else{
                           //alert(comp_country1);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_stateByCountryId',
                                    method:'get',
                                    data:{country:comp_country2},

                                    success:function(comp_state2)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_statelist2').html(comp_state2);
                                        $('#comp_district_list2').html('<option>Select District</option>');
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(comp_state2)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })



                    $('.comp_state2').change(function()
                    {
                               
                             
                               var comp_state2=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!comp_state2)) {alert("Please Select State ")}
                              else{
                        //   alert(comp_state2);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_districtByStateId',
                                    method:'get',
                                    data:{state:comp_state2},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_district_list2').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })


                        $('.comp_district2').change(function()
                    {
                               
                             
                               var dist=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!dist)) {alert("Please Select State ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_cityByDistrict',
                                    method:'get',
                                    data:{dist:dist},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_city_list2').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })


                        $('.rangesize1').mouseleave(function(){


                           
                              var l=$(this).val();
                              if (l.length>25)
                               {
                                return alert("Range label should be less than 25 Character");
                                  }
                                   

                        })



                          $('.rangesize2').mouseleave(function(){


                           
                              var l=$(this).val();
                              if (l.length>25)
                               {
                                return alert("Range label should be less than 25 Character");
                                  }
                                   

                        })
                $('.city').change(function()
                    {
                               
                             
                               var city=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!city)) {alert("Please Select City ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_pincodeByCity',
                                    method:'get',
                                    data:{city:city},

                                    success:function(pincode)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#pincode_list').html(pincode);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(pincode)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })


                     $('.city1').change(function()
                    {
                               
                             
                               var city=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!city)) {alert("Please Select City ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_pincodeByCity',
                                    method:'get',
                                    data:{city:city},

                                    success:function(pincode)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#pincode_list1').html(pincode);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(pincode)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })
                       $('.city2').change(function()
                    {
                               
                             
                               var city=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!city)) {alert("Please Select City ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_pincodeByCity',
                                    method:'get',
                                    data:{city:city},

                                    success:function(pincode)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#pincode_list2').html(pincode);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(pincode)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })

       })
       </script>

<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Users</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body" >
				<div class="panel-body" >
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong><?php echo $heading;?></strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
							echo validation_errors('<div class="error">', '</div>'); 
						//	var_dump($data);
						?>
						
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= $action ?>" enctype="multipart/form-data">
					
                                       
                                                    
                    <div class="form-group">
                        <label>Select Country</label>
                        <select name="country" class="form-control country">
                        <option>Select Country</option>
                        <?php
                                
                                foreach($data['countrylist'] as $row)
                                {
                                    echo"<option value='".$row->id."'>".$row->country."</option>";
                                }
                        
                        ?>
                        </select>
                        </div>
                                             
                    <div class="form-group">
                        <label>Select Currency</label>
                        <select name="currency" class="form-control country">
                        <option>Select Currency</option>
                        <?php
                                
                                foreach($data['currencylist'] as $row)
                                {
                                    echo"<option value='".$row->id."'>".$row->cname."</option>";
                                }
                        
                        ?>
                        </select>
                        </div> 
								<div class="form-group">
									<label>Business Name:<strong><font color='red'>*</font></strong></label>
									<input id="business_name" name="business_name" class="form-control"  >
								</div>
								<div class="form-group">
									<label>Address:</label>
									<textarea id="address" name="address" class="form-control" ></textarea>
								</div>
								
								<div class="form-group">
									<label>Select Revenue:</label>
									<select class="form-control" name="revenue">
									   <option>5 %</option>
									
									<option value="10">10 %</option>
									<option value="15">15 %</option>
									<option value="20">20 %</option>
									<option value="25">25 %</option>
									<option value="30">30 %</option>
									<option value="35">35 %</option>
									<option value="40">40 %</option>
									<option value="45">45 %</option>
									<option value="50">50 %</option>
									</select>
								</div>
								<input type='hidden' name="user_role" value="<?php if(isset($assign_role) and !empty($assign_role)){echo $assign_role; } ?>">
								
								<div class="form-group">
									<label>Contact Person Name:<strong><font color='red'>*</font></strong></label>
									<input id="contact_person_name" name="contact_person_name" class="form-control" >
								</div>
									<div class="form-group">
                               	<label>Gender:</label>
                                   <label class="radio-inline">
                                    	<input type="radio" name="gender" id="gender" value="1" >Male
									</label>
									<label class="radio-inline">
										<input type="radio" name="gender" id="gender" value="2">Female
									</label>
								</div>
								
								<div class="form-group">
									<label>Email Address:<strong><font color='red'>*</font></strong></label>
									<input id="email" name="email" class="form-control" >
								</div>
								<div class="form-group">
                					<label for="dtp_input2" class="control-label">Birth Date:</label>
                					
									<input type="date" id="dtp_input2" class="form-control" name="birth_date"/><br/>
           						</div>
									<div class="form-group">
									<label>Contact Person Phone:<strong><font color='red'>*</font></strong></label>
									<input id="phone" name="phone" class="form-control" >
								</div>
								
								<div class="form-group">
									<label>User Name:<strong><font color='red'>*</font></strong></label>
									<input id="user_name" name="user_name" class="form-control"  >
								</div>
								<div class="form-group">
									<label>Password:<strong><font color='red'>*</font></strong></label>
									<input type="password" id="password" name="password" class="form-control" value="" >
								</div>
								<div class="form-group">
									<label>Confirm Password:<strong><font color='red'>*</font></strong></label>
									<input type="password" id="cpassword" name="cpassword" class="form-control" value="" >
								</div>
								
								
								<input type="submit" class="btn btn-primary"  value="Submit" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">	
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