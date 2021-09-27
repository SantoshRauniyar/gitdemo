<div class="container">
	        <div class="row">
	            <div class="col-md-8 col-md-offset-2">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
	                        <h3 class="panel-title"><strong>Locations Management</strong></h3>
	                    </div>
	                    <div class="panel-body">
						<?php $this->load->view('common/errors');?>
	                       
	                           
	                        	<div>
	                        		<h3>VIew City Zone</h3>
	                        		<br>
	                        	</div>
	                            <fieldset>

	                                <div class="form-group">
	                                	<label>Country Name</label>
	                                    <select class="form-control country" name="country" disabled="">
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
	                                    <select class="form-control state" id="statelist" name="state" disabled="">
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
	                                    <select class="form-control district" id="district_list" name="district" disabled="">
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
	                               <select class="form-control city" id="city_list" name="city" disabled="">
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
	                                   
	                                    <select name="pincode[]" class="form-control" multiple id="pin_list" disabled="">
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
	                                   <input readonly="" type="text"  value="<?= $zone_data[0]->city_zone ?>" class="form-control" name="city_zone">
	                                    <span class="text-danger"><?= form_error('city_zone') ?></span>
	                                </div>
	                                

	                                <!-- Change this to a button or input when using this as a form -->
	                                <a href="<?=  base_url('cityzonelist/view_list') ?>" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;"   class="btn  btn-success">Back</a>                            	</fieldset>
	                        
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>