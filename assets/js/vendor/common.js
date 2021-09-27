// JavaScript Document
jQuery(function(){
	
	jQuery.ajax(
	{
	  	type: "POST",
	  	url: APPLICATION_URL+'team/getteamlist/',
	  	//data : jQuery('#editprofileform').serialize(),
	  	dataType: 'json',
	  	async: false,
	  	success: function( response ) 
	  	{
	    	console.log(response);
	  		if(response.status == 'success')
	  		{
	  			var htm = "";
	  			for(var i = 0 ; i < response.data.length ; i++)
	  			{
	  				if(jQuery("#teamdropdown").val() == '')
	  				{
	  					if(i == 0)
	  					{
	  						htm+="<option value='"+response.data[i].id+"' selected='selected'>"+response.data[i].team_title+"</option>";
	  					}
	  					else
	  					{
	  						htm+="<option value='"+response.data[i].id+"'>"+response.data[i].team_title+"</option>";
	  					}
	  				}
	  				else
	  				{
	  					if(response.data[i].id == jQuery("#teamdropdown").val())
	  					{
	  						htm+="<option value='"+response.data[i].id+"' selected='selected'>"+response.data[i].team_title+"</option>";
	  					}
	  					else
	  					{
	  						htm+="<option value='"+response.data[i].id+"'>"+response.data[i].team_title+"</option>";
	  					}
	  				}
	  				//htm+="<li class='clearfix'><a href='javascript:void{0};' onclick='getSelectedTeam("+response.data[i].id+");' style='float:left;'>"+(i+1)+". "+response.data[i].team_title+"</a><a href='"+APPLICATION_URL+"team/single_team_delete/"+response.data[i].id+"' style='float:right;padding-left:0px !important;'><span class='fa fa-times' style='color:red;'></span></a><a href='"+APPLICATION_URL+"team/edit_team/"+response.data[i].id+"' style='float:right;padding-left:0px !important;'><span class='fa fa-pencil-square-o' style='color:black'></span></a></li>";
	  			}
   			if(jQuery("#teamdropdown").val() == '')
				{
					jQuery('#teamdropdown').html(htm).fadeIn('slow');
					jQuery('#teamdropdown').change();
				}
				else
				{
					jQuery('#teamdropdown').html(htm).fadeIn('slow');
				}
				return true;
	  		}
	  		else
	  		{
	  			//var htm = "<li>"+response.message+"</li>";
				jQuery('#teamdropdown').attr('disabled','disabled');
				return false;
	  		}
	  	},
	});
	
	jQuery.ajax(
	{
	  	type: "POST",
	  	url: APPLICATION_URL+'plan/getPlanList/',
	  	//data : jQuery('#editprofileform').serialize(),
	  	dataType: 'json',
	  	async: false,
	  	success: function( response ) 
	  	{
	    	console.log(response);
	    	//console.log(response.data[3]);
	  		if(response.status == 'success')
	  		{
	  			var htm = "<option value='' selected='selected'>Select Your Plan</option>";
	  			for(var i = 0 ; i < response.data.length ; i++)
	  			{
	  				if(jQuery("#plan_id").val() == '')
	  				{
	  					if(i == 0)
	  					{
	  						htm+="<option value='"+response.data[i].id+"'>"+response.data[i].plan_title+"</option>";
	  					}
	  					else
	  					{
	  						htm+="<option value='"+response.data[i].id+"'>"+response.data[i].plan_title+"</option>";
	  					}
	  				}
	  				else
	  				{
	  					if(response.data[i].id == jQuery("#plan_id").val())
	  					{
	  						htm+="<option value='"+response.data[i].id+"' selected='selected'>"+response.data[i].plan_title+"</option>";
	  					}
	  					else
	  					{
	  						htm+="<option value='"+response.data[i].id+"'>"+response.data[i].plan_title+"</option>";
	  					}
	  				}
	  				//htm+="<li class='clearfix'><a href='javascript:void{0};' onclick='getSelectedTeam("+response.data[i].id+");' style='float:left;'>"+(i+1)+". "+response.data[i].team_title+"</a><a href='"+APPLICATION_URL+"team/single_team_delete/"+response.data[i].id+"' style='float:right;padding-left:0px !important;'><span class='fa fa-times' style='color:red;'></span></a><a href='"+APPLICATION_URL+"team/edit_team/"+response.data[i].id+"' style='float:right;padding-left:0px !important;'><span class='fa fa-pencil-square-o' style='color:black'></span></a></li>";
	  			}
   			if(jQuery("#plan_id").val() == '')
				{
					jQuery('#plan_id').html(htm).fadeIn('slow');
					jQuery('#plan_id').change();
				}
				else
				{
					jQuery('#plan_id').html(htm).fadeIn('slow');
				}
				return true;
	  		}
	  		else
	  		{
	  			var htm = "<li>"+response.message+"</li>";
				jQuery('#plan_id').attr('disabled','disabled');
				return false;
	  		}
	  	},
	});
});

jQuery('#teamdropdown').change(function(){
	var team_id = jQuery(this).val();
	jQuery.ajax(
	{
	   type: "POST",
	   url: APPLICATION_URL+'team/setSelectedTeam/'+team_id,
	   //data : jQuery('#editprofileform').serialize(),
	   dataType: 'json',
	   async: false,
	   success: function( response ) 
	   {
		   if(response.status == 'success')
		   {
			   console.log(response.message);
			   if(response.data.logo_image != '')
			   {
				   jQuery('#team_logo').attr('src',APPLICATION_URL+"assets/upload/team/"+response.data.logo_image);
			   }
			   else
			   {
				   jQuery('#team_logo').attr('src',APPLICATION_URL+"assets/administrator/images/images.jpeg");
			   }
			   
			   jQuery('#teamtitle').html(response.data.team_title);
			   location.reload();
			   return true;
		   }
		   else
		   {
			   console.log(response.message);
			   return false;   
		   }
	   },	   
	});
});

jQuery('#plan_id').change(function() {
	var plan_id = jQuery('#plan_id').val();
	jQuery.ajax(
	{
		type: "POST",
	  	url: APPLICATION_URL+'plan/getPlanDetails/'+plan_id,
	  	//data : jQuery('#editprofileform').serialize(),
	  	dataType: 'json',
	  	async: false,
	  	success: function( response )
	  	{
	  		if(response.status == "success")
	  		{
	  			jQuery(".planDetails").html("<h4 style='text-align:center;'>"+response.data['plan_title']+" "+response.data['validiti_period']+" year<br> Amount= "+response.data['price']+"</h4>");
	  		}
	  	},
	});
});

jQuery('#plan_select').click(function (e) {
	e.preventDefault();
	var plan_id = jQuery('#plan_id').val();
	location.href = APPLICATION_URL+"plan/getPlanDetails/"+plan_id;
	return true;
});