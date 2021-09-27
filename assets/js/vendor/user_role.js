// JavaScript Document

function checkUncheck()
{
	var x='userslistform';
	if(document.getElementById('checkall').checked == true)
	{
		for(i=0; i < document.getElementById(x).length ; i++)
		{
			if(document.forms[x][i].type == "checkbox" && document.forms[x][i].id == 'chk[]')
			{
				document.forms[x][i].checked = true;
			}
		}
	}
	else if(document.getElementById('checkall').checked == false)
	{
		//alert(x);
		for(i=0; i < document.getElementById(x).length ; i++)
		{
			if(document.forms[x][i].type == "checkbox" && document.forms[x][i].id == "chk[]")
			{
				document.forms[x][i].checked = false;
			}
		}
	}
}

function check()
{
	var x='userslistform';
	var j=0;
	var k=0;
	for(i=0 ; i < document.getElementById(x).length ; i++)
	{
		if(document.forms[x][i].type == "checkbox" && document.forms[x][i].id == "chk[]")
		{
			j++;
			if(document.forms[x][i].checked == true)
				k++;
		}
	}
	//alert(j);
	if(k == j)
		document.getElementById('checkall').checked = true;
	else
		document.getElementById('checkall').checked = false;	
}

jQuery('#delete').click(function (e) {
	e.preventDefault();
	if(confirm("Are you sure you want to delete this role ?"))
	{
		jQuery.ajax(
			{
           type: "POST",
           url: jQuery(this).attr('href'),
           data : jQuery('#userslistform').serialize(),
           async: false,
           success: function( response ) 
           {
           		//alert(response);
           		if(response==1)
           		{
           			alert("Role deleted successfully.");
           			document.getElementById('userslistform').submit();
					return true;
           		}
           		else
           		{
           			alert(response);
					return false;
           		}
           },
      	});
	}
});

function changestatus(base_url,submit_url,formname,control)
{
	if(control.checked == true)
	{
		var urlpath = base_url+submit_url+'1';
	}
	else
	{
		var urlpath = base_url+submit_url+'0';
	}
	jQuery.ajax(
	{
		type: "POST",
        url: urlpath,
        data : jQuery('#'+formname).serialize(),
        async: false,
        success: function( response ) 
        {
        	//alert(response);
        	if(response==1)
        	{
        		return true;
          	}
          	else
          	{
          		alert(response);
          		return false;
           	}
       },
  	});
}

