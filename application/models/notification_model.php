<?php
class Notification_model extends MY_Generic_Model 
{
	public function __construct()
	{
		// Call the Model constructor
	  	parent::__construct();
	}
	
	public function save()
	{
		return $this->insert($this->tables['notification'],$this->data);
	}
	
	public function count_admin_new_notification()
	{
		$query = $this->query("SELECT count(id)as total_new_notification FROM ".$this->tables['notification']." WHERE to_users LIKE '%admin%' and read_status NOT LIKE '%admin%'");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
	
	public function get_new_notification()
	{
		$query = $this->query("SELECT id,message FROM ".$this->tables['notification']." WHERE to_users LIKE '%admin%' AND read_status NOT LIKE '%admin%' ORDER BY date DESC");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	public function change_Read_satatus()
	{
		$query  = $this->query("UPDATE ".$this->tables['notification']." SET read_status = 'admin,' WHERE to_users LIKE '%admin%' AND read_status NOT LIKE '%admin%' ");
		return $this->db->affected_rows();
	}

	public function sent_notification($data)
	{
				/*$data=[
					'message'=>$message,
					'link'=>$link,
					'to_users'=>$to
				];*/
				$success=$this->db->insert('notification',$data);
				if(isset($success) and !empty($success))
				{
					return true;
				}
				else{
					return false;


				}
	}


                                                public function get_bday_users()
                                                {
                                                    $this->db->select('users.id,users.first_name,users.last_name,users.email,user_roles.user_role_name');
                                                    $this->db->from('users');
                                                    $this->db->join('user_roles','user_roles.id=users.user_role');
                                                    $this->db->where('users.birth_date',date('Y-m-d'));
                                                    $result=$this->db->get();
                                                    $data=$result->result();
                                                    
                                                    if($result->num_rows()>0)
                                                    {
                                                        return $data;
                                                    }
                                                    else
                                                    {
                                                        return false;
                                                    }
                                                }

}
?>