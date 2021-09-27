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
                          // alert(state);
                              

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
                               
                             
                               var cid=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!cid)) {alert("Please Select State ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_pinsByCity',
                                    method:'get',
                                    data:{cid:cid},

                                    success:function(pins)
                                    {
                                      
                                        $('#pin_list').html(pins);
                                        
                                         
                                         
                                    },
                                   error:function(pins)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })


       })

</script>

<div class="container">
	        <div class="row">
	            <div class="col-md-8 col-md-offset-2">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
	                        <h3 class="panel-title"><strong>Locations Management</strong></h3>
	                    </div>
	                    <div class="panel-body">
						<?php $this->load->view('common/errors');?>
	                        <form role="form" method="post" action="<?php echo base_url('users/do_update_city_zone').'/'.$zone_data[0]->id;?>" >
	                           
	                        	<div>
	                        		<h3>Edit City Zone</h3>
	                        		<br>
	                        	</div>
	                            <fieldset>

	                                <div class="form-group">
	                                	<label>Country Name</label>
	                                    <select class="form-control country" name="country">
	                                    	<option hidden value="">Select Country</option>
	                                    	<?php
	                                    	foreach ($country as $value) {
	                                    		?>
	                           <option value="<?= $value->id ?>"  <?= $zone_data[0]->country_id==$value->id?'selected':'' ?>><?= $value->country ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('country') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>State Name</label>
	                                    <select class="form-control state" id="statelist" name="state">
	                                    	<option hidden="" value="">Select State</option>
	                                    		<?php
	                                    	foreach ($state as $value) {
	                                    		?>
	                           <option value="<?= $value->id ?>"  <?= $zone_data[0]->state_id==$value->id?'selected':'' ?>><?= $value->state ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('state') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>District Name</label>
	                                    <select class="form-control district" id="district_list" name="district">
	                                    	<option hidden="" value="">Select District</option>
	                                    	<?php
	                                    	foreach ($district as $value) {
	                                    		?>
	                           <option value="<?= $value->id ?>"  <?= $zone_data[0]->district_id==$value->id?'selected':'' ?>><?= $value->district_name ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('district') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>City Name</label>
	                               <select class="form-control city" id="city_list" name="city">
	                                    	<option hidden="" value="">Select City</option>
	                                    	<?php
	                                    	foreach ($city as $value) {
	                                    		?>
	                           <option value="<?= $value->city_id ?>"  <?= $zone_data[0]->city_id==$value->city_id?'selected':'' ?>><?= $value->city ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('city') ?></span>
	                                </div>
	                                <div class="form-group">
	                                    <label>Zone's Pincode</label>
	                                   
	                                    <select name="pincode[]" class="form-control" multiple id="pin_list">
	                                       <option>Please First Select City</option>
	                                       <?php
	                                    	foreach ($pins as $value) {
	                                    		?>
	                           <option value="<?= $value ?>" selected><?= $value ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                </div>
	                                <span class="text-danger"><?= form_error('pincode[]') ?></span>
	                                
	                                <div class="form-group">
	                                	<label>Zone Name</label>
	                                   <input type="text"  value="<?= $zone_data[0]->city_zone ?>" class="form-control" name="city_zone">
	                                    <span class="text-danger"><?= form_error('city_zone') ?></span>
	                                </div>
	                                

	                                <!-- Change this to a button or input when using this as a form -->
	                                <input type="submit" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;"  name="submit" value="Update Zone" class="btn  btn-success">
                            	</fieldset>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>