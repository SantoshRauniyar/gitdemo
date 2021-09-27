<div class="container">
	        <div class="form-group">
	            <div class="col-md-8 col-md-offset-2">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
	                        <h3 class="panel-title">Doctor Management</h3>
	                        	<strong><?php

																switch ($data[0]->status) {
																	case '0':
																		echo "Not Assigned";
																		break;
																		case '1':
																		echo "Pending";
																		break;
																		case '2':
																		echo "Approved";
																		break;
																		case '3':
																		echo "Hold";
																		break;
																		case '4':
																		echo "Rejected";
																		break;
																			
																	
																}

															?></strong>
															
				</div>
	                   
	                    <div class="panel-body">
						<?php $this->load->view('common/errors');?>
	                        
	                        	<div>
	                        		<h3>View Doctor Details</h3>
	                        		<br>
	                        		
	                        	</div>
	                        	<form class="form-group">
	                        	    <div class="row">
	                        	        <div class="col-sm-4 col-md-4">
	                        	        <label>Dr. ID</label>
	                        	        <input readonly class="form-control" value="<?= $data[0]->d_uni_id ?>">
	                        	    </div>
	                        	    <div class="col-sm-4 col-md-4">
	                        	        <label>Speciality</label>
	                        	        <input readonly class="form-control" value="<?= $data[0]->spl_name ?>">
	                        	    </div>
	                        	     <div class="col-sm-4 col-md-4">
	                        	        <label>Dr. Name</label>
	                        	        <input readonly class="form-control" value="<?= $data[0]->first_name ?>">
	                        	    </div>
	                        	    </div>
	                        	    <br>
	                        	    <div class="row">
	                        	        <div class="col-sm-4 col-md-4">
	                        	        <label>Email</label>
	                        	        <input readonly class="form-control" value="<?= $data[0]->email ?>">
	                        	    </div>
	                        	     <div class="col-sm-4 col-md-4">
	                        	        <label>Mobile</label>
	                        	        <input readonly class="form-control" value="<?= $data[0]->main_mobile ?>">
	                        	    </div>
	                        	    <div class="col-sm-4 col-md-4">
	                        	        <label>Year of Graduation</label>
	                        	        <input readonly class="form-control" value="<?= $data[0]->year_of_graduation ?>">
	                        	    </div>
	                        	    </div>
	                        	    <br>
	                        	     <div class="row">
	                        	        <div class="col-sm-4 col-md-4">
	                        	        <label>Heighest Qualification</label>
	                        	        <input readonly class="form-control" value="<?= $data[0]->heighest_qualification ?>">
	                        	    </div>
	                        	     <div class="col-sm-4 col-md-4">
	                        	        <label>Co-Ordinator</label>
	                        	        <input readonly class="form-control" value="<?= $data[0]->coordinator ?>">
	                        	    </div>
	                        	    <div class="col-sm-4 col-md-4">
	                        	        <label>License Copy</label>
	                        	          <a href="http://care.haspatal.com/public/media/b_lic/<?= $data[0]->licence_copy ?>" _target="blank" class="badge badge-info">View</a>
	                        	  
	                        	    </div>
	                        	    </div>
	                        	     <br>
	                        	     
	                        	     <div class="row">
	                        	        <div class="col-sm-4 col-md-4">
	                        	        <label>Language</label>
	                        	        <select class="form-control" disabled multiple>
	                        	            <?php 
	                        	        
	                        	        foreach($lang as $row)
	                        	        echo'<option>'.$row->language.'</option>';
	                        	        
	                        	        ?> 
	                        	        </select>
	                        	       
	                        	        
	                        	        
	                        	    </div>
	                        	     <div class="col-sm-4 col-md-4">
	                        	        <label>Co-Ordinator</label>
	                        	        <input readonly class="form-control" value="<?= $data[0]->coordinator ?>">
	                        	    </div>
	                        	    <div class="col-sm-4 col-md-4">
	                        	        <label>Profile Pic</label>
	                        	        <a href="http://care.haspatal.com/public/media/profile_pic/<?= $data[0]->profile_pic ?>" _target="blank" class="badge badge-info">View</a>
	                        	    </div>
	                        	    </div>
	                        	     <br>
	                        	     <div class="row">
	                        	         
	                        	     
	                        	      <div class="col-md-8 col-sm-8">
	                        	             <label>Bio</label>
	                        	             <textarea readonly class="form-control" rows="5" cols="10"><?= $data[0]->bio ?></textarea>
	                        	         </div>
	                        	          <div class="col-sm-4 col-md-4">
	                        	        <label>Designation</label>
	                        	        <input readonly class="form-control" value="<?= $data[0]->designation ?>">
	                        	    </div>
	                        	         </div>
	                        	         <br>
	                        	     <div class="row">
	                        	        
	                        	        
	                        	    

						                    <br>
						                        <a  href="<?= $data[0]->status==4?base_url('users/taskboard'):base_url('doctor_registers/doctor_status/').'/'.$data[0]->id.'/'. 4 ?>" class="btn btn-primary" style="color:white;background-color:red;border-color:red;">Reject</a>
						                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= $data[0]->status==3?base_url('users/taskboard'):base_url('doctor_registers/doctor_status/').'/'.$data[0]->id.'/'. 3?>" class="btn btn-primary" style="color:white;background-color:yellow;border-color:yellow;">Hold</a>
						                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= $data[0]->status==2?base_url('users/taskboard'):base_url('doctor_registers/doctor_status/').'/'.$data[0]->id.'/'. 2?>" class="btn btn-primary" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;">Approve</a>
						                
						               						                
	                        	     </div>
	                        	     
	                        	   
	                        	</form>
	                        	    
	                        	</div>
	                           
	                        
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>