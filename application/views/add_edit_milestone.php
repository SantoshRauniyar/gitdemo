		<script type="text/javascript">
			
 
$(document).ready(function(){






                 //unit head from class onchange Function
                               $('.project').change(function()
                    {
                        var id=$(this).val();

                        alert(id);
                    


                        $.ajax({

                                    url:'<?= base_url() ?>users/getmileHead',
                                    method:'get',
                                    data:{id:id},

                                    success:function(milehead)
                                    {

                                        $('#my').html(milehead);//my on followers box
                                        $('#milehead').html(milehead);//my on followers box
                                    
                                         
                                         
                                    },
                                   error:function(milehead)
                                    {
                                        alert('error occurs');
                                    }


                        })
                    })



                      

})


		</script>
<div style="padding: 2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Milestone</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Milestones Management</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
						<h3><b>Create a Milestone</b></h3>
												<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
								<?php if($mode == "edit"){?>
								<input type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />
								
								<div class="clearfix"></div>
								<?php } ?>
								<div class="form-group">
									<label>Milestone Title:<strong><font color='red'>*</font></strong></label>
									<input id="milestone_title" name="milestone_title" class="form-control" value="<?php if(isset($milestone_title)){echo $milestone_title;}?>" >
								</div>
								<div class="form-group" style="margin-left:0;">
									<label>Project Name:<strong><font color='red'>*</font></strong></label>
									
									<?php
										if(isset($project_id))
										{
											echo form_dropdown("project_id",$projectlist,$project_id,"class='form-control  col-md-6 project'");
										}
										else
										{
											echo form_dropdown("project_id",$projectlist,'',"class='project form-control col-md-6'");
										}
										
									?>
									
									
								</div>
								<div class="form-group">
										<label>Select Milestone Head:</label>
										

                                <?php
											if(isset($mile_head) && !empty($mile_head))
											{
												echo form_dropdown('mile_head',$userlist,$mile_head,"id = 'milehead' class='form-control '");
											}
											else
											{
												echo form_dropdown('mile_head',$userlist,'',"id = 'milehead' class='form-control '");
											}
										?>
									</div>
									     <div class="form-group" >
                                             
									<label>Milestone Follwers(Multiple Select)</label>
								 <?php	if(isset($users) && !empty($users))
											{
											    $a1=explode('-',$users);
												echo form_multiselect('users[]',$userlist,$a1,"id = 'my' class='form-control '");
											}
											else
											{
											    
												echo form_multiselect('users[]',$userlist,'',"id = 'my' class='form-control '");
											
											}
											?>
								</div>
								
								<div class="form-group">
									<label>Description:<strong><font color='red'>*</font></strong></label>
									<textarea id="description" name="description" class="form-control" ><?php if(isset($description)){echo $description;}?></textarea>
								</div>
								<div class="form-group">
									<label>Budget:<strong><font color='red'>*</font></strong></label>
									<input id="budget" name="budget" class="form-control" value="<?php if(isset($budget)){echo $budget;}?>" >
								</div>
								
								<div class="clearfix"></div>
								
								<input style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;" type="submit" class="btn btn-primary" value="<?php if($mode == 'edit'){echo 'Update';}else{echo 'Save';}?>">	
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