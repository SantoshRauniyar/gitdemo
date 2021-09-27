// JavaScript Document

function checkUncheck()
{
	var x='Grouplistform';
	
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
	var x='Grouplistform';
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
					alert("Group deleted successfully.");
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
	var x='Grouplistform';
	for(count=0 ; count < document.getElementById(x).length ; count++)
	{
		if(document.forms[x][count].type == "checkbox" && document.forms[x][count].checked == true)
		{
			i++;
		}
	}
	if(i > 0) 
	{
		if(confirm("Are you sure you want to delete these groups ?"))
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
						alert("Groups deleted successfully.");
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

//jQuery('#team_id').change(function () {
//	//alert("sdhkjhfhsdfkhsdhfkhsdf");
//	if(jQuery('#team_id').val() != '')
//	{
//		jQuery.ajax(
//		{
//		   type: "POST",
//		   url: APPLICATION_URL+"groups/getUserlist/"+jQuery('#team_id').val(),
//		   data : jQuery('#editgroupform').serialize(),
//		   dataType: 'json',
//		   async: false,
//		   success: function( response ) 
//		   {
//			   console.log(response);
//			   if(response.status == "success")
//			   {
//				   var htm='<option>Select team manager</option>';
//				   for(var i=0;i<response.data.length;i++)
//				   {
//					   htm+="<option value='"+response.data[0].id+"'>"+response.data[0].user_name+"</option>";
//				   }
//				   jQuery('#manager_id').html(htm);
//				   jQuery('#member_id').html(htm);
//				   //jQuery('#manager_id)
//			   }
//		   },
//		});
//	}
//	else
//	{
//		var htm = "<option>Select user</option>";
//		jQuery('#manager_id').html(htm);
//		jQuery('#member_id').html(htm);
//	}
//});

jQuery('#manager_id').change(function () {
	jQuery("#member_id option[value='"+jQuery('#member_id').val()+"']").attr("selected","");
	jQuery("#member_id option[value='"+jQuery('#manager_id').val()+"']").attr("selected","selected");
});
