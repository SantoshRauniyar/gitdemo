<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class unit extends Template
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

		function add_unit()
		{
				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_unit'))
		{

			$this->db->order_by('pro_name','asc');
			$p=$this->db->get('program');
		$data['program']=$p->result();

		$this->db->order_by('dtitle','asc');
		$d=$this->db->get('department');
		$data['dept']=$d->result();
		$data['userlist']=$this->authentication_model->getUnitHead();
		//var_dump($data);
			$this->view('unit/add_unit',$data);
		}//close
	}

			

		function do_save()
		{


			$this->form_validation->set_rules('unit_name','Unit Name','trim|required');
			$this->form_validation->set_rules('program','Program','trim|required');
			$this->form_validation->set_rules('dept','Department','trim|required');
			//$this->form_validation->set_rules('users','Members','required');
			$this->form_validation->set_rules('unithead','Unit Head','required|is_unique[unit.uhead]');

				if ($this->input->post('submit')) {
				    
					$id= $this->user_classification_model->getIdExsitPlusOne('id','unit');

						if ($this->form_validation->run()==TRUE) {
							
						
			$arr=[
                'id'=>$id,
				'unit_name'=>$this->input->post('unit_name'),
				'program'=>$this->input->post('program'),
				'dept'=>$this->input->post('dept'),
				'uhead'=>$this->input->post('unithead'),
				'section_id'=>$this->input->post('section_id')
				

			];
                
               // var_dump($arr);
				                    $ph=$this->db->select('pro_name,pro_head')->where('pid',$arr['program'])->from('program')->get()->result();
		                            $dh=$this->db->select('dtitle,manager_id')->where('did',$arr['dept'])->from('department')->get()->result();
		                            $sh=$this->db->select('section_name,section_head')->where('id',$arr['section_id'])->from('section')->get()->result();
			
		                            $pro_head=$ph[0]->pro_head;
		                            $dept_head=$dh[0]->manager_id;
		                            $pro_name=$ph[0]->pro_name;
		                            $dept_name=$dh[0]->dtitle;
		                            $section_name=$sh[0]->section_name;
		                            $section_head=$sh[0]->section_head;
			
	
			           
			            $to=$pro_head.','.$dept_head.','.$section_head.','.$arr['uhead'];
			            $emails=$this->user_role_model->getEmail($to);
			            //var_dump($to);
			           // var_dump($emails);
			            
			            if($this->db->insert('unit',$arr))
			            {

							/**
							 * Notification to associated users
							 * 
							 */


							$sentdata=[
								'message'=>'New '.$arr['unit_name'].' Unit Created.',
								'link'=>'unit/single_unit_view/'.$id												
							];
							$users=[$arr['uhead'],$section_head,$dept_head,$pro_head,$this->session->userdata('id')];
							$users=array_unique($users);
	;						foreach($users as $user)
							{
								$sentdata['to_users']=$user;
								$this->notification_model->sent_notification($sentdata);
	
				
							}


			            	//Mail Notification will be sent to Deaprtment head and Admin
				
						 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/unit/add.html");
					$emailBody = str_replace("<@unit_name@>",$arr['unit_name'],$emailBody);
					$emailBody = str_replace("<@section_name@>",$section_name,$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
					$emailBody = str_replace("<@link@>",base_url().'/unit/single_unit_view/'.$id,$emailBody);
					$emailBody = str_replace("<@pro_name@>",$pro_name,$emailBody);
						$emailBody = str_replace("<@dept_name@>",$dept_name,$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Unit Management - Unit Created in ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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

			
			
			redirect('unit/unitlist');
			
				

		} else {$this->db->order_by('pro_name','asc');
			$p=$this->db->get('program');
		$data['program']=$p->result();

		$this->db->order_by('dtitle','asc');
		$d=$this->db->get('department');
		$data['dept']=$d->result();
		$u=$this->db->get('users');
		$data['users']=$u->result();
$this->view('unit/add_unit',$data);
		
			
		
		}

}
}
}
					function unit_delete_list()
					{
	if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_unit'))
		{
			$plist=$this->db->get("program");
			$data['programlist']=$plist->result();
				$this->view('unit/unit_delete_list',$data);
					}//close

				}


				function deleteunit($id,$pro=null,$dept=null,$sec=null,$uhead=null)
				{

					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_unit'))
				{
				    
				     $ph=$this->db->select('pro_name,pro_head')->where('pid',$pro)->from('program')->get()->result();
		                            $dh=$this->db->select('dtitle,manager_id')->where('did',$dept)->from('department')->get()->result();
		                            
		                            
			
		                            $pro_head=$ph[0]->pro_head;
		                            $dept_head=$dh[0]->manager_id;
		                            $pro_name=$ph[0]->pro_name;
		                            $dept_name=$dh[0]->dtitle;
		                           
			
	                                    if(!empty($sec))
		                            {
		                            $sh=$this->db->select('section_name,section_head')->where('id',$sec)->from('section')->get()->result();
		                             $section_name=$sh[0]->section_name;
		                            $section_head=$sh[0]->section_head;
		                            }
		                            else
		                            {
		                                $section_head=$pro_head;
		                            }
			           
			            $to=$pro_head.','.$dept_head.','.$section_head.','.$uhead;
			            $emails=$this->user_role_model->getEmail($to);
			            var_dump($to);
			            var_dump($emails);
			            
			            if($this->db->where('id',$id)->delete('unit'))
			            {
			            	//Mail Notification will be sent to Deaprtment head and Admin
				
						 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/unit/delete.html");
					$emailBody = str_replace("<@unit_name@>",$arr['unit_name'],$emailBody);
					if(!empty($arr['section_id']))
					{
					$emailBody = str_replace("<@section_name@>",$section_name,$emailBody);
					}
					else
					{
					    $emailBody = str_replace("<@section_name@>",' ',$emailBody);
					}
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					$emailBody = str_replace("<@pro_name@>",$pro_name,$emailBody);
						$emailBody = str_replace("<@dept_name@>",$dept_name,$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Unit Management - Unit Delete in ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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
					
					redirect('unit/unit_delete_list');
				}
			}
				}


		function unitlist()
		{
			if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_unit'))
		{
				$this->db->select('*');
				$this->db->from('unit');
				$this->db->join('program','program.pid=unit.program');
			$ulist=$this->db->get();
			$data['unit_list']=$ulist->result();

			$plist=$this->db->get("program");
			$data['programlist']=$plist->result();
				$this->view('unit/unit_list',$data);
			}//close

		}

			function taskboard()
           {


				$data['prolist']=$this->program_model->getprogramdropdown();
				        
           				$this->view('unit/taskboard',$data);
           }
           
            function taskbyprodeptsecunit()
           {



           		if ($end_date=$this->input->get('end_date')) {
           		
           					
           					$start_date=$this->input->get('start_date');
           					$pid=$this->input->get('pid');
           					$did=$this->input->get('did');
           					$sid=$this->input->get('sid');
           					$uid=$this->input->get('uid');
           					
           					if($uid=='' or $pid=='' or $sid=='' or $start_date=='' )
           					{   
           					    $this->session->set_flashdata('errors','Please Select Program,Department,Section,Unit,Start Date,End Date');
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
					if(isset($sid) and !empty($sid)){
					$this->db->where('taskk.section',$sid);
					}
					$this->db->where('taskk.unit',$uid);
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
		function view_unit_edit()
		{
				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_unit'))
		{
				$plist=$this->db->get('program');
			$data['programlist']=$plist->result();
				$this->view('unit/editunitlist',$data);
		}//close
	}

		function editunit($id)
		{
if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_unit'))
		{
					$this->db->where('id',$id);
					$unit=$this->db->get('unit');
					$data['unitlist']=$unit->result();

		$p=$this->db->get('program');
		$data['program']=$p->result();
		$d=$this->db->get('department');
		$data['dept']=$d->result();

            $data['section']=$this->db->select('id,section_name')->from('section')->get()->result();
								$data['userlist']=$this->authentication_model->getUnitHead();
					$this->view('unit/edit_unit',$data);
		}//close
	}



		function single_unit_view($id)
		{
				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_unit'))
		{

					$this->db->where('id',$id);
					$unit=$this->db->get('unit');
					$data['unitlist']=$unit->result();

		$p=$this->db->get('program');
		$data['program']=$p->result();
		$d=$this->db->get('department');
		$data['dept']=$d->result();


$data['userlist']=$this->authentication_model->getUnitHead();
					$this->view('unit/single_unit',$data);
		}//close
	}

		function do_update($id)
		{


			$this->form_validation->set_rules('unit_name','Unit Name','trim|required');
			$this->form_validation->set_rules('program','Program','trim|required');
			$this->form_validation->set_rules('dept','Department','trim|required');
			//$this->form_validation->set_rules('users','Members','required');
			$this->form_validation->set_rules('unithead','Unit Head','required');

				if ($this->input->post('submit')) {
				

						if ($this->form_validation->run()==TRUE) {
							
			$arr=[

				'unit_name'=>$this->input->post('unit_name'),
				'program'=>$this->input->post('program'),
				'dept'=>$this->input->post('dept'),
				'uhead'=>$this->input->post('unithead'),
				'section_id'=>$this->input->post('section_id')

			];
			
			           
			
			                $sec=$this->input->post('section_id');
                           // var_dump($arr);

		                            $ph=$this->db->select('pro_name,pro_head')->where('pid',$arr['program'])->from('program')->get()->result();
		                            $dh=$this->db->select('dtitle,manager_id')->where('did',$arr['dept'])->from('department')->get()->result();
		                            
		                            
			
		                            $pro_head=$ph[0]->pro_head;
		                            $dept_head=$dh[0]->manager_id;
		                            $pro_name=$ph[0]->pro_name;
		                            $dept_name=$dh[0]->dtitle;
		                           
			
	                                    if(!empty($sec))
		                            {
		                            $sh=$this->db->select('section_name,section_head')->where('id',$arr['section_id'])->from('section')->get()->result();
		                             $section_name=$sh[0]->section_name;
		                            $section_head=$sh[0]->section_head;
		                            }
		                            else
		                            {
		                                $section_head=$pro_head;
		                            }
			           
			            $to=$pro_head.','.$dept_head.','.$section_head.','.$arr['uhead'];
			            $emails=$this->user_role_model->getEmail($to);
			           // var_dump($to);
			           // var_dump($emails);
			            
			            if($this->db->where('id',$id)->update('unit',$arr))
			            {
									/**
									 * 
									 * Notification block
									 * 
									 */
									$sentdata=[
										'message'=>$arr['unit_name'].' Unit Updated.',
										'link'=>'unit/single_unit_view/'.$id												
									];
									$users=[$arr['uhead'],$section_head,$dept_head,$pro_head,$this->session->userdata('id')];
									$users=array_unique($users);
			;						foreach($users as $user)
									{
										$sentdata['to_users']=$user;
										$this->notification_model->sent_notification($sentdata);
			
						
									}

			            	//Mail Notification will be sent to Deaprtment head and Admin
				
						 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/unit/edit.html");
					$emailBody = str_replace("<@unit_name@>",$arr['unit_name'],$emailBody);
					if(!empty($arr['section_id']))
					{
					$emailBody = str_replace("<@section_name@>",$section_name,$emailBody);
					}
					else
					{
					    $emailBody = str_replace("<@section_name@>",' ',$emailBody);
					}
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
					$emailBody = str_replace("<@link@>",base_url().'/unit/single_unit_view/'.$id,$emailBody);
					$emailBody = str_replace("<@pro_name@>",$pro_name,$emailBody);
						$emailBody = str_replace("<@dept_name@>",$dept_name,$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Unit Management - Unit Updated in ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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


			
			redirect('unit/unitlist');
			
				

		}
		else
		{
						$p=$this->db->get('program');
		$data['program']=$p->result();
		$d=$this->db->get('department');
		$data['dept']=$d->result();
						$u=$this->db->get('users');
		$data['users']=$u->result();
		//var_dump($data);
			$this->view('unit/editunit',$data);
		
			
		
		}

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
			function 	taskbyprodepuid()
			{


				          		if ($uid=$this->input->get('uid')) {
           				
           		
           		
           	                	$this->set_title["title"] = $this->set_title('Program Management');

								$program_head=$this->get_head("program","pid",$pid,"pro_head");
								$dept_head=$this->get_head("department","did",$did,"manager_id");
								$uhead=$this->get_head("unit","id",$uid,"uhead");

		$sort = !isset($_REQUEST['sort'])?'task':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

										




						$this->db->select('taskk.status,users.user_name,taskk.id,taskk.title,taskk.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program');
					$this->db->join('users','users.id=taskk.assign_uid');
					$this->db->where('unit',$uid);

							 //$mid=$this->get_head("program","pid",74,"pro_head");

							if ($this->session->userdata('user_role')!='Captain') {
						$this->db->where('taskk.assign_uid',$this->session->userdata('id'));
					}/*else if($this->session->userdata('id')!=$this->get_head("program","pid",74,"pro_head")) {
									$this->db->where('taskk.assign_uid',$this->session->userdata('id'));	
					}*/
					//$val=$this->get_head("program","pid",74,"pro_head");
					if ($this->session->userdata('id')==$program_head) {
						# code...
					}
					

					$res=$this->db->get();
					$tasklist=$res->result();


								
								}
							}
							


				function unitbydept()
	{
		if ($did=$this->input->get('did')) {
			$this->db->where('dept',$did);
			$res=$this->db->get('unit');
			$unitdata=$res->result();

			?>

					<select class="dept">
						<option >Select Please</option>
				<?php
											foreach ($unitdata as $value) {
										?>
											<option value="<?=$value->id ?>" ><?=$value->unit_name ?></option>


										<?php
											}


											?>
											</select>

			<?php
		}
	}
	
	
	
	                                	function unitbysec()
	{
		if ($sid=$this->input->get('sid')) {
			$this->db->where('section_id',$sid);
			$res=$this->db->get('unit');
			$unitdata=$res->result();
                        
                        if($res->num_rows()>0)
                        {
			?>
                                <label>Select Unit</label>
					<select class="form-control" name="unit">
						<option >Select Unit Please</option>
				<?php
											foreach ($unitdata as $value) {
										?>
											<option value="<?=$value->id ?>" ><?=$value->unit_name ?></option>


										<?php
											}


											?>
											</select>

			<?php
		}
		}
		/*else
		{
		    echo'<div class="text-danger">Unit Not Available</div>';
		}*/
	}




		//ajax request



	function unitlistbydept()
	{

						if ($sid=$this->input->get('sid')) {
						


								$this->db->select('unit.id,unit.unit_name,program.pro_name,department.dtitle');
								$this->db->from('unit');
								$this->db->join('program','program.pid=unit.program');
								$this->db->join('department','department.did=unit.dept');
								$this->db->join('section','section.id=unit.section_id');
								$this->db->where('unit.section_id',$sid);
								$joined_data=$this->db->get();
								$unit_list=$joined_data->result();


									foreach($unit_list as $data)
									{
							?>
								<tr class="odd gradeX">
									<!--  <td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();"></td>-->
								<tr>
									<td><?= $data->unit_name ?></td>
									<td><?= $data->pro_name ?></td>
									<td><?= $data->dtitle ?></td>
									<td>
<!--<a onclick="return confirm('Are you sure to delete this ?')" href="<?= base_url('unit/deleteunit/'.$data->id) ?>" class="btn btn-danger">Delete</a> <a onclick="return confirm('Are you sure to update this ?')"  href="<?= base_url('unit/editunit/'.$data->id) ?>" class="btn btn-info">Edit</a>-->
									<a style="color:white;background-color: #ef0f0f;border-color: #ef0f0f"  href="<?= base_url('unit/single_unit_view/'.$data->id) ?>" class="btn btn-info">View Details</a></td>
								</tr>
							<?php
									}
						
	}
}

function uniteditbydept()
	{

						if ($sid=$this->input->get('sid')) {
						


								$this->db->select('unit.id,unit.unit_name,program.pro_name,department.dtitle');
								$this->db->from('unit');
								$this->db->join('program','program.pid=unit.program');
								$this->db->join('department','department.did=unit.dept');
								$this->db->join('section','section.id=unit.section_id');
								$this->db->where('unit.section_id',$sid);
								$joined_data=$this->db->get();
								$unit_list=$joined_data->result();


									foreach($unit_list as $data)
									{
							?>
								<tr class="odd gradeX">
									<!--  <td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();"></td>-->
								<tr>
									<td><?= $data->unit_name ?></td>
									<td><?= $data->pro_name ?></td>
									<td><?= $data->dtitle ?></td>
									<td>
<!--<a onclick="return confirm('Are you sure to delete this ?')" href="<?= base_url('unit/deleteunit/'.$data->id) ?>" class="btn btn-danger">Delete</a> <a onclick="return confirm('Are you sure to update this ?')"  href="<?= base_url('unit/editunit/'.$data->id) ?>" class="btn btn-info">Edit</a>-->
									<a style="color:white;background-color: #ef0f0f;border-color: #ef0f0f" onclick="return confirm('Are you sure to update this ?')"  href="<?= base_url('unit/editunit/'.$data->id) ?>" class="btn btn-info">Edit</a></td>
								</tr>
							<?php
									}
						
	}
}



		
		function unitdeletebydept()
	{

						if ($sid=$this->input->get('sid')) {
						


								$this->db->select('unit.uhead,unit.id,unit.unit_name,program.pro_name,department.dtitle,unit.program,unit.dept,unit.section_id');
								$this->db->from('unit');
								$this->db->join('program','program.pid=unit.program');
								$this->db->join('department','department.did=unit.dept');
								$this->db->join('section','section.id=unit.section_id');
								$this->db->where('unit.section_id',$sid);
								$joined_data=$this->db->get();
								$unit_list=$joined_data->result();
                if(empty($data->section_id))
                {
                    $section_id=0;
                }
                else
                {
                    $section_id=$data->section_id;
                }

									foreach($unit_list as $data)
									{
							?>
								<tr class="odd gradeX">
									<!--  <td><input type="checkbox" id="chk[]" name="chk[]" onclick="check();"></td>-->
								<tr>
									<td><?= $data->unit_name ?></td>
									<td><?= $data->pro_name ?></td>
									<td><?= $data->dtitle ?></td>
									<td>
<!--<a onclick="return confirm('Are you sure to delete this ?')" href="<?= base_url('unit/deleteunit/'.$data->id) ?>" class="btn btn-danger">Delete</a> <a onclick="return confirm('Are you sure to update this ?')"  href="<?= base_url('unit/editunit/'.$data->id) ?>" class="btn btn-info">Edit</a>-->
									<a style="color:white;background-color: #ef0f0f;border-color: #ef0f0f"  href="<?= base_url('unit/deleteunit/'.$data->id).'/'.$data->program.'/'.$data->dept.'/'.$section_id.'/'.$data->uhead ?>" class="btn btn-info">Delete</a></td>
								</tr>
							<?php
									}
						
	}
}

			/**
			* @param
			*  Dashboard for unit
			*  total task
			*	approved task ->4
			*  rejected task ->5
			*  running late ->opened 2
			***/

			function get_task_details($colType=null,$colVal=null,$status_code,$for_count_coulmn,$status,$end_date=null,$start_date=null)
			{

						//$end= new DateTime($end_date);
						//$start= new DateTime($start_date);

				$this->db->select('count('.$for_count_coulmn.') as '.$status.'');
					$this->db->from('taskk');
					if($status_code<7){
					$this->db->where($for_count_coulmn,$status_code);}

					$this->db->where('assign_uid',$this->session->userdata('id'));
					
					if(!empty($colType))
					{
					$this->db->where($colType,$colVal);
					}
					if(!empty($end_date))
					{$this->db->where('taskk.start_date >=',$start_date);
					$this->db->where('taskk.end_date <=',$end_date);}

					$res=$this->db->get();
					$data=$res->result();
					$data=$data[0];
					return $data->$status;
			}

							function getdashboard()
							{

									if ($end_date=$this->input->get('end_date')) {
										$start_date=$this->input->get('start_date');
									        $colType=$this->input->get('dt');
									        $id=$this->input->get('dy');
									                	// Score calculation start here

										//	$this->db->where('created_by',$this->session->userdata('user_name'));
								//	$this->db->where('assign_uid',$this->session->userdata('id'));
								            
								        
								
        				        	
									
										
									                switch($colType)
									                {
									                    case "Program":
									                  
								$completed=$this->get_task_details("program",$id,3,'status','completed',$end_date,$start_date);//for opened or running task

								$approved=$this->get_task_details("program",$id,4,'status','approved',$end_date,$start_date);//for approved task
								$created=$this->get_task_details("program",$id,10,'id','created',$end_date,$start_date);//for approved task 10 is for created task
								$rejected=$this->get_task_details("program",$id,5,'status','rejected',$end_date,$start_date);

								$opened=$this->get_task_details("program",$id,2,'status','opened',$end_date,$start_date);//for opened or running task

								$delayed=$this->get_task_details("program",$id,4,'status','completed',$end_date,$start_date);//for approved task
								$awaited=$this->get_task_details("program",$id,3,'status','awaited',$end_date,$start_date);//for approved task 10 is for created task
								$progress=$this->get_task_details("program",$id,2,'status','running',$end_date,$start_date);
								$assigned=$this->get_task_details("program",$id,10,'id','assigned',$end_date,$start_date);
									                        break;
									                        
									                        case 'Department':
									                  
									                            	$completed=$this->get_task_details("department",$id,3,'status','completed',$end_date,$start_date);//for opened or running task

								$approved=$this->get_task_details("department",$id,4,'status','approved',$end_date,$start_date);//for approved task
								$created=$this->get_task_details("department",$id,10,'id','created',$end_date,$start_date);//for approved task 10 is for created task
								$rejected=$this->get_task_details("department",$id,5,'status','rejected',$end_date,$start_date);

								$opened=$this->get_task_details("department",$id,2,'status','opened',$end_date,$start_date);//for opened or running task

								$delayed=$this->get_task_details("department",$id,4,'status','completed',$end_date,$start_date);//for approved task
								$awaited=$this->get_task_details("department",$id,3,'status','awaited',$end_date,$start_date);//for approved task 10 is for created task
								$progress=$this->get_task_details("department",$id,2,'status','running',$end_date,$start_date);
								$assigned=$this->get_task_details("department",$id,10,'id','assigned',$end_date,$start_date);
									                        break;
									                        case 'Unit':
									       
									                       									                            	$completed=$this->get_task_details("department",$id,3,'status','completed',$end_date,$start_date);//for opened or running task

								$approved=$this->get_task_details("unit",$id,4,'status','approved',$end_date,$start_date);//for approved task
								$created=$this->get_task_details("unit",$id,10,'id','created',$end_date,$start_date);//for approved task 10 is for created task
								$rejected=$this->get_task_details("unit",$id,5,'status','rejected',$end_date,$start_date);

								$opened=$this->get_task_details("unit",$id,2,'status','opened',$end_date,$start_date);//for opened or running task

								$delayed=$this->get_task_details("unit",$id,4,'status','completed',$end_date,$start_date);//for approved task
								$awaited=$this->get_task_details("unit",$id,3,'status','awaited',$end_date,$start_date);//for approved task 10 is for created task
								$progress=$this->get_task_details("unit",$id,2,'status','running',$end_date,$start_date);
								$assigned=$this->get_task_details("unit",$id,10,'id','assigned',$end_date,$start_date);
								break;
								default:
								         return   '<div class="alert alert-danger">No Record Found</div>';
									                        
									                }
									        	 $cc=strtolower($colType);
									$this->db->select('*');
									$this->db->from('taskk');
							       
							        $this->db->where('taskk.start_date >=',$start_date);
									$this->db->where('taskk.end_date <=',$end_date);
							        $this->db->where($cc,$id);
							    	$res=$this->db->get();
										$data=$res->result();

												$score=0;
												$delayed_count=0;
											foreach ($data as $value) {
												
											$end= new DateTime($value->end_date);
											$comp=new DateTime($value->completed_at);
												//var_dump($end>$comp);

												if ($comp>$end) {
													$delayed_count+=1;
												}

												if ($value->status==4 and $comp<$end) {
														
														$value->end_date;
													$score+=2;
															
												}
												else if($value->status==4 and $comp>$end)
												{
													$value->end_date."<br>";
													$score+=1;
												}
											}
											$totalscore=$score;
												$delayedcount=$delayed_count;
									//closed score calculation




								?>

								<div class="row third_cls">
                <div class="col-md-4 col-lg-4 col-sm-6 left_bg">
                    <img class="bg" height="20%" style="height:2%;" src="<?= base_url('assets/dashboard').'/'?>hexagon.png" />
                    <div class="left_bg_div">
                        <span>Total Score</span>
                        <h2><?=  $totalscore ?></h2>
                    </div>
                </div>
                
                <div class="col-md-12 col-lg-8 third_innr_crcl" style="float:all;">
                    <div class="row" style="justify-content: space-between;">
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls marg_btm_cls">
                           
                                 <span>Task Assigned</span>
                            <h2><?= $created ?></h2>
                            
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls">
                             <span>Tasks Opened</span>
                            <h2><?= $opened ?></h2>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls blu">
                           <span>Tasks Marked Completed</span>
                            <h2><?=$completed?></h2>
                        </div>
                    </div>
                    <div class="row" style="justify-content: space-between;margin-top: 25px;">
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls grn marg_btm_cls">
                           <span>Tasks Got Approved</span>
                            <h2><?= $approved ?></h2>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls red marg_btm_cls">
                             <span>Tasks Got Rejected</span>
                            <h2><?= $rejected ?></h2>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls ylw">
                            <span>Tasks Approval Awaited</span>
                            <h2><?= $awaited ?></h2>

                        </div>
                    </div>
                    <div class="row" style="justify-content: space-between;margin-top: 25px;">
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls gray marg_btm_cls">
                           <span>Tasks Under Progress</span>
                            <h2><?= $progress ?></h2>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls pink marg_btm_cls">
                             <span>Tasks Delayed</span>
                            <h2><?= $delayedcount ?></h2>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls ygd">
                            <span>Tasks Quality Index</span>
                            <h2>12765</h2>
                        </div>
                    </div>
                </div>
            </div> <?php
        }

							}

			 public  function	dashboard()
				{
				    
				                        $res=$this->user_classification_model->is_head('uhead','unit');

			                            if(empty($res))
			                            {
			                                        $this->session->set_flashdata('errors',"Sorry! Contact your Admin");
			                                          return  redirect('/users/taskboard');       
			                            }
				                        
				                   $ddata['datalist']=$res;     
								$ddata['completed']=$this->user_classification_model->get_task_details("unit",$res[0]->id,3,'status','completed');//for opened or running task

								$ddata['approved']=$this->user_classification_model->get_task_details("unit",$res[0]->id,4,'status','approved');//for approved task
								$ddata['created']=$this->user_classification_model->get_task_details("unit",$res[0]->id,10,'id','created');//for approved task 10 is for created task
								$ddata['rejected']=$this->user_classification_model->get_task_details("unit",$res[0]->id,5,'status','rejected');
								$ddata['opened']=$this->user_classification_model->get_task_details("unit",$res[0]->id,2,'status','opened');//for opened or running task
								$ddata['delayed']=$this->user_classification_model->get_task_details("unit",$res[0]->id,4,'status','completed');//for approved task
								$ddata['awaited']=$this->user_classification_model->get_task_details("unit",$res[0]->id,3,'status','awaited');//for approved task 10 is for created task
								$ddata['progress']=$this->user_classification_model->get_task_details("unit",$res[0]->id,2,'status','running');
								$ddata['assigned']=$this->user_classification_model->get_task_details('unit',$res[0]->id,10,'id','assigned');

									// Score calculation start here

										$this->db->select('*');
									$this->db->from('taskk');
									//$this->db->where('created_by',$this->session->userdata('user_name'));
								//	$this->db->where('assign_uid',$this->session->userdata('id'));
									$this->db->where('unit',$res[0]->id);
									
										$res=$this->db->get();
										$data=$res->result();

												$score=0;
												$delayed_count=0;
											foreach ($data as $value) {
												
											$end= new DateTime($value->end_date);
											$comp=new DateTime($value->completed_at);
												//var_dump($end>$comp);

												if ($comp>$end) {
													$delayed_count+=1;
												}

												if ($value->status==4 and $comp<$end) {
														
														$value->end_date;
													$score+=2;
															
												}
												else if($value->status==4 and $comp>$end)
												{
													$value->end_date."<br>";
													$score+=1;
												}
											}
											$ddata['totalscore']=$score;
												$ddata['delayedcount']=$delayed_count;
									//closed score calculation


                        $ddata['heading']="Unit";
                        $ddata['r1']='id';
                        $ddata['r2']='unit_name';
                    
                        
					$this->view('dashboard/dashboard',$ddata);
				}

}