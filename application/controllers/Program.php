<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Program extends Template
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
		//$this->load->model('program_model');
		$this->load->model('authentication_model');
		$this->load->model('users_model');
		$this->load->model('user_role_model');
		$this->load->model('user_classification_model');
		$this->user_classification_model->set_role();
		$this->load->model('plan_model');
		$this->load->model('notification_model');
		$data['my']="santu";
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

		public	function dupload()
			{
					$config['upload_path']='./upload/';
					$config['allowed_types']='jpg|jpeg|png';
					$this->load->library('upload',$config);
					if($this->upload->do_upload('logo')) {
					return $this->upload->data();
					}
					else
					{
					    return	$this->upload->display_errors();
					}

			}
	function all()
	{

		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_pro'))
		{
			$this->db->select('program.*,users.first_name,users.last_name');
			$this->db->from('program');
			$this->db->join('users', 'users.id = program.pro_head','left');
		$this->db->order_by('pro_name','asc');
			$query = $this->db->get();
			$row=$query->result_array();
		 

		 $this->view('program/program_list',compact('row'));
		}
		else
	{
		$this->view('common/permit_abort');
	}


	}
	

		function 	filter_by($type)
		{

			switch ($type) {
				case "today":
								
								$this->db->select('taskk.status,users.user_name,taskk.id,taskk.title,taskk.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program');
					$this->db->join('projects','projects.id=taskk.project');
					$this->db->join('users','users.id=taskk.assign_uid');
							$this->db->where('cast(taskk.start_date as date) = cast(now() as date)');
							$this->db->order_by('taskk.start_date','DESC');
								$res=$this->db->get();
								$data=$res->result();
						


								break;
								case "yesterday":
							$this->db->select('taskk.status,users.user_name,taskk.id,taskk.title,taskk.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program');
					$this->db->join('projects','projects.id=taskk.project');
					$this->db->join('users','users.id=taskk.assign_uid');
							$this->db->where('cast(taskk.start_date as date) = date_sub(cast(now() as date), interval 1 day)');
							$this->db->order_by('taskk.start_date','DESC');
								$res=$this->db->get();
								$data=$res->result();

		
								break;	
				default:
					echo "So Sorrry!!!!!!!!!!!!!!!!!";
					break;
			}

						if ($this->db->count_all_results()>0) {
							$data['tasklist']=$data;
								$this->view('task/filtered_taskboard',$data);
							}
							else
							{
								echo "Not Found data";
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

			        function get_task_details($coltype,$colVal,$status_code,$for_count_coulmn,$status,$end_date=null,$start_date=null)
			{

						//$end= new DateTime($end_date);
						//$start= new DateTime($start_date);
                        $res=$this->user_classification_model->is_head('pro_head','program');
				    $this->db->select('count('.$for_count_coulmn.') as '.$status.'');
					$this->db->from('taskk');
					if($status_code<7){
					$this->db->where($for_count_coulmn,$status_code);}

					//$this->db->where('assign_uid',$this->session->userdata('id'));
					$this->db->where($coltype,$colVal);
					if(!empty($end_date))
					{$this->db->where('taskk.start_date >=',$start_date);
					$this->db->where('taskk.end_date <=',$end_date);}

					$res=$this->db->get();
					$data=$res->result();
					$data=$data[0];
					return $data->$status;
			}               
			
			                    public function is_head_Of()
			                    {
			                            $res=$this->user_classification_model->is_head('pro_head','program');
			                            if(!empty($res))
			                            {
			                                           var_dump($res[0]->pro_name);       
			                            }
			                            else
			                            {
			                                echo"Failed Cotact to admin";
			                            }
			                         
			                    }
			
		
		                     public  function	dashboard()
				{
				    
				                        $res=$this->user_classification_model->is_head('pro_head','program');

			                            if(empty($res))
			                            {
			                                          return  redirect('/users/taskboard');       
			                            }
				                        
				                   $ddata['datalist']=$res;     
								$ddata['completed']=$this->get_task_details("program",$res[0]->pid,3,'status','completed');//for opened or running task

								$ddata['approved']=$this->get_task_details("program",$res[0]->pid,4,'status','approved');//for approved task
								$ddata['created']=$this->get_task_details("program",$res[0]->pid,10,'id','created');//for approved task 10 is for created task
								$ddata['rejected']=$this->get_task_details("program",$res[0]->pid,5,'status','rejected');
								$ddata['opened']=$this->get_task_details("program",$res[0]->pid,2,'status','opened');//for opened or running task
								$ddata['delayed']=$this->get_task_details("program",$res[0]->pid,4,'status','completed');//for approved task
								$ddata['awaited']=$this->get_task_details("program",$res[0]->pid,3,'status','awaited');//for approved task 10 is for created task
								$ddata['progress']=$this->get_task_details("program",$res[0]->pid,2,'status','running');
								$ddata['assigned']=$this->get_task_details('program',$res[0]->pid,10,'id','assigned');

									// Score calculation start here

										$this->db->select('*');
									$this->db->from('taskk');
									//$this->db->where('created_by',$this->session->userdata('user_name'));
								//	$this->db->where('assign_uid',$this->session->userdata('id'));
									$this->db->where('program',$res[0]->pid);
									
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


                        $ddata['heading']="Program";//heading 
                        $ddata['r1']='pid'; //column to get to show  dropdown
                        $ddata['r2']='pro_name'; //column to get to show  dropdown
                        
					$this->view('dashboard/dashboard',$ddata);
				}
		
		
	
	/* 
		Add User Process
	*/
	public function add_program()
	{



		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_pro'))
		{
		

		$data = array();
		$this->set_title('Add Program');
		$data 				 = $this->session->flashdata('addprogram');

            
		$data['userlist']	 = $this->authentication_model->getProgramHead();
		//$data['planlist']	 = $this->plan_model->getplans();
		$data['mode'] 		 = "Add";
		$data['action'] 	 = base_url()."program/do_save/";
		$data['heading']	 = "Add Program";
		$this->view("program/add-edit-program",$data);
	}
	else
	{
		$this->view('common/permit_abort');
	}
	}
		//this function is userdefined for get exact path to upload

				function uploadkro_logo()
				{
					//echo $r='.$fieldname.';
				$logo = isset($_FILES['logo']['name'])?$_FILES['logo']['name']:'';
				//echo $logo;
$logo_tmp=isset($_FILES['logo']['tmp_name'])?$_FILES['logo']['tmp_name']:'';
$imageFileType = strtolower(pathinfo($logo,PATHINFO_EXTENSION));

//
				$fname=rand().'.'.$imageFileType;

				if($imageFileType=='png' | $imageFileType=='jpeg' | $imageFileType=='jpg' )
             {  if(move_uploaded_file($logo_tmp,'./upload/'.$fname))
               {
               	return $fname;
               	
               }

           }
               else
               {
               	return  false;
               }
           
           }
           function uploadkro_icon()
				{
					//echo $r='.$fieldname.';
				$logo = isset($_FILES['pro_icon']['name'])?$_FILES['pro_icon']['name']:'';
				//echo $logo;
$logo_tmp=isset($_FILES['pro_icon']['tmp_name'])?$_FILES['pro_icon']['tmp_name']:'';
$imageFileType = strtolower(pathinfo($logo,PATHINFO_EXTENSION));

//
				$fname=rand().'.'.$imageFileType;
              if($imageFileType=='png' | $imageFileType=='jpeg' | $imageFileType=='jpg' )
             {  if(move_uploaded_file($logo_tmp,'./upload/'.$fname))
               {
               	return $fname;
               	
               }

           }
               else
               {
               	return  false;
               }
           }

           function taskboard()
           {

			$pres=$this->db->get('program');
				$data['prolist']=$pres->result();
           				$this->view('program/taskboard',$data);
           }



           function taskboardbyprogram()
           {



           		if ($end_date=$this->input->get('end_date')) {
           						
           						$pid=$this->input->get('pid');
           						$start_date=$this->input->get('start_date');
           		$this->set_title["title"] = $this->set_title('Program Management');

		$sort = !isset($_REQUEST['sort'])?'task':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		

			$this->db->select('taskk.status,users.user_name,taskk.id,taskk.title,taskk.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program');
					$this->db->join('projects','projects.id=taskk.project');
					$this->db->join('users','users.id=taskk.assign_uid');

					$this->db->where('taskk.program',$pid);
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
											
												?>

													<tr>
														<td><?=$value->end_date ?></td>
														<td><?=$value->title ?></td>
														<td><?=$uname ?></td>
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


<td><a href="<?=  base_url('task/set_complete').'/'.$value->id ?>" style="color:white;background-color:#ef0f0f;border-color: #ef0f0f" class="	btn btn-info">View Details</a></td>
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





	
    function do_save()
					{
		$this->form_validation->set_rules('pro_name', 'Program Name', 'required');
		$this->form_validation->set_rules('pro_head', 'Program Head', 'required|is_unique[program.pro_head]');
		$this->form_validation->set_rules('pro_code', 'Program Code', 'required');
								if($this->input->post('submit'))
								{

									if ($this->form_validation->run()==false) {
										
									
									
							
								$this->view('program/add-edit-program');
									}
									else
									{
				             $id= $this->user_classification_model->getIdExsitPlusOne('pid','program');

						$arr=[
						                'pid'=>$id,
										'pro_name'=>$this->input->post('pro_name'),				
										'pro_head'=>$this->input->post('pro_head'),
										'pro_code'=>$this->input->post('pro_code'),
										'team_id'=>29				
							];
								

								//New Logo
								if($new_img=$this->uploadkro_logo())
								{
									$arr['logo']=$new_img;
								}
								else
								{
									$arr['logo']=$old_img;
								}

								

								//New Icon
								if($new_icon=$this->uploadkro_icon())
								{
									$arr['icon']=$new_icon;
								}
								else
								{
									$arr['icon']=$old_icon;
								}

								
								
									if($this->db->insert('program',$arr))
									{
										
								$sentdata=[
												'message'=>'New '.$arr['pro_name'].' program has been created.',
												'link'=>'Program/single_program/'.$id												
											];
												$users=[$arr['pro_head'],$this->session->userdata('id')];
											foreach($users as $user)
											{
												$sentdata['to_users']=$user;
												$this->notification_model->sent_notification($sentdata);

								
											}
							
											//When program Updated then we will send an email to admin,program_head or ex. pro_head
                                            
                                            $emails=$this->user_role_model->getEmail($arr['pro_head']);
                                            	 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/program.html");
					$emailBody = str_replace("<@pro_name@>",$arr['pro_name'],$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
					$emailBody = str_replace("<@link@>",base_url().'Program/single_program/'.$id,$emailBody);
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Project Management - Program Created ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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
			        	
			        	redirect('Program/all');

                                            //var_dump($emails);

									}
			                                    	//var_dump($arr);
											
									}
								}

					}


					function delete_program($id,$pro_name=null,$ph=null)
					{



								if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_pro'))
		{

					$q="DELETE from program where pid=$id";
				$result=$this->db->query($q);
					
					
					$emails=$this->user_role_model->getEmail($ph);
			
					
					
					if($result)
					{

								
			                		 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/delete_program.html");
					$emailBody = str_replace("<@pro_name@>",$pro_name,$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
					//$emailBody = str_replace("<@link@>",'Deleted',$emailBody);
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Project Management - Program Deleted ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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
			        	
			        	redirect('Program/all');
		            
		                    	}
	                            	}
		                    			}
		

					

					function update_program($id)
					{


									if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_pro'))
		{


		                   

									
								$data['res']=$this->db->where('pid',$id)->get('program')->result();
						$data['userlist']	 = $this->authentication_model->getProgramHead();
						
							
								$this->view('program/update_program',$data);
							}

						
					}



					//single programm view
					function single_program($id)
					{


									if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_pro'))
		{


		$data 				 = $this->session->flashdata('addprogram');
		

		                $data_head_office		= $this->user_role_model->getuserbyrole(46);
									
								$this->db->where('pid',$id);
								$data=$this->db->get('program');
								$res=$data->result();
									
							
								$this->view('program/single_program',compact('data_head_office','res'));

							}

						
					}

                            function do_update($id)
					{
		$this->form_validation->set_rules('pro_name', 'Program Name', 'required');
		$this->form_validation->set_rules('pro_head', 'Program Head', 'required');
		$this->form_validation->set_rules('pro_code', 'Program Code', 'required');
								if($this->input->post('submit'))
								{

									if ($this->form_validation->run()==false) {
										
									$this->db->where('pid',$id);
								$data=$this->db->get('program');
								$res=$data->result();
									
							
								$this->view('program/update_program',compact('res'));
									}
									else
									{
				

						$arr=[
										'pro_name'=>$this->input->post('pro_name'),				
										'pro_head'=>$this->input->post('pro_head'),
										'pro_code'=>$this->input->post('pro_code'),
										'team_id'=>29				
							];
								$old_img=$this->input->post('oldimg');
								$old_icon=$this->input->post('oldicon');

								//New Logo
								if($new_img=$this->uploadkro_logo())
								{
									$arr['logo']=$new_img;
								}
								else
								{
									$arr['logo']=$old_img;
								}

								

								//New Icon
								if($new_icon=$this->uploadkro_icon())
								{
									$arr['icon']=$new_icon;
								}
								else
								{
									$arr['icon']=$old_icon;
								}

								
									$this->db->where('pid',$id);
									if($this->db->update('program',$arr))
									{
										

										$sentdata=[
											'message'=>$arr['pro_name'].' program has been Updated.',
											'link'=>'Program/single_program/'.$id												
										];
											$users=[$arr['pro_head'],$this->session->userdata('id')];
										foreach($users as $user)
										{
											$sentdata['to_users']=$user;
											$this->notification_model->sent_notification($sentdata);

							
										}

											//When program Updated then we will send an email to admin,program_head or ex. pro_head
                                            
                                            $emails=$this->user_role_model->getEmail($arr['pro_head']);
                                            	 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/edit_program.html");
					$emailBody = str_replace("<@pro_name@>",$arr['pro_name'],$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
					$emailBody = str_replace("<@link@>",base_url().'Program/single_program/'.$id,$emailBody);
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Project Management - Program Updated ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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
			        	
			        	redirect('Program/program_edit_list');

                                            //var_dump($emails);

									}
			                                    	//var_dump($arr);
											
									}
								}

					}

 		function program_dashboard()
 		{
 			$this->db->select('*');
			$this->db->from('program');
			$this->db->join('users', 'users.id = program.pro_head');
			$this->db->order_by('pro_name','asc');
			$query = $this->db->get();
			$row=$query->result_array();
 			$this->view('program/program_dashboard',compact('row'));
 		}


 			function program_delete_list()
 			{
if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_pro'))
		{


			$this->db->select('program.*,users.first_name,users.last_name');
			$this->db->from('program');
			$this->db->join('users', 'users.id = program.pro_head','left');
			//$this->db->where('team_id',29);
		$this->db->order_by('pro_name','asc');
			$query = $this->db->get();
			$row=$query->result_array();
		 

		 $this->view('program/prodel_list',compact('row'));

}


 			}
 			function program_edit_list()
 			{

if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_pro'))
		{

			$this->db->select('program.*,users.first_name,users.last_name');
			$this->db->from('program');
			$this->db->join('users', 'users.id = program.pro_head','left');
			//$this->db->where('team_id',29);
						$this->db->order_by('pro_name','asc');
			$query = $this->db->get();
			$row=$query->result_array();
		 

		 $this->view('program/proedit_list',compact('row'));


}

 			}




}
?>