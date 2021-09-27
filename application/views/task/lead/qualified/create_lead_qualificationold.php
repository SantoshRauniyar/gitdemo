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


                  $('#checklead').change(function(){
                    
                    var p=$(this).val();
                    //alert(p);


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
						<h3><b>Create Lead Qualification</b></h3><br><br>
					<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('task/do_save_lead')?>" enctype="multipart/form-data">
								
										<div class="form-group">
                            <select class="form-control" name="checklead" id="checklead">
                              <option hidden="" >Select Lead</option>

                                <?php

                                      foreach ($lead as $value) {
                                        
                                        ?>
          <option value="<?= $value->lead_name."-".$value->phone."-".$value->lead_email ?>"><?= $value->lead_name."-".$value->phone." ".$value->lead_email ?></option>
                                        <?php
                                      }

                                ?>

                            </select>

                    </div>

                    <span id="status"></span>
           		
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