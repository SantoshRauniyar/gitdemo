  <script type="text/javascript">
        $(document).ready(function(){

         $('.end_date').mouseleave(function()
                    {
                               
                              var end_date=$(this).val();
                               var start_date=$('#start_date').val();
                              
                             // var dname=$(this).attr('dept');
                             if ((!start_date) && (!end_date)) {alert("Please Select Start Date and end_date ")}
                              else{
                           //alert(did+pid+end_date+start_date);
                              

                               $.ajax({

                                    url:'<?= base_url() ?>unit/getdashboard',
                                    method:'get',
                                    data:{start_date:start_date,end_date:end_date},

                                    success:function(tasklist)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#dashboard').html(tasklist);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(tasklist)
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
  <div class="clearfix" style="height:5%">
      
  </div>
   <section  id="task_board">
        <div class="container">
            <div class="col-12 titl_card">
                <h3>My Task Board</h3>
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
                    <ul class="days_col days_col_jst">
                        <li><input type="date" id="1" class="form-control start_dates" placeholder="Start Date"></li>
                        <li style="margin-right: 0;"><input type="date" id="2" class="form-control end_date" placeholder="Start Date"></li>
                    </ul>
                </div>
            </div>

            <div class="row third_cls" id="dashboard">
                <div class="col-md-4 col-lg-4 col-sm-6 left_bg">
                    <img class="bg" height="20%" style="height:2%;" src="<?= base_url('assets/dashboard').'/'?>hexagon.png" />
                    <div class="left_bg_div">
                        <span>Total Score</span>
                        <h2><?=  $totalscore ?></h2>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 third_innr_crcl" style="float:all;">
                    <div class="row" style="justify-content: space-between;">
                        <div class="col-md-3 col-lg-3 col-sm-12 cmn_cls marg_btm_cls">
                           
                                 <span>Task Assigned</span>
                            <h2><?= $created ?></h2>
                            
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12 cmn_cls org marg_btm_cls">
                             <span>Tasks Opened</span>
                            <h2><?= $opened ?></h2>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12 cmn_cls blu">
                           <span>Tasks Marked Completed</span>
                            <h2><?=$completed?></h2>
                        </div>
                    </div>
                    <div class="row" style="justify-content: space-between;margin-top: 25px;">
                        <div class="col-md-3 col-lg-3 col-sm-12 cmn_cls grn marg_btm_cls">
                           <span>Tasks Got Approved</span>
                            <h2><?= $approved ?></h2>
                        </div>

                        <div class="col-md-3 col-lg-3 col-sm-12 cmn_cls red marg_btm_cls">
                             <span>Tasks Got Rejected</span>
                            <h2><?= $rejected ?></h2>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12 cmn_cls ylw">
                            <span>Tasks Approval Awaited</span>
                            <h2><?= $awaited ?></h2>

                        </div>
                    </div>
                    <div class="row" style="justify-content: space-between;margin-top: 25px;">
                        <div class="col-md-3 col-lg-3 col-sm-12 cmn_cls gray marg_btm_cls">
                           <span>Tasks Under Progress</span>
                            <h2><?= $progress ?></h2>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12 cmn_cls pink marg_btm_cls">
                             <span>Tasks Delayed</span>
                            <h2><?= $delayedcount ?></h2>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12 cmn_cls ygd">
                            <span>Tasks Quality Index</span>
                            <h2>1234</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>