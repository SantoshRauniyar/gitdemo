<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');



class Task extends Template
{
	public function __construct()
	{
		parent::__construct();
		
//		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	//	header("Cache-Control: no-store,no-cache, must-revalidate");
	
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->load->helper('form');

		$this->load->model('users_model');
		$this->load->model('milestone_model');
		$this->load->model('groups_model');
		$this->load->model('task_model');

		$this->set_header_path('blocks/header');
		$this->set_template('template');
		$this->set_title('Task Management');

		$this->assets_load->add_css(array(base_url('assets/css/bootstrap-datetimepicker.min.css')),"header");

		$this->assets_load->add_js(array(base_url('assets/js/bootstrap-datetimepicker.js'),
										 base_url('assets/js/bootstrap-datetimepicker.fr.js'),
										 base_url('assets/js/vendors/task.js')),"footer");

		if(!$this->session->userdata('id'))
			redirect("authentication/");
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
		
		$this->set_title["title"] = $this->set_title('Task Management');



		$sort = !isset($_REQUEST['sort'])?'task':$_REQUEST['sort'];

		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		

		$userdata = $this->task_model->gettasklist($sort,$type);

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

		$this->view("task_list",$data);

	}

	

	/* 

		Add User Process

	*/

	public function add_task()

	{

		$data = array();

		$this->set_title('Add Task');

		$data 				   	= $this->session->flashdata('addtaskdata');

		$data['milestonelist'] 	= $this->milestone_model->getMilestonseList();

		$data['userlist']		= $this->users_model->getuserdropdown();
		
		$data['grouplist']		= $this->groups_model->getgrouplist();

		$data['mode'] 		 	= "Add";

		$data['action'] 	 	= base_url()."task/do_save/";

		$data['heading']	 	= "Add Task";

		$this->view("add_edit_task",$data);

	}

	

	public function do_save()

	{

		$config = array(

	             		array(

	                     'field'   => 'task', 

	                     'label'   => 'task', 

	                     'rules'   => 'trim|required'

	                  ),

	            		array(

	                     'field'   => 'description', 

	                     'label'   => 'description', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'milestone_id', 

	                     'label'   => 'milestone name', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'member_id', 

	                     'label'   => 'member name', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'budget', 

	                     'label'   => 'budget', 

	                     'rules'   => 'trim|required|numeric'

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

	                  )

                	);

		$this->form_validation->set_rules($config);

		$fields 	= array ("task","description","milestone_id","member_id","start_date","end_date","budget");

			

		foreach($fields as $field)

		{

			$data[$field] = $this->input->post($field);

		}

		

		if ($this->form_validation->run() == FALSE) 

		{

			$this->session->set_flashdata( "errors", validation_errors());

			//unset($data['password']);

			$this->session->set_flashdata('addtaskdata',$data);

			redirect('task/add_task');

		}

		else

		{	

			$milestonebudget = $this->milestone_model->get_milestone_budget($data['milestone_id']);

			$sumoftaskbudget = $this->task_model->get_sum_of_budget($data['milestone_id']);

			

			if(($sumoftaskbudget + $data['budget']) > $milestonebudget)

			{

				$this->session->set_flashdata("errors","Your task budget is more then your milestone's remaining budget limit.");

				$this->session->set_flashdata('addtaskdata',$data);

				redirect('task/add_task');

			}

			$this->task_model->set_fields($data);

			$result = $this->task_model->save();

			

			if($result > 0)

			{

				$this->session->set_flashdata( "success", "Task added successfully.");

				redirect('task/add_task');

			}

		}

	}

	

	public function edit_task($id)

	{

		$data = array();

		$this->set_title('Edit Task');

		

		

		$adduserdata = $this->task_model->gettaskbyid($id);

		if(!$adduserdata)

			redirect("task/all");

		else

			$data = $adduserdata;

		$data['milestonelist'] 	= $this->milestone_model->getMilestonseList();

		$data['userlist']		= $this->users_model->getuserdropdown();
		
		$data['grouplist']		= $this->groups_model->getgrouplist();
		
		$data['mode'] 	= "edit";

		$data['action'] = base_url()."task/do_update";

		$data['heading']= "Edit Task";

		$this->view("add_edit_task",$data);

	}

	

	public function do_update()

	{

		$config = array(

	             		array(

	                     'field'   => 'task', 

	                     'label'   => 'task', 

	                     'rules'   => 'trim|required'

	                  ),

	            		array(

	                     'field'   => 'description', 

	                     'label'   => 'description', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'milestone_id', 

	                     'label'   => 'milestone name', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'member_id', 

	                     'label'   => 'member name', 

	                     'rules'   => 'trim|required'

	                  ),

					  array(

	                     'field'   => 'budget', 

	                     'label'   => 'budget', 

	                     'rules'   => 'trim|required|numeric'

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

	                  )

                	);

		$this->form_validation->set_rules($config);

		$fields 	= array ("id","task","description","milestone_id","member_id","start_date","end_date","budget");

			

		foreach($fields as $field)

		{

			$data[$field] = $this->input->post($field);

		}

		

		if ($this->form_validation->run() == FALSE) 

		{

			$this->session->set_flashdata( "errors", validation_errors());

			//unset($data['password']);

			//$this->session->set_flashdata('addprojectdata',$data);

			redirect('task/edit_task/'.$data['id']);

		}

		else

		{

			$milestonebudget = $this->milestone_model->get_milestone_budget($data['milestone_id']);

			$sumoftaskbudget = $this->task_model->get_sum($data['milestone_id'],$data['id']);

			

			if(($sumoftaskbudget+$data['budget']) > $milestonebudget)

			{

				$this->session->set_flashdata("errors","Your task budget is more then your milestone's remaining budget limit.");

				$this->session->set_flashdata('addtaskdata',$data);

				redirect('task/edit_task/'.$data['id']);

			}

			$this->task_model->set_fields($data);

			$result = $this->task_model->do_update();

			

			$this->session->set_flashdata( "success", "Milestone updated successfully.");

			redirect('task/edit_task/'.$data['id']);

			

		}

	}

	

	

	/*

		Delete Single Task

	*/

	public function single_task_delete($task_id)

	{

		$this->task_model->do_delete($task_id);

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

			$this->task_model->do_delete($data);

		}

		echo 1;

		exit;

	}

	/*public function change_user_status($id,$status)

	{

		if($status == 0)

			$data['status'] = 1;

		else

			$data['status'] = 0;

		

		$this->users_model->changeUserStatus($id,$data);

		

		echo 1;

		exit();

	}*/

}

?>