<script type="text/javascript">
	
	$(document).ready(function(){

			
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

                                    success:function(tasklist)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#projectlist').html(tasklist);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(tasklist)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })
                             
                                                              	//check all order by OID
                               $('.project').change(function()
                    {
                               
                             
                                    var pid=$(this).val();
                             // var dname=$(this).attr('dept');
                           // alert(pid);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>milestone/milebyproject',
                                    method:'get',
                                    data:{pid:pid},

                                    success:function(milestonelist)
                                    {
                                       // alert(milestonelist);
                                           // id='#'+show;
                                        $('#milestonelist').html(milestonelist);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(milestonelist)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })







          $('.end_date').mouseleave(function()
                    {
                               
                              var end_date=$(this).val();
                              var pid=$('#program').val();


                               var project_id=$('#projectlist').val();
                                    var milestone_id=$('#milestonelist').val();

                               var start_date=$('#start_date').val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!start_date) || (!pid) || (!milestone_id)) {alert("Please Select Start Date and Program ")}
                              else{
                           //alert(did+pid+end_date+start_date);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>milestone/taskbymilestone',
                                    method:'get',
                                    data:{project_id:project_id,pid:pid,start_date:start_date,end_date:end_date,mile_id:milestone_id},

                                    success:function(tasklist)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#settasklist').html(tasklist);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(tasklist)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


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
				<div class="panel-heading" style="background-color: #ef0f0f;border-color:#ef0f0f;color:white;vertical-align:all;">
					<strong>Milestone Taskboard</strong><!--   &nbsp;&nbsp;&nbsp;&nbsp; <a  onmouseover="this.style.color='yellow'" onmouseleave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti">All</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  onmouseover="this.style.color='yellow'" onmouseleave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti">Today</a>&nbsp;&nbsp;&nbsp;&nbsp;<a  onmouseover="this.style.color='yellow'" onmouseleave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti">Tomorrow</a>&nbsp;&nbsp;&nbsp;&nbsp;<a  onmouseover="this.style.color='yellow'" onmouseleave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti">This Week</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  onmouseover="this.style.color='yellow'" onmouseleave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti">This Month</a>
					<div class="row text-right">
						<div class="container pull-right" ><div class="col-md-4"></div><div class="col-md-2"></div><div class="col-md-2"><a href="" style="color:white;text-decoration: none;font-weight: bold;" id="noti" onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'"><h4>Tomorrow</h4></a></div><div class="col-md-2"><a  onmouseover="this.style.color='yellow'" onmouseleave="this.style.color='#fff'" onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti"><h4>This Week</h4></a></div><div class="col-md-2"><a onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti"><h4>This Month</h4></a></div></div>
			</div>-->

				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
					<?php 
							$this->load->view('common/errors');
					?>

						<div class="row">
							<div class="form-group col-md-2">
								<label>
									Select Program
								</label>
								<select name="program" id="program"  class="program form-control">
									
									<option>Select Please</option>
									<?php

									foreach ($prolist as $value) {
										
										?>
										<option value="<?= $value->pid ?>"><?= $value->pro_name ?></option>
										<?php
									}

									?>

								</select>
							</div>



	<div class="form-group col-md-2">
								<label>
									Select Project
								</label>
								<select name="project"  id="projectlist" class="project form-control">
									
									<option>Select Please</option>
									

								</select>
							</div>

								<div class="form-group col-md-2">
								<label>
									Select Milestone
								</label>
								<select name="Milestone"  id="milestonelist" class="milestone form-control">
									
									<option>Select Please</option>
									

								</select>
							</div>
              <div class="col-md-3"> 
                <label>Start Date</label>
                <input type="datetime-local" class="form-control" name="start_date" id="start_date">
              </div>
                            <div class="col-md-3"> 
                <label>End Date</label>
                <input type="datetime-local" class="form-control end_date" id="end_date" name="end_date">
              </div>


						</div>


						<form id="Tasklistform" name="Tasklistform" method="post" >
                       
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
	<th>Target Completion</th><th>Task Title</th><th>Created By</th><th>Created On</th><th>Priority</th><th>Program</th><th>Project</th><th>Assigned to</th><th>Status</th><th>Action</th>
								</tr>
							</thead>
							<tbody id="settasklist">
							
                            </tbody>
						</table>
						<?php if(isset($userdata['links'])){echo $userdata['links'];}?>
						<div id="#task_reassigning_model" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm">
    							<div class="modal-content">
									<div class="modal-header">
        								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        								<h4 class="modal-title">Task Discussion</h4>
      								</div>
      								<div class="modal-body">	
      								</div>
									<div class="modal-footer">
										<div class="input-group">
											<input id="task_id" name="task_id" type="hidden" value="">
											<input id="comment" name="comment" type="text" class="form-control input-sm" placeholder="Type your comment here..." />
											<span class="input-group-btn">
												<button id="send" name="send" type="submit" class="btn btn-warning btn-sm" id="btn-chat">
												Send
												</button>
											</span>
										</div>
      								</div>
	    						</div>
  							</div>
						</div>
						<div id="task_discussion_model" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-sm">
    							<div class="modal-content">
									<div class="modal-header">
        								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        								<h4 class="modal-title">Task Discussion</h4>
      								</div>
      								<div class="modal-body">	
      								</div>
									<div class="modal-footer">
										<div class="input-group">
											<input id="task_id" name="task_id" type="hidden" value="">
											<input id="comment" name="comment" type="text" class="form-control input-sm" placeholder="Type your comment here..." />
											<span class="input-group-btn">
												<button id="send" name="send" type="submit" class="btn btn-warning btn-sm" id="btn-chat">
												Send
												</button>
											</span>
										</div>
      								</div>
	    						</div>
  							</div>
						</div>
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
