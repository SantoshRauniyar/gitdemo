<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Projects extends Template
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->model('projects_model');
		$this->load->model('users_model');
		$this->set_header_path('administrator/blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->set_template('administrator/template');
		$this->set_title('User Management');
		
		$this->assets_load->add_css(array(base_url('assets/administrator/css/bootstrap-datetimepicker.min.css')),"header");
		$this->assets_load->add_js(array(base_url('assets/administrator/js/bootstrap-datetimepicker.js'),
										 base_url('assets/administrator/js/bootstrap-datetimepicker.fr.js'),
										 base_url('assets/administrator/js/vendors/products.js')),"footer");
										 
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
		$this->set_title["title"] = $this->set_title('Project Management');

		$sort = !isset($_REQUEST['sort'])?'project_name':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		$userdata = $this->projects_model->getprojectslist($sort,$type);

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
		$this->view("administrator/projects/projects_list",$data);
	}
	/* 

		Add User Process

	*/

	public function add_projects()
	{
		$data = array();
		$this->set_title('Add Project');
		$data 				 = $this->session->flashdata('addprojectdata');
		$data['leaderslist'] = $this->users_model->getTeamLeaderList();
		$data['mode'] 		 = "Add";
		$data['action'] 	 = base_url()."administrator/projects/do_save/";
		$data['heading']	 = "Add Project";
		$this->view("administrator/projects/add_edit_project",$data);
	}

	

	public function do_save()

	{

		$config = array(

	             		array(

	                     'field'   => 'project_name', 

	                     'label'   => 'project name', 

	                     'rules'   => 'trim|required'

	                  ),

	            		array(

	                     'field'   => 'description', 

	                     'label'   => 'description', 

	                     'rules'   => 'trim'

	                  ),

					  array(

	                     'field'   => 'leader_id', 

	                     'label'   => 'assign to', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'no_of_milestone', 

	                     'label'   => 'Number of Mailestone', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'start_date', 

	                     'label'   => 'start date', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'end_date', 

	                     'label'   => 'end date', 

	                     'rules'   => 'trim|required'

	                  ),

					   array(

	                     'field'   => 'budget', 

	                     'label'   => 'budget', 

	                     'rules'   => 'trim|required|numeric'

	                  )

                	);

		$this->form_validation->set_rules($config);

		$fields 	= array ("project_name","description","leader_id","no_of_milestone","start_date","end_date","budget");

			

		foreach($fields as $field)

		{

			$data[$field] = $this->input->post($field);

		}

		

		if ($this->form_validation->run() == FALSE) 

		{

			$this->session->set_flashdata( "errors", validation_errors());

			//unset($data['password']);

			$this->session->set_flashdata('addprojectdata',$data);

			redirect('administrator/projects/add_projects');

		}

		else

		{	

			

			$this->projects_model->set_fields($data);

			$result = $this->projects_model->save();

			

			if($result > 0)

			{

				$this->session->set_flashdata( "success", "Project added successfully.");

				redirect('administrator/projects/add_projects');

			}

		}

	}

	

	public function edit_project($id)

	{

		$data = array();

		$this->set_title('Edit Project');

		

		

		$adduserdata = $this->projects_model->getProjectbyid($id);

		if(!$adduserdata)

			redirect("/administrator/projects/all");

		else

			$data = $adduserdata;

		$data['leaderslist'] = $this->users_model->getTeamLeaderList();

		$data['mode'] 		 = "edit";

		$data['action'] 	 = base_url()."administrator/projects/do_update";

		$data['heading']	 = "Edit Projects";

		$this->view("administrator/projects/add_edit_project",$data);

	}

	

	public function do_update()

	{

		$config = array(

	             		array(

	                     'field'   => 'project_name', 

	                     'label'   => 'project name', 

	                     'rules'   => 'trim|required'

	                  ),

	            		array(

	                     'field'   => 'description', 

	                     'label'   => 'description', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'leader_id', 

	                     'label'   => 'assign to', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'no_of_milestone', 

	                     'label'   => 'Number of Mailestone', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'start_date', 

	                     'label'   => 'start date', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'end_date', 

	                     'label'   => 'end date', 

	                     'rules'   => 'trim|required'

	                  ),

					   array(

	                     'field'   => 'budget', 

	                     'label'   => 'budget', 

	                     'rules'   => 'trim|required|numeric'

	                  )

                	);

		$this->form_validation->set_rules($config);

		$fields 	= array ("id","project_name","description","leader_id","no_of_milestone","start_date","end_date","budget");

			

		foreach($fields as $field)

		{

			$data[$field] = $this->input->post($field);

		}

		

		if ($this->form_validation->run() == FALSE) 

		{

			$this->session->set_flashdata( "errors", validation_errors());

			//unset($data['password']);

			//$this->session->set_flashdata('addprojectdata',$data);

			redirect('administrator/projects/edit_project/'.$data['id']);

		}

		else

		{	

			$this->projects_model->set_fields($data);

			$result = $this->projects_model->do_update();

			

			$this->session->set_flashdata( "success", "Projects updated successfully.");

			redirect('administrator/projects/edit_project/'.$data['id']);

			

		}

	}

	

	/*

		Delete Single Project 

	*/

	public function delete_project($id)

	{

		$result = $this->projects_model->do_delete($id);

		if($result > 0)

		{

			echo "1";

			exit;

		}

		echo "0";

		exit;

	}

	

	/*

		Delete Multiple Projects

	*/

	public function delete_multiple()

	{

		$checkbox = $this->input->post('chk');

		

		foreach($checkbox as $data)

		{

			$this->projects_model->do_delete($data);

		}

		

		echo "1";

		exit;

	}

}

?>