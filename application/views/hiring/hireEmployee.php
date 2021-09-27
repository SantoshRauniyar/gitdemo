<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Hiring Process</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Hiring Management</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" >
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
								<h3><b>Hire an Employee</b></h3>
							<form role="form" name="editgroupform" id="editgroupform" method="post" action="<?= base_url('/Hiring/do_save')?>" enctype="multipart/form-data">
                            	                    	
                                                            <div class="form-group">
                                                                <label>Job Title  <span style="color:red;">*</span></label>
                                                                <input required=""  type="text" class="form-control" name="job_title">
                                                                <?php echo form_error('job_title', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                            
                                            
                                            <label>Job Timing <span style="color:red;">*</span></label>
                                                            <div class="form-group" >

                                                             <select required="" name="job_time" class="form-control">
                                                                 <option value="">Select Job Time</option>
                                                                 <option value="1">Full Time</option>
                                                                 <option value="2">Part Time</option>
                                                             </select>
                    <?php echo form_error('job_time', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            
                                                            <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Contract Type <span style="color:red;">*</span></label>
                                                                <select required="" name="contract_type" class="form-control">
                                                                 <option value="" hidden>Select Contract</option>
                                                                 <option value="1">Temporary</option>
                                                                 <option value="2">Contract</option>
                                                                 <option value="3">Internship</option>
                                                                 <option    value="4">Fresher</option>
                                                                 <option    value="5">Volunteer</option>
                                                                 <option    value="6">Commission</option>
                                                                 <option    value="7">Walkin</option><option>Fresher</option>
                                                        
                                                             </select>
                                                             <?php echo form_error('contract_type', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Qualification Type <span style="color:red;">*</span></label>
                                                                <select required="" name="quali_type" class="form-control">
                                                                 <option value="" hidden>Select Qualification Type</option>
                                                                 <option value="1">Post Graduate</option>
                                                                 <option value="2">Graduate</option>
                                                                 <option value="3">Diploma</option>
                                                                 <option value="4">Plus Two</option>
    
                                                        
                                                             </select>
                                                             <?php echo form_error('quali_type', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Interview Date <span style="color:red;">*</span></label>
                                                                <input required="" type="datetime-local" class="form-control" name="int_date">
                                                                <?php echo form_error('int_date', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                  <div class="col-md-4">
                                                                <label>Interview Person <span style="color:red;">*</span></label>
                                                                <input required="" type="text" class="form-control" name="int_person">
                                                                <?php echo form_error('int_person', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            
                                                            
                                                             <div class="col-md-4">
                                                                <label>Interview Location <span style="color:red;">*</span></label>
                                                                <input required="" type="text" class="form-control" name="int_location">
                                                                <?php echo form_error('int_location', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                 <div class="col-md-6">
                                                                <label>Deadline <span style="color:red;">*</span> <span style="color:red;">*</span></label>
                                                                <input required="" type="datetime-local" class="form-control" name="deadline">
                                                                <?php echo form_error('deadline', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                      <div class="col-md-6">
                                                                <label>Email <span style="color:red;">*</span></label>
                                                                <input required="" type="email" class="form-control" name="email">
                                                                <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            </div>
                                                            <br>
                                                            <hr>
                                                             <label>Salary & Benefits</label> 
                                                            <div class="row">
                                                              
                                                                
                                                                <div class="col-md-6" >
                                                                    <label> Range</label>
                                                                    <input required="" type="number" class="form-control" name="s_min" placeholder="Min value"> 
                                                                    <?php echo form_error('s_min', '<div class="text-danger">', '</div>'); ?>

                                                                </div>
                                                                
                                                                <div class="col-md-6" >
                                                                    <br>
                                                                    <input required="" type="number" name="s_max"  class="form-control" placeholder="Max value"> 
                                                                    <?php echo form_error('s_max', '<div class="text-danger">', '</div>'); ?>

                                                                </div>
                                                            </div>
                                                            <br>
                                                             <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Supplement Pay <span style="color:red;">*</span></label>
                                                                <select required="" name="supplement_pay" class="form-control">
                                                                 <option value="">Select Supplement</option>
                                                                 <option value="1">Commission Pay</option>
                                                                 <option value="2">Overtime Pay</option>
                                                                 <option value="3">Shift Allowence</option>
                                                                 <option    value="4">Joining Bonus</option>
                                                                 <option    value="5">Performance Bonus</option>
                                                                 <option    value="6">Quarterly Bonus</option>
                                                                 <option    value="7">Yearly  Bonus</option>
                                                    
                                                        
                                                             </select>
                                                             <?php echo form_error('supplement_pay', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Other Benefits Type <span style="color:red;">*</span></label>
                                                                <select required="" name="OtherBenefitsType" class="form-control">
                                                                 <option value="">Select Benefits Type</option>
                                                                 <option value="1">Mobile Recharge Reimbursement</option>
                                                                 <option value="2">Travel Allowence</option>
                                                                 <option value="3">Health Insurance</option>
                                                                     
                                                             </select>
                                                             <?php echo form_error('OtherBenefitsType', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            </div>
                                                          
                                                            
                                                            
                                                             <div class="form-group">
                                                                <label>Job Description  <span style="color:red;">*</span></label>
                                                                <textarea required="" class="form-control" name="job_desc" cols="10" rows="5"></textarea>
                                                                <?php echo form_error('job_desc', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                           
								 <br><br><br>
										<div class="form-group">
											<input required="" type="submit" name="submit" class="btn btn-info" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">
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