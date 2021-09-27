<?php
class index extends Template 
{
	public function __construct() 
	{
		parent::__construct();
		
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		header("Cache-Control: no-store,no-cache, must-revalidate");
		
		$this->load->library('session'); 
		$this->set_header_path('blocks/header1');
		$this->set_template("template_home");
	}
	public function index()
	{
		if(!$this->session->userdata('id')) 
		{
			$this->view("index",array());
		}
		else
		{
			redirect('dashboard/');
		}
	}
}