jQuery('#user_role').change(function() {
	if(jQuery('#user_role').val() != "")
	{
		//jQuery('#subpanel').show();
		//jQuery('#loader').show();
		jQuery.ajax(
		{
           type: "POST",
           url: APPLICATION_URL+'user_role/getPrivillages/'+jQuery('#user_role').val(),
           data : jQuery('#editprivillagesform').serialize(),
		     dataType: 'json',
           async: false,
		     beforeSend: function()
		     {
			     jQuery('#loader').show();
			     jQuery('#subpanel').hide();			   
		     },
           complete: function( response ) 
           {
        	   	console.log(response.responseText);
			    var jsonobj = jQuery.parseJSON(response.responseText);
				console.log(jsonobj);
				setTimeout(
					function(){
           		if(jsonobj.status == 'success')
           		{
					jQuery('#is_add_group_member').val(jsonobj.data.is_add_group_member);
					jQuery('#is_delete_group_member').val(jsonobj.data.is_delete_group_member);
					jQuery('#is_group_chat_board').val(jsonobj.data.is_group_chat_board);
					jQuery('#is_theam').val(jsonobj.data.is_theam);
					
					jQuery('#is_task_create').val(jsonobj.data.is_task_create);
					jQuery('#is_complete_task').val(jsonobj.data.is_complete_task);
					jQuery('#is_approve_task').val(jsonobj.data.is_approve_task);
					jQuery('#is_reassign_task').val(jsonobj.data.is_reassign_task);	
					jQuery('#is_sub_task').val(jsonobj.data.is_sub_task);
					jQuery('#is_task_discussion').val(jsonobj.data.is_task_discussion);


					jQuery('#is_add_pro').val(jsonobj.data.is_add_pro);
					jQuery('#is_del_pro').val(jsonobj.data.is_del_pro);
					jQuery('#is_edit_pro').val(jsonobj.data.is_edit_pro);
					jQuery('#is_view_pro').val(jsonobj.data.is_view_pro);

					jQuery('#is_taskboard_pro').val(jsonobj.data.is_taskboard_pro);
					jQuery('#is_dashboard_pro').val(jsonobj.data.is_dashboard_pro);



					jQuery('#is_add_unit').val(jsonobj.data.is_add_unit);
					jQuery('#is_del_unit').val(jsonobj.data.is_del_unit);
					jQuery('#is_edit_unit').val(jsonobj.data.is_edit_unit);
					jQuery('#is_view_unit').val(jsonobj.data.is_view_unit);
					jQuery('#is_taskboard_unit').val(jsonobj.data.is_taskboard_unit);
					jQuery('#is_dashboard_unit').val(jsonobj.data.is_dashboard_unit);


					jQuery('#is_add_project').val(jsonobj.data.is_add_project);
					jQuery('#is_del_project').val(jsonobj.data.is_del_project);
					jQuery('#is_edit_project').val(jsonobj.data.is_edit_project);
					jQuery('#is_view_project').val(jsonobj.data.is_view_project);
					jQuery('#is_taskboard_project').val(jsonobj.data.is_taskboard_project);
					jQuery('#is_dashboard_project').val(jsonobj.data.is_dashboard_project);
						
					jQuery('#is_add_mile').val(jsonobj.data.is_add_mile);
					jQuery('#is_del_mile').val(jsonobj.data.is_del_mile);
					jQuery('#is_edit_mile').val(jsonobj.data.is_edit_mile);
					jQuery('#is_view_mile').val(jsonobj.data.is_view_mile);
					jQuery('#is_taskboard_mile').val(jsonobj.data.is_taskboard_mile);
					jQuery('#is_dashboard_mile').val(jsonobj.data.is_dashboard_mile);


					jQuery('#is_add_gtask').val(jsonobj.data.is_add_gtask);
					jQuery('#is_del_gtask').val(jsonobj.data.is_del_gtask);
					jQuery('#is_edit_gtask').val(jsonobj.data.is_edit_gtask);
					jQuery('#is_view_gtask').val(jsonobj.data.is_view_gtask);
					jQuery('#is_approve_gtask').val(jsonobj.data.is_approve_gtask);
					jQuery('#is_comp_gtask').val(jsonobj.data.is_comp_gtask);

				jQuery('#is_add_mtask').val(jsonobj.data.is_add_mtask);
					jQuery('#is_del_mtask').val(jsonobj.data.is_del_mtask);
					jQuery('#is_edit_mtask').val(jsonobj.data.is_edit_mtask);
					jQuery('#is_view_mtask').val(jsonobj.data.is_view_mtask);
					jQuery('#is_approve_mtask').val(jsonobj.data.is_approve_mtask);
					jQuery('#is_comp_mtask').val(jsonobj.data.is_comp_mtask);



					jQuery('#is_add_pub_task').val(jsonobj.data.is_add_pub_task);
					jQuery('#is_del_pub_task').val(jsonobj.data.is_del_pub_task);
					jQuery('#is_edit_pub_task').val(jsonobj.data.is_edit_pub_task);
					jQuery('#is_view_pub_task').val(jsonobj.data.is_view_pub_task);
					jQuery('#is_approve_pub_task').val(jsonobj.data.is_approve_pub_task);
					jQuery('#is_comp_pub_task').val(jsonobj.data.is_comp_pub_task);
			
					jQuery('#is_add_response_task').val(jsonobj.data.is_add_response_task);
					jQuery('#is_del_response_task').val(jsonobj.data.is_del_response_task);
					jQuery('#is_edit_response_task').val(jsonobj.data.is_edit_response_task);
					jQuery('#is_view_response_task').val(jsonobj.data.is_view_response_task);
					jQuery('#is_approve_response_task').val(jsonobj.data.is_approve_response_task);


												jQuery('#is_add_team').val(jsonobj.data.is_add_team);
												jQuery('#is_del_team').val(jsonobj.data.is_del_team);
												jQuery('#is_edit_team').val(jsonobj.data.is_edit_team);
												jQuery('#is_view_team').val(jsonobj.data.is_view_team);
												jQuery('#is_approve_team').val(jsonobj.data.is_approve_team);
												
												jQuery('#is_add_member').val(jsonobj.data.is_add_member);
												jQuery('#is_del_member').val(jsonobj.data.is_del_member);
												jQuery('#is_edit_member').val(jsonobj.data.is_edit_member);
												jQuery('#is_view_member').val(jsonobj.data.is_view_member);
												jQuery('#is_member_block').val(jsonobj.data.is_member_block);
												jQuery('#is_member_unblock').val(jsonobj.data.is_member_unblock);


jQuery('#is_add_role').val(jsonobj.data.is_add_role);
jQuery('#is_del_role').val(jsonobj.data.is_del_role);
jQuery('#is_edit_role').val(jsonobj.data.is_edit_role);
jQuery('#is_view_role').val(jsonobj.data.is_view_role);

jQuery('#is_add_assign').val(jsonobj.data.is_add_role);
jQuery('#is_del_assign').val(jsonobj.data.is_del_role);
jQuery('#is_edit_assign').val(jsonobj.data.is_edit_role);
jQuery('#is_view_assign').val(jsonobj.data.is_view_role);
		


jQuery('#is_add_lead_gen_task').val(jsonobj.data.is_add_lead_gen_task);
jQuery('#is_del_lead_gen_task').val(jsonobj.data.is_del_lead_gen_task);
jQuery('#is_edit_lead_gen_task').val(jsonobj.data.is_edit_lead_gen_task);
jQuery('#is_view_lead_gen_task').val(jsonobj.data.is_view_lead_gen_task);


jQuery('#is_add_lead_quali_task').val(jsonobj.data.is_add_lead_quali_task);
jQuery('#is_del_lead_quali_task').val(jsonobj.data.is_del_lead_quali_task);
jQuery('#is_edit_lead_quali_task').val(jsonobj.data.is_edit_lead_quali_task);
jQuery('#is_view_lead_quali_task').val(jsonobj.data.is_view_lead_quali_task);												
												
												
							jQuery('#is_add_country').val(jsonobj.data.is_add_country);
jQuery('#is_del_country').val(jsonobj.data.is_del_country);
jQuery('#is_edit_country').val(jsonobj.data.is_edit_country);
jQuery('#is_view_country').val(jsonobj.data.is_view_country);					

jQuery('#is_add_state').val(jsonobj.data.is_add_state);
jQuery('#is_del_state').val(jsonobj.data.is_del_state);
jQuery('#is_edit_state').val(jsonobj.data.is_edit_state);
jQuery('#is_view_state').val(jsonobj.data.is_view_state);

jQuery('#is_add_district').val(jsonobj.data.is_add_district);
jQuery('#is_del_district').val(jsonobj.data.is_del_district);
jQuery('#is_edit_district').val(jsonobj.data.is_edit_district);
jQuery('#is_view_district').val(jsonobj.data.is_view_district);

jQuery('#is_add_city').val(jsonobj.data.is_add_city);
jQuery('#is_del_city').val(jsonobj.data.is_del_city);
jQuery('#is_edit_city').val(jsonobj.data.is_edit_city);
jQuery('#is_view_city').val(jsonobj.data.is_view_city);

jQuery('#is_add_pincode').val(jsonobj.data.is_add_pincode);
jQuery('#is_del_pincode').val(jsonobj.data.is_del_pincode);
jQuery('#is_edit_pincode').val(jsonobj.data.is_edit_pincode);
jQuery('#is_view_pincode').val(jsonobj.data.is_view_pincode);

jQuery('#is_add_cityzone').val(jsonobj.data.is_add_cityzone);
jQuery('#is_del_cityzone').val(jsonobj.data.is_del_cityzone);
jQuery('#is_edit_cityzone').val(jsonobj.data.is_edit_cityzone);
jQuery('#is_view_cityzone').val(jsonobj.data.is_view_cityzone);

                        jQuery('#is_hire').val(jsonobj.data.is_hire);
jQuery('#is_delete_hire').val(jsonobj.data.is_delete_hire);
jQuery('#is_edit_hire').val(jsonobj.data.is_edit_hire);
jQuery('#is_view_hire').val(jsonobj.data.is_view_hire);


jQuery('#is_take_leave').val(jsonobj.data.is_take_leave);
jQuery('#is_delete_leave').val(jsonobj.data.is_delete_leave);
jQuery('#is_edit_leave').val(jsonobj.data.is_edit_leave);
jQuery('#is_view_leave').val(jsonobj.data.is_view_leave);


jQuery('#is_add_sec').val(jsonobj.data.is_add_sec);
jQuery('#is_del_sec').val(jsonobj.data.is_del_sec);
jQuery('#is_edit_sec').val(jsonobj.data.is_edit_sec);
jQuery('#is_view_sec').val(jsonobj.data.is_view_sec);



jQuery('#is_dr_pend').val(jsonobj.data.is_dr_pend);
jQuery('#is_dr_reg').val(jsonobj.data.is_dr_reg);
jQuery('#is_dr_rej').val(jsonobj.data.is_dr_rej);
jQuery('#is_dr_appr').val(jsonobj.data.is_dr_appr);

jQuery('#is_ppend').val(jsonobj.data.is_ppend);
jQuery('#is_preg').val(jsonobj.data.is_preg);
jQuery('#is_prej').val(jsonobj.data.is_prej);
jQuery('#is_pappr').val(jsonobj.data.is_pappr);

jQuery('#is_add_country_partner').val(jsonobj.data.is_add_country_partner);
jQuery('#is_del_country_partner').val(jsonobj.data.is_del_country_partner);
jQuery('#is_edit_country_partner').val(jsonobj.data.is_edit_country_partner);
jQuery('#is_view_country_partner').val(jsonobj.data.is_view_country_partner);
jQuery('#is_add_state_partner').val(jsonobj.data.is_add_state_partner);
jQuery('#is_del_state_partner').val(jsonobj.data.is_del_state_partner);
jQuery('#is_edit_state_partner').val(jsonobj.data.is_edit_state_partner);
jQuery('#is_view_state_partner').val(jsonobj.data.is_view_state_partner);
jQuery('#is_add_district_partner').val(jsonobj.data.is_add_district_partner);
jQuery('#is_del_district_partner').val(jsonobj.data.is_del_district_partner);
jQuery('#is_edit_district_partner').val(jsonobj.data.is_edit_district_partner);
jQuery('#is_view_district_partner').val(jsonobj.data.is_view_district_partner);


jQuery('#is_hview_reg').val(jsonobj.data.is_hview_reg);
jQuery('#is_hview_approval').val(jsonobj.data.is_hview_approval);				


					jQuery('#subpanel').show();
					jQuery('#loader').hide();
					return true;
           		}
           		else
           		{
					jQuery('.well').html(response.data).fadeIn('slow');
					return false;
           		}},5000);
           },
      	});	
	}
	else
	{
		jQuery('#subpanel').hide();
		jQuery('#loader').hide();
	}
});


