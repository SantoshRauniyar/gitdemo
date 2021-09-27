<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Team extends Template
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
		$this->load->model('authentication_model');
		$this->load->model('users_model');
		$this->load->model('plan_model');
		$this->set_header_path('blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->user_classification_model->set_role();
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
	
	public function setSelectedTeam($team_id)
	{
		$data = array();
		if($team_id != '')
		{
			$teamdetails = $this->team_model->getteamDetails($team_id);
			
			$this->session->set_userdata('team_id',$team_id);
			$this->session->set_userdata('team_title',$teamdetails['team_title']);
			$this->session->set_userdata('logo_image',$teamdetails['logo_image']);
			$this->session->set_userdata('background_image',$teamdetails['background_image']);
			$this->session->set_userdata('background_color',$teamdetails['background_color']);
			$this->session->set_userdata('panel_heading_color',$teamdetails['panel_heading_color']);
			$this->session->set_userdata('panel_body_color',$teamdetails['panel_body_color']);			
												
			$data['status']  = "success";	
			$data['data']    = $teamdetails;
			$data['message'] = "Team selected successfully.";
			
			echo json_encode($data);
			exit;
		}
		else
		{
			$data['status'] = "error";
			$data['message'] = "Team is not selected.";
			
			echo json_encode($data);
			exit;
		}
	}
	
	/*

		Manage users view

	*/
	public function all()
	{

					//
		/**
		*@return int nof_team
		*here I've called count team to set privilleges
				santosh updated here
		**/
		$nof_team=$this->team_model->count_team();
		$data['total_team']=$nof_team;//set number of team to disable ADD_TEAM

		//$this->data['current_page'] = 'viewdetail';
		$this->set_title["title"] = $this->set_title('Team Management');
		$sort = !isset($_REQUEST['sort'])?'team_title':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
		
		
		$userdata = $this->team_model->getteamslist($sort,$type,$this->session->userdata('id'));
	
		if($type=='asc')
			$type ='desc';
		else
			$type ='asc';

      	$data['type'] = $type;
      	$data['sort'] = $sort;

		if(count($userdata['results'])>0)
			$data['userdata'] = $userdata;

      	$data['url']  = $_SERVER['PHP_SELF'].'?sort='.$sort.'&type='.$type;
      //$this->view('administrator/admin_category_templet',$this->data);
		$this->view("team/team_list",$data);
	}
	
	public function getteamlist()
	{
		$teamlist = $this->team_model->getlistteam($this->session->userdata('id'));
		if(!empty($teamlist))
		{
			$data['status'] = "success";
			$data['data'] = $teamlist;		
		}
		else
		{
			$data['status'] ="error";
			$data['message'] = "No team available. ";
		}
		
		if($this->input->is_ajax_request())
		{
			echo json_encode($data);
			exit;
		}
	}

	/* Get Plan Details */
	public function getPlanDetails($plan_id ='')
	{
		if($this->input->is_ajax_request())
		{
			$plan_id  = $this->input->post('plan_id');
			if($plan_id == '')
			{
				$data['status'] = "error";
				$data['data']	= "No Plan Selected . Please select any plan .";
				echo json_encode($data);
				exit;
			}
			$plan_details = $this->plan_model->getplanbyid($plan_id);
			if($plan_details)
			{
				if($plan_details['description'] != '')
				{
					$data['status'] = "success";
					$data['data']	= $plan_details['description'];
					echo json_encode($data);
					exit;
				}
				else
				{
					$data['status'] = "error";
					$data['data']	= "No features available .";
					echo json_encode($data);
					exit;
				}
			}
		}
		else
		{
			$plan_details = $this->plan_model->getplanbyid($plan_id);
			if($plan_details)
			{
				if($plan_details['description'] != '')
				{
					return $plan_details['description'];
				}
				else
				{
					return false;
				}
			}
		}
	}
	
	/* 
		Add User Process
	*/
	public function add_team()
	{
				if($this->session->userdata('user_role')=="Captain")
								{
		$data = array();
		$this->set_title('Add Team');
		$data 				 = $this->session->flashdata('addteamdata');
		//$data['projectlist'] = $this->projects_model->getPrjectList();
		//$data['userlist']	 = $this->users_model->getmyteamleader();
		//$data['planlist']	 = $this->plan_model->getplans();
		$data['mode'] 		 = "Add";
		$data['action'] 	 = base_url()."team/do_save/";
		$data['heading']	 = "Add Team";
		$this->view("team/add_edit_team",$data);

	}//close
	}

	public function do_save()
	{
		$config = array(
	             		array(
	                     'field'   => 'team_title', 
	                     'label'   => 'team title', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'description', 
	                     'label'   => 'description', 
	                     'rules'   => 'trim|required'
	                  ),
	                  array(
	                     'field'   => 'background_color', 
	                     'label'   => 'background_color', 
	                     'rules'   => 'trim'
	                  ),
	                  array(
	                     'field'   => 'panel_heading_color', 
	                     'label'   => 'panel_heading_color', 
	                     'rules'   => 'trim'
	                  ),
	                  array(
	                  	'field'   => 'panel_body_color', 
	                     'label'   => 'panel_body_color', 
	                     'rules'   => 'trim'
	                  )
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("team_title","description","background_color","panel_heading_color","panel_body_color");
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		$logo_image = isset($_FILES['logo_image']['name'])?$_FILES['logo_image']['name']:'';
		$background_image = isset($_FILES['background_image']['name'])?$_FILES['background_image']['name']:'';
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			$this->session->set_flashdata('addteamdata',$data);
			redirect('team/add_team');
		}
		else
		{	
			$data['team_leader_id'] = $this->session->userdata('id');
			$noofteam  = $this->plan_model->get_no_of_team($this->session->userdata('plan_id'));
			$countteam = $this->team_model->count_no_of_team($this->session->userdata('id'));
			
			/*if($countteam['total_team'] >= $noofteam['no_of_team'])
			{
				$this->session->set_flashdata( "errors", "You completed your team creation quota, for create more team your have to upgrade your plan. ");
				//unset($data['password']);
				$this->session->set_flashdata('addteamdata',$data);
				redirect('team/all');
			}*/
			$data['team_title'] = trim($data['team_title']," ");
			if($this->team_model->isTeamExist($data['team_title'],$this->session->userdata('id')))
			{
				$this->session->set_flashdata( "errors", "This team name is already exist!");
				$this->session->set_flashdata('addteamdata',$data);
				redirect('team/add_team/'.$data['id']);
			}
			if($logo_image != '')
			{
				$this->file_uploader->set_default_upload_path('./assets/upload/team/');
				$logo_image = $this->file_uploader->upload_image('logo_image');
				if($logo_image['status'] == 200)
				{
					$data['logo_image'] = $logo_image['data'];
				}
				else
				{
					$this->session->set_flashdata( "errors", $logo_image['status']." : ".$logo_image['data']);
					//unset($data['password']);
					$this->session->set_flashdata('addteamdata',$data);
					redirect('team/add_team');
				}
			}
			if($background_image != '')
			{
				$this->file_uploader->set_default_upload_path('./assets/upload/team_background/');
				$background_image = $this->file_uploader->upload_image('background_image');
				if($background_image['status'] == 200)
				{
					$data['background_image'] = $background_image['data'];
				}
				else
				{
					$this->session->set_flashdata( "errors", $background_image['status']." : ".$background_image['data']);
					//unset($data['password']);
					$this->session->set_flashdata('addteamdata',$data);
					redirect('team/add_team');
				}
			}
			$this->team_model->set_fields($data);
			$result = $this->team_model->save();
			
			if($result > 0)
			{
				$adminmail = $this->authentication_model->getAdminEmailId();
				if($adminmail)
				{
					$emailBody = file_get_contents("assets/email/registretionformlink.html");
					$emailBody=str_replace("<@link@>",base_url()."authentication/registerform/".$result,$emailBody);
					//echo $emailBody;
					$headers = "MIME-Version: 1.0\r\n"; 
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: Kizaku <system@kizaku.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					//print_r($adminmail);exit;
					mail(@$adminmail['email'], "Kizaku - New team creation", $emailBody, $headers);
				}
				$this->session->set_flashdata( "success", "team added successfully.");
				redirect('team/all');
			}
		}
	}

	public function edit_team($id)
	{


						if($this->session->userdata('user_role')=="Captain")
								{
		$data = array();
		$this->set_title('Edit Team');
		$adduserdata = $this->team_model->getteamDetails($id);
		//print_r($adduserdata);exit;
		if(!$adduserdata)
			redirect("team/all");
		else
			$data = $adduserdata;
		/*$data['userlist']	 = $this->users_model->getusers();
		$data['planlist']	 = $this->plan_model->getplans();
		$data['feature'] 	 = $this->getPlanDetails($data['plan_id']);*/
		$data['mode'] 		 = "edit";
		$data['action'] 	 = base_url()."team/do_update";
		$data['heading']	 = "Edit Team";
		$this->view("team/add_edit_team",$data);
	}//close

}

	public function do_update()
	{
		$config = array(
	             		array(
	                     'field'   => 'team_title', 
	                     'label'   => 'team title', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'description', 
	                     'label'   => 'description', 
	                     'rules'   => 'trim|required'
	                  ),
	                  array(
	                     'field'   => 'background_color', 
	                     'label'   => 'background_color', 
	                     'rules'   => 'trim'
	                  ),
	                  array(
	                     'field'   => 'panel_heading_color', 
	                     'label'   => 'panel_heading_color', 
	                     'rules'   => 'trim'
	                  ),
	                  array(
	                  	'field'   => 'panel_body_color', 
	                     'label'   => 'panel_body_color', 
	                     'rules'   => 'trim'
	                  )
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("id","team_title","description","background_color","panel_heading_color","panel_body_color");
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}		
		$logo_image = isset($_FILES['logo_image']['name'])?$_FILES['logo_image']['name']:'';
		$background_image = isset($_FILES['background_image']['name'])?$_FILES['background_image']['name']:'';
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			redirect('team/edit_team/'.$data['id']);
		}
		else
		{	
			$data['team_title'] = trim($data['team_title']," ");
			if($this->team_model->isTeamExist($data['team_title'],$this->session->userdata('id'),$data['id']))
			{
				$this->session->set_flashdata( "errors", "This team name is already exist!");
				redirect('team/edit_team/'.$data['id']);
			}
			if($logo_image != '')
			{
				//$this->users_model->set_field("id",$data['id']);
				$oldImagepath = $this->team_model->getImagePath($data['id']);
				//print_r($oldImagepath);exit;
				if($oldImagepath)
				{
					if(file_exists("assets/upload/team/".$oldImagepath['logo_image']))
					{
						unlink("assets/upload/team/".$oldImagepath['logo_image']);
					}
				}
				$this->file_uploader->set_default_upload_path("./assets/upload/team/");
				$logo_image = $this->file_uploader->upload_image('logo_image');
				if($logo_image['status'] == 200)
				{
					$data['logo_image'] = $logo_image['data'];
				}
				else
				{
					$this->session->set_flashdata( "errors", $logo_image['status']." ".$logo_image['data']);
					//unset($data['password']);
					//$this->session->set_flashdata('adduserdata',$data);
					redirect('team/edit_team/'.$data['id']);
				}
			}
			if($background_image != '')
			{
				//$this->users_model->set_field("id",$data['id']);
				$oldImagepath = $this->team_model->getBackgroundImagePath($data['id']);
				//print_r($oldImagepath);exit;
				if($oldImagepath['background_image']!= '')
				{
					if(file_exists("assets/upload/team_background/".$oldImagepath['background_image']))
					{
						unlink("assets/upload/team_background/".$oldImagepath['background_image']);
					}
				}
				$this->file_uploader->set_default_upload_path("./assets/upload/team_background/");
				$background_image = $this->file_uploader->upload_image('background_image');
				if($background_image['status'] == 200)
				{
					$data['background_image'] = $background_image['data'];
				}
				else
				{
					$this->session->set_flashdata( "errors", $background_image['status']." ".$background_image['data']);
					//unset($data['password']);
					//$this->session->set_flashdata('adduserdata',$data);
					redirect('team/edit_team/'.$data['id']);
				}
			}
			$this->team_model->set_fields($data);
			$result = $this->team_model->do_update();
			
			$this->session->set_flashdata( "success", "Team updated successfully.");
			redirect('team/all');
		}
	}
	
	public function team_configuration()
	{
		$data			  = array();
		$this->set_title('Team Configuration');
		$data['teamlist'] = $this->team_model->getteambyid($this->session->userdata('id'));
		$data['heading']  = "Team Configuration";
		$data['action']   = base_url()."team/set_configuration";
		$this->view("team/team_configuration",$data);
	}

	public function getTeamFeatures($team_id)
	{
		$featureslist = $this->team_model->getTeamFeatures($team_id);
		if(!empty($featureslist))
		{
			$data['status'] = "success";
			$data['data']   = $featureslist;
			echo json_encode($data);
			exit;
		}
	}

	public function set_configuration()
	{
		$fields = array("multi_groups_creation","multi_time_zone","multi_currency","leave_management","rejoin","mis_chart","theam","limit_member_size","announcements","group_creation","subgroup_creation","group_discussion_board","recurrence_task","subsequent_task","budget_task","task_followers","task_approval","task_discussion","auto_abort","subtask","reassign_task");
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		$team_id = $this->input->post('team_id');
		$result = $this->team_model->set_configuration($team_id,$data);
		$this->session->set_flashdata('success',"Team Configuration updated Successfully.");
		redirect('team/all');
	}
	
	
	/*
		Backup team
	*/
	public function backup_team($team_id)
	{
		// Load the DB utility class
				if($this->session->userdata('user_role')=="Captain")
								{
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$prefs = array(
      	'tables'      => array('team', 'user_roles','users','groups','group_members','projects','milestone','task','task_comments','task_followers'),  // Array of tables to backup.
         'ignore'      => array(),           // List of tables to omit from the backup
         'format'      => 'txt',             // gzip, zip, txt
         'filename'    => 'mybackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
         'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
         'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
         'newline'     => "\n"               // Newline character used in backup file
         );

			//$this->dbutil->backup($prefs);
		$backup = $this->dbutil->backup($prefs); 
	
		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('assets/backup/mybackup.sql', $backup);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('mybackup.sql', $backup);
	}//close

}
	
	/*
		Restore team
	*/
	public function restore_team()
	{

						if($this->session->userdata('user_role')=="Captain")
								{
		$schema = htmlspecialchars(file_get_contents('assets/backup/mybackup.sql'));
		$query = rtrim( trim($schema), "\n;");
		$query_list = explode(";", $query);


		foreach($query_list as $query)
		{
			$query = substr($query,strrpos($query,'#')+1);
			$this->db->query($query);
		}

	}//close
	}	
	/*
		Delete milestone
	*/
	public function single_team_delete($id)
	{

						if($this->session->userdata('user_role')=="Captain")
								{
		$result = $this->team_model->do_delete($id);
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
		redirect("team/all");

	}//close
	}

	public function delete_multiple()
	{

						if($this->session->userdata('user_role')=="Captain")
								{
		$teams = $this->input->post('chk');
		foreach($teams as $data)
		{
			$this->team_model->do_delete($data);
		}
		echo 1;
		exit;
	}//close
}
}
?>