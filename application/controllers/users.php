<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Users extends Template
{
	public function __construct()
	{
		parent::__construct();
		
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		header("Cache-Control: no-store,no-cache, must-revalidate");
		
		$this->load->library('form_validation');
		$this->load->library('session');
		
		$this->load->model('users_model');
		$this->load->model('team_model');
		$this->load->model('plan_model');
		$this->load->model('user_classification_model');
		$this->user_classification_model->set_role();
		$this->load->model('authentication_model');
		
		$this->load->helper('form');
		$this->load->helper('date');
		$this->set_header_path('blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->set_template('template');
		$this->set_title('User Management');
		$this->assets_load->add_css(array(base_url('assets/administrator/css/bootstrap-datetimepicker.min.css')),"header");
		$this->assets_load->add_js(array(base_url('assets/administrator/js/bootstrap-datetimepicker.js'),
										 base_url('assets/administrator/js/bootstrap-datetimepicker.fr.js'),
										 base_url('assets/administrator/js/vendors/users.js')),"footer");
	
		if(!$this->session->userdata('id'))
			redirect("authentication/");
	}

	public function index()
	{
		$this->all();
	}

				function  check_permission()
				{

							
				}
	
	/*
		Manage users view
	*/
	public function all()
	{
	    if( $this->session->userdata('Captain') or $this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_member'))
	
	{	//$this->data['current_page'] = 'viewdetail';
		$this->set_title["title"] = $this->set_title('User Management');
		$sort 					  = !isset($_REQUEST['sort'])?'user_name':$_REQUEST['sort'];
		$type 					  = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
		$userdata 				  = $this->users_model->getuserslist($sort,$type,$this->session->userdata('id'),$this->session->userdata('team_id'));

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
      	$data['teamlist'] = $this->team_model->getteamlistdropdown($this->session->userdata('id'));
		$this->view("users/user_list",$data);
	}
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

/* 
		Add User Process
	*/
	public function add_users()
	{

			if($this->session->userdata('user_role')=="Captain" or $this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_member'))
					{
		$data = array();
		$this->set_title('Add User');
		
		
		$data 				 = $this->session->flashdata('adduserdata');
		//$data['teamlist']	 = $this->team_model->getteamlistdropdown($this->session->userdata('id'));
		$data['userrolelist']= $this->user_classification_model->get_user_role_dropdown($this->session->userdata('id'),$this->session->userdata('team_id'));
		$data['citylist']	 = $this->authentication_model->getcitydropdown();
		$data['statelist']	 = $this->authentication_model->getstatedropdown();
		$data['districtlist']	 = $this->authentication_model->getdistrictdropdown();
		$data['countrylist'] = $this->authentication_model->getcountrydropdown();
		$data['cityzonelist']=$this->db->select('id,city_zone')->from('city_zone')->get()->result();
		$data['program']=$this->db->select('pid,pro_name')->from('program')->get()->result();
		$data['mode'] 		 = "Add";
		$data['action'] 	 = base_url()."users/do_save/";
		$data['heading']	 = "Add User";
		
		$this->view("users/add_edit_users",$data);
	}//close
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
					  /*array(
	                     'field'   => 'user_role', 
	                     'label'   => 'user type', 
	                     'rules'   => 'trim|required'
	                  ),*/
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
					  ),
					  /*array(
					  	 'field'   => 'cityzone', 
	                     'label'   => 'cityzone', 
	                     'rules'   => 'trim|required'
					  ),*/
					  array(
					  	 'field'   => 'district', 
	                     'label'   => 'District', 
	                     'rules'   => 'trim|required'
					  ),
					  array(
					  	 'field'   => 'program', 
	                     'label'   => 'Program', 
	                     'rules'   => 'trim'
					  ),
					  array(
					  	 'field'   => 'department', 
	                     'label'   => 'Department', 
	                     'rules'   => 'trim'
					  ),
					  array(
					  	 'field'   => 'section', 
	                     'label'   => 'Section', 
	                     'rules'   => 'trim'
					  ),
					  array(
					  	 'field'   => 'unit', 
	                     'label'   => 'unit', 
	                     'rules'   => 'trim'
					  ),
                	);
                	
                	if($this->input->post('user_role')==19)
                	{
                	    $this->form_validation->set_rules('cityzone','City Zone','required|trim');
                	}
                	
		$this->form_validation->set_rules($config);
		$fields 	= array ("program","section","unit","department","user_name","password","first_name","last_name","user_role","birth_date","gender","address","city_id","state_id","country_id","email","contact_no","timezone","cityzone","district");

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		$profile_image = isset($_FILES['profile_image']['name'])?$_FILES['profile_image']['name']:'';
		$id_proof = isset($_FILES['id_proof']['name'])?$_FILES['id_proof']['name']:'';
		$address_proof = isset($_FILES['address_proof']['name'])?$_FILES['address_proof']['name']:'';
		$offer_letter = isset($_FILES['offer_letter']['name'])?$_FILES['offer_letter']['name']:'';
		//echo $profile_image;exit;

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			$this->session->set_flashdata('adduserdata',$data);
			redirect('users/add_users');
		}
		
		else
		{	
			$data['team_id'] = $this->session->userdata("team_id");
			//$noofuser  = $this->plan_model->get_no_of_user($this->session->userdata('plan_id'));
			$countuser = $this->users_model->count_no_of_user($data['team_id']);
			
			/*if($countuser['total_user'] >= $noofuser['no_of_user_in_team'])
			{
				$this->session->set_flashdata( "errors", "Your user creation quota is over,Please upgrad your plan for add more user into team. ");
				//unset($data['password']);
				$this->session->set_flashdata('adduserdata',$data);
				redirect('users/add_users');
			}*/
			
			$data['user_name'] = trim($data['user_name'],' ');
			if($this->users_model->isUserExist($data['user_name'],$data['team_id']))
			{
				$this->session->set_flashdata( "errors", "User name is already exist in this team! ");
				//unset($data['password']);
				$this->session->set_flashdata('adduserdata',$data);
				redirect('users/add_users');
			}	
			$data['created_by'] = $this->session->userdata('id');
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
					redirect('users/add_users');
				}
			}
			//id_proof
			if($id_proof != '')
			{
				$this->file_uploader->set_default_upload_path("./assets/upload/users/");
				$id_proof = $this->file_uploader->upload_image('id_proof');
				if($id_proof['status'] == 200)
				{
					$data['id_proof'] = $id_proof['data'];
				}
				else
				{
					$this->session->set_flashdata( "errors", $id_proof['status']." ".$id_proof['data']);
					//unset($data['password']);
					$this->session->set_flashdata('adduserdata',$data);
					redirect('users/add_users');
				}
			}
			//
			//address_proof
			if($address_proof != '')
			{
				$this->file_uploader->set_default_upload_path("./assets/upload/users/");
				$address_proof = $this->file_uploader->upload_image('address_proof');
				if($address_proof['status'] == 200)
				{
					$data['address_proof'] = $address_proof['data'];
				}
				else
				{
					$this->session->set_flashdata( "errors", $address_proof['status']." ".$address_proof['data']);
					//unset($data['password']);
					$this->session->set_flashdata('adduserdata',$data);
					redirect('users/add_users');
				}
			}
			
			
			//offer_letter
			if($offer_letter != '')
			{
				$this->file_uploader->set_default_upload_path("./assets/upload/users/");
				$offer_letter = $this->file_uploader->upload_image('offer_letter');
				if($offer_letter['status'] == 200)
				{
					$data['offer_letter'] = $offer_letter['data'];
				}
				else
				{
					$this->session->set_flashdata( "errors", $offer_letter['status']." ".$offer_letter['data']);
					//unset($data['password']);
					$this->session->set_flashdata('adduserdata',$data);
					redirect('users/add_users');
				}
			}
			
			//print_r($profile_image);exit;
			$ps=$data['password'];
			$data['password'] =md5($data['password']); //hash("SHA512",$data['password'],false);
			$this->users_model->set_fields($data);
			$result = $this->users_model->save();
			
			if($result > 0)
			{
			    
			              if($data['email'] != '')
			{
				if(filter_var($data['email'],FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/register_success_msg.html");
					$emailBody = str_replace("<@name@>",$data['first_name'].' '.$data['last_name'],$emailBody);

					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					// mail  for login link 
					
					$emailBody = file_get_contents(base_url()."assets/email/login_form_link.html");
					$emailBody = str_replace("<@user_name@>",$data['user_name'],$emailBody);
					$emailBody = str_replace("<@password@>",$ps,$emailBody);
					$emailBody = str_replace("<@email@>",$data['email'],$emailBody);
					$emailBody = str_replace("<@link@>",'http://kizaku.haspatal.com/authentication/login',$emailBody);

					

					
					//closed mail
					
					if(!mail($data['email'], "Team Management - Member Created in ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
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
			    
				$this->session->set_flashdata( "success", "User added successfully.");
				redirect('users/all');
			}
		}
	}
	
	
	public function do_switch_user($id,$team_id = '')
	{
		if($team_id == '')
		{
			echo "Team Name field is required.";
			exit;
		}
		$data['id'] = $id;
		$data['team_id'] = $team_id;
		//print_r($data);exit;
		$this->users_model->set_fields($data);
		$result = $this->users_model->do_update();
		echo 1;
		exit;
	}

	public function edit_user($id)
	{
				if($this->session->userdata('user_role')=="Captain")
						{
		$data = array();
		$this->set_title('Edit User');
		$adduserdata = $this->users_model->getuserbyid($id);

		if(!$adduserdata)
			redirect("users/all");
		else
			$data = $adduserdata;
		//$data['teamlist']	 = $this->team_model->getteamlistdropdown($this->session->userdata('id'));
		$data['userrolelist']= $this->user_classification_model->get_user_role_dropdown($this->session->userdata('id'),$this->session->userdata('team_id'));
		$data['citylist']	 = $this->authentication_model->getcitydropdown();
		$data['districtlist']	 = $this->authentication_model->getdistrictdropdown();
		$data['statelist']	 = $this->authentication_model->getstatedropdown();
		$data['countrylist'] = $this->authentication_model->getcountrydropdown();
	//$data['programlist'] = $this->authentication_model->getprogramdropdown();
		$data['mode'] 		 = "edit";
		$data['action'] 	 = base_url()."users/do_update";
		$data['heading']	 = "Edit User";
		$this->view("users/add_edit_users",$data);
	}//close
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
		$fields 	= array ("id","user_name","first_name","last_name","user_role","birth_date","gender","address","city_id","state_id","country_id","email","contact_no","timezone");

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
			redirect('users/edit_user/'.$data['id']);
		}
		else
		{	$data['user_name'] = trim($data['user_name'],' ');
		    $data['team_id']   = $this->session->userdata('team_id');
			if($this->users_model->isUserExist($data['user_name'],$data['team_id'],$data['id']))
			{
				$this->session->set_flashdata( "errors", "User name is already exist in this team! ");
				//unset($data['password']);
				$this->session->set_flashdata('adduserdata',$data);
				redirect('users/add_users');
			}	
			if($profile_image != '')
			{
				//$this->users_model->set_field("id",$data['id']);
				$oldImagepath = $this->users_model->getImagePath($data['id']);
				//print_r($oldImagepath);exit;
				if($oldImagepath['profile_image'] != '')
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
					redirect('users/edit_user/'.$data['id']);
				}
			}
			//print_r($profile_image);exit;
			//id proof
			
			if($id_proof != '')
			{
				//$this->users_model->set_field("id",$data['id']);
				$oldImagepath = $this->users_model->getImagePath($data['id']);
				//print_r($oldImagepath);exit;
				if($oldImagepath['id_proof'] != '')
				{
					if(file_exists("assets/upload/users/".$oldImagepath['id_proof']))
					{
						unlink("assets/upload/users/".$oldImagepath['id_proof']);
					}
				}
				$this->file_uploader->set_default_upload_path("./assets/upload/users/");
				$id_proof = $this->file_uploader->upload_image('id_proof');
				if($id_proof['status'] == 200)
				{
					$data['id_proof'] = $id_proof['data'];
				}
				else
				{
					$this->session->set_flashdata( "errors", $id_proof['status']." ".$id_proof['data']);
					//unset($data['password']);
					//$this->session->set_flashdata('adduserdata',$data);
					redirect('users/edit_user/'.$data['id']);
				}
			}
			
			//addressproof
			if($address_proof != '')
			{
				//$this->users_model->set_field("id",$data['id']);
				$oldImagepath = $this->users_model->getImagePath($data['id']);
				//print_r($oldImagepath);exit;
				if($oldImagepath['address_proof'] != '')
				{
					if(file_exists("assets/upload/users/".$oldImagepath['address_proof']))
					{
						unlink("assets/upload/users/".$oldImagepath['address_proof']);
					}
				}
				$this->file_uploader->set_default_upload_path("./assets/upload/users/");
				$address_proof = $this->file_uploader->upload_image('address_proof');
				if($address_proof['status'] == 200)
				{
					$data['address_proof'] = $address_proof['data'];
				}
				else
				{
					$this->session->set_flashdata( "errors", $address_proof['status']." ".$address_proof['data']);
					//unset($data['password']);
					//$this->session->set_flashdata('adduserdata',$data);
					redirect('users/edit_user/'.$data['id']);
				}
			}
			
			//offer latter
			if($offer_letter != '')
			{
				//$this->users_model->set_field("id",$data['id']);
				$oldImagepath = $this->users_model->getImagePath($data['id']);
				//print_r($oldImagepath);exit;
				if($oldImagepath['offer_letter'] != '')
				{
					if(file_exists("assets/upload/users/".$oldImagepath['offer_letter']))
					{
						unlink("assets/upload/users/".$oldImagepath['offer_letter']);
					}
				}
				$this->file_uploader->set_default_upload_path("./assets/upload/users/");
				$offer_letter = $this->file_uploader->upload_image('offer_letter');
				if($offer_letter['status'] == 200)
				{
					$data['offer_letter'] = $offer_letter['data'];
				}
				else
				{
					$this->session->set_flashdata( "errors", $offer_letter['status']." ".$offer_letter['data']);
					//unset($data['password']);
					//$this->session->set_flashdata('adduserdata',$data);
					redirect('users/edit_user/'.$data['id']);
				}
			}
			
			
			$this->users_model->set_fields($data);
			$result = $this->users_model->do_update();

			$this->session->set_flashdata( "success", "User updated successfully.");
			redirect('users/all');
		}
	}
	
	public function invite_user()
	{
		$data = array();
		$this->set_title("Invite Users");
		$data = $this->session->flashdata('emails');
		$data['heading'] = "Invite Users";
		$data['action']  = base_url()."users/send_invitation/";
		$this->view("users/invite_user",$data);
	}

	public function send_invitation()
	{
		$data = array();
		$erroremail = array();
		$emails = $this->input->post("email");
		$i = 0;
		foreach ($emails as $email)
		{
			if($email != '')
			{
				if(filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					if($this->users_model->isEmailExist($email))
					{
						$erroremail[$i] = $email;
						$i++;
						
 						$this->session->set_flashdata( "errors", "Email is already exist.");
// 						$this->session->set_flashdata('emails',$data);
// 						redirect('users/invite_user');
					}
					$data['created_by'] = $this->session->userdata("id");
					$data['email'] = $email;
					$this->users_model->set_fields($data);
					$result_id = $this->users_model->save();

					$emailBody = file_get_contents(base_url()."assets/email/invitationmail.html");
					$emailBody = str_replace("<@linkjoin@>",base_url()."users/add_edit_users/".$result_id,$emailBody);
					$emailBody = str_replace("<@linkno@>",base_url()."users/single_delete/".$result_id,$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: Kizaku <system@kizaku.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($email, "Project Management - Invitation to join ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
					{
						$erroremail[$i] = $email;
						$i++;
						$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
				}
				else 
				{
					$erroremail[$i] = $email;
					$i++;
					$this->session->set_flashdata( "errors", "Please enter valid email address.");
				//	$this->session->set_flashdata('emails',$data);
				//	redirect('users/invite_user');
				}
			}
			else
			{
				$erroremail[$i] = $email;
				$i++;
				$this->session->set_flashdata( "errors", "Please enter email address.");
				//$this->session->set_flashdata('emails',$data);
				//redirect('users/invite_user');
			}
		}
		if($i > 0)
		{
			$this->session->set_flashdata('emails',$erroremail);
			redirect('users/invite_user');
		}
		else
		{
			$this->session->set_flashdata( "success", "Invitation send successfully.");
			redirect('users/all');
		}
	}
	/*
		Delete Single User
	*/
	public function single_delete($user_id)
	{

		if($this->session->userdata('user_role')=="Captain")
		{
		$result = $this->users_model->do_delete($user_id);
		if($this->input->is_ajax_request())
		{
			echo 1;
			exit;
		}
		redirect('users/all');
	}//close
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
		redirect('users/all');
	}


				function getusers()
				{


						if ($this->input->get('did')) {
							
							$id=$pid=$uid=$sid=$did=0;
							    $uid=$this->input->get('uid');
								$pid=$this->input->get('pid');
								$sid=$this->input->get('uid');
								$did=$this->input->get('did');
								$id=$this->input->get('id');
							
							$dept=$this->db->select('manager_id')->from('department')->where('did',$did)->get()->result();
							$pro=$this->db->select('pro_head')->from('program')->where('pid',$pid)->get()->result();
							$sec=$this->db->select('section_head')->from('section')->where('id',$sid)->get()->result();
							$unit=$this->db->select('uhead')->from('unit')->where('id',$uid)->get()->result();
							
							
							
						//	var_dump($dept);exit();
						//head of their exclude them id is self head of id
								$d=$p=$s=$u=0;
								if(isset($dept) && !empty($dept))
								{
							     $d=$dept[0]->manager_id;
								}
								
								if(isset($pro) && !empty($pro))
								{
							    $p=$pro[0]->pro_head;
								}
								if(isset($sec) && !empty($sec))
								{
							    $s=$sec[0]->section_head;
								}
								if(isset($sec) && !empty($sec))
								{
							    $u=$unit[0]->section_head;
								}
								
								$this->db->select('id,first_name,last_name');
							    $this->db->where('created_by',$this->session->userdata('id'));
								$this->db->where_not_in('user_role',[22,36,24,37,21,0]);
								$this->db->where_not_in('id',[$s,$p,$d,$u,$id]);
								$this->db->order_by('user_name','asc');
							$res=$this->db->get('users');
							$data=$res->result();
								$response=['message'=>'Success','status'=>200,'data'=>$data];
								?>

									<select class="form-control" name="users[]" multiple="" id="my">
										<option>Select Please</option>
									<?php
											foreach ($data as $value) {
										?>
											<option value="<?=$value->id ?>"><?=$value->first_name.' '.$value->last_name ?></option>


										<?php
											}


											?>	
									</select>

								<?php
							
						}

				}
				
				
				function getmileHead()
				{


						if ($this->input->get('id')) {
							
							

								$id=$this->input->get('id');
							
							$head=$this->db->select('users')->from('projects')->where('id',$id)->get()->result();
						        
							if(!empty($head) and isset($head))
							{
							    $a1=explode('-',$head[0]->users);
							    
							    //$only=array_merge([43,25,42],$a1);//
							    
								$this->db->select('id,first_name,last_name');
								$this->db->from('users');
							    $this->db->where('created_by',$this->session->userdata('id'));
								$this->db->where_in('id',$a1);
								$this->db->or_where_in('user_role',[43,25,42]);
								$this->db->order_by('user_name','asc');
							$res=$this->db->get();
							$data=$res->result();
						//	var_dump($data);exit();
								$response=['message'=>'Success','status'=>200,'data'=>$data];
								?>

									<select class="form-control" name="users[]" multiple="" id="my">
										<option>Select Please</option>
									<?php
											foreach ($data as $value) {
										?>
											<option value="<?=$value->id ?>"><?=$value->first_name.' '.$value->last_name ?></option>


										<?php
											}


											?>	
									</select>

								<?php
							
						}
							else
							{
							    echo'<option value="">Not Available</option>';
							    return false;
							}
						}
						

				}

									function create_target_audience()
									{
														if($this->session->userdata('user_role')=="Captain")
										{
										$this->view('users/create_audience');

									}//close
									}

									function save_audience()
									{
										$this->form_validation->set_rules('audi_name','Audience Name','trim|required|is_unique[audience.audi_name]');
										$this->form_validation->set_rules('audi_code','Audience Code','trim|required|is_unique[audience.audi_code]|max_length[3]');
										if ($this->form_validation->run()==FALSE) {
											
											$this->view("users/create_audience");
										}
										else
										{
											$arr=[

													"audi_name"=>$this->input->post("audi_name"),
													"audi_code"=>$this->input->post("audi_code"),
													"created_by"=>$this->session->userdata('id')
											];
											$this->db->insert('audience',$arr);
											redirect("users/audience_list/view");
										}
									}

									 function audience_list($action)
									 {

								if($this->session->userdata('user_role')=="Captain")
						{
									 	if (!empty($action)) {
								 	
								 				switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Target Audience View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="Target Audience Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Target Audience Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Content View List";
								 						break;
								 				}
									 	$ares=$this->db->get('audience');
									 	$audidata=$ares->result();
									 	$data['audi_list']=$audidata;
									 	$this->view("users/audience_list",$data);
									 }
									}//close

									 }

									 function edit_audience($aid,$static_view=null)
									 {
									 					if($this->session->userdata('user_role')=="Captain")
						{
									 	if (!empty($static_view)) {
									 		$data['static_view']=$static_view;
									 	}
									 
									 	$this->db->where('aid',$aid);
									 	$res=$this->db->get('audience');
									 	$adata=$res->result();
									 	$data['audidata']=$adata[0];
									 	$this->view('users/edit_audience',$data);
									 		}
									 }


									 			function do_update_audience($aid)
									 			{
									 				$this->form_validation->set_rules('audi_name','Audience Name','trim|required');
										$this->form_validation->set_rules('audi_code','Audience Code','trim|required|max_length[3]');
										if ($this->form_validation->run()==FALSE) {
											
											$this->view("users/create_audience");
										}
										else
										{
											$arr=[

													"audi_name"=>$this->input->post("audi_name"),
													"audi_code"=>$this->input->post("audi_code"),
													"created_by"=>$this->session->userdata('id')
											];
											$this->db->where('aid',$aid);
											$this->db->update('audience',$arr);
											redirect("users/audience_list/view");
										}
									 			}


									 			function delete_audience($aid)
									 			{

									 								if($this->session->userdata('user_role')=="Captain")
						{
									 							$this->db->where('aid',$aid);
									 							$this->db->delete('audience');
									 							redirect('users/audience_list');
									 						}//close
									 			}

									 							
							
							function create_content()
									{

														if($this->session->userdata('user_role')=="Captain")
						{
										$this->view('users/create_content');

									}
									}

									function save_content()
									{
										$this->form_validation->set_rules('content_name','Content Name','trim|required|is_unique[content.content_name]');
										$this->form_validation->set_rules('content_type','Content Type','trim|required|is_unique[content.content_type]');
										$this->form_validation->set_rules('content_code','Content Code','trim|required|is_unique[content.content_code]|max_length[3]');
										if ($this->form_validation->run()==FALSE) {
											
											$this->view("users/create_content");
										}
										else
										{
											$arr=[
													"content_type"=>$this->input->post("content_type"),
													"content_name"=>$this->input->post("content_name"),
													"content_code"=>$this->input->post("content_code"),
													"created_by"=>$this->session->userdata('id')
											];
											$this->db->insert('content',$arr);
											redirect("users/content_list/view");
										}
									}

									 function content_list($action)
									 {

									 								if($this->session->userdata('user_role')=="Captain")
						{

									 		if (!empty($action)) {
								 	
								 				switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Content View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="Content Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Content Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Content View List";
								 						break;
								 				}


									 	$ares=$this->db->get('content');
									 	$contdata=$ares->result();
									 	$data['cont_list']=$contdata;
									 	$this->view("users/content_list",$data);
									 }
									}//close

									 }

									 function edit_content($cont_id,$static_view=0)
									 {
									 					if($this->session->userdata('user_role')=="Captain")
						{
									 	if (!empty($static_view)) {
									 		$data['static_view']=$static_view;
									 	}
									 	
									 	
									 	$this->db->where('cont_id',$cont_id);
									 	$res=$this->db->get('content');
									 	$adata=$res->result();
									 	$data['contentdata']=$adata[0];
									 	$this->view('users/edit_content',$data);

									 }//close
								}


									 			function do_update_content($cont_id)
									 			{
									 				$this->form_validation->set_rules('content_name','Content Name','trim|required');

									 				$this->form_validation->set_rules('content_type','Content Type','trim|required');
										$this->form_validation->set_rules('content_code','Content Code','trim|required|max_length[3]');
										if ($this->form_validation->run()==FALSE) {
											
											$this->view("users/create_content");
										}
										else
										{
											$arr=[

													"content_type"=>$this->input->post("content_type"),

													"content_name"=>$this->input->post("content_name"),
													"content_code"=>$this->input->post("content_code"),
													"created_by"=>$this->session->userdata('id')
											];
											$this->db->where('cont_id',$cont_id);
											$this->db->update('content',$arr);
											redirect("users/content_list");
										}
									 			}


									 			function delete_content($cont_id)
									 		{

									 								if($this->session->userdata('user_role')=="Captain")
												{
									 							$this->db->where('cont_id',$cont_id);
									 							$this->db->delete('content');
									 							redirect('users/content_list');
									 			}//close
									 		}

							function create_channel()
							{

										if($this->session->userdata('user_role')=="Captain")
										{
												$data['heading']="Create Channel";
												$data['action']=base_url('users/channel_do_save');
												$this->view('task/channel/create_channel',$data);
											}
							}

											function channel_do_save()
											{

														$this->form_validation->set_rules('channel_name','Channel Name',"required|trim|is_unique[channel.channel_name]");
														if ($this->form_validation->run()==FALSE) {
															
															$this->view('task/channel/create_channel');
														}
														else

														{
																		$arr=[

																				"channel_name"=>$this->input->post('channel_name'),
																				"created_by"=>$this->session->userdata('id')
																		];
																	$this->db->insert('channel',$arr);
																	redirect('users/channel_list/view');
														}

											}

											function channel_list($action)
											{

												
						if($this->session->userdata('user_role')=="Captain")
						{
												
									 		if (!empty($action)) {
								 	
								 				switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Channel View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="Channel Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Channel Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Channel View List";
								 						break;
								 				}
													$res=$this->db->get('channel');
													$channel=$res->result();
														$data['channel_list']=$channel;
																
																if ($res->num_rows()>0) {
																$this->session->set_flashdata('getchannel','Channel List Available');
																}
																else{
																	$this->session->set_flashdata('failedchannel','Channel Not Available');
																}

														$this->view('task/channel/channel_list',$data);
													
											}

										}//close
									}

										function edit_channel($id)
										{	
							if($this->session->userdata('user_role')=="Captain")
						{	

												$data['action']=base_url('users/do_update_channel').'/'.$id;
												$data['heading']="Edit Channel";
												$this->db->where('id',$id);
												$res=$this->db->get('channel');
												$channel=$res->result();
												$data['channeldata']=$channel[0];

												$this->view('task/channel/create_channel',$data);

										}//close
						}


										function do_update_channel($id)
										{
									$this->form_validation->set_rules('channel_name','Channel Name',"required|trim");
														if ($this->form_validation->run()==FALSE) {
															
															$this->view('task/channel/create_channel');
														}
														else

														{
																		$arr=[

																				"channel_name"=>$this->input->post('channel_name'),
																				"created_by"=>$this->session->userdata('id')
																		];
																		$this->db->where('id',$id);
																	$this->db->update('channel',$arr);
																	redirect('users/channel_list/view');
														}

										}

										function delete_channel($id)
									{
										if($this->session->userdata('user_role')=="Captain")
										{	
											$this->db->where('id',$id);
											$this->db->delete('channel');
											redirect('users/channel_list/delete');

										}//close
									}

										
						

									 			
//avenue CRUD

												function create_avenue()
											{

																if($this->session->userdata('user_role')=="Captain")
										{	
												$data['heading']="Create Avenue";
												$data['action']=base_url('users/avenue_do_save');
																			$data['mode']='add';
													$this->db->order_by('channel_name','asc');
													$res=$this->db->get('channel');

												$data['channel']=$res->result();
												$this->view('users/avenue/create_avenue',$data);
										}
											}

											function avenue_do_save()
											{

														$this->form_validation->set_rules('avenue_name','Avenue Name',"required|trim|is_unique[avenue.avenue_name]");

														$this->form_validation->set_rules('avenue_url','Avenue Url',"required|valid_url");
														$this->form_validation->set_rules('channel','Channel Name',"required|trim");
														if ($this->form_validation->run()==FALSE) {
															$data['heading']="Create Avenue";
												$data['action']=base_url('users/avenue_do_save');

													$this->db->order_by('channel_name','asc');
													$res=$this->db->get('channel');

												$data['channel']=$res->result();
															$this->view('users/avenue/create_avenue',$data);
														}
														else

														{
																		$arr=[

																				"avenue_name"=>$this->input->post('avenue_name'),
																				"avenue_url"=>$this->input->post('avenue_url'),
																				"channel_id"=>$this->input->post('channel'),
																				"created_by"=>$this->session->userdata('id')
																		];
																	$this->db->insert('avenue',$arr);
																	redirect('users/avenue_list/view');
														}

											}

											function avenue_list($action)
											{

													if($this->session->userdata('user_role')=="Captain")
						{	
 	
												
									 		if (!empty($action)) {
								 	
								 				switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Avenue View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="Avenue Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Avenue Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Avenue View List";
								 						break;
								 				}

								 						$this->db->select('avenue.avenue_name,avenue.avenue_url,avenue.id,channel.channel_name');
								 						$this->db->from('avenue');
								 						$this->db->join('channel','channel.id=avenue.channel_id');
													$res=$this->db->get();
													$avenue=$res->result();
														$data['avenue_list']=$avenue;
																
																if ($res->num_rows()>0) {
																$this->session->set_flashdata('getavenue','avenue List Available');
																}
																else{
																	$this->session->set_flashdata('failedavenue','Avenue Not Available');
																}

														$this->view('users/avenue/avenue_list',$data);
														
													
													
													
											}
										}//close

										}

										function edit_avenue($id,$static_view=null)
										{	
													if($this->session->userdata('user_role')=="Captain")
						{	

												$data['action']=base_url('users/do_update_avenue').'/'.$id;
												$data['heading']="Edit Avenue";
												if (!empty($static_view)) {
													$data['static_view']=$static_view;
												}
													$this->db->order_by('channel_name','asc');
													$res=$this->db->get('channel');

												$data['channel']=$res->result();
												$data['mode']='edit';

												$this->db->where('id',$id);
												$res=$this->db->get('avenue');
												$avenue=$res->result();
												$data['avenuedata']=$avenue[0];

												$this->view('users/avenue/create_avenue',$data);

										}//close
									}


										function do_update_avenue($id)
										{
									$this->form_validation->set_rules('avenue_name','Avenue Name',"required|trim");

										$this->form_validation->set_rules('avenue_url','Avenue Url',"required|valid_url");
										$this->form_validation->set_rules('channel','Channel Name',"required|trim");
														if ($this->form_validation->run()==FALSE) {
															$data['heading']="Create Avenue";
												$data['action']=base_url('users/avenue_do_save');

													$this->db->order_by('channel_name','asc');
													$res=$this->db->get('channel');

												$data['channel']=$res->result();
															$this->view('users/avenue/create_avenue',$data);
														}
														else

														{
																		$arr=[

																				"avenue_name"=>$this->input->post('avenue_name'),
																				"avenue_url"=>$this->input->post('avenue_url'),
																				"channel_id"=>$this->input->post('channel')
																			
																		];
																		$this->db->where('id',$id);
																	$this->db->update('avenue',$arr);
																	redirect('users/avenue_list/view');
														}

										}

										function delete_avenue($id)
									{
												if($this->session->userdata('user_role')=="Captain")
										{	
											$this->db->where('id',$id);
											$this->db->delete('avenue');
											redirect('users/avenue_list/delete');
										}//close
									}


										function create_avenue_group()
										{

													if($this->session->userdata('user_role')=="Captain")
						{	
														$data['heading']="Create Avenue Group";
														$data['action']=base_url('users/save_group_avenue');
														$data['mode']="add";



														$this->db->order_by('avenue_name','asc');
														$res=$this->db->get('avenue');
														$data['avenue']=$res->result();
														$this->view('users/avenue_group/create_avenue_group',$data);

										}

										}


										function save_group_avenue()
										{


											$this->form_validation->set_rules('group_name','Avenue Group Name','trim|required|ise_unique[avenue_group.group_name]');
											$this->form_validation->set_rules('avenue_name','Select Avenue Group','required');
											$this->form_validation->set_rules('remarks','Remarks','trim|required');


												if ($this->form_validation->run()==FALSE) {
													
													$data['heading']="Create Avenue Group";
														$data['action']=base_url('users/save_group_avenue');
														$data['mode']="add";



														$this->db->order_by('avenue_name','asc');
														$res=$this->db->get('avenue');
														$data['avenue']=$res->result();
														$this->view('users/avenue_group/create_avenue_group',$data);
												}
												else
												{
													$arr=[

															"group_name"=>$this->input->post('group_name'),
															"remarks"=>$this->input->post('remarks'),
															"created_by"=>$this->session->userdata('id')

													];

													$getavenues=$this->input->post('avenue_name');
													
													$arr['avenue_group']=implode('-',$getavenues);
														$this->session->set_flashdata('addgroup');
													 $this->db->insert('avenue_group',$arr);
													 redirect('users/avenue_group_list/view');
												}

										}


										function avenue_group_list( $action)
										{

												if($this->session->userdata('user_role')=="Captain")
						{	
												if (!empty($action)) {
								 	
								 				switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Avenue View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="Avenue Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Avenue Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Avenue View List";
								 						break;
								 				}


								 				$res=$this->db->get('avenue_group');
								 				$data['avenue_list']=$res->result();
								 				$this->view('users/avenue_group/avenue_group_list',$data);

										}
									}//close
								}


									function edit_group_avenue($gid,$static_view=null)
									{

														if($this->session->userdata('user_role')=="Captain")
						{	
											if (!empty($static_view)) {
												$data['static_view']=$static_view;
											}

												$data['heading']="Edit Avenue Group";
												$data['action']=base_url('users/do_update_avenue_group').'/'.$gid;
												$this->db->where('gid',$gid);
												$res=$this->db->get('avenue_group');
												$val=$res->result();
												$data['avenuedata']=$val[0];
												$ares=$this->db->get('avenue');
												$data['avenue']=$ares->result();


												$this->view('users/avenue_group/edit_avenue_group',$data);

									}//close
								}

									function do_update_avenue_group($gid)
										{
											$this->form_validation->set_rules('group_name','Avenue Group Name','trim|required|ise_unique[avenue_group.group_name]');
											$this->form_validation->set_rules('avenue_name','Select Avenue Group','required');
											$this->form_validation->set_rules('remarks','Remarks','trim|required');


												if ($this->form_validation->run()==FALSE) {
													
												$data['heading']="Edit Avenue Group";
												$data['action']=base_url('users/do_update_avenue_group').'/'.$gid;
												


														$this->db->order_by('avenue_name','asc');
														$res=$this->db->get('avenue');
														$data['avenue']=$res->result();
														$this->view('users/avenue_group/edit_avenue_group',$data);
												}
												else
												{
													$arr=[

															"group_name"=>$this->input->post('group_name'),
															"remarks"=>$this->input->post('remarks'),
															"created_by"=>$this->session->userdata('id')

													];

													$getavenues=$this->input->post('avenue_name');
													
													$arr['avenue_group']=implode('-',$getavenues);
														$this->session->set_flashdata('addgroup');
													 	$this->db->where('gid',$gid);
													 $this->db->update('avenue_group',$arr);
													 redirect('users/avenue_group_list/edit');
												}

										}

										function delete_group_avenue($id)
										{

												if($this->session->userdata('user_role')=="Captain")
											{	
												if (!empty($id)) {
													$this->db->where('gid',$id);
													$this->db->delete('avenue_group');
													redirect('users/avenue_group_list/delete');
											}
										}//close

									}


										function settest()
										{
											// Declare an array 
$sides = array(1,2,3,4); 
$data= array();
// Use foreach loop to display the 
// elements of array 
foreach($sides as $index => $value) { 
			echo $data['gid']= $value; 
			$this->db->insert('avenue_groupid',$data);
} 
										}

											
								 
					function create_response_type()
					{

							if($this->session->userdata('user_role')=="Captain")
						{	
						$data['heading']="Create Response Type";
						$data['action']=base_url('users/save_response_type');
						$data['mode']="add";
						$this->view('users/response_type/create_response_type',$data);
						//echo "string";

					}//close

					}    





										function save_response_type()
										{
											$this->form_validation->set_rules('type_name','Response Type Name','trim|required|ise_unique[response_type.type_name]');
										


												if ($this->form_validation->run()==FALSE) {
													
													$data['heading']="Create Response Type";
														$data['action']=base_url('users/save_response_type');
														$data['mode']="add";;
														$this->view('users/response_type/create_response_type',$data);
												}
												else
												{
													$arr=[

															"type_name"=>$this->input->post('type_name'),
															"created_by"=>$this->session->userdata('id')

													];

													
														$this->session->set_flashdata('addtype');
													 $this->db->insert('response_type',$arr);
													 redirect('users/response_type_list/view');
												}

										}


										function response_type_list( $action)
										{

												if($this->session->userdata('user_role')=="Captain")
						{	
												if (!empty($action)) {
								 	
								 				switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Response View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="Response Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Response Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Response View List";
								 						break;
								 				}


								 				$res=$this->db->get('response_type');
								 				$data['responsetype_list']=$res->result();
								 				$this->view('users/response_type/response_type_list',$data);

										}
									}//close
							}


									function edit_response_type($id,$static_view=null)
									{
														if($this->session->userdata('user_role')=="Captain")
						{	

											if (!empty($static_view)) {
												$data['static_view']=$static_view;
											}

												$data['heading']="Edit Response Type";
												$data['action']=base_url('users/do_update_response_type').'/'.$id;
												$this->db->where('id',$id);
												$res=$this->db->get('response_type');
												$val=$res->result();
												$data['response_typedata']=$val[0];
												$ares=$this->db->get('response_type');
												$data['response']=$ares->result();


												$this->view('users/response_type/create_response_type',$data);

									}//close
								}

									function do_update_response_type($id)
										{
											$this->form_validation->set_rules('type_name','Response Type Name','trim|required');
											


												if ($this->form_validation->run()==FALSE) {
													
												$data['heading']="Edit Response Type";
												$data['action']=base_url('users/do_update_response_type').'/'.$id;
												$data['mode']='edit';
												


														$this->db->order_by('type_name','asc');
														$res=$this->db->get('response_type');
														$data['response_typedata']=$res->result();
														$this->view('users/response_type/create_response_type',$data);
												}
												else
												{
													$arr=[

															"type_name"=>$this->input->post('type_name')


													];

														$this->session->set_flashdata('addtype');
													 	$this->db->where('id',$id);
													 $this->db->update('response_type',$arr);
													 redirect('users/response_type_list/edit');
												}

										}
			

										function delete_response_type($id)
										{
															if($this->session->userdata('user_role')=="Captain")
												{	

												if (!empty($id)) {
													$this->db->where('id',$id);
													$this->db->delete('response_type');
													redirect('users/response_type_list/delete');
												}

											}
										}





												function add_replies()
											{
													if($this->session->userdata('user_role')=="Captain")
						{	

												$data['heading']="Create Replies";
												$data['action']=base_url('users/replies_do_save');
																			$data['mode']='add';
													$this->db->order_by('type_name','asc');
													$res=$this->db->get('response_type');

												$data['response_type']=$res->result();
												$this->view('users/response_replies/add_replies',$data);
											}

								}

											function replies_do_save()
											{

														$this->form_validation->set_rules('replies','Replies',"required|trim");

														
														$this->form_validation->set_rules('response_type','Response Type',"required|trim");
														if ($this->form_validation->run()==FALSE) {
															$data['heading']="Create Replies";
												$data['action']=base_url('users/replies_do_save');

													$this->db->order_by('type_name','asc');
													$res=$this->db->get('response_type');

												$data['response_type']=$res->result();
															$this->view('users/response_replies/add_replies',$data);
														}
														else

														{
																		$arr=[

																				"replies"=>$this->input->post('replies_name'),
																
																				"reply_type"=>$this->input->post('response_type'),
																				"created_by"=>$this->session->userdata('id')
																		];
																	$this->db->insert('replies',$arr);
																	redirect('users/replies_list/view');
														}

											}
											function replies_list($action)
											{

												
 														if($this->session->userdata('user_role')=="Captain")
						{	
												
									 		if (!empty($action)) {
								 	
								 				switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Replies View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="Replies Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Replies Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Replies View List";
								 						break;
								 				}

								 						$this->db->select('replies.replies,,replies.id,response_type.type_name');
								 						$this->db->from('replies');
								 						$this->db->join('response_type','response_type.id=replies.reply_type');
													$res=$this->db->get();
													$replies=$res->result();
														$data['replies_list']=$replies;
																
																if ($res->num_rows()>0) {
																$this->session->set_flashdata('getreplies','replies List Available');
																}
																else{
																	$this->session->set_flashdata('failedreplies','Replies Not Available');
																}

														$this->view('users/response_replies/replies_list',$data);
														
													
													
													
											}

										}//close

									}

										function edit_replies($id,$static_view=null)
										{	

									if($this->session->userdata('user_role')=="Captain")
						{	

												$data['action']=base_url('users/do_update_replies').'/'.$id;
												$data['heading']="Edit Replies";
												if (!empty($static_view)) {
													$data['static_view']=$static_view;
												}
													$this->db->order_by('type_name','asc');
													$res=$this->db->get('response_type');

												$data['response_type']=$res->result();
												$data['mode']='edit';

												$this->db->where('id',$id);
												$res=$this->db->get('replies');
												$replies=$res->result();
												$data['repliesdata']=$replies[0];

												$this->view('users/response_replies/add_replies',$data);

										}//close

							}


										function do_update_replies($id)
										{
									$this->form_validation->set_rules('replies','Replies',"required|trim");

														
														$this->form_validation->set_rules('response_type','Response Type',"required|trim");
														if ($this->form_validation->run()==FALSE) {
															$data['heading']="Edit Replies";
												$data['action']=base_url('users/replies_do_save');

													$this->db->order_by('type_name','asc');
													$res=$this->db->get('response_type');
													$data['mode']='edit';

												$data['response_type']=$res->result();
															$this->view('users/response_replies/add_replies',$data);
														}
														else

														{
																		$arr=[

																				"replies"=>$this->input->post('replies'),
																			
																				"reply_type"=>$this->input->post('response_type')
																			
																		];
																		$this->db->where('id',$id);
																	$this->db->update('replies',$arr);
																	redirect('users/replies_list/view');
														}

										}

										function delete_replies($id)
										{
									if($this->session->userdata('user_role')=="Captain")
								{
											$this->db->where('id',$id);
											$this->db->delete('replies');
											redirect('users/replies_list/delete');

									}//close
										}
										
									
									function add_country()
                        {
                              $this->view('dashboard/add_country');
                        }

                        function do_save_country()
                        {

                              $this->form_validation->set_rules('c_name','Country Name','required|trim|is_unique[country.country]');
                              $this->form_validation->set_rules('c_code','Country Code','required|trim|is_unique[country.code]');


                              if ($this->form_validation->run()==false)
                               {
                                    
                                    $this->view('dashboard/add_country');
                              }
                              else
                              {
                              			if($this->users_model->save_country())
                              			{
                              			
                              				redirect('users/view_countries/view');
                              			}
                              			
                              }      
                        }



                        function view_countries($action)
                        {
                        	switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Country View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="Country Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Country Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Replies View List";
								 						break;
								 				}
                        	$data['country_list']=$this->users_model->get_countries();
                        		$this->view('dashboard/countries_list',$data);
                        }



                        public function edit_country($id)
                   {

                        		if (!empty($id)) {
                        			
               $clist=$this->users_model->edit_country_ByID($id);
               $data['country']=$clist[0];
               	$this->view('dashboard/edit_country',$data);
                        		}
                        }


                        public function do_update_country($id)
                        {
                        		 $this->form_validation->set_rules('c_name','Country Name','required|trim');
                              $this->form_validation->set_rules('c_code','Country Code','required|trim');


                              if ($this->form_validation->run()==false) {
                                    
                                    $this->view('dashboard/add_country');
                              }
                              else
                              {
                              			if($this->users_model->update_country($id))
                              			{
                              			
                              				redirect('users/view_countries/view');
                              			}
                              			
                              }      
                        }


                         function delete_country($id)
                        {
                        	

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/destroy_country',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id' =>$id),
));

