// JavaScript Document
 $('.form_date').datetimepicker({
        //language:  'fr',
		format: "dd MM yyyy - hh:ii:ss",
		pickDate: true,                 //en/disables the date picker
        pickTime: true,
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
		showMeridian:true
    });
 function getcheckedvalue()
 {
		 if(document.getElementById('task_type').value == 1)
		 {
			 document.getElementById('milestone_id').style.display = "block";
		 }
		 if(document.getElementById('task_type').value == 2)
		 {
			 document.getElementById('milestone_id').style.display = "none";
		 }
 }
 
function changePriority(id)
{
	 jQuery('#task_priority').val();
	 jQuery.ajax(
			 {
	           type: "POST",
	           url: APPLICATION_URL+'task/changePriority/'+id+"/"+jQuery('#task_priority').val(),
	           data : jQuery('#Tasklistform').serialize(),
			   dataType : 'json',
	           async: false,
	           success: function( response ) 
	           {
	           		if(response.status == 200)
	           		{
	           			jQuery(".well").css("display","block");
						jQuery(".well").html("<font color=Green>"+response.message+"</font>");
						return true;
	           		}
	           },
	      	});
 }

function changeStatus(id)
{
	 jQuery('#status').val();
	 jQuery.ajax(
			 {
	           type: "POST",
	           url: APPLICATION_URL+'task/changeStatus/'+id+"/"+jQuery('#status').val(),
	           data : jQuery('#Tasklistform').serialize(),
			   dataType : 'json',
	           async: false,
	           success: function( response ) 
	           {
	           		if(response.status == 200)
	           		{
	           			jQuery(".well").css("display","block");
						jQuery(".well").html("<font color=Green>"+response.message+"</font>");
						return true;
	           		}
	           },
	      	});
 }
 
jQuery('#task_mode').change(function () {
	if(jQuery(this).val() == 2)
	{
		jQuery('#parenttasklist').show();
	}
	else
	{
		jQuery('#parenttasklist').hide();
	}
});
 
jQuery('#recurrence').change(function () {
	if(jQuery(this).val() == 1)
	{
		jQuery('#recurrence_start_date').show();
		jQuery('#recurrence_end_date').show();
		jQuery('#no_of_recurrence_time').show();
		jQuery('#frequency').show();
	}
	else
	{
		jQuery('#recurrence_start_date').hide();
		jQuery('#recurrence_end_date').hide();
		jQuery('#no_of_recurrence_time').hide();
		jQuery('#frequency').hide();
	}
});

jQuery('#frequency_type').change(function () {
	if(jQuery(this).val() == 1)
	{
		jQuery('#fix_recurrence_time').show();
		jQuery('#variable_recurrence_time').hide();
	}
	else if(jQuery(this).val() == 2)
	{
		var count = jQuery('#no_of_recurrence').val();
		var content = "";
		for(var i=1 ; i<=count ; i++)
		{
			content += "<div class='form-group col-md-4'><lable>Date:</lable><strong><font color='red'>*</font></strong><input class='form-control' id='date[]' name='date[]'></div><div class='form-group col-md-4'><lable>Creation Time:<strong><font color='red'>*</font></strong></lable><input class='form-control' id='creation_time[]' name='creation_time[]'></div><div class='form-group col-md-4'><lable>Finish Time:<strong><font color='red'>*</font></strong></lable><input class='form-control' id='finish_time[]' name='finish_time[]'></div><div class='clearfix'></div>";
		}
		jQuery('#variable_recurrence_time').html(content);
		jQuery('#fix_recurrence_time').hide();
		jQuery('#variable_recurrence_time').show();
	}
	else
	{
		jQuery('#fix_recurrence_time').hide();
		jQuery('#variable_recurrence_time').hide();
	}
});

jQuery('#project_id').change(function () {
	if(jQuery(this).val() != '')
	{
		jQuery.ajax(
		{
   		type: "POST",
      	url: APPLICATION_URL+'task/getMilestoneByProjectId/'+jQuery(this).val(),
      	data : jQuery('#editprofileform').serialize(),
			dataType : 'json',
      	async: false,
      	success: function( response ) 
      	{
      		//alert(response);
				//console.log(response);
         	if(response.status == 200)
         	{
					var content = "<label>Mailestone:<strong><font color='red'>*</font></strong></label><select id='milestone_id' name='milestone_id' class='form-control'><option>Select Milestone</option>";
					for (var i = 0 ; i < response.data.milestone_list.length ; i++)
					{	
						content += "<option value='"+response.data.milestone_list[i].id+"'>"+response.data.milestone_list[i].milestone_title+"</option>";
					}
					content += "</select>";
					//console.log(content);
					jQuery('#milestone').html(content);
					return true;
         	}
         	else
         	{
         		var content = "<label>Mailestone:<strong><font color='red'>*</font></strong></label><select id='milestone_id' name='milestone_id' class='form-control'><option>Select Milestone</option>";
					jQuery('#milestone').html(content);
					return false;
         	}
      	},
		});
	}
	else
	{
		var content = "<label>Mailestone:<strong><font color='red'>*</font></strong></label><select id='milestone_id' name='milestone_id' class='form-control'><option>Select Milestone</option>";
		jQuery('#milestone').html(content);
		return false;
	}
});

