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
	                        		<h3>View Country</h3>
	                        		<br>
	                        	</div>
	                            <fieldset>
									<span class="text-success"><?= $this->session->userdata('added')?"Country Successfully Added":"" ?></span>
									<span class="text-danger"><?= $this->session->userdata('fail_added')?"Country Successfully Added":"" ?></span>
	                                <div class="form-group">
	                                	<label>Country Name</label>
	                                    <input readonly="" class="form-control" placeholder="Country Name" name="c_name" type="text" value="<?= $country->country ?>">
	                                    <span class="text-danger"><?= form_error('c_name') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>Country Code</label>
	                                    <input readonly="" class="form-control" placeholder="Country Code" name="c_code" type="text" value="<?= $country->code ?>">
	                                    <span class="text-danger"><?= form_error('c_code') ?></span>
	                                </div>

	                               
                            	</fieldset>
	                       
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    