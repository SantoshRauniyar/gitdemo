1<div>
	<div class="row">
		<div class="col-lg-12">
			<br><br><br><br>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong><?php echo $heading;?></strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
								<?php if($mode == "edit"){?>
								<input type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />
								<div class="clearfix"></div>
								<?php } ?>
								<div class="form-group">
									<label>Role Name:<strong><font color='red'>*</font></strong></label>
									<input id="user_role_name" name="user_role_name" class="form-control" value="<?php if(isset($user_role_name)){echo $user_role_name;}?>" >
								</div>
								<div class="form-group">
							
								<label>Select Roles Master</label> 
								<select name="roles_master" class="form-control">
								    <?php
								    
								    foreach($roles_masters as $row)
								    {
								        ?>
								        <option value="<?= $row->id ?>" <?php if($mode == "edit"){ echo $d=$roles_master==$row->id?'selected':''; ?><?php } ?>><?= $row->name ?></option>
								        <?php
								    }
								    
								    ?>
								</select>
								</div>
								<div class="form-group">
									<label>Description:<strong><font color='red'>*</font></strong></label>
									<textarea id="description" name="description" class="form-control"><?php if(isset($description)){echo $description;}?></textarea>								
								</div>
								<input type="submit" class="btn btn-primary" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;" value="<?php if($mode == 'edit'){echo 'Update';}else{echo 'Save';}?>">	
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