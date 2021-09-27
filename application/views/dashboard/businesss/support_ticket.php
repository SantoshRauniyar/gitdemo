<div class="container">
	        <div class="row">
	            <div class="col-md-8 col-md-offset-2">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
	                        <h3 class="panel-title">Support Ticket Management</h3>
	                    </div>
	                    <div class="panel-body">
						<?php $this->load->view('common/errors');?>
	                        
	                        	<div>
	                        		<h3>Support Ticket</h3>
	                        		<br>
	                        	</div>
	                            <fieldset>
        <form class="form-group" method="post" action="<?=  base_url('dashboard/set_ticket') ?>">
            
        
	                                <div class="form-group">
	                                	<label>OTP Verified at</label>

	                                    <input type="text" class="form-control" value="<?= $data->created_at ?>" readonly>
	                                    
	                                </div>
	                                
	                                <div class="form-group">
	                                	<label>Business Name</label>

	                                    <input type="text" class="form-control" value="<?= $data->b_name ?>" readonly>
	                                    
	                                </div>
	                                <div class="form-group">
	                                	<label>Business Type</label>

	                                    <input type="text" class="form-control" value=" <?php  
									    
									    switch($data->b_type)
									    {
									        case 11:
									            echo'Pharmacy';
									            break;
									            case 13:
									            echo'Imagings';
									            break;
									            case 16:
									            echo'Therapy';
									            break;
									            case 17:
									            echo'Counseling';
									            break;
									            case 14:
									            echo'Home Care';
									            break;
									            case 12:
									            echo'Lab';
									            break;
									            default:
									                echo'Business not selected';
									    }
									    
									    ?>
									   " readonly>
	                                    
	                                </div>
	                                <div class="form-group">
	                                	<label>Mobile</label>

	                                    <input type="text" class="form-control" value="<?= $data->mobile ?>" readonly>
	                                    
	                                </div>
	                                
	                                <div class="form-group">
	                                	<label>Email</label>

	                                    <input type="text" class="form-control" value="<?= $data->email ?>" readonly>
	                                    
	                                </div>
	                                
	                                <div class="form-group">
	                                    <label>Remarks</label>
	                                    <textarea name="remarks" placeholder="Remarks" class="form-control"></textarea>
	                                </div>
	                                
	                                
	                                <div class="form-group">
	                                    <button name="set"  class="btn btn-success">Create Ticket</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= base_url('dashboard/discard_business/').'/'.$data->id.'/'.$data->b_type ?>"  onclick="return confirm('Are you sure to discard it ?')" class="btn btn-danger">Discard Ticket</a>
	                                </div>
	                                
                            	</fieldset>
	                        
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>