// JavaScript Document

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
CKEDITOR.replace( 'description', {
	uiColor: '#14B8C4',
	toolbar: [
		[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
		[ 'FontSize', 'TextColor', 'BGColor' ]
	]
});

function checkUncheck()
{
	var x='planlistform';
	
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
	var x='planlistform';
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

function single_delete(submiturl,formname,confirmmessage,successmsg)
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

function multiple_delete(submiturl,formname,confirmmessage,successmsg)
{
	var i=0;
	var x=formname;
	for(count=0 ; count < document.getElementById(x).length ; count++)
	{
		if(document.forms[x][count].type == "checkbox" && document.forms[x][count].checked == true)
		{
			i++;
		}
	}
	if(i > 0) 
	{
		if(confirm("Are you sure you want to delete these plans ?"))
		{
			jQuery.ajax(
				{
			   type: "POST",
			   url: APPLICATION_URL+submiturl,
			   data : jQuery('#'+x).serialize(),
			   async: false,
			   success: function( response ) 
			   {
					//alert(response);
					if(response==1)
					{
						alert("Plans deleted successfully.");
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
}

jQuery('#plan_type').change(function() {
	if(jQuery('#plan_type').val() != "0")
	{
		if(jQuery('#plan_type').val() == "2")
		{
			jQuery('#plan_amount').show();
		}
		else
		{
			jQuery('#plan_amount').hide();
		}
		
	}
	else
	{
		jQuery('#plan_amount').show();
		return false;
	}
});


jQuery('#amount').keypress(function(e) {
	var keyCode = e.which ? e.which : e.keyCode;
	if(keyCode >= 48 && keyCode <= 57)
	{
		if(jQuery('#amount').val().length >= 5)
			return false;
		
		return true;
	}
	else
	{
		return false;
	}
});