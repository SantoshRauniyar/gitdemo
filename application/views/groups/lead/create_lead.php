<script type="text/javascript">
	
	$(document).ready(function(){

			$('#response').hide();


            $('.market_response_post').click(function(){


              $('#response').toggle(500);


            })


                  $('#phonecode').mouseleave(function(){
                      var p=$(this).val();
                    code='L'+p+'-'+'<?= $code ?>';
                    $('#lcode').val(code);

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
				<div class="panel-heading" style="background-color:#323200;color:white;">
					<strong>Department Taskboard</strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
						?>
						<h3><b>Lead Generation Form</b></h3><br><br>
					<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('groups/do_save_lead')?>" enctype="multipart/form-data">
								
												
                  <div class="row">
                        <div class="form-group col-md-4">
                          <input type="checkbox" class="market_response_post" name="market_response_post">
                          <label>Marketing Posts Response</label>
											   <span class="text-danger"><?= form_error('market_response_post') ?></span>
												</div>
                        <div class="form-group col-md-4">
                          <input type="checkbox" name="market_response_post">
                          <label>Referals</label>
                         <span class="text-danger"><?= form_error('referals') ?></span>
                        </div>
                        <div class="form-group col-md-4">
                          <input type="checkbox" name="market_response_post">
                          <label>Others</label>
                         <span class="text-danger"><?= form_error('others') ?></span>
                        </div>
                      </div>

                      <div id="response">

           						<label>Select Response <strong><font color='red'>*</font></strong></label>
           										<div class="row">

           											<div class="col-md-4">
           												<select class="	form-control" name="avenue">
           													<option>Select Aveneue</option>
           													<?php
											foreach ($avenue as $value) {
										?>
											<option value="<?=$value->id ?>"><?=$value->avenue_name ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('avenue')?></span>
           											</div>
           											<div class="col-md-4">
           												<input type="date" class="form-control" name="rdate">
           												<span class="text-danger"><?= form_error('rdate')?></span>
           											</div>
           											<div class="col-md-4">
           												<select class="	form-control" name="post">
           													<option>Select Post</option>
           																	<?php
											foreach ($post as $value) {
										?>
											<option value="<?=$value->id ?>"><?=$value->task_name ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('audience')?></span>
           											</div>
                              </div>


           								           		<div class="form-group">
                                          <label>Select Lead Type</label>
                                          <select class="form-control" name="lead_type">
                                    <option>Select Lead Type</option>
                                            <?php
                      foreach ($audience as $value) {
                    ?>
                      <option value="<?=$value->aid ?>"><?=$value->audi_name ?></option>
                    <?php
                      }
                      ?>
                                  </select>
                                  <span class="text-danger"><?= form_error('audience')?></span>
                                        </div>			

           														<div class="form-group">

                					<label for="dtp_input3" class="control-label">Lead Name <strong><font color='red'>*</font></strong></label>
                            <input type="text" name="lead_name" class="form-control">
                						<span class="text-danger"><?= form_error('task_details')?></span>



           						</div>
                                <div class="form-group">

                          <label for="dtp_input3" class="control-label">Lead Email <strong><font color='red'>*</font></strong></label>
                            <input type="url" name="lead_email" class="form-control">
                            <span class="text-danger"><?= form_error('lead_email')?></span>
                          </div>
                          <label>Lead Phone</label>
                            <div class="row">
                              <div class="col-md-2">
                                <select class="form-control" name="phonecode" id="phonecode">
                                    <?php
                                          foreach ($phonecode as  $value)
                                          {
                                    ?>

                                       <option value="<?= $value->phonecode ?>"><?= $value->phonecode ?></option>
                                   <?php } ?>
                                 

                                </select>
                              </div>
                              <div class="col-md-8">
                                <input type="number"  name="phone" class="form-control">
                              </div>
                            </div>
                    

         					
           					<div class="form-group">
           						<label>Lead Comments</label>
           						<textarea class="form-control" name="lead_comment" rows="5" placeholder="Lead Comment"></textarea>
           						<span class="text-danger"><?= form_error('lead_comment')?></span>
           					</div>
								<div class="form-group">
                  <label>Priority</label>
          <select name="priority" class="form-control">
            <option value="1">Low</option>
            <option value="2">Medium</option>
            <option value="3">High</option>
            <option value="4">Urgent</option>
          </select>
									<span class="text-danger"><?= form_error('priority') ?></span>

           				
           						<!--<div class="form-group col-md-6">
           							<br><a href="javascript:void()"  class="btn btn-info btn1" style="color: :white;background-color: #323200;border-color:#323200">Next</a>
           						</div>-->
           					</div>
           			


												
	
						
           					
									<div class="form-group">
									<label>Assign to:></label>
									<select class="form-control" name="assign_to">
												<option hidden="" selected="">Select Please</option>
											<?php
											foreach ($dept as $value) {
										?>
											<option value="<?=$value->did.'-'.$value->email ?>"><?=$value->dtitle ?></option>
										<?php
											}
											?>
									</select>
									<span class="text-danger"><?= form_error('assign_to') ?></span>
								</div>
           				
									<div class="form-group" >
									<label>Team Comments <strong><font color='red'>*</font></strong></label>
									<textarea class="form-control" rows="5" name="team_comments"></textarea>
								</div>
									<div class="form-group" >
									<label>Lead ID</label>
									<input type="text" readonly="" value="L91-00000001" id="lcode" class="form-control" name="lead_code">
									<span class="text-danger"><?= form_error('lead_code') ?></span>
								</div>
								


								<div class="form-group col-md-6">

        <br>
                						<input type="submit" value="Next" class="btn btn-info" style="border-color: #323200;background-color:#323200;color:white;" name="next">



           						</div>
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