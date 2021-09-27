	<div class="row">
									<div class="">&nbsp;&nbsp;&nbsp;&nbsp;<label>Attributes Assignment</label></div>
									<div class="col-md-2">
													<label>Program</label>
								<select class="	form-control program projetbypro" name="program" title="select Program">
												<option value="" hidden="">Select Program</option>
											<?php
											foreach ($program as $value) {
										?>
											<option value="<?=$value->pid ?>"><?=$value->pro_name ?></option>


										<?php
											}


											?>
									</select> 
									</div>

									<div class="col-md-2">
										<div class="form-group" >
								<label>Department</label>
									<select class="form-control dept" name="department" id="dept" title="Select Department">
											
										<option value="" hidden="">Select Department</option>
									</select> 
								</div>
									</div>
									<div class="col-md-2">
										<div class="form-group" >
									
								<span class="sec" id="section">
									    <label>Select Section</label>
									<select class="form-control" name="section" id="getsec">
										<option>Select Section</option>
											
											
									</select> 
									<span class="text-danger"><?= form_error('section') ?></span>
									</span>
								</div>
									</div>
							                        
							                      <div class="col-md-2">
										<div class="form-group" >
									<span id="unit">
									    <label>Unit</label>
									<select class="	form-control " name="" id="unit" title="select unit">
										<option>Select Unit</option>
											
																			</select> 
									</span>
									<span class="text-danger"><?= form_error('unit') ?></span>
								</div>
									</div>
							
									<div class="col-md-2">
										<div class="form-group" >
									
									<label>Project</label>
									<select class="	form-control proformile" name="project" id="project" title="Please select a project ">
												<option value="" hidden=""selected="">Select Project</option>
											<?php
											foreach ($projects as $value) {
										?>
											<option value="<?=$value->id ?>"><?=$value->project_name ?></option>


										<?php
											}


											?>
									</select>
									<span class="text-danger"><?= form_error('project') ?></span> 
								</div>
									</div>
									<div class="col-md-2">
										<div class="form-group" >
									<label>Milestone</label>
									<select class="	form-control "  name="milestone" id="milestone" title="select milestone">
												<option value="" hidden="" selected="">Select Milestone</option>
											<?php
											foreach ($milestone as $value) {
										?>
											<option value="<?=$value->id  ?>"><?=$value->milestone_title ?></option>


										<?php
											}


											?>
									</select> 
									<span class="text-danger"><?= form_error('milestone') ?></span>
								</div>
									</div>
								</div>