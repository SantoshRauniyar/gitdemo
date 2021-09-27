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

                                    url:'<?= base_url() ?>groups/deptlistbypro',
                                    method:'get',
                                    data:{pid:pid},

                                    success:function(dept)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#deptlist').html(dept);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(dept)
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
			<h1 class="page-header"></h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Program  Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
						?>
						<h3><b>	Department List</b></h3>
						<form id="Grouplistform" name="Grouplistform" method="post" >
                       
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
	
									<th>Department<?php if($sort == "groups_title"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/groups/all?sort=groups_title&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=groups_title&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=groups_title&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									
									<!--  <th>Team Name<?php if($sort == "team_id"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/groups/all?sort=team_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=team_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=team_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>-->
									<th>Department Head<?php if($sort == "manager_id"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/groups/all?sort=manager_id&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=manager_id&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/groups/all?sort=manager_id&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Program</th>
									<th align="center">Actions</th>
								</tr>
							</thead>
							<tbody id="deptlist">
							
                            </tbody>
						</table>
						<?php
							if(isset($userdata['links']))
								echo $userdata['links'];
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