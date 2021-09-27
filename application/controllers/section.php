<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class section extends Template
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
		$this->load->model('program_model');
		$this->load->model('notification_model');
		$this->load->model('authentication_model');
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

		function add_section()
		{
				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_unit'))
		{

			$this->db->order_by('pro_name','asc');
			$p=$this->db->get('program');
		$data['program']=$p->result();

		$data['dept']=$this->db->order_by('dtitle','asc')->where('is_sec',1)->get('department')->result();
				$data['userlist']= $this->authentication_model->getSectionHead();
		//var_dump($data);
		$this->view('unit/section/add_section',$data);
		}//close
	}

			

		function do_save()
		{


			$this->form_validation->set_rules('section_name','Section Name','trim|required');
			$this->form_validation->set_rules('program','Program','trim|required');
			$this->form_validation->set_rules('dept','Department','trim|required');
		
			$this->form_validation->set_rules('section_head','Section Head','required|trim|is_unique[section.section_head]');

				if ($this->input->post('submit')) {
				
            $id= $this->user_classification_model->getIdExsitPlusOne('id','section');
						if ($this->form_validation->run()==TRUE) {
							
			$arr=[
                    'id'=>$id,
				'section_name'=>$this->input->post('section_name'),
				'program_id'=>$this->input->post('program'),
				'dept_id'=>$this->input->post('dept'),
				'section_head'=>$this->input->post('section_head'),
				'created_by'=>$this->session->userdata('id')
				

			];
			
                			$ph=$this->db->select('pro_name,pro_head')->where('pid',$arr['program_id'])->from('program')->get()->result();
		                    	$dh=$this->db->select('dtitle,manager_id')->where('did',$arr['dept_id'])->from('department')->get()->result();
			
		                            $pro_head=$ph[0]->pro_head;
		                            $dept_head=$dh[0]->manager_id;
		                            $pro_name=$ph[0]->pro_name;
		                            $dept_name=$dh[0]->dtitle;
			
	
			           
			            $to=$pro_head.','.$dept_head;
			            $emails=$this->user_role_model->getEmail($to);
			          //  var_dump($to);
			            //var_dump($emails);
			            
			            if($this->db->insert('section',$arr))
			            {
			            	//Mail Notification will be sent to Deaprtment head and Admin
							$sentdata=[
								'message'=>'New  '.$arr['section_name'].' Section Created.',
								'link'=>'section/single_section_view/'.$id												
							];
								$users=[$dept_head,$pro_head,$this->session->userdata('id')];
								$users=array_unique($users);
								foreach($users as $user)
							{
								$sentdata['to_users']=$user;
								$this->notification_model->sent_notification($sentdata);
	
				
							}
						 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/section/add.html");
					$emailBody = str_replace("<@section_name@>",$arr['section_name'],$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
					$emailBody = str_replace("<@link@>",base_url().'/section/single_section_view/'.$id,$emailBody);
					$emailBody = str_replace("<@pro_name@>",$pro_name,$emailBody);
						$emailBody = str_replace("<@dept_name@>",$dept_name,$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Section Management - Section Created in ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
					{
						echo "email not sent";
						$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
					
				
					
					
				}
				else 
				{
					echo"InValid Email";
					$this->session->set_flashdata( "errors", "Please enter valid email address.");
			
				}
				         
	            	}	           
			        	}
			            
			        	redirect('section/section_list');
			            }
			            
			
		} else {
		    	$this->db->order_by('pro_name','asc');
			$p=$this->db->get('program');
		$data['program']=$p->result();

		$data['dept']=$this->db->order_by('dtitle','asc')->where('is_sec',1)->get('department')->result();
		$data['users']=$this->db->select('id,user_name')->order_by('user_name')->get('users')->result();
		//var_dump($data);
		$this->view('unit/section/add_section',$data);
		
			
		
		}

}
}
					function section_delete_list()
					{
	if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_unit'))
		{
			$plist=$this->db->get("program");
			$data['programlist']=$plist->result();
				$this->view('unit/section/section_delete_list',$data);
					}//close

				}


			        	function deletesection($id,$did=null,$pid=null,$sec_name=null)
			    	{

				                    	if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_unit'))
			                           	{
					                                  
					
				            	$ph=$this->db->select('pro_name,pro_head')->where('pid',$pid)->from('program')->get()->result();
		                    	$dh=$this->db->select('dtitle,manager_id')->where('did',$did)->from('department')->get()->result();
			
		                            $pro_head=$ph[0]->pro_head;
		                            $dept_head=$dh[0]->manager_id;
		                            $pro_name=$ph[0]->pro_name;
		                            $dept_name=$dh[0]->dtitle;
			
	
			           
			            $to=$pro_head.','.$dept_head;
			            $emails=$this->user_role_model->getEmail($to);
			          //  var_dump($to);
			            //var_dump($emails);
			            
			            if($this->db->where('id',$id)->delete('section'))
			            {
			            	//Mail Notification will be sent to Deaprtment head and Admin
				
						 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/section/delete.html");
					$emailBody = str_replace("<@section_name@>",$sec_name,$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
				//	$emailBody = str_replace("<@link@>",base_url().'/section/single_section_view/'.$id,$emailBody);
					$emailBody = str_replace("<@pro_name@>",$pro_name,$emailBody);
						$emailBody = str_replace("<@dept_name@>",$dept_name,$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Section Management - Section Deleted in ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
					{
						echo "email not sent";
						$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
					
				
					
					
				}
				else 
				{
					echo"InValid Email";
					$this->session->set_flashdata( "errors", "Please enter valid email address.");
			
				}
				         
	            	}	           
			        	}
					redirect('section/section_delete_list');
			            }
				}
			}


		function section_list()
		{
		            	if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_unit'))
	            	{
		                    	$plist=$this->db->get("program");
		                    	$data['programlist']=$plist->result();
			                	$this->view('unit/section/section_list',$data);
		            	}//close

		}

			function taskboard()
           {

			        
				    $data['prolist']=$this->program_model->getprogramdropdown();

           				$this->view('unit/section/taskboard',$data);
           }
		function view_section_edit()
		{
				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_unit'))
		{
				$plist=$this->db->get('program');
			$data['programlist']=$plist->result();
				$this->view('unit/section/editsectionlist',$data);
		}//close
	}

		function editsection($id)
		{
                if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_unit'))
		{
					$this->db->where('id',$id);
					$section=$this->db->get('section');
					$data['sectionlist']=$section->result();

	                    	$p=$this->db->get('program');
	                    	$data['program']=$p->result();
	                    	$d=$this->db->get('department');
	                    	$data['dept']=$d->result();
                $data['userlist']= $this->authentication_model->getSectionHead();
					        $this->view('unit/section/edit_section',$data);
		}//close
	}



		function single_section_view($id)
		{
				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_unit'))
		{

					$this->db->where('id',$id);
					$section=$this->db->get('section');
					$data['sectionlist']=$section->result();

		                $p=$this->db->get('program');
	                    	$data['program']=$p->result();
	                    	$d=$this->db->get('department');
	                        	$data['dept']=$d->result();
	                            	$u=$this->db->get('users');
	                                	$data['users']=$u->result();
		       
				$this->view('unit/section/single_section',$data);
		}
	
	}

		function do_update($id)
		{


				$this->form_validation->set_rules('section_name','Section Name','trim|required');
			$this->form_validation->set_rules('program','Program','trim|required');
			$this->form_validation->set_rules('dept','Department','trim|required');
		
			$this->form_validation->set_rules('section_head','Section Head','required');

				if ($this->input->post('submit')) {
				

						if ($this->form_validation->run()==TRUE) {
							
			$arr=[

				'section_name'=>$this->input->post('section_name'),
				'program_id'=>$this->input->post('program'),
				'dept_id'=>$this->input->post('dept'),
				'section_head'=>$this->input->post('section_head'),
				'created_by'=>$this->session->userdata('id')
				

			];
			
			$ph=$this->db->select('pro_name,pro_head')->where('pid',$arr['program_id'])->from('program')->get()->result();
			$dh=$this->db->select('dtitle,manager_id')->where('did',$arr['dept_id'])->from('department')->get()->result();
			$pro_head=$ph[0]->pro_head;
			$dept_head=$dh[0]->manager_id;
			
			$pro_name=$ph[0]->pro_name;
			$dept_name=$dh[0]->dtitle;
			            
			            $to=$arr['section_head'].','.$pro_head.','.$dept_head;
			            $emails=$this->user_role_model->getEmail($to);
			           // var_dump($to);
			            //var_dump($emails);
			            
			            if($this->db->where('id',$id)->update('section',$arr))
			            {
			            	//Mail Notification will be sent to Deaprtment head and Admin
									$this->session->set_flashdata('success','Section Updated Successfully');
							$sentdata=[
								'message'=>$arr['section_name'].' Section Updated.',
								'link'=>'section/single_section_view/'.$id												
							];
							$users=[$arr['section_head'],$dept_head,$pro_head,$this->session->userdata('id')];
							$users=array_unique($users);
	;						foreach($users as $user)
							{
								$sentdata['to_users']=$user;
								$this->notification_model->sent_notification($sentdata);
	
				
							}

						 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/section/edit.html");
					$emailBody = str_replace("<@section_name@>",$arr['section_name'],$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
					$emailBody = str_replace("<@link@>",base_url().'/section/single_section_view/'.$id,$emailBody);
					$emailBody = str_replace("<@pro_name@>",$pro_name,$emailBody);
						$emailBody = str_replace("<@dept_name@>",$dept_name,$emailBody);
							$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Section Management - Section Updated in ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
					{
						echo "email not sent";
						$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
					
				
					
					
				}
				else 
				{
					echo"InValid Email";
					$this->session->set_flashdata( "errors", "Please enter valid email address.");
			
				}
				         
	            	}	           
			        	}
			        	redirect('section/section_list');
			            }
			            
			           // var_dump($arr);
			
		} else {
		    	$this->db->order_by('pro_name','asc');
			$p=$this->db->get('program');
		$data['program']=$p->result();

		$data['dept']=$this->db->order_by('dtitle','asc')->where('is_sec',1)->get('department')->result();
		$data['users']=$this->db->select('id,user_name')->order_by('user_name')->get('users')->result();
		//var_dump($data);
		$this->view('unit/section/edit_section',$data);
		
			
		
		}

}
}

						/**
						* @return head id 
						*@param $table table name from where we get id
						* @param $unique_column spacific  from where we get id
						*
						*/

				function get_head($table,$unique_column,$unique_id,$head_column_name)
				{

								$this->db->where($unique_column,$unique_id);
								$res=$this->db->get($table);
								$data=$res->result();
								$data=$data[0];
								//var_dump($data);
								return $data->$head_column_name;


				}
				//$this->get_head("program","pro_head",74);


							function test()
							{
								$res=$this->get_head("program","pid",74,"pro_head");
								echo $res;
							}
		 function taskbyprodeptsec()
           {



           		if ($end_date=$this->input->get('end_date')) {
           		
           					
           					$start_date=$this->input->get('start_date');
           					$pid=$this->input->get('pid');
           					$did=$this->input->get('did');
           					$sid=$this->input->get('sid');
           					
           					if($did=='' or $pid=='' or $sid=='' or $start_date=='' )
           					{   
           					    $this->session->set_flashdata('errors','Please Select Program,Department,Section,Start Date,End Date');
           					    echo'<span>Please Select Program,Department,Section,Start Date,End Date</span>';
           					}
           		$this->set_title["title"] = $this->set_title('Program Management');

		$sort = !isset($_REQUEST['sort'])?'task':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		

						$this->db->select('taskk.status,users.user_name,taskk.id,taskk.title,users.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program');
					$this->db->join('projects','projects.id=taskk.project');
					$this->db->join('users','users.id=taskk.assign_uid');
					$this->db->where('taskk.program',$pid);
					$this->db->where('taskk.department',$did);
					$this->db->where('taskk.section',$sid);
					$this->db->where('taskk.start_date >=',$start_date);
					$this->db->where('taskk.end_date <=',$end_date);
		if ($this->session->userdata('user_role')!='Captain') {
						$this->db->where('taskk.assign_uid',$this->session->userdata('id'));
					}
					
					$res=$this->db->get();
					$tasklist=$res->result();


												if ($res->num_rows()>0) {
										foreach ($tasklist as $value) {
										    $uname='';
										    $user=$this->users_model->get_userdetails_by_id($value->created_by);
										    if(isset($user) and !empty($user))
										    {
										        $uname=$user['user_name'];
										    }
										    //var_dump($user);exit();
											
												?>

													<tr>
														<td><?=$value->end_date ?></td>
														<td><?=$value->title ?></td>
														<td><?= $uname ?></td>
														<td><?=$value->created_at ?></td>
														<td>
															<?php

																switch ($value->priority) {
																	case '0':
																		echo "Low";
																		break;
																		case '1':
																		echo "Medium";
																		break;
																		case '2':
																		echo "High";
																		break;
																		case '3':
																		echo "Very High";
																		break;
																		case '4':
																		echo "Urgent";
																		break;
																	
																}

															?>
														</td>
														<td><?=$value->pro_name ?></td>
														<td><?=$value->project_name ?></td>
														<td><?= $value->user_name?></td>
														<td><?php

																switch ($value->status) {
																	case '0':
																		echo "Not Assigned";
																		break;
																		case '1':
																		echo "Assigned";
																		break;
																		case '2':
																		echo "Opened";
																		break;
																		case '3':
																		echo "Mark As Completed";
																		break;
																		case '4':
																		echo "Approved";
																		break;
																			case '5':
																		echo "Aborted";
																		break;	case '6':
																		echo "Rejected";
																		break;
																	
																}

															?></td>


<td><a href="<?=  base_url('task/set_complete').'/'.$value->id ?>" style="color:white;background-color:#f10a0a;border-color: #f10a0a" class="	btn btn-info">View Details</a></td>
													</tr>

												<?php

										}
									}
									else
									{
										?>

										<tr><td colspan="10"><div class="alert alert-danger text-center">
											<h4>No Data Found</h4>
										</div></td></tr>
										<?php

								
}

           }
       }


				function secbydept()
	{
		if ($did=$this->input->get('did')) {
			$this->db->where('dept_id',$did);
			$res=$this->db->get('section');
			$secdata=$res->result();

			?>

					<select class="dept">
						<option >Select Please</option>
				<?php
											foreach ($secdata as $value) {
										?>
											<option value="<?=$value->id ?>" ><?=$value->section_name ?></option>


										<?php
											}


											?>
											</select>

			<?php
		}
	}




		//ajax request



	function sectionlistbydept()
	{

						if ($did=$this->input->get('did')) {
						


								$this->db->select('users.first_name,users.last_name,section.id,section.section_name,program.pro_name,department.dtitle,department.did,program.pid');
								$this->db->from('section');
								$this->db->join('program','program.pid=section.program_id');
								$this->db->join('users','users.id=section.section_head','left');
								$this->db->join('department','department.did=section.dept_id');
								$this->db->where('section.dept_id',$did);
								$joined_data=$this->db->get();
								$section_list=$joined_data->result();

                                    if($joined_data->num_rows()>0)
                                    {
									foreach($section_list as $data)
									{
							?>
								<tr class="odd gradeX">
									<!--  <td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();"></td>-->
								<tr>
									<td><?= $data->section_name ?></td>
									<td><?= $data->pro_name ?></td>
									<td><?= $data->dtitle ?></td>
									<td><?= $data->first_name.' '.$data->last_name ?></td>
									<td>
<!--<a onclick="return confirm('Are you sure to delete this ?')" href="<?= base_url('section/sectionunit/'.$data->id) ?>" class="btn btn-danger">Delete</a> <a onclick="return confirm('Are you sure to update this ?')"  href="<?= base_url('unit/editunit/'.$data->id) ?>" class="btn btn-info">Edit</a>-->
									<a style="color:white;background-color: #323200;border-color: #323200"  href="<?= base_url('section/single_section_view/'.$data->id) ?>" class="btn btn-info">View Details</a></td>
								</tr>
							<?php
									}
                                }
                                else
									{
										?>

										<tr><td colspan="4"><div class="alert alert-danger text-center">
											<h4>No Data Found</h4>
										</div></td></tr>
										<?php
									}
						
	}
}

