  <script type="text/javascript">
        $(document).ready(function(){

         $('.end_date').mouseleave(function()
                    {
                               
                              var end_date=$(this).val();
                               var start_date=$('#start_date').val();
                               var dy=$('#dy').val();
                               var dt=$('#dashtype').val();
                             //  alert(dt);
                              
                             // var dname=$(this).attr('dept');
                             if ((!start_date) && (!end_date)) {alert("Please Select Start Date and end_date ")}
                              else{
                           //alert(did+pid+end_date+start_date);
                              

                               $.ajax({
                                            
                                    url:dy?'<?= base_url() ?>unit/getdashboard':'<?= base_url() ?>users/userdashboard',   
                                            
                                    method:'get',
                                    data:{start_date:start_date,end_date:end_date,dy:dy,dt:dt},

                                    success:function(tasklist)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#dashboard').html(tasklist);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(tasklist)
                                    {
                                        console.log(tasklist);
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
  <div class="clearfix" style="height:5%">
      
  </div>
   <section  id="task_board">
        <div class="container">
            <div class="col-12 titl_card">
                <h3><?= !empty($heading)?$heading."Dashboard":"Doctor Dashboard" ?></h3>
            </div>

            <div class="row secnd_cls">
                <div class="col-lg-6 col-md-12">
                    <!--<ul class="days_col">
                        <li><a href="">Today</a></li>
                        <li><a href="">Tomorrow</a></li>
                        <li><a href="">This Week</a></li>
                        <li style="margin-right: 0;"><a href="">This Year</a></li>
                    </ul>-->
                </div>
                <div class="col-lg-6 col-md-12">
                    <ul                    class="days_col days_col_jst">
    
                        <li>
                        
                        </li>
                        <li><input type="date" id="1" class="form-control start_dates" placeholder="Start Date"></li>
                        <li style="margin-right: 0;"><input type="date" id="2" class="form-control end_date" placeholder="Start Date"></li>
                    </ul>
                </div>
            </div>

            <div class="row third_cls" id="dashboard">
                <div class="col-md-4 col-lg-4 col-sm-6 left_bg">
                    <img class="bg" height="20%" style="height:2%;" src="<?= base_url('assets/dashboard').'/'?>hexagon.png" />
                    <div class="left_bg_div">
                        <span>Total Registration</span>
                        <h2><?=  $drdata['pending']+$drdata['approved'] ?></h2>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 third_innr_crcl" style="float:all;">
                    <div class="row" style="justify-content: space-between;">
                        <div class="col-md-4 col-lg-4 col-sm-6 cmn_cls marg_btm_cls">
                           <a  style="text-decoration:none" href="<?= base_url('doctor_registers/doctor_list/1') ?>" >
                               <span>Approved Doctor</span>
                            <h2><?= $drdata['approved'] ?></h2>
                           </a>
                                 
                
                            
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-md-4 col-lg-4 col-sm-6 cmn_cls org marg_btm_cls">
                            <a href="<?= base_url('doctor_registers/doctor_list/0') ?>" style="text-decoration:none"><span>Pending Doctor</span>
                            <h2><?= $drdata['pending']?></h2></a> 
                        </div>
                       <!-- <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls blu">
                           <span>Tasks Marked Completed</span>
                            <h2><?="$completed"?></h2>
                        </div>
                    </div>-->
                
                    
                </div>
            </div>
        </div>
    </section>