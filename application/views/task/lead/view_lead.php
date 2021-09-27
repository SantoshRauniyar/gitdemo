<script type="text/javascript">
	
	$(document).ready(function(){

			$('#response').hide();

        <?php if($lead->source==1){ ?>$('#response').show();<?php }?>
            $('.market_response_post').click(function(){


              $('#response').toggle(500);


            })


            $('.refferal').click(function(){


              $('#response').hide();


            })
            $('.other').click(function(){


              $('#response').hide();


            })


                  /*$('#phonecode').mouseleave(function(){
                      var p=$(this).val();
                    code='L'+p+'-'+'<?= $lead->lead_code ?>';
                    $('#lcode').val(code);

                  })*/


                
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
						<h3><b>Lead Generation Form</b></h3><br><br>
					<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('task/do_update_lead').'/'.$lead->id?>" enctype="multipart/form-data">
								<div class="form-group" >
									<label>Lead ID</label>
									<input type="text" readonly="" value="<?= empty($lead->lead_code)?str_pad($lead->id+1, 8, '0', STR_PAD_LEFT):$lead->lead_code ?>" id="lcode" class="form-control" name="lead_code">
									<span class="text-danger"><?= form_error('lead_code') ?></span>
								</div>
												<h4><b>Select Source</b></h4>
                  <div class="row">
                        <div class="form-group col-md-4">
                          <input type="radio" value="1" <?= $lead->source==1?"checked":"" ?> class="market_response_post" name="source">
                          <label>Marketing Posts Response</label>
											   <span class="text-danger"><?= form_error('source') ?></span>
												</div>
                        <div class="form-group col-md-4">
                          <input type="radio" class="refferal" <?= $lead->source==2?"checked":"" ?> value="2" name="source">
                          <label>Referals</label>
                         <span class="text-danger"><?= form_error('source') ?></span>
                        </div>
                        <div class="form-group col-md-4">
                          <input type="radio" value="3" <?= $lead->source==3?"checked":"" ?> class="other" name="source">
                          <label>Others</label>
                         <span class="text-danger"><?= form_error('source') ?></span>
                        </div>
                      </div>

                      <div id="response">

           						<label>Select Response <strong><font color='red'>*</font></strong></label>
           										<div class="row">

           											<div class="col-md-4">
           												<select class="	form-control" name="avenue" disabled=" ">
           													<option>Select Aveneue</option>
           													<?php
											foreach ($avenue as $value) {
										?>
											<option value="<?=$value->id ?>"  <?= $lead->avenue==$value->id?"selected":"" ?> ><?=$value->avenue_name ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('avenue')?></span>
           											</div>
           											<div class="col-md-2">
           												<input type="date" disabled="  " value="<?= $lead->rdate ?>" class="form-control" name="rdate">
           												<span class="text-danger"><?= form_error('rdate')?></span>
           											</div>
           											<div class="col-md-6">
           												<select class="	form-control" name="post" disabled=" ">
           													<option>Select Post</option>
           																	<?php
											foreach ($post as $value) {
										?>
											<option value="<?=$value->id ?>" <?= $lead->post==$value->id?"selected":"" ?>><?=$value->task_name ?></option>
										<?php
											}
											?>
           												</select>
           												<span class="text-danger"><?= form_error('post')?></span>
           											</div>
                              </div>
                            </div>


           								           		<div class="form-group">
                                          <label>Select Lead Type</label>
                                          <select class="form-control" name="lead_type" disabled="  ">
                                    <option>Select Lead Type</option>
                                            <?php
                      foreach ($audience as $value) {
                    ?>
                      <option value="<?=$value->aid ?>" <?= $lead->lead_type==$value->aid?"selected":"" ?>><?=$value->audi_name ?></option>
                    <?php
                      }
                      ?>
                                  </select>
                                  <span class="text-danger"><?= form_error('audience')?></span>
                                        </div>			

           														<div class="form-group">

                					<label for="dtp_input3" class="control-label">Lead Name <strong><font color='red'>*</font></strong></label>
                            <input disabled=" " type="text" value="<?= $lead->lead_name ?>" name="lead_name" class="form-control">
                						<span class="text-danger"><?= form_error('task_details')?></span>



           						</div>
                                <div class="form-group">

                          <label for="dtp_input3" class="control-label">Lead Email <strong><font color='red'>*</font></strong></label>
                            <input disabled=" " type="email" value="<?= $lead->lead_email ?>" name="lead_email" class="form-control">
                            <span class="text-danger"><?= form_error('lead_email')?></span>
                          </div>
                          <label>Lead Phone</label>
                            <div class="row">
                              <div class="col-md-2">
                                <select disabled="  " class="form-control" name="phonecode" id="phonecode">
                                    <?php
                                          foreach ($phonecode as  $value)
                                          {
                                    ?>

                                       <option value="<?= $value->id ?>" <?=  $lead->phonecode==$value->id?"selected":""  ?>> +<?= $value->phonecode ?></option>
                                   <?php } ?>
                                 

                                </select>
                                 <span class="text-danger"><?= form_error('phonecode')?></span>
                              </div>
                              <div class="col-md-8">
                                <input type="number" readonly=" "  value="<?= $lead->phone ?>"  name="phone" class="form-control" maxlength="10">
                                 <span class="text-danger"><?= form_error('phone')?></span>
                              </div>
                            </div>
                    

         					
           					<div class="form-group">
           						<label>Lead Comments</label>
                      <textarea disabled="  " class="form-control" name="lead_comment" rows="5" placeholder="Lead Comment"><?= $lead->lead_comment ?></textarea>
           						<span class="text-danger"><?= form_error('lead_comment')?></span>
           					</div>
								
									
								

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