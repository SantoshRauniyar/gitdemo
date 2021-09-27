<?php

	
	/**
	 * 
	 */
	class program_model extends MY_Generic_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function add_program()
		{
			$arr=[
				'pro_name'=>$this->input->post('pro_name'),
				'logo'=>$this->input->post('logo'),
				'icon'=>$this->input->post('pro_icon'),
				'pro_head'=>$this->input->post('pro_head'),
				'market_off'=>$this->input->post('marketing_off'),
				'it_off'=>$this->input->post('it_off'),
				'acc_off'=>$this->input->post('acc_office'),
				'op_off'=>$this->input->post('operation_off'),
				'estb_off'=>$this->input->post('estb_off'),
				'sales_off'=>$this->input->post('sale_off'),
				'admin_off'=>$this->input->post('admin_off'),
				'team_id'=>29
				
			];
			var_dump($arr);
			if($this->db->insert('program',$arr))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		
		
		public function getprogramdropdown()
	{
		$query = "SELECT pid,pro_name FROM program";
		return $this->get_drop_down($query,"pid","pro_name","Please");
	}
		
	}


?>