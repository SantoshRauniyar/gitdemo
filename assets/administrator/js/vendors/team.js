// JavaScript Document
jQuery('#plan_id').change(function () {
	jQuery.ajax(
		{
           type: "POST",
           url: APPLICATION_URL+'index.php/administrator/team/getPlanDetails',
           data : jQuery('#editteamform').serialize(),
		   dataType: 'json',
           async: false,
           success: function( response ) 
           {
				//console.log(response);
           		if(response.status == 'success')
           		{
					jQuery('.well').html(response.data).fadeIn('slow');
					return true;
           		}
           		else
           		{
					jQuery('.well').html(response.data).fadeIn('slow');
					return false;
           		}
           },
      	});					 
});
jQuery('#team_id').change(function (){
	if(jQuery('#team_id').val() != "")
	{
		//jQuery('#subpanel').show();
		//jQuery('#loader').show();
		jQuery.ajax(
		{
           type: "POST",
           url: APPLICATION_URL+'team/getTeamFeatures/'+jQuery('#team_id').val(),
           data : jQuery('#editteamform').serialize(),
		   dataType: 'json',
           async: false,
		   beforeSend: function()
		   {
			   jQuery('#loader').show();
			   jQuery('#subpanel').hide();
			   
		   },
           complete: function( response ) 
           {
			    var jsonobj = jQuery.parseJSON(response.responseText);
				//console.log(jsonobj);
				setTimeout(
					function(){
           		if(jsonobj.status == 'success')
           		{
					jQuery('#multi_groups_creation').val(jsonobj.data[0].multi_groups_creation);
					jQuery('#multi_time_zone').val(jsonobj.data[0].multi_time_zone);
					jQuery('#multi_currency').val(jsonobj.data[0].multi_currency);
					jQuery('#leave_management').val(jsonobj.data[0].leave_management);
					jQuery('#rejoin').val(jsonobj.data[0].rejoin);
					jQuery('#mis_chart').val(jsonobj.data[0].mis_chart);	
					jQuery('#theam').val(jsonobj.data[0].theam);
					jQuery('#limit_member_size').val(jsonobj.data[0].limit_member_size);
					jQuery('#announcements').val(jsonobj.data[0].announcements);
					
					jQuery('#group_creation').val(jsonobj.data[0].group_creation);
					jQuery('#subgroup_creation').val(jsonobj.data[0].subgroup_creation);
					jQuery('#group_discussion_board').val(jsonobj.data[0].group_discussion_board);
					
					jQuery('#recurrence_task').val(jsonobj.data[0].recurrence_task);
					jQuery('#subsequent_task').val(jsonobj.data[0].subsequent_task);
					jQuery('#budget_task').val(jsonobj.data[0].budget_task);
					jQuery('#task_followers').val(jsonobj.data[0].task_followers);
					jQuery('#task_approval').val(jsonobj.data[0].task_approval);
					jQuery('#task_discussion').val(jsonobj.data[0].task_discussion);
					jQuery('#auto_abort').val(jsonobj.data[0].auto_abort);
					jQuery('#subtask').val(jsonobj.data[0].subtask);
					jQuery('#reassign_task').val(jsonobj.data[0].reassign_task);

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

jQuery('#features').change(function (){
	//alert(jQuery('#subpanel').val());
	if(jQuery('#features').val() == 0)
	{
		jQuery('#dataTables-example').hide();
	}
	else if(jQuery('#features').val() == 1)
	{
		jQuery('#dataTables-example').show();
		jQuery('#team_setting').show();
		jQuery('#group_setting').hide();
		jQuery('#task_settoing').hide();
	}
	else if(jQuery('#features').val() == 2)
	{
		jQuery('#dataTables-example').show();
		jQuery('#team_setting').hide();
		jQuery('#group_setting').show();
		jQuery('#task_settoing').hide();
	}
	else if(jQuery('#features').val() == 3)
	{
		jQuery('#dataTables-example').show();
		jQuery('#team_setting').hide();
		jQuery('#group_setting').hide();
		jQuery('#task_settoing').show();
	}
	else
	{
		jQuery('#dataTables-example').hide();
	}
});
/*function setValue(baseurl,submit_url)
{
	
	jQuery.ajax(
		{
           type: "POST",
           url: APPLICATION_URL+submit_url,
           data : jQuery('#editteamform').serialize(),
		   //dataType: 'json',
           async: false,
           success: function( response ) 
           {
				alert(response);
           		if(response == '1')
           		{
					alert("success");
					jQuery('.well').html(response.data).fadeIn('slow');
					return true;
           		}
           		else
           		{
					alert(response);
					jQuery('.well').html(response.data).fadeIn('slow');
					return false;
           		}
           },
      	});
}*/

function checkUncheck()
{
	var x='Teamlistform';
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

	var x='Teamlistform';

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



function single_team_delete(submiturl,formname,confirmmessage,successmsg)
{
	if(confirm(confirmmessage))
	{
		jQuery.ajax(
		{
           type: "POST",
           url: APPLICATION_URL+submiturl,
           data : jQuery('#'+formname).serialize(),
           async: false,
           success: function( response ) 
           {
          		//alert(response);

           		if(response==1)

           		{

					alert("Plan deleted successfully.");

           			document.getElementById(formname).submit();

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

}



jQuery('#multidelete').click(function (e) {

	e.preventDefault();

	var i=0;

	var x='Teamlistform';

	for(count=0 ; count < document.getElementById(x).length ; count++)

	{

		if(document.forms[x][count].type == "checkbox" && document.forms[x][count].checked == true)

		{

			i++;

		}

	}

	if(i > 0) 

	{

		if(confirm("Are you sure you want to delete these teams ?"))

		{

			jQuery.ajax(

				{

			   type: "POST",

			   url: jQuery(this).attr('href'),

			   data : jQuery('#'+x).serialize(),

			   async: false,

			   success: function( response ) 

			   {

					//alert(response);

					if(response==1)

					{

						alert("Teams deleted successfully.");

						document.getElementById(x).submit();

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

		return false;

	}

	else

	{

		alert("No checkbox selected for delete.");

	}

});