jQuery('#menu').change(function(){

		if(jQuery('#menu').val() == 1)
	{
		
		jQuery('#program').show();//program
		jQuery('#projects').hide();//projects
		jQuery('#tasks').hide();//task
		jQuery('#team').hide();//team
		jQuery('#locations').hide();//location
		jQuery('#haspatals').hide();//haspatal
		jQuery('#doctors').hide();//doctors
			jQuery('#partners').hide();//partners

	}else if(jQuery('#menu').val()==2)
	{
		jQuery('#program').hide();//program
		jQuery('#projects').show();//projects
		jQuery('#tasks').hide();//task
		jQuery('#team').hide();//team
		jQuery('#locations').hide();//location
		jQuery('#haspatals').hide();//haspatal
		jQuery('#doctors').hide();//doctors
			jQuery('#partners').hide();//partners
	}else if(jQuery('#menu').val()==3)
	{
						jQuery('#program').hide();//program
		jQuery('#projects').hide();//projects
		jQuery('#tasks').show();//task
		jQuery('#team').hide();//team
		jQuery('#locations').hide();//location
		jQuery('#haspatals').hide();//haspatal
		jQuery('#doctors').hide();//doctors
			jQuery('#partners').hide();//partners
	}else if(jQuery('#menu').val()==4)
	{
		jQuery('#program').hide();//program
		jQuery('#projects').hide();//projects
		jQuery('#tasks').hide();//task
		jQuery('#team').show();//team
		jQuery('#haspatals').hide();//haspatal
				jQuery('#locations').hide();//location
				jQuery('#doctors').hide();//doctors
					jQuery('#partners').hide();//partners
	}
	else if(jQuery('#menu').val()==5)
	{
		jQuery('#program').hide();//program
		jQuery('#projects').hide();//projects
		jQuery('#tasks').hide();//task
		jQuery('#team').hide();//team
		jQuery('#locations').show();//location
		jQuery('#haspatals').hide();//haspatal
		jQuery('#doctors').hide();//doctors
			jQuery('#partners').hide();//partners
	}
	else if(jQuery('#menu').val()==6)
	{
		jQuery('#program').hide();//program
		jQuery('#projects').hide();//projects
		jQuery('#tasks').hide();//task
		jQuery('#team').hide();//team
		jQuery('#locations').hide();//location
		jQuery('#haspatals').show();//haspatal
		jQuery('#doctors').hide();//doctors
			jQuery('#partners').hide();//partners
	}
	else if(jQuery('#menu').val()==7)
	{
		jQuery('#program').hide();//program
		jQuery('#projects').hide();//projects
		jQuery('#tasks').hide();//task
		jQuery('#team').hide();//team
		jQuery('#locations').hide();//location
		jQuery('#haspatals').hide();//haspatal
			jQuery('#doctors').show();//doctors
				jQuery('#partners').hide();//partners
	}
	else if(jQuery('#menu').val()==8)
	{
		jQuery('#program').hide();//program
		jQuery('#projects').hide();//projects
		jQuery('#tasks').hide();//task
		jQuery('#team').hide();//team
		jQuery('#locations').hide();//location
		jQuery('#haspatals').hide();//haspatal
			jQuery('#doctors').hide();//doctors
			jQuery('#partners').show();//partners
	}


})




