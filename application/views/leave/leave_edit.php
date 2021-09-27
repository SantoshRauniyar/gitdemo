<div style="padding: 2%">
	<div class="row">
		<div class="col-lg-12" style="">
			<h1 class="page-header">Leave </h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Leave Management</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" >
					<div class="row">
						<div class="col-lg-12">
								

						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= $action ?>" enctype="multipart/form-data">	
								<h4><b><?= $heading?></b></h4>
							
						                    <div class="form-group">
						                        <label>Employee Name</label>
						                        <input required="" type="text" value="<?= $data->emp_name ?>"  name="emp_name" class="form-control">
						                        <span class="text-danger"><?=  form_error('emp_name') ?></span>
						                    </div>
						                    						<input type="hidden" name="id" value="<?= $data->id ?>">                    
						                    <div class="form-group">
						                        <label>Employee ID</label>
						                        <input required="" type="text" value="<?= $data->emp_id ?>" name="emp_id" class="form-control">
						                         <span class="text-danger"><?=  form_error('emp_id') ?></span>
						                    </div>
           						     	        <div class="form-group">
           						     	            <select required="" name="department" class="form-control">
           						     	                <?php
           						     	                    
           						     	                    foreach($dept as $row)
           						     	                    {
           						     	                    ?>
           						     	                    
           						     	                    <option value="<?= $row->did ?>" <?= $data->department==$row->did?"selected":"" ?> ><?= $row->dtitle ?></option>
           						     	                    <?php }     
           						     	                ?>
           						     	            </select>
           						     	             <span class="text-danger"><?=  form_error('deptartment') ?></span>
           						     	        </div>
           						     	        						                    <div class="form-group">
						                        <label>Reason for Requested Leave</label>
						                      <select required="" name="reason_to_leave" class="form-control">
						                            <option value="">Select Reason for Requested Leave</option>
                                                  <option value="1"     <?= $data->reason_to_leave==1?"selected":"" ?>> Maternity Leave </option>
                                                  <option value="2"     <?= $data->reason_to_leave==2?"selected":"" ?>> Sick Leave       </option>
                                                  <option value="3"     <?= $data->reason_to_leave==3?"selected":"" ?>> Unpaid Leave    </option>
                                                  <option value="4"     <?= $data->reason_to_leave==4?"selected":"" ?>> Parental Leave  </option>
						                          <option value="5"     <?= $data->reason_to_leave==5?"selected":"" ?>> Annual Leave       </option>
						                      </select>
						                       <span class="text-danger"><?=  form_error('reason_to_leave') ?></span>
						                    </div>
						                    <br>
           						     	        <h5>Date Range</h5>
           						     	        <div class="row">
           						     	            
           						     	            <div class="col-md-6">
           						     	            
           						     	            <label>From</label>
           						     	            <input required="" type="datetime-local" value="<?= $data->s_date ?>"  class="form-control" name="s_date">
           						     	             <span class="text-danger"><?=  form_error('s_date') ?></span>
           						     	        </div>
           						     	        <div class="col-md-6">
           						     	            
           						     	            <label>To</label>
           						     	            <input required="" type="datetime-local" value="<?= $data->e_date ?>" class="form-control" name="e_date">
           						     	             <span class="text-danger"><?=  form_error('e_date') ?></span>
           						     	        </div>
           						     	        </div>
           						     	        
           						     	        <div class="form-group">
           						     	            <label>Assign to Person</label>
           						     	            <select required="" class="form-control" name="assigned">
           						     	                <?php
           						     	                foreach($users as $row)
           						     	                {
           						     	                    ?>
           						     	                    <option value="<?= $row->id ?>" <?= $data->assigned==$row->id?"selected":"" ?>><?= $row->first_name.' '.$row->last_name ?></option>
           						     	                    <?php
           						     	                }
           						     	                ?>
           						     	            </select>
           						     	             <span class="text-danger"><?=  form_error('assigned') ?></span>
           						     	        </div>
           						     	        
           						<div class="form-group">
           					
<input  type="submit" name="submit"  value="Apply Leave" class="btn btn-info " style="color:white;background-color: #ef0f0f;border-color: #ef0f0f" >

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