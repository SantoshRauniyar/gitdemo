<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class subunit extends Template
{
	public function __construct()
	{
		parent::__construct();
		
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->model('team_model');
		$this->load->model('section_model');


$this->load->model('unit_model');	
$this->load->model('groups_model');	
$this->load->model('sub_unit_model');
$this->load->model('program_model');
		$this->load->model('authentication_model');
		$this->load->model('notification_model');
		$this->load->model('users_model');
		$this->load->model('user_classification_model');
		$this->user_classification_model->set_role();
		$this->load->model('user_role_model');
		$this->load->model('plan_model');
		$this->set_header_path('blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->set_template('template');
		$this->set_title('Team Management');
		
		$this->assets_load->add_css(array(base_url('assets/administrator/css/bootstrap-formhelpers.css'),
						  				  base_url('assets/administrator/css/bootstrap-formhelpers.min.css')),"header");
						  
		$this->assets_load->add_js(array(base_url('assets/administrator/js/bootstrap-formhelpers.js'),
				  						 base_url('assets/administrator/js/ckeditor/ckeditor.js'),
										 base_url('assets/administrator/js/vendors/team.js')),"footer");

		if(!$this->session->userdata('id'))
			redirect("authentication/");
	}

	public function index()
	{
		$this->all();
	}


				public function all()
				{
					$data['programlist']=$this->program_model->getprogramdropdown();
					$data['title_head']="Sub Unit View List";
							//$res=$this->sub_unit_model->getallsubunit();
					return $this->view('subunit/subunit_list',$data);
				}

								function subunitlistbyunit()
	{

						if ($uid=$this->input->get('uid')) {
						

									$subunit_list=$this->sub_unit_model->getallsubunit($uid);

																	if(isset($subunit_list) and !empty($subunit_list))
										{

									foreach($subunit_list as $data)
									{
							?>
								<tr class="odd gradeX">
									<!--  <td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();"></td>-->
								<tr>
									<td><?= $data->sub_uname ?></td>
									<td><?= $data->pro_name ?></td>
									<td><?= $data->dtitle ?></td>
									<td><?= $data->section_name ?></td>
									<td><?= $data->unit_name ?></td>
									<td>

									<a style="color:white;background-color: #ef0f0f;border-color: #ef0f0f"  href="<?= base_url('child-unit/'.$data->id) ?>" class="btn btn-info">View Details</a></td>
								</tr>
							<?php
									}
								}
								else
								{
						echo "<div class='alert alert-danger'>Sorry Sub unit not found !</div>";

								}

						
	}
}

																		


						public function editlist()
				{
					$data['programlist']=$this->program_model->getprogramdropdown();
					$data['title_head']="Sub Unit Edit List";
							//$res=$this->sub_unit_model->getallsubunit();
					return $this->view('subunit/editsubunitlist',$data);
				}



				function subuniteditlistbyunit()
	{

						if ($uid=$this->input->get('uid')) {
						

									$subunit_list=$this->sub_unit_model->getallsubunit($uid);

															if(isset($subunit_list) and !empty($subunit_list))
										{

									foreach($subunit_list as $data)
									{
							?>
								<tr class="odd gradeX">
									<!--  <td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();"></td>-->
								<tr>
									<td><?= $data->sub_uname ?></td>
									<td><?= $data->pro_name ?></td>
									<td><?= $data->dtitle ?></td>
									<td><?= $data->section_name ?></td>
									<td><?= $data->unit_name ?></td>
									<td>
										
									<a style="color:white;background-color: #ef0f0f;border-color: #ef0f0f"  href="<?= base_url('child-unit/'.$data->id) ?>" class="btn btn-info">Edit</a></td>
								</tr>
							<?php
									}
								}
								else
								{
							echo "<div class='alert alert-danger'>Sorry Sub unit not found !</div>";

								}
						
	}
}
		function add_sub_unit()
		{
				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_sub_unit'))
		{


		$data['programlist']=$this->program_model->getprogramdropdown();
		$data['departmentlist']=$this->groups_model->getdepartmentdropdown();
		$data['sectionlist']=$this->section_model->getsectiondropdown();
		$data['unitlist']=$this->unit_model->getunitdropdown();
		$data['userlist']=$this->authentication_model->getSubUnitHead();
		$data['action']=base_url().'subunit/do_save/';
		$data['title_head']='Add Sub Unit ';
		
			$this->view('subunit/add',$data);
		}//close
	}





	//delete list


						public function deletelist()
				{
					$data['programlist']=$this->program_model->getprogramdropdown();
					$data['title_head']="Sub Unit Delete List";
							//$res=$this->sub_unit_model->getallsubunit();
					return $this->view('subunit/subunit_delete_list',$data);
				}



				function subunitdeletelistbyunit()
	{

						if ($uid=$this->input->get('uid')) {
										

									$subunit_list=$this->sub_unit_model->getallsubunit($uid);


										if(isset($subunit_list) and !empty($subunit_list))
										{
									foreach($subunit_list as $data)
									{
							?>
								<tr class="odd gradeX">
									<!--  <td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();"></td>-->
								<tr>
									<td><?= $data->sub_uname ?></td>
									<td><?= $data->pro_name ?></td>
									<td><?= $data->dtitle ?></td>
									<td><?= $data->section_name ?></td>
									<td><?= $data->unit_name ?></td>
									<td>
										
									<a style="color:white;background-color: #ef0f0f;border-color: #ef0f0f"  href="<?= base_url('child-unit/destroy/'.$data->id) ?>" onclick="return confirm('Are you sure to delete ?')" class="btn btn-info">Delete</a></td>
								</tr>
							<?php
									}
								}else
								{
									echo "<div class='alert alert-danger'>Sorry Sub unit not found !</div>";
								}
						
	}
}
		
			

		function do_save()
	{
				

			$this->form_validation->set_rules('sub_uname','Unit Name','trim|required');
			$this->form_validation->set_rules('program_id','Program','trim|required');
			$this->form_validation->set_rules('department_id','Department','trim|required');

			$this->form_validation->set_rules('section_id','Section','trim|required');
			$this->form_validation->set_rules('unit_id','Unit','trim|required');
			$this->form_validation->set_rules('sub_uhead','Sub Unit Head','required|is_unique[sub_unit.sub_uhead]');

				if ($this->input->post('submit')) {
				    
						if ($this->form_validation->run()==FALSE) {
							
						
		$data['programlist']=$this->program_model->getprogramdropdown();
		$data['departmentlist']=$this->groups_model->getdepartmentdropdown();
		$data['sectionlist']=$this->section_model->getsectiondropdown();
		$data['unitlist']=$this->unit_model->getunitdropdown();
		$data['userlist']=$this->authentication_model->getSubUnitHead();
		$data['action']=base_url().'subunit/do_save/';
		$data['title_head']='Add Sub Unit ';
		
			$this->view('subunit/add',$data);
                		
              
					
				}
				else 
				{
						

		 	$input=[
				'sub_uname'=>$this->input->post('sub_uname'),
				'program_id'=>$this->input->post('program_id'),
				'unit_id'=>$this->input->post('unit_id'),
				'section_id'=>$this->input->post('section_id'),
				'sub_unit_followers'=>json_encode($this->input->post('sub_unit_followers')),
				'department_id'=>$this->input->post('department_id'),
				'sub_uhead'=>$this->input->post('sub_uhead'),
				'section_id'=>$this->input->post('section_id'),
				'created_by'=> $this->session->userdata('id')
				

			];
								/**
								*when sub unit adeded then we sent mail to every upper level officer
								*
								*send notification to every one
								*/
						$id=$this->sub_unit_model->do_save($input);
						if($id)
						{
							//var_dump($id);
		$usersformail=$this->sub_unit_model->getUserDetailsBy($input['program_id'],$input['department_id'],$input['section_id'],$input['unit_id'],$id);
									  //$emails=$this->user_role_model->getEmail($insertaraay['assign_uid']);
                                            	
                                            	                 /**
                                                * Notification module
                                                * 
                                                * */
                                     date_default_timezone_set('Asia/Kolkata');
                  $sentdata=[
								'message'=>'New '.$input['sub_uname'].' Sub Unit  Created.',
								'link'=>'subunit/'.$id,
								'date'=>date("d M  G:i")
							];

                                            	 foreach($usersformail as $value) {
					    		
                                 $sentdata['to_users']=$value->id;
								$isn=$this->notification_model->sent_notification($sentdata);

			        	}

						}
				}
			}
	}


						           
			   		public function destroy($id)
			   		 {
			   		 	if($this->sub_unit_model->destroy($id))
			   		 	{
			   		 		$this->session->set_flashdata('success','Sub Unit Deleted Successfully');
			   		 		return redirect('/child-unit-deletelist');
			   		 	}
			   		 } 
			    
			   		 					public function edit($id)
			   		 					{
			$data['subunit']=$this->sub_unit_model->getdatabyId($id);
		$data['programlist']=$this->program_model->getprogramdropdown();
		$data['departmentlist']=$this->groups_model->getdepartmentdropdown();
		$data['sectionlist']=$this->section_model->getsectiondropdown();
		$data['unitlist']=$this->unit_model->getunitdropdown();
		$data['userlist']=$this->authentication_model->getSubUnitHead();
		$data['action']=base_url().'subunit/do_update/';
		$data['title_head']='Edit Sub Unit ';
		
			$this->view('subunit/add',$data);

			   		 					}

			   		 					public function single_view($id)
			   		 					{
			$data['subunit']=$this->sub_unit_model->getdatabyId($id);
		$data['programlist']=$this->program_model->getprogramdropdown();
		$data['departmentlist']=$this->groups_model->getdepartmentdropdown();
		$data['sectionlist']=$this->section_model->getsectiondropdown();
		$data['unitlist']=$this->unit_model->getunitdropdown();
		$data['userlist']=$this->authentication_model->getSubUnitHead();
		$data['action']=base_url().'/';
		$data['title_head']='View Sub Unit ';
		
			$this->view('subunit/single_view',$data);

			   		 					}




			   		 			public function followerlist()
			   		 			{
			   		 				if($uid=$this->input->get('uid'))
			   		 				{
			   		 						$followerlist=$this->sub_unit_model->followers($uid);

			   		 								if($followerlist)
			   		 								{
			   		 						foreach($followerlist as $value) {
			   		 					?>
			   		 	<option value="<?=  $value->id ?>"><?= $value->first_name.' '.$last_name ?></option>

			   		 					<?php
			   		 						}
			   		 					}
			   		 					else
			   		 					{
			   		 						echo '<option>Followers Not Available</option>';
			   		 					}
			   		 				}
			   		 			}


			   		 			public function do_update()
			   		 			{
			   		 				
			 $this->form_validation->set_rules('sub_uname','Unit Name','trim|required');
			$this->form_validation->set_rules('program_id','Program','trim|required');
			$this->form_validation->set_rules('department_id','Department','trim|required');

			$this->form_validation->set_rules('section_id','Section','trim|required');
			$this->form_validation->set_rules('unit_id','Unit','trim|required');
			$this->form_validation->set_rules('sub_uhead','Sub Unit Head','required');

				if ($this->input->post('submit')) {
				    
						if ($this->form_validation->run()==FALSE) {
							
						
		$data['programlist']=$this->program_model->getprogramdropdown();
		$data['departmentlist']=$this->groups_model->getdepartmentdropdown();
		$data['sectionlist']=$this->section_model->getsectiondropdown();
		$data['unitlist']=$this->unit_model->getunitdropdown();
		$data['userlist']=$this->authentication_model->getSubUnitHead();
		$data['action']=base_url().'subunit/do_update/';
		$data['title_head']='Add Sub Unit ';
		
			$this->view('subunit/add',$data);
                		
              
					
				}
				else 
				{
						

		 	$input=[
				'sub_uname'=>$this->input->post('sub_uname'),
				'program_id'=>$this->input->post('program_id'),
				'unit_id'=>$this->input->post('unit_id'),
				'section_id'=>$this->input->post('section_id'),
				'sub_unit_followers'=>json_encode($this->input->post('sub_unit_followers')),
				'department_id'=>$this->input->post('department_id'),
				'sub_uhead'=>$this->input->post('sub_uhead'),
				'id'=>$this->input->post('id'),
				'section_id'=>$this->input->post('section_id'),
				'created_by'=> $this->session->userdata('id')
				

			];
								/**
								*when sub unit adeded then we sent mail to every upper level officer
								*
								*send notification to every one
								*/
									$id=$input['id'];
						$is_update=$this->sub_unit_model->do_update($input);
						if($is_update)
						{
							//var_dump($id);
		$usersformail=$this->sub_unit_model->getUserDetailsBy($input['program_id'],$input['department_id'],$input['section_id'],$input['unit_id'],$id);
									  //$emails=$this->user_role_model->getEmail($insertaraay['assign_uid']);
                                            	
                                            	                 /**
                                                * Notification module
                                                * 
                                                * */
                                     date_default_timezone_set('Asia/Kolkata');
                  $sentdata=[
								'message'=>'New '.$input['sub_uname'].' Sub Unit  Updated.',
								'link'=>'subunit/'.$id,
								'date'=>date("d M  G:i")
							];

                                            	 foreach($usersformail as $value) {
					    		
                                 $sentdata['to_users']=$value->id;
								$isn=$this->notification_model->sent_notification($sentdata);

			        	}

			        			return redirect('/child-unit-editlist');
						}
				}
			}

			   		 			}
			}
				
