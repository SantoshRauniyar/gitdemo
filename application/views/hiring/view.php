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
								<h3><b> Edit Hire  Employee</b></h3>

                                                            <div class="form-group">
                                                                <label>Job Title  <span style="color:red;">*</span></label>
                                                                <input readonly="" required="" value="<?= $data->job_title ?>" type="text" class="form-control" name="job_title">
                                                                <?php echo form_error('job_title', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                            
                                            <input readonly="" type="hidden" name="id" value="<?= $data->id ?>">
                                            <label>Job Timing <span style="color:red;">*</span></label>
                                                            <div class="form-group" >

                                                             <select disabled="" required="" name="job_time" class="form-control">
                                                                 <option value="">Select Job Time</option>
                                                                 <option value="1" <?= $data->job_time==1?"selected":"" ?>>Full Time</option>
                                                                 <option value="2" <?= $data->job_time=2?"selected":"" ?>>Part Time</option>
                                                             </select>
                    <?php echo form_error('job_time', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            
                                                            <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Contract Type <span style="color:red;">*</span></label>
                                                                <select disabled="" required="" name="contract_type" class="form-control">
                                                                 <option  value=""   hidden>Select Contract</option>
                                                                 <option  value="1" <?= $data->contract_type==1?"selected":"" ?> >Temporary</option>
                                                                 <option  value="2" <?= $data->contract_type==2?"selected":"" ?> >Contract</option>
                                                                 <option  value="3" <?= $data->contract_type==3?"selected":"" ?> >Internship</option>
                                                                 <option  value="4" <?= $data->contract_type==4?"selected":"" ?> >Fresher</option>
                                                                 <option  value="5" <?= $data->contract_type==5?"selected":"" ?> >Volunteer</option>
                                                                 <option  value="6" <?= $data->contract_type==6?"selected":"" ?> >Commission</option>
                                                                 <option  value="7" <?= $data->contract_type==7?"selected":"" ?> >Walkin</option><option>Fresher</option>
                                                        
                                                             </select>
                                                             <?php echo form_error('contract_type', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Qualification Type <span style="color:red;">*</span></label>
                                                                <select disabled="" required="" name="quali_type" class="form-control">
                                                                 <option value="" hidden>Select Qualification Type</option>
                                                                 <option value="1"<?= $data->quali_type==1?"selected":"" ?>>Post Graduate</option>
                                                                 <option value="2"<?= $data->quali_type==2?"selected":"" ?>>Graduate</option>
                                                                 <option value="3"<?= $data->quali_type==3?"selected":"" ?>>Diploma</option>
                                                                 <option value="4"<?= $data->quali_type==4?"selected":"" ?>>Plus Two</option>
    
                                                        
                                                             </select>
                                                             <?php echo form_error('quali_type', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Interview Date <span style="color:red;">*</span></label>
                                                                <input readonly="" required=""  value="<?= $data->int_date ?>" type="datetime-local" class="form-control" name="int_date">
                                                                <?php echo form_error('int_date', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                  <div class="col-md-4">
                                                                <label>Interview Person <span style="color:red;">*</span></label>
                                                                <input readonly="" value="<?= $data->int_person ?>"  required="" type="text" class="form-control" name="int_person">
                                                                <?php echo form_error('int_person', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            
                                                            
                                                             <div class="col-md-4">
                                                                <label>Interview Location <span style="color:red;">*</span></label>
                                                                <input readonly="" required="" value="<?= $data->int_location ?>" type="text" class="form-control" name="int_location">
                                                                <?php echo form_error('int_location', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                 <div class="col-md-6">
                                                                <label>Deadline <span style="color:red;">*</span> <span style="color:red;">*</span></label>
                                                                <input readonly="" required=""  value="<?= $data->deadline ?>" type="datetime-local" class="form-control" name="deadline">
                                                                <?php echo form_error('deadline', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                      <div class="col-md-6">
                                                                <label>Email <span style="color:red;">*</span></label>
                                                                <input readonly="" required="" value="<?= $data->email ?>"  type="email" class="form-control" name="email">
                                                                <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            </div>
                                                            <br>
                                                        
                                                            <div class="row">
                                                               <label>Salary & Benefits</label> 
                                                                
                                                                <div class="col-md-6" >
                                                                    <label> Range</label>
                                                                    <input readonly="" required="" value="<?= $data->s_min ?>" type="number" class="form-control" name="s_min" placeholder="Min value"> 
                                                                    <?php echo form_error('s_min', '<div class="text-danger">', '</div>'); ?>

                                                                </div>
                                                                <div class="col-md-6" >
                                                                    <input readonly="" required="" value="<?= $data->s_max ?>"  type="number" name="s_max"  class="form-control" placeholder="Max value"> 
                                                                    <?php echo form_error('s_max', '<div class="text-danger">', '</div>'); ?>

                                                                </div>
                                                            </div>
                                                            <br>
                                                             <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Supplement Pay <span style="color:red;">*</span></label>
                                                                <select disabled="" required="" name="supplement_pay" class="form-control">
                                                                 <option  value="">Select Supplement</option>
                                                                 <option  <?= $data->supplement_pay==1?"selected":"" ?> value="1">Commission Pay</option>
                                                                 <option  <?= $data->supplement_pay==2?"selected":"" ?> value="2">Overtime Pay</option>
                                                                 <option  <?= $data->supplement_pay==3?"selected":"" ?> value="3">Shift Allowence</option>
                                                                 <option  <?= $data->supplement_pay==4?"selected":"" ?> value="4">Joining Bonus</option>
                                                                 <option  <?= $data->supplement_pay==5?"selected":"" ?> value="5">Performance Bonus</option>
                                                                 <option  <?= $data->supplement_pay==6?"selected":"" ?> value="6">Quarterly Bonus</option>
                                                                 <option  <?= $data->supplement_pay==7?"selected":"" ?> value="7">Yearly  Bonus</option>
                                                    
                                                        
                                                             </select>
                                                             <?php echo form_error('supplement_pay', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Other Benefits Type <span style="color:red;">*</span></label>
                                                                <select disabled="" required="" name="OtherBenefitsType" class="form-control">
                                                                 <option value="">Select Benefits Type</option>
                                                                 <option value="1" <?= $data->OtherBenefitsType==1?"selected":"" ?>>Mobile Recharge Reimbursement</option>
                                                                 <option value="2" <?= $data->OtherBenefitsType==2?"selected":"" ?>>Travel Allowence</option>
                                                                 <option value="3" <?= $data->OtherBenefitsType==3?"selected":"" ?>>Health Insurance</option>
                                                                     
                                                             </select>
                                                             <?php echo form_error('OtherBenefitsType', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                            </div>
                                                          
                                                            
                                                            
                                                             <div class="form-group">
                                                                <label>Job Description  <span style="color:red;">*</span></label>
                                                                <textarea readonly="" required=""  class="form-control" name="job_desc" cols="10" rows="5"><?= $data->job_desc ?></textarea>
                                                                <?php echo form_error('job_desc', '<div class="text-danger">', '</div>'); ?>

                                                            </div>
                                                           
								 <br><br><br>
										<div class="form-group">
											<a href="<?= base_url('Hiring/hire_list/view') ?>" class="btn btn-info" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">Back</a>
										</div>


						
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