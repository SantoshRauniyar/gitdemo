<script type="text/javascript">
	 $(document).ready(function(){

         $('.country').mouseleave(function()
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
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(state)
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
	                        <form role="form" method="post" action="<?php echo base_url('users/do_save_district');?>" >
	                        	<div>
	                        		<h3>Add State</h3>
	                        		<br>
	                        	</div>
	                            <fieldset>

	                                <div class="form-group">
	                                	<label>Country Name</label>
	                                    <select class="form-control country" name="country">
	                                    	<option hidden>Select Country</option>
	                                    	<?php
	                                    	foreach ($country as $value) {
	                                    		?>
	                           <option value="<?= $value->id ?>"><?= $value->country ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('country') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>State Name</label>
	                                    <select class="form-control" id="statelist" name="state">
	                                    	<option hidden="">Select State</option>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('state') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>District Name</label>
	                                    <input type="text" class="form-control" name="district_name">
	                                    <span class="text-danger"><?= form_error('district_name') ?></span>
	                                </div>

	                                <!-- Change this to a button or input when using this as a form -->
	                                <input type="submit" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;"  name="submit" value="Add District" class="btn  btn-success">
                            	</fieldset>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>