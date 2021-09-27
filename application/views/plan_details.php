<div  style="padding:2%;">
	<?php
		if($mode == "Display")
		{
	?>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Plans Details</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong>Plans</strong>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<?php
						if(isset($planDetails) && !empty($planDetails))
						{
							foreach($planDetails as $plans)
							{
					?>
					<div class="col-md-3">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong><?php echo $plans['plan_title'];?></strong>							
							</div>
							<div class="panel-body text-center">
								 <ul class="list-group" style="list-style:round;">
								 	<li class="list-group-item list-group-item-success" style="margin-top:5px;"><?php echo "Validity ".$plans['validiti_period']." years.";?></li>
								 	<li class="list-group-item list-group-item-success" style="margin-top:5px;"><?php echo "No. of Teame ".$plans['no_of_team'].".";?></li>
									<li class="list-group-item list-group-item-success" style="margin-top:5px;"><?php echo "No. of User per team ".$plans['no_of_user_in_team'].".";?></li>
									<li class="list-group-item list-group-item-success" style="margin-top:5px;"><?php echo "No. of Groups ".$plans['no_of_group'].".";?></li>
									<li class="list-group-item list-group-item-success" style="margin-top:5px;"><?php if($plans['is_timezone_allow'] != '1'){echo "Multiple Timezone not allowed.";}else{echo "Multiple Timezone allowed.";}?></li>
									<li class="list-group-item list-group-item-success" style="margin-top:5px;"><?php if($plans['is_currency_allow'] != '1'){echo "Multiple Currency not allowed.";}else{echo "Multiple Currency allowed.";}?></li>
									<li class="list-group-item list-group-item-success" style="margin-top:5px;"><?php if($plans['is_auto_email'] != '1'){echo "Auto Email not allowed.";}else{echo "Auto Email allowed.";}?></li>
									<li class="list-group-item list-group-item-success" style="margin-top:5px;"><?php if($plans['is_member_leave_allow'] != '1'){echo "Leave Management not allowed.";}else{echo "Leave Management allowed.";}?></li>
									<li class="list-group-item list-group-item-success" style="margin-top:5px;"><?php if($plans['is_theam_allow'] != '1'){echo "Theme Management not allowed.";}else{echo "Theme Management allowed.";}?></li>										
								</ul>
							</div>
						</div>
					</div>
					<?php
							}
						}
						else 
						{
							echo "No Plan available.";
						}	
					?>				
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<?php 
		}
		else if($mode == "Payment") 
		{
	?>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="login-panel well">
				<form role="form" id="paymentForm" name="paymentForm" method="post" action="<?php echo base_url();?>plan/payment_checkout/">
					<input type="hidden" id="plan_id" name="plan_id" value="<?php echo $planDetails['id'];?>">
					<input type="hidden" id="plan_title" name="plan_title" value="<?php echo $planDetails['plan_title'];?>">
					<input type="hidden" id="price" name="price" value="<?php echo $planDetails['price'];?>">
					<input type="hidden" id="validiti_period" name="validiti_period" value="<?php echo $planDetails['validiti_period'];?>">
				<ul class="list-group">
					<li class="list-group-item disabled" style="border:none;background-color:transparent;text-align:center;padding:0px;">Captain ID : <?php echo $this->session->userdata('id');?></li> 
					<li class="list-group-item disabled" style="border:none;background-color:transparent;text-align:center;padding:0px;">Captain Name : <?php echo $this->session->userdata('user_name');?></li>
					<li class="list-group-item disabled" style="border:none;background-color:transparent;text-align:center;padding:0px;">&nbsp;</li>
					<li class="list-group-item disabled" style="border:none;background-color:transparent;padding:0px;">Plan Selected 	 : <?php echo $planDetails['plan_title'];?> <?php echo $planDetails['validiti_period'];?> Year</li>
					<li class="list-group-item disabled" style="border:none;background-color:transparent;padding:0px;">Plan Start Date : <?php echo date("M d, Y, l");?> </li>
					<li class="list-group-item disabled" style="border:none;background-color:transparent;padding:0px;">Amount Payable  : <?php echo $planDetails['price'];?> </li>
					<li class="list-group-item disabled" style="border:none;background-color:transparent;text-align:center;padding:0px;">&nbsp;</li>
					<li class="list-group-item disabled" style="border:none;background-color:transparent;padding:0px;">
						<button type="submit" value="checkout" class="btn btn-success btn-block btn-lg" id="checkout" name="checkout">Proceed to Checkout</button>
					</li>
				</ul>
				</form>
			</div>
		</div>
	</div>
	<?php	
		}
		else if($mode == "Success_Payment")
		{
	?>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="login-panel well">
				<ul class="listgroup">
					<li class="list-group-item disabled" style="border:none;background-color:transparent;text-align:center;padding:0px;">Thanks for your Payment,</li>
					<li class="list-group-item disabled" style="border:none;background-color:transparent;text-align:left;padding:0px;">Rs. <?php echo $price;?> have been activated in your account</li>
					<li class="list-group-item disabled" style="border:none;background-color:transparent;text-align:center;padding:0px;">Captain ID :<?php echo $this->session->userdata('id');?></li>
				</ul>
			</div>
		</div>
	</div>
	<?php
		}
	?>
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->