<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"></h1>
      <br>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;color:white;">
					<strong>Haspatal Department</strong>	
					<strong class="pull-right"><?php

																switch ($haspatal->ustatus) {
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
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
					 						<form class="container">
						    <div class="row">
						        <div class="col-md-4">
						            <h3>How to find you ?</h3>
						        </div>
						        <div class="col-md-4">
						            <h3>About Your Hospital </h3>
						        </div>
						        <div class="col-md-4">
						            <h3>Tell Us About Yourself</h3>
						        </div>
						        
						    </div>
						            <div class="row">
						                <div class="col-md-4">
						                    <label>Country</label>
						                    <input type="text" class="form-control" readonly="" value="<?= $haspatal->country ?>">
						                </div>
						                <div class="col-md-4">
						                    <label>Hospital Name</label>
						                     <input type="text" class="form-control" readonly="" value="<?= $haspatal->hospital_name ?>">
						                </div>
						                <div class="col-md-4">
						                    <label>Contact Person</label>
						                     <input type="text" class="form-control" readonly="" value="<?= $haspatal->contact_person ?>">
						                </div>
						               						            </div>
						               						            
						               						            
						               						            						            <div class="row">
						                <div class="col-md-4">
						                    <label>State</label>
						                    <input type="text" class="form-control" readonly="" value="<?= $haspatal->state ?>">
						                </div>
						                <div class="col-md-4">
						                    <label>Service Type</label>
						                     <input type="text" class="form-control" readonly="" value="<?= $haspatal->services==1?'Single Specialty':'Multi Specialities' ?>">
						                </div>
						                <div class="col-md-4">
						                    <label>Contact Phone</label>
						                     <input type="text" class="form-control" readonly="" value="<?= $haspatal->contact_person_phonoe_no ?>">
						                     

						                </div>
						               						            </div>
						               						            
						               						            
						               						            					            <div class="row">
						                <div class="col-md-4">
						                    <label>District</label>
						                    <input type="text" class="form-control" readonly="" value="<?= $haspatal->district_name ?>">
						                </div>
						                <div class="col-md-4">
						                    <label>Year of Establishment</label>
						                     <input type="text" class="form-control" readonly="" value="<?= $haspatal->year_of_establishment ?>">
						                </div>
						                <div class="col-md-4">
						                    <label>Contact Email</label>
						                     <input type="text" class="form-control" readonly="" value="<?= $haspatal->email ?>">
						                </div>
						               						            </div>
						               						            				            <div class="row">
						                <div class="col-md-4">
						                    <label>City</label>
						                    <input type="text" class="form-control" readonly="" value="<?= $haspatal->city ?>">
						                </div>
						                <div class="col-md-4">
						                    <br>
						                    <label>License Copy</label>
						                     <a href="http://13.59.46.134/media/license_copy/<?= $haspatal->license_copy ?>" target="_blank" class="badge badge-primary">View</a>
						                </div>
						                <div class="col-md-4">

						                </div>
						                
						                					            <div class="row">
						                <div class="col-md-4">
						                    <label>Pincode</label>
						                    <input type="text" class="form-control" readonly="" value="<?= $haspatal->pincode_id ?>">
						                </div>
						                <div class="col-md-4">
						                       
						                
						                </div>
						                <div class="col-md-4">
						                    
						                </div>
						               						            </div>
						               						            						                					            <div class="row">
						                <div class="col-md-4">
						                    <label>Address</label>
						                    <textarea type="text" class="form-control" readonly=""><?= $haspatal->address ?></textarea>
						                </div>
						                <div class="col-md-4">
						                        <label>GST Registration Copy</label>
						                     <a href="http://13.59.46.134/media/gst_copy/<?= $haspatal->gst_no ?>" target="_blank" class="badge badge-primary">View</a>
						                
						                </div>
						                <div class="col-md-4">
						                    						               						                   <label>Message</label> 
						               						                   <textarea class="form-control" readonly=""><?=$haspatal->message ?></textarea></div>
						               						            </div>
						               						            
						               						            	 <div class="row">
						               				           
						               						                  
						               						                  <div class="col-md-8">
						               						                    
						               						                <label>Mobile</label>
						                                                             <input type="text" class="form-control" readonly="" value="<?= $haspatal->mobile ?>">
						               						                </div>
						               						                
						               						     
						               						               
						               						                <div class="col-md-4">

						                    <br>
						                        <a  href="<?= base_url('haspatal_registers/haspatal_status/').'/'.$haspatal->id.'/'. 4 ?>" class="btn btn-primary" style="color:white;background-color:red;border-color:red;">Reject</a>
						                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= base_url('haspatal_registers/haspatal_status/').'/'.$haspatal->id.'/'. 3?>" class="btn btn-primary" style="color:white;background-color:yellow;border-color:yellow;">Hold</a>
						                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= base_url('haspatal_registers/haspatal_status/').'/'.$haspatal->id.'/'. 2?>" class="btn btn-primary" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f;">Approve</a>
						                
						               						                </div>
						               						                  
						               						            </div>
						               						            </div>
				               						                		
						               						            
						    
						</form>

						</div>     

					</div>

                    <!-- /.row (nested) -->

				</div>

                <!-- /.panel-body -->

			</div>

			<!-- /.panel -->

		</div>

		<!-- /.col-lg-12 -->

	</div>

	<!-- /.row -->

	</div>

	<!-- /#page-wrapper -->

</div>

</div>