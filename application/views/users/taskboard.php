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
					<strong>My Taskboard</strong>
				

				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
					<?php 
							$this->load->view('common/errors');
					?>

			
						<form id="Tasklistform" name="Tasklistform" method="post">
                       
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
	<th>Target Completion</th><th>Task Title</th><th>Assigned By</th><th>Priority</th><th>Program</th><th>Remarks</th><th>Status</th><th>Action</th>
								</tr>
							</thead>
							<tbody id="settasklist">
							    
							    <?php
				                        
				                        if(!empty($tasklist))
				                        {
				                        foreach($tasklist as $value)
				                        {
				                        	$end_date = strtotime($value->end_date);
											$completed_at = strtotime($value->completed_at);
											$date=strtotime(date('d-m-Y'));

				                            ?>
				                            <tr  <?php if($end_date<$date and $value->status<=2){echo'style="color:red"';} ?>>
				                            <td><?= $value->end_date ?></td>
				                            <td><?= $value->title ?></td>
				                            
				                            <td><?= $value->user_name ?></td>
				                            <td>
				                                <?php
				                                
				                                switch($value->priority)
				                                {
				                                    case 1:
				                                        echo"Low";
				                                        break;
				                                        				                                    case 2:
				                                        echo"Medium";
				                                        break;
				                                        				                                    case 3:
				                                        echo"High";
				                                        break;
				                                        				                                    case 4:
				                                        echo"Very High";
				                                        break;
				                                        				                                    case 5:
				                                        echo"Urgent";
				                                        break;
				                                }
				                                
				                                ?>
				                            </td>
				                            <td><?= $value->pro_name ?></td>
				                            <td><?=$value->description ?></td>
				                        
				                            <td><?php

																switch ($value->status) {
																	case '0':
																		echo "Not Assigned";
																		break;
																		case '1':
																		echo "Assigned";
																		break;
																		case '2':
																		echo "Opened";
																		break;
																		case '3':
																		echo "Mark As Completed";
																		break;
																		case '4':
																		echo "Approved";
																		break;
																			case '5':
																		echo "Aborted";
																		break;	case '6':
																		echo "Rejected";
																		break;
																	
																}

															?></td>
															
            <td><a href="<?=  base_url().'task/opentask/'.$value->id.'/2' ?>" style="color:white;background-color:#ef0f0f;border-color: #ef0f0f" class="	btn btn-info">Open</a></td>

	</tr>
				                            
				                            <?php
				                        }
				                        }
				                        else
				                        {
				                            echo'<tr colspan="6"><div class="alert alert-danger">Task Empty</div></tr>';
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

		
