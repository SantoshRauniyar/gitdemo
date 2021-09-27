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
					<strong>Task Type Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
						<form id="Tasklistform" name="Tasklistform" method="post" >
                        <a id="multidelete" href="<?php echo base_url('index.php/administrator/task_type/delete_multiple');?>" class="btn btn-primary">Delete Multiple</a>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th><input type="checkbox" id="checkall" name="checkall" onclick="checkUncheck();"></th>
									<th>Task-Type Name<?php if($sort == "task_type_name"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/task_type/all?sort=task_type_name&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/task_type/all?sort=task_type_name&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/task_type/all?sort=task_type_name&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									
									<th align="center">Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php
								if(isset($userdata))
								{
									foreach($userdata['results'] as $data)
									{
							?>
								<tr class="odd gradeA">
									<td><input type="checkbox" id="chk[]" name="chk[]" value="<?php echo $data->id;?>" onclick="check();"></td>
									<td>
										<?php echo $data->task_type_name;?>
									</td>
									<td align="center">
										<a href="<?php echo base_url('index.php/administrator/task_type/edit_task_type/'.$data->id);?>">
											<img src="<?php echo base_url('assets/icons/edit.png');?>" height="18" width="18" title="Edit">
										</a>&nbsp;
										
										<a href="javascript:void(0);" onclick="delete_tasks('index.php/administrator/task_type/single_task__type_delete/<?php echo $data->id;?>','Tasklistform','Are you sure you want to delete this task type ?','Task type deleted successfully.');">
											<img src="<?php echo base_url('assets/icons/error_msg.png');?>" height="22" width="22" title="Delete">
										</a>
									</td>
								</tr>
							<?php
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