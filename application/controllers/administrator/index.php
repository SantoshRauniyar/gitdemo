<?php
class index extends Template {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		/*if(!$this->session->userdata('admin_id')) {
			redirect('administrator/authentication/');
		}*/
	}
	
	public function index()
	{
		if(!$this->session->userdata('admin_id')) {
			redirect('administrator/authentication/');
		}
		else
		{
			redirect('administrator/myaccount');
		}

	}
}
?>