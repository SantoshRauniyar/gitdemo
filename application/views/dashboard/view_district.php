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
	                        		<h3>View District</h3>
	                        		<br>
	                        	</div>
	                            <fieldset>

	                                <div class="form-group">
	                                	<label>Country Name</label>

	                                    <select disabled="" class="form-control country" name="country">
	                                    	<option hidden>Select Country</option>
	                                    	<?php
	                                    	foreach ($country as $value) {
	                                    		?>
	                           <option value="<?= $value->id ?>"<?=$district->country_id==$value->id?"selected":"" ?> ><?= $value->country ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('country') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>State Name</label>
	                                    <select disabled="" class="form-control" id="statelist" name="state">
	                                    	<option hidden="">Select State</option>
	                                    	<?php
	                                    	foreach ($state as $value) {
	                                    		?>
	                           <option value="<?= $value->id ?>"<?=$district->state_id==$value->id?"selected":"" ?> ><?= $value->state ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('state') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>District Name</label>
	                                    <input readonly="" type="text" class="form-control" value="<?=$district->district_name ?>" name="district_name">
	                                    <span class="text-danger"><?= form_error('district_name') ?></span>
	                                </div>

	                               
                            	</fieldset>
	                        
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>