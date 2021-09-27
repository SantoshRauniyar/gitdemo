<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Projects extends Template
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
		$this->load->model('projects_model');
		$this->load->model('authentication_model');
		$this->load->model('users_model');
		$this->load->model('user_role_model');
		$this->load->model('notification_model');
		$this->load->model('team_model');
		$this->set_header_path('blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->user_classification_model->set_role();
		$this->set_template('template');
		$this->set_title('Project Management');
		
		$this->assets_load->add_css(array(base_url('assets/administrator/css/bootstrap-datetimepicker.min.css')),"header");

		

		$this->assets_load->add_js(array(base_url('assets/administrator/js/bootstrap-datetimepicker.js'),

										 base_url('assets/administrator/js/bootstrap-datetimepicker.fr.js'),

										 base_url('assets/administrator/js/vendors/products.js')),"footer");
		
		
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

					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_project'))
		{


		//$this->data['current_page'] = 'viewdetail';
		$this->set_title["title"] = $this->set_title('Project Management');

		$sort = !isset($_REQUEST['sort'])?'project_name':$_REQUEST['sort'];
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
		$this->view("projects/projects_list",$data);
	}

}



	//view all projects

	public function all_view()
	{

					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_project'))
		{

		//$this->data['current_page'] = 'viewdetail';
		$this->set_title["title"] = $this->set_title('Project Management');

		$sort = !isset($_REQUEST['sort'])?'project_name':$_REQUEST['sort'];
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
		$this->view("projects/view_project",$data);

						}
	}
	
	/* 

		Add User Process

	*/

 function uploadkro_icon()
				{
					//echo $r='.$fieldname.';
				$logo = isset($_FILES['icon']['name'])?$_FILES['icon']['name']:'';
				//echo $logo;
$logo_tmp=isset($_FILES['icon']['tmp_name'])?$_FILES['icon']['tmp_name']:'';
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




	public function add_projects()
	{
			if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_project'))
		{



		$data = array();
		$this->set_title('Add Project');
		$data 			  = $this->session->flashdata('addprojectdata');
		//$data['teamlist'] = $this->team_model->getteamlistdropdown($this->session->userdata('id'));
		$data['mode'] 	  = "Add";
		$data['action']   = base_url()."projects/do_save/";
		$data['heading']  = "Add Project";

		$this->db->order_by('pro_name','asc');
		$res=$this->db->get('program');
		$data['program']  =$res->result();


			$this->db->select('department.manager_id as id,users.user_name');
			$this->db->distinct();
			$this->db->from('department');
			$this->db->join('users','users.id=department.manager_id');
			$this->db->order_by('user_name','asc');	
		            $lead=$this->db->get();
		            $data['leader']  =$lead->result();
            		
            		
        $data['followers']=$data['userlist']= $this->authentication_model->getProjectHead();

		$this->view("projects/add_edit_project",$data);
	}
			}

	public function do_save()
	{
		$config = array(
	             		array(
	                     'field'   => 'project_name', 
	                     'label'   => 'project name', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'description', 
	                     'label'   => 'description', 
	                     'rules'   => 'trim'
	                  ),
					  array(
	                     'field'   => 'no_of_milestone', 
	                     'label'   => 'Number of Mailestone', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'start_date', 
	                     'label'   => 'start date', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'end_date', 
	                     'label'   => 'end date', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'budget', 
	                     'label'   => 'budget', 
	                     'rules'   => 'trim|required|numeric'
	                  ),
					   array(
	                     'field'   => 'program_id', 
	                     'label'   => 'program', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'leader_id', 
	                     'label'   => 'Project Leader', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'discuss', 
	                     'label'   => 'Discussion Board', 
	                     'rules'   => 'trim|required'
	                  )
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("project_name","description","program_id","no_of_milestone","start_date","end_date","budget","leader_id","discuss");
			
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
			$this->session->set_flashdata('addprojectdata',$data);
			redirect('projects/add_projects');
		}
		else
		{	
			$data['project_name'] = trim($data['project_name']," ");
			$data['team_id']      = $this->session->userdata('team_id');
			if($this->projects_model->isProjectExist($data['project_name'],$data['team_id']))
			{
				$this->session->set_flashdata( "errors", "Project name is already exist!");
				//unset($data['password']);
				$this->session->set_flashdata('addprojectdata',$data);
				redirect('projects/add_projects');
			}
			$data['created_by'] = $this->session->userdata('id');
			$data['icon']=$this->uploadkro_icon();
			$img='';
     foreach($_FILES['attach']['error'] as $k=>$v)
 {
    $uploadfile = 'upload/'. basename($_FILES['attach']['name'][$k]);

    $ext=explode('.',$uploadfile);
    $ext=end($ext);
    $f=rand().'.'.$ext;
    if (move_uploaded_file($_FILES['attach']['tmp_name'][$k],'upload/'.$f)) 
    {
        $img.=$_FILES['attach']['name'][$k].'-';
    }

    /*else 
    {
        $error=$_FILES['file']['name'][$k], " upload attack!\n";
    } 
    echo $img;  */

    $data['files']=$img;

 }


			$this->projects_model->set_fields($data);
			$result = $this->projects_model->save();

			if($result > 0)
			{
				$this->session->set_flashdata( "success", "Project added successfully.");

				/**
				 * @return $ph details from program
				 * @param  $pro_head
				 * @param $emails all email associated with  ID
				 * 
				 */
				$ph=$this->db->select('pro_name,pro_head')->where('pid',$data['program_id'])->from('program')->get()->result();
				$pro_head=$ph[0]->pro_head;
				$to=$data['leader_id'].','.$pro_head;
				$emails=$this->user_role_model->getEmail($to);

				$sentdata=[
					'message'=>$data['project_name'].' Project Added.',
					'link'=>'projects/all/'											
				];
				$users=[$data['leader_id'],$pro_head,$this->session->userdata('id')];
				$users=array_unique($users);
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
		$emailBody = str_replace("<@project_name@>",$arr['section_name'],$emailBody);
		$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
		$emailBody = str_replace("<@link@>",base_url().'/project/single_section_view/'.$id,$emailBody);
		$emailBody = str_replace("<@pro_name@>",$ph[0]->pro_name,$emailBody);
		$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
		$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
		
		if(!mail($value->email, "Project Management - Projeect Created in ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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
			redirect('projects/all');
			}

				redirect('projects/all');
			}
		}
	
	public function edit_project($id)
	{		
					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_project'))
		{


		$data = array();
		$this->set_title('Edit Project');

		$adduserdata = $this->projects_model->getProjectbyid($id);
	
		if(!$adduserdata)
			redirect("projects/all");
		else
			$data = $adduserdata;
	
		//$data['teamlist'] = $this->team_model->getteamlistdropdown($this->session->userdata('id'));
		$data['mode'] 		 = "edit";
		$data['action'] 	 = base_url()."projects/do_update";
		$data['heading']	 = "Edit Projects";
				$res=$this->db->get('program');
		$data['program']  =$res->result();


			$this->db->select('*');
			$this->db->from('department');
			$this->db->join('users','users.id=department.manager_id');
			$this->db->order_by('user_name','asc');	
		$lead=$this->db->get();
		$data['leader']  =$lead->result();

        $data['followers']=$data['userlist']= $this->authentication_model->getusersExceptPartners();

		$this->view("projects/add_edit_project",$data);
			}
	}

	//view single project

public function view_project($id)
	{

							if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_project'))
		{

		$data = array();
		$this->set_title('Edit Project');

		$adduserdata = $this->projects_model->getProjectbyid($id);
	
		if(!$adduserdata)
			redirect("projects/all");
		else
			$data = $adduserdata;
	
		//$data['teamlist'] = $this->team_model->getteamlistdropdown($this->session->userdata('id'));
		$data['mode'] 		 = "edit";
		$data['action'] 	 = base_url()."projects/do_update";
		$data['heading']	 = "Edit Projects";
					$res=$this->db->get('program');
		$data['program']  =$res->result();


			$this->db->select('*');
			$this->db->from('department');
			$this->db->join('users','users.id=department.manager_id');
			$this->db->order_by('user_name','asc');	
		$lead=$this->db->get();
		$data['leader']  =$lead->result();
		$this->view("projects/single_project",$data);
			}
	}



	//delete single project

						public function delete_project_list()
	{
		//$this->data['current_page'] = 'viewdetail';

										if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_project'))
		{


		$this->set_title["title"] = $this->set_title('Project Management');

		$sort = !isset($_REQUEST['sort'])?'project_name':$_REQUEST['sort'];
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
		$this->view("projects/projectsdelete_list",$data);
	}

			}
	
	
	public function do_update()
	{
		$config = array(
					array(
							'field'   => 'project_name',
							'label'   => 'project name',
							'rules'   => 'trim|required'
					),
					array(
							'field'   => 'description',
							'label'   => 'description',
							'rules'   => 'trim|required'
					),
					array(
							'field'   => 'no_of_milestone',
							'label'   => 'Number of Mailestone',
							'rules'   => 'trim|required'
					),
					array(
							'field'   => 'start_date',
							'label'   => 'start date',
							'rules'   => 'trim|required'
					),
					array(
							'field'   => 'end_date',
							'label'   => 'end date',
							'rules'   => 'trim|required'
					),
					array(
							'field'   => 'budget',
							'label'   => 'budget',
							'rules'   => 'trim|required|numeric'
					),
					array(
							'field'   => 'program_id',
							'label'   => 'program',
							'rules'   => 'trim|required'
					),
					  array(
	                     'field'   => 'leader_id', 
	                     'label'   => 'Project Leader', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'discuss', 
	                     'label'   => 'Discussion Board', 
	                     'rules'   => 'trim|required'
	                  )
		);
		$this->form_validation->set_rules($config);
		$fields 	= array ("id","project_name","description","program_id","no_of_milestone","start_date","end_date","budget","leader_id","discuss");
	
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
			redirect('projects/edit_project/'.$data['id']);
		}
		else
		{
			$data['project_name'] = trim($data['project_name']," ");
			$data['team_id']	  = $this->session->userdata('team_id');
			if($this->projects_model->isProjectExist($data['project_name'],$data['team_id'],$data['id']))
			{
				$this->session->set_flashdata( "errors", "Project name is already exist!");
				//unset($data['password']);
				$this->session->set_flashdata('addprojectdata',$data);
				redirect('projects/add_projects');
			}
			$data['created_by'] = $this->session->userdata('id');


					if (isset($_FILES['icon']['name'])) {
						$data['icon']=$this->uploadkro_icon();
					}

			$this->projects_model->set_fields($data);



			$result = $this->projects_model->do_update();
			
				$this->session->set_flashdata( "success", "Projects updated successfully.");
				
				$ph=$this->db->select('pro_name,pro_head')->where('pid',$data['program_id'])->from('program')->get()->result();
				$pro_head=$ph[0]->pro_head;
				$to=$data['leader_id'].','.$pro_head;
				$emails=$this->user_role_model->getEmail($to);

				$sentdata=[
					'message'=>$data['project_name'].' Project Updated.',
					'link'=>'projects/all/'											
				];
				$users=[$data['leader_id'],$pro_head,$this->session->userdata('id')];
				$users=array_unique($users);
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
		$emailBody = str_replace("<@project_name@>",$arr['section_name'],$emailBody);
		$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
		$emailBody = str_replace("<@link@>",base_url().'/project/single_section_view/'.$id,$emailBody);
		$emailBody = str_replace("<@pro_name@>",$ph[0]->pro_name,$emailBody);
		$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
		$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
		
		if(!mail($value->email, "Project Management - Projeect Updated in ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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
			redirect('projects/all');
				
				
				
			
		}
	}
	/* Change Status */
	public function chnage_status($project_id,$status)
	{
		$result = $this->projects_model->change_status($project_id,$status);
		redirect("projects/all");
	}


	
	public function delete_project($id)
	{
							if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_project'))
				{

		$result = $this->projects_model->do_delete($id);
		if($result > 0)
		{
			echo "1";
			exit;
		}
		echo "0";
		exit;
					}
	}




function taskboard()
           {

           						if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_taskboard_project'))
		{


			$pres=$this->db->get('program');
				$data['prolist']=$pres->result();

           				$this->view('projects/taskboard',$data);
           }
       }


		
	/*
		Delete Multiple Projects
	*/
	public function delete_multiple()
	{
		$checkbox = $this->input->post('chk');
	
		foreach($checkbox as $data)
		{
			$this->projects_model->do_delete($data);
		}
		echo "1";
		exit;
	}


function taskbyprodeptproject()
{

			          		if ($end_date=$this->input->get('end_date')) {
           						$project_id=$this->input->get('project_id');
           						$start_date=$this->input->get('start_date');
           					
           		$this->set_title["title"] = $this->set_title('Program Management');

		$sort = !isset($_REQUEST['sort'])?'task':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		

						$this->db->select('taskk.status,users.user_name,taskk.id,taskk.title,taskk.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program');
					$this->db->join('projects','projects.id=taskk.project');
					$this->db->join('users','users.id=taskk.assign_uid');
					//$this->db->where('program',$pid);
					//$this->db->where('department',$did);
					///$this->db->where('unit',$uid);
					$this->db->where('project',$project_id);
					$this->db->where('taskk.start_date >=',$start_date);
					$this->db->where('taskk.end_date <=',$end_date);
		if ($this->session->userdata('user_role')!='Captain') {
						$this->db->where('taskk.assign_uid',$this->session->userdata('id'));
					}
					
					$res=$this->db->get();
					$tasklist=$res->result();


								if ($res->num_rows()>0) {

										foreach ($tasklist as $value) {
											
												?>

													<tr>
														<td><?=$value->end_date ?></td>
														<td><?=$value->title ?></td>
														<td><?=$value->created_by ?></td>
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


//ajax request for project


	function projectbypro()
	{
		if ($pid=$this->input->get('pid')) {
			$this->db->where('program_id',$pid);
			$res=$this->db->get('projects');
			$projectdata=$res->result();

			?>

				<option>Select Please</option>	
				<?php
											foreach ($projectdata as $value) {
										?>
											<option value="<?=$value->id ?>" ><?=$value->project_name ?></option>


										<?php
											}


											?>
										

			<?php
		}
	}


			function projectlistbypro()
			{

						if ($pid=$this->input->get('pid')) {
						

			

									$this->db->select('projects.project_name,projects.description,projects.no_of_milestone,projects.start_date,projects.end_date,projects.status,projects.id,program.pro_name');
									$this->db->from('projects');
									$this->db->join('program','program.pid=projects.program_id');
									$this->db->where('program_id',$pid);
									$this->db->where('created_by',$this->session->userdata('id'));
										$prolist=$this->db->get();
										$projectlist=$prolist->result();


									foreach($projectlist as $data)
									{
							?>
								<tr class="odd gradeX">
									
									<td>
										<?php echo $data->project_name;?>
									</td>
									<td><?php echo $data->description;?></td>
									<!-- <td class="center"><?php  echo $data->team_name;?></td>-->
									<td class="center"><?php echo $data->no_of_milestone;?></td>									
									<td><?php echo $data->start_date;?></td>
									<td><?php echo $data->end_date;?></td>
									
									<td><?php if($data->status == "1"){ echo "Assign";}else if($data->status == "2"){echo "Pandding";}else if($data->status == "3"){echo "Complete";}?></td>
									<td>
										<a class="btn btn-info" style="color:white;background-color:#ef0f0f;border-color: #ef0f0f" href="<?php echo base_url('projects/edit_project/'.$data->id);?>">
											Edit
										</a>&nbsp;
									
									</td>
								</tr>
							<?php
									}
						}


			}



			function projecteditbypro()
			{

						if ($pid=$this->input->get('pid')) {
						

			

									$this->db->select('projects.project_name,projects.description,projects.no_of_milestone,projects.start_date,projects.end_date,projects.status,projects.id,program.pro_name');
									$this->db->from('projects');
									$this->db->join('program','program.pid=projects.program_id');
									$this->db->where('program_id',$pid);
									$this->db->where('created_by',$this->session->userdata('id'));
										$prolist=$this->db->get();
										$projectlist=$prolist->result();


									foreach($projectlist as $data)
									{
							?>
								<tr class="odd gradeX">
									
									<td>
										<?php echo $data->project_name;?>
									</td>
									<td><?php echo $data->description;?></td>
									<!-- <td class="center"><?php  echo $data->team_name;?></td>-->
									<td class="center"><?php echo $data->no_of_milestone;?></td>									
									<td><?php echo $data->start_date;?></td>
									<td><?php echo $data->end_date;?></td>
									
									<td><?php if($data->status == "1"){ echo "Assign";}else if($data->status == "2"){echo "Pandding";}else if($data->status == "3"){echo "Complete";}?></td>
									<td>
										<a class="btn btn-info" style="color:white;background-color:#ef0f0f;border-color: #ef0f0f" href="<?php echo base_url('projects/edit_project/'.$data->id);?>">
											Edit
										</a>&nbsp;
									
									</td>
								</tr>
							<?php
									}
						}


			}





			function projectdeletebypro()
			{

						if ($pid=$this->input->get('pid')) {
						

			

									$this->db->select('projects.project_name,projects.description,projects.no_of_milestone,projects.start_date,projects.end_date,projects.status,projects.id,program.pro_name');
									$this->db->from('projects');
									$this->db->join('program','program.pid=projects.program_id');
									$this->db->where('program_id',$pid);
									$this->db->where('created_by',$this->session->userdata('id'));
										$prolist=$this->db->get();
										$projectlist=$prolist->result();


									foreach($projectlist as $data)
									{
							?>
								<tr class="odd gradeX">
									
									<td>
										<?php echo $data->project_name;?>
									</td>
									<td><?php echo $data->description;?></td>
									<!-- <td class="center"><?php  echo $data->team_name;?></td>-->
									<td class="center"><?php echo $data->no_of_milestone;?></td>									
									<td><?php echo $data->start_date;?></td>
									<td><?php echo $data->end_date;?></td>
									
									<td><?php if($data->status == "1"){ echo "Assign";}else if($data->status == "2"){echo "Pandding";}else if($data->status == "3"){echo "Complete";}?></td>
									<td>
										<a href="javascript:void(0);" class="btn btn-info" style="color:white;background-color: #ef0f0f;border-color: $ef0f0f;border-color:#ef0f0f;" onclick="return delete_projects('projects/delete_project/<?php echo $data->id;?>','projectslistform','Are you sure you want to delete this project ?','Project deleted successfully.');">
											

											Delete
										</a>&nbsp;
									
									</td>
								</tr>
							<?php
									}
						}


			}



}
