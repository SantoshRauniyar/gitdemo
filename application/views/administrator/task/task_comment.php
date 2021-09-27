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

							<form role="form" name="addcommentform" id="addcommentform" method="post" action="<?php echo base_url('index.php/administrator/task/do_add_comment');?>" enctype="multipart/form-data">

								<input type="hidden" id="task_id" name="task_id" value = <?php echo $task_details[0]['id']; ?> />
								<div class="form-group">

									<?php echo $task_details[0]['description'];?>

								</div>
								<div class="form-group">
									<?php
										foreach($comment_list as $comment)
										{
											echo $comment['user_name']." = ".$comment['comment']."<br>";
										}
									?>
								</div>
								
								<div class="form-group">

									<label>Comment:<strong><font color='red'>*</font></strong></label>

									<textarea id="comment" name="comment" class="form-control" ></textarea>

								</div>
								<div class="clearfix"></div>

								

								<input type="submit" class="btn btn-primary" value="Save">	

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