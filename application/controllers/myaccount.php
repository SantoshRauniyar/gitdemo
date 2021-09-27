<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Myaccount extends Template
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
		
		$this->load->model('myaccount_model');
		$this->load->model('authentication_model');
		$this->load->model('users_model');
		$this->load->model('user_classification_model');
		$this->user_classification_model->set_role();
		$this->load->helper('date');

		$this->set_header_path('blocks/header');
		$this->set_template('template');
		$this->set_title('My Account');

		$this->assets_load->add_css(array(base_url('assets/administrator/css/bootstrap-datetimepicker.min.css')),"header");
		$this->assets_load->add_js(array(base_url('assets/administrator/js/bootstrap-datetimepicker.js'),
										 base_url('assets/administrator/js/bootstrap-datetimepicker.fr.js'),
										 base_url('assets/administrator/js/vendors/users.js')),"footer");

		if(!$this->session->userdata('id'))
			redirect("authentication/");
	}

	public function get_state_list($country_id)
	{
		$data = array();
		$state_list = $this->users_model->get_state_list($country_id);
	
		if($state_list)
		{
			//$data['state_list'] = $state_list;
			if($this->input->is_ajax_request())
			{
				$data['status'] = "Success";
				$data['data']   = $state_list;
	
				echo json_encode($data);
				exit;
			}
		}
		else
		{
			$data['status'] = "Errors";
			$data['message']= "Not found";
				
			echo json_encode($data);
		}
	}
	
	public function get_city_list($state_id)
	{
		$data = array();
		$city_list = $this->users_model->get_city_list($state_id);
	
		if($city_list)
		{
			//$data['state_list'] = $state_list;
			if($this->input->is_ajax_request())
			{
				$data['status'] = "Success";
				$data['data']   = $city_list;
	
				echo json_encode($data);
				exit;
			}
		}
		else
		{
			$data['status'] = "Errors";
			$data['message']= "Not found";
	
			echo json_encode($data);
		}
	}
	public function index()
	{
		$data = array();
		$this->set_title('Edit User');
		$id = $this->session->userdata('id');
		$adduserdata = $this->users_model->getuserbyid($id);
		$data = $adduserdata;
		$data['citylist']		= $this->authentication_model->getcitydropdown();
		$data['statelist']		= $this->authentication_model->getstatedropdown();
		$data['countrylist']	= $this->authentication_model->getcountrydropdown();
		$data['mode'] 	= "edit";
		$data['action'] = base_url()."myaccount/do_update";
		$data['heading']= "Edit Profile";
		$this->view("myaccount/edit_profile",$data);
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
								'field'   => 'city_id', 
	                     		'label'   => 'city', 
	                     		'rules'   => 'trim'
							),
						array(
								'field'   => 'state_id', 
	                     		'label'   => 'state', 
	                     		'rules'   => 'trim'
							),
						array(
								'field'   => 'country_id', 
	                     		'label'   => 'country', 
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

		$fields 	= array ("id","user_name","first_name","last_name","birth_date","gender","address","city_id","state_id","country_id","email","contact_no","timezone");

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
			redirect('myaccount/');
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
					redirect('myaccount/');
				}
			}
			//print_r($profile_image);exit;
			$this->users_model->set_fields($data);
			$result = $this->users_model->do_update();
			
			$this->session->set_userdata('profile_image',$data['profile_image']);
			
			$this->session->set_flashdata( "success", "Profile updated successfully.");
			redirect('myaccount/');
		}

	}

	public function change_password()
	{
		$this->set_title('Change Password');
		$this->view('change_password');
	}

	public function update_password()
	{
		$config = array(
	             		array(
	                     'field'   => 'old_password', 
	                     'label'   => 'old password', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'new_password', 
	                     'label'   => 'new password', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'confirm_password', 
	                     'label'   => 'confirm password', 
	                     'rules'   => 'trim|required|matches[new_password]'
	                  )
				);
		$this->form_validation->set_rules($config);
		$fields 	= array ("old_password","new_password");

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			//$this->session->set_flashdata('login_data',$data);
			redirect('myaccount/change_password');
		}
		else
		{
			$data['password'] 	  = $data['new_password'];
			$data['old_password'] =md5($data['old_password']); //hash('SHA512',$data['old_password'],false);
			unset($data['new_password']);
			$data['password']	  = md5($data['password']);//hash('SHA512',$data['password'],false);
			$data['id'] = $this->session->userdata('id');
			$this->myaccount_model->set_fields($data);
			$results = $this->myaccount_model->update_user_password();
			
			if($results > 0)
			{
				$this->session->set_flashdata( "success", "Password updated successfully.");
				redirect('myaccount/change_password');
			}
			else
			{
				$this->session->set_flashdata( "errors", "Old password can not matched.");
				redirect('myaccount/change_password');
			}
		}
	}
}