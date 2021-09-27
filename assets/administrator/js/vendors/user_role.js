// JavaScript Document

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