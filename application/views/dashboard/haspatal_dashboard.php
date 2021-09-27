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
 
    </div>
    <br>
    <br>
    <br>
   <section  id="task_board">
        <div class="container">
            <div class="col-12 titl_card">
                <h3 style="color:white;">Haspatal Dashboard</h3>
            </div>

                
                        <?php if(!empty($wildvalue)){ echo $wildvalue;}?>
                
                
                
            <p><?php if(!empty($zoneDetails)){echo$zoneDetails; } else {?></p>
 
 <div class="pull-right" style="padding:10px;"><button type="button" class="btn btn-primary" style="background-color:#f10a0a;border-color:#f10a0a;" data-toggle="modal" data-target=".bd-example-modal-lg">Change</button>
<br></div><?php } ?><br><div class="text-center" style="margin-left:5%;"><h4>All India Up-to-Date Registration <b><strong style="color:#db4130; "><?php if(!empty($data->indusers)){ echo $data->indusers;}else { echo $data->users;} ?></strong></b></h4></div>
            <div class="row third_cls" id="dashboard">
                <div class="col-md-4 col-lg-4 col-sm-6 left_bg">
                    <img class="bg"  style="height:10%;" src="<?= base_url('assets/dashboard').'/'?>hexagon.png" />
                    <div class="left_bg_div">
                       <span> <?php $status="Total Registration"; if(!empty($status)){ echo$status;}else{echo"Total Registrants";} ?></span>
                        <h2><?=  $data->users ?></h2>
                       
                       
                        <!--Growth calculation Data Start Here-->
                        <?php if(!empty($score)) { ?>
                          <span><?=  $data2->range_name ?></span>
                        <h3><?=  $data2->users ?></h3>
                        Growth  <?php $data->users==0?$data->users=1:''; ?>
                           <?php $us=$data2->users-$data->users/$data->users*100;if($us>0){echo $us;}else{echo "<b class='text-danger'>[".$us."]</b>";} ?>%
                      <?php } ?>
                      <!--Growth calculation Data clsoe Here-->
                      
                      
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 third_innr_crcl" style="float:all;">
                    <div class="row" style="justify-content: space-between;">
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls" >
                           
                                 <a href="<?= base_url('dashboard/business_list').'/11' ?>"><span>Pharmacy</span></a>
                            <h2><?= $data->pharmacy ?></h2>
                            <?php if(!empty($score)) {?>
                              <strong><?= $data->range_name ?></strong>
                              <div>
                                <div class="pull-left"><?= $data->pharmacy ?></div>
                              
                    <div class="pull-right">Growth  <?php $data->pharmacy==0?$data->pharmacy=1:$data->pharmacy; ?>
                           <?php $p=$data2->pharmacy-$data->pharmacy/$data->pharmacy*100;if($p>0){echo $p;}else{echo "<b class='text-danger'>[".abs($p)."]</b>";} ?>%</div>
                            </div><?php } ?>
                            
                                 <?php

                                  if (!empty($approved)) {   ?>
                                  
                                <div class="row">
                                  <div class="col-md-4"><span>Reg</span><span><?= $data->pharmacy ?></span></div>
                                  <div class="col-md-4"><span>Pend</span><span><?= $pending->pharmacy ?></span></div>
                                   <div class="col-md-4"> <span>Apr</span><span><?= $approved->pharmacy ?></span></div>

    
                                      </div>
                              

                                  <?php  }

                              ?>
                            
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls">
                             <a href="<?= base_url('dashboard/business_list').'/12' ?>"><span>Labs</span></a>
                            <h2><?= $data->labs ?></h2>
                            <?php if(!empty($score)) {?>
                              <strong><?= $data->range_name ?></strong>
                              <div>
                                <div class="pull-left"><?= $data->labs ?></div>
                              
                    <div class="pull-right">Growth  <?php $data->labs==0?$data->labs=1:$data->labs; ?>
                           <?php $l=$data2->labs-$data->labs/$data->labs*100;if($l>0){echo $l;}else{echo "<b class='text-danger'>[".abs($l)."]</b>";} ?>%</div>
                            </div><?php } ?>
                            
                                     <?php

                                  if (!empty($approved)) {   ?>
                                  
                                <div class="row">
                                  <div class="col-md-4"><span>Reg</span><span><?= $data->labs ?></span></div>
                                  <div class="col-md-4"><span>Pend</span><span><?= $pending->labs ?></span></div>
                                   <div class="col-md-4"> <span>Apr</span><span><?= $approved->labs ?></span></div>

    
                                      </div>
                              

                                  <?php  }

                              ?>
                            
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org">
                           <a href="<?= base_url('dashboard/business_list').'/13' ?>"><span>Imaging center</span></a>
                            <h2><?=$data->imaging_center?></h2>
                            <?php if(!empty($score)) {?>
                              <strong><?= $data->range_name ?></strong>
                              <div>
                                <div class="pull-left"><?= $data->imaging_center ?></div>
                              
                    <div class="pull-right">Growth  <?php $data->imaging_center==0?$data->imaging_center=1:$data->imaging_center; ?>
                           <?php  $i=$data2->imaging_center-$data->imaging_center/$data->imaging_center*100;if($i>0){echo $i;}else{echo "<b class='text-danger'>[".abs($i)."]</b>";} ?>%</div>
                            </div><?php } ?>
                            
                                 <?php

                                  if (!empty($approved)) {   ?>
                                  
                                <div class="row">
                                  <div class="col-md-4"><span>Reg</span><span><?= $data->imaging_center ?></span></div>
                                  <div class="col-md-4"><span>Pend</span><span><?= $pending->imaging_center ?></span></div>
                                   <div class="col-md-4"> <span>Apr</span><span><?= $approved->imaging_center ?></span></div>

    
                                      </div>
                              

                                  <?php  }

                              ?>
                            
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <div class="row" style="justify-content: space-between;margin-top: 25px;">
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls">
                          <a href="<?= base_url('dashboard/business_list').'/16' ?>"> <span>Therapy Center</span></a>
                            <h2><?= $data->therapy_center ?></h2>
                            <?php if(!empty($score)) {?>
                              <strong><?= $data->range_name ?></strong>
                              <div>
                                <div class="pull-left"><?= $data->therapy_center ?></div>
                              
                    <div class="pull-right">Growth  <?php $data->therapy_center==0?$data->therapy_center=1:$data->therapy_center; ?>
                           <?php  $t=$data2->therapy_center-$data->therapy_center/$data->therapy_center*100;if($t>0){echo $t;}else{echo "<b class='text-danger'>[".abs($t)."]</b>";} ?>%</div>
                            </div><?php } ?>
                            
                            
                                 <?php

                                  if (!empty($approved)) {   ?>
                                  
                                <div class="row">
                                  <div class="col-md-4"><span>Reg</span><span><?= $data->therapy_center ?></span></div>
                                  <div class="col-md-4"><span>Pend</span><span><?= $pending->therapy_center ?></span></div>
                                   <div class="col-md-4"> <span>Apr</span><span><?= $approved->therapy_center ?></span></div>

    
                                      </div>
                              

                                  <?php  }

                              ?>
                            
                        </div>
                        <div class="col-sm-1"></div>

                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls">
                             <a href="<?= base_url('dashboard/business_list').'/17' ?>"><span>Counseling</span></a>
                            <h2><?= $data->councelling ?></h2>
                            <?php if(!empty($score)) {?>
                              <strong><?= $data->range_name ?></strong>
                              <div>
                                <div class="pull-left"><?= $data->councelling ?></div>
                              
                    <div class="pull-right">Growth  <?php $data->councelling==0?$data->councelling=1:$data->councelling; ?>
                           <?php  $c=$data2->councelling-$data->councelling/$data->councelling*100;if($c>0){echo $c;}else{echo "<b class='text-danger'>[".abs($c)."]</b>";} ?>%</div>
                            </div><?php } ?>
                            
                              <?php

                                  if (!empty($approved)) {   ?>
                                  
                                <div class="row">
                                  <div class="col-md-4"><span>Reg</span><span><?= $data->councelling ?></span></div>
                                  <div class="col-md-4"><span>Pend</span><span><?= $pending->councelling ?></span></div>
                                   <div class="col-md-4"> <span>Apr</span><span><?= $approved->councelling ?></span></div>

    
                                      </div>
                              

                                  <?php  }

                              ?>
                        </div>
                        <div class="col-sm-1"></div>
                        
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org cmn_cls ygd">
                           <a href="<?= base_url('dashboard/business_list').'/14' ?>">  <span>Home Care</span></a>
                            <h2><?= $data->homecare ?></h2>

                              <?php if(!empty($score)) {?>
                              <strong><?= $data->range_name ?></strong>
                              <div>
                                <div class="pull-left"><?= $data->homecare ?></div>
                              
                    <div class="pull-right">Growth  <?php $data->homecare==0?$data->homecare=1:$data->homecare; ?>
                           <?php  $h=$data2->homecare-$data->homecare/$data->homecare*100; if($h>0){echo $h;}else{echo "<b class='text-danger'>[".abs($h)."]</b>";} ?>%</div>
                            </div><?php } ?>


                            <?php

                                  if (!empty($approved)) {   ?>
                                  
                                <div class="row">
                                  <div class="col-md-4"><span>Reg</span><span><?= $data->homecare ?></span></div>
                                  <div class="col-md-4"><span>Pend</span><span><?= $pending->homecare ?></span></div>
                                   <div class="col-md-4"> <span>Apr</span><span><?= $approved->homecare ?></span></div>

    
                                      </div>
                              

                                  <?php  }

                              ?>

                        </div>
        <div class="col-sm-1"></div>
                    </div>
                    </div>
                    <hr><hr>
                    <div class="row" style="float:all;">
                                  <div class="col-sm-3" >
                            <a href="javascript:void()" class="btn btn info" style="background-color:white;border-color:white;text-decoration:none;color:#f10a0a"  onclick="location.reload()">Refresh</a>
                            </div>
                        <div class="col-sm-3">
                              <?php if(empty($status)){  if(empty($today)){ ?><a class="btn btn-info" style="background-color:white;border-color:white;text-decoration:none;color:#f10a0a;" href="<?= base_url('dashboard/view_haspatal_dashboard/today') ?>">Today's Data</a><?php } else{ ?><a class="btn btn info blu" href="<?= base_url('dashboard/view_haspatal_dashboard') ?>">Total Data</a><?php }
                              }
                              ?>
                              
                              
                              
                              <?php if(!empty($status)){  if(empty($today)){ ?><a class="btn btn-info" style="background-color:white;border-color:white;text-decoration:none;color:#f10a0a;" href="<?= base_url('dashboard/view_haspatal_dashboard/all') ?>">Total Data</a><?php } else{ ?><a class="btn btn info blu" href="<?= base_url('dashboard/view_haspatal_dashboard') ?>">Today's Data</a><?php }
                              }
                              ?>
                            </div>
                            <?php  if($this->session->userdata('user_role')!=19){ ?>
                    
                               <a href="javascript:void()" class="btn btn-primary bgc" style="background-color:white;border-color:white;text-decoration:none;color:#f10a0a" data-toggle="modal" data-target=".bd-compare-modal-lg">Compare</a>
                            <?php } ?>
                            
                            
                            </div>
                
            </div>
        
                                  
                            
                            
        </div>
    </section>
    
    
    
                  
    
    
    
    
    
    
    
    
    
    
    
   <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">

    <div class="modal-content">
      <div class="modal-header" style="background-color:#ef0f0f;color:white">
        <h5 class="modal-title" id="exampleModalLabel">Program <?= var_dump($st) ?> dashboard</h5>
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
            <div class="row">
                <div class="col-sm-6">
                <label>Start Date</label>
                <input type="date" class="from-control" name="start_date">
            </div>
            <div class="col-sm-6">
                <label>End Date</label>
                <input type="date" class="from-control" name="end_date">
            </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-3">
                    <select name="country" class="form-control country">
                        <option>Select Country</option>
                        <option value="3" selected>India</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="state" <?= $st?"":"disabled=''"; ?> class="form-control state" id="statelist">
                        <option>Select State</option>
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
                        <option>Select City Zone</option>
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
                    <select name="pincode" class="form-control" id="pincode_list">
                        <option>Select Pincode</option>
                        <?php  if(!empty($plist))
                        {
                        foreach ($plist as $value) {
                      ?>
                        <option value="<?= $value->id ?>"><?= $value->pincode ?></option>
                      <?php } }?>
                    </select>
                </div>
            <div class="col-md-6">
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