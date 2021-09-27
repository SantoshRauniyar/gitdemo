<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<br><br><br><br>
		</div>
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>User Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
						?>
						<form id="userslistform" name="userslistform" method="post" action="<?php base_url('index.php/administrator/users/');?>">
						<!--<a id="add_role" href="<?php echo base_url('user_role/add_role');?>" class="btn btn-primary" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;" >Add Role</a>
						<a id="setpermission" href="<?php echo base_url('user_role/set_privillages');?>" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;" class="btn btn-primary">Set Role Permission</a>-->
						<?php
						if(isset($userroledata))
						{
						?>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<!-- <th><input type="checkbox" id="checkall" name="checkall" onclick="checkUncheck();"></th>-->
									<th>User Role</th>
									<th>Description</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
									foreach($userroledata['results'] as $data)
									{
							?>
								<tr class="odd gradeX">
									<!--  <td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();"></td>-->
									<td><?php echo $data->user_role_name;?></td>
									<td><?php echo $data->description;?></td>
									<td>
									    <?php
									    if(!isset($action))
									    {
									        $action='';
									    }
									    switch($action)
									    {
									        case 'edit':
									            ?>
		<a class=" btn btn-info" style="border-color:#ef0f0f;color:white;background-color:#ef0f0f" href="<?php echo base_url('user_role/edit_user_role/'.$data->id);?>">Edit
																					</a>&nbsp;
																					<?php  break;
																					
																					case 'delete':
																					    ?>
																					    <a class=" btn btn-info" style="border-color:#ef0f0f;color:white;background-color:#ef0f0f" id="delete" href="<?php echo base_url('user_role/single_role_delete/'.$data->id);?>">Delete
											
										</a>
																					    <?php
																					    break;
																					    default:
																					        ?>
																					        <a class=" btn btn-info" style="border-color:#ef0f0f;color:white;background-color:#ef0f0f" id="view" href="<?php echo base_url('user_role/single_role_view/'.$data->id);?>">View
											
										</a>
										
										<?php
									            
									    }
									    
									    ?>
	
										
									</td>
								</tr>
							<?php
									}
							?>
                            </tbody>
						</table>
						<?php
								echo $userroledata['links'];
						}
						else 
						{
							echo "No record available.";
						} 
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