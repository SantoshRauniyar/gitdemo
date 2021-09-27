<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Authentication extends Template
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
		
		$this->load->model('authentication_model');
		$this->load->model("myaccount_model");
		$this->load->model('users_model');
		$this->load->model('team_model');
		$this->load->model('groups_model');
		$this->load->model('user_role_model');
		$this->load->model('plan_model');
		$this->load->model('user_classification_model');
		$this->load->model('notification_model');
		
		$this->load->helper('date');
		$this->load->helper('form');

		$this->set_header_path('blocks/header');
		$this->set_template('template');
		$this->set_title('Authentication');
	}

	public function index()
	{
		$data['user_name'] 		 = isset($_COOKIE['user_name'])?$_COOKIE['user_name']:''; 
		$data['user_password']   = isset($_COOKIE['user_password'])?$_COOKIE['user_password']:'';
		$data['email']			 = isset($_COOKIE['email'])?$_COOKIE['email']:'';

		if(!$this->session->userdata('id'))
		{
			if($data['user_name'] == '' || $data['user_password'] == '' || $data['email'] == '')
			{
				redirect('authentication/login');
			}
			else
			{
				$data 					= array();
				$data['user_name'] 		= $_COOKIE['user_name'];
				$data['user_password'] 	= $_COOKIE['user_password'];
				$data['email']			= $_COOKIE['email'];
				$data['title']			= 'Login | Project Management';

				$this->load->view('login',$data);
			}
		}
		else
		{
			redirect('dashboard/view_haspatal_dashboard/');
		}
	}

	
	/*
		User Authentication
	*/
	public function login()
	{
		if($this->session->userdata('id') != '' && $this->session->userdata('user_name') != '')
		{
			redirect("dashboard/view_haspatal_dashboard/");
		}
		else
		{
			$data = array();
			$this->set_title('Login');
			$data			= $this->session->flashdata('login_data');
			$data['title'] 	= 'Login | Project Management';
			$this->load->view('login',$data);
		}
	}

	public function do_login()
	{
		$config =array
					(
	             	array(
	                     'field'   => 'user_name', 
	                     'label'   => 'Username', 
	                     'rules'   => 'trim|required'
	                  ),
	            	array(
	               	     'field'   => 'password', 
	                     'label'   => 'Password', 
	                     'rules'   => 'trim|required'
	                  ),
						array(
								'field' => 'email',
								'label' => 'email', 
								'rules' => 'trim|required|valid_email'
						)
					);
		$this->form_validation->set_rules($config);

		$fields 	= array ( "user_name", "password","email" );

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			unset($data['password']);
			$this->session->set_flashdata('login_data',$data);
			redirect('authentication/login');
		}
		else
		{
			$password		  = $data['password'];
			$data['password'] = md5($password); //hash("SHA512",$data['password'],false);
			//print_r($data);exit;
			$this->authentication_model->set_fields($data);
			$row = $this->authentication_model->do_userlogin();
			//print_r($row);exit;

			if (!empty($row)) // Data is in row set session
			{		
				if($row['user_role'] != 'Captain')
				{
					$result = $this->user_classification_model->getprivillages($row['user_role']);
					if(!empty($result))
					{
						/*foreach($result as $key=>$value)
						{
							$row[$key] = $value;
						}*/	
					} 
				}

				//$res=$this->user_classification_model->getprivillages($row['user_role']);
				//$this->session->set_userdata($res);
				if(isset($_REQUEST['remember']) && $_REQUEST['remember'] ==  "on")
				{	
					setcookie('user_name',$data['user_name'],time()+3600*24*60,'/');
					setcookie('user_password',$password,time()+3600*24*60,'/');
					setcookie('email',$data['email'],time()+3600*24*60,'/');
				}
				else
				{
					setcookie('user_name','',1000,'/');
					setcookie('user_password','',1000,'/');
					setcookie('email','',1000,'/');
				}
				 $this->session->set_userdata('user_name',$data['user_name']);
				 $this->session->set_userdata('uimage',$data['profile_image']);
				 $this->session->set_userdata('fullname',$data['first_name'].' '.$data['last_name']);
				 $this->session->set_userdata('user_id',$data['id']);
				 $this->session->set_userdata('user_role',$data['user_role']);
				 $this->session->set_userdata('team_id',$data['team_id']);
				

				/*$row['admin_id']   = $row['id'];
				$row['admin_name'] = $row['user_name']; 
				unset($row['id']);
				unset($row['user_name']);*/
				$this->session->set_userdata($row);///do not remove this by santoshrauni checked 
				//print_r($row);exit;
				if($row['plan_id'] != '' && $row['plan_id'] != 0)
				{					
					//print_r($row);exit;
					redirect("program_dashboard/");
				}
				else 
				{
					redirect("program_dashboard/");
				}
	
			}
			else
			{
				$user_id = $this->users_model->getUserId($data);
				if($user_id)
				{
					if($this->session->userdata('unsuccess_id') != '' && $this->session->userdata('unsuccess_id') == $user_id['id'])
					{
						if($this->session->userdata('count') == 2) 
						{
							$result = $this->users_model->changeUserStatus($user_id['id'],array("status"=>0));
							$this->session->set_flashdata( "errors", 'You completed three unsuccessfull attempt, because of security reasone your account is locked please contact to admin...!');
							unset($data['password']);
							$this->session->set_flashdata('login_data',$data);
							redirect('authentication/login');	
						}
						else
						{
							$this->session->set_userdata('count',$this->session->userdata('count')+1);
						}
					}
					else
					{
						$this->session->set_userdata('unsuccess_id',$user_id['id']);
						//echo $this->session->userdata('id');exit;
						$this->session->set_userdata('count',1);
					}
				}
				else
				{
					$this->session->set_flashdata( "errors", 'No such account found, please register first and then login.');
					unset($data['password']);
					$this->session->set_flashdata('login_data',$data);
					redirect('authentication/login');
				}
				$this->session->set_flashdata( "errors", 'Invalid username, password, or email address.');
				unset($data['password']);
				$this->session->set_flashdata('login_data',$data);
				redirect('authentication/login');			
			}
		}
	}
	
	/* Catpain Registration */
	public function register()
	{
		iF($this->session->flashdata('success') != false)
		{
			$data = array();
			$this->set_title('Verification');
			$data['title'] = "Verification | Project Management";
			$data['heading'] = "Verification";
			$this->load->view("varification_messages",$data);
			//$this->load->view("common/varification_msg",$data);
			return true;			
		}
		$data = array();
		$this->set_title('Registration');
		$data['title'] 			= 'Registration | Project Management';
		$data['register_data']  = $this->session->flashdata('register_data');
		$this->load->view('register',$data);
	}

	public function do_register()
	{
		$config = array(
	             		array(
	                     'field'   => 'email', 
	                     'label'   => 'email', 
	                     'rules'   => 'trim|required|valid_email'
	                  )
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("email");
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			$this->session->set_flashdata('register_data',$data);
			redirect('authentication/register');
		}
		else
		{
			if($this->users_model->isEmailExist($data['email']))
			{
				$this->session->set_flashdata( "errors", "Email is already exist.");
				$this->session->set_flashdata('register_data',$data);
				redirect('authentication/register');
			}
			else
			{
				$data['ip'] 	   = $this->input->ip_address();
				$data['user_role'] = "Captain";
				$this->users_model->set_fields($data);
				$result_id = $this->users_model->save();
				if($result_id > 0)
				{
					$emailBody = file_get_contents("./assets/email/registretionformlink.html");
					$emailBody=str_replace("<@link@>",base_url()."authentication/registerform/".$result_id,$emailBody);
					//echo $emailBody;
					$headers = "MIME-Version: 1.0\r\n"; 
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: Kizaku <system@kizaku.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();

					mail($data['email'], "Project Management - Verification Link", $emailBody, $headers);

					$this->session->set_flashdata('success',"Please check your email Verification Link sent to Your Email:".$data['email']);
					redirect("authentication/register");
				}
			}
		}
	}
	
	

	public function registerform($id)
	{
		//echo $id;exit;
		$data = array();; 
		$this->set_title('Registration');
		$data							= $this->users_model->getuserbyid($id);
		//$data['planlist']		= $this->plan_model->getplans();
		
		$data['citylist']			= $this->authentication_model->getcitydropdown();
		
		$data['statelist']		= $this->authentication_model->getstatedropdown();
		$data['countrylist']		= $this->authentication_model->getcountrydropdown();
		$data['title'] 			= 'Registration | Project Management';
		$data['register_data']  = $this->session->flashdata('register_data');
		$data['action']			= base_url()."authentication/do_registration";
		$data['mode'] 				= "Add";
		$data['heading'] 			= "User Registration";
		$this->load->view('edit_profile',$data);
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


	public function do_registration()
	{
		$data 	= array();
		$config	= array(
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
								'field'   => 'user_name', 
	                    		'label'   => 'user name', 
			                    'rules'   => 'trim|required|min_length[6]|max_length[20]'
							),
						array(
								'field'   => 'password', 
	                     		'label'   => 'password', 
	                     		'rules'   => 'trim|required|min_length[6]|max_length[20]'
							),
						array(
								'field'   => 'confirm_password', 
	                     		'label'   => 'confirm password', 
	                     		'rules'   => 'trim|required|matches[password]'
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
	                     		'label'   => 'email', 
	                     		'rules'   => 'trim|required|valid_email'
							),
						array(
								'field'   => 'contact_no', 
	                     		'label'   => 'contact number', 
	                     		'rules'   => 'trim'
							),
						array(
								'field'   => 'timezone', 
	                     		'label'   => 'timezone', 
	                     		'rules'   => 'trim|required'
							)
					);
		$this->form_validation->set_rules($config);

		$fields = array("id","first_name","last_name","user_name","password","birth_date","gender","address","city_id","state_id","country_id","email","contact_no","timezone");

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		//print_r($data);exit;
		$profile_image = isset($_FILES['profile_image']['name'])?$_FILES['profile_image']['name']:'';

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('error',validation_errors());
			$this->session->set_flashdata('register_data',$data);
			redirect('authentication/registerform/'.$data['id']);
		}
		else
		{
			if(!$this->users_model->isUserNameExists($data['id'],$data['user_name']))
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
						unset($data['password']);
						$this->session->set_flashdata('register_data',$data);
						redirect('authentication/registerform/'.$data['id']);
					}
				}
				//print_r($profile_image);exit;
				$password		  = $data['password'];
				$data['password'] = md5($data['password']);//hash("SHA512",$data['password'],false);
				$data['ip'] 	  = $this->input->ip_address(); 
				$this->users_model->set_fields($data);
				$result = $this->users_model->do_update();
	
				if($result > 0)
				{
					$emailBody = file_get_contents("./assets/email/register_success_msg.html");
					$emailBody = str_replace("<@user_name@>",$data['user_name'],$emailBody);
					/*$emailBody = str_replace("<@password@>",$password,$emailBody);
					$emailBody = str_replace("<@link@>",base_url()."authentication/login/",$emailBody);*/
					
					//echo $emailBody;
						
					$headers = "MIME-Version: 1.0\r\n"; 
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: Kizaku <system@kizaku.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					mail($data['email'], "Kizaku : Registration Successful", $emailBody, $headers);
					
					$notification_data['to_users'] = "admin,";
					$notification_data['message']  = $data['first_name']." ".$data['last_name']." is register as a team captain.";
					
					$this->notification_model->set_fields($notification_data);
					$this->notification_model->save();
					
					
					$adminemail = $this->myaccount_model->getadminemail();
					
					//print_r($adminemail);exit;
					
					$emailBody1 = file_get_contents("./assets/email/approval_panding.html");
					$emailBody1 = str_replace("<@user_name@>",$data['user_name'],$emailBody1);
					$emailBody1 = str_replace("<@name@>",$data['first_name']." ".$data['last_name'],$emailBody1);
					$emailBody1 = str_replace("<@address@>",$data['address'],$emailBody1);
					$emailBody1 = str_replace("<@email@>",$data['email'],$emailBody1);
					$emailBody1 = str_replace("<@phone@>",$data['contact_no'],$emailBody1);
					$emailBody1 = str_replace("<@link@>" , base_url('authentication/active_user/'.$data['id'].'/'.$password.'/1'),$emailBody1);
					
					
					
					mail($adminemail['email'], "Kizaku : Approval Pending : [".$data['user_name']."]", $emailBody1, $headers);								
					$this->session->set_flashdata( "success", "Registation successfully. Mail sent to your email address with authentication details and login link. ");
					redirect('authentication/registerform/'.$data['id']);
				}
			}
			else
			{
				$this->session->set_flashdata( "errors", "User Name is already exist.");
				unset($data['password']);
				$this->session->set_flashdata('register_data',$data);
				redirect('authentication/registerform/'.$data['id']);
			}
		}
	}
	
	public function active_user($id,$password,$status)
	{

		$data			= array();
		//$data['id'] 	= $id;
		$data['status'] = $status;
		$this->users_model->changeUserStatus($id,$data);
		
		$result = $this->users_model->get_userdetails_by_id($id);
		
		$emailBody 		= file_get_contents("./assets/email/login_form_link.html");
		$emailBody 		= str_replace("<@user_name@>",$result['user_name'],$emailBody);
		$emailBody 		= str_replace("<@id@>",$id,$emailBody);
		$emailBody 		= str_replace("<@password@>",$password,$emailBody);
		$emailBody 		= str_replace("<@email@>",$result['email'],$emailBody);
		$emailBody 		= str_replace("<@link@>",base_url("authentication/login"),$emailBody);
		
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
		$headers .= "From: Kizaku <system@kizaku.com> \r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();
		
		mail($result['email'],"Kizaku : Approval successful",$emailBody,$headers); 
	}
	
	public function logout()
	{
		$this->session->unset_userdata("id");
		$this->session->unset_userdata("user_name");
		$this->session->unset_userdata("deliverdata1");
		$this->session->sess_destroy();
		$this->clear_cache();

		redirect("index/");
	}
}