jQuery('#task_type').change(function () {
	if(jQuery(this).val() == 1)
	{
		jQuery('#projects').show().fadeIn('slow');
		jQuery('#milestone').show().fadeIn('slow');
	}
	else
	{
		jQuery('#projects').hide().fadeOut('slow');
		jQuery('#milestone').hide().fadeOut('slow');
	}
});

jQuery('#budget').keypress(function (e){

	var charCode = (e.which) ? e.which : event.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) 
    {
        return false;
    } 
    else 
    {
        return true;
    }     
});

function checkUncheck()
{
	var x='Tasklistform';

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
	var x='Tasklistform';
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

function delete_tasks(submiturl,formname,confirmmessage,successmessage)
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

jQuery('#multidelete').click(function (e) {
	e.preventDefault();
	var i=0;
	var x='Tasklistform';
	for(count=0 ; count < document.getElementById(x).length ; count++)
	{
		if(document.forms[x][count].type == "checkbox" && document.forms[x][count].checked == true)
		{
			i++;
		}
	}
	if(i > 0) 
	{
		if(confirm("Are you sure you want to delete these tasks ?"))
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

function get_discussion(id,user_id)
{
	var str = id.split("/");
	jQuery('#task_id').attr('value',str[str.length-1]);
	jQuery.ajax(
	{
		   type: "POST",
		   url: id,
		   data : jQuery('#Tasklistform').serialize(),
		   dataType : 'json',
		   async: false,
		   success: function( response ) 
		   {
			    console.log(response);
		   		if(response.status == "success")
		   		{
		   			var htm = "<ul class='chat'>"; 
		   			for(var i = 0 ; i < response.data.length ; i++)
		   			{
		   				if(response.data[i].user_id == user_id)
		   				{
		   					htm +="<li class='right clearfix'>"+
						  	  	"<span class='chat-img pull-right'>"+
						  	  		"<img src='"+APPLICATION_URL+"assets/upload/users/"+response.data[i].user_image+"' height='50' width='50' alt='User Avatar' class='img-circle' />" +
						  	  	"</span>" +
						  	  	"<div class='chat-body clearfix'>" +
						  	  		"<div class='header'>" +
						  	  			"<small class='text-muted'>" +
						  	  				"<i class='fa fa-clock-o fa-fw'></i>" +
						  	  			"</small>" +
						  	  			"<strong class='pull-right primary-font'>"+response.data[i].user_name+"</strong>" +
						  	  		"</div>" +
						  	  		"<p>"+response.data[i].comment+"</p>" +
						  	  	"</div>" +
						  	  "</li>";
		   				}
		   				else
		   				{	
		   					htm += "<li class='left clearfix'>" +
								"<span class='chat-img pull-left'>" +
									"<img src='"+APPLICATION_URL+"assets/upload/users/"+response.data[i].user_image+"' alt='User Avatar' class='img-circle' height='50' width='50' />" +
								"</span>" +
								"<div class='chat-body clearfix'>" +
									"<div class='header'>" +
										"<strong class='primary-font'>"+response.data[i].user_name+"</strong>" +
										"<small class='pull-right text-muted'>" +
											"<i class='fa fa-clock-o fa-fw'></i>" +
										"</small>" +
									"</div>" +
									"<div class='clearfix'></div>" +
									"<p>"+response.data[i].comment+"</p>" +
								"</div>" +
							"</li>";
		   				}
		   			}
		   			
		   			htm += "</ul>";
		   			jQuery('.modal-body').html(htm).fadeIn(5000);
					return true;
		   		}
		   		else
		   		{
		   			jQuery('.modal-body').html(response.message);
					return false;
		   		}
		   },
      });
}


jQuery('#send').click(function (e) {
	
	e.preventDefault();
	var Task_ID = jQuery(this).parent().parent().find('#task_id').val();
	//var comment = jQuery(this).parent().parent().find('#comment').val();
	jQuery.ajax(
	{
	   type: "POST",
	   url: APPLICATION_URL+"task/do_add_comment/",
	   data : jQuery('#Tasklistform').serialize(),
	   dataType : 'json',
	   async: false,
	   success: function( response ) 
	   {
		   if(response.status == "success")
		   {
			   
			   get_discussion(APPLICATION_URL+'task/get_task_discussion/'+Task_ID);
				return true;
		   }
		   else
		   {	
			   return false;
		   }
	   },
	});
});