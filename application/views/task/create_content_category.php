
<div style="padding: 2%">
	<div class="row">
		<div class="col-lg-12" style="">
			<h1 class="page-header">Create Content Category</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Content Management</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body" >
					<div class="row">
						<div class="col-lg-12">
								

						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="category_save" enctype="multipart/form-data">
							<div class="form-group">
									<label>Category Name:<strong><font color='red'>*</font></strong></label>
									<input type="text" class="form-control" name="cname">
									<span class="text-danger"><?= form_error('cname') ?></span>
								</div>
								

           						     	
           						<div class="form-group">
           						
<input type="submit" name="submit" value="Create Category" class="btn btn-info " style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">
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