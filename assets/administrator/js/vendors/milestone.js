// JavaScript Document

 $('.form_date').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });

function change_status(submiturl)
{
	var url1 = submiturl;
	var urlarray = url1.split('/');
	var status = '';
	if(urlarray[urlarray.length-1] == 0)
		status = "active";
	else
		status = "Inactive";
	if(confirm("Are you sure you want to "+status+" this user ?"))
	{
		jQuery.ajax(
			{
           type: "POST",
           url: url1,
           data : jQuery('#userslistform').serialize(),
           async: false,
           success: function( response ) 
           {
           		//alert(response);
           		if(response==1)
           		{
           			//alert(successmessage);
					//jQuery('#status').chid().attr('src'));
					//window.location = APPLICATION_URL+'index.php/administrator/users/all';
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
	return false;
}

function checkUncheck()
{
	var x='Milestonelistform';
	
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
	var x='Milestonelistform';
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
	if(confirm("Are you sure you want to delete this milestone ?"))
	{
		jQuery.ajax(
			{
           type: "POST",
           url: jQuery(this).attr('href'),
           data : jQuery('#Milestonelistform').serialize(),
           async: false,
           success: function( response ) 
           {
           		//alert(response);
           		if(response==1)
           		{
					alert("Milestone deleted successfully.");
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
});

jQuery('#multidelete').click(function (e) {
	e.preventDefault();
	var i=0;
	var x='Milestonelistform';
	for(count=0 ; count < document.getElementById(x).length ; count++)
	{
		if(document.forms[x][count].type == "checkbox" && document.forms[x][count].checked == true)
		{
			i++;
		}
	}
	if(i > 0) 
	{
		if(confirm("Are you sure you want to delete these milestones ?"))
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
						alert("Milestones deleted successfully.");
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