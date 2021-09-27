<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Groups extends Template
{
	public function __construct()
	{
		parent::__construct();
		
		//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		//header("Cache-Control: no-store,no-cache, must-revalidate");
		
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->model('team_model');
				$this->load->model('task_model');
		$this->load->model('groups_model');
		$this->load->model('authentication_model');
	$this->load->model('user_classification_model');
	$this->load->model('notification_model');
		$this->user_classification_model->set_role();
		$this->load->model('users_model');
		$this->load->model('user_role_model');
		$this->set_header_path('blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->set_template('template');
		$this->set_title('Group Management');
		
		
		$this->assets_load->add_js(array(base_url('assets/administrator/js/vendors/group.js')),"footer");
		
		if(!$this->session->userdata('id'))
			redirect("authentication/");
	}
	public function index()
	{
		$this->all();
	}
	
	/*
		Manage users view
	*/
	public function all()
	{

					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_groups'))
		{

		//$this->data['current_page'] = 'viewdetail';
		$this->set_title["title"] = $this->set_title('Group Management');

		$sort = !isset($_REQUEST['sort'])?'groups_title':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
		
		$team_id = $this->session->userdata('team_id');
		if($team_id == '')
			$team = NULL;
		//$userdata = $this->groups_model->getgroupslist($sort,$type,$this->session->userdata('id'),$team_id);

			$this->db->select('*');
			$this->db->from('department');
			$this->db->join('users','users.id=department.manager_id');
			$this->db->join ( 'program', 'program.pid = department.program_id');
			
			$res=$this->db->get();
			$userdata=$res->result();


		if($type=='asc')
			$type ='desc';
		else
			$type ='asc';
			
      	$data['type'] = $type;
      	$data['sort'] = $sort;
      	$data['userdata']=$userdata;
	
//var_dump($userdata);
						$pres=$this->db->get('program');
						$plist=$pres->result();

					$data['programlist']=$plist;
      	$data['url']  = $_SERVER['PHP_SELF'].'?sort='.$sort.'&type='.$type;
      //$this->view('administrator/admin_category_templet',$this->data);
		$this->view("groups/group_list",$data);
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

			function get_task_details($status_code,$for_count_coulmn,$status,$end_date=null,$start_date=null)
			{

						//$end= new DateTime($end_date);
						//$start= new DateTime($start_date);

				$this->db->select('count('.$for_count_coulmn.') as '.$status.'');
					$this->db->from('taskk');
					if($status_code<7){
					$this->db->where($for_count_coulmn,$status_code);}

					$this->db->where('assign_uid',$this->session->userdata('id'));
					if(!empty($end_date))
					{$this->db->where('taskk.start_date >=',$start_date);
					$this->db->where('taskk.end_date <=',$end_date);}

					$res=$this->db->get();
					$data=$res->result();
					$data=$data[0];
					return $data->$status;
			}
		
		               public  function	dashboard()
				{
				    
				                        $res=$this->user_classification_model->is_head('manager_id','department');

			                            if(empty($res))
			                            {
			                                          return  redirect('/users/taskboard');       
			                            }
				                        
				                   $ddata['datalist']=$res;     
								$ddata['completed']=$this->user_classification_model->get_task_details("department",$res[0]->did,3,'status','completed');//for opened or running task

								$ddata['approved']=$this->user_classification_model->get_task_details("department",$res[0]->did,4,'status','approved');//for approved task
								$ddata['created']=$this->user_classification_model->get_task_details("department",$res[0]->did,10,'id','created');//for approved task 10 is for created task
								$ddata['rejected']=$this->user_classification_model->get_task_details("department",$res[0]->did,5,'status','rejected');
								$ddata['opened']=$this->user_classification_model->get_task_details("department",$res[0]->did,2,'status','opened');//for opened or running task
								$ddata['delayed']=$this->user_classification_model->get_task_details("department",$res[0]->did,4,'status','completed');//for approved task
								$ddata['awaited']=$this->user_classification_model->get_task_details("department",$res[0]->did,3,'status','awaited');//for approved task 10 is for created task
								$ddata['progress']=$this->user_classification_model->get_task_details("department",$res[0]->did,2,'status','running');
								$ddata['assigned']=$this->user_classification_model->get_task_details('department',$res[0]->did,10,'id','assigned');

									// Score calculation start here

										$this->db->select('*');
									$this->db->from('taskk');
									//$this->db->where('created_by',$this->session->userdata('user_name'));
								//	$this->db->where('assign_uid',$this->session->userdata('id'));
									$this->db->where('department',$res[0]->did);
									
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


                        $ddata['heading']="Department";
                        $ddata['r1']='did';
                        $ddata['r2']='dtitle';
                    
                        
					$this->view('dashboard/dashboard',$ddata);
				}
		
		


        function get_user_name($email)
        {
           $res= $this->user_role_model->get_username($email);
           if(!empty($res))
           {
          // var_dump($res);
              return $res->first_name.' '.$res->last_name;
           }
           else
           {
               return $email;
           }
        }





				function deptlistbypro()
				{

							if ($pid=$this->input->get('pid')) {
								


			$this->db->select('*');
			$this->db->from('department');
			$this->db->join('users','users.id=department.manager_id');
			$this->db->join ( 'program', 'program.pid = department.program_id');
			$this->db->where('program_id',$pid);
			
			
			$res=$this->db->get();
			$userdata=$res->result();

									foreach($userdata as $data)
									{
							?>
								<tr class="odd gradeA">
									
									<td>
										<?php echo $data->dtitle;?>
									</td>
									
									
									<td class="center"><?php  echo $data->first_name.' '.$data->last_name;?></td>
									<td><?=  $data->pro_name?></td>
									<td align="center">
										<a class="btn btn-info" style="background-color: #f10a0a;color:white;border-color: #f10a0a" href="<?php echo base_url('groups/view_department/'.$data->did);?>">
											View Details
										</a>&nbsp;
										
										<!--<a href="javascript:void(0);" onclick="single_team_delete('groups/single_group_delete/<?php echo $data->id;?>','Grouplistform','Are you sure you want to delete this group ?','Group deleted successfully.');">
											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete">
										</a>-->
									</td>
								</tr>
							<?php
									}
									
								
						
							}

				}



							function deldeptlistbypro()
				{

							if ($pid=$this->input->get('pid')) {
								


			$this->db->select('*');
			$this->db->from('department');
			$this->db->join('users','users.id=department.manager_id');
			$this->db->join ( 'program', 'program.pid = department.program_id');
			$this->db->where('program_id',$pid);
			
			$res=$this->db->get();
			$userdata=$res->result();



									foreach($userdata as $data)
									{
							?>
								<tr class="odd gradeA">
									
									<td>
										<?php echo $data->dtitle;?>
									</td>
									
									<!-- <td class="center"><?php  echo $data->team_name;?></td>-->
									<td class="center"><?php  echo $data->first_name.' '.$data->last_name;?></td>
									<td><?=  $data->pro_name?></td>
									<td align="center">
										<!--<a class="btn btn-info" style="background-color: #f10a0a;color:white;border-color: #f10a0a" href="<?php echo base_url('groups/edit_group/'.$data->did);?>">
											Edit
										</a>-->&nbsp;
										
										<a class="btn btn-info" style="background-color: #f10a0a;color:white;border-color: #f10a0a" href="<?= base_url('groups/delete_dept/').'/'.$data->did.'/'.$data->manager_id.'/'.$data->dtitle.'/'.$data->pro_head.'/'.$data->pro_name ?>" onclick="return confirm('Are you sure to delete this Department')">Delete
											
										</a>
									</td>
								</tr>
							<?php
									}
								}
							}





							function editdeptlistbypro()
				{

							if ($pid=$this->input->get('pid')) {
								


			$this->db->select('*');
			$this->db->from('department');
			$this->db->join('users','users.id=department.manager_id','left');
			$this->db->join ( 'program', 'program.pid = department.program_id');
			$this->db->where('program_id',$pid);
			
			$res=$this->db->get();
			$userdata=$res->result();



											foreach($userdata as $data)
									{
							?>
								<tr class="odd gradeA">
									
									<td>
										<?php echo $data->dtitle;?>
									</td>
									
									<!-- <td class="center"><?php  echo $data->team_name;?></td>-->
									<td class="center"><?php  echo $data->first_name.' '.$data->last_name;?></td>
									<td><?=  $data->pro_name?></td>
									<td align="center">
										<a class="btn btn-info" style="background-color: #f10a0a;color:white;border-color: #f10a0a" href="<?php echo base_url('groups/edit_group/'.$data->did);?>">
											Edit
										</a>&nbsp;
										
										<!--<a href="javascript:void(0);" onclick="single_team_delete('groups/single_group_delete/<?php echo $data->id;?>','Grouplistform','Are you sure you want to delete this group ?','Group deleted successfully.');">
											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete">
										</a>-->
									</td>
								</tr>
							<?php
									}
							
								}
							}
									
								
						




	function deptbyprogram()
	{
		if ($pid=$this->input->get('pid')) {
			$this->db->where('program_id',$pid);
			$this->db->where('is_sec',1);
			$res=$this->db->get('department');
			
			$deptdata=$res->result();
             if($res->num_rows()>0)
             {
			?>

				
						<option >Select Please</option>
				<?php
					foreach ($deptdata as $value) {
				?>
				<option  value="<?=$value->did?>" ><?=$value->dtitle ?></option>


										<?php
											}
             }
             else
             {
                 echo"<option>Department not applicable</option>";
             }


		}
	}




	function deptbypro()
	{
		if ($pid=$this->input->get('pid')) {
			$this->db->where('program_id',$pid);
			$res=$this->db->get('department');
			$deptdata=$res->result();

			?>

				
						<option >Select Please</option>
				<?php
											foreach ($deptdata as $value) {
										?>
											<option value="<?=$value->did ?>" ><?=$value->dtitle ?></option>


										<?php
											}


		}
	}
	
	
	
	            	function sectionbyDept()
	{
		if ($did=$this->input->get('did')) {
		    $this->db->select('id,section_name');
			$this->db->where('dept_id',$did);
			$this->db->order_by('section_name','ASC');
			$res=$this->db->get('section');
			$sectiondata=$res->result();
                        
                        
                        if($res->num_rows()>0)
                        {
			?>

				
						<option >Select Please</option>
				<?php
											foreach ($sectiondata as $value) {
										?>
											<option value="<?=$value->id ?>" ><?=$value->section_name ?></option>


										<?php
											}
                        }
                        else
                        {
                            echo"<option>Section not applicable</option>";
                        }


		}
	}




		  function taskbyprodept()
           {



           		if ($end_date=$this->input->get('end_date')) {
           		
           					
           					$start_date=$this->input->get('start_date');
           					$pid=$this->input->get('pid');
           					$did=$this->input->get('did');
           					
           					if($did=='' or $pid=='' or $start_date=='' )
           					{
           					    $this->session->set_flashdata('errors','Please Select Program,Department,Start Date,End Date');
           					   // return redirect('/groups/taskboard');
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





                    function taskboard()
           {

		                	$pres=$this->db->get('program');
			            	$data['prolist']=$pres->result();

           				$this->view('groups/taskboard',$data);
           }


//delete group list


public function delete_deptlist()
	{

							if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_delete_group_member'))
		{

		//$this->data['current_page'] = 'viewdetail';
		$this->set_title["title"] = $this->set_title('Group Management');

		$sort = !isset($_REQUEST['sort'])?'groups_title':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
		
		$team_id = $this->session->userdata('team_id');
		if($team_id == '')
			$team = NULL;
		//$userdata = $this->groups_model->getgroupslist($sort,$type,$this->session->userdata('id'),$team_id);

			
			$res=$this->db->get('program');
			$userdata=$res->result();


		if($type=='asc')
			$type ='desc';
		else
			$type ='asc';
			
      	$data['type'] = $type;
      	$data['sort'] = $sort;
      	$data['programlist']=$userdata;
	
//var_dump($userdata);
		
      	$data['url']  = $_SERVER['PHP_SELF'].'?sort='.$sort.'&type='.$type;
      //$this->view('administrator/admin_category_templet',$this->data);
		$this->view("groups/deldept_list",$data);
	}
}

	/* 
		Add User Process
	*/
	public function add_group()
	{

			if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_group_member'))
		{

		$data = array();
		$this->set_title('Add Group');
		$data 				 = $this->session->flashdata('addgroupdata');
		//$data['projectlist'] = $this->projects_model->getPrjectList();
		//$data['teamlist']	 = $this->team_model->getteams($this->session->userdata('id'));
		$data['userlist']	 = $this->users_model->getUserByTeamId($this->session->userdata('team_id'));
		$data['mode'] 		 = "Add";
		$data['action'] 	 = base_url()."groups/do_save";
		$data['heading']	 = "Add Group";
			$this->db->order_by('pro_name','asc');
			$p=$this->db->get('program');
			$data['programlist'] = $p->result();
		$this->db->order_by('user_name','a');
			
			
            $data['userlist']= $this->authentication_model->getDepartmentHead();
		$this->view("groups/add_edit_group",$data);

	}
	}
	
	public function getUserlist($team_id)
	{
		$userlist = $this->users_model->get_user_list($team_id);
		if($this->input->is_ajax_request())
		{
			$data['status'] = "success";
			$data['data']   = $userlist;
			echo json_encode($data);
			exit;
		}
	}

	
	public function do_save()
	{ 
				

				 $id= $this->user_classification_model->getIdExsitPlusOne('did','department');
				$arr=[
                    "did"=>$id,
					"dtitle"=>$this->input->post('dtitle'),
					"program_id"=>$this->input->post('pid'),
					"manager_id"=>$this->input->post('mid'),
					"is_sec"=>$this->input->post('sec'),
					"team_id"=>29

				];


						$this->form_validation->set_rules('dtitle','Department Titile','trim|required');
						$this->form_validation->set_rules('pid','Program','trim|required');
						$this->form_validation->set_rules('mid','Head','trim|required|is_unique[department.manager_id]');
						$this->form_validation->set_rules('sec','Choose Secction','required');
			            
			            //get progran head ID and program name
			            $res=$this->db->where('pid',$arr['program_id'])->get('program')->result();
			               $pro_head=$res[0]->pro_head;
			               $pro_name=$res[0]->pro_name;
			               // var_dump($res);
			             //closed
			                
			              if($this->form_validation->run()==true)
			              {
			                
			            $to=$arr['manager_id'].','.$pro_head;
			            $emails=$this->user_role_model->getEmail($to);
                        
                        
						if ($this->form_validation->run()==true) {
						

					if($this->db->insert('department',$arr))
					
					{
						$sentdata=[
							'message'=>'New'.$arr['dtitle'].' Department Created.',
							'link'=>'groups/view_department/'.$id												
						];
							$users=[$arr['manager_id'],$pro_head,$this->session->userdata('id')];
							$users=array_unique($users);
;						foreach($users as $user)
						{
							$sentdata['to_users']=$user;
							$this->notification_model->sent_notification($sentdata);

			
						}
				$this->session->set_flashdata( "success", "Department created successfully.");
				
				//Mail Notification will be sent to Deaprtment head and Admin
				
						 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/dept/add.html");
					$emailBody = str_replace("<@dept_name@>",$arr['dtitle'],$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->get_user_name($value->email),$emailBody);
					$emailBody = str_replace("<@pro_name@>",$pro_name,$emailBody);
					$emailBody = str_replace("<@link@>",base_url().'groups/view_department/'.$id,$emailBody);
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Department Management - Created Department in ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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
				
				
				
				
				redirect('groups/all');
					}
					else
					{
					    redirect('groups/all');   
					}
						}
				
			}
			else
			{
						$this->db->order_by('pro_name','asc');
			$p=$this->db->get('program');
			$data['programlist'] = $p->result();
		$this->db->order_by('user_name','asc');
			$u=$this->db->get('users');

		$data['userlist'] = $u->result();
		$this->view("groups/add_edit_group",$data);
			}

	}
	
	
	public function edit_group($id)
	{
			if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_group_chat_board'))//is_group_chat_board this is for edit status
		{

		$data = array();
		$this->set_title('Edit Group');
		
		
		$this->db->where('did',$id);
		$res=$this->db->get('department');
		$editlist=$res->result();
		//var_dump( $editlist);
		$data['editlist']=$editlist;
		$data['heading']	 = "Edit Group";
		


		$this->db->order_by('pro_name','asc');
		$p=$this->db->get('program');
		$data['programlist'] = $p->result();

		
					///$ignore = array(22,36,24,37,21);//district partner,state partner,country,cityzone

            $u=$this->db->select('id,first_name,last_name')->from('users')->where('user_role',25 )->order_by('first_name','asc')->get();
            		$data['userlist'] = $u->result();
		$this->view("groups/department_edit",$data);
	}
}


		public function view_department($id)
		{
				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_group_chat_board'))
		{

			$data = array();
		$this->set_title('Edit Group');
		

			$this->db->select('*');
			$this->db->from('department');
			$this->db->join('users','users.id=department.manager_id');
			$this->db->join ( 'program', 'program.pid = department.program_id');
			$this->db->where('did',$id);
			
			$res=$this->db->get();
			$userdata=$res->result();
			$data['userdata']=$userdata;

				$pres=$this->db->get('program');
					$data['programlist']=$pres->result();

			$this->view("groups/show_dept",$data);
		}
	}

	
	public function do_update($id)
	{
		
		
				
				$arr=[

					"dtitle"=>$this->input->post('dtitle'),
					"program_id"=>$this->input->post('pid'),
					"manager_id"=>$this->input->post('mid'),
										"is_sec"=>$this->input->post('sec'),
					"team_id"=>29

				];


						$this->form_validation->set_rules('dtitle','Department Titile','trim|required');
						$this->form_validation->set_rules('pid','Program','trim|required');
						$this->form_validation->set_rules('mid','Head','trim|required');
						//$this->form_validation->set_rules('sec','Choose Section','required');
			            
			            //get program head by Program ID
			            $res=$this->db->where('pid',$arr['program_id'])->get('program')->result();
			               $pro_head=$res[0]->pro_head;
			               $pro_name=$res[0]->pro_name;

						if ($this->form_validation->run()==true) {
						
							$this->db->where('did',$id);
					$res=$this->db->update('department',$arr);
				//	echo " Successfully Updated data";
					if($res)
					{
						$sentdata=[
							'message'=>$arr['dtitle'].' Department Updated.',
							'link'=>'groups/view_department/'.$id												
						];
							$users=[$arr['manager_id'],$pro_head,$this->session->userdata('id')];
							$users=array_unique($users);
;						foreach($users as $user)
						{
							$sentdata['to_users']=$user;
							$this->notification_model->sent_notification($sentdata);

			
						}	
					}
					$emails=$this->user_role_model->getEmail($pro_head);
							 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/dept/edit.html");
					$emailBody = str_replace("<@dept_name@>",$arr['dtitle'],$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->get_user_name($value->email),$emailBody);
					$emailBody = str_replace("<@pro_name@>",$pro_name,$emailBody);
					$emailBody = str_replace("<@link@>",base_url().'groups/view_department'.$id,$emailBody);
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Department Management - Department Updated ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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
					
					
				$this->session->set_flashdata( "success", "Department Updated successfully.");
			
			      
				redirect('groups/dept_edit_list');
			}
			else
			{
						$this->db->order_by('pro_name','asc');
			$p=$this->db->get('program');
			$data['programlist'] = $p->result();
		$this->db->order_by('user_name','asc');
			$u=$this->db->get('users');

		$data['userlist'] = $u->result();
		$this->view("groups/edit_dept",$data);
			
			
		}
	}
	
	/*
		Delete milestone
	*/
	public function single_group_delete($id)
	{
		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_delete_group_member'))
		{
		$result = $this->groups_model->do_delete($id);
		//echo $result;exit;
		
		if($this->input->is_ajax_request())
		{		
			if($result)
			{
				echo 1;
				exit;
			}
			else
			{
				echo 0;
				exit;
			}
		}
		redirect("groups/all");
	}
	}


		function dept_edit_list()
		{

					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_group_chat_board'))
		{

			$res=$this->db->get('program');
			$userdata=$res->result();
			$data['programlist']=$userdata;
			//var_dump($userdata);
			$this->view('groups/deptedit_list',$data);
		}

	}
	
	
	public function delete_dept($id,$dh=null,$dtitle=null,$pro_head=null,$pro_name=null)

	{

							if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_delete_group_member'))
		{
	                    	$this->db->where('did',$id);
	                    	if($this->db->delete('department'))
	                    	{
	                    	    
	                    	    //$to=$dh.','.$pro_head; 
	                    	    /**
	                    	    *Mail sent to  Admin and Program Head not Department 
	                    	    * 
	                    	    * 
	                    	    * */
	                    	    
	                    	    
	                    	    $emails=$this->user_role_model->getEmail($pro_head);
	                    	  		 foreach ($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/dept/delete.html");
					$emailBody = str_replace("<@dept_name@>",$dtitle,$emailBody);
					$emailBody = str_replace("<@pro_name@>",$pro_name,$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->get_user_name($value->email),$emailBody);
				//	$emailBody = str_replace("<@link@>",'Deleted',$emailBody);
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Department Management - Department Deleted ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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
	                    	  
	                    	  redirect('groups/delete_deptlist');  
	                    	}
		                        

			}
}

		function create_code()
							{
								$res=$this->db->query("select max(id) as'code' FROM lead_generation");
								//$this->db->from('content_production_order');
								//$res=$this->db->get();
								$data=$res->result();
								$data=$data[0];
										$digit=$data->code;
										$max=$digit;					
								 $max = str_pad($max+1, 8, '0', STR_PAD_LEFT);
								
								 	return $max;
								}

		function	create_lead_generation()
		{

					$data['avenue']=$this->users_model->get_avenue();
					$data['audience']=$this->users_model->get_audience();
					$data['post']=$this->task_model->get_published_post();
					$data['phonecode']=$this->users_model->get_phonecode();
					$data['dept']=$this->groups_model->getdept();
					$data['code']=	$this->create_code();
			

			$this->view('groups/lead/create_lead',$data);
		}

		


			function do_save_lead()
			{

					$config = array(
	             		array(
	                     'field'   => 'avenue', 
	                     'label'   => 'Avenue ', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'rdate', 
	                     'label'   => 'Lead Date', 
	                     'rules'   => 'required'
	                  ),
					  array(
	                     'field'   => 'post', 
	                     'label'   => 'Post', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'lead_type', 
	                     'label'   => 'Lead Type', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'lead_name', 
	                     'label'   => 'Lead Name', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'lead_email', 
	                     'label'   => 'Lead Email', 
	                     'rules'   => 'trim|required|numeric'
	                  ),
					   array(
	                     'field'   => 'phonecode', 
	                     'label'   => 'Phone Code', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'phone', 
	                     'label'   => 'Phone', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'lead_comment', 
	                     'label'   => 'Lead Comment', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'priority', 
	                     'label'   => 'Priority', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'assign_to', 
	                     'label'   => 'Assign To', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'team_comments', 
	                     'label'   => 'Team Comment', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'lead_code', 
	                     'label'   => 'Lead Code', 
	                     'rules'   => 'trim|required'
	                  )
                	);
		$this->form_validation->set_rules($config);
						//print_r($_POST);
/*Array ( [market_response_post] => on [avenue] => Select Aveneue [rdate] => [post] => Select Post [lead_type] => Select Lead Type [lead_name] => [lead_email] => [phonecode] => 0 [phone] => [lead_comment] => [priority] => 1 [assign_to] => Select Please [team_comments] => [end_date] => L91-00000001 [next] => Next )*/
		$fields 	= array ("market_response_type","avenue","rdate","post","lead_type","lead_name","lead_email","lead_comment","priority","team_comments","lead_code");
			
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
					$data['phone']=$this->input->post('phonecode').$this->input->post('phone');//mobile number
					

					/****
					*		$assign_to is-> department manager ID 
					*	explode for find  email to send department manager and ID to store in db
					*
					****/
					$dept=$this->input->post('assign_to');
					if (!empty($dept)) {
						$str_dept=explode('-',$dept);

					$data['assign_to']=$str_dept[0];
					}

					$data['created_by']=$this->session->userdata('id');
					$data['team_id']=$this->session->userdata('team_id');


					print_r($data);

					$this->db->insert('lead_generation',$data);
					
					
			}

}

?>