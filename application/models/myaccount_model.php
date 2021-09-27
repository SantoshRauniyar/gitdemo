<?php
class Myaccount_model extends MY_Generic_Model 
{   
	public function __construct()   
	{        
		// Call the Model constructor		  
		parent::__construct();   
	}   
	public function getAdminProfile()   
	{		
		$query = $this->query("SELECT id,user_name,first_name,last_name,email,contact_no FROM ".$this->tables['admin']." WHERE id = 1 ");		
		if($query->num_rows() > 0)		
		{			
			return $query->row_array();		
		}		
		return false;   
	}   
	
	public function getadminemail()
	{
		$query = $this->query("SELECT email FROM ".$this->tables['admin']." WHERE id = 1 ");	
		if($query->num_rows() > 0)
			return $query->row_array();
		else
			return false;
	}
	
	public function do_update()   
	{		
		$where['id'] = $this->data['id'];		
		unset($this->data['id']);		
		$this->update($this->tables['admin'],$this->data,$where);		
		return $this->db->affected_rows();   
	}   
	public function update_password()   
	{  		
		$where['id'] 	   = $this->data['id'];		
		$where['password'] = $this->data['old_password'];		
		unset($this->data['id']);		
		unset($this->data['old_password']);		
		$this->update($this->tables['admin'],$this->data,$where);		
		return $this->db->affected_rows();   
	}   
	public function update_user_password()   
	{  		
		$where['id'] 	   = $this->data['id'];		
		$where['password'] = $this->data['old_password'];		
		unset($this->data['id']);		
		unset($this->data['old_password']);		
		$this->update($this->tables['users'],$this->data,$where);		
		return $this->db->affected_rows();   
	}
}