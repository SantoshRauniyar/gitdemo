
<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<br>
			<br>
			<br>
			
			<br>
			<br>
			<br>
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
					<strong>Roles Masters</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
							echo validation_errors('<div class="error">', '</div>'); 
						//	var_dump($data);
						?>
						
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('RoleMasters/do_save') ?>" enctype="multipart/form-data">
					
                                    <div class="form-group">
                                        <label>Roles Master Name</label>
                                        <input type="text" class="form-control" name="master_name">
                                    </div>
                                  
                                  
                                
                                                    
                   				
								
								<input type="submit" class="btn btn-primary"  value="Submit" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">	
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