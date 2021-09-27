<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');



class Myaccount extends Template

{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->model('myaccount_model');

		

		$this->set_header_path('administrator/blocks/header');

		//	$this->set_header_path('administrator/blocks/footer');

		$this->set_template('administrator/template');

		$this->set_title('My Account');

		

		if(!$this->session->userdata('admin_id'))

			redirect("administrator/authentication/");

	}

	public function index()

	{

		$this->set_title('Edit Profile');

		$data = $this->myaccount_model->getAdminProfile();

		$this->view('administrator/myaccount/edit_profile',$data);

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

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'last_name', 

	                     'label'   => 'last name', 

	                     'rules'   => 'trim|required'

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

	                  )

                	);

		$this->form_validation->set_rules($config);

		$fields 	= array ( "id","user_name","first_name","last_name","email","contact_no");

			

		foreach($fields as $field)

		{

			$data[$field] = $this->input->post($field);

		}

		

		

		if ($this->form_validation->run() == FALSE) 

		{

			$this->session->set_flashdata( "errors", validation_errors());

			//unset($data['password']);

			//$this->session->set_flashdata('login_data',$data);

			redirect('administrator/myaccount/');

		}

		else

		{

			$this->myaccount_model->set_fields($data);

			$result = $this->myaccount_model->do_update();

			

			$this->session->set_flashdata( "success", "Profile updated successfully.");

			redirect('administrator/myaccount/');

			

		}

	}

	public function change_password()

	{

		$this->set_title('Change Password');

		$this->view('administrator/myaccount/change_password');

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

			redirect('administrator/myaccount/change_password');

		}

		else

		{

			$data['password'] = $data['new_password'];

			//$data['old_password'] = hash('SHA512',$data['old_password'],false);

			unset($data['new_password']);

			$data['id'] = $this->session->userdata('admin_id');

			$this->myaccount_model->set_fields($data);

			$results = $this->myaccount_model->update_password();

			

			if($results > 0)

			{

				$this->session->set_flashdata( "success", "Password updated successfully.");

				redirect('administrator/myaccount/change_password');

			}

			else

			{

				$this->session->set_flashdata( "errors", "Old password can not matched.");

				redirect('administrator/myaccount/change_password');

			}

		}

	}

}