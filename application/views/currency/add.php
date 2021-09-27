
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
				<div class="panel-heading" style="background-color:#323200;border-color:#323200;color:white;">
					<strong>Currency </strong>	
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
						
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('Currency/do_save') ?>" enctype="multipart/form-data">
					
                                    <div class="form-group">
                                        <label>Currency Name</label>
                                        <input type="text" name="cname" class="form-control">
                                    </div>
                                  
                                  
                                                                        <div class="form-group">
                                        <label>Currency Sign</label>
                                        <input type="text" name="csign" class="form-control">
                                    </div>                
                   				
								
								<input type="submit" class="btn btn-primary"  value="Submit" style="color:white;background-color: #323200;border-color: #323200">	
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