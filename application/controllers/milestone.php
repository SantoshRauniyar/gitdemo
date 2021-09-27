<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Milestone extends Template
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
		$this->load->model('milestone_model');
		$this->load->model('user_role_model');
		$this->load->model('notification_model');
		$this->load->model('authentication_model');
		$this->load->model('projects_model');
		$this->set_header_path('blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->set_template('template');
		$this->set_title('Milestone Management');
		$this->load->model('users_model');
		$this->user_classification_model->set_role();
		
		$this->assets_load->add_css(array(base_url('assets/css/bootstrap-datetimepicker.min.css')),"header");
		
		$this->assets_load->add_js(array(base_url('assets/js/bootstrap-datetimepicker.js'),
										 base_url('assets/js/bootstrap-datetimepicker.fr.js'),
										 base_url('assets/administrator/js/vendors/milestone.js')),"footer");
		
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

			if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_mile'))
		{

		//$this->data['current_page'] = 'viewdetail';
		$this->set_title["title"] = $this->set_title('Milestone Management');

		$sort = !isset($_REQUEST['sort'])?'milestone_title':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
		
		$pres=$this->db->get('program');
		$programlist=$pres->result();

		if($type=='asc')
			$type ='desc';
		else
			$type ='asc';
			
      	$data['type'] = $type;
      	$data['sort'] = $sort;
	
			$data['programlist'] = $programlist;
		
      	$data['url']  = $_SERVER['PHP_SELF'].'?sort='.$sort.'&type='.$type;
		  $data['view_as']='view';
      //$this->view('administrator/admin_category_templet',$this->data);
		$this->view("milestone/view_milestone_list",$data);
	}
	}

			function taskboard()
           {

			$pres=$this->db->get('program');
				$data['prolist']=$pres->result();

           				$this->view('milestone/taskboard',$data);
           }

