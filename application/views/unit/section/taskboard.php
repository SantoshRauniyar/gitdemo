<script type="text/javascript">
	
	$(document).ready(function(){

			
                 //check all order by OID
                               $('.program').change(function()
                    {
                               
                              var pid=$(this).val();
                             // var dname=$(this).attr('dept');
                            // alert(pid);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>groups/deptbypro',
                                    method:'get',
                                    data:{pid:pid},

                                    success:function(tasklist)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#deptlist').html(tasklist);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(tasklist)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })
                               	//check all order by OID
                              $('.department').change(function()
                    {
                               
                              
                                    var did=$(this).val();
                             // var dname=$(this).attr('dept');
                            //alert(pid+did);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>section/secbydept',
                                    method:'get',
                                    data:{did:did},

                                    success:function(seclist)
                                    {
                                      //  alert(dept);
                                        $('#seclist').html(seclist);
                                    
                                         
                                         
                                    },
                                   error:function(seclist)
                                    {
                                        alert('error occurs');
                                    }


                        })
                            


                        })



                                    	
                               $('.end_date').mouseleave(function()
                    {
                               
                              var end_date=$(this).val();
                              var pid=$('#program').val();
                              var did=$('#deptlist').val();
                              var sid=$('#seclist').val();

                               var start_date=$('#start_date').val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!start_date) && (!pid)) {alert("Please Select Start Date and Program ")}
                             	else{
                           //alert(did+pid+end_date+start_date);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>section/taskbyprodeptsec',
                                    method:'get',
                                    data:{did:did,pid:pid,start_date:start_date,end_date:end_date,sid:sid},

                                    success:function(tasklist)
                                    {

                                        $('#settasklist').html(tasklist);
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
			<h1 class="page-header">Tasks</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color: #ef0f0f;border-color:#ef0f0f;color:white;vertical-align:all;">
					<strong>Section Taskboard</strong>
				<!--	<div class="row text-right">
						<div class="container pull-right" ><div class="col-md-4"></div><div class="col-md-2"><a href="#" style="color:yellow;text-decoration: none;font-weight: bold;" id="noti"><h4>Today</h4></a></div><div class="col-md-2"><a href="" style="color:white;text-decoration: none;font-weight: bold;" id="noti" onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'"><h4>Tomorrow</h4></a></div><div class="col-md-2"><a onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti"><h4>This Week</h4></a></div><div class="col-md-2"><a onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti"><h4>This Month</h4></a></div></div>
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
								<?= form_dropdown('program',$prolist,'',' id="program" class="form-control program"') ?>
							</div>

							<div class="form-group col-md-2">
								<label>
									Select Department
								</label>
								<select name="department"  id="deptlist" class="department form-control">
									
									<option>Select Please</option>
									

								</select>
							</div><div class="form-group col-md-2">
								<label>
									Select Section
								</label>
								<select name="section"  id="seclist" class="section form-control">
									
									<option>Select Please</option>
									

								</select>
							</div>
							<div class="col-md-2"> 
								<label>Start Date</label>
								<input type="datetime-local" class="form-control" name="start_date" id="start_date">
							</div>
														<div class="col-md-2"> 
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