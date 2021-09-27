<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Groups</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Program Management</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" >
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
								<h3><b>Create a Department</b></h3>
							<form role="form" name="editgroupform" id="editgroupform" method="post" action="do_save" enctype="multipart/form-data">
                            		

								 <div id="userlist" class="form-group" style="margin-left:0;">
									<label>Select Program<strong><font color='red'>*</font></strong></label>
									<select class="form-control" name="pid">
									<?php
									foreach ($programlist as $value) {
										?>
													<option value="<?= $value->pid ?>"><?= $value->pro_name ?></option>
										<?php
										}	
									?>
									</select>	
									<span class="text-danger"><?=  form_error('pid')?></span>							
								</div>
                                            
								<div class="form-group">
									<label>Department Title</label>
									<input type="text" name="dtitle" class="form-control">
									
									<span class="text-danger"><?=  form_error('dtitle')?></span>
								</div>
								<!--<div class="form-group">
                                                <label>Section</label>
                                                <input type="radio" value="1" name="sec"> Yes <input type="radio" value="0" name="sec"> No
                                                
                                                <span class="text-danger"><?= form_error('sec') ?></span>
                                            </div>-->

																		 <div id="userlist" class="form-group" style="margin-left:0;">
									<label>Select Manager<strong><font color='red'>*</font></strong></label>
									<?php
											if(isset($userlist) && !empty($userlist))
											{
												echo form_dropdown('mid',$userlist,'',"id = 'state_id' class='form-control '");
											}
											
										?>
									<span class="text-danger"><?=  form_error('mid')?></span>								
								</div>

										<div class="form-group">
											<input type="submit" name="submit" class="btn btn-info" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">
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