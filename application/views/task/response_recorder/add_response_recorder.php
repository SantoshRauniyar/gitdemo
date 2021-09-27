<script type="text/javascript">
  
    $(document).ready(function(){


        $('#dept').hide();

        $('#is_ticket').click(function(){


              $('#dept').toggle(500);


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
					?>	<h3><b>Response Recorder Task</b></h3>
											<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('task/do_save_recorder')?>" enctype="multipart/form-data">
						
											
                        <div class="form-group">
                          

                          <label>Select Avenue</label>
                          <select class="form-control" name="avenue_name">
                            <option>Select Avenue</option>
                            <?php
                      foreach ($avenue as $value) {
                    ?>
                      <option value="<?=$value->id ?>"><?=$value->avenue_name ?></option>
                    <?php
                      }
                      ?>
                          </select>
                          <span class="text-danger"><?= form_error('avenue_name') ?></span>
                        </div>
              

								<div class="form-group">

                					<label for="dtp_input3" class="control-label">Post  Title<strong><font color='red'>*</font></strong></label>

                						<input type="text" class="form-control" name="title">
                						<span class="text-danger"><?= form_error('title')?></span>



           						</div>
           						
           									        <div class="form-group">
                                  <label>Response Type</label>
                                  <select class=" form-control "  name="res_type">
                            <?php
                      foreach ($response_type as $value) {
                    ?>
                      <option value="<?=$value->id ?>"><?=$value->type_name ?></option>
                    <?php
                      }
                      ?>
                                  </select>
                                  <span class="text-danger"><?= form_error('res_type')?></span>
                                </div>
           											<div class="form-group">
                                  <label>Response <strong><font color='red'>*</font></strong></label>
           												<input type="text" class="form-control" name="response">           												
                                  <span class="text-danger"><?= form_error('response')?></span>
           											</div>
           									
                                <div class="row">
           											<div class="col-md-3">
                                  <label>Response Date</label>
           												<input type="date" name="rdate" class="form-control">
           												<span class="text-danger"><?= form_error('rdate')?></span>
           											</div>
                                  <div class="col-md-3">
                                  <label>Response Time</label>
                                  <input type="time" name="rtime" class="form-control">
                                  <span class="text-danger"><?= form_error('rtime')?></span>
                                </div>
           											
           									
           										</div>
           					      <div class="form-group">
                            <label>Suggested Replies</label>
                            <select class="form-control" name="suggested_reply">
                              <?php

                                  foreach ($replies as $value) {
                                    ?>
                                          <option value="<?= $value->id ?>"><?= $value->replies ?></option>

                                    <?php
                                  }

                              ?>
                            </select>
                          </div>

           									<div class="form-group">

                					<label for="dtp_input3" class="control-label"> Post URL<strong><font color='red'>*</font></strong></label>

                					<input type="url" name="post_url" class=" form-control">
                            
                          
                						<span class="text-danger"><?= form_error('post_url')?></span>
                            </div>

                            <div class="form-group">

                          <label for="dtp_input3" class="control-label"> Responder URL<strong><font color='red'>*</font></strong></label>

                          <input type="url" name="responder_url" class=" form-control">
                            
                          
                            <span class="text-danger"><?= form_error('responder_url')?></span>
                            </div>

                    <div class="form-group">
                       <label for="dtp_input3" class="control-label"> Given Reply <strong><font color='red'>*</font></strong></label>
                       <textarea class="form-control" rows="5" name="given_reply"></textarea>
                       <span class="text-danger"><?= form_error('given_reply')?></span>
                   </div>
              <h4 style="color:#ef0f0f"><b>Assign</b></h4>
                  <hr>
         				<div class="form-group">
									<label>Reply By :</label>
									<input type="text" class="form-control" value="<?= $this->session->userdata('user_name') ?>" name="reply_by">
									<span class="text-danger"><?= form_error('reply_by') ?></span>
								</div>
           				
									
									<div class="form-group" >
									<label>Reply  Date & Time</label>
									<input type="datetime-local" class="form-control" name="reply_time">
									<span class="text-danger"><?= form_error('end_date') ?></span>
								</div>
							
									<div class="">&nbsp;&nbsp;&nbsp;&nbsp;<label>Create Ticket</label>&nbsp;&nbsp;&nbsp;&nbsp<input type="checkbox" name="ticket" id="is_ticket"></div>
									<div class="form-group">
													
								<select class="	form-control dept" id="dept" name="dept" title="select Department">
												<option  value="0" hidden="" selected="">Select Department</option>
											<?php
											foreach ($department as $value) {
										?>
											<option value="<?=$value->did ?>"><?=$value->dtitle ?></option>


										<?php
											}


											?>
									</select> 
									</div>

									

								<div class="form-group col-md-6">

        <br>
                						<input type="submit" value="Next" class="btn btn-info" style="border-color: #ef0f0f;background-color:#ef0f0f;color:white;" name="next">



           						</div>
           		
							</form>

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
