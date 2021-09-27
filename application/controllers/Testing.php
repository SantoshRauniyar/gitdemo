<?php

/**
 * 
 */
class Testing extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('task_model');

	}

	public function set()
	{
		if($this->task_model->changePriorityToHigh())
			echo "Updated";
		else
			echo "string";

	}
}