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
	                        		<h3>View State</h3>
	                        		<br>
	                        	</div>
	                            <fieldset>

	                                <div class="form-group">
	                                	<label>Country Name</label>
	                                    <select disabled="" class="form-control" name="c_id">
	                                    	<option hidden>Select Country</option>
	                                    	<?php
	                                    	foreach ($country as $value) {
	                                    		?>
	                           <option value="<?= $value->id ?>" <?= $state_data->country_id==$value->id?"selected":"" ?>><?= $value->country ?></option>
	                                    		<?php
	                                    	}
	                                    	?>
	                                    </select>
	                                    <span class="text-danger"><?= form_error('c_id') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>State Name</label>
	                                    <input readonly="" class="form-control" placeholder="State Name" name="state_name" value="<?= $state_data->state ?>" type="text">
	                                    <span class="text-danger"><?= form_error('state_name') ?></span>
	                                </div>

	                                <!-- Change this to a button or input when using this as a form -->
	                                
                            	</fieldset>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>