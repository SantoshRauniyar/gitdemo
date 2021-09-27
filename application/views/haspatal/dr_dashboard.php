 <?php  
 
 $cit=$dis=$st=$drdata['st'];
 
 ?>
 <script type="text/javascript">
 setInterval(function(){ location.reload() }, 300000);

   $(document).ready(function(){

         $('.country').change(function()
                    {
                               
                             
                               var country=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!country)) {alert("Please Select Country ")}
                              else{
                           //alert(country);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_stateByCountryId',
                                    method:'get',
                                    data:{country:country},

                                    success:function(state)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#statelist').html(state);
                                        $('#district_list').html('<option>Select District</option>');
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(state)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })
                        
                        
                        //Get filter data
                        $('.apply').click(function()
                    {
                               
                             //return  alert($('.btype').val());
                             var  formData={
                                 btype:$('.btype').val(),
                                 end_date:$('.end_date').val(),
                                 start_date:$('.start_date').val(),
                                 country:$('.country').val(),
                                 state:$('.state').val(),
                                 district:$('.district').val(),
                                 city:$('.city').val(),
                                 pincode:$('.pincode').val()
                                 
                                 
                             }
                                formData.end_date===''?$('#validate_end_date').html('<span class="text-danger">End Date Required</span>'):$('#validate_end_date').html('');
                                formData.start_date===''?$('#validate_start_date').html('<span class="text-danger">Start Date Required</span>'):$('#validate_end_date').html('');
                               
                                formData.country===''?$('#validate_country').html('<span class="text-danger">Country Required</span>'):$('#validate_country').html('');
                                formData.state===''?$('#validate_state').html('<span class="text-danger">State Required</span>'):$('#validate_state').html('');
                               
                                formData.district===''?$('#validate_district').html('<span class="text-danger">District Required</span>'):$('#validate_district').html('');
                                formData.city===''?$('#validate_city').html('<span class="text-danger">City Required</span>'):$('#validate_city').html('');
                                formData.pincode===''?$('#validate_pincode').html('<span class="text-danger">Pincode Required</span>'):$('#validate_pincode').html('');
                               
                              console.log(formData);
                                    if(formData.country==='' || formData.state==='' || formData.end_date==='' || formData.start_date==='' || formData.district==='' || formData.pincode==='' || formData.city==='')
                                    {
                                       return  alert('Please Complete All Details');
                                    }
                                
                                
                             
                            
                            
                               $.ajax({

                                    url:'<?= base_url() ?>haspatal_registers/countBusiness',
                                    dataType:'json',
                                    method:'post',
                                    data:formData,

                                    success:function(response)
                                    {
                                        //alert(response.start_date);
                                      $('#today').html(response.data.today);
                                      $('#year').html(response.data.year);
                                      $('#yesterday').html(response.data.yesterday);
                                      $('#fortnight').html(response.data.fortnight);
                                      $('#week').html(response.data.week);
                                      $('#month').html(response.data.month);
                                     $('#total').html(response.data.total);
                                     $('#successmessage').html('<div class="alert alert-success" >Close the Modal and Check Searched Data</div>');
                                      console.log(response)   
                                         
                                    },
                                   error:function(response)
                                    {
                                        alert('error');
                                        $('#successmessage').html('<div class="alert alert-danger" >something got error</div>');
                                        console.log(response);
                                    }


                        })
                        
                        })


                  $('.state').change(function()
                    {
                               
                             
                               var state=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!state)) {alert("Please Select State ")}
                              else{
                        //   alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_districtByStateId',
                                    method:'get',
                                    data:{state:state},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#district_list').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })
                   $('.district').change(function()
                    {
                               
                             
                               var dist=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!dist)) {alert("Please Select State ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_cityByDistrict',
                                    method:'get',
                                    data:{dist:dist},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#city_list').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })



                    $('.comp_country1').change(function()
                    {
                               
                             
                               var comp_country1=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!comp_country1)) {alert("Please Select Country ")}
                              else{
                           //alert(comp_country1);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_stateByCountryId',
                                    method:'get',
                                    data:{country:comp_country1},

                                    success:function(comp_state1)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_statelist1').html(comp_state1);
                                        $('#comp_district_list1').html('<option>Select District</option>');
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(comp_state1)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })



                    $('.comp_state1').change(function()
                    {
                               
                             
                               var comp_state1=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!comp_state1)) {alert("Please Select State ")}
                              else{
                         //  alert(comp_state1);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_districtByStateId',
                                    method:'get',
                                    data:{state:comp_state1},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_district_list1').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })


                        $('.comp_district1').change(function()
                    {
                               
                             
                               var dist=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!dist)) {alert("Please Select State ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_cityByDistrict',
                                    method:'get',
                                    data:{dist:dist},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_city_list1').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })






                          $('.comp_country2').change(function()
                    {
                               
                             
                               var comp_country2=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!comp_country2)) {alert("Please Select Country ")}
                              else{
                           //alert(comp_country1);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_stateByCountryId',
                                    method:'get',
                                    data:{country:comp_country2},

                                    success:function(comp_state2)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_statelist2').html(comp_state2);
                                        $('#comp_district_list2').html('<option>Select District</option>');
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(comp_state2)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })



                    $('.comp_state2').change(function()
                    {
                               
                             
                               var comp_state2=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!comp_state2)) {alert("Please Select State ")}
                              else{
                        //   alert(comp_state2);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_districtByStateId',
                                    method:'get',
                                    data:{state:comp_state2},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_district_list2').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })


                        $('.comp_district2').change(function()
                    {
                               
                             
                               var dist=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!dist)) {alert("Please Select State ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_cityByDistrict',
                                    method:'get',
                                    data:{dist:dist},

                                    success:function(district)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#comp_city_list2').html(district);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(district)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })


                        $('.rangesize1').mouseleave(function(){


                           
                              var l=$(this).val();
                              if (l.length>25)
                               {
                                return alert("Range label should be less than 25 Character");
                                  }
                                   

                        })



                          $('.rangesize2').mouseleave(function(){


                           
                              var l=$(this).val();
                              if (l.length>25)
                               {
                                return alert("Range label should be less than 25 Character");
                                  }
                                   

                        })
                $('.city').change(function()
                    {
                               
                             
                               var city=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!city)) {alert("Please Select City ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_pincodeByCity',
                                    method:'get',
                                    data:{city:city},

                                    success:function(pincode)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#pincode_list').html(pincode);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(pincode)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })


                     $('.city1').change(function()
                    {
                               
                             
                               var city=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!city)) {alert("Please Select City ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_pincodeByCity',
                                    method:'get',
                                    data:{city:city},

                                    success:function(pincode)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#pincode_list1').html(pincode);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(pincode)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })
                       $('.city2').change(function()
                    {
                               
                             
                               var city=$(this).val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!city)) {alert("Please Select City ")}
                              else{
                           //alert(state);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>users/get_pincodeByCity',
                                    method:'get',
                                    data:{city:city},

                                    success:function(pincode)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#pincode_list2').html(pincode);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(pincode)
                                    {
                                        alert('error occurs');
                                    }


                        })
                           } 


                        })

       })

</script>
  <style type="text/css">
      /* Full height */
  .bg{height:50%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

  </style>
 
  <br>
  <br>
  <br>
      
  </div>
   <section  id="task_board">
        <div class="container">
            <div class="col-12 titl_card">
                <h3 style="color:white;"> <?= $drdata['heading']?>   Dashboard</h3>
            </div>
            <input type="hidden" name="btype" class="btype" value="<?php  if(!empty($drdata['btype'])){ echo $drdata['btype'];} ?>">

                <div style="height:50px"></div>
            <p><?php if(!empty($zoneDetails)){echo$zoneDetails; } else {?></p>
 
 <div class="pull-right" style="padding:10px;"><button type="button" style="background-color:#f10a0a;border-color:#f10a0a;" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Change</button>
</div><?php } ?>
            <div class="row third_cls" id="dashboard">
                <div class="col-md-4 col-lg-4 col-sm-6 left_bg">
                    <img class="bg"  style="height:10%;" src="<?= base_url('assets/dashboard').'/'?>hexagon.png" />
                    <div class="left_bg_div">
                        <h5>Total</h5>
                       <h2 id="total"><?=  (int)$drdata['total'] ?></h2>
                       
                                            <!--Growth calculation Data clsoe Here-->
                      
                      
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 third_innr_crcl" style="float:all;">
                    <div class="row" style="justify-content: space-between;">
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls" >
                           
                                 <a href="<?= base_url('haspatal_registers/service_list/yesterdaylist/'.$drdata['link']) ?>"><span><b>Yesterday</b></span></a>
                           <h2 id="yesterday"><?= (int)$drdata['yesterday'] ?></h2>
                            
                            
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls" >
                             <a href="<?= base_url('haspatal_registers/service_list/todaylist/'.$drdata['link']) ?>"><span><b>Today</b></span></a>
                            <h2 id="today"><?= (int)$drdata['today'] ?></h2>
                             
                        </div>
                        
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls" >
                             <a href="<?= base_url('haspatal_registers/service_list/weeklist/'.$drdata['link']) ?>"><span><b>This Week</b></span></a>
                            <h2 id="week"><?= (int)$drdata['week'] ?></h2>
                             
                        </div>
        
                    </div>
                    <br>
                    <br>
                    <div class="row" style="justify-content: space-between;">
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls" >
                           
                                 <a href="<?= base_url('haspatal_registers/service_list/fortnightlist/'.$drdata['link']) ?>"><span><b>This Fortnight</b></span></a>
                           <h2 id="fortnight"><?= (int)$drdata['fortnight'] ?></h2>
                            
                            
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls" >
                             <a href="<?= base_url('haspatal_registers/service_list/monthlist/'.$drdata['link']) ?>"><span><b>This Month</b></span></a>
                            <h2 id="month"><?= (int)$drdata['month'] ?></h2>
                             
                        </div>
                        
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls" >
                             <a href="<?= base_url('haspatal_registers/service_list/yearlist/'.$drdata['link']) ?>"><span><b>This Year</b></span></a>
                            <h2 id="year"><?= (int)$drdata['year'] ?></h2>
                             
                        </div>
        
                    </div>
                    

                </div>
            </div>
            <br>
                                 
                            <?php  if($this->session->userdata('user_role')!=19){ ?>
                         <div class="col-sm-12 col-md-3 col-lg-3">
                               <button type="button" class="btn btn-primary"style="background-color:#f10a0a;border-color:#f10a0a;"  data-toggle="modal" data-target=".bd-compare-modal-lg">Compare</button>
                            </div><?php } ?>
                            
                            <div class="col-sm-12 col-md-3 col-lg-3">
                                <a class="btn btn info blu" href="#" style="background-color:#f10a0a;border-color:#f10a0a;color:white;">Chart</a>
                            </div>
                            
                            
        </div>
    </section>
    
    
    
                  
    
    
    
    
    
    
    
    
    
    
    
   <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header" style="background-color:#ef0f0f;color:white">
        <h5 class="modal-title" id="exampleModalLabel"><?= $drdata['heading'] ?></h5>
        <button type="button" class="close" style="background-color:white;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
        <form class="form-group" method="post" action="<?=base_url('dashboard/filter_byRange_dashboard')?>">
           <div class="row">
               <h3><b></b>Change Dashboard Data Range</b></h3>
           </div>
           
                       <div id="successmessage"></div>
            <div class="row">
                <div class="col-sm-6">
                <label>Start Date</label>
                <span id="validate_start_date"></span>
                <input type="date" class="form-control start_date" value="" name="start_date">
            </div>
            <div class="col-sm-6">
                <label>End Date</label>
                <span id="validate_end_date"></span>
                
                <input type="date" class="form-control end_date" name="end_date">
            </div>
            </div>

            <br><br>
            <div class="row">
                <div class="col-md-3">
                    <span id="validate_country"></span>
                    <select name="country" class="form-control country">
                        <option value="">Select Country</option>
                        <option value="3">India</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <span id="validate_state"></span>
                    <select name="state" <?= $st?"":"disabled=''"; ?> class="form-control state" id="statelist">
                        <option value="">Select State</option>
                        <?php
                     echo $s=$st?" ":"<option value='$stateData->id' selected>$stateData->state</option>";
                            foreach ($full_list as $key => $value) {
                          ?>
                          <option value="<?=$value->id ?>"><?= $value->state ?></option>
                          <?php
                            }
                        ?>
                    </select>
                </div><div class="col-md-3">
                    <span id="validate_district"></span>
                    <select name="district" <?= $dis?"":"disabled=''"; ?> class="form-control district" id="district_list">
                      <?php  
                            echo $s=$dis?" ":"<option value='$districtData->id' selected>$districtData->district_name</option>";
                          ?>
                           <?php
                        if(!empty($dlist))
                        {
                        foreach ($dlist as $value) {
                      ?>
                        <option value="<?= $value->id ?>"><?= $value->district_name ?></option>
                      <?php } }?>
                    </select>
                </div><div class="col-md-3">
                    <span id="validate_city"></span>
                    <select name="city" <?= $dis?"":"disabled=''"; ?> class="form-control city" id="city_list">
                        <option>Select City</option>
                        <?php
                        echo $s=$cit?" ":"<option value='$cityData->id' selected>$cityData->city</option>";
                        if(!empty($clist))
                        {
                        foreach ($clist as $value) {
                      ?>
                        <option value="<?= $value->id ?>"><?= $value->city ?></option>
                      <?php } }?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <?php  if($this->session->userdata('user_role')==19) { ?>
                <div class="col-md-3">
                    <select name="city_zone" class="form-control" id="cz_list">
                        <option value="">Select City Zone</option>
                        <?php if(!empty($czlist))
                        {
                        foreach ($czlist as $value) {
                      ?>
                        <option value="<?= $value->id ?>"><?= $value->city_zone ?></option>
                      <?php } }?>
                    </select>
                </div>
                <?php } ?>
                <div class="col-md-3">
                    <span id="validate_pincode"></span>
                    <select name="pincode" class="form-control pincode" id="pincode_list">
                        <option value="">Select Pincode</option>
                        <?php  if(!empty($plist))
                        {
                        foreach ($plist as $value) {
                      ?>
                        <option value="<?= $value->id ?>"><?= $value->pincode ?></option>
                      <?php } }?>
                    </select>
                </div>
            <div class="col-md-6">
                <input class="btn btn-info apply" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f"  value="Apply" type="button"  name="submit">
            </div>
        </div>
        </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!--    Compare Data -->

 <div class="modal fade bd-compare-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header" style="background-color:#ef0f0f;color:white">
        <h5 class="modal-title" id="exampleModalLabel">Program dashboard</h5>
        <button type="button" class="close" style="background-color:white;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
        <form class="form-group" method="post" action="<?= base_url('dashboard/compare_byRange_dashboard')?>">
           <div class="row">
               <h3><b>Change Dashboard Data Range</b></h3>
           </div>
           <br>
           <div class="row">
            <div class="col-md-3"> <label>Base Range Label</label></div>
            <div class="col-md-9">
              <div class="form-group">
                  <input type="text" name="range_label1" class="form-control rangesize1">
             </div>
           </div>
            <div class="row">
                <div class="col-sm-6">
                <label>Start Date</label>
                <input type="date" class="from-control" name="start_date1">
            </div>
            <div class="col-sm-6">
                <label>End Date</label>
                <input type="date" class="from-control" name="end_date1">
            </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-2">
                    <select name="comp_country1" class="form-control comp_country1">
                        <option>Select Country</option>
                        <option value="3">India</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="comp_state1" class="form-control comp_state1" id="comp_statelist1">
                        <option>Select State</option>
                        
                    </select>
                </div><div class="col-md-3">
                    <select name="comp_district1" class="form-control comp_district1" id="comp_district_list1">
                      <?php  

                          foreach ($dlist as $value) {
                      ?>
                        <option value="<?= $value ?>"><?= $value ?></option>
                      <?php } ?>
                    </select>
                </div><div class="col-md-2">
                    <select name="comp_city1" class="form-control city1" id="comp_city_list1">
                        <option>Select City</option>
                    </select>
                </div>
            
            
            
                <div class="col-md-2">
                    <select name="comp_pincode1" class="form-control" id="pincode_list1">
                        <option>Select Pincode</option>
                       
                    </select>
                </div>

</div>
    <hr style="color:black;height:10%;">

                 <br>
           <div class="row">
            <div class="col-md-3"> <label>Compare Range Label </label></div>
            <div class="col-md-9">
              <div class="form-group">
                  <input type="text" name="range_label2" class="form-control rangesize2">
             </div>
           </div>
            <div class="row">
                <div class="col-sm-6">
                <label>Start Date</label>
                <input type="date" class="from-control" name="start_date2">
            </div>
            <div class="col-sm-6">
                <label>End Date</label>
                <input type="date" class="from-control" name="end_date2">
            </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-2">
                    <select name="comp_country2" class="form-control comp_country2">
                        <option>Select Country</option>
                        <option value="3">India</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="comp_state2" class="form-control comp_state2" id="comp_statelist2">
                        <option>Select State</option>
                        
                    </select>
                </div><div class="col-md-3">
                    <select name="comp_district2" class="form-control comp_district2" id="comp_district_list2">
                      <?php  

                          foreach ($dlist as $value) {
                      ?>
                        <option value="<?= $value ?>"><?= $value ?></option>
                      <?php } ?>
                    </select>
                </div><div class="col-md-2">
                    <select name="comp_city2" class="form-control city2" id="comp_city_list2">
                        <option>Select City</option>
                    </select>
                </div>
            
            
            
                <div class="col-md-2">
                    <select name="comp_pincode2" class="form-control" id="pincode_list2">
                        <option>Select Pincode</option>
                        
                    </select>
                </div>
              </div>
              <br>
            <div class="text-center">
                <input class="btn btn-info" style="color:white;background-color:#ef0f0f;border-color:#ef0f0f" type="submit" name="submit">
            </div>
        </div>
        </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
