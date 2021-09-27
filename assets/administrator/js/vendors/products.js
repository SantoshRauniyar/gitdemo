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



jQuery('#budget').keypress(function (e){

	var charCode = (e.which) ? e.which : event.keyCode;

    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {

        return false;

    } else {

        return true;

    }     

});

jQuery('#no_of_milestone').keypress(function (e){

	var charCode = (e.which) ? e.which : event.keyCode;

    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {

        return false;

    } else {

        return true;

    }     

});


function checkUncheck()

{

	var x='projectslistform';

	

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

	var x='projectslistform';

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



function delete_projects(submiturl,formname,confirmmessage,successmessage)

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

					alert(successmessage);

           			document.getElementById(formname).submit();

					return true;

           		}

           		else

           		{

           			alert('error');

					return false;

           		}

           },

      	});

	}

	return false;

}



function delete_multiple(submiturl,formname,confirmmessage,successmessage)

{

	var i=0;

	var x=formname ;

	for(count=0 ; count < document.getElementById(x).length ; count++)

	{

		if(document.forms[x][count].type == "checkbox" && document.forms[x][count].checked == true)

		{

			i++;

		}

	}

	if(i > 0) 

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

						alert(successmessage);

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

		return false;

	}

	else

	{

		alert("No checkbox selected for delete.");

	}

}

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

