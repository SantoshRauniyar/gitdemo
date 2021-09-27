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
					<strong>Task Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
					<?php 
							$this->load->view('common/errors');
					?>
						<form id="Tasklistform" name="Tasklistform" method="post" >
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Sr.</th>
									<th>Task<?php if($sort == "task"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=task&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=task&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=task&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Description<?php if($sort == "description"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=description&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=description&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=description&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<!--<th>Miletone<?php if($sort == "milestone_id"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=milestone_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=milestone_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=milestone_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Assign To<?php if($sort == "member_id"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=member_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=member_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=member_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Start Date<?php if($sort == "start_date"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=start_date&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=start_date&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=start_date&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>End Date<?php if($sort == "end_date"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=end_date&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=end_date&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=end_date&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
                                    <th>Budget<?php if($sort == "budget"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=budget&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=budget&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=budget&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>-->
									<th>Status<?php if($sort == "status"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=status&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=status&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=status&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>

									<th align="center">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								if(isset($userdata))
								{
									$i= 1;
									foreach($userdata['results'] as $data)
									{
							?>
								<tr class="odd gradeA">
									<td><?php echo $i;?></td>
									<td>
										<?php echo $data->task;?>
									</td>
									<td><?php echo $data->description;?></td>
									<!--<td class="center"><?php  echo $data->milestone_title;?></td>
									 <td class="center"><?php  echo $data->member_name;?></td>
									<!--<td class="center"><?php  echo $data->start_date;?></td>
									<td class="center"><?php  echo $data->end_date;?></td>
                                    <td class="center"><?php  echo $data->budget;?></td>-->
									<td class="center">
										<?php
											if($data->status == 1)
												echo "Assign";
											else if($data->status == 2)
												echo "Accept";
											else if($data->status == 3)
												echo "Waiting";
											else if($data->status == 4)
												echo "Working";
											else if($data->status == 5)
												echo "Complete";
											else if($data->status == 6)
												echo "Approved"; 
										?>		 
									</td>	
									<td align="center">
										<a id="view" class="btn btn-primary" title="View Details">View</a>
									</td>
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