jQuery('#privillages').change(function (){
	//alert(jQuery('#subpanel').val());
	//alert(jQuery('#privillages').val());
	if(jQuery('#privillages').val() == 0)
	{
		jQuery('#dataTables-example').hide();

	}
	else if(jQuery('#privillages').val() == 1)//department
	{
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').show();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
	}
	else if(jQuery('#privillages').val() == 2)//task
	{
		//alert(jQuery('#privillages').val());
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#task_privillages').show();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
				jQuery('#response_task_privillages').hide();
						jQuery('#member_privillages').hide();
								jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
								jQuery('#project_privillages').hide();
								jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
		//jQuery('#task_settoing').hide();
	}
	else if(jQuery('#privillages').val() == 3)//program
	{
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#program_privillages').show();
	jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
	jQuery('#project_privillages').hide();
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
			jQuery('#member_privillages').hide();
			jQuery('#response_task_privillages').hide();

				jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
				jQuery('#state_privillages').hide();
							jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
			
	}
	else if(jQuery('#privillages').val() == 4)//unit
	{
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#unit_privillages').show();
		//jQuery('#task_settoing').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();
		jQuery('#lead_generation_task_privillages').hide();
		jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
	
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#project_privillages').hide();

				jQuery('#response_task_privillages').hide();
						jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
								jQuery('#member_privillages').hide();
								jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
	}
	
	else if(jQuery('#privillages').val() == 60)//unit
	{
	   // alert(jQuery('#privillages').val());
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#unit_privillages').hide();
		jQuery('#section_privillages').show();
		jQuery('#program_privillages').hide();	jQuery('#patients_privillages').hide();
		jQuery('#lead_generation_task_privillages').hide();
		jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
	
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#project_privillages').hide();

				jQuery('#response_task_privillages').hide();
						jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
								jQuery('#member_privillages').hide();
								jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
	}
	
	else if(jQuery('#privillages').val() == 61)//patient
	{
	   // alert(jQuery('#privillages').val());
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#unit_privillages').hide();
		jQuery('#section_privillages').hide();
		
		jQuery('#patients_privillages').show();
		jQuery('#program_privillages').hide();	
		jQuery('#lead_generation_task_privillages').hide();
		jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
	
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#project_privillages').hide();

				jQuery('#response_task_privillages').hide();
						jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
								jQuery('#member_privillages').hide();
								jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
	}
	
	else
	{
		jQuery('#dataTables-example').hide();
	}
});

				jQuery('#project').change(function(){


		 if(jQuery('#project').val() == 5)//project
	{
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').show();
		//jQuery('#task_settoing').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#member_privillages').hide();
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
	}
	else if(jQuery('#project').val() == 6)//milestone
	{
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#project_privillages').hide();
		//jQuery('#task_settoing').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#member_privillages').hide();
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#milestone_privillages').show();
		jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
	}

				})



