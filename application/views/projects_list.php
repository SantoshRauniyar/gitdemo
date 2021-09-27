<div style="padding:2%">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"> My Projects</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>My Project List</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
						<form id="projectslistform" name="projectslistform" method="post" >
                        
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">	
							<thead>
								<tr>
									<th>Project Name<?php if($sort == "project_name"){if($type == "desc"){echo "<a href='". base_url('index.php/projects/all?sort=project_name&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/projects/all?sort=project_name&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/projects/all?sort=project_name&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Description<?php if($sort == "description"){if($type == "desc"){echo "<a href='". base_url('index.php/projects/all?sort=description&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/projects/all?sort=description&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/projects/all?sort=description&type=desc')."'><i class='fa fa-unsorted fa-unsorted pull-right'></i></a>";}?></th>
									<th>Assign to<?php if($sort == "leader_id"){if($type == "desc"){echo "<a href='". base_url('index.php/projects/all?sort=leader_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/projects/all?sort=leader_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/projects/all?sort=leader_id&type=desc')."'><i class='fa fa-sorted fa-unsorted pull-right'></i></a>";}?></th>
									<th>Milestone<?php if($sort == "no_of_milestone"){if($type == "desc"){echo "<a href='". base_url('index.php/projects/all?sort=no_of_milestone&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/projects/all?sort=no_of_milestone&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/projects/all?sort=no_of_milestone&type=desc')."'><i class='fa fa-sorted fa-unsorted pull-right'></i></a>";}?></th>
									<th>Start Date<?php if($sort == "start_date"){if($type == "desc"){echo "<a href='". base_url('index.php/projects/all?sort=start_date&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/projects/all?sort=start_date&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/projects/all?sort=start_date&type=desc')."'><i class='fa fa-sorted fa-unsorted pull-right'></i></a>";}?></th>
									<th>End date<?php if($sort == "end_date"){if($type == "desc"){echo "<a href='". base_url('index.php/projects/all?sort=end_date&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/projects/all?sort=end_date&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/projects/all?sort=end_date&type=desc')."'><i class='fa fa-sorted fa-unsorted pull-right'></i></a>";}?></th>
									<th>Status<?php if($sort == "status"){if($type == "desc"){echo "<a href='". base_url('index.php/projects/all?sort=status&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/projects/all?sort=status&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/projects/all?sort=status&type=desc')."'><i class='fa fa-sorted fa-unsorted pull-right'></i></a>";}?></th>
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
										<?php echo $data->project_name;?>
									</td>
									<td><?php echo $data->description;?></td>
									<td class="center"><?php  echo $data->leader_name;?></td>
									<td class="center"><?php echo $data->no_of_milestone;?></td>									
									<td><?php echo $data->start_date;?></td>
									<td><?php echo $data->end_date;?></td>
									
									<td><?php if($data->status == "1"){ echo "<a href='".base_url('index.php/projects/chnage_status/'.$data->id.'/2')."' class='btn btn-primary'>Pandding</a>";}else if($data->status == "2"){echo "<a href='".base_url('index.php/projects/chnage_status/'.$data->id.'/3')."' class='btn btn-primary'>Complete</a>";}else if($data->status == "3"){echo "<a href='#' class='btn btn-primary' disabled='disabled'>Pandding<span class='glyphicon glyphicon-ok'></span></a>";}?></td>
								</tr>
							<?php
									}
								echo $userdata['links'];
								}
								else
								{
									echo "<tr align=center><td colspan=9 >No projects available right now.</td></tr>";
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