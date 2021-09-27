

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
	                        		<h3>View City</h3>
	                        		<br>
	                        	</div>
	                            <fieldset>

	                                <div class="form-group">
	                                	<label>Country Name</label>
	                                    <select disabled="" class="form-control country" name="country">
	                                    	<option hidden value="">Select Country</option>
	                                    	<?php
	                                    	foreach ($country as $value) {
	                                    		?>
	                           <option value="<?= $value->id ?>"<?= $city->country_id==$value->id?"selected":"" ?>><?= $value->country ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('country') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>State Name</label>
	                                    <select disabled="" class="form-control state" id="statelist" name="state">
	                                    	<option hidden="" value="">Select State</option>
	                                    	<?php
	                                    	foreach ($state as $value) {
	                                    		?>
	                           <option value="<?= $value->id ?>"<?= $city->state_id==$value->id?"selected":"" ?>><?= $value->state ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('state') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>District Name</label>
	                                    <select disabled="" class="form-control" id="district_list" name="district">
	                                    	<option hidden="" value="">Select District</option>
	                                    	<?php
	                                    	foreach ($district as $value) {
	                                    		?>
	                           <option value="<?= $value->id ?>"<?= $city->district_id==$value->id?"selected":"" ?>><?= $value->district_name ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('district') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>City Name</label>
	                                   <input readonly="" type="text" value="<?= $city->city ?>" class="form-control" name="city">
	                                    <span class="text-danger"><?= form_error('city') ?></span>
	                                </div>

	                               
                            	</fieldset>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>