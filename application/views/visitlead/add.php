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
						
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('visited_leads/do_save') ?>" enctype="multipart/form-data">
					
                                                 
                                                        <div class="form-group">
                                                            
                                                            <label>Select Pincode</label>
                                                            <select class="form-control"  name="pincode">
                                                                <?php
                                                                if(count($pincode)>0)
                                                                {
                                                                foreach($pincode as $pin)
                                                                {
                                                                    echo'<option value="'.$pin->pincode.'">'.$pin->pincode.'</option>';
                                                                }
                                                                }
                                                                else
                                                                {
                                                                    echo'<option value="">Sorry Contact your Admin</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                 
                            								<div class="form-group">
									<label>Lead Name :<strong><font color='red'>*</font></strong></label>
									<input  name="lead_name" class="form-control" >
								</div>
									<div class="form-group">
									<label>Lead Shop Picture :</label>
									<input type="file" name="shop_pic" class="form-control">
								</div>
								<div class="form-group">
									<label>Lead Card Picture :</label>
									<input type="file" name="card_pic" class="form-control">
								</div>
								<div class="form-group">
									<label>Lead Comments :<strong><font color='red'>*</font></strong></label>
									<textarea id="business_name" name="lead_comments" class="form-control" col='10'  rows='5'></textarea>
								</div>
								<div class="form-group">
									<label>Your Comments :<strong><font color='red'>*</font></strong></label>
									<textarea id="business_name" name="your_comments" class="form-control" col='10'  rows='5'></textarea>
								</div>
							

								
								<div class="form-group">
									<label>Is Next Visit :</label>
									<input type="radio" value="1" name="is_next_visit"> Yes &nbsp;&nbsp;&nbsp;&nbsp; <input value="0" type="radio" name="is_next_visit"> No
								</div>
							
								<div class="form-group">
                					<label for="dtp_input2" class="control-label">Lead Date:</label>
                					
									<input type="date" id="dtp_input2" class="form-control" name="date"/><br/>
           						</div>
									<div class="form-group">
									
								<button type="submit" class="btn btn-primary" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">	Submit </button>
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