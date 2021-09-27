<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"></h1>
      <br>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;color:white;">
					<strong>Add Program</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('Program/do_save')?>" enctype="multipart/form-data">
								<div class="row">
								<div class="form-group col-md-6">

                					<label for="dtp_input3" class="control-label">Program Name<strong><font color='red'>*</font></strong></label>

                						<input type="text" class="form-control" name="pro_name">
                						<span class="text-danger"><?= form_error('pro_name')?></span>



           						</div>
								<div class="form-group col-md-6">

                					<label for="dtp_input3" class="control-label">Select Program Accounts Officer:<strong><font color='red'>*</font></strong></label>

                						<select name="acc_office" class="form-control">
                						<?php

                                  foreach($acc_office as $data) {
                                    ?>
                                      <option value="<?= $data->id.'+'.$data->email?>"><?= $data->user_name?></option>
                                    <?php
                                  }

                            ?>
                						</select>
                						<span class="text-danger"><?= form_error('acc_office')?></span>



           						</div>
           					</div>
           					<div class="row">
								<div class="form-group col-md-6">

                					<label for="dtp_input3" class="control-label">Upload Program Logo<strong><font color='red'>*</font></strong></label>

                						<input type="file" class="form-control" name="logo">
									<span class="text-danger"><?= form_error('logo')?></span>


           						</div>

								<div class="form-group col-md-6">


        <br>
                						<input type="submit" value="Submit" class="btn btn-info" style="background-color:#ef0f0f;color:white;" name="submit">



           						</div>
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