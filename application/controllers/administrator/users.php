<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Users extends Template
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->model('users_model');
		$this->load->helper('date');

		$this->set_header_path('administrator/blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->set_template('administrator/template');
		$this->set_title('User Management');
		
		$this->assets_load->add_css(array(base_url('assets/administrator/css/bootstrap-datetimepicker.min.css')),"header");

		$this->assets_load->add_js(array(base_url('assets/administrator/js/bootstrap-datetimepicker.js'),
										 			base_url('assets/administrator/js/bootstrap-datetimepicker.fr.js'),
										 			base_url('assets/administrator/js/vendors/users.js')),"footer");
		
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
		$this->set_title["title"] = $this->set_title('User Management');

		$sort = !isset($_REQUEST['sort'])?'user_name':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		$userdata = $this->users_model->admin_getuserslist($sort,$type);

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
		$this->view("administrator/users/user_list",$data);
	}

	/* 
		Add User Process
	*/
	public function add_users()
	{
		$data = array();
		$this->set_title('Add User');
		$data 			= $this->session->flashdata('adduserdata');
		$data['mode'] 	= "Add";
		$data['action'] = base_url()."administrator/users/do_save/";
		$data['heading']= "Add User";
		$this->view("administrator/users/add_edit_users",$data);
	}

	public function do_save()
	{
		$config = array(
	             		array(
	                     'field'   => 'user_name', 
	                     'label'   => 'username', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'first_name', 
	                     'label'   => 'first name', 
	                     'rules'   => 'trim|required|alpha'
	                  ),
					  array(
	                     'field'   => 'last_name', 
	                     'label'   => 'last name', 
	                     'rules'   => 'trim|required|alpha'
	                  ),
					  array(
	                     'field'   => 'password', 
	                     'label'   => 'password', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'confirm_password', 
	                     'label'   => 'confirm password', 
	                     'rules'   => 'trim|required|matches[password]'
	                  ),
					  array(
	                     'field'   => 'user_role', 
	                     'label'   => 'user type', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'birth_date', 
	                     'label'   => 'birth date', 
	                     'rules'   => 'trim'
	                  ),
					  array(
	                     'field'   => 'gender', 
	                     'label'   => 'gender', 
	                     'rules'   => 'trim'
	                  ),
					  array(
	                     'field'   => 'address', 
	                     'label'   => 'address', 
	                     'rules'   => 'trim'
	                  ),
					  array(
	                     'field'   => 'email', 
	                     'label'   => 'email address', 
	                     'rules'   => 'trim|required|valid_email'
	                  ),
					  array(
	                     'field'   => 'contact_no', 
	                     'label'   => 'contact number', 
	                     'rules'   => 'trim|required|numeric|max_length[10]'
	                  ),
					  array(
					  	 'field'   => 'timezone', 
	                     'label'   => 'timezone', 
	                     'rules'   => 'trim|required'
				  )
                	);
		$this->form_validation->set_rules($config);

		$fields 	= array ("user_name","password","first_name","last_name","user_role","birth_date","gender","address","email","contact_no","timezone");

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}

		$profile_image = isset($_FILES['profile_image']['name'])?$_FILES['profile_image']['name']:'';
		//echo $profile_image;exit;
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			$this->session->set_flashdata('adduserdata',$data);
			redirect('administrator/users/add_users');
		}
		else
		{	
			if($profile_image != '')
			{
				$this->file_uploader->set_default_upload_path("./assets/upload/users/");
				$profile_image = $this->file_uploader->upload_image('profile_image');
				if($profile_image['status'] == 200)
				{
					$data['profile_image'] = $profile_image['data'];

				}
				else
				{
					$this->session->set_flashdata( "errors", $profile_image['status']." ".$profile_image['data']);
					//unset($data['password']);
					$this->session->set_flashdata('adduserdata',$data);
					redirect('administrator/users/add_users');
				}
			}
			//print_r($profile_image);exit;
			$data['password'] = hash("SHA512",$data['password'],false);
			$this->users_model->set_fields($data);
			$result = $this->users_model->save();

			if($result > 0)
			{
				$this->session->set_flashdata( "success", "User added successfully.");
				redirect('administrator/users/add_users');
			}
		}
	}
	
	public function switchuser($id)
	{
		
	}
	
	public function edit_user($id)
	{
		$data = array();
		$this->set_title('Edit User');

		$adduserdata = $this->users_model->getuserbyid($id);
		if(!$adduserdata)
			redirect("/administrator/users/all");
		else
			$data = $adduserdata;

		$data['mode'] 	= "edit";
		$data['action'] = base_url()."administrator/users/do_update";
		$data['heading']= "Edit User";
		$this->view("administrator/users/add_edit_users",$data);
	}

	public function do_update()
	{
		$config = array(
	             		array(
	                     'field'   => 'user_name', 
	                     'label'   => 'username', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'first_name', 
	                     'label'   => 'first name', 
	                     'rules'   => 'trim|required|alpha'
	                  ),
					  array(
	                     'field'   => 'last_name', 
	                     'label'   => 'last name', 
	                     'rules'   => 'trim|required|alpha'
	                  ),
					  array(
	                     'field'   => 'user_role', 
	                     'label'   => 'user type', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'birth_date', 
	                     'label'   => 'birth date', 
	                     'rules'   => 'trim'
	                  ),
					  array(
	                     'field'   => 'gender', 
	                     'label'   => 'gender', 
	                     'rules'   => 'trim'
	                  ),
					  array(
	                     'field'   => 'address', 
	                     'label'   => 'address', 
	                     'rules'   => 'trim'
	                  ),
					  array(
	                     'field'   => 'email', 
	                     'label'   => 'email address', 
	                     'rules'   => 'trim|required|valid_email'
	                  ),
					  array(
	                     'field'   => 'contact_no', 
	                     'label'   => 'contact number', 
	                     'rules'   => 'trim|required|numeric|max_length[10]'
	                  ),
					  array(
	                     'field'   => 'timezone', 
	                     'label'   => 'timezone', 
	                     'rules'   => 'trim|required'
	                  )
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("id","user_name","first_name","last_name","user_role","birth_date","gender","address","email","contact_no","timezone");

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		$profile_image = isset($_FILES['profile_image']['name'])?$_FILES['profile_image']['name']:'';
		//echo $profile_image;exit;

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			//$this->session->set_flashdata('adduserdata',$data);
			redirect('administrator/users/edit_user/'.$data['id']);
		}
		else
		{	
			if($profile_image != '')
			{
				//$this->users_model->set_field("id",$data['id']);
				$oldImagepath = $this->users_model->getImagePath($data['id']);
				//print_r($oldImagepath);exit;
				if($oldImagepath)
				{
					if(file_exists("assets/upload/users/".$oldImagepath['profile_image']))
					{
						unlink("assets/upload/users/".$oldImagepath['profile_image']);
					}
				}
				$this->file_uploader->set_default_upload_path("./assets/upload/users/");
				$profile_image = $this->file_uploader->upload_image('profile_image');
				if($profile_image['status'] == 200)
				{
					$data['profile_image'] = $profile_image['data'];
				}
				else
				{
					$this->session->set_flashdata( "errors", $profile_image['status']." ".$profile_image['data']);
					//unset($data['password']);
					//$this->session->set_flashdata('adduserdata',$data);
					redirect('administrator/users/edit_user/'.$data['id']);
				}
			}
			//print_r($profile_image);exit;
			$this->users_model->set_fields($data);
			$result = $this->users_model->do_update();

			$this->session->set_flashdata( "success", "User updated successfully.");
			redirect('administrator/users/edit_user/'.$data['id']);
		}
	}

	/*
		Delete Single User
	*/
	public function single_delete($user_id)
	{
		$result = $this->users_model->do_delete($user_id);
		if($this->input->is_ajax_request())
		{
			echo 1;
			exit;
		}
		redirect('administrator/users/all');
	}
	public function change_user_status($id,$status)
	{
		if($status == 0)
			$data['status'] = 1;
		else
			$data['status'] = 0;
		
		$this->users_model->changeUserStatus($id,$data);
		if($this->input->is_ajax_request())
		{
			echo 1;
			exit;
		}
		redirect('administrator/users/all');
	}
}
?>