function sectioneditbydept()
	{

						if ($did=$this->input->get('did')) {
						


									$this->db->select('users.first_name,users.last_name,section.id,section.section_name,program.pro_name,department.dtitle,department.did,program.pid');
								$this->db->from('section');
								$this->db->join('program','program.pid=section.program_id');
								$this->db->join('users','users.id=section.section_head','left');
								$this->db->join('department','department.did=section.dept_id');
								$this->db->where('section.dept_id',$did);
								$joined_data=$this->db->get();
								$unit_list=$joined_data->result();

                        
                                    if($joined_data->num_rows()>0)
                                    {
									foreach($unit_list as $data)
									{
							?>
								<tr class="odd gradeX">
									<!--  <td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();"></td>-->
								<tr>f
									<td><?= $data->section_name ?></td>
									<td><?= $data->pro_name ?></td>
									<td><?= $data->first_name.' '.$data->last_name ?></td>
									<td><?= $data->dtitle ?></td>
									<td>
<!--<a onclick="return confirm('Are you sure to delete this ?')" href="<?= base_url('section/deletesection/'.$data->id) ?>" class="btn btn-danger">Delete</a> <a onclick="return confirm('Are you sure to update this ?')"  href="<?= base_url('unit/editunit/'.$data->id) ?>" class="btn btn-info">Edit</a>-->
									<a style="color:white;background-color: #323200;border-color: #323200" onclick="return confirm('Are you sure to update this ?')"  href="<?= base_url('section/editsection/'.$data->id) ?>" class="btn btn-info">Edit</a></td>
								</tr>
							<?php
									}
                                    }
                                    else
									{
										?>

										<tr><td colspan="4"><div class="alert alert-danger text-center">
											<h4>No Data Found</h4>
										</div></td></tr>
										<?php
									}
						
	}
}



		
		function sectiondeletebydept()
	{

						if ($did=$this->input->get('did')) {
						


								$this->db->select('users.first_name,users.last_name,section.id,section.section_name,program.pro_name,department.dtitle,department.did,program.pid');
								$this->db->from('section');
								$this->db->join('program','program.pid=section.program_id');
								$this->db->join('users','users.id=section.section_head','left');
								$this->db->join('department','department.did=section.dept_id');
								$this->db->where('section.dept_id',$did);
								$joined_data=$this->db->get();
								$unit_list=$joined_data->result();

        
                            if($joined_data->num_rows()>0)
                            {
									foreach($unit_list as $data)
									{
							?>
								<tr class="odd gradeX">
									<!--  <td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();"></td>-->
								<tr>
									<td><?= $data->section_name ?></td>
									<td><?= $data->pro_name ?></td>
									<td><?= $data->dtitle ?></td>
									<td><?= $data->first_name.' '.$data->last_name ?></td>
									<td>
<a onclick="return confirm('Are you sure to delete this ?')" href="<?= base_url('section/deletesection/'.$data->id.'/'.$data->did.'/'.$data->pid) ?>" class="btn btn-danger" style="color:white;background-color: #323200;border-color: #323200">Delete</a></td>
								</tr>
		
							<?php
									}
                            }
                            else
									{
										?>

										<tr><td colspan="4"><div class="alert alert-danger text-center">
											<h4>No Data Found</h4>
										</div></td></tr>
										<?php
									}
	}
}

			function sectionbydept()
        	{
	            	       if ($did=$this->input->get('did')) {
			                    $this->db->where('dept_id',$did);
			                    $res=$this->db->get('section');
			                    $secdata=$res->result();
			                    
			                    if($res->num_rows()>0)
			                    {

			?>
                        <label>Select Section</label>
					<select class="form-control" name="section" id="getsec">
						<option >Select Section Please</option>
				<?php
											foreach ($secdata as $value) {
										?>
											<option value="<?=$value->id ?>" ><?=$value->section_name ?></option>


										<?php
											}


											?>
											</select>

			<?php
		}
else
{
	echo'<option>Section Not Available</option>';
}
	            	           
	            	           
	            	           
	            	           
	            	      
	            	       }
	}
		
						

}