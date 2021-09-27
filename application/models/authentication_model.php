<?php
class Authentication_model extends MY_Generic_Model 
{
   public function __construct()
   {
        // Call the Model constructor
	  parent::__construct();
   }

	public function do_login()
	{	
		$query = $this->query("SELECT id,user_name FROM ".$this->tables['admin']." WHERE user_name = '".$this->data['admin_name']."' AND password = '".$this->data['password']."'");
		return $query->row_array();		
	}
	
	public function getAdminEmailId()
	{
		$query = $this->query("SELECT email FROM ".$this->tables['admin']." WHERE user_name = 'admin'");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	public function do_userlogin()
	{
		$query = $this->query("SELECT id,user_name,first_name,last_name,email,user_role,profile_image,plan_id,team_id FROM ".$this->tables['users']." WHERE user_name = '".$this->data['user_name']."' AND password = '".$this->data['password']."' AND email = '".$this->data['email']."' AND status=1");
		return $query->row_array();		
	}

	public function getcitydropdown()
	{
		$query = "SELECT id,city FROM ".$this->tables['city'];
		return $this->get_drop_down($query,"id","city","Select Your City");
	}
	
	public function getstatedropdown()
	{
		$query = "SELECT id,state FROM ".$this->tables['state'];
		return $this->get_drop_down($query,"id","state","Select Your State");
	}

	public function getcountrydropdown()
	{
		$query = "SELECT id,country FROM ".$this->tables['country'];
		return $this->get_drop_down($query,"id","country","Select Your Country");
	}
	
	public function getdistrictdropdown()
	{
		$query = "SELECT id,district_name FROM district";
		return $this->get_drop_down($query,"id","district_name","Select Your District");
	}
	//unassigned users to set the role
	public function getusersdropdown()
	{
		$query = "SELECT id,user_name FROM users WHERE user_role=0  AND created_by=".$this->session->userdata('id')."  order by user_name asc";
		return $this->get_drop_down($query,"id","user_name","Select Member");
	}
	
	//get user except partners users to use  in task/program/department/milestone/section/unit
	public function getusersExceptPartners()
	{
		$query = "SELECT id, concat(first_name,' ',last_name) as user_name FROM users  where user_role not in(22,36,24,37,21,0) and  created_by=".$this->session->userdata('id')."  order by user_name asc";
		return $this->get_drop_down($query,"id","user_name"," Please ");
	}
	
	public function getProgramHead()
	{
		$query = "SELECT id, concat(first_name,' ',last_name) as user_name FROM users  where user_role=43 and  created_by=".$this->session->userdata('id')."  order by first_name asc";
		return $this->get_drop_down($query,"id","user_name"," Please ");
	}
	
	public function getDepartmentHead()
	{
		$query = "SELECT id, concat(first_name,' ',last_name) as user_name FROM users  where user_role=25 and  created_by=".$this->session->userdata('id')."  order by first_name asc";
		return $this->get_drop_down($query,"id","user_name"," Please ");
	}
	
	
	public function getSectionHead()
	{
		$query = "SELECT id, concat(first_name,' ',last_name) as user_name FROM users  where user_role=26 and  created_by=".$this->session->userdata('id')."  order by first_name asc";
		return $this->get_drop_down($query,"id","user_name"," Please ");
	}
	
	
	public function getUnitHead()
	{
		$query = "SELECT id, concat(first_name,' ',last_name) as user_name FROM users  where user_role=27 and  created_by=".$this->session->userdata('id')."  order by first_name asc";
		return $this->get_drop_down($query,"id","user_name"," Please ");
	}

	public function getSubUnitHead()
	{
		$query = "SELECT id, concat(first_name,' ',last_name) as user_name FROM users  where user_role=27 and  created_by=".$this->session->userdata('id')."  order by first_name asc";
		return $this->get_drop_down($query,"id","user_name"," Please ");
	}
	
	public function getProjectHead()
	{
		$query = "SELECT id, concat(first_name,' ',last_name) as user_name FROM users  where user_role in(43,25,42) and  created_by=".$this->session->userdata('id')."  order by first_name asc";
		return $this->get_drop_down($query,"id","user_name"," Please ");
	}
	
	
	public function getMileHead()
	{
		$query = "SELECT id, concat(first_name,' ',last_name) as user_name FROM users  where user_role in(43,25,42) and  created_by=".$this->session->userdata('id')."  order by first_name asc";
		return $this->get_drop_down($query,"id","user_name"," Please ");
	}
	
	public function taskfollowers()
	{
		$query = "SELECT u.id, concat(u.first_name,' ',u.last_name) as user_name FROM users u left join taskk t on u.id=t.assign_uid  where t.assign_uid is null and u.user_role not in(22,36,24,37,21) and  u.created_by=".$this->session->userdata('id')."  order by u.first_name asc";
		return $this->get_drop_down($query,"id","user_name"," Please ");
	}
	
	public function getprogramdropdown()
	{
		$query = "SELECT pid,pro_name FROM ".$this->tables['program'];
		return $this->get_drop_down($query,"pid","pro_name","Select Your Program");
	}
	
	/*public function getUserData($data)
	{			
		$this->db->select("*");
		$this->db->from("admin");
		$this->db->where($data);
		$query = $this->db->get();
		return $query;		
	}

	public function isPasswordExist($data,$id)
	{			
		$this->db->select("admin_id");
		$this->db->from("admin");
		$this->db->where($data);
		$query = $this->db->get();
		if($query->num_rows > 0){
					return true;			
		}else{
					return false;
		}
	}

	public function isEmailExist($email,$id)
	{			
		$this->db->select("admin_id");
		$this->db->from("admin");
		$this->db->where('email !=', $email);
		$query = $this->db->get();
		if($query->num_rows > 0){
					return true;			
		}else{
					return false;
		}
	}

	public function update($data,$id)



	{	



		$this->db->where('admin_id',$id);



  		$this->db->update('admin',$data);



  		return true;		



	}



	



	public function updatePasswordByEmail($data,$email)



	{	



		$this->db->where('email',$email);



  		$this->db->update('admin',$data);



  		return true;		



	}



	



	public function forgotpassemail($email,$id)



	{			



		$this->db->select("admin_id");



		$this->db->from("admin");



		$this->db->where('email', $email);



		$query = $this->db->get();



		



		if($query->num_rows > 0){



					return true;			



		}else{



					return false;



		}



	}*/



	



}



?>