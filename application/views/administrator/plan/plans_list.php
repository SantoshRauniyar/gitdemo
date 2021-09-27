<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Plans</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<strong>Plan Management</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="table-responsive">
						<form id="planlistform" name="planlistform" method="post" >
						<a id="multidelete" href="javascript:void(0);" class="btn btn-primary" onclick="multiple_delete('index.php/administrator/plan/delete_multiple','planlistform','Are you sure you want to delete these plan ?','Plans deleted Successfully.');">Delete Multiple</a>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th><input type="checkbox" id="checkall" name="checkall" onclick="checkUncheck();"></th>
									<th>Plan title<?php if($sort == "plan_title"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/plan/all?sort=plan_title&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/plan/all?sort=plan_title&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/plan/all?sort=plan_title&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									<th>Description<?php if($sort == "description"){if($type == "desc"){echo "<a href='". base_url('index.php/administrator/plan/all?sort=description&type=desc')."'><i class='fa fa-sort-asc pull-right'></i></a>";}else{echo "<a href='". base_url('index.php/administrator/plan/all?sort=description&type=asc')."'><i class='fa fa-sort-desc pull-right'></i></a>";}}else{echo "<a href='". base_url('index.php/administrator/plan/all?sort=description&type=desc')."'><i class='fa fa-unsorted pull-right'></i></a>";}?></th>
									
									<th align="center">Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php
								if(isset($userdata))
								{
									foreach($userdata['results'] as $data)
									{
							?>
								<tr class="odd gradeX">
									<td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();" value="<?php echo $data->id;?>" ></td>
									<td>
										<?php echo $data->plan_title;?>
									</td>
									<td class="center"><?php echo $data->description;?></td>
									<td align="center">
										<a href="<?php echo base_url('index.php/administrator/plan/edit_plan/'.$data->id);?>">
											<img src="<?php echo base_url('assets/administrator/icons/edit.png');?>" height="18" width="18" title="Edit">
										</a>&nbsp;
										
										<a id="delete" href="javascript: void(0);" onclick= "single_delete('index.php/administrator/plan/delete_plan/<?php echo $data->id;?>','planlistform','Are you sure you want to delete this plan ?','Plan deleted successfully.')">											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete">
										</a>
									</td>
								</tr>
							<?php
									}
								}
								else
								{
									echo "<tr><td colspan=6 align=center>No Recoreds Available</td></tr>";
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