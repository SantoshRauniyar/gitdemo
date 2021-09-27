<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Team extends Template
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->model('team_model');
		$this->load->model('users_model');
		$this->load->model('plan_model');
		$this->set_header_path('administrator/blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->set_template('administrator/template');
		$this->set_title('Team Management');
		$this->assets_load->add_js(array(base_url('assets/administrator/js/ckeditor/ckeditor.js'),
										 base_url('assets/administrator/js/vendors/team.js')),"footer");

		if(!$this->session->userdata('admin_id'))

			redirect("administrator/authentication/");
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
		//$this->data['current_page'] = 'viewdetail';
		$this->set_title["title"] = $this->set_title('Team Management');
		$sort = !isset($_REQUEST['sort'])?'team_title':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
		$userdata = $this->team_model->admin_getteamslist($sort,$type);
	
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
		$this->view("administrator/team/team_list",$data);
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
		$data = array();
		$this->set_title('Add Team');
		$data 				 = $this->session->flashdata('addteamdata');
		//$data['projectlist'] = $this->projects_model->getPrjectList();
		$data['userlist']	 = $this->users_model->getmyteamleader();
		$data['planlist']	 = $this->plan_model->getplans();
		$data['mode'] 		 = "Add";
		$data['action'] 	 = base_url()."administrator/team/do_save/";
		$data['heading']	 = "Add Team";
		$this->view("administrator/team/add_edit_team",$data);
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
	                     'field'   => 'team_leader_id', 
	                     'label'   => 'team leader id', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'plan_id', 
	                     'label'   => 'plan id', 
	                     'rules'   => 'trim|required'
	                  )
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("team_title","description","team_leader_id","plan_id");
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		$logo_image = isset($_FILES['logo_image']['name'])?$_FILES['logo_image']['name']:'';
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			$this->session->set_flashdata('addteamdata',$data);
			redirect('administrator/team/add_team');
		}
		else
		{	
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
					redirect('administrator/team/add_team');
				}
			}
			$this->team_model->set_fields($data);
			$result = $this->team_model->save();
			if($result > 0)
			{
				$this->session->set_flashdata( "success", "team added successfully.");
				redirect('administrator/team/add_team');
			}
		}
	}

	public function edit_team($id)
	{
		$data = array();
		$this->set_title('Edit Team');
		$adduserdata = $this->team_model->getteambyid($id);
		if(!$adduserdata)
			redirect("/administrator/team/all");
		else
			$data = $adduserdata;
		$data['userlist']	 = $this->users_model->getusers();
		$data['planlist']	 = $this->plan_model->getplans();
		$data['feature'] 	 = $this->getPlanDetails($data['plan_id']);
		$data['mode'] 		 = "edit";
		$data['action'] 	 = base_url()."administrator/team/do_update";
		$data['heading']	 = "Edit Team";
		$this->view("administrator/team/add_edit_team",$data);
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
	                     'field'   => 'team_leader_id', 
	                     'label'   => 'team leader id', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'plan_id', 
	                     'label'   => 'plan id', 
	                     'rules'   => 'trim|required'
	                  )
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("id","team_title","description","team_leader_id","plan_id");
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}		
		$logo_image = isset($_FILES['logo_image']['name'])?$_FILES['logo_image']['name']:'';
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			//$this->session->set_flashdata('addprojectdata',$data);
			redirect('administrator/team/edit_team/'.$data['id']);
		}
		else
		{	
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
					redirect('administrator/team/edit_team/'.$data['id']);
				}
			}
			$this->team_model->set_fields($data);
			$result = $this->team_model->do_update();
			
			$this->session->set_flashdata( "success", "Team updated successfully.");
			redirect('administrator/team/edit_team/'.$data['id']);
		}
	}

	/*
		Delete milestone
	*/
	public function single_team_delete($id)
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
		redirect("administrator/plan/all");
	}

	public function delete_multiple()
	{
		$teams = $this->input->post('chk');
		foreach($teams as $data)
		{
			$this->team_model->do_delete($data);
		}
		echo 1;
		exit;
	}
}
?>