$response = curl_exec($curl);
$result=json_decode($response);
//var_dump($result);
curl_close($curl);
		if ($result->status) {
			$this->db->where('id',$id);
                        	$this->db->delete('country');
                        	
		}

							
		redirect('users/view_countries/delete');
                        	
                        }

                        	function add_state()
                        	{		$data['country']=$this->users_model->get_countries();
                        			$this->view('dashboard/add_state',$data);	
                        	}
                        		 function do_save_state()
                        {

                              $this->form_validation->set_rules('state_name','State Name','required|trim|is_unique[state.state]');
                              $this->form_validation->set_rules('c_id','Country Name','required|trim');


                              if ($this->form_validation->run()==false)
                               {
                                    
                                    $data['country']=$this->users_model->get_countries();
                                    $this->view('dashboard/add_state');
                              }
                              else
                              {
                              			if($this->users_model->save_state())
                              			{
                              			
                              				redirect('users/state_list/view');
                              			}
                              			
                              }      
                        }


                        			function edit_state($id)
                        			{
                        				$data['state_data']=$this->users_model->get_state_ById($id);
                        				$data['country']=$this->users_model->get_countries();
                        				var_dump($data['state_data']);
                        				$this->view('dashboard/edit_state',$data);
                        			}

                        			

                        			function do_update_state($id)
                        			{
                        				 $this->form_validation->set_rules('state_name','State Name','required|trim');
                              $this->form_validation->set_rules('c_id','Country Name','required|trim');


                              if ($this->form_validation->run()==false)
                               {
                                    
                                    $data['country']=$this->users_model->get_countries();
                                    $this->view('dashboard/edit_state');
                              }
                              else
                              {
                              			if($this->users_model->update_state($id))
                              			{
                              			
                              				redirect('users/state_list/edit');
                              			}
                              			
                              }		
                        			}	


                        public function state_list($action)
                        {
                        	switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="State View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="State Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="State Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="State View List";
								 						break;
								 				}
						/**
						*we are sendind country to choose to get according state
						*
						*
						**/
						$data['country']=$this->users_model->get_countries();
                        	
                        	$this->view('dashboard/state_list',$data);

                        }

                        public function delete_state($id)
                        {
                        	if ($this->users_model->delete_state($id)) {
                        		
                        		redirect('users/state_list/delete');
                        	}
                        }

                        function get_stateByCountryId()
                        {
                        	if ($id=$this->input->get('country')) {
                        		
                        		$state=$this->users_model->get_state_CountryId($id);

                        			echo "<option value=''>Select State</option>";
                        			if(!empty($state))
                        			{
                        		foreach ($state as $value) {
                        		
                        	
                        			?>

                        			<option value="<?= $value->id ?>"><?= $value->state ?></option>

                        			<?php

                        		}
                        	}
                        	else
                        	{
                        		echo "<option>State Not Available</option>";
                        	}
                        	}
                        }
                        
                        function get_czByCity()
                        {
                        	if ($id=$this->input->get('cid')) {
                        		
                        		$cityzone=$this->db->select('id,city_zone')->where('city_id',$id)->order_by('city_zone','ASC')->from('city_zone')->get()->result();

                        			echo "<option value=''>Select City Zone</option>";
                        			if(!empty($cityzone))
                        			{
                        		foreach ($cityzone as $value) {
                        		
                        	
                        			?>

                        			<option value="<?= $value->id ?>"><?= $value->city_zone ?></option>

                        			<?php

                        		}
                        	}
                        	else
                        	{
                        		echo "<option>City Zone Not Available</option>";
                        	}
                        	}
                        }

                        function stateEasyNavigation()
                        {
                        	if ($cid=$this->input->get('cid')) {
                        			


                        		$view_as=$this->input->get('action');
                        		$state_list=$this->users_model->get_stateByCid($cid);

                        		if(empty($state_list))
                        		{
                        			echo "<tr><td colspan='5'><div class='alert alert-danger'>States are not available</div></td></tr>";
                        		}
                        				?>

                        						<tr class="odd gradeA">
                        		
									<?php
										$sr=1;
										foreach($state_list as $data) {
													
													?>

										<tr>
										<td><?=$sr ?></td>
										<td><?= $data->state ?></td>
										<td><?=  $data->country ?></td>
									<td>

											<?php

														switch ($view_as) {
															case 'edit_list':
																?>
																<a href="<?= base_url().'users/edit_state/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >Edit</a>
																<?php
																break;
																case 'delete_list':
																?>
																<a href="<?= base_url().'users/delete_state/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;"  onclick="return confirm('Are you sure to delete this ?')" >Delete</a>
																<?php
																break;
																case 'view_list':
																?>
																<a href="<?= base_url().'users/view_state/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >View</a>
																<?php
																break;
														
														}



											?>




									</td>
																</tr>

													<?php
													$sr++;
												}


									?>
								</tr>

                        				<?php


                        	}
                        }







                         function DistrictEasyNavigation()
                        {
                        	if ($cid=$this->input->get('cid')) {
                        			

                        		$sid=$this->input->get('sid');
                        		$view_as=$this->input->get('action');
                        		
                        		$district_list=$this->users_model->get_District($cid,$sid);

                        		if(empty($district_list))
                        		{
                        			echo "<tr><td colspan='5'><div class='alert alert-danger'>District are not available</div></td></tr>";
                        		}
                        				?>
											<tr class="odd gradeA">
									<?php
										$sr=1;
										foreach($district_list as $data) {
													
													?>

										<tr>
										<td><?=$sr ?></td>
										<th><?=  $data->district_name ?></th>
										<td><?= $data->state ?></td>
										<td><?=  $data->country ?></td>
									<td>

											<?php

														switch ($view_as) {
															case 'edit_list':
																?>
																<a href="<?= base_url().'users/edit_district/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >Edit</a>
																<?php
																break;
																case 'delete_list':
																?>
																<a href="<?= base_url().'users/delete_district/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;"  onclick="return confirm('Are you sure to delete this ?')" >Delete</a>
																<?php
																break;
																case 'view_list':
																?>
																<a href="<?= base_url().'users/view_district/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >View</a>
																<?php
																break;
														
														}



											?>




									</td>
																</tr>

													<?php
													$sr++;
												}


									?>
								</tr>

                        				<?php


                        	}
                        }
                        		/**
                        		*@param cid int country id
                        		*@param sid int state id
                        		*@param did int district id
                        		**/

                          function cityEasyNavigation()
                        {
                        	if ($did=$this->input->get('did')) {
                        			

                        		
                        		$view_as=$this->input->get('action');
                        		
                        		$city_list=$this->users_model->get_city($did);

                        		if(empty($city_list))
                        		{
                        			echo "<tr><td colspan='5'><div class='alert alert-danger'>City are not available</div></td></tr>";
                        		}
                        				?>
												<tr class="odd gradeA">
									<?php
										$sr=1;
											foreach($city_list as $data) {
													
													?>

										<tr>
										<td><?=$sr ?></td>
										<td><?= $data->city ?></td>
										<td><?=  $data->district_name ?></td>
										<td><?= $data->state ?></td>
										<td><?=  $data->country ?></td>
									<td>

											<?php

														switch ($view_as) {
															case 'edit_list':
																?>
																<a href="<?= base_url().'users/edit_city/'.$data->city_id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >Edit</a>
																<?php
																break;
																case 'delete_list':
																?>
																<a href="<?= base_url().'users/delete_city/'.$data->city_id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;"  onclick="return confirm('Are you sure to delete this ?')" >Delete</a>
																<?php
																break;
																case 'view_list':
																?>
																<a href="<?= base_url().'users/view_city/'.$data->city_id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >View</a>
																<?php
																break;
																default:
																?>
																<a href="<?= base_url().'users/view_city/'.$data->city_id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >View</a>
																<?php
														
														}



											?>




									</td>
																</tr>

													<?php
													$sr++;
												}


									?>
								</tr>

                        				<?php


                        	}
                        }


                         function pincodeEasyNavigation()
                        {
                        	if ($city_id=$this->input->get('city_id')) {
                        			

                        		
                        		$view_as=$this->input->get('action');
                        		
                        		$pincode_list=$this->users_model->get_pincodes($city_id);

                        		if(empty($pincode_list))
                        		{
                        			echo "<tr><td colspan='7'><div class='alert alert-danger'>Pincodes are not available</div></td></tr>";
                        		}
                        				?>
											<tr class="odd gradeA">
									<?php
										$sr=1;
											foreach($pincode_list as $data) {
													
													?>

										<tr>
										<td><?=$sr ?></td>
										<td><?= $data->pincode ?></td>
										<td><?= $data->city ?></td>
										<td><?=  $data->district_name ?></td>
										<td><?= $data->state ?></td>
										<td><?=  $data->country ?></td>
									<td>

											<?php

														switch ($view_as) {
															case 'edit_list':
																?>
																<a href="<?= base_url().'users/edit_pincode/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >Edit</a>
																<?php
																break;
																case 'delete_list':
																?>
																<a href="<?= base_url().'users/delete_pincode/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;"  onclick="return confirm('Are you sure to delete this ?')" >Delete</a>
																<?php
																break;
																case 'view_list':
																?>
																<a href="<?= base_url().'users/view_pincode/'.$data->id ?>/static_view"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >View</a>
																<?php
																break;
														
														}



											?>




									</td>
																</tr>

													<?php
													$sr++;
												}


									?>
								</tr>

                        				<?php


                        	}
                        }

                        public function add_district()
                        {
                        	$data['country']=$this->users_model->get_countries();
                        	$this->view('dashboard/add_district',$data);
                        }

                        function do_save_district()
                        {
                        	$this->form_validation->set_rules('country','Country','required|trim');
                        	$this->form_validation->set_rules('state','State','required|trim');
                        	$this->form_validation->set_rules('district_name','District Name','required|trim|is_unique[district.district_name]');
                        	if ($this->form_validation->run()==false) {
                        		
							$data['country']=$this->users_model->get_countries();
                        	$this->view('dashboard/add_district',$data);
                        	}
                        	else
                        	{
                        		$this->users_model->save_district();
                        		redirect('users/district_list/view');
                        	}
                        }

                        			function edit_district($id)
                        			{
                        							$data['country']=$this->users_model->get_countries();
                        							$data['state']=$this->users_model->get_state();                  
                        							$data['district']=$this->users_model->get_district_ById($id);

                        					$this->view('dashboard/edit_district',$data);

                        			}

                        			 function do_update_district($id)
                        {
                        	$this->form_validation->set_rules('country','Country','required|trim');
                        	$this->form_validation->set_rules('state','State','required|trim');
                        	$this->form_validation->set_rules('district_name','District Name','required|trim');
                        	if ($this->form_validation->run()==false) {
                        		
							$data['country']=$this->users_model->get_countries();
                        	$this->view('dashboard/edit_district',$data);
                        	}
                        	else
                        	{
                        		$this->users_model->update_district($id);
                        		redirect('users/district_list/view');
                        	}
                        }

                         public function district_list($action)
                        {
                        	switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="District View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="District Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="District Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="District View List";
								 						break;
								 				}
                        	$data['country']=$this->users_model->get_country_api();
                        	//var_dump($data['district_list']);
                        $this->view('dashboard/district_list',$data);

                        }


                        function delete_district($id)
                        {
                        	if($this->users_model->delete_district_byId($id))
                        	{
                        		return redirect('users/district_list/delete');
                        	}

                        }
                        		function get_districtByStateId()
                        		{
                        			if ($id=$this->input->get('state')) {
                        				
                        				$district=$this->users_model->set_districtByStateId($id);
                        				if(!empty($district))
                        			{
                        				echo "<option value=''>Select District</option>";
                        		foreach ($district as $value) {
                        		
                        	
                        			?>

                        			<option value="<?= $value->id ?>"><?= $value->district_name ?></option>

                        			<?php

                        		}
                        	}
                        	else
                        	{
                        		echo "<option value=''>District Not Available</option>";
                        	}
                        			}
                        		}

                        		function add_city()
                        		{
                        			$data['country']=$this->users_model->get_countries();
                        			$this->view('dashboard/add_city',$data);
                        		}
                                    
                                    function get_pinsByCity()
                                    {
                                        if($cid=$this->input->get('cid'))
                                        {
                                            $pincode=$this->user_classification_model->get_pins($cid);
                                                if($pincode)
                                                {
                                                foreach($pincode as $value)
                                                {
                                            ?>
                                                    <option value="<?= $value->pincode ?>"><?= $value->pincode ?></option>
                                            <?php
                                                }
                                                }
                                                else
                                                {
                                                    echo"<option>Pincode Not available</option>";
                                                }
                                        }
                                    }
                                    
                                    function pincode_minus()
                                    {
            $this->db->where('zone_pincode.pincode NOT IN (select pincode.pincode from pincode where zone_pincode.city_id=13)');
            $res=$this->db->get();
            var_dump($res);
                                    }
                                    
                                    
                            	function add_city_zone()
                        		{
                        			$data['country']=$this->users_model->get_countries();
                        		//	$data['pincodes']=$this->users_model->get_pincodes();
                        			$this->view('dashboard/zone/add_city_zone',$data);
                        		}
                        		
                        		
                        		        function do_save_city_zone()
                        		{
                        				$this->form_validation->set_rules('country','Country','required|trim');
                        				$this->form_validation->set_rules('state','State','required|trim');
                        				$this->form_validation->set_rules('district','District','required|trim');
                        				$this->form_validation->set_rules('city','City','required|trim');
                        	$this->form_validation->set_rules('pincode[]','Pincode','required');
                        	
                        	$this->form_validation->set_rules('city_zone','City Zone','required');
                        	
                        	if ($this->form_validation->run()==false) {
                        		
                        			 $data['country']=$this->users_model->get_countries();
                        			$this->view('dashboard/zone/add_city_zone',$data);
                        	}
                        	else
                        	{
                        	   // var_dump($_POST);
                        		//$this->users_model->save_city_zone();
                        		//	redirect('users/pincode_list/view');
                        		
                        		
                        	

                                    $id=$this->user_classification_model->getIdExsitPlusOne('id','city_zone');
                                                 // echo "id is".$id;
						 		 	$arr=[
						 		 		"id"=>$id,	
						 		 		"country_id"=>$this->input->post('country'),
						 		 		"state_id"=>$this->input->post('state'),
						 		 		"district_id"=>$this->input->post('district'),
						 		 		"city_id"=>$this->input->post('city'),
						 		 		
						 		 		"created_by"=>$this->session->userdata('id'),
						 		 		"city_zone"=>$this->input->post('city_zone'),
						 		 		"pincodes"=>implode(',',$this->input->post('pincode'))
						 		 	];
                                      $this->db->insert('city_zone',$arr);
                                      $pincodes=$this->input->post('pincode');
                                      /*foreach($pincodes as $value)
                                      {
                                         $this->db->insert('zone_pincode',["cz_id"=>$id,"pincode"=>$value]);
                                      }*/
                                     // var_dump($arr);
                                     redirect('users/cityzonelist/edit_list');

                        		}
                        		}
                        		
                        		function get_city_zones()
                        		{
                        		    $this->db->select('city_zone.city_zone,city.city,district.district_name,state.state,zone_pincode.pincode');
                        		    $this->db->from('city_zone');
                        		    $this->db->join('city','city.id=city_zone.city_id');
                        		    $this->db->join('state','state.id=city_zone.state_id');
                        		    $this->db->join('district','district.id=city_zone.district_id');
                        		    $this->db->join('zone_pincode','zone_pincode.cz_id=city_zone.id');
                        		    $res=$this->db->get();
                        		    var_dump($res->result());
                        		}
                        		
                        		
                        		        function cityzonelist($action)
                        		        {
                        		            $data['view_as']=$action;
                        		            $data['country']=$this->users_model->get_countries();
                        		            $this->view('dashboard/city_zone_list',$data);
                        		            
                        		        }
                        		
                        		
                        		                        function CityZoneEasyNavigation()
                        {
                        	if ($cid=$this->input->get('cid')) {
                        			

                        
                        		$view_as=$this->input->get('action');
                        		
                        		$city_zone_list=$this->users_model->get_city_zones($cid);
                                    
                        		if(empty($city_zone_list))
                        		{
                        			echo "<tr><td colspan='5'><div class='alert alert-danger'>City Zone are not available</div></td></tr>";
                        		}
                        		else
                        		{
                        				?>
											<tr class="odd gradeA">
									<?php
										$sr=1;
										foreach($city_zone_list as $data) {
													
													?>

										<tr>
										<td><?=$sr ?></td>
										<th><?=  $data->city_zone ?></th>
										<td><?= $data->city ?></td>
										<td><?=  $data->district_name ?></td>
										<td><?= $data->state ?></td>
									
									<td>

											<?php

														switch ($view_as) {
															case 'edit_list':
																?>
																<a href="<?= base_url().'users/edit_city_zone/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >Edit</a>
																<?php
																break;
																case 'delete_list':
																?>
																<a href="<?= base_url().'users/delete_city_zone/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;"  onclick="return confirm('Are you sure to delete this ?')" >Delete</a>
																<?php
																break;
																case 'view_list':
																?>
																<a href="<?= base_url().'users/single_view_city_zone/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >View</a>
																<?php
																break;
																default:
																    ?>
																<a href="<?= base_url().'users/single_view_city_zone/'.$data->id ?>"   class="btn-sm btn-info" style="color:white;background-color:#323200;border-color:#323200;" >View</a>
																<?php
																    
														}
														$sr++;
										}



											?>




									</td>
																</tr>

													<?php
													
												}


									?>
								</tr>

                        				<?php


                        	}
                        }
                        		
                        		function edit_city_zone($id)
                        		{
                        		    $data['zone_data']=$this->db->where('id',$id)->get('city_zone')->result();
                        		    $data['country']=$this->users_model->get_countries();
                        			$data['state']=$this->users_model->get_state();
                        			$data['district']=$this->users_model->get_districts();
                        			$data['city']=$this->users_model->get_city();
                        			$pin=$this->db->select('pincodes')->from('city_zone')->where('id',$id)->get()->result();
                        		          $data['pins']=explode(",",$pin[0]->pincodes);
                        		    //var_dump($pin);
                        		    $this->view('dashboard/zone/edit',$data);
                        		}
                        		
                        		
                        			function single_view_city_zone($id)
                        		{
                        		    $data['zone_data']=$this->db->where('id',$id)->get('city_zone')->result();
                        		    $data['country']=$this->users_model->get_countries();
                        			$data['state']=$this->users_model->get_state();
                        			$data['district']=$this->users_model->get_districts();
                        			$data['city']=$this->users_model->get_city();
                        			$pin=$this->db->select('pincodes')->from('city_zone')->where('id',$id)->get()->result();
                        		          $data['pins']=explode(",",$pin[0]->pincodes);
                        		    //var_dump($pin);
                        		    $this->view('dashboard/zone/view',$data);
                        		}
                        		
                        		
                        		
                        		 function do_update_city_zone($id)
                        		{
                        				$this->form_validation->set_rules('country','Country','required|trim');
                        				$this->form_validation->set_rules('state','State','required|trim');
                        				$this->form_validation->set_rules('district','District','required|trim');
                        				$this->form_validation->set_rules('city','City','required|trim');
                        	//$this->form_validation->set_rules('pincode[]','Pincode','required');
                        	
                        	$this->form_validation->set_rules('city_zone','City Zone','required');
                        	
                        	if ($this->form_validation->run()==false) {
                        		          $data['zone_data']=$this->db->where('id',$id)->get('city_zone')->result();
                        		          $data['pins']=$this->db->select('pincode')->where('cz_id',$id)->from('zone_pincode')->get()->result();
                        			 $data['country']=$this->users_model->get_countries();
                        			$this->view('dashboard/zone/edit',$data);
                        	}
                        	else
                        	{
                        	   // var_dump($_POST);
                        		//$this->users_model->save_city_zone();
                        		//	redirect('users/pincode_list/view');
                        		
                        		
                        	

                                    //$id=$this->input->post('id');
                                                 // echo "id is".$id;
						 		 	$arr=[
						 		 		
						 		 		"country_id"=>$this->input->post('country'),
						 		 		"state_id"=>$this->input->post('state'),
						 		 		"district_id"=>$this->input->post('district'),
						 		 		"city_id"=>$this->input->post('city'),
						 		 		
						 		 		"created_by"=>$this->session->userdata('id'),
						 		 		"city_zone"=>$this->input->post('city_zone'),
						 		 		"pincodes"=>implode(',',$this->input->post('pincode'))
						 		 	];
                                      $this->db->where('id',$id)->update('city_zone',$arr);
                                      $pincodes=$this->input->post('pincode');
                                      
                                      /*foreach($pincodes as $value)
                                      {
                                          
                                         $this->db->where('cz_id',$id)->where('pincode',$value)->update('zone_pincode',["cz_id"=>$id,"pincode"=>$value]);
                                      }*/
                                      //var_dump($arr); 
                                     //var_dump($pincodes);
                                      redirect('users/city_zone_list/edit_list');

                        		}
                        		}
                        		
                        		
                        		        function delete_city_zone($id)
                        		        {
                        		            
                        		            if($this->db->where('id',$id)->delete('city_zone'))
                        		            {
                        		                redirect('users/city_zone_list/delete_list');
                        		            }
                        		            
                        		        }
                        		
                        		function do_save_city()
                        		{
                        			$this->form_validation->set_rules('country','Country','required|trim');
                        			$this->form_validation->set_rules('state','State','required|trim');
                        			$this->form_validation->set_rules('city','City','required|trim');
                        			$this->form_validation->set_rules('district','District','required|trim');
                        			$this->form_validation->set_rules('cz','City Zone','required|trim');
                        			if($this->form_validation->run()==false) {
                        				
                        				$data['country']=$this->users_model->get_countries();
                        				$this->view('dashboard/add_city',$data);
                        			}
                        			else
                        			{
                        				$this->users_model->save_city();
                        				redirect('users/city_list/view');
                        			}
                        		}

                        		function city_list($action)
                        		{
                        			$data['country']=$this->users_model->get_country_api();
                        			switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="City View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="City Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="City Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="City View List";
								 						break;
								 				}
                        			$this->view('dashboard/city_list',$data);
                        		}


                        		function edit_city($id)
                        		{
                        			$data['country']=$this->users_model->get_countries();
                        			$data['state']=$this->users_model->get_state();
                        			$data['district']=$this->users_model->get_district();
                        			if($city=$this->users_model->get_city_ById($id))
                        			{
                        			$data['city']=$city;
                        			//var_dump($data);
                        			$this->view('dashboard/edit_city',$data);
                        		}
                        		
                        		else
                        		{
 
                        				$this->view('common/error_404');
                        		}


                        		}


                        		function do_update_city($id)
                        		{
                        			$this->form_validation->set_rules('country','Country','required|trim');
                        			$this->form_validation->set_rules('state','State','required|trim');
                        			$this->form_validation->set_rules('city','City','required|trim');
                        			$this->form_validation->set_rules('district','District','required|trim');
                        			$this->form_validation->set_rules('cz','City Zone','required|trim');
                        			if($this->form_validation->run()==false) {
                        				
                        				$data['country']=$this->users_model->get_countries();
                        				$this->view('dashboard/add_city',$data);
                        			}
                        			else
                        			{
                        				$this->users_model->update_city($id);
                        				redirect('users/city_list/view');
                        			}
                        		}


                        		function delete_city($id)
                        		{
                        			if($this->users_model->del_city($id))
                        			{
                        				redirect('users/city_list/delete');
                        			}

                        		}
                        		function get_cityByDistrict()
                        		{
                        			if ($id=$this->input->get('dist')) {
                        				
                        				$data=$this->users_model->get_dist_ById($id);

                        						if($data)
                        			{
                        				echo "<option value=''>Select City</option>";
                        		foreach ($data as $value) {
                        		
                        	
                        			?>

                        			<option value="<?= $value->id ?>"><?= $value->city ?></option>

                        			<?php

                        		}
                        	}
                        	else
                        	{
                        		echo "<option value=''>City Not Available</option>";
                        	}
                        			}
                        		}
                        	
                        		function add_pincode()
                        		{
                        			$data['country']=$this->users_model->get_countries();
                        			$this->view('dashboard/add_pincode',$data);
                        		}

                        		function do_save_pincode()
                        		{
                        				$this->form_validation->set_rules('country','Country','required|trim');
                        				$this->form_validation->set_rules('state','State','required|trim');
                        				$this->form_validation->set_rules('district','District','required|trim');
                        				$this->form_validation->set_rules('city','City','required|trim');
                        	$this->form_validation->set_rules('pincode','Pincode','required|trim');
                        	if ($this->form_validation->run()==false) {
                        		
                        			 $data['country']=$this->users_model->get_countries();
                        			$this->view('dashboard/add_pincode',$data);
                        	}
                        	else
                        	{
                        			$this->users_model->save_pincode();
                        			redirect('users/pincode_list/view');
                        	}

                        		}

                        			function pincode_list($action)
                        			{
                        				switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Pincode View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="Pincode Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Pincode Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Pincode View List";
								 						break;
								 				}
                        					$data['country']=$this->users_model->get_countries();

                        					$this->view('dashboard/pincode_list',$data);
                        			}

                        		function edit_pincode($id)
                        		{


                        			$data['country']=$this->users_model->get_countries();
                        			$data['state']=$this->users_model->get_state();
                        			$data['district']=$this->users_model->get_districts();
                        			$data['city']=$this->users_model->get_city();
                        			if($pincode=$this->users_model->pincode_byId($id))
                        			
                        			{
                        				$data['pincode']=$pincode;
                        			$this->view('dashboard/edit_pincode',$data);
                        		}

                        		else
                        		{
 
                        				$this->view('common/error_404');
                        		}
                        		}


                        		function single_view_pincode($id)
                        		{

                        			
                        			
                        			$data['country']=$this->users_model->get_countries();
                        			$data['state']=$this->users_model->get_state();
                        			$data['district']=$this->users_model->get_district();
                        			$data['city']=$this->users_model->get_city();
                        	
                        		if($pincode=$this->users_model->pincode_byId($id))
                        			{

                        			$data['pincode']=$pincode;
                        			$this->view('dashboard/single_view_pincode',$data);
                        		}
                        	
                        		else
                        		{
 
                        				$this->view('common/error_404');
                        		}

                        		}

                        		function do_update_pincode($id)
                        		{
                        				$this->form_validation->set_rules('country','Country','required|trim');
                        				$this->form_validation->set_rules('state','State','required|trim');
                        				$this->form_validation->set_rules('district','District','required|trim');
                        				$this->form_validation->set_rules('city','City','required|trim');
                        	$this->form_validation->set_rules('pincode','Pincode','required|trim');
                        	if ($this->form_validation->run()==false) {
                        		
                        			 $data['country']=$this->users_model->get_countries();
                        			$this->view('dashboard/edit_pincode',$data);
                        	}
                        	else
                        	{
                        			$this->users_model->update_pincode($id);
                        			redirect('users/pincode_list/view');
                        	}

                        		}	
                        		
                        		
                        		
                        		//Single View
                        		
              public function view_country($id)
                   {

                        		if (!empty($id)) {
                        			
               $clist=$this->users_model->edit_country_ByID($id);
               $data['country']=$clist[0];
               	$this->view('dashboard/view_country',$data);
                        		}
                        }
                        
                        
                        			function view_state($id)
                        			{
                        				$data['state_data']=$this->users_model->get_state_ById($id);
                        				$data['country']=$this->users_model->get_countries();
                        				var_dump($data['state_data']);
                        				$this->view('dashboard/view_state',$data);
                        			}
                function view_district($id)
                        			{
                        							$data['country']=$this->users_model->get_countries();
                        							$data['state']=$this->users_model->get_state();                  
                        							$data['district']=$this->users_model->get_district_ById($id);

                        					$this->view('dashboard/view_district',$data);

                        			}
                        			
                        			function view_city($id)
                        		{
                        			$data['country']=$this->users_model->get_countries();
                        			$data['state']=$this->users_model->get_state();
                        			$data['district']=$this->users_model->get_district();
                        			if($city=$this->users_model->get_city_ById($id))
                        			{
                        			$data['city']=$city;
                        			//var_dump($data);
                        			$this->view('dashboard/view_city',$data);
                        		}
                        		
                        		else
                        		{
 
                        				$this->view('common/error_404');
                        		}


                        		}
                        		
                        		
                        		function view_pincode($id)
                        		{


                        			$data['country']=$this->users_model->get_countries();
                        			$data['state']=$this->users_model->get_state();
                        			$data['district']=$this->users_model->get_districts();
                        			$data['city']=$this->users_model->get_city();
                        			if($pincode=$this->users_model->pincode_byId($id))
                        			
                        			{
                        				$data['pincode']=$pincode;
                        			$this->view('dashboard/single_view_pincode',$data);
                        		}

                        		else
                        		{
 
                        				$this->view('common/error_404');
                        		}
                        		}
                    	function get_pincodeByCity()
                        		{
                        			if ($id=$this->input->get('city')) {
                        				
                        				$data=$this->users_model->get_pins($id);

                        						if($data)
                        			{
                        				echo "<option value=''>Select Pincode</option>";
                        		foreach ($data as $value) {
                        		
                        	
                        			?>

                        			<option value="<?= $value->pincode ?>"><?= $value->pincode ?></option>

                        			<?php

                        		}
                        	}
                        	else
                        	{
                        		echo "<option value=''>Pincodes Not Available</option>";
                        	}
                        			}
                        		}
                        		
                        	function delete_pincode($id)
    	{


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/destroy_pincode',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id' =>$id),
));

