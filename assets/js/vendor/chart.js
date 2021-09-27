//Flot Pie Chart

jQuery(function() {

    var data = [{
        label: "Completed task",
        data: 20
    }, {
        label: "Not Completed task",
        data: 30
    }];

    var plotObj = jQuery.plot(("#flot-pie-chart"), data, {
        series: {
            pie: {
                show: true
            }
        },
        grid: {
            hoverable: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });
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
	   			var htm = "<option value=''>Teams</option>";
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
                //<a href="<?php echo base_url('team/team_configuration');?>" class="pull-left" ><img src="<?php echo base_url('assets/administrator/icons/cog.png');?>" title="Configure Team"></a>
                
				//jQuery('#teamdropdown').html(htm).fadeIn('slow');
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
	   			var htm = "<li>"+response.message+"</li>";
				jQuery('#teamdropdown').attr('disabled','disabled');
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
/*jQuery('.form_date').datetimepicker({

    //language:  'fr',

    weekStart: 1,

    todayBtn:  1,

	autoclose: 1,

	todayHighlight: 1,

	startView: 2,

	minView: 2,

	forceParse: 0

});*/

jQuery('#user_id').change(function () {
	//alert(jQuery('#user_id').val());
	jQuery.ajax(
	{
	   type: "POST",
	   url: APPLICATION_URL+'chart/getchartdata/'+jQuery('#user_id').val(),
	   data : jQuery('#chartform').serialize(),
	   dataType: 'json',
	   async: false,
	   success: function( response ) 
	   {
		   console.log(response);
		   if(response.status == "success")
		   {
			   var res1 =parseInt(response.data['Total_Completed_Task']);
			   var res2 =parseInt(response.data['Total_Not_Completed_Task']);
			   
			   if(res1 > 0 && res2 > 0)
			   {
				   var data1 = [{
				        label: "Total_Completed_Task",
				        data: res1
				    }, {
				        label: "Total_Not_Completed_Task",
				        data: res2
				    }];
			   }
			   else if(res1 <= 0 && res2 > 0)
			   {
				   jQuery('#flot-pie-chart').html("No task is completed yet.");
					  return true;
			   }
			   else if(res1 > 0 && res2 <= 0)
			   {
				   jQuery('#flot-pie-chart').html("All Task is Completed.");
					  return true;
			   }
			   else if(res1 <= 0 && res2 <= 0)
			   {
				  jQuery('#flot-pie-chart').html("No data us available for generating task.");
				  return true;
			   }
			   
			   var plotObj = jQuery.plot(("#flot-pie-chart"), data1, {
			        series: {
			            pie: {
			                show: true
			            }
			        },
			        grid: {
			            hoverable: true
			        },
			        tooltip: true,
			        tooltipOpts: {
			            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
			            shifts: {
			                x: 20,
			                y: 0
			            },
			            defaultTheme: false
			        }
			    });
		   }
		   else
		   {
			   
		   }
	   },
	});
});


