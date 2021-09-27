	<script type="text/javascript">
	
	$(document).ready(function(){

			$('#secondform').hide();
                 //check all order by OID
                               $('.program').change(function()
                    {
                               
                              var pid=$(this).val();
                             // var dname=$(this).attr('dept');
                              
                            // alert(pid);
                               $.ajax({

                                    url:'<?= base_url() ?>projects/projectbypro',
                                    method:'get',
                                    data:{pid:pid},

                                    success:function(prolist)
                                    {
                                      //  alert(dept);
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


                                  $('.project').change(function()
                    {
                               
                              var project_id=$(this).val();
                              var pid=$('#programlist').val();
                             // var dname=$(this).attr('dept');
                              
                             alert(pid+project_id);
                               $.ajax({

                                    url:'<?= base_url() ?>milestone/viewmilebypro',
                                    method:'get',
                                    data:{pid:pid,project_id:project_id},

                                    success:function(mile)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#milestonelist').html(mile);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(mile)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })



                                 






                        })
</script>

<div style="padding:2%;">
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
					<strong>Projects Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
					<?php 
							$this->load->view('common/errors');
						?>

						<h3><b>Milestone List</b></h3>
						<form id="Milestonelistform" name="Milestonelistform" method="post" >
								<div class="row">
									<div class="form-group col-md-6">
										<label>Select Program</label>
										<select class="form-control program" id="programlist">
											<option>Select Please</option>
											<?php

												foreach ($programlist as $value) {
										?>
												
												<option value="<?= $value->pid ?>"><?= $value->pro_name ?></option>

										<?php
												}

											?>
										</select>
									</div>

									<div class="form-group col-md-6">
										<label>Select Project</label>
										<select class="form-control project" id="projectlist">
											
										</select>
									</div>
								</div>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									
									<th>Milestone title<?php if($sort == "milestone_title"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/milestone/all?sort=milestone_title&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=milestone_title&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=milestone_title&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Project Name<?php if($sort == "project_id"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/milestone/all?sort=project_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=project_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=project_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Description<?php if($sort == "description"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/milestone/all?sort=description&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=description&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=description&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Budget<?php if($sort == "budget"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/milestone/all?sort=budget&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=budget&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/milestone/all?sort=budget&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th align="center">Actions</th>
								</tr>
							</thead>
							<tbody id="milestonelist">
							
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