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
				<div class="panel-heading" style="background-color: #ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Task Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
					<?php 
							$this->load->view('common/errors');
					?>
					<h3>Task Edit List</h3>
						<form id="Tasklistform" name="Tasklistform" method="post" >
 
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									
									<th>Task<?php if($sort == "task"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=task&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=task&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=task&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Priority</th>
									<!--<th>Description<?php if($sort == "description"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=description&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=description&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=description&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>-->
									<!--  <th>Miletone<?php if($sort == "milestone_id"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=milestone_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=milestone_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=milestone_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Assign To<?php if($sort == "member_id"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=member_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=member_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=member_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Start Date<?php if($sort == "start_date"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=start_date&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=start_date&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=start_date&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>End Date<?php if($sort == "end_date"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=end_date&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=end_date&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=end_date&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
                                    <th>Budget<?php if($sort == "budget"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=budget&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=budget&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=budget&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>-->
									<th>Status<?php if($sort == "status"){if($type == "desc"){echo "<a href='". base_url('index.php/task/all?sort=status&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/task/all?sort=status&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/task/all?sort=status&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th align="center" colspan="3">Options</th>
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
										<?php echo $data->task;?>
									</td>
									<td>
										<?php
											
											 $prioritylist = array("0"=>"Select Priority","1"=>"Normal","2"=>"Low","3"=>"Major","4"=>"critical");
											 
											 if(isset($data->task_priority))
											 {
											 	echo form_dropdown("task_priority",$prioritylist,$data->task_priority,"id='task_priority' onchange='changePriority(".$data->id.");'");
											 }
											 else 
											 {
											 	echo form_dropdown("task_priority",$prioritylist,'',"id='task_priority' onchange='changePriority(".$data->id.");'");
											 }
										?>
									</td>
									<!--<td><?php echo $data->description;?></td>-->
									<!--  <td class="center"><?php  echo $data->milestone_title;?></td>
									 <td class="center"><?php  echo $data->member_name;?></td>
									<td class="center"><?php  echo $data->start_date;?></td>
									<td class="center"><?php  echo $data->end_date;?></td>
                                    <td class="center"><?php  echo $data->budget;?></td>-->
									<td class="center">
										<?php
											 $statuslist = array(""=>"Select","1"=>"Assign","2"=>"Accept","3"=>"Waiting","4"=>"Working","5"=>"Complete","6"=>"Approved");
											 
											 if(isset($data->status))
											 {
											 	echo form_dropdown("status",$statuslist,$data->status,"id='status' onchange='changeStatus(".$data->id.");'");
											 }
											 else 
											 {
											 	echo form_dropdown("status",$statuslist,'',"id='task_priority' onchange='changeStatus(".$data->id.");'");
											 }
										?>
									</td>
									<td align="center">
										<a id="discussion" class="btn btn-primary" data-toggle="modal" data-target="#task_discussion_model" onclick="get_discussion('<?php echo base_url('task/get_task_discussion/'.$data->id);?>','<?php echo $this->session->userdata('id');?>');">Discussion</a>
										
									</td>
									<td align="center">
										<a id ="reassign" class="btn btn-primary" data-toggle="model" data-target="#task_reassigning_model">Rassign</a>
									</td>
									<td align="center">
										<a class="btn btn-primary" style="background-color: yellow;color:black;">Sub Task</a>
									</td>
									<?php
										if($data->member_id != $this->session->userdata('id'))
										{
									?>
									<td align="center">
										<a href="<?php echo base_url('task/edit_task/'.$data->id);?>">
											<img src="<?php echo base_url('assets/administrator/icons/edit.png');?>" height="18" width="18" title="Edit">
										</a>&nbsp;
										
										<a href="javascript:void(0);" onclick="delete_tasks('task/single_task_delete/<?php echo $data->id;?>','Tasklistform','Are you sure you want to delete this task ?','Task deleted successfully.');">
											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete">
										</a>
									</td>
									<?php
										}
									?>
									
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
						<?php if(isset($userdata['links'])){echo $userdata['links'];}?>
						<div id="#task_reassigning_model" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm">
    							<div class="modal-content">
									<div class="modal-header">
        								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        								<h4 class="modal-title">Task Discussion</h4>
      								</div>
      								<div class="modal-body">	
      								</div>
									<div class="modal-footer">
										<div class="input-group">
											<input id="task_id" name="task_id" type="hidden" value="">
											<input id="comment" name="comment" type="text" class="form-control input-sm" placeholder="Type your comment here..." />
											<span class="input-group-btn">
												<button id="send" name="send" type="submit" class="btn btn-warning btn-sm" id="btn-chat">
												Send
												</button>
											</span>
										</div>
      								</div>
	    						</div>
  							</div>
						</div>
						<div id="task_discussion_model" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm">
    							<div class="modal-content">
									<div class="modal-header">
        								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        								<h4 class="modal-title">Task Discussion</h4>
      								</div>
      								<div class="modal-body">	
      								</div>
									<div class="modal-footer">
										<div class="input-group">
											<input id="task_id" name="task_id" type="hidden" value="">
											<input id="comment" name="comment" type="text" class="form-control input-sm" placeholder="Type your comment here..." />
											<span class="input-group-btn">
												<button id="send" name="send" type="submit" class="btn btn-warning btn-sm" id="btn-chat">
												Send
												</button>
											</span>
										</div>
      								</div>
	    						</div>
  							</div>
						</div>
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