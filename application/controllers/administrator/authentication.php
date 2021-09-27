<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Authentication extends Template
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('authentication_model');
		
		$this->set_header_path('administrator/blocks/header');
		$this->set_template('administrator/template');
		$this->set_title('Authentication');
	}
	public function index()
	{
		$data['admin_name'] = isset($_COOKIE['admin_name'])?$_COOKIE['admin_name']:''; 
		$data['password']   = isset($_COOKIE['password'])?$_COOKIE['password']:'';
		
		if(!$this->session->userdata('admin_id'))
		{
			if($data['admin_name'] == '' || $data['password'] == '')
			{
				redirect('administrator/authentication/login');
			}
			else
			{
				$data = array();
				$data['admin_name'] = $_COOKIE['admin_name'];
				$data['password'] 	= $_COOKIE['password'];
				$data['title']		= 'Admin Login | Project Management';
				$this->load->view('administrator/authentication/login',$data);
			}
		}
		else
		{
			
			redirect('administrator/myaccount/');
		}
	}
	public function login()
	{
		$data = array();
		$this->set_title('Admin Login');
		$data['title'] 		= 'Admin Login | Project Management';
		$data['login_data'] = $this->session->flashdata('login_data');
		$this->load->view('administrator/authentication/login',$data);
	}
	
	public function do_login()
	{	
		$config = array(
	             		array(
	                     'field'   => 'admin_name', 
	                     'label'   => 'Username', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'password', 
	                     'label'   => 'Password', 
	                     'rules'   => 'trim|required|md5'
	                  )
                	);
	
		$this->form_validation->set_rules($config);
		$fields 	= array ( "admin_name", "password" );
			
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			unset($data['password']);
			$this->session->set_flashdata('login_data',$data);
			redirect('administrator/authentication/login');
		}
		
		else
		{
			$this->authentication_model->set_fields($data);
			$row = $this->authentication_model->do_login();
			
			//print_r($row);exit;
			if ( $row ) // Data is in row set session
			{
				if(isset($_REQUEST['remember']) && $_REQUEST['remember'] ==  "on")
				{
					
					setcookie('admin_name',$data['admin_name'],time()+3600*24*60,'/');
					setcookie('password',$data['password'],time()+3600*24*60,'/');
				}
				else
				{
					
					setcookie('admin_name','',1000,'/');
					setcookie('password','',1000,'/');
				}

				$row['admin_id']   = $row['id'];
				$row['admin_name'] = $row['user_name']; 
				
				unset($row['id']);
				unset($row['user_name']);
				
				$this->session->set_userdata( $row );
				redirect("administrator/myaccount");
			}
			
			else
			{
				$this->session->set_flashdata( "errors", 'Invalid username or password.');
				unset($data['password']);
				$this->session->set_flashdata('login_data',$data);
				redirect('administrator/authentication/login');			
			}
		}
	}
	
	
	public function logout()
	{
		$this->session->unset_userdata("admin_id");
		$this->session->unset_userdata("admin_name");
		$this->clear_cache();	
		redirect("administrator/authentication/");
	}
}