<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');



class User_role extends Template

{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->model('user_role_model');

		$this->set_header_path('administrator/blocks/header');

		//$this->set_header_path('administrator/blocks/footer');

		$this->set_template('administrator/template');

		$this->set_title('User Role Management');

		

		//$this->assets_load->add_css(array(base_url('assets/administrator/css/bootstrap-datetimepicker.min.css')),"header");

		

		$this->assets_load->add_js(array(base_url('assets/administrator/js/vendors/user_role.js')),"footer");

		

		if(!$this->session->userdata('admin_id'))

			redirect("administrator/authentication/");

	}

	public function index()

	{

		$this->all();

	}
	
	/*
		Add user role
	*/
	
	public function add_role()
	{
		$data = array();

		$this->set_title('Add New Role');

		$data 			= $this->session->flashdata('adduserrolldata');

		$data['mode'] 	= "Add";

		$data['action'] = base_url()."administrator/user_role/do_save/";

		$data['heading']= "Add New Role";

		$this->view("administrator/user_role/add_edit_user_role",$data);
	}

	
	/* 

		Add User role Process

	*/

	public function do_save()

	{
		$config = array(

	             		array(

	                     'field'   => 'role', 

	                     'label'   => 'role', 

	                     'rules'   => 'trim|required'

	                  )

	           	);

		$this->form_validation->set_rules($config);

		$fields 	= array ("role");

		foreach($fields as $field)

		{

			$data[$field] = $this->input->post($field);

		}

		if ($this->form_validation->run() == FALSE) 

		{

			$this->session->set_flashdata( "errors", validation_errors());

			//unset($data['password']);

			$this->session->set_flashdata('adduserrolldata',$data);

			redirect('administrator/user_role/add_role');

		}

		else

		{	

			$this->user_role_model->set_fields($data);

			$result = $this->user_role_model->save();

			if($result > 0)
			{

				$this->session->set_flashdata( "success", "User added successfully.");

				redirect('administrator/user_role/add_role');

			}

		}

	}
	
	/*

		Manage users role & permission view

	*/

	public function all()

	{

		//$this->data['current_page'] = 'viewdetail';

		$this->set_title["title"] = $this->set_title('User permission Management');



		$sort = !isset($_REQUEST['sort'])?'role':$_REQUEST['sort'];

		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		

		$userroledata = $this->user_role_model->getuserrolelist($sort,$type);

		if($type=='asc')

			$type ='desc';

		else

			$type ='asc';

			

      	$data['type'] = $type;

      	$data['sort'] = $sort;

	

		if(count($userroledata['results'])>0)

			$data['userroledata'] = $userroledata;

		

      	$data['url']  = $_SERVER['PHP_SELF'].'?sort='.$sort.'&type='.$type;

      //$this->view('administrator/admin_category_templet',$this->data);

		$this->view("administrator/user_role/permission_manager",$data);

	}

	/* Set permission of roll */

	public function changestatus($rol_id,$field,$value)
	{
		$num_result = $this->user_role_model->changestatus($rol_id,$field,$value);
		if($num_result > 0)
		{
			echo 1;
		}
		else
		{	
			echo "No Changes.";
		}
		exit;
	}

	
	

	public function edit_user_role($id)

	{

		$data = array();

		$this->set_title('Edit User Role');

		$adduserroledata = $this->user_role_model->getuserrolebyid($id);

		if(!$adduserroledata)

			redirect("administrator/user_role/all");

		else

			$data = $adduserroledata;

		$data['mode'] 	= "edit";

		$data['action'] = base_url()."administrator/user_role/do_update";

		$data['heading']= "Edit User Role";

		$this->view("administrator/user_role/add_edit_user_role",$data);

	}

	

	public function do_update()

	{

		$config = array(

	             	array(

	                     'field'   => 'role', 

	                     'label'   => 'role', 

	                     'rules'   => 'trim|required'

	                  )

                	);

		$this->form_validation->set_rules($config);

		$fields 	= array ("id","role");
			
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

			$this->user_role_model->set_fields($data);

			$result = $this->user_role_model->do_update();

			$this->session->set_flashdata( "success", "User role updated successfully.");

			redirect('administrator/user_role/edit_user_role/'.$data['id']);
			
		}

	}

	

	/*

		Delete Single User

	*/

	public function single_role_delete($role_id)
	{

		$result = $this->user_role_model->do_delete($role_id);

		if($this->input->is_ajax_request())

		{

			echo 1;

			exit;

		}

		redirect('administrator/user_role/all');

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