function editmilestone()

	{

		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_mile'))
		{

		//$this->data['current_page'] = 'viewdetail';
		$this->set_title["title"] = $this->set_title('Milestone Management');

		$sort = !isset($_REQUEST['sort'])?'milestone_title':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
		
		$pres=$this->db->get('program');
		$programlist=$pres->result();

		if($type=='asc')
			$type ='desc';
		else
			$type ='asc';
			
      	$data['type'] = $type;
      	$data['sort'] = $sort;
	
			$data['programlist'] = $programlist;
		
      	$data['url']  = $_SERVER['PHP_SELF'].'?sort='.$sort.'&type='.$type;
      //$this->view('administrator/admin_category_templet',$this->data);
		$this->view("milestone/edit_milestone_list",$data);
	}

}
	
	/* 
		Add User Process
	*/
	public function add_milestone()
	{
					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_mile'))
		{

		$data = array();
		$this->set_title('Add Milestone');
		$data 				 = $this->session->flashdata('addmilestonedata');
		$data['projectlist'] = $this->projects_model->getPrjectList($this->session->userdata('id'));
		$data['mode'] 		 = "Add";
		$data['action'] 	 = base_url()."milestone/do_save/";
		$data['heading']	 = "Add Milestone";
		        $data['followers']=$data['userlist']= $this->authentication_model->getMileHead();
		$this->view("add_edit_milestone",$data);
	}

}
	
	public function do_save()
	{
		$config = array(
	             		array(
	                     'field'   => 'milestone_title', 
	                     'label'   => 'milestone title', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'description', 
	                     'label'   => 'description', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'project_id', 
	                     'label'   => 'project name', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
					  	'field'   => 'budget', 
	                     'label'  => 'budget', 
	                     'rules'  => 'trim|required|numeric'
					  ),
					  array(
					  	'field'   => 'mile_head', 
	                     'label'  => 'Milestone Head', 
	                     'rules'  => 'trim|required'
					  )
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("milestone_title","description","project_id","budget","mile_head");
			
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
			$followers=$user_ar=$this->input->post('users');
			$uid=implode('-',$user_ar);//array to string 
			$data['users']=$uid;
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			$this->session->set_flashdata('addmilestonedata',$data);
			redirect('milestone/add_milestone');
		}
		else
		{	
			$data['milestone_title'] = trim($data['milestone_title'],' ');
			if($this->milestone_model->isMilestoneExist($data['milestone_title'],$data['project_id']))
			{
				$this->session->set_flashdata('errors',"Milestone name is already exist in this project!");
				$this->session->set_flashdata('addmilestonedata',$data);
				redirect('milestone/add_milestone');
			}
			$no_of_milestone = $this->projects_model->get_no_of_milestone($data['project_id']);
			$countmilestone	 = $this->milestone_model->count_milestone($data['project_id']);
							   
			if($countmilestone['total_milestone'] == $no_of_milestone['no_of_milestone'])
			{
				$this->session->set_flashdata('errors',"Your project milestone limit is over, Please upgrad your project milestone limit.");
				$this->session->set_flashdata('addmilestonedata',$data);
				redirect('milestone/add_milestone');
			}
			else
			{
				//echo $no_of_milestone['budget'];exit;
				$result = $this->milestone_model->gettotalbudget($data['project_id']);
				$projectbudget = $no_of_milestone['budget']- $result['totalbudget'];
				if($data['budget'] > $projectbudget)
				{
					$this->session->set_flashdata('errors',"Your milestone budget is more then your project's remaining budget limit.");
					$this->session->set_flashdata('addmilestonedata',$data);
					redirect('milestone/add_milestone');
				}
			}
			$this->milestone_model->set_fields($data);
			$result = $this->milestone_model->save();
			
			if($result > 0)
			{
						/**
				 * @return $ph details from program
				 * @param  $pro_head
				 * @param $emails all email associated with  ID
				 * 
				 */
				
				$project=$this->db->select('project_name,program_id,leader_id')->where('id',$data['project_id'])->from('projects')->get()->result();
				$program=$this->db->select('pro_name,pro_head')->where('pid',$project[0]->program_id)->from('program')->get()->result();
						var_dump($project);
						var_dump($program);
				
				$pro_head=$program[0]->pro_head;
				$to=$project[0]->leader_id.','.$pro_head;
				$emails=$this->user_role_model->getEmail($to);

				$sentdata=[
					'message'=>$data['milestone_title'].' Mileestone Added.',
					'link'=>'milstone/all/'											
				];
				$users=[$project[0]->leader_id,$pro_head,$this->session->userdata('id')];
				$users=array_unique($users);
				var_dump($users);
						foreach($users as $user)
				{
				$sentdata['to_users']=$user;//singl  user will get notification
					$this->notification_model->sent_notification($sentdata);

	
				}

			 foreach ($emails as $value) {
				 if($value->email != '')
{
	if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
	{

	

		$emailBody = file_get_contents(base_url()."assets/email/section/edit.html");
		$emailBody = str_replace("<@project_name@>",$data['milestone_title'],$emailBody);
		$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
		$emailBody = str_replace("<@link@>",base_url().'/milestone/single_milestone_view/',$emailBody);
		$emailBody = str_replace("<@pro_name@>",$program[0]->pro_name,$emailBody);
		$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
		$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
		
		if(!mail($value->email, "Project Management - Projeect Created in ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
		{
			echo "email not sent";
			$this->session->set_flashdata( "errors", "Check Internet orEmail Address is wrong.");
		}
		
	
		
		
	}
	else 
	{
		echo"InValid Email";
		$this->session->set_flashdata( "errors", "Please enter valid email address.");

	}
			 
		}	           
			}

				$this->session->set_flashdata( "success", "Milestone added successfully.");
				redirect('milestone/');

			}

			
		
		}
		
	}
	
			


	public function edit_milestone($id)
	{		

		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_pro'))
		{


		$data = array();
		$this->set_title('Edit Milestone');
		
		
		$adduserdata = $this->milestone_model->getMilestonebyid($id);
		
			$data = $adduserdata;
		$data['projectlist'] = $this->projects_model->getPrjectList($this->session->userdata('id'));
		$data['mode'] 	= "edit";
		$data['action'] = base_url()."milestone/do_update";
		$data['heading']= "Edit Milestone";
		        $data['followers']=$data['userlist']= $this->authentication_model->getMileHead();
		$this->view("add_edit_milestone",$data);

	}
}
public function view_milestone($id)
	{		

		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_pro'))
		{


		$data = array();
		$this->set_title('Edit Milestone');
		
		
		$adduserdata = $this->milestone_model->getMilestonebyid($id);
		
			$data = $adduserdata;
		$data['projectlist'] = $this->projects_model->getPrjectList($this->session->userdata('id'));
		$data['mode'] 	= "edit";
		$data['action'] = base_url()."milestone/do_update";
		$data['heading']= "Edit Milestone";
		$this->view("milestone/viewstatic_milestone",$data);

	}
}
		
		

		
		

	
	public function do_update()
	{
		$config = array(
	             		array(
	                     'field'   => 'milestone_title', 
	                     'label'   => 'milestone title', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'description', 
	                     'label'   => 'description', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'project_id', 
	                     'label'   => 'Project Name', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
					  	'field'   => 'budget', 
	                     'label'  => 'budget', 
	                     'rules'  => 'trim|required|numeric'
					  ),
					  array(
					  	'field'   => 'mile_head', 
	                     'label'  => 'milestone head', 
	                     'rules'  => 'trim|required'
					  )
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("id","milestone_title","description","project_id","budget","mile_head");
			
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
			$followers=$user_ar=$this->input->post('users');
			
			$uid=implode('-',$user_ar);//array to string 
			$data['users']=$uid;
		
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			//$this->session->set_flashdata('addprojectdata',$data);
			redirect('milestone/edit_milestone/'.$data['id']);
		}
		else
		{	
			$data['milestone_title'] = trim($data['milestone_title'],' ');
			if($this->milestone_model->isMilestoneExist($data['milestone_title'],$data['project_id'],$data['id']))
			{
				$this->session->set_flashdata('errors',"Milestone name is already exist in this project!");
				$this->session->set_flashdata('addmilestonedata',$data);
				redirect('milestone/add_milestone');
			}
			$projectbudget 		  = $this->projects_model->getprojectbudget($data['project_id']);
			$totalmilestonebudget = $this->milestone_model->get_total_budget($data['project_id'],$data['id']);
			
			if(($totalmilestonebudget+$data['budget']) > $projectbudget)
			{
				$this->session->set_flashdata("errors","Your milestone budget is more then your project's remaining budget limit.");
				redirect('milestone/edit_milestone/'.$data['id']);
			}
			$this->milestone_model->set_fields($data);
			$result = $this->milestone_model->do_update();
			
			$this->session->set_flashdata( "success", "Milestone updated successfully.");
			redirect('milestone/edit_milestone_list');
			
		}
	}
			function delete_milestone_list()
			{



				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_mile'))
		{


				//$this->data['current_page'] = 'viewdetail';
		$this->set_title["title"] = $this->set_title('Milestone Management');

		$sort = !isset($_REQUEST['sort'])?'milestone_title':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
		
		$pres=$this->db->get('program');
		$programlist=$pres->result();

		if($type=='asc')
			$type ='desc';
		else
			$type ='asc';
			
      	$data['type'] = $type;
      	$data['sort'] = $sort;
	
			$data['programlist'] = $programlist;
		
      	$data['url']  = $_SERVER['PHP_SELF'].'?sort='.$sort.'&type='.$type;
      //$this->view('administrator/admin_category_templet',$this->data);
		$this->view("milestone/del_milestone_list",$data);
			}
				}

	/*
		Delete milestone
	*/
	public function delete_milestone($id)
	{


					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_mile'))
		{

		$result = $this->milestone_model->do_delete($id);
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
		redirect("milestone/delete_milestone_list");
	}
	}
	
	public function delete_multiple()
	{
		$milestones = $this->input->post('chk');
		foreach($milestones as $data)
		{
			$this->milestone_model->do_delete($data);
		}
		echo 1;
		exit;
	}
	public function change_user_status($id,$status)
	{
		if($status == 0)
			$data['status'] = 1;
		else
			$data['status'] = 0;
		
		$this->users_model->changeUserStatus($id,$data);
		
		echo 1;
		exit();
	}//ajax request for project

		 function taskbymilestone()
		 {



			          		if ($end_date=$this->input->get('end_date')) {
           		
           					$did=$this->input->get('did');
           					$pid=$this->input->get('pid');
           					$start_date=$this->input->get('start_date');
           					//$did=$this->input->get('did');
           					$mile_id=$this->input->get('mile_id');
           					           					$uid=$this->input->get('uid');
           					$project_id=$this->input->get('project_id');
           		$this->set_title["title"] = $this->set_title('Program Management');

		$sort = !isset($_REQUEST['sort'])?'task':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		

						$this->db->select('taskk.status,users.user_name,taskk.id,taskk.title,taskk.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program');
					$this->db->join('projects','projects.id=taskk.project');
					$this->db->join('users','users.id=taskk.assign_uid','left');
					$this->db->where('taskk.program',$pid);
					$this->db->where('taskk.project',$project_id);
					$this->db->where('taskk.milestone',$mile_id);
					$this->db->where('taskk.start_date >=',$start_date);
					$this->db->where('taskk.end_date <=',$end_date);
		       
					
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



	function milebyproject()
	{
		if ($pid=$this->input->get('pid')) {
			$this->db->where('project_id',$pid);
			$res=$this->db->get('milestone');
			$miledata=$res->result();

			?>

				<option>Select Please</option>	
				<?php
											foreach ($miledata as $value) {
										?>
											<option value="<?=$value->id ?>" ><?=$value->milestone_title ?></option>


										<?php
											}


											?>
										

			<?php
		}
	}


			function viewmilebypro()
			{

					if ($pid=$this->input->get('pid')) {
						
						$project_id=$this->input->get('project_id');

							$this->db->select('milestone.milestone_title,milestone.description,milestone.id,milestone.budget,projects.project_name');
								$this->db->from('milestone');
								$this->db->join('projects','projects.id=milestone.project_id');
								$this->db->where('created_by',$this->session->userdata('id'));
								$this->db->where('project_id',$project_id);

								$milelist=$this->db->get();
								$milestonelist=$milelist->result();
							//var_dump($milestonelist);
							$userdata['results']=$milestonelist;

							foreach($userdata['results'] as $data)
									{
							?>
								<tr class="odd gradeX">
										<td>
										<?php echo $data->milestone_title;?>
									</td>
									<td class="center"><?php  echo  $data->project_name;?></td>
									<td><?php echo $data->description;?></td>
									<td><?php echo $data->budget;?></td>
									<td align="center">
										<a style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;" class="btn btn-info" href="<?php echo base_url('milestone/view_milestone/'.$data->id);?>">
											View Details
										</a>&nbsp;
										
										<!--<a id="delete" href="<?php echo base_url('milestone/delete_milestone/'.$data->id);?>">
											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete">
										</a>
									</td>
								</tr>
							<?php
									}

					}


			}
function deletemilebypro()
			{

					if ($pid=$this->input->get('pid')) {
						
						$project_id=$this->input->get('project_id');

							$this->db->select('milestone.milestone_title,milestone.description,milestone.id,milestone.budget,projects.project_name');
								$this->db->from('milestone');
								$this->db->join('projects','projects.id=milestone.project_id');
								$this->db->where('created_by',$this->session->userdata('id'));
								$this->db->where('project_id',$project_id);

								$milelist=$this->db->get();
								$milestonelist=$milelist->result();
							//var_dump($milestonelist);
							$userdata['results']=$milestonelist;

							foreach($userdata['results'] as $data)
									{
							?>
								<tr class="odd gradeX">
										<td>
										<?php echo $data->milestone_title;?>
									</td>
									<td class="center"><?php  echo $data->project_name;?></td>
									<td><?php echo $data->description;?></td>
									<td><?php echo $data->budget;?></td>
									<td align="center">
										<!--<a style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;" class="btn btn-info" href="<?php echo base_url('milestone/edit_milestone/'.$data->id);?>">
											View Details
										</a>-->&nbsp;
										
										<a id="delete"style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;" class="btn btn-info" href="<?php echo base_url('milestone/delete_milestone/'.$data->id);?>">
											Delete
										</a>
									</td>
								</tr>
							<?php
									}

					}


			}

			function editmilebypro()
			{

					if ($pid=$this->input->get('pid')) {
						
						$project_id=$this->input->get('project_id');

							$this->db->select('milestone.milestone_title,milestone.description,milestone.id,milestone.budget,projects.project_name');
								$this->db->from('milestone');
								$this->db->join('projects','projects.id=milestone.project_id');
								$this->db->where('created_by',$this->session->userdata('id'));
								$this->db->where('project_id',$project_id);

								$milelist=$this->db->get();
								$milestonelist=$milelist->result();
							//var_dump($milestonelist);
							$userdata['results']=$milestonelist;

							foreach($userdata['results'] as $data)
									{
							?>
								<tr class="odd gradeX">
										<td>
										<?php echo $data->milestone_title;?>
									</td>
									<td class="center"><?php  echo $data->project_name;?></td>
									<td><?php echo $data->description;?></td>
									<td><?php echo $data->budget;?></td>
									<td align="center">
										<a style="background-color:#ef0f0f;border-color:#ef0f0f;color:white;" class="btn btn-info" href="<?php echo base_url('milestone/edit_milestone/'.$data->id);?>">
											Edit
										</a>&nbsp;
										
										<!--<a id="delete" href="<?php echo base_url('milestone/delete_milestone/'.$data->id);?>">
											<img src="<?php echo base_url('assets/administrator/icons/error_msg.png');?>" height="22" width="22" title="Delete">
										</a>
									</td>
								</tr>
							<?php
									}

					}


			}

}
?>