 
    $(document).ready(function()
    {
         var lang="http://localhost/kizaku";
        //here get sction if dept has section otherwise it will be return unit 
                               $('.dept').change(function()
                    {
                               
                              var did=$(this).val();
                             // var dname=$(this).attr('dept');
                             //alert(did);
                              

                               $.ajax({

                                    url:lang+'/section/sectionbydept',
                                    method:'get',
                                    data:{did:did},

                                    success:function(unit)
                                    {
                                       // alert(unit);
                                           // id='#'+show;
                                        $('#section').html(unit);
                                    
                                         console.log(unit);
                                         
                                    },
                                   error:function(unit)
                                    {
                                        alert('error occurs');
                                    }


                        });
                            


                        });
                        
                        
                        
                        //all unit by section
                        
                               $('.sec').change(function()
                    {
                               
                              var sid=$('#getsec').val();
                             // var dname=$(this).attr('dept');
                             
                             

                               $.ajax({

                                    url:lang+'/unit/unitbysec',
                                    method:'get',
                                    data:{sid:sid},

                                    success:function(section)
                                    {
                                        $('#unit').html(section);
                                         console.log(section);
                                    },
                                   error:function(section)
                                    {
                                        alert('error occurs');
                                    }


                        });
                            


                        });
                        
                //Notification 
                setTimeout(function() {
                            var link = document.getElementById('notify');
                           // alert(link);
                            if(link) {
                                link.click();
                            }
                        //1-second delay
                            
                        }, 1000);
                    
                    
                                
                                        $('#notify').click(function(){


                                               // alert('fired');

                                                $.ajax({

                                                    url:lang+'/Notification/set_notification',
                                                    method:'get',
                                                    dataType:'json',
                                                    data:{set:true},
                                                    success:function(response){
                                                        //alert(response);
                                                        console.log(response.data);
                                                        $('#noti').html(response.message);
                                                       
                                                        
                                                         let wholeArray = Object.keys(response).map(key => response[key]);
                                                         let realdata=wholeArray[0]  
                                                         //console.log(realdata[0]['id']);
                                                         //var valueresponse='';
                                                        var valueresponse='';
                                                         for(i=0;i<realdata.length;i++)
                                                         {
                                                             var read=realdata[i]['read_status']==1?'low':'';
     valueresponse+="<div class='alert alert-success reminded' id='"+realdata[i]['id']+"' class='"+read+"' ><a href='"+lang+'/'+realdata[i]['link']+"'>"+realdata[i]['message']+"</a><div class='badge badge-info pull-right'>"+realdata[i]['date'] +"</div></div>";
                                                            //console.log(lang+realdata['link']);
                                                            }
                                                        
                                                            $('#viewnoti').html(valueresponse);
                                                         console.log(valueresponse);
                                                    },
                                                    error:function(response){
                                                        console.log(response);
                                                    }
                                                })




                                    });
                                    //onmouse move notification will be read_status=1
                                    $(document).on("mousemove", ".pcart", (event) => {
                                        var pid=$(event.target).attr('id');
                                            // alert(pid);
                                                    if(pid){
                                            $.ajax({

                                                url:lang+'/Notification/read_status',
                                                method:'post',
                                                data:{id:pid},
                                                success:function(response){
                                                    console.log(response);
                                                    $('#noti').html('&nbsp;');
                                                },
                                                error:function(response){
                                                    console.log('error',response);

                                                }
                                            });
                                        }
                                      })

                                    $('.real-time-notification').click(function(){
                                        alert('We are working');
                                        $.ajax({

                                            url:lang+'/Notification/set_notification',
                                            method:'get',
                                            dataType:'json',
                                            data:{set:true},
                                            success:function(response){
                                                //alert(response);
                                                console.log(response.data);
                                                $('#noti').html(response.message);
                                               
                                                
                                                 let wholeArray = Object.keys(response).map(key => response[key]);
                                                 let realdata=wholeArray[0];
                                                 //console.log(realdata[0]['id']);
                                                 //var valueresponse='';
                                                var valueresponse='';
                                                 for(i=0;i<realdata.length;i++)
                                                 {
                                                     var read=realdata[i]['read_status']==1?'low':'';
valueresponse+="<div class='alert alert-success dim pcart' id='"+realdata[i]['id']+"' class='"+read+"' ><a  href='"+lang+'/'+realdata[i]['link']+"'>"+realdata[i]['message']+"</a><div class='badge badge-info pull-right'>"+realdata[i]['date'] +"</div></div>";
                                                    //console.log(lang+realdata['link']);
                                                    }
                                                
                                                    $('#viewnoti').html(valueresponse);
                                                 console.log(valueresponse);
                                            },
                                            error:function(response){
                                                console.log(response);
                                            }
                                        })

                                    });
        
        
    })
 
  