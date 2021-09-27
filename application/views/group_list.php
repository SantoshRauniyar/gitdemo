<div style="padding: 2%">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Groups</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Group Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
						<form id="Grouplistform" name="Grouplistform" method="post" >
                        <a id="multidelete" href="<?php echo base_url('index.php/groups/delete_multiple');?>" class="btn btn-primary">Delete Multiple</a>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th><input type="checkbox" id="checkall" name="checkall" onclick="checkUncheck();"></th>
									<th>Group<?php if($sort == "groups_title"){if($type == "desc"){echo "<a href='". base_url('index.php/groups/all?sort=groups_title&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/groups/all?sort=groups_title&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/groups/all?sort=groups_title&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Description<?php if($sort == "description"){if($type == "desc"){echo "<a href='". base_url('index.php/groups/all?sort=description&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/groups/all?sort=description&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/groups/all?sort=description&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Team Name<?php if($sort == "team_id"){if($type == "desc"){echo "<a href='". base_url('index.php/groups/all?sort=team_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/groups/all?sort=team_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/groups/all?sort=team_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Group Manager<?php if($sort == "manager_id"){if($type == "desc"){echo "<a href='". base_url('index.php/groups/all?sort=manager_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/groups/all?sort=manager_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/groups/all?sort=manager_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
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
										<?php echo $data->groups_title;?>
									</td>
									<td><?php echo $data->description;?></td>
									<td class="center"><?php  echo $data->team_name;?></td>
									<td class="center"><?php  echo $data->manager_name;?></td>
									<td align="center">
										<a href="<?php echo base_url('index.php/groups/edit_group/'.$data->id);?>">
											<img src="<?php echo base_url('assets/administrator/icons/edit.png');?>" height="18" width="18" title="Edit">
										</a>&nbsp;
										
										<a href="javascript:void(0);" onclick="single_team_delete('index.php/groups/single_group_delete/<?php echo $data->id;?>','Grouplistform','Are you sure you want to delete this group ?','Group deleted successfully.');">
											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete">
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