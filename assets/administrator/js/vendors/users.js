// JavaScript Document
var ToEndDate = new Date();
$('.form_date').datetimepicker({
		//language:  'fr',
		formate:'dd/mm/yyyy',
		weekStart: 1,
      todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		minView: 2,
		maxView: 4,
		endDate: ToEndDate
});
jQuery('#status').click(function (e) { 
	e.preventDefault();
	var url1 = jQuery(this).attr('href');
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
});
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
	if(confirm("Are you sure you want to delete this user ?"))
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
					alert("User deleted successfully.");
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
jQuery('#multidelete').click(function (e) {
	e.preventDefault();
	var i=0;
	var x='userslistform';
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
jQuery('#switchusr').click(function(e) {
	e.preventDefault();
	jQuery.ajax(
	{
	   type: "POST",
	   url: APPLICATION_URL+"users/do_switch_user/"+jQuery('#id').val()+"/"+jQuery('#team_id').val(),
	   data : jQuery('#switchuserform').serialize(),
	   async: false,
	   success: function( response ) 
	   {
			//alert(response);
			if(response==1)
			{
				alert("User switch successfully.");
				location.href= APPLICATION_URL+"users/all";
				return true;
			}
			else
			{
				alert(response);
				return false;
			}
	   },
	});
});

 var max_fields      = 10; //maximum input boxes allowed
 var wrapper         = "#control"; //Fields wrapper
 var add_button      = "#addcontrol"; //Add button ID
    
 var x = 1; //initlal text box count
jQuery(add_button).click(function(e){ //on add input button click
	 e.preventDefault();
	 if(x < max_fields)
	 { //max input box allowed
		 x++; //text box increment
	     jQuery(wrapper).append('<div style="margin-top:10px;"><input type="text" id="email[]" name="email[]" class="form-control" /><a href="#" class="remove_field"><i class="fa fa-times"></i></a></div>'); //add input box
	 }
});
	    
jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
	e.preventDefault(); 
	jQuery(this).parent('div').remove(); 
	x--;
});


function getstatelist()
{
	jQuery.ajax({
		
		 type: "POST",
         url: APPLICATION_URL+'users/get_state_list/'+jQuery('#country_id').val(),
         data : jQuery('#editprofileform').serialize(),
		   dataType: 'json',
         async: false,
         success: function( response ) 
         {
      	   		console.log(response.data);
        	 	var htm ='';
         		if(response.status == 'Success')         		
         		{
         			htm  = "<label>State:</label>";
         			htm += "<select id='state_id' name='state_id' class='form-control' onchange='getcitylist();'>";
         			
         			for(var i = 0 ; i < response.data.length; i++ )
         			{
         				htm += "<option value='"+response.data[i].id+"'>"+response.data[i].state+"</option>";
         			}
         			htm += "</select>";
         			jQuery('#statelist').html(htm);
         			return true;
         		}
         		else
         		{
					//jQuery('.well').html(response.data).fadeIn('slow');
					return false;
         		}
         },
	});
}

function getcitylist()
{
	jQuery.ajax({
		
		 type: "POST",
         url: APPLICATION_URL+'users/get_city_list/'+jQuery('#state_id').val(),
         data : jQuery('#editprofileform').serialize(),
		   dataType: 'json',
         async: false,
         success: function( response ) 
         {
      	   		console.log(response.data);
        	 	var htm ='';
         		if(response.status == 'Success')         		
         		{
         			htm  = "<label>City:</label>";
         			htm += "<select id='city_id' name='city_id' class='form-control'>";
         			
         			for(var i = 0 ; i < response.data.length; i++ )
         			{
         				htm += "<option value='"+response.data[i].id+"'>"+response.data[i].city+"</option>";
         			}
         			htm += "</select>";
         			jQuery('#citylist').html(htm);
         			return true;
         		}
         		else
         		{
					//jQuery('.well').html(response.data).fadeIn('slow');
					return false;
         		}
         },
	});
}
