<div class="container">
	        <div class="row">
	            <div class="col-md-8 col-md-offset-2">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
	                        <h3 class="panel-title"><strong>Locations Management</strong></h3>
	                    </div>
	                    <div class="panel-body">
						<?php $this->load->view('common/errors');?>
	                        <form role="form" method="post" action="<?= base_url('users/do_update_country').'/'.$country->id?>" >
	                        	<div>
	                        		<h3>Edit Country</h3>
	                        		<br>
	                        	</div>
	                            <fieldset>
									<span class="text-success"><?= $this->session->userdata('added')?"Country Successfully Added":"" ?></span>
									<span class="text-danger"><?= $this->session->userdata('fail_added')?"Country Successfully Added":"" ?></span>
	                                <div class="form-group">
	                                	<label>Country Name</label>
	                                    <input class="form-control" placeholder="Country Name" name="c_name" type="text" value="<?= $country->country ?>">
	                                    <span class="text-danger"><?= form_error('c_name') ?></span>
	                                </div>
	                                <div class="form-group">
	                                	<label>Country Code</label>
	                                    <input class="form-control" placeholder="Country Code" name="c_code" type="text" value="<?= $country->code ?>">
	                                    <span class="text-danger"><?= form_error('c_code') ?></span>
	                                </div>

	                                <!-- Change this to a button or input when using this as a form -->
	                                <input type="submit" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;"  name="submit" value="Edit Country" class="btn  btn-success">
                            	</fieldset>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <?= var_dump($country) ?>