<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Users</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body" >
				<div class="panel-body" >
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong><?php echo $heading;?></strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						    
						    
						<?php 
						
						//if(!empty($data['partner']->id)){ echo'selected'; }
							$this->load->view('common/errors');
							echo validation_errors('<div class="error">', '</div>'); 
						//	var_dump($data);
						?>
						
						                    
                                                    
                   
                                <label>Select District</label>
                                            <select disabled="" class="form-control" name="district">
                                <?php
                                
                                foreach($data['districtlist'] as $row)
                                {
                                    ?>
                                    
                                    <option value="<?= $row->id?>" <?php if(!empty($data['partner']->id)){ echo $d=$row->id==$data['partner']->district_id?'selected':''; } ?>><?= $row->district_name ?></option>
                                    
                                    <?php
                                }
                        
                        ?>
                        </select>
                        
								<div class="form-group">
									<label>Business Name:<strong><font color='red'>*</font></strong></label>
									<input readonly="" id="business_name" value="<?= $data['partner']->business_name ?>" name="business_name" class="form-control"  >
								</div>
								<div class="form-group">
									<label>Address:</label>
									<textarea id="address" disabled="" name="address" class="form-control" ><?=$data['partner']->address ?></textarea>
								</div>
								
								<div class="form-group">
									<label>Select Revenue:</label>
									<select disabled="" class="form-control" name="revenue">
									   <option>5 %</option>
									
									<option value="10" <?= $data['partner']->revenue==10?'selected':''?>>10 %</option>
									<option value="15" <?= $data['partner']->revenue==15?'selected':''?>>15 %</option>
									<option value="20" <?= $data['partner']->revenue==20?'selected':''?>>20 %</option>
									<option value="25" <?= $data['partner']->revenue==25?'selected':''?>>25 %</option>
									<option value="30" <?= $data['partner']->revenue==30?'selected':''?>>30 %</option>
									<option value="35" <?= $data['partner']->revenue==35?'selected':''?>>35 %</option>
									<option value="40" <?= $data['partner']->revenue==40?'selected':''?>>40 %</option>
									<option value="45" <?= $data['partner']->revenue==45?'selected':''?>>45 %</option>
									<option value="50" <?= $data['partner']->revenue==50?'selected':''?>>50 %</option>
									</select>
								</div>
								<input readonly="" type='hidden' name="user_role" value="<?php if(isset($assign_role) and !empty($assign_role)){echo $assign_role; } ?>">
								
								<div class="form-group">
									<label>Contact Person Name:<strong><font color='red'>*</font></strong></label>
									<input readonly="" id="contact_person_name" name="contact_person_name" value="<?= $data['partner']->contact_person?>" class="form-control" >
								</div>
								<!--	<div class="form-group">
                               	<label>Gender:</label>
                                   <label class="radio-inline">
                                    	<input readonly="" type="radio" name="gender" id="gender" value="1" >Male
									</label>
									<label class="radio-inline">
										<input readonly="" type="radio" name="gender" id="gender" value="2" >Female
									</label>
								</div>
								
								<div class="form-group">
									<label>Email Address:<strong><font color='red'>*</font></strong></label>
									<input readonly="" id="email" name="email" class="form-control" >
								</div>
								<div class="form-group">
                					<label for="dtp_input readonly=""2" class="control-label">Birth Date:</label>
                					
									<input readonly="" type="date" id="dtp_input readonly=""2" class="form-control" name="birth_date"/><br/>
           						</div>-->
									<div class="form-group">
									<label>Contact Person Phone:<strong><font color='red'>*</font></strong></label>
									<input readonly="" id="phone" name="phone" value="<?= $data['partner']->phone?>" class="form-control" >
								</div>
								<!--
								<div class="form-group">
									<label>User Name:<strong><font color='red'>*</font></strong></label>
									<input readonly="" id="user_name" name="user_name" class="form-control"  >
								</div>
								<div class="form-group">
									<label>Password:<strong><font color='red'>*</font></strong></label>
									<input readonly="" type="password" id="password" name="password" class="form-control" value="" >
								</div>
								<div class="form-group">
									<label>Confirm Password:<strong><font color='red'>*</font></strong></label>
									<input readonly="" type="password" id="cpassword" name="cpassword" class="form-control" value="" >
								</div>
								-->
								
							
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