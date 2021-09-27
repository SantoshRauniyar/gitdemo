<?php
Class Plan_model extends MY_Generic_Model {   
	public function __construct()   
	{
		// Call the Model constructor	  
		parent::__construct();	  
		$this->load->library('pagination');	  
		$this->model_pagination->set_ref($this);     
		$this->model_pagination->set_uri_segment(4);	  
		$this->model_pagination->set_per_page(10);   
	}
	public function getplanslist($sort,$type)   
	{   	  
		$fields = 'id,plan_title,description';
		$where =  'ORDER BY '.$sort." ".$type;	  
		return $this->model_pagination->query_pagination(base_url()."administrator/plan/all/",$fields,'plan',$where);   
	}   
	public function getplanbyid($id)   
	{   		
		$query = $this->query("SELECT * FROM ".$this->tables['plan']." WHERE id=".$id);
		if($query->num_rows() > 0)		
		{			
			return $query->row_array();		
		}		
		else		
		{			
			return false;		
		}   
	}   
	public function getplanfeaturebyid($id)
   {
	   	$query = $this->query("SELECT id,plan_title,validiti_period,price FROM ".$this->tables['plan']." WHERE id=".$id);
	   	if($query->num_rows() > 0)
	   	{
	   		return $query->row_array();
	   	}
	   	else
	   	{
	   		return false;
	   	}
   }
   
   public function get_no_of_team($plan_id)
   {
   		$query = $this->query("SELECT no_of_team FROM ".$this->tables['plan']." WHERE id=".$plan_id);
   		if($query->num_rows() > 0)
   		{
   			return $query->row_array();
   		}
   		else
   		{
   			return false;
   		}
   }
   
   public function get_no_of_user($plan_id)
   {
   	$query = $this->query("SELECT no_of_user_in_team FROM ".$this->tables['plan']." WHERE id=".$plan_id);
   	if($query->num_rows() > 0)
   	{
   		return $query->row_array();
   	}
   	else
   	{
   		return false;
   	}
   }
   
   public function getplans()
   {
	   $query = "SELECT id,plan_title FROM ".$this->tables['plan'];
		return $this->get_drop_down($query,"id","plan_title","PLAN");
   }
   
   public function getPlanList()
   {
   	$query = $this->query("SELECT id,plan_title FROM ".$this->tables['plan']);
   	if($query->num_rows() > 0)
   	{
   		return $query->result_array();
   	} 
   	else 
   	{
   		return array();
   	}
   }
   
   public function getPlanDetails()
   {
   	$query = $this->query("SELECT id,plan_title,validiti_period,no_of_team,no_of_user_in_team,no_of_group,is_timezone_allow,is_currency_allow,is_auto_email,is_member_leave_allow,is_theam_allow FROM ".$this->tables['plan']);
   	if($query->num_rows() > 0)
   		return $query->result_array();
   	else 
   		return array();
   }
   /* Insert user */
    public function save()
    {
   		return $this->insert($this->tables['plan'],$this->data);
	}
	
	
	
	/* Update user */
	public function do_update()
	{
		$where['id'] = $this->data['id'];
		unset($this->data['id']);
		$this->update($this->tables['plan'],$this->data,$where);
	}
	
	public function do_delete($id)
	{
		$where['id'] = $id;
		$this->delete($this->tables['plan'],$where);
		return $this->db->affected_rows();
	}
}