$response = curl_exec($curl);

curl_close($curl);
$obj=json_decode($response);
			if ($obj->status) {
					
					$this->db->where('id',$id);
					$this->db->delete('pincode');
					redirect('users/pincode_list/delete');
			}
			else
			{
				echo "<script>alert('Sorry! Could not delete')</script>";
			}

    }
            
        
        function taskboard()
           {
                        $filter='';
                            //unit
                            switch((int)$this->session->userdata('user_role'))
                            {
                                case 27:
						$res=$this->db->select('unit')->from('users')->where('id',$this->session->userdata('id'))->get()->result();
				            $filter=$res[0]->unit;
				            break;
				            case 26:
						$res=$this->db->select('section')->from('users')->where('id',$this->session->userdata('id'))->get()->result();
				            $filter=$res[0]->section;
				            break;
				            case 25:
						$res=$this->db->select('department')->from('users')->where('id',$this->session->userdata('id'))->get()->result();
				            $filter=$res[0]->department;
				            break;
				            case 12:
						$res=$this->db->select('program')->from('users')->where('id',$this->session->userdata('id'))->get()->result();
				            $filter=$res[0]->program;
				            break;
				            
				            
                            }
				            
				            
				         $this->db->select('taskk.priority,taskk.description,taskk.link,taskk.id,taskk.status,taskk.created_at,users.user_name,program.pro_name,department.dtitle,unit.unit_name,section.section_name,taskk.title,taskk.end_date,taskk.completed_at');
				        $this->db->from('taskk');
				        $this->db->join('program','program.pid=taskk.program','left');
				        $this->db->join('section','section.id=taskk.section','left');
				        $this->db->join('unit','unit.id=taskk.unit','left');
				        $this->db->join('department','department.did=taskk.department','left');
				        $this->db->join('users','users.id=taskk.created_by','left');
				        $this->db->where('taskk.assign_uid',$this->session->userdata('id'));
				        $res=$this->db->get();
				        $data['tasklisto']=$res->result();
				        
                                   foreach($data['tasklisto'] as $value)
				                        {
				                        	$end_date = strtotime($value->end_date);
											$completed_at = strtotime($value->completed_at);
											$date=strtotime(date('d-m-Y'));

				                        
				                            if($end_date<$date and $value->status<=2){
				                                
				                                //echo$value->id;
				                                $arr=[
				                                    'priority'=>5
				                                    ];
				                                     $this->db->where('id',$value->id);
				                              $this->db->update('taskk',$arr);
				                             
				                            }
				                        }
				                        
				                        $this->db->select('taskk.priority,taskk.description,taskk.link,taskk.id,taskk.status,taskk.created_at,users.user_name,program.pro_name,department.dtitle,unit.unit_name,section.section_name,taskk.title,taskk.end_date,taskk.completed_at');
				        $this->db->from('taskk');
				        $this->db->join('program','program.pid=taskk.program','left');
				        $this->db->join('section','section.id=taskk.section','left');
				        $this->db->join('unit','unit.id=taskk.unit','left');
				        $this->db->join('department','department.did=taskk.department','left');
				        $this->db->join('users','users.id=taskk.created_by','left');
				        $this->db->where('taskk.assign_uid',$this->session->userdata('id'));
				        
				        if($this->session->userdata('user_role')=='Captain')
				        {
				        	switch((int)$this->session->userdata('user_role'))
                            {
                                case 27:
						    $this->db->or_where('unit.id',$filter);
						   $this->db->or_where('assign_uid',$this->session->userdata('id'));
				            break;
				            case 26:
				                 $this->db->or_where('section.id',$filter);
				                 				                 $this->db->or_where('assign_uid',$this->session->userdata('id'));
							break;
				            case 25:
				                 $this->db->or_where('department.id',$filter);
				                 				                 $this->db->or_where('assign_uid',$this->session->userdata('id'));
						    break;
				            case 12:
				                 $this->db->or_where('program.pid',$filter);
				                 $this->db->or_where('assign_uid',$this->session->userdata('id'));
					        break;
				            default:
				                $this->db->or_where('assign_uid',$this->session->userdata('id'));
				            
                            }
				        
				        }
				        //$this->db->where('assign_uid',$this->session->userdata('id'));
				        $res=$this->db->get();
				        $data['tasklist']=$res->result();
				                        
           			$this->view('users/taskboard',$data);
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
                
                                    function	dashboard()
		        		{
								$ddata['completed']=$this->get_task_details(3,'status','completed');//for opened or running task

								$ddata['approved']=$this->get_task_details(4,'status','approved');//for approved task
								$ddata['created']=$this->get_task_details(10,'id','created');//for approved task 10 is for created task
								$ddata['rejected']=$this->get_task_details(5,'status','rejected');

								$ddata['opened']=$this->get_task_details(2,'status','opened');//for opened or running task

								$ddata['delayed']=$this->get_task_details(4,'status','completed');//for approved task
								$ddata['awaited']=$this->get_task_details(3,'status','awaited');//for approved task 10 is for created task
								$ddata['progress']=$this->get_task_details(2,'status','running');
								$ddata['assigned']=$this->get_task_details(10,'id','assigned');

									// Score calculation start here

										$this->db->select('*');
									$this->db->from('taskk');
									//$this->db->where('created_by',$this->session->userdata('user_name'));
									$this->db->where('assign_uid',$this->session->userdata('id'));
									
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
												else if($value->status==6 and $comp==null)
												{
												    $score-=2;
												}
											}
											$ddata['totalscore']=$score;
												$ddata['delayedcount']=$delayed_count;
									//closed score calculation



					$this->view('dashboard/dashboard',$ddata);
				}

                                                        function userdashboard()
							{

									if ($end_date=$this->input->get('end_date')) {
										$start_date=$this->input->get('start_date');
									
									$completed=$this->get_task_details(3,'status','completed',$end_date,$start_date);//for opened or running task

								$approved=$this->get_task_details(4,'status','approved',$end_date,$start_date);//for approved task
								$created=$this->get_task_details(10,'id','created',$end_date,$start_date);//for approved task 10 is for created task
									$rejected=$this->get_task_details(5,'status','rejected',$end_date,$start_date);

								$opened=$this->get_task_details(2,'status','opened',$end_date,$start_date);//for opened or running task

								$delayed=$this->get_task_details(4,'status','completed',$end_date,$start_date);//for approved task
								$awaited=$this->get_task_details(3,'status','awaited',$end_date,$start_date);//for approved task 10 is for created task
								$progress=$this->get_task_details(2,'status','running',$end_date,$start_date);
								$assigned=$this->get_task_details(10,'id','assigned',$end_date,$start_date);

									// Score calculation start here

										$this->db->select('*');
									$this->db->from('taskk');
								//	$this->db->where('created_by',$this->session->userdata('user_name'));
									$this->db->where('assign_uid',$this->session->userdata('id'));

									$this->db->where('taskk.start_date >=',$start_date);
									$this->db->where('taskk.end_date <=',$end_date);
									
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
											$totalscore=$score;
												$delayedcount=$delayed_count;
									//closed score calculation




								?>

								<div class="row third_cls">
                <div class="col-md-4 col-lg-4 col-sm-6 left_bg">
                    <img class="bg" height="20%" style="height:2%;" src="<?= base_url('assets/dashboard').'/'?>hexagon.png" />
                    <div class="left_bg_div">
                        <span>Total Score</span>
                        <h2><?=  $totalscore ?></h2>
                    </div>
                </div>
                
                <div class="col-md-12 col-lg-8 third_innr_crcl" style="float:all;">
                    <div class="row" style="justify-content: space-between;">
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls marg_btm_cls">
                           
                                 <span>Task Assigned</span>
                            <h2><?= $created ?></h2>
                            
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls org marg_btm_cls">
                             <span>Tasks Opened</span>
                            <h2><?= $opened ?></h2>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls blu">
                           <span>Tasks Marked Completed</span>
                            <h2><?=$completed?></h2>
                        </div>
                    </div>
                    <div class="row" style="justify-content: space-between;margin-top: 25px;">
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls grn marg_btm_cls">
                           <span>Tasks Got Approved</span>
                            <h2><?= $approved ?></h2>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls red marg_btm_cls">
                             <span>Tasks Got Rejected</span>
                            <h2><?= $rejected ?></h2>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls ylw">
                            <span>Tasks Approval Awaited</span>
                            <h2><?= $awaited ?></h2>

                        </div>
                    </div>
                    <div class="row" style="justify-content: space-between;margin-top: 25px;">
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls gray marg_btm_cls">
                           <span>Tasks Under Progress</span>
                            <h2><?= $progress ?></h2>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls pink marg_btm_cls">
                             <span>Tasks Delayed</span>
                            <h2><?= $delayedcount ?></h2>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-md-3 col-lg-3 col-sm-6 cmn_cls ygd">
                            <span>Tasks Quality Index</span>
                            <h2>12765</h2>
                        </div>
                    </div>
                </div>
            </div> <?php
        }

							}
							
							public function taskFollowers()
							{
								if($uid=$this->input->post('uid'))
								{
							        $this->db->select('users.user_name,users.id,users.last_name,users.first_name,user_roles.user_role_name');
									$this->db->from('users');
									$this->db->join('user_roles','user_roles.id=users.user_role');
									$this->db->where_not_in('users.id',$uid);
									$this->db->where_not_in('user_roles.id',[22,36,24,37,21,0]);
								
									$res=$this->db->get()->result();
									//print_r(json_encode($res));
											if(count($res)>0)
											{
									foreach ($res as  $row) {
										?>
	<option value="<?= $row->id ?>"><?= $row->first_name .' ,'. $row->last_name.' , '.$row->user_role_name ?></option>
										<?php

									}
								}
								else
								{
									echo'<option value="">No Followers Available</option>';
								}
								}
								else
								{
									return false;
								}
							}

}
?>