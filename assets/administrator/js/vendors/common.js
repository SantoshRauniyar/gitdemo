// JavaScript Document

jQuery(document).ready(function() {
	setTimeout(getNotification(),1000);
});
function getNotification()
{
	//alert("hi");
	jQuery.ajax(
	{
		type: "POST",
   		url: APPLICATION_URL+'administrator/notification/get_New_Notification',
   		data : jQuery('#editprofileform').serialize(),
   		dataType : 'json',
   		async: false,
   		success: function( response ) 
   		{
			//alert(response);
			console.log(response);
			if(response.status == 200)
			{
				if(response.data['count'] == 0)
				{
					jQuery('#badge').html('');
				}
				else
				{
					jQuery('#badge').html(response.data['count']);
				}
				var htm = '';
				for(var i = 0; i < response.data['notification_list'].length; i++)
				{
					htm +="<li><div class='col-md-12'>"+response.data['notification_list'][0].message+"</div></li><li class='divider'></li>";
				}
				jQuery('#notification_dialog').html(htm);
				return true;
			}
			else
			{
				jQuery('#notification_dialog').html(response.Message);
				return false;
			}
	   },
	});
	//getNotification();
}

function change_status(pathurl)
{
/*jQuery('#read_notification').click(function (e) {
	e.preventDefault();*/
	
	jQuery.ajax(
	{
		type: "POST",
   		url: pathurl,
   		data : jQuery('#editprofileform').serialize(),
   		dataType : 'json',
   		async: false,
   		success: function( response ) 
   		{
			if(response.status == 200)
			{
				getNotification();
				return true;
			}
			else
			{
				return false;
			}
		}
	});
//});
}
/*jQuery('#plan_id').change(function () {
	jQuery.ajax(
	{
		type: "POST",
		url: APPLICATION_URL+'index.php/administrator/team/getPlanDetails',
      data : jQuery('#editteamform').serialize(),
		dataType: 'json',
      async: false,
      success: function( response ) 
      {
			console.log(response);
         if(response.status == 'success')
         {
				jQuery('.well').html(response.data.no_of_team).fadeIn('slow');
				return true;
        	}
      	else
      	{
				jQuery('.well').html(response.data.no_of_team).fadeIn('slow');
				return false;
      	}
      },
	});					 
});*/