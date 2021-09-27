<div style="padding: 2%">
	<div class="row">
		<div class="col-lg-12" style="">
			<h1 class="page-header">Department Taskboard</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Department Taskboard</strong>	
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
	<label>Response Type Name:<strong><font color='red'>*</font></strong></label>
	<input type="text" class="form-control" name="type_name" value="<?= isset($response_typedata->type_name)?$response_typedata->type_name:""?>" <?= isset($static_view)?"disabled='0'":""?>>
	<span class="text-danger"><?= form_error('type_name') ?></span>
								</div>
										

           						     	
           						<div class="form-group">
           						<?php 
           						if(empty($static_view))
           							{
           								?>
<input type="submit" name="submit"  value="<?= !empty($response_typedata)?"Update Response Type":"Create Response Type"?>" class="btn btn-info " style="color:white;background-color: #ef0f0f;border-color: #ef0f0f" >
<?php 
}
 ?>
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