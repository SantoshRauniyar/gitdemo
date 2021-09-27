
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
					<strong>Assign Role</strong>	
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
					
                                    <div class="form-group">
                                        <label>Currency Name</label>
                                        <input readonly="" type="text" class="form-control" name="cname" value="<?= $cur[0]->cname ?>">
                                    </div>
                                        <div class="form-group">
                                        <label>Currency Sign</label>
                                        <input readonly="" type="text" class="form-control" name="csign" value="<?= $cur[0]->csign ?>">
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