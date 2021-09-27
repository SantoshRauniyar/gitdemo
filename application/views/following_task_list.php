<div style="padding:2%;">

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

					<strong>Followings Task</strong>

				</div>

				<!-- /.panel-heading -->

				<div class="panel-body">

					<div class="table-responsive">

						<form id="Tasklistform" name="Tasklistform" method="post" >

                        <!--<a id="multidelete" href="<?php echo base_url('index.php/administrator/task/delete_multiple');?>" class="btn btn-primary">Delete Multiple</a>-->

						<table class="table table-striped table-bordered table-hover" id="dataTables-example">

							<thead>

								<tr>

									<th class="col-md-2">Sr. No.</th>

									<th class="col-md-10">Task<?php if($sort == "task"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/task/following_task_list?sort=task&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/task/following_task_list?sort=task&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/task/following_task_list?sort=task&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>

								</tr>

							</thead>

							<tbody>

							<?php

								if(isset($userdata))

								{
									
									$i=1;

									foreach($userdata['results'] as $data)

									{

							?>

								<tr class="odd gradeA">

									<td class="col-md-2"><?php echo $i;?></td>

									<td class="col-md-10">
										<a href="<?php echo base_url('index.php/task/add_comments/'.$data->id);?>">
										<?php echo $data->task;?>
										</a>
									</td>

									<!--<td align="center">

										<a href="<?php echo base_url('index.php/administrator/task/edit_task/'.$data->id);?>">

											<img src="<?php echo base_url('assets/icons/edit.png');?>" height="18" width="18" title="Edit">

										</a>&nbsp;

										

										<a href="javascript:void(0);" onclick="delete_tasks('index.php/administrator/task/single_task_delete/<?php echo $data->id;?>','Tasklistform','Are you sure you want to delete this task ?','Task deleted successfully.');">

											<img src="<?php echo base_url('assets/icons/error_msg.png');?>" height="22" width="22" title="Delete">

										</a>

									</td>-->

								</tr>

							<?php
										$i++;
									}

								}

								else

								{

									echo "<tr><td colspan=9 align=center>No Recoreds Available.</td></tr>";

								}

							?>

                            </tbody>

						</table>

						</form>

					</div>

				</div>

				<!-- /.panel-body -->

			</div>

			<!-- /.panel -->

		</div>

		<!-- /.col-lg-12 -->

	</div>

</div>

<!-- /#page-wrapper -->



</div>

<!-- /#wrapper -->