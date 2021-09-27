<script type="text/javascript">
	
	$(document).ready(function(){

			
                 //check all order by OID
                               $('.program').change(function()
                    {
                               
                              var pid=$(this).val();
                             // var dname=$(this).attr('dept');
                              
                             alert(pid);
                               $.ajax({

                                    url:'<?= base_url() ?>projects/projectlistbypro',
                                    method:'get',
                                    data:{pid:pid},

                                    success:function(prolist)
                                    {
                                        alert(prolist);
                                           // id='#'+show;
                                        $('#projectlist').html(prolist);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(prolist)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })



                                 






                        })
</script>
<div id="container" style="padding:2%" >
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Projects</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Project Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
						?>

						 <h3><b>View Projects List</b></h3>
						<form id="projectslistform" name="projectslistform" method="post" >
										<div class="row">
								<div class="form-group col-md-4">
									<label>Select Program</label>
									<select class="form-control program" id="programlist">
										<option> Please Select Program</option>
										<?php

											foreach ($programlist as $value) {
						?>
										<option value="<?=  $value->pid ?>"><?= $value->pro_name ?></option>

						<?php
											}

										?>
									</select>
								</div>
								
							</div>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">	
							<thead>
								<tr>
									
									<th>Project Name<?php if($sort == "project_name"){if($type == "desc"){echo "<a href='". base_url('projects/all?sort=project_name&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('projects/all?sort=project_name&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('projects/all?sort=project_name&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Description<?php if($sort == "description"){if($type == "desc"){echo "<a href='". base_url('projects/all?sort=description&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('projects/all?sort=description&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('projects/all?sort=description&type=desc')."'><i class='fa fa-unsorted fa-unsorted pull-right'></i></a>";}?></th>
									<!-- <th>Team to assign<?php if($sort == "team_name"){if($type == "desc"){echo "<a href='". base_url('projects/all?sort=team_name&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('projects/all?sort=team_name&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('projects/all?sort=team_name&type=desc')."'><i class='fa fa-sorted fa-unsorted pull-right'></i></a>";}?></th>-->
									<th>Milestone<?php if($sort == "no_of_milestone"){if($type == "desc"){echo "<a href='". base_url('projects/all?sort=no_of_milestone&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('projects/all?sort=no_of_milestone&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('projects/all?sort=no_of_milestone&type=desc')."'><i class='fa fa-sorted fa-unsorted pull-right'></i></a>";}?></th>
									<th>Start Date<?php if($sort == "start_date"){if($type == "desc"){echo "<a href='". base_url('projects/all?sort=start_date&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('projects/all?sort=start_date&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('projects/all?sort=start_date&type=desc')."'><i class='fa fa-sorted fa-unsorted pull-right'></i></a>";}?></th>
									<th>End date<?php if($sort == "end_date"){if($type == "desc"){echo "<a href='". base_url('projects/all?sort=end_date&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('projects/all?sort=end_date&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('projects/all?sort=end_date&type=desc')."'><i class='fa fa-sorted fa-unsorted pull-right'></i></a>";}?></th>
									<th>Status<?php if($sort == "status"){if($type == "desc"){echo "<a href='". base_url('projects/all?sort=status&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('projects/all?sort=status&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('projects/all?sort=status&type=desc')."'><i class='fa fa-sorted fa-unsorted pull-right'></i></a>";}?></th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody id="projectlist">
							
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