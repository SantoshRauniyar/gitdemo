<style type="text/css">
	li a{color:#191919;font-weight: bold;font-size:1em;font-family:montserrat;letter-spacing:0.01em;}
.stellarnav	li a{color:black;background-color: white;border-top-color:grey;}
*{font-family:montserrat;}

@media only screen and (min-width: 600px) {
  #x{
    left:-50px;
  }


.dim:hover{background-color:grey;opacity:0.7;}

  @media only screen and (min-width: 300px) {
  li,ul,a{{
    background-color: powderblue;
  }
}

.bgc , .panel-heading{background-color:#ef0f0f;border-color:#ef0f0f;color:white;}
.bgc a{color:white;font-weight;bold;}
.low{opacity:0.4;color:grey;}


/* styles for this sample only */
*{ margin: 0; padding: 0; }
body { height: 3200px; font-size: 16px; font-family: 'Exo 2', sans-serif; background: #efefef; color: #555; }
.header { text-align: center; }
.header a { padding: 30px 0 0; display: block; font-size: 48px; text-decoration: none; color: #555; }
.header p { margin: 10px 0 40px 0; font-size: 18px; }
.container { max-width: 1200px; margin: 0 auto; }
@media only screen and (max-width : 1000px) {
	.stellarnav > ul > li > a { padding: 20px 23px; }
}
/* styles for this sample only */



</style>

	



<?php      


$deliveryData   = @$_SESSION['deliverdata1'];

if($this->session->userdata('user_role')=='Captain')
{
    $deliveryData=  array('id' => '12','user_role_name' => 'Program Director','team_id' => '29','created_by_user_id' => '77','description' => 'Program Head for Haspatal','is_add_sec'=>1,'is_del_sec'=>1,'is_view_sec'=>1,'is_edit_sec'=>1,'is_ppend'=>1,'is_prej'=>1,'is_preg'=>1,'is_pappr'=>1,'is_groups' =>'1','is_add_group_member' => '1','is_delete_group_member' => '1','is_group_chat_board' => '1','is_theam' => '1','is_task_create' =>'1','is_reassign_task' =>'1','is_task' =>'1','is_sub_task' =>'1','is_complete_task' =>'1','is_approve_task' =>'1','is_task_discussion' =>'1','status' => '1','date' => '2020-12-03 03:07:16','is_add_pro' => '1','is_del_pro' =>'1','is_edit_pro' =>'1','is_view_pro' =>'1','is_taskboard_pro' => '1','is_dashboard_pro' => '1','is_add_unit' => '1','is_edit_unit' => '1','is_del_unit' => '1','is_view_unit' => '1','is_taskboard_unit' =>'1','is_dashboard_unit' =>'1','is_add_project' => '1','is_edit_project' => '1','is_view_project' => '1','is_del_project' => '1','is_taskboard_project' => '1','is_dashboard_project' => '1','is_add_mile' => '1','is_edit_mile' => '1','is_view_mile' => '1','is_del_mile' => '1','is_taskboard_mile' => '1','is_dashboard_mile' => '1','is_add_gtask' => '1','is_edit_gtask' => '1','is_comp_gtask' =>'1','is_del_gtask' => '1','is_approve_gtask' =>'1','is_view_gtask' => '1','mtask' =>'1','is_add_mtask' =>'1','is_del_mtask' =>'1','is_edit_mtask' =>'1','is_comp_mtask' =>'1','is_approve_mtask' =>'1','is_view_mtask' =>'1','is_del_pub_task' =>'1','is_edit_pub_task' =>'1','is_comp_pub_task' =>'1','is_approve_pub_task' =>'1','is_view_pub_task' =>'1','is_add_pub_task' =>'1','is_add_response_task' => '1','is_edit_response_task' =>'1','is_view_response_task' =>'1','is_del_response_task' =>'1','is_approve_response_task' =>'1','is_add_team' => '1','is_edit_team' => '1','is_view_team' => '1','is_del_team' => '1','is_add_member' => '1','is_edit_member' => '1','is_view_member' => '1','is_del_member' => '1','is_member_block' =>'1','is_member_unblock' =>'1','is_add_role' => '1','is_edit_role' => '1','is_view_role' => '1','is_del_role' => '1','is_add_lead_gen_task' =>'1','is_edit_lead_gen_task' =>'1','is_del_lead_gen_task' =>'1','is_view_lead_gen_task' =>'1','is_add_lead_quali_task' =>'1','is_edit_lead_quali_task' =>'1','is_del_lead_quali_task' =>'1','is_view_lead_quali_task' =>'1','is_add_country' => '1','is_edit_country' => '1','is_view_country' => '1','is_del_country' => '1','is_add_state' =>'1','is_edit_state' => '1','is_view_state' => '1','is_del_state' => '1','is_add_district' =>'1','is_edit_district' => '1','is_view_district' => '1','is_del_district' => '1','is_add_city' =>'1','is_edit_city' => '1','is_view_city' => '1','is_del_city' => '1','is_add_pincode' =>'1','is_edit_pincode' => '1','is_view_pincode' => '1','is_del_pincode' => '1','is_hview_reg' => '1','is_hview_approval' => '1','is_take_leave' =>'1','is_edit_leave' =>'1','is_view_leave' =>'1','is_delete_leave' =>'1','is_hire' =>'1','is_edit_hire' =>'1','is_delete_hire' =>'1','is_view_hire' =>'1','is_dr_appr' =>'1','is_dr_rej' =>'1','is_dr_pend' =>'1','is_dr_reg' =>'1','is_add_country_partner' => '1','is_del_country_partner' => '1','is_edit_country_partner' => '1','is_view_country_partner' => '1','is_add_state_partner' =>'1','is_del_state_partner' =>'1','is_edit_state_partner' =>'1','is_view_state_partner' => '1','is_add_district_partner' =>'1','is_del_district_partner' =>'1','is_edit_district_partner' =>'1','is_view_district_partner' => '1','is_add_assign' => '1','is_edit_assign' => '1','is_view_assign' => '1','is_del_assign' => '1','is_add_setcurrency' =>'1','is_view_setcurrency' =>'1','is_edit_setcurrency' =>'1','is_del_setcurrency' =>'1','is_add_currency' =>'1','is_view_currency' =>'1','is_edit_currency' =>'1','is_del_currency' =>'1','is_add_cityzone' =>'1','is_view_cityzone' =>'1','is_edit_cityzone' =>'1','is_del_cityzone' =>'1');}

?>

<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<nav class="navbar navbar-dark navbar-fixed-top navbar-right" style="height:5%;background-color:white;">
	<div class="stellarnav row" style="background-color:#fff">
					      <a style="" class="navbar-brand" href="<?php echo base_url();?>"><img style="height:35px;"  src="<?php echo base_url('assets/images/logo.png');?>"/></a>
		<ul style="">

			<li style="color:black;border-bottom-color:black;" ><a style="" style="color:black;border-bottom-color:black;"  href="">Programs </a>
		    	<ul style="" style="">
						<li style="color:black;border-bottom-color:black;"><a  style="color:black;border-bottom-color:black;" href="#">Programs</a>
		    			<ul style="">
		    			    
		    			 
		    					<?php if ($deliveryData['is_add_pro']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
                            <li><a style="" href="<?= base_url('Program/add_program') ?>">Create Program</a>  			
				    		</li><?php } ?>
				    		
				    		
                            <?php if ($deliveryData['is_edit_pro']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
						<li><a   style=""href="<?= base_url('Program/program_edit_list') ?>">Edit  Program</a></li><?php } ?>

	<?php if ($deliveryData['is_del_pro']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    		<li><a   style=""href="<?= base_url('Program/program_delete_list') ?>">Delete  Program</a></li>
				    	<?php } ?>

		<?php if ($deliveryData['is_view_pro']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    		<li><a style="" href="<?= base_url('Program/all') ?>">View Program</a></li>
                           <?php } ?>

                            
        <?php if ($deliveryData['is_taskboard_pro']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    		<li><a style="" href="<?= base_url('Program/taskboard') ?>">Program Taskboards</a></li><?php } ?>
				    		
				    		<?php if ($deliveryData['is_dashboard_pro']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    		<li><a style="" href="<?= base_url('program_dashboard') ?>">Program Dashboards</a></li><?php } ?>
				    	
				    <?php	if ($deliveryData['is_hview_reg']==1 or $deliveryData['is_hview_approval']==1 )
		    			    {
		    			    
		    			    ?>
				    		<li><a style="" href="">H360</a>
				    		
				    		<ul style="" style="">
				  <?php if ($deliveryData['is_hview_reg']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('dashboard/view_haspatal_dashboard') ?>">Registration</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_hview_approval']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('program_dashboard') ?>">Approval</a></li>
				    
				    <li><a style="" href="<?= base_url('haspatal_registers/business_register') ?>">Business Register</a></li>
				    
				    	<?php } ?>	</ul></li> <?php } ?>
				    	
				    
				    <?php if ($deliveryData['is_dr_reg']==1 or $deliveryData['is_dr_appr']==1 or $deliveryData['is_dr_pend']==1 or $deliveryData['is_dr_rej']==1 or $this->session->userdata('user_role')=='Captain') {
				        ?>
				    	    <?php	if ($deliveryData['is_dr_reg']==1 or $deliveryData['is_dr_appr']==1 or $deliveryData['is_dr_pend']==1 or $deliveryData['is_dr_rej']==1 )
		    			    {
		    			    
		    			    ?>
				    	<li><a style="" href="">Haspatal Doctors</a>
				    		
				    		<ul style="" style="">
				  <?php if ($deliveryData['is_dr_reg']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('doctor_registers/dashboard_registration') ?>">Registration</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_dr_appr']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('doctor_registers/dashboard') ?>">Approval</a></li>
				    
				    	<?php } ?>
				    	<?php if ($deliveryData['is_dr_pend']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    	<li><a style="" href="<?= base_url('doctor_registers/dashboard_pending') ?>">Pending</a></li>
				   <?php } ?>
				   
				   <?php if ($deliveryData['is_dr_rej']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('doctor_registers/dashboard_rejected') ?>">Rejected</a></li>
				    <?php } ?>
				    	
				    	</ul></li><?php } } ?>
				    		
		    			</ul>
		    		</li>
		    		
		    		<li class="devider"></li>
		    		
		    		<?php	if ($deliveryData['is_add_group_member']==1 or $deliveryData['is_group_chat_board']==1 or $deliveryData['is_groups']==1 or $deliveryData['is_delete_group_member']==1 or  $deliveryData['is_ppend']==1 or  $deliveryData['is_pappr']==1or  $deliveryData['is_prej']==1or  $deliveryData['is_preg']==1)
		    			    {
		    			    
		    			    ?>
		    		
		    		<li style=""><a style="" style="" href="#">Department</a>
		    			<ul style="" style="">

                        

		    		<?php if ($deliveryData['is_add_group_member']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    		<li><a  style="border-b" href="<?= base_url('groups/add_group')?>">Create Department</a></li><?php } ?>

				<?php if ($deliveryData['is_group_chat_board']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				<li><a  style="" href="<?= base_url('groups/dept_edit_list')?>">Edit Department</a></li>

			<?php } ?>
			
			          
				    		

								

			    				<?php if ($deliveryData['is_delete_group_member']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>

				    		<li><a  style="" href="<?= base_url('groups/delete_deptlist')?>">Delete Department</a></li>
				    	<?php } ?>

                                                                                    <?php if ($deliveryData['is_theam']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    		<li><a  style="" href="<?= base_url('groups/all')?>">View Department</a></li>
			    		<?php } ?>

				    		<?php if ($deliveryData['is_delete_group_member']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				 <li><a  style="" href="<?= base_url('groups/taskboard')?>">Department Taskboard</a></li>
				 <li><a  style="" href="<?= base_url('department_dashboard')?>">Department Dashboard</a></li>
				<?php } ?>
				 <?php if ($deliveryData['is_preg']==1 or $deliveryData['is_pappr']==1 or $deliveryData['is_ppend']==1 or $deliveryData['is_prej']==1 or $this->session->userdata('user_role')=='Captain') {
				        ?>
				    
				    	<li><a style="" href="">Haspatal Patients</a>
				    		
				    		<ul style="" style="">
				  <?php if ($deliveryData['is_preg']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('patient_registers/dashboard_registration') ?>">Registration</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_pappr']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('patient_registers/dashboard') ?>">Approval</a></li>
				    
				    	<?php } ?>
				    	<?php if ($deliveryData['is_ppend']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    	<li><a style="" href="<?= base_url('patient_registers/dashboard_pending') ?>">Pending</a></li>
				   <?php } ?>
				   
				   <?php if ($deliveryData['is_prej']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('patient_registers/dashboard_rejected') ?>">Rejected</a></li>
				    <?php } ?>
				    	
				    	</ul></li><?php } ?>
				    
		    			</ul>
		    		</li>
		    		<?php } ?>
		    		
		    		
		    		<?php if ($deliveryData['is_add_sec']==1 or $deliveryData['is_edit_sec']==1 or $deliveryData['is_view_sec']==1 or $deliveryData['is_del_sec']==1 or $this->session->userdata('user_role')=='Captain') {
				        ?>
		    			<li><a style="" style="" href="#">Section</a>
		    			<ul style="">
		    	

		    		<?php if ($deliveryData['is_add_sec']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>		
		    	
		    	<li><a style="" href="<?php echo base_url('section/add_section');?>">Create Section</a></li>
                        <?php } ?>

		    								   

                            	<?php if ($deliveryData['is_edit_sec']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
		    					<li><a style="" href="<?php echo base_url('section/view_section_edit');?>">Edit Section</a></li>

	                    	   <?php } ?>
	                    	   
		    								<?php if ($deliveryData['is_del_sec']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		<li><a style="" href="<?php echo base_url('section/section_delete_list');?>">Delete Section</a></li><?php }  ?>

	                    	   
                            	<?php if ($deliveryData['is_view_sec']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
		    					<li><a style="" href="<?php echo base_url('section/section_list');?>">View Section</a></li>

	                    	   <?php } ?>

		    					<?php if ($deliveryData['is_add_sec']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				 <li><a  style="" href="<?= base_url('section_taskboard')?>">Section Taskboard</a></li>
				 <li><a  style="" href="<?= base_url('section_dashboard')?>">Section Dashboard</a></li>
				<?php } ?>			

		    			</ul>
		    		</li>
		    		<?php } ?>
		    		
		    		<?php if ($deliveryData['is_add_unit']==1 or $deliveryData['is_edit_unit']==1 or $deliveryData['is_view_unit']==1 or $deliveryData['is_del_unit']==1 or $deliveryData['is_dashboard_unit']==1  or $deliveryData['is_taskboard_unit']==1 or $this->session->userdata('user_role')=='Captain') {
				        ?>
		    		<li><a style="" style="" href="#">Unit</a>
		    			<ul style="">
		    	

		    		<?php if ($deliveryData['is_add_unit']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>		
		    	<li><a style="" href="<?php echo base_url('unit/add_unit');?>">Create Unit</a></li>
		    
                        <?php } ?>

		    								   

                            	<?php if ($deliveryData['is_edit_unit']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
		    					<li><a style="" href="<?php echo base_url('unit/view_unit_edit');?>">Edit Unit</a></li>

	                    	   <?php } ?>

		    								<?php if (['is_view_unit']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		<li><a style="" href="<?php echo base_url('unit/unitlist');?>">View  Unit</a></li><?php } ?>

		    								<?php if ($deliveryData['is_del_unit']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		<li><a style="" href="<?php echo base_url('unit/unit_delete_list');?>">Delete Unit</a></li><?php }  ?>

				    		<?php if ($deliveryData['is_taskboard_unit']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		<li><a style="" href="<?php echo base_url('unit/taskboard');?>">Unit Taskboard</a></li><?php } ?>

				    			<?php if ($deliveryData['is_dashboard_unit']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		<li><a style="" href="<?php echo base_url('unit/dashboard');?>">Unit Dashboard</a></li><?php } ?>
		    			</ul>
		    		</li>
		    		<?php  }  ?>
		    		
		    		
		    	
		    	
		    	</ul>
		    </li>
		    <!-- Section Menu-->
		         	    <?php if ($deliveryData['is_view_mile']==1 or $deliveryData['is_view_project']==1 or $this->session->userdata('user_role')=='Captain') {?>
	     
		    <!--project menu-->
		    <li style="color:black;border-bottom-color:black;" ><a style="" style="color:black;border-bottom-color:black;"  href="">Projects</a>
		    	<ul style="" style="">
		    	    
		    	    
		    	    <?php if ($deliveryData['is_view_project']==1 or $deliveryData['is_add_project']==1 or $deliveryData['is_edit_project']==1 or $deliveryData['is_del_project']==1  or $deliveryData['is_taskboard_project']==1 or $deliveryData['is_dashboard_project']==1 or $this->session->userdata('user_role')=='Captain') {?>
	     
						<li style="color:black;border-bottom-color:black;"><a  style="color:black;border-bottom-color:black;">Projects</a>
		    			<ul style="">
		    			    
		    			    	<?php if ($deliveryData['is_add_project']==1 or $this->session->userdata('user_role')=='Captain') {?>	
		    			    
                            <li><a style="" href="<?php echo base_url('projects/add_projects/');?>">Create Projects</a> </li><?php } ?>


                             <?php if ($deliveryData['is_edit_project']==1 or $this->session->userdata('user_role')=='Captain') {?>	
				    		<li><a   style=""href="<?php echo base_url('projects/all');?>">Edit Projects</a></li><?php  } ?>
				    		
				    	<?php if ($deliveryData['is_view_project']==1 or $this->session->userdata('user_role')=='Captain') {?>	
				    		<li><a style="" href="<?= base_url('projects/all_view') ?>">View Projects</a></li><?php } ?>
				    		

		    			    	<?php if ($deliveryData['is_del_project']==1 or $this->session->userdata('user_role')=='Captain') {?>	
				    		<li><a   style=""href="<?php echo base_url('projects/delete_project_list/');?>">Delete Projects</a></li><?php } ?>

				    <?php if ($deliveryData['is_taskboard_project']==1 or $this->session->userdata('user_role')=='Captain') {?>	
				    		<li><a style="" href="<?= base_url('projects/taskboard') ?>">Projects Taskboards</a></li>
				    	<?php  } ?>


				    					    			    	<?php if ($deliveryData['is_dashboard_project']==1 or $this->session->userdata('user_role')=='Captain') {?>	
				    			<li><a style="" href="<?= base_url('projects/taskboard') ?>">Projects Dashboards</a></li>  <?php } ?>

				    						    			    	<?php if ($deliveryData['is_taskboard_project']==1 or $this->session->userdata('user_role')=='Captain') {?>	
				    				<li><a style="" href="<?= base_url('projects/taskboard') ?>">Projects Discussions Board</a></li><?php } ?>
				    		
		    			</ul>
		    		</li><?php } ?>
		    		
		    		
		    		<li class="devider"></li>
		    		      	    <?php if ($deliveryData['is_view_mile']==1 or $deliveryData['is_add_mile']==1 or $deliveryData['is_edit_mile']==1 or $deliveryData['is_del_mile']==1  or $deliveryData['is_taskboard_mile']==1 or $deliveryData['is_dashboard_mile']==1 or $this->session->userdata('user_role')=='Captain') {?>
	     
		    <li style=""><a style="" style="" href="#">Milestones</a>
		 
		    			<ul style="" style="">
		    	<?php if ($deliveryData['is_add_mile']==1 or $this->session->userdata('user_role')=='Captain') {?>	
				    		<li><a  style="" href="<?php echo base_url('milestone/add_milestone/');?>">Create Milestone</a></li><?php } ?>
            

<?php if ($deliveryData['is_edit_mile']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a  style="" href="<?php echo base_url('milestone/editmilestone/');?>">Edit Milestone</a></li><?php } ?>

		<?php if ($deliveryData['is_view_mile']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a  style="" href="<?php echo base_url('milestone/all');?>">View Milestone</a></li>
		<?php } ?>

		<?php if ($deliveryData['is_del_mile']==1 or $this->session->userdata('user_role')=='Captain') {?>
<li><a  style="" href="<?php echo base_url('milestone/delete_milestone_list/');?>">Delete Milestone</a></li><?php } ?>
			
			<?php if ($deliveryData['is_taskboard_mile']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		<li><a  style="" href="<?php echo base_url('milestone/taskboard');?>">Milestone Taskboard</a></li><?php } ?>

				    		<?php if ($deliveryData['is_dashboard_mile']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		<li><a  style="" href="<?php echo base_url('milestone/taskboard');?>">Milestone Dashboard</a></li><?php } ?>
		    			</ul>
		    		</li>
		    	
		    	<?php } ?>

		    	</ul>
		    </li>
<?php } ?>

		   	<li style="color:black;border-bottom-color:black;" ><a style="" style="color:black;border-bottom-color:black;"  href="">Tasks</a>
		    	<ul style="" style="">
						<li style="color:black;border-bottom-color:black;"><a  style="color:black;border-bottom-color:black;" href="#">Task</a>
		    			<ul style="">
		    			    
				    	        <li><a>General Tasks</a>
				    	            <ul>

				    	            	<?php if ($deliveryData['is_add_gtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    	                	<li><a style="" href="<?= base_url('task/add_task') ?>">Create General Task</a></li><?php } ?>
				    						    		

				    						    		<?php if ($deliveryData['is_edit_gtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    						    		<li><a   style=""href="<?= base_url('task/task_editor_list') ?>">Edit General Task</a></li><?php } ?>
				    	<?php if ($deliveryData['is_view_gtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
<li><a style="" href="<?= base_url('task/all') ?>">View General Task</a></li><?php } ?>
				    						    		
		<?php if ($deliveryData['is_del_gtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a style=""href="<?= base_url('task/abort') ?>">Delete General Task</a></li><?php } ?>


<?php if ($deliveryData['is_comp_gtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
<li><a style="" href="<?= base_url('task/complete_view') ?>">Complete General Task</a></li>
<?php } ?>
			<?php if ($deliveryData['is_approve_gtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?= base_url('task/complete_view') ?>">Approve General Task</a></li><?php } ?>
			<?php if ($deliveryData['is_del_gtask']==1 or $this->session->userdata('user_role')=='Captain') { ?>
			<li><a   style=""href="<?= base_url('task/complete_view') ?>">Abort General Task</a></li><?php } ?>
				    	            </ul>
				    	            
				    	        </li>
				    	        
				    	        
				    	        <li><a>Tasks History</a>
				    	            <ul>

				    	            	<?php if ($deliveryData['is_view_gtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    	                	<li><a style="" href="<?= base_url('/created_task') ?>">Created Tasks</a></li><?php } ?>
				    						    		

				    						    		<?php if ($deliveryData['is_edit_gtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    						    		<li><a   style=""href="<?= base_url('/assigned_task') ?>">Assigned Tasks</a></li><?php } ?>
				    						    		
	
				    	            </ul>
				    	            
				    	        </li>
				    	        
				    	        
			<?php if ($deliveryData['is_view_mtask']==1 or $deliveryData['is_view_pub_task']==1 or $deliveryData['is_view_lead_gen_task']==1 or $deliveryData['is_view_lead_quali_task']==1 or $deliveryData['is_view_lead_quali_task']==1 or $deliveryData['is_view_response_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
	    		
                        <li class="drop-left"><a>Marketing Tasks</a>
				    	            <ul>
				    	                <li class="drop-left"><a   style="">Content Production</a>
				    		<ul class="drop-left">
				    					<?php if ($deliveryData['is_add_mtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		    <li><a   style=""href="<?= base_url('task/content_production_order') ?>">Create Production</a></li><?php } ?>

				   	<?php if ($deliveryData['is_view_mtask']==1 or $this->session->userdata('user_role')=='Captain') {?>				    		    
				    		     <li><a   style=""href="<?= base_url('task/content_production_order_view_list') ?>">View Production</a></li><?php } ?>

				     <?php if ($deliveryData['is_edit_mtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
					  <li><a   style=""href="<?= base_url('task/content_production_order_edit_list') ?>">Edit Production</a></li><?php } ?>

					  		<?php if ($deliveryData['is_comp_mtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		      <li><a   style=""href="<?= base_url('task/content_production_order_delete_list') ?>">Complete Production</a></li><?php  } ?>

				    		      <?php if ($deliveryData['is_approve_mtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		      <li><a   style=""href="<?= base_url('task/content_production_order_delete_list') ?>">Approve Production</a></li><?php } ?>

				    		     <?php if ($deliveryData['is_del_mtask']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		       <li><a   style=""href="<?= base_url('task/content_production_order_delete_list') ?>">Abort Production</a></li><?php } ?>
				    		</ul>
				    		</li>
				    		    <li><a   style="">Content Publish</a>
				    		<ul>
				    <?php if ($deliveryData['is_add_pub_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		    <li><a   style=""href="<?= base_url('task/content_publish') ?>">Create Publish Tasks</a></li><?php } ?>

				    <?php if ($deliveryData['is_edit_pub_task']==1 or $this->session->userdata('user_role')=='Captain') { ?>
				    		    <li><a   style=""href="<?= base_url('task/published_list/edit') ?>">Edit Publish Tasks</a></li><?php } ?>

				    <?php if ($deliveryData['is_view_pub_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		     <li><a   style=""href="<?= base_url('task/published_list/view') ?>">View Publish Tasks</a></li><?php } ?>

				    <?php if ($deliveryData['is_comp_pub_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		      <li><a   style=""href="<?= base_url('task/published_list/view') ?>">Complete Publish Tasks</a></li><?php } ?>

				    		  <?php if ($deliveryData['is_approve_pub_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		      <li><a   style=""href="<?= base_url('task/published_list/view') ?>">Approve Publish Tasks</a></li><?php } ?>

				    		  <?php if ($deliveryData['is_del_pub_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		       <li><a   style=""href="<?= base_url('task/published_list/delete') ?>">Abort Publish Tasks</a></li><?php }?>
				    		</ul>
				    		</li>
				    		      

				<li><a  style="" href="">Lead Generation</a>
				          	<ul>
				    <?php if ($deliveryData['is_add_lead_gen_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		    <li><a   style=""href="<?= base_url('task/create_lead_generation') ?>">Create Lead Generation</a></li><?php } ?>

				    <?php if ($deliveryData['is_edit_lead_gen_task']==1 or $this->session->userdata('user_role')=='Captain') { ?>
				    		    <li><a   style=""href="<?= base_url('task/edit_lead_generation_list') ?>">Edit Lead Generation</a></li><?php } ?>

				    <?php if ($deliveryData['is_view_lead_gen_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		     <li><a   style=""href="<?= base_url('task/view_lead_generation_list') ?>">View Lead Generation </a></li><?php } ?>
				    		     <?php if ($deliveryData['is_del_lead_gen_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		     <li><a   style=""href="<?= base_url('task/delete_lead_generation_list') ?>">Delete Lead Generation </a></li><?php } ?>

				    		</ul>  
				</li>

			
			
			                    
			                    
			                   
		    					
				<li><a  style="" href="">Lead Qualification</a>
				          	<ul>
				    <?php if ($deliveryData['is_add_lead_quali_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		    <li><a   style=""href="<?= base_url('task/create_lead_qualification') ?>">Create Lead Qualification</a></li><?php } ?>
          <?php if ($deliveryData['is_edit_lead_quali_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		    <li><a   style=""href="<?= base_url('task/edit_lead_qualified_list') ?>">Edit Lead Qualification</a></li><?php } ?>
				    		    
				    		    
				    		      <?php if ($deliveryData['is_view_lead_quali_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		    <li><a   style=""href="<?= base_url('task/view_lead_qualified_list') ?>">View Lead Qualification</a></li><?php } ?>
				    		    
				    		      <?php if ($deliveryData['is_del_lead_quali_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		    <li><a   style=""href="<?= base_url('task/delete_lead_qualified_list') ?>">Delete Lead Qualification</a></li><?php } ?>
				   

				    		</ul>  
				</li>


			
			
			
				    		<li><a   style="">Response Recorder</a>
				    		<ul>
				    			<?php if ($deliveryData['is_add_response_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		    <li><a   style=""href="<?= base_url('task/add_response_recorder') ?>">Create Response Recorder</a></li><?php } ?>
				    		    <?php if ($deliveryData['is_view_response_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		     <li><a   style=""href="<?= base_url('task/response_recorder_list/view') ?>">View Response Recorder</a></li><?php } ?>


				    		     	<?php if ($deliveryData['is_edit_response_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		      <li><a   style=""href="<?= base_url('task/response_recorder_list/edit') ?>">Edit Response Recorder</a></li><?php } ?>
				    		      	<?php if ($deliveryData['is_del_response_task']==1 or $this->session->userdata('user_role')=='Captain') {?>
				    		       <li><a   style=""href="<?= base_url('task/response_recorder_list/delete') ?>">Delete Response Recorder</a></li><?php } ?>
				    		</ul>
				    		</li>
				    		</ul>
				    		</li>
                    <?php }?>
		    			</ul>
		    			
		    		</li>
		    		
		    		<li class="devider"></li>
<?php if ( $this->session->userdata('user_role')=='Captain') {?>

		    		<li style=""><a style="" style="" href="#">Sub-Tasks</a>
		    			<ul style="" style="">
				    		<li><a style="" href="<?= base_url('task/sub_task') ?>">Create Sub-Task</a>   			
				    		</li>
				    		<li><a style="" href="<?= base_url('task/sub_view') ?>">View Sub-Task</a></li>

				    		<li><a   style=""href="<?= base_url('task/a') ?>">Edit Sub-Task</a></li>
				    		<li><a   style=""href="<?= base_url('task/a') ?>">Abort Sub-Task</a></li>
				    		<li><a   style=""href="<?= base_url('task/a') ?>">Approve Sub-Task</a></li>
				    		<li><a   href="<?= base_url('task/a') ?>">Transfer SubTask</a></li>
		    			</ul>
		    		</li><?php } ?>
		    		
		    

		    	</ul>
		    </li>

		   <li><a style="" href="">Team</a>
		    	<ul>
		    	    
		    	       <?php 
		    			    
		    			    if ($deliveryData['is_add_country_partner']==1 or $deliveryData['is_edit_country_partner']==1 or $deliveryData['is_view_country_partner']==1 or $deliveryData['is_del_country_partner']==1)
		    			    {
		    			    
		    			    ?>
		    			    
                                            	<!--partner-->
				    	<li><a style="" href="">Country Partner</a>
				    		
				    		<ul style="" style="">
				  <?php if ($deliveryData['is_add_country_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('Partner/partner_registration') ?>">Add Country Partner</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_edit_country_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('Partner/edit_list') ?>">Edit Country Partner</a></li>
				    
				    
				    	<?php } ?>
				    	
				    	<?php if ($deliveryData['is_view_country_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('Partner/index/view') ?>">View Country Partner</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_del_country_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('Partner/delete_list') ?>">Delete Country Partner</a></li>
				    
				    
				    	<?php } ?>
				    	</ul></li>
				    	<?php } ?><!--close country partner -->
				    	
				    	
				    <?php	if ($deliveryData['is_add_state_partner']==1 or $deliveryData['is_edit_state_partner']==1 or $deliveryData['is_view_state_partner']==1 or $deliveryData['is_del_state_partner']==1)
		    			    {
		    			    
		    			    ?>
				    	           	<!--partner-->
				    	<li><a style="" href="">State Partner</a>
				    		
				    		<ul style="" style="">
				  <?php if ($deliveryData['is_add_state_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('StatePartner/create') ?>">Add State Partner</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_edit_state_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('StatePartner/edit_list') ?>">Edit State Partner</a></li>
				    
				    
				    	<?php } ?>
				    	
				    	<?php if ($deliveryData['is_view_state_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('StatePartner/') ?>">View State Partner</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_del_state_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('StatePartner/delete_list') ?>">Delete State Partner</a></li>
				    
				    
				    	<?php } ?>
				    	
				    	
				    	</ul></li>
				    	
				    	<?php  } ?>
				    	
				    	
				    	
				    <?php
				    if ($deliveryData['is_add_district_partner']==1 or $deliveryData['is_edit_district_partner']==1 or $deliveryData['is_view_district_partner']==1 or $deliveryData['is_del_district_partner']==1)
		    			    {
		    			    
		    			    ?>
				    	           	<!-- Districtpartner-->
				    	<li><a style="" href="">District Partner</a>
				    		
				    		<ul style="" style="">
				  <?php if ($deliveryData['is_add_district_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('DistrictPartner/create') ?>">Add District Partner</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_edit_district_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('DistrictPartner/edit_list') ?>">Edit District Partner</a></li>
				    
				    
				    	<?php } ?>
				    	
				    	<?php if ($deliveryData['is_view_district_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('DistrictPartner/') ?>">View District Partner</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_del_district_partner']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('DistrictPartner/delete_list') ?>">Delete District Partner</a></li>
				    
				    
				    	<?php } ?>
				    	</ul></li>
				    	<?php  } ?>
		  <!-- <li><a style="">Team  </a>
		   	<ul>
		   		<?php if ($deliveryData['is_view_team']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a style="" >View Team</a></li><?php } ?>

	<?php if ($deliveryData['is_view_team']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a style="">Edit Team</a></li><?php } ?>
	
	
	<?php if((int)$this->session->userdata('user_role')=='Captain' or (int)$this->session->userdata('user_role')==37) {
		    					?>
                            <li><a style="" href="<?= base_url('visited_leads/create') ?>">Create Visited Lead</a>  			
				    		</li>
				    		<li><a style="" href="<?= base_url('visited_leads/index/edit') ?>">Edit Visited Lead</a>
				    		<li><a style="" href="<?= base_url('visited_leads/index/view') ?>">View Visited Lead</a>
				    		<li><a style="" href="<?= base_url('visited_leads/index/delete') ?>">Delete Visited Lead</a>
				    		
				    		</li><?php } ?>
	</ul></li>-->


	 <li><a style="">Members  </a>
	
		   	<ul>
		   		<?php if ($deliveryData['is_add_member']==1 or $this->session->userdata('user_role')=='Captain') {?>
		   		<li><a style="" href="<?php echo base_url('users/add_users');?>">Add Members</a></li><?php } ?>

		   		<?php if ($deliveryData['is_view_member']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a style="" href="<?php echo base_url('users/all');?>">View Members</a></li><?php } ?>

	<?php if ($deliveryData['is_edit_member']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a style="" href="<?php echo base_url('users/edit_list');?>">Edit Members</a></li><?php } ?>

		<?php if ($deliveryData['is_del_member']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a style="" href="<?php echo base_url('users/delete_list');?>">Delete Members</a></li><?php } ?>

<?php if ($deliveryData['is_member_block']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a style="" href="<?php echo base_url('users/block_list');?>">Block Members</a></li>
<?php } ?>

<?php if ($deliveryData['is_member_unblock']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a style="" href="<?php echo base_url('users/unblock_list');?>">Unblcok Members</a></li>
	<?php } ?>
	
	
	</ul></li>
<?php if ($deliveryData['is_view_setcurrency']==1 or $deliveryData['is_view_currency']==1 or $deliveryData['is_view_role']==1 or $deliveryData['is_view_assign']==1 or $this->session->userdata('user_role')=='Captain') {?>
	     

	 <li class="drop-left">
	 	<a style="">Role Management  </a>
	<ul>
	   
				    	
			<li><a>Roles Masters</a>
			<ul>
			    <li><a href="<?php echo base_url('RoleMasters/create');?>">Create</a></li>
			     <li><a href="<?php echo base_url('RoleMasters/editlist');?>">Edit</a></li>
			      <li><a href="<?php echo base_url('RoleMasters/');?>">View</a></li>
			       <li><a href="<?php echo base_url('RoleMasters/deletelist');?>"> Delete</a></li>
			       	    
			       
			</ul>
			</li>
			<li><a>Role</a> 
			    <ul>
			        	<?php if ($deliveryData['is_add_role']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a style="" href="<?php echo base_url('user_role/add_role');?>">Create Roles</a></li>
<?php  }  ?>

	<?php if ($deliveryData['is_edit_role']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a style="" href="<?php echo base_url('user_role/editlist');?>">Edit Roles</a></li>
<?php }  ?>


			<?php if ($deliveryData['is_view_role']==1 or $this->session->userdata('user_role')=='Captain') { ?>
		<li><a style="" href="<?php echo base_url('user_role/all');?>">View Roles</a></li>
	<?php }  ?>
 
		<?php if ($deliveryData['is_del_role']==1 or $this->session->userdata('user_role')=='Captain') {?>
	<li><a style="" href="<?php echo base_url('user_role/deletelist');?>">Delete Roles</a></li>
	<?php }  ?>
		<?php if ($deliveryData['is_add_assign']==1 or $deliveryData['is_edit_assign']==1 or $deliveryData['is_view_assign']==1 or $deliveryData['is_del_assign']==1 or $this->session->userdata('user_role')=='Captain') {?>

				    	<li class="drop-left"><a style="" href="">Assign Role </a>
				    		
				    		<ul style="" style="">
				  <?php if ($deliveryData['is_add_assign']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('AssignRoles/create') ?>">Create Assign</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_edit_assign']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('AssignRoles/editlist') ?>">Assign Edit List</a></li>
				    
				    
				    	<?php } ?>
				    	
				    	<?php if ($deliveryData['is_view_assign']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('AssignRoles/index') ?>">Assign View List </a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_del_assign']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('AssignRoles/deletelist') ?>">Assign Delete List</a></li>
				    
				    
				    	<?php } ?>
				    	</ul></li>
				    		<?php if ($this->session->userdata('user_role')=='Captain') {?>
				    <li><a style="" href="<?php echo base_url('user_role/set_privillages');?>">Set Permissions</a></li>	
				    <?php }  ?>
				    	<?php  }?>
			    </ul>
			</li>
	

	<!--partner-->

			
				    			
				    			  
	</ul></li>
	<?php } ?>

			


		    	</ul>
		    </li>
		    <li>
          <a style=""  href="#"><button type="button" style="background-color:#fff;border-color:#fff;text-decoration:none;" class="real-time-notification" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-bell"></i><sup><span class="badge badge-success" id="noti">0</span></sup></button></a>
          <ul style="">
              		
		    		
		    		
		    			


				</ul>
        </li>
          <li>
          <a style=""  href="#"><img style="height:35px;width:35px;border-radius:10px;" src="<?=base_url('assets/upload/users').'/'.$this->session->userdata('profile_image')?>"></a>
          <ul style="">
          					    
          				           <li><a style="" href="<?php echo base_url('myaccount/');?>"> Edit Profile</a></li>
           <li><a style="" href="<?php echo base_url('users/dashboard');?>">My Dashboard</a></li>
					<li><a style="" href="<?php echo base_url('myaccount/change_password/');?>"> Change Password</a></li>
					<li class="divider"></li>
					<li><a style="" href="<?php echo base_url('users/taskboard');?>">My Taskboard</a></li>
					<li><a style="" href="<?php echo base_url('authentication/logout');?>">Logout</a></li>
					
          					</ul>
        </li>
		<li><a href=""><i class=""></i></a>
		</li>
		<?php if ($deliveryData['is_view_country']==1 or $deliveryData['is_view_cityzone']==1 or $deliveryData['is_view_pincode']==1 or $deliveryData['is_view_city']==1 or $deliveryData['is_view_district']==1 or $deliveryData['is_view_state']==1  or   $this->session->userdata('user_role')=='Captain') {?>

 <li  id="x" class="drop-left" >
          <a style="" href="#" >Configure</a>
          <span id="notify"></span><ul style="" >

                                            
                                                	
				    	 <?php if ($deliveryData['is_add_currency']==1 or $deliveryData['is_view_currency']==1 or $deliveryData['is_edit_currency']==1 or $deliveryData['is_del_currency']==1 or $this->session->userdata('user_role')=='Captain') {?>
	     
				    			    	<li class="drop-left"><a style="" href="">Currency </a>
				    		
				    		<ul style="" style="">
				  <?php if ($deliveryData['is_add_currency']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('Currency/create') ?>">Add Currency</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_edit_currency']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('Currency/editlist') ?>">Currency Edit List</a></li>
				    
				    
				    	<?php } ?>
				    	
				    	<?php if ($deliveryData['is_view_currency']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('Currency/index') ?>">Currency View List </a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_del_currency']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('Currency/deletelist') ?>">Currency Delete List</a></li>
				    
				    
				    	<?php } ?>
				    	</ul></li><?php } ?>

                                                 <?php if ($deliveryData['is_add_setcurrency']==1 or $deliveryData['is_view_setcurrency']==1 or $deliveryData['is_edit_setcurrency']==1 or $deliveryData['is_del_setcurrency']==1 or $this->session->userdata('user_role')=='Captain') {?>
	      	<li class="drop-left"><a style="" href="">Set Currency </a>
				    		
				    		<ul style="" style="">
				  <?php if ($deliveryData['is_add_setcurrency']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('SetCurrency/create') ?>">Set Currency</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_edit_setcurrency']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('SetCurrency/editlist') ?>">Currency Value Edit</a></li>
				    
				    
				    	<?php } ?>
				    	
				    	<?php if ($deliveryData['is_view_setcurrency']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('SetCurrency/index') ?>">Currency Value View</a></li>
				   <?php } ?>
				        <?php if ($deliveryData['is_del_setcurrency']==1 or $this->session->userdata('user_role')=='Captain') {
		    					?>
				    <li><a style="" href="<?= base_url('SetCurrency/deletelist') ?>">Currency Value Delete</a></li>
				    
				    
				    	<?php } ?>
				    	</ul></li><?php  } ?>
          							<?php if ($deliveryData['is_view_leave']==1 or $this->session->userdata('user_role')=='Captain') {?>

          				<li style=""><a href="#">Content</a>
          					<ul style="">
          						 <li><a style="" href="#">Content Category</a>
		    			<ul style="">
				    		<li><a style="" href="<?php echo base_url('task/create_content_category');?>">Add Category</a></li>
				    		<li><a style="" href="<?php echo base_url('task/category_list/edit');?>">Edit Category</a></li>
				    		<li><a style="" href="<?php echo base_url('task/category_list/view');?>">View Category</a></li>
				    		<li><a style="" href="<?php echo base_url('task/category_list/delete');?>">Delete Category</a></li>
				    		
		    			</ul>
		    		</li>
		    		
		    				 <li><a style="" href="#">Dashboards</a>
		    			<ul style="">
				    			    					<li><a style="" href="<?= base_url('haspatal_registers/HomecareDashboard') ?>">HomeCare Dashboard</a></li>
		    					<li><a style="" href="<?= base_url('haspatal_registers/LabDashboard') ?>">Lab Dashboard</a></li>
		    					<li><a style="" href="<?= base_url('haspatal_registers/ImagingsCentre') ?>">Imagings Centre Dashboard</a></li>
		    					<li><a style="" href="<?= base_url('haspatal_registers/CounsellingDashboard') ?>">Counselling Dashboard</a></li>
		    					<li><a style="" href="<?= base_url('haspatal_registers/serviceDashboard') ?>">Pharmacy Dashboard</a></li>
		    					<li><a style="" href="<?= base_url('haspatal_registers/TherapyDashboard') ?>">Therapy Dashboard</a></li>		
		    			</ul>
		    		</li>
		   
          						<li><a style="" href="#">Content Type</a>
		    			<ul style="">
				    		<li><a style="" href="<?php echo base_url('users/create_content');?>">Add Content Type</a></li>
				    		<li><a style="" href="<?php echo base_url('users/content_list/edit');?>">Edit Content Type</a></li>
				    		<li><a style="" href="<?php echo base_url('users/content_list/view');?>">View Content Type</a></li>
				    		<li><a style="" href="<?php echo base_url('users/content_list/delete');?>">Delete Content Type</a></li>
				    		
		    			</ul>
		    		</li>
		    						<li><a style="" href="#">Target Audience</a>
		    			<ul style="">
				    		<li><a style="" href="<?php echo base_url('users/create_target_audience');?>">Add Target Audience</a></li>
				    		<li><a style="" href="<?php echo base_url('users/audience_list/edit');?>">Edit Target Audience</a></li>
				    		<li><a style="" href="<?php echo base_url('users/audience_list/view');?>">View Target Audience</a></li>
				    		<li><a style="" href="<?php echo base_url('users/audience_list/delete');?>">Delete Target Audience</a></li>
				    		
		    			</ul>
		    		</li>

          					</ul>
          				</li>
          						<!--   channel menu --->

          						<li style=""><a href="#">Channel</a>
          					<ul style="">
          				<li><a style="" href="#">Channel</a>
		    			<ul style="">
				    		<li><a style="" href="<?php echo base_url('users/create_channel');?>">Add Channel</a></li>
				    		<li><a style="" href="<?php echo base_url('users/channel_list/edit');?>">Edit Channel</a></li>
				    		<li><a style="" href="<?php echo base_url('users/channel_list/view');?>">View Channel</a></li>
				    		<li><a style="" href="<?php echo base_url('users/channel_list/delete');?>">Delete Channel</a></li>
				    		
		    			</ul>
		    		</li>
		    		<li><a style="" href="#">Avenue</a>
		    			<ul style="">
				    		<li><a style="" href="<?php echo base_url('users/create_avenue');?>">Add Avenue</a></li>
				    		<li><a style="" href="<?php echo base_url('users/avenue_list/edit');?>">Edit Avenue</a></li>
				    		<li><a style="" href="<?php echo base_url('users/avenue_list/view');?>">View Avenue</a></li>
				    		<li><a style="" href="<?php echo base_url('users/avenue_list/delete');?>">Delete Avenue</a></li>
				    		
		    			</ul>
		    		</li>
		    		<li><a style="" href="#">Avenue Group</a>
		    			<ul style="">
				    		<li><a style="" href="<?php echo base_url('users/create_avenue_group');?>">Add Avenue Group</a></li>
				    		<li><a style="" href="<?php echo base_url('users/avenue_group_list/edit');?>">Edit Avenue Group</a></li>
				    		<li><a style="" href="<?php echo base_url('users/avenue_group_list/view');?>">View Avenue Group</a></li>
				    		<li><a style="" href="<?php echo base_url('users/avenue_group_list/delete');?>">Delete Avenue Group</a></li>
				    		
		    			</ul>
		    		</li>
          					</ul>
          				</li>


          							<li style=""><a href="#">Response</a>
          					<ul style="">
          				<li><a style="" href="#">Response Type</a>
		    			<ul style="">
				    		<li><a style="" href="<?php echo base_url('users/create_response_type');?>">Add Response Type</a></li>
				    		<li><a style="" href="<?php echo base_url('users/response_type_list/edit');?>">Edit Response Type</a></li>
				    		<li><a style="" href="<?php echo base_url('users/response_type_list/view');?>">View Response Type</a></li>
				    		<li><a style="" href="<?php echo base_url('users/response_type_list/delete');?>">Delete Response Type</a></li>
				    		
		    			</ul>
		    		</li>
		    			<li><a style="" href="#">Replies</a>
		    			<ul style="">
				    		<li><a style="" href="<?php echo base_url('users/add_replies');?>">Add Reply</a></li>
				    		<li><a style="" href="<?php echo base_url('users/replies_list/edit');?>">Edit Replied</a></li>
				    		<li><a style="" href="<?php echo base_url('users/replies_list/view');?>">View Replied </a></li>
				    		<li><a style="" href="<?php echo base_url('users/replies_list/delete');?>">Delete Replied </a></li>
				    		
		    			</ul>
		    		</li>
          					</ul>
          				</li> <?php } ?>
          									 <li><a><i class='fa fa-map-marker'></i>  Locations</a>
          					<ul style="">

            
    <li><a style="" >Country</a>
		<ul style="">
		                <?php if ($deliveryData['is_add_country']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/add_country');?>">Add Country</a></li>
         <?php } ?>
         
                     <?php if ($deliveryData['is_edit_country']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/view_countries/edit');?>">Edit Country</a></li>
         <?php } ?>
         
                     <?php if ($deliveryData['is_view_country']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/view_countries/view');?>">View Country</a></li>
		<?php } ?>
		
		            <?php if ($deliveryData['is_del_country']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/view_countries/delete');?>">Delete Country</a></li>
		<?php } ?>
         </ul>
          </li>
          
                
                
               
					<li><a style="">State</a>

							<ul style="">
	 <?php if ($deliveryData['is_add_state']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/add_state');?>">Add State</a></li>
         
         <?php } ?>
         
          <?php if ($deliveryData['is_edit_state']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/state_list/edit');?>">Edit State</a></li>
         
         <?php } ?>
         
          <?php if ($deliveryData['is_view_state']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/state_list/view');?>">View State</a></li>
		<?php }  ?>
		
		 <?php if ($deliveryData['is_del_state']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/state_list/delete');?>">Delete State</a></li>
		<?php } ?>
         </ul>
					</li>
					
<li><a style="">District</a>
		<ul style="">
		     <?php if ($deliveryData['is_add_district']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/add_district');?>">Add District</a></li>
         <?php } ?>
         
          <?php if ($deliveryData['is_edit_district']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/district_list/edit');?>">Edit District</a></li>
            <?php } ?>
           <?php if ($deliveryData['is_view_district']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/district_list/view');?>">View District</a></li>
		<?php } ?>
		
		  <?php if ($deliveryData['is_del_district']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/district_list/delete');?>">Delete District</a></li>
		<?php } ?>
		
	</ul>
</li><li><a style="">City</a>
	<ul style="">
	    
	      <?php if ($deliveryData['is_add_city']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/add_city');?>">Add City</a></li>
         <?php } ?>
         
         
          <?php if ($deliveryData['is_edit_city']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/city_list/edit');?>">Edit City</a></li>
         <?php } ?>
         
         
           <?php if ($deliveryData['is_view_city']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/city_list/view');?>">View City</a></li>
		
		<?php } ?>
		    
		    
		     <?php if ($deliveryData['is_del_city']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/city_list/delete');?>">Delete City</a></li>
		<?php } ?>
	</ul>
</li>



					<li><a style="">Pincode</a>

							<ul style="">
							    
							     <?php if ($deliveryData['is_add_pincode']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/add_pincode');?>">Add Pincode</a></li><?php  } ?>
         
          <?php if ($deliveryData['is_edit_pincode']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/pincode_list/edit');?>">Edit Pincode</a></li>
         <?php } ?>
         
           <?php if ($deliveryData['is_view_pincode']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/pincode_list/view');?>">View Pincode</a></li>
		<?php } ?>
		
		  <?php if ($deliveryData['is_del_pincode']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/pincode_list/delete');?>">Delete Pincode</a></li>
		<?php } ?>
	</ul>
					</li>
					
					<li><a style="">City Zone</a>

							<ul style="">
							    
							     <?php if ($deliveryData['is_add_cityzone']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/add_city_zone');?>">Add City Zone</a></li><?php  } ?>
         
          <?php if ($deliveryData['is_edit_cityzone']==1 or $this->session->userdata('user_role')=='Captain') {?>
         <li><a style="" href="<?php echo base_url('users/cityzonelist/edit_list');?>">Edit City Zone</a></li>
         <?php } ?>
         
           <?php if ($deliveryData['is_view_cityzone']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/cityzonelist/view_list');?>">View City Zone</a></li>
		<?php } ?>
		
		  <?php if ($deliveryData['is_del_cityzone']==1 or $this->session->userdata('user_role')=='Captain') {?>
		<li><a style="" href="<?php echo base_url('users/cityzonelist/delete_list');?>">Delete City Zone</a></li>
		<?php } ?>
	</ul>
					</li>
          					</ul>
          				</li><?php } ?>
          				
          				
          				
          					



<!--
          											<?php if($this->session->userdata('user_role')=="Captain") { ?>
          											
          						
          											
           <li<?php if($this->session->userdata('team_id')== ''){echo " class='disabled'";}?>> 
                           				<a style="" href="<?php echo base_url('team/team_configuration');?>"><i class='fa fa-gear'></i> Settings</a>
			                        </li>
			                        
	    		                    <li<?php if($this->session->userdata('team_id')== ''){echo " class='disabled'";}?>>
	            		            	<a style="" href="<?php echo base_url('team/backup_team/'.$this->session->userdata('team_id'));?>"><i class="fa fa-arrow-circle-up"></i> Backup</a>
	                    		    </li>
	                        		<li<?php if($this->session->userdata('team_id')== ''){echo " class='disabled'";}?>>
			                        	<a style="" href="<?php echo base_url('team/restore_team');?>"><i class="fa fa-arrow-circle-down"></i> Restore</a>
	    		                    </li>
	            		            <li<?php if($this->session->userdata('team_id')== ''){echo " class='disabled'";}?>> 
                        			   	<a style="" href="<?php echo base_url('team/single_team_delete/'.$this->session->userdata('team_id'));?>"><i class='fa fa-times' style='color:red;'></i> Delete</a>
			                        </li><?php } ?>-->
  </ul>
</div>
			</li>

			<!-- /.dropdown -->
		</ul>
	</div>

<!-- closed --->

		<!-- /.navbar-top-links -->
		<div class="navbar-default sidebar" role="navigation" style="margin-top:85px;background:#f8f8f8 !important;">
			<div class="sidebar-nav navbar-collapse">
				<ul style="" class="nav" id="side-menu">
					<?php
						if($this->session->userdata('id') != '')
						{
							if($this->session->userdata('plan_id') != 0)
							{
					?>
					<li>
					<?php
								if($this->session->userdata('logo_image') != '')
								{
									if(file_exists('assets/upload/team/'.$this->session->userdata('logo_image')))
									{
					?>
							<img id="team_logo" name="team_logo" src="<?php echo base_url('assets/upload/team/'.$this->session->userdata('logo_image'));?>" width="100%" height="80" style="border:none;">
					<?php
									}
									else
									{
					?>
							<img id="team_logo" name="team_logo" src="<?php echo base_url('assets/images/teamlogo.png');?>" width="100%" height="80" style="border:none;">
					<?php
									}
								}
								else
								{
					?>
					<img id="team_logo" name="team_logo" src="<?php echo base_url('assets/images/teamlogo.png');?>" width="100%" height="80" style="border:none;">
					<?php
								}
					?>
					</li>
					<?php
							}
							else
							{
					?>

					<?php
							}
					?>
					<?php
							if($this->session->userdata('user_role') == "Captain")
							{
					?>
					<li class="dropdown" style="display:none;padding-top:0px !important;padding-bottom:0px !important;">
						<div class="input-group custom-search-form">
							<?php
								$team_dropdown = array(""=>" Teams",$this->session->userdata('team_id')=>$this->session->userdata('team_title'));
								if($this->session->userdata('team_id')!= '')
									echo form_dropdown('teamdropdown',$team_dropdown,$this->session->userdata('team_id'),"id='teamdropdown' class='form-control'");
								else
									echo form_dropdown('teamdropdown',$team_dropdown,'',"id='teamdropdown' class='form-control'");
							?>
                    		<span class="input-group-btn dropdown">
		                     	<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button" style='background-color: transparent;border:none;'>
        	        	        	<span class="fa fa-bars"></span>
            		            </button>
                        		<ul style="" class="dropdown-menu dropdown-menu-right">
				                  	<li> 
        			                   	<a style="" href="<?php echo base_url('team/add_team');?>"><i class='fa fa-plus-circle'></i> Add</a>
	                		        </li>
	                        		<li<?php if($this->session->userdata('team_id')== ''){echo " class='disabled'";}?>> 
			                           	<a style="" href="<?php echo base_url('team/edit_team/'.$this->session->userdata('team_id'));?>"><i class='fa fa-edit'></i> Edit</a>
	        		                </li>
	                		        <li<?php if($this->session->userdata('team_id')== ''){echo " class='disabled'";}?>> 
                           				<a style="" href="<?php echo base_url('team/team_configuration');?>"><i class='fa fa-gear'></i> Settings</a>
			                        </li>
	    		                    <li<?php if($this->session->userdata('team_id')== ''){echo " class='disabled'";}?>>
	            		            	<a style="" href="<?php echo base_url('team/backup_team/'.$this->session->userdata('team_id'));?>"><i class="fa fa-arrow-circle-up"></i> Backup</a>
	                    		    </li>
	                        		<li<?php if($this->session->userdata('team_id')== ''){echo " class='disabled'";}?>>
			                        	<a style="" href="<?php echo base_url('team/restore_team');?>"><i class="fa fa-arrow-circle-down"></i> Restore</a>
	    		                    </li>
	            		            <!--<li<?php if($this->session->userdata('team_id')== ''){echo " class='disabled'";}?>> 
                        			   	<a style="" href="<?php echo base_url('team/single_team_delete/'.$this->session->userdata('team_id'));?>"><i class='fa fa-times' style='color:red;'></i> Delete</a>
			                        </li>-->
	    		                </ul>
							</span>
						</div>
					</li>
					
					<?php 
						} 
					}

               ?>
								
          </ul>
        </li>
		   
		</ul>
	</div><!-- .stellarnav -->

  
</nav>

	<!-- required -->
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script type="text/javascript" src="js/stellarnav.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery('.stellarnav').stellarNav({
				theme: 'light',
				breakpoint: 960,
				position: 'right'
			
			});
		});
	</script>
	<!-- required -->

	<script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>

	<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-bell"></i>Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="viewnoti">
        
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>