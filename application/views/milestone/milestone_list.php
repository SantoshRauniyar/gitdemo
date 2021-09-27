<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Projects</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Projects Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
					<?php 
							$this->load->view('common/errors');
						?>

						<h3><b>Milestone List</b></h3>
						<form id="Milestonelistform" name="Milestonelistform" method="post" >
						
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									
									<th>Milestone title<?php if($sort == "milestone_title"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/milestone/all?sort=milestone_title&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=milestone_title&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=milestone_title&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Project Name<?php if($sort == "project_id"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/milestone/all?sort=project_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=project_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=project_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Description<?php if($sort == "description"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/milestone/all?sort=description&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=description&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=description&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Budget<?php if($sort == "budget"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/milestone/all?sort=budget&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=budget&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=budget&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
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
								<tr class="odd gradeX">
										<td>
										<?php echo $data->milestone_title;?>
									</td>
									<td class="center"><?php  echo $data->project_name;?></td>
									<td><?php echo $data->description;?></td>
									<td><?php echo $data->budget;?></td>
									<td align="center">
										<a style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;" class="btn btn-info" href="<?php echo base_url('milestone/edit_milestone/'.$data->id);?>">
											Edit
										</a>&nbsp;
										
										<!--<a id="delete" href="<?php echo base_url('milestone/delete_milestone/'.$data->id);?>">
											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete">-->
										</a>
									</td>
								</tr>
							<?php
									}
								}
								else
								{
									echo "<tr><td colspan=6 align=center>No Recoreds Available</td></tr>";
								}
							?>
                            </tbody>
						</table>
						<?php if(isset($userdata['links'])){echo $userdata['links'];}?>
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