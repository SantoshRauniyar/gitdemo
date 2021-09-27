<div>
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
							

								<div class="form-group">
									<label>Role Name:<strong><font color='red'>*</font></strong></label>
									<input readonly="" id="user_role_name" name="user_role_name" class="form-control" value="<?php if(isset($user_role_name)){echo $user_role_name;}?>" >
								</div>
								<div class="form-group">
							
								<label>Select Roles Master</label> 
								<select name="roles_master" class="form-control" disabled>
								    <?php
								    
								    foreach($roles_masters as $row)
								    {
								        ?>
								        <option value="<?= $row->id ?>" <?= $roles_master==$row->id?'selected':'' ?>><?= $row->name ?></option>
								        <?php
								    }
								    
								    ?>
								</select>
								</div>
								<div class="form-group">
									<label>Description:<strong><font color='red'>*</font></strong></label>
									<textarea  readonly="" id="description" name="description" class="form-control"><?php if(isset($description)){echo $description;}?></textarea>								
								</div>
									
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