<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');



class Task_type extends Template

{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->model("task_type_model");
		
		$this->set_header_path('administrator/blocks/header');

		//	$this->set_header_path('administrator/blocks/footer');

		$this->set_template('administrator/template');

		$this->set_title('Task Type Management');

		

		$this->assets_load->add_css(array(base_url('assets/administrator/css/bootstrap-datetimepicker.min.css')),"header");

		

		$this->assets_load->add_js(array(base_url('assets/administrator/js/bootstrap-datetimepicker.js'),

										 base_url('assets/administrator/js/bootstrap-datetimepicker.fr.js'),

										 base_url('assets/administrator/js/vendors/task.js')),"footer");

		

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

		$this->set_title["title"] = $this->set_title('Task Type Management');



		$sort = !isset($_REQUEST['sort'])?'task_type_name':$_REQUEST['sort'];

		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		

		$userdata = $this->task_type_model->gettasktypelist($sort,$type);

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

		$this->view("administrator/task_type/task_type_list",$data);

	}

	

	/* 

		Add User Process

	*/

	public function add_task_type()

	{

		$data = array();

		$this->set_title('Add Task');

		$data 				   	= $this->session->flashdata('addtaskdata');

		$data['mode'] 		 	= "Add Task-Type";

		$data['action'] 	 	= base_url()."administrator/task_type/do_save/";

		$data['heading']	 	= "Add Task Type";

		$this->view("administrator/task_type/add_edit_task_type",$data);

	}

	

	public function do_save()

	{

		$config = array(

	             		array(

	                     'field'   => 'task_type_name', 

	                     'label'   => 'task_type_name', 

	                     'rules'   => 'trim|required'

	                  )

                	);

		$this->form_validation->set_rules($config);

		$fields 	= array ("task_type_name");

			

		foreach($fields as $field)

		{

			$data[$field] = $this->input->post($field);

		}

		

		if ($this->form_validation->run() == FALSE) 

		{

			$this->session->set_flashdata( "errors", validation_errors());

			//unset($data['password']);

			$this->session->set_flashdata('addtaskdata',$data);

			redirect('administrator/task_type/add_task_type');

		}

		else

		{	

			$this->task_type_model->set_fields($data);

			$result = $this->task_type_model->save();

			

			if($result > 0)

			{

				$this->session->set_flashdata( "success", "Task type added successfully.");

				redirect('administrator/task_type/add_task_type');

			}

		}

	}

	

	public function edit_task_type($id)

	{

		$data = array();

		$this->set_title('Edit Task');

		

		

		$adduserdata = $this->task_type_model->gettasktypebyid($id);

		if(!$adduserdata)

			redirect("administrator/task_type/all");

		else

			$data = $adduserdata;

		
		$data['mode'] 	= "edit";

		$data['action'] = base_url()."administrator/task_type/do_update";

		$data['heading']= "Edit Task Type";

		$this->view("administrator/task_type/add_edit_task_type",$data);

	}

	

	public function do_update()

	{

		$config = array(

	             		array(

	                     'field'   => 'task_type_name', 

	                     'label'   => 'task type', 

	                     'rules'   => 'trim|required'

	                  )
                	);

		$this->form_validation->set_rules($config);

		$fields 	= array ("id","task_type_name");

			

		foreach($fields as $field)

		{

			$data[$field] = $this->input->post($field);

		}

		

		if ($this->form_validation->run() == FALSE) 

		{

			$this->session->set_flashdata( "errors", validation_errors());

			//unset($data['password']);

			//$this->session->set_flashdata('addprojectdata',$data);

			redirect('administrator/task_type/edit_task_type/'.$data['id']);

		}

		else

		{

			$this->task_type_model->set_fields($data);

			$result = $this->task_type_model->do_update();

			

			$this->session->set_flashdata( "success", "Task type updated successfully.");

			redirect('administrator/task_type/edit_task_type/'.$data['id']);

			

		}

	}

	

	

	/*

		Delete Single Task

	*/

	public function single_task_type_delete($task_id)

	{

		$this->task_type_model->do_delete($task_id);

		echo 1;

		exit;

	}

	

	/*

		Delete Multiple Task

	*/

	public function delete_multiple()

	{

		$tasks = $this->input->post('chk');

		

		foreach($tasks as $data)

		{

			$this->task_type_model->do_delete($data);

		}

		echo 1;

		exit;

	}
}

?>