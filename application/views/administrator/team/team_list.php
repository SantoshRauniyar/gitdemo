<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Teams</h1>
		</div>
		<!-- /.col-lg-12 -->	
	</div>	<!-- /.row -->	
	<div class="row">		
		<div class="col-lg-12">			
			<div class="panel panel-default">				
				<div class="panel-heading">					
					<strong>Team Management</strong>				
				</div>				<!-- /.panel-heading -->				
				<div class="panel-body">					
					<div class="table-responsive">						
						<form id="Teamlistform" name="Teamlistform" method="post" >	               
						<a id="multidelete" href="<?php echo base_url('index.php/administrator/team/delete_multiple');?>" class="btn btn-primary">Delete Multiple</a>						
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">							
							<thead>								
								<tr>									
									<th><input type="checkbox" id="checkall" name="checkall" onclick="checkUncheck();"></th>									<th>Team<?php if($sort == "team_title"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/team/all?sort=team_title&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/team/all?sort=team_title&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/team/all?sort=team_title&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>									<th>Description<?php if($sort == "description"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/team/all?sort=description&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/team/all?sort=description&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/team/all?sort=description&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>									<th>Team Leader<?php if($sort == "team_leader_id"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/team/all?sort=team_leader_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/team/all?sort=team_leader_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/team/all?sort=team_leader_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>									<th>Team Logo</th>									<th align="center">Actions</th>
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
									<td><?php echo $data->team_title;?></td>
									<td><?php echo $data->description;?></td>
									<td class="center"><?php  echo $data->team_leader_name;?></td>									
									<td align="center">
										<?php
											if($data->logo_image != '')
											{
												if(file_exists('assets/upload/team/'.$data->logo_image))
												{
										?>
										<img src = "<?php  echo base_url('assets/upload/team/'.$data->logo_image);?>" height="25" width="25" />
										<?php
												}
												else 
												{
										?>
										<img src = "<?php  echo base_url('assets/administrator/images/images.jpeg');?>" height="25" width="25" />
										<?php
												}
											}
											else 
											{
										?>
										<img src = "<?php  echo base_url('assets/administrator/images/images.jpeg');?>" height="25" width="25" />
										<?php
											}
										?>
									</td>									
									<td align="center">
										<a href="javascript:void(0);" onclick="single_team_delete('index.php/administrator/team/single_team_delete/<?php echo $data->id;?>','Teamlistform','Are you sure you want to delete this team ?','Team deleted successfully.');">											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete"></a>
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
               <?php if(isset($userdata['links'])){echo $userdata['links'];}?>
					</form>					
				</div>				
			</div>				<!-- /.panel-body -->			
		</div>			<!-- /.panel -->		
	</div>		<!-- /.col-lg-12 -->
</div>
</div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->