<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Groups extends Template
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->model('team_model');
		$this->load->model('groups_model');
		$this->load->model('users_model');
		$this->set_header_path('administrator/blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->set_template('administrator/template');
		$this->set_title('Group Management');

		$this->assets_load->add_js(array(base_url('assets/administrator/js/vendors/group.js')),"footer");
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
		$this->set_title["title"] = $this->set_title('Group Management');
		$sort = !isset($_REQUEST['sort'])?'groups_title':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		$userdata = $this->groups_model->admin_getgroupslist($sort,$type);

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

		$this->view("administrator/groups/group_list",$data);

	}

	

	/* 

		Add User Process

	*/

	public function add_group()

	{

		$data = array();

		$this->set_title('Add Group');

		$data 				 = $this->session->flashdata('addgroupdata');

		//$data['projectlist'] = $this->projects_model->getPrjectList();

		$data['teamlist']	 = $this->team_model->getteams();

		$data['userlist']	 = $this->users_model->getusers();

		$data['mode'] 		 = "Add";

		$data['action'] 	 = base_url()."administrator/groups/do_save/";

		$data['heading']	 = "Add Group";

		$this->view("administrator/groups/add_edit_group",$data);

	}



	

	public function do_save()

	{

		$config = array(

	             		array(

	                     'field'   => 'group_title', 

	                     'label'   => 'group title', 

	                     'rules'   => 'trim|required'

	                  ),

	            		array(

	                     'field'   => 'description', 

	                     'label'   => 'description', 

	                     'rules'   => 'trim|required'

	                  ),

	            		array(

	                     'field'   => 'team_id', 

	                     'label'   => 'team id', 

	                     'rules'   => 'trim|required'

	                  ),

	            		array(

	                     'field'   => 'manager_id', 

	                     'label'   => 'manager id', 

	                     'rules'   => 'trim|required'

	                  )

						

                	);

		$this->form_validation->set_rules($config);

		$fields 	= array ("group_title","description","team_id","manager_id");

			

		foreach($fields as $field)

		{

			$data[$field] = $this->input->post($field);

		}

		

		if ($this->form_validation->run() == FALSE) 

		{

			$this->session->set_flashdata( "errors", validation_errors());

			//unset($data['password']);

			$this->session->set_flashdata('addgroupdata',$data);

			redirect('administrator/groups/add_group');

		}

		else

		{	

			$this->groups_model->set_fields($data);

			$result = $this->groups_model->save();

			

			if($result > 0)

			{

				$members = $this->input->post('member_id');

				foreach($members as $member)

				{

					$this->groups_model->set_fields(array("group_id"=>$result,"member_id"=>$member));

					$this->groups_model->add_members();

				}

				$this->session->set_flashdata( "success", "Group created successfully.");

				redirect('administrator/groups/add_group');

			}

		}

	}

	

	public function edit_group($id)

	{

		$data = array();

		$this->set_title('Edit Group');

		

		

		$adduserdata = $this->groups_model->getgroupbyid($id);

		if(!$adduserdata)

			redirect("/administrator/groups/all");

		else

			$data = $adduserdata;

			

		$data['teamlist']	 = $this->team_model->getteams();

		$data['userlist']	 = $this->users_model->getusers();

		$data['member_id']	 = $this->groups_model->getmembersbyid($id);

		//print_r($data['member_id']);exit;

		$data['mode'] 		 = "edit";

		$data['action'] 	 = base_url()."administrator/groups/do_update";

		$data['heading']	 = "Edit Group";

		$this->view("administrator/groups/add_edit_group",$data);

	}

	

	public function do_update()

	{

		$config = array(

	             		array(

	                     'field'   => 'group_title', 

	                     'label'   => 'group title', 

	                     'rules'   => 'trim|required'

	                  ),

	            		array(

	                     'field'   => 'description', 

	                     'label'   => 'description', 

	                     'rules'   => 'trim|required'

	                  ),

	            		array(

	                     'field'   => 'team_id', 

	                     'label'   => 'team id', 

	                     'rules'   => 'trim|required'

	                  ),

	            		array(

	                     'field'   => 'manager_id', 

	                     'label'   => 'manager id', 

	                     'rules'   => 'trim|required'

	                  )

						

                	);

		$this->form_validation->set_rules($config);

		$fields 	= array ("id","group_title","description","team_id","manager_id");

			

		foreach($fields as $field)

		{

			$data[$field] = $this->input->post($field);

		}

		

		if ($this->form_validation->run() == FALSE) 

		{

			$this->session->set_flashdata( "errors", validation_errors());

			//unset($data['password']);

			//$this->session->set_flashdata('addprojectdata',$data);

			redirect('administrator/groups/edit_group/'.$data['id']);

		}

		else

		{	

			$this->groups_model->set_fields($data);

			$result = $this->groups_model->do_update();

			$this->groups_model->do_delete_members($data['id']);

				$members = $this->input->post('member_id');

				foreach($members as $member)

				{

					$this->groups_model->set_fields(array("group_id"=>$data['id'],"member_id"=>$member));

					$this->groups_model->add_members();

				}

			$this->session->set_flashdata( "success", "Group updated successfully.");

			redirect('administrator/groups/edit_group/'.$data['id']);

			

		}

	}

	

	/*

		Delete milestone

	*/

	public function single_group_delete($id)

	{

		$result = $this->groups_model->do_delete($id);

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

		redirect("administrator/groups/all");

	}

	

	public function delete_multiple()

	{

		$teams = $this->input->post('chk');

		foreach($teams as $data)

		{

			$this->groups_model->do_delete($data);

		}

		echo 1;

		exit;

	}

}

?>