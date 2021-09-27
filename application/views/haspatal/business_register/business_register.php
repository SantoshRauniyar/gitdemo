<script type="text/javascript">
	
	$(document).ready(function(){

			

                


                  $('.verify').click(function(){
                   
                    var m=$('#mobile').val();
                    alert(m);

                                  



                        $.ajax({

                                    url:'<?= base_url() ?>haspatal_registers/check_business',
                                    method:'post',
                                    data:{m:m},

                                    success:function(data)
                                    {
                                        if(data!=0)
                                        {
                                        
                                       str=data;
                                       console.log(str)
                                       var res = str.split("/");
                                       var full_details=res[1]+'  '+res[2];
                                       
                                       if(res[3]==11){ $('#b_type').val('Pharmacy')}
                                       else if(res[3]==13){ $('#b_type').val('Imagings')}
                                       else if(res[3]==16){ $('#b_type').val('Therapy')}
                                       else if(res[3]==12){ $('#b_type').val('Lab')}
                                       else if(res[3]==14){ $('#b_type').val('Home Care')}
                                       else if(res[3]==17){ $('#b_type').val('Counseling')}
                                       
                                       console.log(res);
                                      // if()
                                           
                                        $('#status').html(full_details);
                                        $('#user_id').val(res[0]);
                                        }
                                        else
                                        {
                                            $('#status').html('Business not found');
                                        }
                                         console.log(data);
                                         
                                    },
                                   error:function(dept)
                                    {
                                        alert('error occurs');
                                    }


                        })

                  })


                   

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

                
                    })


</script>
<style type="text/css">
	.highlight-error {
  border-color: red;
}

</style>
<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"></h1>
      <br>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<br>
	<br>
	<br>
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<div class="panel panel-default">
			<!---	<div class="panel-heading" style="background-color:#ef0f0f;color:white;">
					<strong>Marketing Department</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>-->
				<div class="panel-body ">
					
						<div class="col-lg-12 ">
						<?php 
							$this->load->view('common/errors');
						?>
						<div class="text-center" style="color:red">
						    <img class="img img-responsive" style="height:80px;" src="<?= base_url('assets/logo-360.png') ?>">
						    <h3><b>Assisted Registration Form</b></h3></div><br><br>
					<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('haspatal_registers/save_business')?>" enctype="multipart/form-data">
								
										<div class="form-group">
                            <input type="number" id="mobile" name="mobile" placeholder="Enter Mobile Number" class="form-control">

                    </div>
                <strong><span class="text text-success" id="status">Name  Email</span></strong> <span class="pull-right"><input class="btn btn-info verify" type="button"  style="color:white;background-color:red;border-color:black;" value="Verify"></span>
                    
                    
                    

                            <br><br>
            <input type="hidden" id="user_id" name="user_id">
                    <div class="form-group">
                     
                      <input placeholder="Business Type" type="text" id="b_type" class="form-control" readonly>
                      <span class=" text-danger"><?= form_error('b_type') ?></span>
                    </div>
                
                <div class="form-group">
                    <select name="country" class="form-control country">
                        <option>Select Country</option>
                        <option value="3">India</option>
                    </select>
                </div>
                <div class="form-group">
                    <select name="state" class="form-control state" id="statelist">
                        <option>Select State</option>
                        <?php

                            foreach ($full_list as $key => $value) {
                          ?>
                          <option value="<?=$value->id ?>"><?= $value->state ?></option>
                          <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="district" class="form-control district" id="district_list">
                      <?php  

                          foreach ($dlist as $value) {
                      ?>
                        <option value="<?= $value ?>"><?= $value ?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="city" class="form-control city" id="city_list">
                        <option>Select City</option>
                    </select>
                </div>
        
            
            
                <div class="form-group">
                    <select name="pincode" class="form-control" id="pincode_list">
                        <option>Select Pincode</option>
                        
                    </select>
                </div>
                                <div class="form-group">
                                    <input type="text" name="b_name" class="form-control" placeholder="Business Name">
                                </div>
                                <div class="form-group">
                                    <textarea name="profile" placeholder="Business Profile" class="form-control" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Business Card Picture</label>
                                    <input type="file" class="form-control" name="b_card_pic">
                                </div>
           		               
           		               <div class="form-group">
                                    <label>Business Shop Picture</label>
                                    <input type="file" class="form-control" name="b_shop_pic">
                                </div>
                                <div class="form-group">
                                    <label>Business License Picture</label>
                                    <input type="file" class="form-control" name="b_lic">
                                </div><div class="form-group">
                               <input type="submit" name="submit" value=" Save" class="btn btn-info" style="border-color:#ef0f0f;color:white;background-color: #ef0f0f">
                             </div>
							</form>

				     

					

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