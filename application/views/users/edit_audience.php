
<div style="padding: 2%">
	<div class="row">
		<div class="col-lg-12" style="">
			<h1 class="page-header">Create Target Audience</h1>
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
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?=base_url("users/do_update_audience").'/'.$audidata->aid ?>" enctype="multipart/form-data">
							<div class="form-group">
									<label>Audience Name:<strong><font color='red'>*</font></strong></label>
									<input type="text" class="form-control" name="audi_name" value="<?= $audidata->audi_name ?>" <?= !empty($static_view)?"readonly=''":"" ?>>
									<span class="text-danger"><?= form_error('audi_name') ?></span>
								</div>
								<div class="form-group">
									<label>Audience Code:<strong><font color='red'>*</font></strong></label>
									<input type="number" class="form-control" name="audi_code" value="<?= $audidata->audi_code ?>" <?= !empty($static_view)?"readonly=''":"" ?>>
									<span class="text-danger"><?= form_error('audi_code') ?></span>
								</div>
								

           						     	
           						<div class="form-group">
           						<?php
           									if (empty($static_view)) {
           									
           						?>
								<input type="submit" name="submit" value="Update Audience" class="btn btn-info " style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">
           								<?php } ?>
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