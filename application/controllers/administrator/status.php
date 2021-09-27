<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Status extends Template
{

	public function __construct()
	{

		parent::__construct();

		$this->load->library('form_validation');

		$this->load->library('session');
		
		$this->load->helper('date');

		$this->load->helper('form');
		
		$this->load->model("status_model");
	}
	
	public function index()
	{
		$this->all();
	}
	
	public function all()
	{
		$this->set_title["title"] = $this->set_title('Status Management');

		$sort = !isset($_REQUEST['sort'])?'status':$_REQUEST['sort'];

		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		

		$userdata = $this->status_model->getstatuslist($sort,$type);

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

		$this->view("administrator/status/status_list",$data);
	}
	
	public function add_status()
	{
		$data = array();

		$this->set_title('Add Status');

		$data 				   	= $this->session->flashdata('addtaskdata');

		$data['projects_list']  = $this->projects_model->getprojectlist();
		
		$data['userlist']		= $this->users_model->getuserdropdown();
		
		$data['grouplist']		= $this->groups_model->getgrouplist();

		$data['task_type_list'] = $this->task_type_model->gettypelist();
		
		$data['parent_task_list'] = $this->task_model->getparenttasklist();
		
		
		$data['mode'] 		 	= "Add";

		$data['action'] 	 	= base_url()."administrator/task/do_save/";

		$data['heading']	 	= "Add Task";

		$this->view("administrator/task/add_edit_task",$data);
	}
	
	public function do_save()
	{
		
	}
	
	public function edit_status()
	{
	}
	
	public function do_update()
	{
	}
	
?>