<div id="page-wrapper">

	<div class="row">

		<div class="col-lg-12">

			<h1 class="page-header">Users</h1>

		</div>

		<!-- /.col-lg-12 -->

	</div>

	<!-- /.row -->

	<div class="row">

		<div class="col-lg-12">

			<div class="panel panel-default">

				<div class="panel-heading">

					<strong>User Management</strong>

				</div>

				<!-- /.panel-heading -->

				<div class="panel-body">

					<div class="table-responsive">

						<form id="userslistform" name="userslistform" method="post" action="<?php base_url('index.php/administrator/users/');?>">

						<table class="table table-striped table-bordered table-hover" id="dataTables-example">

							<thead>

								<tr>

									<th><input type="checkbox" id="checkall" name="checkall" onclick="checkUncheck();"></th>

									<th>Profile Image</th>

									<th>User Name</th>

									<th>Name</th>

									<th>User Type</th>
									
									<th>Email</th>

									<th>Contact Number</th>

									<th>Actions</th>

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

									<td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();"></td>

									<td align="center">

										<img src="<?php if($data->profile_image != ''){echo base_url('assets/upload/users/'.$data->profile_image);}else{echo base_url('assets/images/images.jpeg');}?>" height="25" width="25" />

									</td>

									<td><?php echo $data->user_name;?></td>

									<td class="center"><?php echo $data->first_name." ".$data->last_name;?></td>
									
									<td><?php if($data->user_role == "1"){echo "Team Leader";}else if($data->user_role == "2"){echo "Group Manager";}else if($data->user_role =="3"){echo "Group Members";}?></td>

									<td><?php echo $data->email;?></td>

									<td><?php echo $data->contact_no;?></td>

									<th>

										<a href="<?php echo base_url('index.php/administrator/users/edit_user/'.$data->id);?>">

											<img src="<?php echo base_url('assets/icons/edit.png');?>" height="18" width="18" title="Edit">

										</a>&nbsp;

										<a id="status" href="<?php echo base_url('index.php/administrator/users/change_user_status/'.$data->id.'/'.$data->status);?>">

											<img src="<?php if($data->status == 1){echo base_url('assets/icons/active.png');}else{echo base_url('assets/icons/inactive.png');}?>" height="18" width="18" title="<?php if($data->status == 1){echo "Inactive";}else{echo "active";}?>">

										</a>&nbsp;

										<a id="delete" href="<?php echo base_url('index.php/administrator/users/single_delete/'.$data->id);?>">

											<img src="<?php echo base_url('assets/icons/error_msg.png');?>" height="22" width="22" title="Delete">

										</a>

									</th>

								</tr>

							<?php

									}

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