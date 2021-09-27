<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class chart extends Template
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pyramid_model');
		//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		//header("Cache-Control: no-store,no-cache, must-revalidate");
		
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

		$this->load->library('form_validation');
		$this->load->library('session');

		$this->load->helper('form');

		$this->load->model('task_model');
		
		$this->load->model('team_model');
		$this->load->model('users_model');
        $this->user_classification_model->set_role();
		$this->set_header_path('blocks/header');
		$this->set_template('template');
		$this->set_title('MIS Chart');

		if(!$this->session->userdata('id'))

			redirect("authentication/");

	}

	

	public function index()

	{

		$this->chart();

	}

	

	public function chart()

	{

		$data = array();

		$userlist = $this->users_model->getUserByTeamId($this->session->userdata('team_id'));

		$data['userlist'] = $userlist;

		$data['action']   = base_url().'chart/';

		$this->load->view('chart/chart_template',$data);

	}


		public function Get_DownUsers()
		{
			$arData=[];
			$result=$this->pyramid_model->SectionDown();
			$deptresult=$this->pyramid_model->DepartmentDown();
			$unitresult=$this->pyramid_model->UnitDown();
			echo "<pre>";
			print_r($unitresult);
			exit();
			if(!empty($result))
			{
				$i=0;
				foreach ($result as  $row) {
					$arData[$i]=$row->id;
					$i++;
				}
				//array_push($arData,82);
				echo "<pre>";
			print_r($arData);

			
			//var_dump(in_array(82, $arData));
			}

		}
	

	public function getchartdata($user_id = null)

	{

		$data = array();

		if($user_id != '')

		{

			$taskdetails = $this->task_model->getTaskCountByUserId($user_id);

			if($taskdetails)

			{

				$data['data']   = $taskdetails;

				$data['status'] = "success";

				echo json_encode($data);

				exit;

			}

			else 

			{

				$data['status']  = "error";

				$data['message'] = "No data avaliable for generating chart. ";

				echo json_encode($data);

				exit;

			}

		}

	}


	public function roleCheck()
	{
	    echo'<pre>';
		$this->pyramid_model->usersExceptRole();
	}

}

?>