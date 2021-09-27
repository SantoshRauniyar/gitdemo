
<div style="padding:2%;">
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
				<div class="panel-body" >
				<div class="panel-body" >
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Assign Role</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
							echo validation_errors('<div class="error">', '</div>'); 
						//	var_dump($data);
						?>
						
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('AssignRoles/do_update') ?>" enctype="multipart/form-data">
					
					
					<input type="hidden" name="id" value="<?= $assign[0]->id ?>">
                                    <div class="form-group">
                                        <label>Select Member</label>
                                        <select class="form-control" name="user_id">
                                            <option value="">Select Member</option>
                                            <?php
                                                
                                                foreach($users as $user)
                                                {
                                                    ?>
                                                    <option value="<?= $user->id ?>" <?= $assign[0]->user==$user->id?'selected':'' ?>><?= $user->user_name ?></option>
                                                    
                                                    <?php
                                                }
                                            
                                            ?>
                                        </select>
                                    </div>
                                  
                                  
                                    <div class="form-group">
                                        <label>Select User Role</label>
                                        <select class="form-control" name="user_role">
                                            <option value="">Select User Role</option>
                                            <?php
                                                
                                                foreach($user_roles as $user_role)
                                                {
                                                    ?>
                                                    <option value="<?= $user_role->id ?>" <?= $assign[0]->user_role==$user_role->id?'selected':'' ?> ><?= $user_role->user_role_name ?></option>
                                                    
                                                    <?php
                                                }
                                            
                                            ?>
                                        </select>
                                    </div>
                                                    
                   				
								
								<input type="submit" class="btn btn-primary"  value="Update" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">	
							</form>
						</div>     
					</div>
                    <!-- /.row (nested) -->
				</div>
                <!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->
</div>
</div>