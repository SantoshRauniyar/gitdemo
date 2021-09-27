<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"></h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Program  Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
						?>
						<h3><b>	Department List</b></h3>
						<form id="Grouplistform" name="Grouplistform" method="post" >
                       

						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
	
									<th>Department<?php if($sort == "groups_title"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/groups/all?sort=groups_title&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=groups_title&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=groups_title&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									
									<!--  <th>Team Name<?php if($sort == "team_id"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/groups/all?sort=team_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=team_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=team_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>-->
									<th>Department Head<?php if($sort == "manager_id"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/groups/all?sort=manager_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=manager_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=manager_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Program</th>
									<th align="center">Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php
								if(isset($userdata))
								{
									foreach($userdata as $data)
									{
							?>
								<tr class="odd gradeA">
									
									<td>
										<?php echo $data->dtitle;?>
									</td>
									
									<!-- <td class="center"><?php  echo $data->team_name;?></td>-->
									<td class="center"><?php  echo $data->user_name;?></td>
									<td><?=  $data->pro_name?></td>
									<td align="center">
										<a class="btn btn-info" style="background-color: #ef0f0f;color:white;border-color: #ef0f0f" href="<?php echo base_url('groups/edit_group/'.$data->did);?>">
											View Details
										</a>&nbsp;
										
										<!--<a href="javascript:void(0);" onclick="single_team_delete('groups/single_group_delete/<?php echo $data->id;?>','Grouplistform','Are you sure you want to delete this group ?','Group deleted successfully.');">
											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete">
										</a>-->
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
						<?php
							if(isset($userdata['links']))
								echo $userdata['links'];
						?>
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