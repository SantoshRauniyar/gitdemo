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
					<strong><?php echo $heading;?></strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
							<form role="form" name="editplanform" id="editplanform" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
								<?php if($mode == "edit"){?>
								<input type="hidden" id="id" name = "id" value="<?php if(isset($id)){echo $id;}?>" />
								
								<div class="clearfix"></div>
								<?php } ?>
								<div class="form-group">
									<label>Plan Title:<strong><font color='red'>*</font></strong></label>
									<input id="plan_title" name="plan_title" class="form-control" value="<?php if(isset($plan_title)){echo $plan_title;}?>" >
								</div>
								<div class="form-group">
									<label>Select Plan Type:<strong><font color='red'>*</font></strong></label>
									<?php
										$plantypelist = array(""=>"Select Plan Type","1"=>"Free","2"=>"Payable");
										if(isset($plan_type))
										{
											echo form_dropdown("plan_type",$plantypelist,$plan_type,"class='form-control' id='plan_type'");
										} 
										else
										{
											echo form_dropdown("plan_type",$plantypelist,'',"class='form-control' id='plan_type'");
										}
									?>
								</div>
								<div class="form-group">
									<label>Price:<strong><font color='red'>*</font></strong></label>
									<input type="text" id="price" name="price" class="form-control" value="<?php if(isset($price)){echo $price;}?>">
								</div>
								<div id="plan_amount" class="form-group" <?php if(isset($paln_type) && $plan_type == 2){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
									<lable>Amount Playable:</lable>
									<input type="text" id="amount" name="amount" class="form-control" value="<?php if(isset($amount)){echo $amount;}?>">
								</div>
								<div class="form-group col-md-6" style="margin-left:-15px !important;">
									<lable><strong>Select validity period of plan:</strong></lable>
									<?php
										 $validitylist = array("0"=>"Select Validity for plan","1"=>"Three Months","2"=>"Six Months","3"=>"Nine Months","4"=>"One Year","5"=>"Two Year","6"=>"Three Year");
										 if(isset($validiti_period))
										 {
										 	echo form_dropdown("validiti_period",$validitylist,$validiti_period,"class='form-control'");
										 }
										 else
										 {
										 	echo form_dropdown("validiti_period",$validitylist,'',"class='form-control'");
										 }
									?>
								</div>
								
								<div class="form-group col-md-6">
									<lable><strong>Allow Number of Team:</strong></lable>
									<input type="text" id="no_of_team" name="no_of_team" class="form-control" value="<?php if(isset($no_of_team)){echo $no_of_team;}?>">
								</div>
								<div class="form-group col-md-6" style="margin-left:-15px !important;">
									<lable><strong>Allow Number of user in team:</strong></lable>
									<input type="text" id="no_of_user_in_team" name="no_of_user_in_team" class="form-control" value="<?php if(isset($no_of_user_in_team)){echo $no_of_user_in_team;}?>">
								</div>
								<div class="form-group col-md-6">
									<lable><strong>Allow Number of Group:</strong></lable>
									<input type="text" id="no_of_group" name="no_of_group" class="form-control" value="<?php if(isset($no_of_group)){echo $no_of_group;}?>">
								</div>
								<div class="form-group col-md-6" style="margin-left:-15px !important;">
									<lable><strong>Allow Timezone Setting:</strong></lable>
									<?php
										$arraylist = array("0"=>"Select Yes/No","1"=>"Yes","2"=>"No");
										if(isset($is_timezone_allow))
										{
											echo form_dropdown("is_timezone_allow",$arraylist,$is_timezone_allow,"class='form-control'");
										} 
										else
										{
											echo form_dropdown("is_timezone_allow",$arraylist,"2","class='form-control'");
										}
									?>
								</div>
								<div class="form-group col-md-6">
									<lable><strong>Allow Multiple type of Currency:</strong></lable>
									<?php
										$arraylist = array("0"=>"Select Yes/No","1"=>"Yes","2"=>"No");
										if(isset($is_currency_allow))
										{
											echo form_dropdown("is_currency_allow",$arraylist,$is_currency_allow,"class='form-control'");
										} 
										else
										{
											echo form_dropdown("is_currency_allow",$arraylist,"2","class='form-control'");
										}
									?>
								</div>
								<div class="form-group col-md-6" style="margin-left:-15px !important;">
									<lable><strong>Allow Auto Email:</strong></lable>
									<?php
										$arraylist = array("0"=>"Select Yes/No","1"=>"Yes","2"=>"No");
										if(isset($is_auto_email))
										{
											echo form_dropdown("is_auto_email",$arraylist,$is_auto_email,"class='form-control'");
										} 
										else
										{
											echo form_dropdown("is_auto_email",$arraylist,"2","class='form-control'");
										}
									?>
								</div>
								<div class="form-group col-md-6">
									<lable><strong>Allow Member Leave Management:</strong></lable>
									<?php
										$arraylist = array("0"=>"Select Yes/No","1"=>"Yes","2"=>"No");
										if(isset($is_member_leave_allow))
										{
											echo form_dropdown("is_member_leave_allow",$arraylist,$is_member_leave_allow,"class='form-control'");
										} 
										else
										{
											echo form_dropdown("is_member_leave_allow",$arraylist,"2","class='form-control'");
										}
									?>
								</div>
								<div class="form-group col-md-6" style="margin-left:-15px !important;">
									<lable><strong>Allow Theam Setting:</strong></lable>
									<?php
										$arraylist = array("0"=>"Select Yes/No","1"=>"Yes","2"=>"No");
										if(isset($is_theam_allow))
										{
											echo form_dropdown("is_theam_allow",$arraylist,$is_theam_allow,"class='form-control'");
										} 
										else
										{
											echo form_dropdown("is_theam_allow",$arraylist,"2","class='form-control'");
										}
									?>
								</div>
								<div class ="clearfix"></div>
								
								<div class="form-group">
									<label>Description:<strong><font color='red'>*</font></strong></label>
									<textarea id="description" name="description" class="form-control"><?php if(isset($description)){echo $description;}?></textarea>
								</div>
								<div class="clearfix"></div>
								
								<input type="submit" class="btn btn-primary" value="<?php if($mode == 'edit'){echo 'Update';}else{echo 'Save';}?>">	
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