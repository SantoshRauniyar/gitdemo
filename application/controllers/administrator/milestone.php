<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Milestone extends Template
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->model('milestone_model');
		$this->load->model('projects_model');
		$this->set_header_path('administrator/blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->set_template('administrator/template');
		$this->set_title('Project Management');
		
		$this->assets_load->add_css(array(base_url('assets/administrator/css/bootstrap-datetimepicker.min.css')),"header");

		$this->assets_load->add_js(array(base_url('assets/administrator/js/bootstrap-datetimepicker.js'),
													 base_url('assets/administrator/js/bootstrap-datetimepicker.fr.js'),
													 base_url('assets/administrator/js/vendors/milestone.js')),"footer");

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
		$this->set_title["title"] = $this->set_title('Milestone Management');

		$sort = !isset($_REQUEST['sort'])?'milestone_title':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		$userdata = $this->milestone_model->getmilestonelist($sort,$type);

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
		$this->view("administrator/milestone/milestone_list",$data);
	}
	/* 
		Add User Process
	*/
	public function add_milestone()
	{
		$data = array();
		$this->set_title('Add Milestone');
		$data 				 = $this->session->flashdata('addmilestonedata');
		$data['projectlist'] = $this->projects_model->getPrjectList();
		$data['mode'] 		 = "Add";
		$data['action'] 	 = base_url()."administrator/milestone/do_save/";
		$data['heading']	 = "Add Milestone";
		$this->view("administrator/milestone/add_edit_milestone",$data);
	}
	public function do_save()
	{
		$config = array(
	             		array(
	                     'field'   => 'milestone_title', 
	                     'label'   => 'milestone title', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'description', 
	                     'label'   => 'description', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'project_id', 
	                     'label'   => 'project name', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
					  	'field'   => 'budget', 
	                     'label'  => 'budget', 
	                     'rules'  => 'trim|required|numeric'
					  )
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("milestone_title","description","project_id","budget");
			
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			$this->session->set_flashdata('addmilestonedata',$data);
			redirect('administrator/milestone/add_milestone');
		}
		else
		{	
			$no_of_milestone = $this->projects_model->get_no_of_milestone($data['project_id']);
			$countmilestone	 = $this->milestone_model->count_milestone($data['project_id']);
							   
			if($countmilestone['total_milestone'] == $no_of_milestone['no_of_milestone'])
			{
				$this->session->set_flashdata('errors',"Your project milestone limit is over, Please upgrad your project milestone limit.");
				$this->session->set_flashdata('addmilestonedata',$data);
				redirect('administrator/milestone/add_milestone');
			}
			else
			{
				//echo $no_of_milestone['budget'];exit;
				$result = $this->milestone_model->gettotalbudget($data['project_id']);
				$projectbudget = $no_of_milestone['budget']- $result['totalbudget'];
				if($data['budget'] > $projectbudget)
				{
					$this->session->set_flashdata('errors',"Your milestone budget is more then your project's remaining budget limit.");
					$this->session->set_flashdata('addmilestonedata',$data);
					redirect('administrator/milestone/add_milestone');
				}
			}
			$this->milestone_model->set_fields($data);
			$result = $this->milestone_model->save();
			
			if($result > 0)
			{
				$this->session->set_flashdata( "success", "Milestone added successfully.");
				redirect('administrator/milestone/add_milestone');
			}
		}
	}
	
	public function edit_milestone($id)
	{
		$data = array();
		$this->set_title('Edit Milestone');
		
		$adduserdata = $this->milestone_model->getMilestonebyid($id);

		if(!$adduserdata)
			redirect("administrator/milestone/all");
		else
			$data = $adduserdata;

		$data['projectlist'] = $this->projects_model->getPrjectList();;
		$data['mode'] 	= "edit";
		$data['action'] = base_url()."administrator/milestone/do_update";
		$data['heading']= "Edit Milestone";
		$this->view("administrator/milestone/add_edit_milestone",$data);
	}
	public function do_update()
	{
		$config = array(
							array(
	                     'field'   => 'milestone_title', 
	                     'label'   => 'milestone title', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'description', 
	                     'label'   => 'description', 
	                     'rules'   => 'trim|required'
	                  ),
							array(
	                     'field'   => 'project_id', 
	                     'label'   => 'Project Name', 
	                     'rules'   => 'trim|required'
	                  ),
							array(
					  			'field'   => 'budget', 
	                     'label'  => 'budget', 
	                     'rules'  => 'trim|required|numeric'
					  		)
              	);
		$this->form_validation->set_rules($config);

		$fields 	= array ("id","milestone_title","description","project_id","budget");
			
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
			//$this->session->set_flashdata('addprojectdata',$data);
			redirect('administrator/milestone/edit_milestone/'.$data['id']);
		}
		else
		{	
			$projectbudget 		 = $this->projects_model->getprojectbudget($data['project_id']);
			$totalmilestonebudget = $this->milestone_model->get_total_budget($data['project_id'],$data['id']);
			
			if(($totalmilestonebudget+$data['budget']) > $projectbudget)
			{
				$this->session->set_flashdata("errors","Your milestone budget is more then your project's remaining budget limit.");
				redirect('administrator/milestone/edit_milestone/'.$data['id']);
			}
			$this->milestone_model->set_fields($data);
			$result = $this->milestone_model->do_update();
			
			$this->session->set_flashdata( "success", "Milestone updated successfully.");
			redirdo_deleteect('administrator/milestone/edit_milestone/'.$data['id']);
		}
	}
	/*
		Delete milestone
	*/
	public function delete_milestone($id)
	{
		$result = $this->milestone_model->do_delete($id);
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
		redirect("administrator/milestone/all");
	}
	public function delete_multiple()
	{
		$milestones = $this->input->post('chk');
		foreach($milestones as $data)
		{
			$this->milestone_model->do_delete($data);
		}
		echo 1;
		exit;
	}
	public function change_user_status($id,$status)
	{
		if($status == 0)
			$data['status'] = 1;
		else
			$data['status'] = 0;
		
		$this->users_model->changeUserStatus($id,$data);
		echo 1;
		exit();
	}

		function milebyproject()
		{

		if ($pid=$this->input->get('pid')) {
			$this->db->where('project_id',$pid);
			$res=$this->db->get('milestone');
			$miledata=$res->result();

			?>

				
				<?php
											foreach ($miledata as $value) {
										?>
											<option value="<?=$value->id ?>" ><?=$value->milestone_title ?></option>


										<?php
											}


											?>
								

			<?php
		}
	}


}