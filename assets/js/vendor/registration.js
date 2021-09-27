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
jQuery('#plan_id').change(function () {
	jQuery.ajax(
	{
   	type: "POST",
      url: APPLICATION_URL+'authentication/getPlanDetails',
      data : jQuery('#editprofileform').serialize(),
		dataType: 'json',
      async: false,
      success: function( response ) 
      {
      	//console.log(response.data);
         if(response.status == 'success')
         {
         	var htm = '<ul>';
           	/*jQuery.each(response.data,function (key,value){
           		htm+=key+"="+value+"<br>";
    			});*/
    			htm+="<li> Account validity till "+response.data.validiti_period+" year.</li>";
    			htm+="<li> Number of teams allowerd are  "+response.data.no_of_team+" .</li>";
    			htm+="<li> Number of users per team allowerd are  "+response.data.no_of_user_in_team+" .</li>";
    			htm+="<li> Number of Groups per team allowerd are  "+response.data.no_of_group+" .</li>";
    			(response.data.is_timezone_allow != '1')?htm+="<li> Multiple Timezone facility is not available.</li>":htm+="<li> Multiple Timezone facility is available.</li>";
    			(response.data.is_currency_allow != '1')?htm+="<li> Multiple Currency facility is not available.</li>":htm+="<li> Multiple Currency facility is available.</li>";
    			(response.data.is_auto_email != '1')?htm+="<li> Auto email facility is not available.</li>":htm+="<li> Auto email facility is available.</li>";
    			(response.data.is_member_leave_allow != '1')?htm+="<li> Member Leave Management facility is not available.</li>":htm+="<li> Member Leave Management facility is available.</li>";
    			(response.data.is_theam_allow != '1')?htm+="<li> Team's Theme facility is not available.</li>":htm+="<li> Team's Theme facility is available.</li>";
    			htm+="</ul>";
    			
				jQuery('#features').html(htm).fadeIn('slow');
				return true;
         }
         else
         {
				jQuery('#features').html(response.data).fadeIn('slow');
				return false;
        	}
		},
	});					 
});


function getstatelist()
{
	jQuery.ajax({
		
		 type: "POST",
         url: APPLICATION_URL+'authentication/get_state_list/'+jQuery('#country_id').val(),
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
         url: APPLICATION_URL+'authentication/get_city_list/'+jQuery('#state_id').val(),
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