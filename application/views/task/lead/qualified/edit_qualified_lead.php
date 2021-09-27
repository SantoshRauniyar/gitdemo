<script type="text/javascript">
  
  $(document).ready(function(){

      $('#response').hide();


            $('.market_response_post').click(function(){


              $('#response').toggle(500);


            })


            $('.refferal').click(function(){


              $('#response').hide();


            })
            $('.other').click(function(){


              $('#response').hide();


            })

                  $('#action_on_lead').change(function(){
                              var action=$(this).val();
                               var p=$('#checklead').val();
                    //alert(p);



                                if (action==1) {code='Q'}else if (action==2) {code='R';}else if (action==3) {code='Q';} else if (action==4) {code='X';}else if (action==5) {code='H';}


                                  lead_code=p.split('#');

                                        quali_code=lead_code[3]+'-'+code;

                                  $('#lead_id').val(quali_code);


                  })



                  $('#checklead').change(function(){
                    var action=$('#action_on_lead').val();
                    var p=$(this).val();
                    //alert(p);

                                  lead_code=p.split('#');
                                 
                                        if (action==1) {code='Q'}else if (action==2) {code='R';}else if (action==3) {code='Q';} else if (action==4) {code='X';}else if (action==5) {code='H';}


                                 

                                        quali_code=lead_code[3]+'-'+code;

                                  $('#lead_id').val(quali_code);



                        $.ajax({

                                    url:'<?= base_url() ?>task/get_lead',
                                    method:'get',
                                    data:{pid:p},

                                    success:function(data)
                                    {
                                      //  alert(dept);
                                           // id='#'+show;
                                        $('#status').html(data);
                                        // $('.mycartCount').click();
                                         
                                         
                                    },
                                   error:function(dept)
                                    {
                                        alert('error occurs');
                                    }


                        })

                  })


                
                    })


</script>
<style type="text/css">
  .highlight-error {
  border-color: red;
}

</style>
<div style="padding:2%;">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"></h1>
      <br>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#ef0f0f;color:white;">
          <strong>Department Taskboard</strong> 
          <strong class="pull-right"><font color="red">* </font>Fields Required</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
            <?php 
              $this->load->view('common/errors');
            ?>
            <h3><b>Update Lead Qualification</b></h3><br><br>
          <form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('task/do_update_lead_qualified').'/'.$qlead->id?>" enctype="multipart/form-data">
                
                    <div class="form-group">
                            <select class="form-control" name="checklead" id="checklead">
                              <option hidden="" >Select Lead</option>

                                <?php

                                      foreach ($lead as $value) {
                                        
                                        ?>
          <option value="<?= $value->lead_name."#".$value->phone."#".$value->lead_email."#".$value->lead_code ?>"><?= $value->lead_name."-".$value->phone." ".$value->lead_email ?></option>
                                        <?php
                                      }

                                ?>

                            </select>

                    </div>

                    <span id="status"></span>


                    <div class="form-group">

                      <label>Action On This lead</label>
                      <select class="form-control" name="action_on_lead" id="action_on_lead">
                        <option value="1"<?=  $qlead->action_on_lead==1?"selected":""?>>Select & Move to Qualification</option>
                        <option value="2"<?=  $qlead->action_on_lead==2?"selected":""?>>Reject Already Registered</option>
                        <option value="3"<?=  $qlead->action_on_lead==3?"selected":""?>>Edit Form and Qualify</option>
                        <option value="4"<?=  $qlead->action_on_lead==4?"selected":""?>>Reject and Blacklist</option>
                        <option value="5"<?=  $qlead->action_on_lead==5?"selected":""?>>Hold the Laed Info not available clearly</option>
                      </select>
                      <span class=" text-danger"><?= form_error('action_on_lead') ?></span>
                    </div>

                    <div class="form-group">
                      <label>Priority</label>
                      <select class="form-control" name="priority">
                        <option value="1"<?= $qlead->priority=1?"selected":"" ?>>Low</option>
                        <option value="2"<?= $qlead->priority=2?"selected":""?>>Medium</option>
                        <option value="3"<?= $qlead->priority=3?"selected":""?>>High</option>
                        <option value="4"<?= $qlead->priority=4?"selected":""?>>Urgent</option>
                      </select>
                      <span class=" text-danger"><?= form_error('priority') ?></span>
                    </div>

                    <div class="form-group">
                      <label>Assign for Nurture</label>
                      <select class="form-control" name="assign_for">
                        <?php

                        foreach ($dept as $value) {
                      ?>

                              <option value="<?= $value->did.'-',$value->email ?>"<?= $qlead->assigned_for==$value->did?"selected":"" ?>><?= $value->dtitle ?></option>

                      <?php
                        }

                        ?>
                      </select>
                      <span class=" text-danger"><?= form_error('assign_for') ?></span>
                    </div>

                    <div class="form-group">
                      <label>Team Comments</label>
                      <textarea class="form-control" rows="5" name="team_comment"><?= $qlead->team_comment ?></textarea>
                      <span class=" text-danger"><?= form_error('team_comment') ?></span>
                    </div>

                    <div class="form-group">
                      <label>Lead ID</label>
                      <input type="text" name="qlead_id" value="<?= $qlead->qlead_id ?>" class="form-control" readonly="" id="lead_id">
                      <span class=" text-danger"><?= form_error('qlead_id') ?></span>
                    </div>
                             <div class="form-group">
                               <input type="submit" name="submit" value=" Update" class="btn btn-info" style="border-color:#ef0f0f;color:white;background-color: #ef0f0f">
                             </div>
              </form>

             

          </div>

                    <!-- /.row (nested) -->

        </div>

                <!-- /.panel-body -->

      </div>

      <!-- /.panel -->

    </div>

    <!-- /.col-lg-12 -->

  </div>

  <!-- /.row -->

  </div>

  <!-- /#page-wrapper -->

</div>

</div>