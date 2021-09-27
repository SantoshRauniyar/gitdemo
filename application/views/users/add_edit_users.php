<script type="text/javascript">
	 $(document).ready(function(){


        $('#cz').hide();

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
                                       // alert(state);
                                           // id='#'+show;
                                        $('#state_id').html(state);
                                        //$('#district_list').html('<option>Select District</option>');
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
                          // alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_districtByStateId',
                                    method:'get',
                                    data:{state:state},

                                    success:function(district)
                                    {
                                       //alert(district);
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
                                        $('#city_id').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })
                        
                        $('.roles').change(function(){
                            
                            
                            
                            var role_type=$(this).val();
                           // alert(role_type);
                            
                            if(role_type==19){
                                $('#cz').show();
                            }else
                            {
                                $('#cz').hide();
                            }
                            
                            
                            
                        })
                        
                        
                         $('.city').change(function()
                    {
                               
                             
                               var cid=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!cid)) {alert("Please Select State ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_czByCity',
                                    method:'get',
                                    data:{cid:cid},

                                    success:function(cz)
                                    {
                                            console.log(cz); 
                                        $('#cityzone_id').html(cz);
                                        
                                         
                                         
                                    },
                                   error:function(cz)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })



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
                        
                               $('.sec').change(function()
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
						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
								<?php if($mode == "edit"){?>
								<input type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />
								<div class="form-group pull-right">
									<img src="<?php if(isset($profile_image) && $profile_image != ''){echo base_url('assets/upload/users/'.$profile_image);}else{echo base_url('assets/images/images.jpeg');}?> " height="100" width="100" />
								</div>
								<div class="clearfix"></div>
								<?php } ?>
								<div class="form-group">
									<label>First Name:<strong><font color='red'>*</font></strong></label>
									<input id="first_name" name="first_name" class="form-control" value="<?php if(isset($first_name)){echo $first_name;}?>" >
								</div>
								<div class="form-group">
									<label>Last Name:<strong><font color='red'>*</font></strong></label>
									<input id="last_name" name="last_name" class="form-control" value="<?php if(isset($last_name)){echo $last_name;}?>" >
								</div>
								<div class="form-group">
									<label>User Name:<strong><font color='red'>*</font></strong></label>
									<input id="user_name" name="user_name" class="form-control" value="<?php if(isset($user_name)){echo $user_name;}?>">
								</div>
								<?php if($mode == "Add"){?>
								<div class="form-group">
									<label>Password:<strong><font color='red'>*</font></strong></label>
									<input type="password" id="password" name="password" class="form-control" value="" >
								</div>
								<div class="form-group">
									<label>Confirm Password:<strong><font color='red'>*</font></strong></label>
									<input type="password" id="confirm_password" name="confirm_password" class="form-control" value="" >
								</div>
								<?php } ?>

								<div class="row">

									<div class="col-md-3">
												<label>Upload ID Proof</label>	
							<input class="form-control" name="id_proof" type="file">
									</div>

									<div class="col-md-3">
										<div class="form-group" >
																<label>Upload Address Proof</label>	
							<input class="form-control" name="address_proof" type="file">
								</div>
									</div>
									<div class="col-md-3">
										<div class="form-group" >
									
																	<label>Upload Offer Letter</label>	
							<input class="form-control" name="offer_letter" type="file">
								</div>
									</div>
									
									
								</div>
<!-- 								<div class="form-group"> -->
<!-- 									<lable>Select Team</lable> -->
									<?php
// 										if(isset($team_id))
// 										{
// 											echo form_dropdown("team_id",$teamlist,$team_id,"class = 'form-control'");
// 										} 
// 										else
// 										{
// 											echo form_dropdown("team_id",$teamlist,'',"class = 'form-control'");
// 										}
// 									?>
<!-- 								</div> -->
							
								<!--<div class="form-group">
									<label>Birth Date:<strong><font color='red'>*</font></strong></label>
									<input id="birth_date" name="birth_date" class="form-control" value="" >
								</div>-->
								<div class="form-group col-md-6">
                					<label for="dtp_input2" class="control-label">Birth Date:</label>
                					<div class="input-group date form_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    					<input class="form-control" size="16" type="text" value="<?php if(isset($birth_date)){echo $birth_date;}?>" readonly="true">
                    					<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
										<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                					</div>
									<input type="hidden" id="dtp_input2" name="birth_date" value="<?php if(isset($birth_date)){echo $birth_date;}?>" /><br/>
           						</div>
								<div class="form-group col-md-6">
                               	<label>Gender:</label>
                                   <label class="radio-inline">
                                    	<input type="radio" name="gender" id="gender" value="1" <?php if(isset($gender) && $gender == 1){echo "checked";}?>>Male
									</label>
									<label class="radio-inline">
										<input type="radio" name="gender" id="gender" value="2" <?php if(isset($gender) && $gender == 2){echo "checked";}?>>Female
									</label>
								</div>
								<div class="form-group col-md-6">
                                	<label>Profile Image:</label>
									<label class="radio-inline">
                                    	<input type="file" id="profile_image" name="profile_image">
									</label>
                                </div>
								<div class="form-group">
									<label>Address:</label>
									<textarea id="address" name="address" class="form-control" ><?php if(isset($address)){echo $address;}?></textarea>
								</div>
								<div class="form-group">
										<lable>Country:</label>
										<?php
											if(isset($country_id) && !empty($country_id))
											{
												echo form_dropdown('country_id',$countrylist,$country_id,"id = 'country_id' class='form-control country' '");
											}
											else
											{
												echo form_dropdown('country_id',$countrylist,'',"id = 'country_id' class='form-control country'");
											}
										?>
									</div>
									<div class="form-group" id="statelist">
										<lable>State:</label>
										<?php
											if(isset($state_id) && !empty($state_id))
											{
												echo form_dropdown('state_id',$statelist,$state_id,"id = 'state_id' class='form-control state'");
											}
											else
											{
												echo form_dropdown('state_id',$statelist,'',"id = 'state_id' class='form-control state'");
											}
										?>
									</div>
									
																	<div class="form-group" id="citylist"> 
										<lable>District:</label>
										<?php
											if(isset($cz_id) && !empty($cz_id))
											{
												echo form_dropdown('city_zone_id',$cityzonelist,$cz_id,"id = 'city_id' class='form-control'");
											}
											else
											{
												?>
												<!--cz_id city zone ID
												<select class="form-control district" name="district" id="district_list">
												    <option value="">Select District</option>
												   
												</select>-->
												<?php
											if(isset($district) && !empty($district))
											{
												echo form_dropdown('district',$districtlist,$district,"id = 'district_list' class='form-control district'");
											}
											else
											{
												echo form_dropdown('district',$districtlist,'',"id = 'district_list' class='form-control district'");
											}
										?>
												
												<?php
											}
										?>
									</div>
									
									<div class="form-group" id="citylist"> 
										<lable>City:</label>
										<?php
											if(isset($city_id) && !empty($city_id))
											{
												echo form_dropdown('city_id',$citylist,$city_id,"id = 'city_id' class='form-control'");
											}
											else
											{
												echo form_dropdown('city_id',$citylist,'',"id = 'city_id' class='form-control city'");
											}
										?>
									</div>	
									<div class="form-group" id="cz"> 
										<lable>City Zone:</label>
										<?php
											if(isset($cz_id) && !empty($cz_id))
											{
												echo form_dropdown('city_zone_id',$cityzonelist,$cz_id,"id = 'city_id' class='form-control'");
											}
											else
											{
												?>
												<!--cz_id city zone ID-->
												<select class="form-control"id="cityzone_id"  name="cityzone">
												    <option value="">Select City Zone</option>
												    <?php
												    foreach($cityzonelist as $value)
												    {
												        ?>
												        <option value="<?= $value->id ?>"><?= $value->city_zone ?></option>
												        <?php
												    }
												    
												    ?>
												</select>
												
												<?php
											}
										?>
									</div>
								<div class="form-group">
									<label>Email Address:<strong><font color='red'>*</font></strong></label>
									<input id="email" name="email" class="form-control" value="<?php if(isset($email)){echo $email;}?>" >
								</div>
								<div class="form-group">
									<label>Contact Number:</label>
									<input id="contact_no" name="contact_no" class="form-control" value="<?php if(isset($contact_no)){echo $contact_no;}?>" >
								</div>
								<div class="form-group">
									<lable>Select your Country time zone :</lable>
									<?php
										echo timezone_menu('UTC',"form-control","timezone");
									?>
								</div>
								
								<input type="submit" class="btn btn-primary" value="<?php if($mode == 'edit'){echo 'Update';}else{echo 'Save';}?>" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">	
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