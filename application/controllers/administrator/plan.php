<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Plan extends Template
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		
		$this->load->helper('form');
		$this->load->model('plan_model');
		
		$this->set_header_path('administrator/blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->set_template('administrator/template');
		$this->set_title('Plan Management');

		$this->assets_load->add_js(array(base_url('assets/administrator/js/ckeditor/ckeditor.js'),
										 base_url('assets/administrator/js/vendors/plan.js')),"footer");

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
		$this->set_title["title"] = $this->set_title('Plan Management');

		$sort = !isset($_REQUEST['sort'])?'plan_title':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		$userdata = $this->plan_model->getplanslist($sort,$type);

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
		$this->view("administrator/plan/plans_list",$data);
	}

	/* 

		Add User Process

	*/

	public function add_plan()
	{
		$data = array();
		$this->set_title('Add Plan');
		$data 				 = $this->session->flashdata('addplandata');
		//$data['projectlist'] = $this->projects_model->getPrjectList();
		$data['mode'] 		 = "Add";
		$data['action'] 	 = base_url()."administrator/plan/do_save/";
		$data['heading']	 = "Add Plan";
		$this->view("administrator/plan/add_edit_plan",$data);
	}
	
	public function do_save()
	{
		$config = array(
	             		array(
	                     'field'   => 'plan_title', 
	                     'label'   => 'plan title', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'description', 
	                     'label'   => 'description', 
	                     'rules'   => 'trim|required'
	                  ),
							array(
								'field'   => 'plan_type',
								'label'   => 'plan type',
								'rules'   => 'trim|required'
					  		),
					  		array(
								'field'   => 'price',
								'label'   => 'price',
								'rules'   => 'trim|required'
					  		),	
							array(
								'field'   => 'validiti_period',
								'label'   => 'validiti period',
								'rules'   => 'trim'
					  		),
							array(
								'field'   => 'no_of_team',
								'label'   => 'Allow number of team',
								'rules'   => 'trim|required'
							),
							array(
								'field'   => 'no_of_user_in_team',
								'label'   => 'Allow number of member in team',
								'rules'   => 'trim|required'
							),
							array(
								'field'   => 'no_of_group',
								'label'   => 'Allow number of group',
								'rules'   => 'trim|required'
							),
							array(
								'field'   => 'is_timezone_allow',
								'label'   => 'Allow timezone setting',
								'rules'   => 'trim|required'
							),
							array(
								'field'   => 'is_currency_allow',
								'label'   => 'Allow Multiple type of currency',
								'rules'   => 'trim|required'
							),
							array(
								'field'   => 'is_auto_email',
								'label'   => 'Allow auto email',
								'rules'   => 'trim|required'
							),
							array(
								'field'   => 'is_member_leave_allow',
								'label'   => 'Allow member leave management',
								'rules'   => 'trim|required'
							),
							array(
								'field'   => 'is_theam_allow',
								'label'   => 'Allow theam setting',
								'rules'   => 'trim|required'
							),
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("plan_title","description","plan_type","price","validiti_period","no_of_team","no_of_user_in_team","no_of_group","is_timezone_allow","is_currency_allow","is_auto_email","is_member_leave_allow","is_theam_allow");

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			$this->session->set_flashdata('addplandata',$data);
			redirect('administrator/plan/add_plan');
		}
		else
		{	
			$this->plan_model->set_fields($data);
			$result = $this->plan_model->save();
			if($result > 0)
			{
				$this->session->set_flashdata( "success", "Plan added successfully.");
				redirect('administrator/plan/add_plan');
			}
		}
	}
	
	public function edit_plan($id)
	{
		$data = array();
		$this->set_title('Edit Plan');

		$adduserdata = $this->plan_model->getplanbyid($id);

		if(!$adduserdata)
			redirect("/administrator/plan/all");
		else
			$data = $adduserdata;

		$data['mode'] 	= "edit";
		$data['action'] = base_url()."administrator/plan/do_update";
		$data['heading']= "Edit Paln";
		$this->view("administrator/plan/add_edit_plan",$data);
	}

	public function do_update()
	{
		$config = array(
	             		array(
	                     'field'   => 'plan_title', 
	                     'label'   => 'plan title', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'description', 
	                     'label'   => 'description', 
	                     'rules'   => 'trim|required'
	                  ),
							array(
								'field'   => 'plan_type',
								'label'   => 'plan type',
								'rules'   => 'trim|required'
					  		),
					  		array(
								'field'   => 'price',
								'label'   => 'price',
								'rules'   => 'trim|required'
					  		),
						array(
								'field'   => 'validiti_period',
								'label'   => 'validiti period',
								'rules'   => 'trim'
					  ),
						array(
								'field'   => 'no_of_team',
								'label'   => 'Allow number of team',
								'rules'   => 'trim|required'
						),
						array(
								'field'   => 'no_of_user_in_team',
								'label'   => 'Allow number of member in team',
								'rules'   => 'trim|required'
						),
						array(
								'field'   => 'no_of_group',
								'label'   => 'Allow number of group',
								'rules'   => 'trim|required'
						),
						array(
								'field'   => 'is_timezone_allow',
								'label'   => 'Allow timezone setting',
								'rules'   => 'trim|required'
						),
						array(
								'field'   => 'is_currency_allow',
								'label'   => 'Allow Multiple type of currency',
								'rules'   => 'trim|required'
						),
						array(
								'field'   => 'is_auto_email',
								'label'   => 'Allow auto email',
								'rules'   => 'trim|required'
						),
						array(
								'field'   => 'is_member_leave_allow',
								'label'   => 'Allow member leave management',
								'rules'   => 'trim|required'
						),
						array(
								'field'   => 'is_theam_allow',
								'label'   => 'Allow theam setting',
								'rules'   => 'trim|required'
						),
                	);

		$this->form_validation->set_rules($config);

		$fields 	= array ("id","plan_title","description","plan_type","price","validiti_period","no_of_team","no_of_user_in_team","no_of_group","is_timezone_allow","is_currency_allow","is_auto_email","is_member_leave_allow","is_theam_allow");

			

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}

		

		if ($this->form_validation->run() == FALSE) 

		{

			$this->session->set_flashdata( "errors", validation_errors());

			//unset($data['password']);

			//$this->session->set_flashdata('addprojectdata',$data);

			redirect('administrator/plan/edit_plan/'.$data['id']);

		}

		else

		{	

			$this->plan_model->set_fields($data);

			$result = $this->plan_model->do_update();

			

			$this->session->set_flashdata( "success", "Plan updated successfully.");

			redirect('administrator/plan/edit_plan/'.$data['id']);

			

		}

	}

	

	/*

		Delete milestone

	*/

	public function delete_plan($id)

	{

		$result = $this->plan_model->do_delete($id);

		//echo $result;exit;

		

		if($this->input->is_ajax_request())

		{		

			if($result)

			{

				echo 1;

				exit;

			}

			else

			{

				echo 0;

				exit;

			}

		}

		redirect("administrator/plan/all");

	}

	

	public function delete_multiple()

	{

		$plans = $this->input->post('chk');

		foreach($plans as $data)

		{

			$this->plan_model->do_delete($data);

		}

		echo 1;

		exit;

	}

}

?>