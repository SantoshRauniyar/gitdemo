<script type="text/javascript">

          $('.assign').click(function()
                    {
                               
                               var tid=$(this).attr('tid');
                                      
                               alert(pid);
                               
                     /*  $.ajax({

                                    url:'https://medgenpharmacy.com/Cart/removeItem',
                                    method:'get',
                                    data:{tid:tid},

                                    success:function(cart_result)
                                    {
                                        //alert(cart_result);

                                        $('#remove').html(cart_result);
                                         $('.mycartCount').click(); 
                                         location.reload();
                                    },
                                   /* error:function(cart_result)
                                    {
                                        alert('errortt');
                                    }


                        });*/

                    });
    
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
					<strong>Hasptal Management</strong>
					<div class="row text-right">
						<div class="container pull-right" ><div class="col-md-4"></div><div class="col-md-2"><a href="#" style="color:yellow;text-decoration: none;font-weight: bold;" id="noti"><h4>Today</h4></a></div><div class="col-md-2"><a href="" style="color:white;text-decoration: none;font-weight: bold;" id="noti" onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'"><h4>Tomorrow</h4></a></div><div class="col-md-2"><a onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti"><h4>This Week</h4></a></div><div class="col-md-2"><a onMouseOver="this.style.color='yellow'" onMouseLeave="this.style.color='#fff'" href="#" style="color:white;text-decoration: none;font-weight: bold;" id="noti"><h4>This Month</h4></a></div></div>
			</div>

				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
					<?php 
							$this->load->view('common/errors');
					?>
						<form id="Tasklistform" name="Tasklistform" method="post" >
                       
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr><th>Name</th><th>Created At</th><th>Service Type</th><th>Status</th><th>Action</th></tr>
							</thead>
							<tbody>
							<?php
								
							?>

									<?php

										foreach ($haspatal_data as $value) {
											
												?>

													<tr>
														<td><?=$value->hospital_name ?></td>
														<td><?=$value->created_at ?></td>
														
														<td>
															<?php

																switch ($value->services) {
																	case '1':
																		echo "Single Specialty";
																		break;
																		case '2':
																		echo "Multi Specialities";
																		
																				}

															?>
														</td>
																												<td>
															<?= $value->status?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Pending</span>'	?>
														</td>
														
														<td><a href="<?=  base_url('haspatal_registers/view_haspatal').'/'.$value->id?>" style="color:white;background-color:#ef0f0f;border-color: #ef0f0f" class="	btn btn-info">Open</a></td>
													
                                 <!-- <td><button type="button" class="btn btn-primary btn-sm assign" tid="<?= $value->id ?>" style="background-color:#ef0f0f;color:#ef0f0f;border-color:#ef0f0f;" data-toggle="modal" data-target="#exampleModal">A</button></td>-->
													</tr>

												<?php

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





<!-- Button trigger modal -->

