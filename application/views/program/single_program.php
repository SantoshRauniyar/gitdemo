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
          <strong>Program Management</strong>  
          <strong class="pull-right"><font color="red">* </font>Fields Required</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="container">
            <?php 
           
          // print_r($res);
           $resdata=$res[0];
          //echo$resdata->pid;         
           /* foreach ($res as  $value) {
            $value->admin_off;
          }*/

              $this->load->view('common/errors');
            ?>

                <div class="row">
                  <h3>View a Program</h3>
                <div class="form-group col-md-6">

                          <label for="dtp_input3" class="control-label">Program Name<strong><font color='red'>*</font></strong></label>
                            
                                  <input type="hidden" value="<?= $resdata->icon ?>" name="oldicon">
                            <input type="text" readonly="" class="form-control" name="pro_name" value="<?= $resdata->pro_name ?>">
                            <span class="text-danger"><?= form_error('pro_name')?></span>



                      </div>
                    </div>
                      <div class="row">
                      <div class="form-group col-md-6">
                        <label>Program Code</label>
                        <input readonly="" type="text" value="<?= $resdata->pro_code ?>" name="pro_code" class="form-control">
                      </div>
                    </div>
              
                
                    <div class="row">
                <div class="form-group col-md-6">

               <label for="dtp_input3" class="control-label">Upload Program Logo<strong><font color='red'>*</font></strong></label>
               <img style="height:25px;width:100px;" src="<?= base_url('/upload/').'/'.$resdata->logo ?>">
               
                 </div>
              </div>
                    <div class="row">
                <div class="form-group col-md-6">

                          <label for="dtp_input3" class="control-label">Upload Program Icon<strong><font color='red'>*</font></strong></label>

 <img style="height:25px;width:100px;" src="<?= base_url('/upload/').'/'.$resdata->logo ?>">



                      </div>
                    </div>
                
                    <div class="row">
                <div class="form-group col-md-6">

                          <label for="dtp_input3" class="control-label">Select Program Head:<strong><font color='red'>*</font></strong></label>

                <select class="form-control" name="pro_head" disabled>
                              <option value="12">jhii</option>
                                <?php

                                  foreach($data_head_office as $data) {
                                    ?>
                                      <option value="<?= $data->id?>" <?= $data->id==$resdata->pro_head?'selected':'' ?>><?= $data->user_name?></option>
                                    <?php
                                  }

                            ?>
                            </select>
                            <span class="text-danger"><?= form_error('pro_head')?></span>


                      </div>
              
                    </div>
                    <div class="row">
              
              
                    </div>
                    <div class="row">
                
                <div class="form-group col-md-6">


<br>
                            <a  class="btn btn-info" style="background-color:#ef0f0f;color:white;border-color: #ef0f0f;" >Close</a>



                      </div>
                    </div>
        

            </div>     

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