jQuery('#task').change(function(){

if(jQuery('#task').val() == 7)//general task
	{
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#project_privillages').hide();
		//jQuery('#task_settoing').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#response_task_privillages').hide();
		jQuery('#gtask_privillages').show();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
		//jQuery('#task_settoing').hide();
	}
	else if(jQuery('#task').val() == 8)//production task
	{
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').show();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
		jQuery('#member_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
	}
	else if(jQuery('#task').val() == 9)// publish task
	{
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();	
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#pub_task_privillages').show();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
	}
	else if(jQuery('#task').val() == 10)// response_task_privillages
	{
				jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').show();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
	}
	else if(jQuery('#task').val() == 14)// lead_generation_task_privillages
	{
				jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();
		//jQuery('#task_settoing').hide();
	
		jQuery('#gtask_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#member_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#lead_generation_task_privillages').show();
				jQuery('#lead_qualification_task_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
	}
	else if(jQuery('#task').val() == 15)// lead_qualification_task_privillages
	{


			

		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();
		//jQuery('#task_settoing').hide();
	
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#member_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#lead_generation_task_privillages').hide();
		jQuery('#lead_qualification_task_privillages').show();

		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();	
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
	}

				})


jQuery('#teams').change(function(){

if(jQuery('#teams').val() == 11)// team_privillages
	{
				jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').show();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
				jQuery('#state_privillages').hide();

		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#city_privillages').hide();
	}
	else if(jQuery('#teams').val() == 12)// members_privillages
	{
		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
	
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#member_privillages').show();
				jQuery('#state_privillages').hide();

		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
	}
	else if(jQuery('#teams').val() == 13)// role_privillages
	{
				jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
	
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#member_privillages').hide();
		jQuery('#role_privillages').show();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
				jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();		
	}
	            else if(jQuery('#teams').val()==24)
				{

					jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();


		jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();
				jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#leave_privillages').hide();
		jQuery('#hire_privillages').show();
				}
				else if(jQuery('#teams').val()==25)
				{

					jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();
		jQuery('#doctor_rej_privillages').hide();
		jQuery('#doctor_reg_privillages').hide();
		jQuery('#doctor_appr_privillages').hide();
		jQuery('#milestone_privillages').hide();


		jQuery('#h360_reg_privillages').hide();
		jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		
		jQuery('#hire_privillages').hide();
		jQuery('#hire_privillages').hide();
		jQuery('#leave_privillages').show();
				}
			else if(jQuery('#teams').val()==92)
				{

					jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();
		jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();
		jQuery('#doctor_rej_privillages').hide();
		jQuery('#doctor_reg_privillages').hide();
		jQuery('#doctor_appr_privillages').hide();
		jQuery('#milestone_privillages').hide();


		jQuery('#h360_reg_privillages').hide();
		jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		
		jQuery('#hire_privillages').hide();
		jQuery('#hire_privillages').hide();
		jQuery('#leave_privillages').hide();
		jQuery('#currency_privillages').show();
				}
					else if(jQuery('#teams').val()==93)
				{

					jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();
		jQuery('#doctor_rej_privillages').hide();
		jQuery('#doctor_reg_privillages').hide();
		jQuery('#doctor_appr_privillages').hide();
		jQuery('#milestone_privillages').hide();


		jQuery('#h360_reg_privillages').hide();
		jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		
		jQuery('#hire_privillages').hide();
		
		jQuery('#leave_privillages').hide();
		jQuery('#hire_privillages').hide();
		jQuery('#setcurrency_privillages').show();
				}
		
	
				})

jQuery('#location').change(function(){

   // alert(jQuery('#location').val());
if(jQuery('#location').val() == 16)// team_privillages
	{
				jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#country_privillages').show();
				jQuery('#state_privillages').hide();

	
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
	}
	else if(jQuery('#location').val() == 17)// state_privillages
	{
								jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').show();

		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
	}
	else if(jQuery('#location').val() == 18)// city_privillages
	{
								jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').hide();
		jQuery('#city_privillages').show();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
	}
	else if(jQuery('#location').val() == 19)// district_privillages
	{
								jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#district_privillages').show();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
					jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
	}
	else if(jQuery('#location').val() == 20)// pincode_privillages
	{
								jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
			jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').show();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
	}
	else if(jQuery('#location').val() == 91)// cityzone_privillages
	{
								jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
			jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#cityzone_privillages').show();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
	}
})


jQuery('#haspatal').change(function(){


		if (jQuery('#haspatal').val()==21) {


					jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
		jQuery('#h360_reg_privillages').show();
				jQuery('#h360_approval_privillages').hide();jQuery('#leave_privillages').hide(); 		jQuery('#hire_privillages').hide();

		}
		else if(jQuery('#haspatal').val()==22)
				{

					jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();


		jQuery('#h360_reg_privillages').hide();
		jQuery('#h360_approval_privillages').show();	
				}
			

})


jQuery('#doctor').change(function(){


		if (jQuery('#doctor').val()==50) {


		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();
		jQuery('#lead_generation_task_privillages').hide();
		jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
		jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();
				jQuery('#leave_privillages').hide(); 
				jQuery('#hire_privillages').hide();
				jQuery('#doctor_reg_privillages').show();

		}
		else if(jQuery('#doctor').val()==51)
				{

					jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();


		jQuery('#h360_reg_privillages').hide();
		jQuery('#h360_approval_privillages').hide();
		jQuery('#doctor_appr_privillages').show();
				}
					else if(jQuery('#doctor').val()==52)
				{

					jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();


		jQuery('#h360_reg_privillages').hide();
		jQuery('#h360_approval_privillages').hide();
		jQuery('#doctor_pend_privillages').show();
				}
					else if(jQuery('#doctor').val()==53)
				{

					jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();


		jQuery('#h360_reg_privillages').hide();
		jQuery('#h360_approval_privillages').hide();
		jQuery('#doctor_rej_privillages').show();
				}
			

})




jQuery('#partner').change(function(){


		if (jQuery('#partner').val()==54) {


		jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();
		jQuery('#lead_generation_task_privillages').hide();
		jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();
		jQuery('#h360_reg_privillages').hide();
				jQuery('#h360_approval_privillages').hide();
				jQuery('#leave_privillages').hide(); 
				jQuery('#hire_privillages').hide();
				jQuery('#doctor_reg_privillages').hide();

		
		    jQuery('#country_partner_privillages').show();
		}
		else if(jQuery('#partner').val()==55)
				{

					jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();


		jQuery('#h360_reg_privillages').hide();
		jQuery('#h360_approval_privillages').hide();
		jQuery('#doctor_appr_privillages').hide();
		jQuery('#country_partner_privillages').hide();
		jQuery('#state_partner_privillages').show();
				}
					else if(jQuery('#partner').val()==56)
				{

					jQuery('#dataTables-example').show();
		jQuery('#group_privillages').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#cityzone_privillages').hide();jQuery('#unit_privillages').hide();
		jQuery('#project_privillages').hide();
		jQuery('#response_task_privillages').hide();
		jQuery('#program_privillages').hide();	jQuery('#section_privillages').hide(); 		 		jQuery('#patients_privillages').hide();jQuery('#lead_generation_task_privillages').hide();jQuery('#lead_qualification_task_privillages').hide();
		//jQuery('#task_settoing').hide();
			jQuery('#member_privillages').hide();
		
		jQuery('#gtask_privillages').hide();
		jQuery('#mtask_privillages').hide();
		jQuery('#pub_task_privillages').hide();
		//jQuery('#group_setting').hide();
		jQuery('#setcurrency_privillages').hide();jQuery('#currency_privillages').hide();jQuery('#task_privillages').hide();
		jQuery('#role_privillages').hide();
		jQuery('#team_privillages').hide();
		jQuery('#state_privillages').hide();
		jQuery('#city_privillages').hide();
		jQuery('#country_privillages').hide();
				jQuery('#district_privillages').hide();
		jQuery('#pincode_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();jQuery('#doctor_rej_privillages').hide();jQuery('#doctor_reg_privillages').hide();jQuery('#doctor_appr_privillages').hide();jQuery('#milestone_privillages').hide();


		jQuery('#h360_reg_privillages').hide();
		jQuery('#h360_approval_privillages').hide();
		jQuery('#doctor_pend_privillages').hide();
		jQuery('#country_partner_privillages').hide();
		jQuery('#state_partner_privillages').hide();
		jQuery('#district_partner_privillages').show();
				}
					
			

})