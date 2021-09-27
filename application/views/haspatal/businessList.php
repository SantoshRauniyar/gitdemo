<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Business List</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong><?= $btype ?> Business List</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body" >
					<div class="table-responsive">
						<?php 
							$this->load->view('common/errors');
			
						?>
									<h3>	<b>View  <?= $btype ?> Business <?=$heading ?> List</b></h3>
						
						<form id="Grouplistform" name="Grouplistform" method="post" >
                       
                                                    
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
								    <th>Sr.</th>
								<th>Date  </th>
									
									<th>Name</th>
									<th>Email</th>
									
								        <th>Phone</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>City</th>
                                    <th>Pincode</th>
                                    
								
									
								</tr>
								
								
								<?php
								$sr=1;
								        
								        foreach($responseData as $row)
								        {
								?>
								
								<tr>
								    <td><?= $sr ?></td>
								    <td><?= $row->created_at ?></td>
								    <td><?= $row->b_name ?></td>
								    
								    <td><?= $row->email ?></td>
								    
								    
								    
								    <td><?= $row->mobile ?></td>
								    <td><?= $row->state ?></td>
								    <td><?= $row->district_name ?></td>
								    					    <td><?= $row->city ?></td>
								    <td><?= $row->pincode ?></td>
								     
								    
								</tr>
								<?php
								$sr++;
								        }
								    
								?>
								
							</thead>
							<tbody>
				
								
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