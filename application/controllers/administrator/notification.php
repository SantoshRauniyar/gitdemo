<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Notification extends Template
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('notification_model');
		
		if(!$this->session->userdata('admin_id'))
			redirect("administrator/authentication/");
	}
	public function get_New_Notification()
	{
		$count = $this->notification_model->count_admin_new_notification();
		$data['count'] = $count['total_new_notification'];
		
		$notification_list = $this->notification_model->get_new_notification();
		if(!empty($notification_list))
		{
			$data['notification_list'] = $notification_list;
			$result['status'] = "200";
			$result['data']   = $data;
		}
		else
		{
			$result['status'] = "500";
			$result['Message']= "No more notification.";
		}
		
		echo json_encode($result);
		exit;
	}
	
	public function change_status()
	{
		$data = array();
		$result = $this->notification_model->change_Read_satatus();
		if($result > 0)
		{
			$data['status']  = 200;
			$data['message'] = "success";
		}
		else
		{
			$data['status']  = 500;
			$data['message'] = "error";
		}
		
		echo json_encode($data);
		exit;
	}
}
?>