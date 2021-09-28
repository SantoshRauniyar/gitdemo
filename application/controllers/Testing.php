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
		$this->load->model('users_model');
		$this->load->model('sub_unit_model');

	}

	public function set()
	{
		if($this->task_model->changePriorityToHigh())
			echo "Updated";
		else
			echo "string";

	}


		public function is_deptHead()
		{
			var_dump($this->users_model->did_byHead());
		}


		public function getUserDetailsBy()
		{
			$usersformail=$this->sub_unit_model->getUserDetailsBy(17,13,3,30);
			                   	var_dump($usersformail);
			                   	 foreach($usersformail as $value)
			                   	  {
					    		
					    		echo $value->email;

			        	}
		}
}