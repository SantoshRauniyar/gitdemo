 

<div style="padding:2%;">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Users</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body" >
				<div class="panel-body" >
				<div class="panel-heading" style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;">
					<strong><?php echo $heading;?></strong>	
					<strong class="pull-right"><font color="red">* </font>Fields Required</strong>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
						<?php 
							$this->load->view('common/errors');
							echo validation_errors('<div class="error">', '</div>'); 
						//	var_dump($data);
						?>
						
							<form role="form" name="editprofileform" id="editprofileform" method="post" action="<?= base_url('visited_leads/do_update') ?>" enctype="multipart/form-data">
					
                                                 
                            
								<input type="hidden" name="id" value="<?= $visited->id ?>">
								<input type="hidden" name="old_shop_pic" value="<?= $visited->shop_pic ?>">
								<input type="hidden" name="old_card_pic" value="<?= $visited->card_pic ?>">
								<div class="form-group">
									<label>Lead Comments :<strong><font color='red'>*</font></strong></label>
									<textarea id="business_name"  name="lead_comments" class="form-control" col='10'  rows='5'><?= $visited->lead_comments ?></textarea>
								</div>
								<div class="form-group">
									<label>Your Comments :<strong><font color='red'>*</font></strong></label>
									<textarea id="business_name" name="your_comments" class="form-control" col='10'  rows='5'><?=$visited->your_comments?></textarea>
								</div>
								<div class="form-group">
							<img src="<?= base_url('/upload/').'/'.$visited->shop_pic ?>"  style="height:100px;width:100px;" class="img img-responsive">

									<label>Lead Shop Picture :</label>
									<input type="file" name="shop_pic" class="form-control">
								</div>
								<div class="form-group">
								    <img src="<?= base_url('/upload/').'/'.$visited->card_pic ?>"  style="height:100px;width:100px;" class="img img-responsive">
									<label>Lead Card Picture :</label>
									<input type="file" name="card_pic" class="form-control">
								</div>
								<div class="form-group">
									<label>Lead Pincode :</label>
									<input type="number" name="pincode"value="<?= $visited->pincode ?>" class="form-control">
								</div>
								
								<div class="form-group">
									<label>Is Next Visit :</label>
									<input type="radio" value="1" <?= $visited->is_next_visit==1?'checked':'' ?> name="is_next_visit"> Yes &nbsp;&nbsp;&nbsp;&nbsp; <input  <?= $visited->is_next_visit==0?'checked':'' ?> value="0" type="radio" name="is_next_visit"> No
								</div>
							
								<div class="form-group">
                					<label for="dtp_input2" class="control-label">Lead Date:</label>
                					
									<input type="date"  value="<?= $visited->date ?>" id="dtp_input2" class="form-control" name="date"/><br/>
           						</div>
									<div class="form-group">
									
								<button type="submit" class="btn btn-primary" style="color:white;background-color: #ef0f0f;border-color: #ef0f0f">	Submit </button>
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