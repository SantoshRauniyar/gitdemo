<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class User_role extends Template
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
		$this->load->model('user_classification_model');
		$this->user_classification_model->set_role();

		$this->set_header_path('blocks/header');
		$this->set_template("template");
		$this->set_title('User Role Management');
		$this->assets_load->add_js(array(base_url('assets/js/vendor/user_role.js')),"footer");

		if(!$this->session->userdata('id'))
			redirect("authentication/");
	}

	public function index()
	{
		$this->all();
	}
	
	/*
	 Function	:- Display list of the created role
	Date		:- 25/09/2012
	Developed by:- Kartik Shah
	*/
	public function all()
	{
		$this->set_title["title"] = $this->set_title('User permission Management');
	
		$sort = !isset($_REQUEST['sort'])?'user_role_name':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
	
		$userroledata = $this->user_classification_model->user_role_list_pagination($sort,$type,$this->session->userdata('id'),$this->session->userdata('team_id'));
	
//here we update role in sess
			if ($this->session->userdata('user_role')!="Captain") {
				$this->db->where('id',$this->session->userdata('user_role'));
   				 	$res=$this->db->get('user_roles');
   				 $deliveryData=$res->result_array();
   				 $deliveryData=$deliveryData[0];
   				 $this->session->set_userdata('deliverdata1', $deliveryData);         #to set the session with the above array
				
   						 ### for retrieving the session values ###
   	  	 $deliveryData   = $this->session->userdata('deliverdata1');          #will return the whole array
			}

//closed

		if($type=='asc')
			$type ='desc';
		else
			$type ='asc';
	
		$data['type'] = $type;
		$data['sort'] = $sort;
	
		if(count($userroledata['results'])>0)
			$data['userroledata'] = $userroledata;
	
		$data['url']  = $_SERVER['PHP_SELF'].'?sort='.$sort.'&type='.$type;
	
		$this->view("user_role/user_role_list",$data);
	}
	
	
	public function editlist()
	{
		$this->set_title["title"] = $this->set_title('User permission Management');
	
		$sort = !isset($_REQUEST['sort'])?'user_role_name':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
	
		$userroledata = $this->user_classification_model->edituser_role_list_pagination($sort,$type,$this->session->userdata('id'),$this->session->userdata('team_id'));
	
//here we update role in sess
			if ($this->session->userdata('user_role')!="Captain") {
				$this->db->where('id',$this->session->userdata('user_role'));
   				 	$res=$this->db->get('user_roles');
   				 $deliveryData=$res->result_array();
   				 $deliveryData=$deliveryData[0];
   				 $this->session->set_userdata('deliverdata1', $deliveryData);         #to set the session with the above array
				
   						 ### for retrieving the session values ###
   	  	 $deliveryData   = $this->session->userdata('deliverdata1');          #will return the whole array
			}

//closed

		if($type=='asc')
			$type ='desc';
		else
			$type ='asc';
	
		$data['type'] = $type;
		$data['sort'] = $sort;
	
		if(count($userroledata['results'])>0)
			$data['userroledata'] = $userroledata;
	
		$data['url']  = $_SERVER['PHP_SELF'].'?sort='.$sort.'&type='.$type;
	    $data['action']='edit';
		$this->view("user_role/user_role_list",$data);
	}


	public function deletelist()
	{
		$this->set_title["title"] = $this->set_title('User permission Management');
	
		$sort = !isset($_REQUEST['sort'])?'user_role_name':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
	
		$userroledata = $this->user_classification_model->deleteuser_role_list_pagination($sort,$type,$this->session->userdata('id'),$this->session->userdata('team_id'));
	
//here we update role in sess
			if ($this->session->userdata('user_role')!="Captain") {
				$this->db->where('id',$this->session->userdata('user_role'));
   				 	$res=$this->db->get('user_roles');
   				 $deliveryData=$res->result_array();
   				 $deliveryData=$deliveryData[0];
   				 $this->session->set_userdata('deliverdata1', $deliveryData);         #to set the session with the above array
				
   						 ### for retrieving the session values ###
   	  	 $deliveryData   = $this->session->userdata('deliverdata1');          #will return the whole array
			}

//closed

		if($type=='asc')
			$type ='desc';
		else
			$type ='asc';
	
		$data['type'] = $type;
		$data['sort'] = $sort;
	
		if(count($userroledata['results'])>0)
			$data['userroledata'] = $userroledata;
	
		$data['url']  = $_SERVER['PHP_SELF'].'?sort='.$sort.'&type='.$type;
	    $data['action']='delete';
		$this->view("user_role/user_role_list",$data);
	}	

	/*
		Function 		:- Add User Role form view
		Date     		:- 25/09/2014
		Developerd by	:- Kartik
	*/
	
	public function add_role()
	{
		$data = array();
		$this->set_title('Add New Role');
		
		$data 			 = $this->session->flashdata('adduserrolldata');
		$data['mode'] 	 = "Add";
		$data['action'] = base_url()."user_role/do_save/";
		$data['heading']= "Add New Role";
		$data['roles_masters']= $this->db->select('id,name')->from('role_master')->order_by('name','asc')->get()->result();
		$this->view("user_role/add_edit_user_role",$data);
	}

	
	/*
	 	Function 		:- Add User Role Process
		Date     		:- 25/09/2014
		Developerd by	:- Kartik 
	*/
	public function do_save()
	{
		$config = array(
	             	array(
	                		'field'   => 'user_role_name', 
	                 		'label'   => 'role', 
	                 		'rules'   => 'trim|required'
	                  ),
						array(
								'field'   => 'description',
								'label'   => 'description',
								'rules'   => 'trim|required'
					  ),
					  	array(
								'field'   => 'roles_master',
								'label'   => 'Roles Master',
								'rules'   => 'trim|required'
					  )
	           	);
		$this->form_validation->set_rules($config);

		$fields 	= array ("user_role_name","description","roles_master");
		
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			$this->session->set_flashdata('adduserrolldata',$data);
			redirect('user_role/add_role');
		}
		else
		{	
			$data['team_id'] = $this->session->userdata('team_id');
			$data['user_role_name'] = trim($data['user_role_name']," ");
			//echo $data['user_role_name'];
			if($this->user_classification_model->is_role_exist($data['user_role_name'],$this->session->userdata('id'),$this->session->userdata('team_id')))
			{
				$this->session->set_flashdata("errors","Role is allready exist.");
				$this->session->set_flashdata('adduserrolldata',$data);
				redirect('user_role/add_role');
			}
			$data['created_by_user_id'] = $this->session->userdata('id');
			
			$this->user_classification_model->set_fields($data);
			$result = $this->user_classification_model->save();
			if($result > 0)
			{
				$this->session->set_flashdata( "success", "User role added successfully.");
				redirect('user_role/all');
			}
		}
	}
	
	
	
	   function single_role_view($id)
	   {
	       
	       $data = array();
		$this->set_title('View Single User Role');
		
		$adduserroledata = $this->user_classification_model->get_role_details($id,$this->session->userdata('id'));

		if(!$adduserroledata)
			redirect("user_role/all");
		else
			$data = $adduserroledata;
		
	
		$data['heading']= "View Single User Role";
		$data['roles_masters']= $this->db->select('id,name')->from('role_master')->order_by('name','asc')->get()->result();
		$this->view("user_role/single_view_user_role",$data);
	       
	   }
	
	

	/*
	 	Function	:- Edit form for user role
		Date		:- 25/09/2012
		Developed by:- Kartik Shah
	 */
	public function edit_user_role($id)
	{
		$data = array();
		$this->set_title('Edit User Role');
		$adduserroledata = $this->user_classification_model->get_role_details($id,$this->session->userdata('id'));

		if(!$adduserroledata)
			redirect("user_role/all");
		else
			$data = $adduserroledata;
		
		$data['mode'] 	= "edit";
		$data['action'] = base_url()."user_role/do_update";
		$data['heading']= "Edit User Role";
		$data['roles_masters']= $this->db->select('id,name')->from('role_master')->order_by('name','asc')->get()->result();
		$this->view("user_role/add_edit_user_role",$data);
	}

	
	/*
	 	Function	:- Edit user role process
		Date		:- 25/09/2012
		Developed by:- Kartik Shah
	*/
	public function do_update()
	{
		$config = array(
	            array(
	             	'field'   => 'user_role_name', 
	               'label'   => 'role', 
	               'rules'   => 'trim|required'
	                  ),
					array(
						'field'   => 'description',
						'label'   => 'description',
						'rules'   => 'trim|required'
					 ),
					 array(
						'field'   => 'roles_master',
						'label'   => 'Roles Master',
						'rules'   => 'trim|required'
					 )
	          );
		$this->form_validation->set_rules($config);
		$fields 	= array ("id","user_role_name","description","roles_master");
			
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			//$this->session->set_flashdata('adduserdata',$data);
			redirect('administrator/user_role/edit_user_role/'.$data['id']);
		}
		else
		{	
			if($this->user_classification_model->is_role_exist($data['user_role_name'],$this->session->userdata('id'),$this->session->userdata('team_id'),$data['id']))
			{
				$this->session->set_flashdata("errors","Role name is allready exist.");
				$this->session->set_flashdata('adduserrolldata',$data);
				redirect('user_role/edit_user_role/'.$data['id']);
			}
			$this->user_classification_model->set_fields($data);
			$result = $this->user_classification_model->do_update();
			$this->session->set_flashdata( "success", "User role updated successfully.");
			redirect('user_role/all/'); 
		}
	}
	
	/*
		Function	:- Delete User rolw
		Date		:- 25/09/2014
		Developed by:- Kartik Shah
	*/
	public function single_role_delete($role_id)
	{
		$result = $this->user_classification_model->do_delete($role_id);
		if($this->input->is_ajax_request())
		{
			echo 1;
			exit;
		}

		redirect('user_role/all');
	}
	
	/*
	 * 		Function	:- Set Privillagies view
	 * 		Date		:- 26/09/2014
	 * 		Developed by:- Kartik Shah
	 */
	public function set_privillages()
	{
		//$this->data['current_page'] = 'viewdetail';
		$data = array();
		$this->set_title('Set User Role Privillages');
		$data['userrolelist'] = $this->user_classification_model->get_user_role_dropdown($this->session->userdata('id'),$this->session->userdata('team_id'));
		//$data['userrolelist']	= $this->user_classification_model->get_role_privillages($this->session->userdata('id'));
		$data['heading'] 	  = "Set User Role Privillages";
		$data['action']		  = base_url()."user_role/change_privillages/";
		//var_dump($data);
		$this->view("user_role/permission_manager",$data);
	}
	
	/*
	 * 		Function	:- Fetched Privillages
	 * 		Date		:- 27/09/2014
	 * 		Developed by:- Kartik Shah
	 */
	public function getPrivillages($user_role_id)
	{
		$privillagelist = $this->user_classification_model->getprivillages($user_role_id);
		if(!empty($privillagelist))
		{
			$data['status'] = "success";
			$data['data']   = $privillagelist;
			echo json_encode($data);
			exit;
		}
	} 
	/******
	 * 		Function	:- Set Privillages Proccess
	 * 		Date		:- 26/09/2014
	 * 		Developed by:- Kartik Shah
	 ****/
	
	public function change_privillages()
	{
		$config = array(
						array(
								'field'   => 'is_add_group_member',
								'label'   => 'Allow Add Group Member',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_delete_group_member',
								'label'   => 'Allow Delete Group Member',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_group_chat_board',
								'label'   => 'Allow Group Chat',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_theam',
								'label'   => 'Allow Theam Set',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_task_create',
								'label'   => 'Allow Task Creation',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_complete_task',
								'label'   => 'Allow Task Completion',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_approve_task',
								'label'   => 'Allow Task Approval',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_reassign_task',
								'label'   => 'Allow Reassigning Task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_sub_task',
								'label'   => 'Allow Sub-Task Creation',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_task_discussion',
								'label'   => 'Allow Task Discussion',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_add_pro',
								'label'   => 'Allow Add Program',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_pro',
								'label'   => 'Allow Edit Program',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_pro',
								'label'   => 'Allow Delete Program',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_pro',
								'label'   => 'Allow View Program',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_taskboard_pro',
								'label'   => 'Allow Taskboard Program',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_dashboard_pro',
								'label'   => 'Allow View Program',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_add_unit',
								'label'   => 'Allow Add Unit',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_unit',
								'label'   => 'Allow Edit Unit',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_unit',
								'label'   => 'Allow Delete Unit',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_unit',
								'label'   => 'Allow View Unit',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_taskboard_unit',
								'label'   => 'Allow Taskboard Unit',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_dashboard_unit',
								'label'   => 'Allow Dashboard Unit',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_add_project',
								'label'   => 'Allow Add Project',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_project',
								'label'   => 'Allow Edit Project',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_project',
								'label'   => 'Allow Delete Project',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_project',
								'label'   => 'Allow View Project',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_taskboard_project',
								'label'   => 'Allow Taskboard Project',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_dashboard_project',
								'label'   => 'Allow Dashboard Project',
								'rules'   => 'trim'
							),
							array(
								'field'   => 'is_add_mile',
								'label'   => 'Allow Add Milestone',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_mile',
								'label'   => 'Allow Edit Mile',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_mile',
								'label'   => 'Allow Delete Milestone',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_mile',
								'label'   => 'Allow View Milestone',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_taskboard_mile',
								'label'   => 'Allow Taskboard Milestone',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_dashboard_mile',
								'label'   => 'Allow Dashboard Milestoone',
								'rules'   => 'trim'
							),
													array(
								'field'   => 'is_add_gtask',
								'label'   => 'Allow Add General task',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_gtask',
								'label'   => 'Allow Edit ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_gtask',
								'label'   => 'Allow Delete General task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_gtask',
								'label'   => 'Allow View General task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_approve_gtask',
								'label'   => 'Allow Approval General task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_comp_gtask',
								'label'   => 'Allow Complete General task',
								'rules'   => 'trim'
							),						array(
								'field'   => 'is_add_mtask',
								'label'   => 'Allow Add Marketing task',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_mtask',
								'label'   => 'Allow Edit ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_mtask',
								'label'   => 'Allow Delete Marketing task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_mtask',
								'label'   => 'Allow View Marketing task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_approve_mtask',
								'label'   => 'Allow Approval Marketing task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_comp_mtask',
								'label'   => 'Allow Complete Marketing task',
								'rules'   => 'trim'
							),
					array(
								'field'   => 'is_add_pub_task',
								'label'   => 'Allow Add Publish task',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_pub_task',
								'label'   => 'Allow Edit ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_pub_task',
								'label'   => 'Allow Delete Publish task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_pub_task',
								'label'   => 'Allow View Publish task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_approve_pub_task',
								'label'   => 'Allow Approval Publish task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_comp_pub_task',
								'label'   => 'Allow Complete Publish task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_add_response_task',
								'label'   => 'Allow Add Response task',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_response_task',
								'label'   => 'Allow Edit  Response Task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_response_task',
								'label'   => 'Allow Delete Response task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_response_task',
								'label'   => 'Allow View Response task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_approve_response_task',
								'label'   => 'Allow Approval Response task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_add_team',
								'label'   => 'Allow Add Team',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_team',
								'label'   => 'Allow Edit  Team',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_team',
								'label'   => 'Allow Delete Team',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_team',
								'label'   => 'Allow View Team',
								'rules'   => 'trim'
							),
												array(
								'field'   => 'is_add_member',
								'label'   => 'Allow Add Member',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_member',
								'label'   => 'Allow Edit  Member',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_member',
								'label'   => 'Allow Delete Member',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_member',
								'label'   => 'Allow View Member',
								'rules'   => 'trim'
							),
							array(
								'field'   => 'is_member_unblock',
								'label'   => 'Allow Unblock Member',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_member_block',
								'label'   => 'Allow Block Member',
								'rules'   => 'trim'
							),
					array(
								'field'   => 'is_add_role',
								'label'   => 'Allow Add Role',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_role',
								'label'   => 'Allow Edit  Role',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_role',
								'label'   => 'Allow Delete Role',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_role',
								'label'   => 'Allow View Role',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_add_lead_quali_task',
								'label'   => 'Allow Add Lead_quali_task',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_lead_quali_task',
								'label'   => 'Allow Edit  Lead_quali_task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_lead_quali_task',
								'label'   => 'Allow Delete Lead_quali_task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_lead_quali_task',
								'label'   => 'Allow View Lead_quali_task',
								'rules'   => 'trim'
							),
							array(
								'field'   => 'is_add_lead_gen_task',
								'label'   => 'Allow Add Lead_gen_task',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_lead_gen_task',
								'label'   => 'Allow Edit  Lead_gen_task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_lead_gen_task',
								'label'   => 'Allow Delete Lead_gen_task',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_lead_gen_task',
								'label'   => 'Allow View Lead_gen_task',
								'rules'   => 'trim'
							),	array(
								'field'   => 'is_add_country',
								'label'   => 'Allow Add ',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_country',
								'label'   => 'Allow Edit  ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_country',
								'label'   => 'Allow Delete ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_country',
								'label'   => 'Allow View ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_add_state',
								'label'   => 'Allow Add ',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_state',
								'label'   => 'Allow Edit  ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_state',
								'label'   => 'Allow Delete ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_state',
								'label'   => 'Allow View ',
								'rules'   => 'trim'
							),array(
								'field'   => 'is_add_district',
								'label'   => 'Allow Add ',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_district',
								'label'   => 'Allow Edit  ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_district',
								'label'   => 'Allow Delete ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_district',
								'label'   => 'Allow View ',
								'rules'   => 'trim'
							),array(
								'field'   => 'is_add_city',
								'label'   => 'Allow Add ',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_city',
								'label'   => 'Allow Edit  ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_city',
								'label'   => 'Allow Delete ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_city',
								'label'   => 'Allow View ',
								'rules'   => 'trim'
							),array(
								'field'   => 'is_add_pincode',
								'label'   => 'Allow Add ',
								'rules'   => 'trim'
						),
						array(
								'field'   => 'is_edit_pincode',
								'label'   => 'Allow Edit  ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_del_pincode',
								'label'   => 'Allow Delete ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_pincode',
								'label'   => 'Allow View ',
								'rules'   => 'trim'
							),

						array(
								'field'   => 'is_hview_reg',
								'label'   => 'Allow View ',
								'rules'   => ''
							),
						array(
								'field'   => 'is_hview_approval',
								'label'   => 'Allow View ',
								'rules'   => 'trim'
							),
							array(
								'field'   => 'is_delete_leave',
								'label'   => 'Allow Delete ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_leave',
								'label'   => 'Allow View ',
								'rules'   => 'trim'
							),

						array(
								'field'   => 'is_edit_leave',
								'label'   => 'Allow Edit ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_take_leave',
								'label'   => 'Allow Take leave ',
								'rules'   => 'trim'
							) ,
							array(
								'field'   => 'is_delete_hire',
								'label'   => 'Allow Delete ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_view_hire',
								'label'   => 'Allow View ',
								'rules'   => 'trim'
							),

						array(
								'field'   => 'is_edit_hire',
								'label'   => 'Allow Edit ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_hire',
								'label'   => 'Allow Add hire ',
								'rules'   => 'trim'
							),
							array(
								'field'   => 'is_dr_reg',
								'label'   => 'Allow Doctor Registration ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_dr_rej',
								'label'   => 'Allow View ',
								'rules'   => 'trim'
							),

						array(
								'field'   => 'is_dr_appr',
								'label'   => 'Allow Approved ',
								'rules'   => 'trim'
							),
						array(
								'field'   => 'is_dr_pend',
								'label'   => 'Allow Dr  Pending ',
								'rules'   => 'trim'
							)
					
						);
		$this->form_validation->set_rules($config);
		
	$fields = array("is_del_sec","is_edit_sec","is_view_sec","is_add_sec","is_prej","is_ppend","is_pappr","is_preg","is_view_cityzone","is_edit_cityzone","is_del_cityzone","is_view_setcurrency","is_edit_setcurrency","is_del_setcurrency","is_view_currency","is_edit_currency","is_del_currency","is_view_district_partner","is_edit_district_partner","is_del_district_partner","is_add_district_partner","is_view_state_partner","is_edit_state_partner","is_del_state_partner","is_add_state_partner","is_add_country_partner","is_del_country_partner","is_edit_country_partner","is_view_country_partner","is_dr_reg","is_dr_rej","is_dr_appr","is_dr_pend","is_add_group_member","is_delete_group_member","is_group_chat_board","is_theam","is_task_create","is_reassign_task","is_sub_task","is_complete_task","is_approve_task","is_task_discussion","is_add_pro","is_edit_pro","is_del_pro","is_view_pro","is_taskboard_pro","is_dashboard_pro","is_add_unit","is_edit_unit","is_taskboard_unit","is_dashboard_unit","is_view_unit","is_del_unit","is_del_project","is_add_project","is_edit_project","is_taskboard_project","is_dashboard_project","is_view_project","is_add_mile","is_edit_mile","is_taskboard_mile","is_dashboard_mile","is_view_mile","is_del_mile","is_add_gtask","is_edit_gtask","is_comp_gtask","is_approve_gtask","is_view_gtask","is_del_gtask","is_add_mtask","is_edit_mtask","is_comp_mtask","is_approve_mtask","is_view_mtask","is_del_mtask","is_add_pub_task","is_edit_pub_task","is_comp_pub_task","is_approve_pub_task","is_view_pub_task","is_del_pub_task","is_add_response_task","is_edit_response_task","is_approve_response_task","is_view_response_task","is_del_response_task","is_add_team","is_edit_team","is_view_team","is_del_team","is_add_member","is_edit_member","is_view_member","is_del_member","is_member_block","is_member_unblock","is_add_role","is_edit_role","is_del_role","is_view_role","is_add_assign","is_edit_assign","is_del_assign","is_view_assign","is_add_lead_gen_task","is_edit_lead_gen_task","is_del_lead_gen_task","is_view_lead_gen_task","is_add_lead_quali_task","is_edit_lead_quali_task","is_del_lead_quali_task","is_view_lead_quali_task","is_add_country","is_edit_country","is_del_country","is_view_country","is_add_state","is_edit_state","is_del_state","is_view_state","is_add_district","is_edit_district","is_del_district","is_view_district","is_add_city","is_edit_city","is_del_city","is_view_city","is_add_pincode","is_edit_pincode","is_del_pincode","is_view_pincode","is_hview_approval","is_hview_reg","is_delete_hire","is_edit_hire","is_view_hire","is_hire","is_delete_leave","is_edit_leave","is_view_leave","is_take_leave");			
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		
		
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			//$this->session->set_flashdata('adduserdata',$data);
			
			redirect('user_role/set_privillages/');
		}
		else
		{
			$data['id'] = $this->input->post("user_role");
			$this->user_classification_model->set_fields($data);
			$result = $this->user_classification_model->changestatus();
		//	print_r($result);exit;
			if($result > 0)
			{


				$this->session->set_flashdata( "success", "Saved");
				redirect('user_role/all');
			}
		}
	}
	/*public function changestatus($rol_id,$field,$value)
	{
		$num_result = $this->user_classification_model->changestatus($rol_id,$field,$value);
		if($num_result > 0)
		{
			echo 1;
		}
		else
		{
			echo "No Changes.";
		}
		exit;
	}*/


	function set_role_per($attr)
	{


		if($this->user_classification_model->check_role_auth(17,$attr))
		{
			$data=["status"=>200];
		
				return $data;
		}
	}
	
	            
				        function support_ticket()
				        {
				            
                            return $this->view('users/ticket');
                    
				        }


				        
	
}