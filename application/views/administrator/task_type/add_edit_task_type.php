<div id="page-wrapper">

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">Tasks</h1>

		</div>

		<!-- /.col-lg-12 -->

	</div>

	<!-- /.row -->

	<div class="row">

		<div class="col-lg-12">

			<div class="panel panel-default">

				<div class="panel-heading">

					<strong><?php echo $heading;?></strong>	

					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>

				</div>

				<div class="panel-body">

					<div class="row">

						<div class="col-lg-12">

						<?php 

							$this->load->view('common/errors');

						?>

							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">

                            

								<?php if($mode == "edit"){?>

								<input type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />

								

								<div class="clearfix"></div>

								<?php } ?>

								<div class="form-group">

									<label>Task Type Name:<strong><font color='red'>*</font></strong></label>

									<input id="task_type_name" name="task_type_name" class="form-control" value="<?php if(isset($task_type_name)){echo $task_type_name;}?>" >

								</div>
								

								<input type="submit" class="btn btn-primary" value="<?php if($mode == 'edit'){echo 'Update';}else{echo 'Save';}?>">	

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