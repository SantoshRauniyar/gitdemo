<?php
class User_role_model extends MY_Generic_Model 
{
	public function __construct()
    {
       // Call the Model constructor
		parent::__construct();
		$this->load->library('pagination');
		$this->model_pagination->set_ref($this);
		$this->model_pagination->set_uri_segment(4);
		$this->model_pagination->set_per_page(10);
    }
	
	public function getuserrolelist($sort,$type)
    {
		$fields = '*';
		$where =  'ORDER BY '.$sort." ".$type;
		return $this->model_pagination->query_pagination(base_url()."administrator/user_role/all/",$fields,'role_manager',$where);
    }

	public function changestatus($rol_id,$field,$value)
	{
		$where['id'] = $rol_id;
		$data[$field]= $value;
		$this->update($this->tables['role_manager'],$data,$where);
		return $this->db->affected_rows();
    }
   
   public function getdetailsbyid($role_id)
   {
   		$query = $this->query("SELECT groups,project,milestone,task,group_task FROM ".$this->tables['role_manager']." WHERE id=".$role_id);
		
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
   }

   public function getuserrolebyid($id)

   {

   		$query = $this->query("SELECT id,role FROM ".$this->tables['role_manager']." WHERE id=".$id);

		if($query->num_rows() > 0)

		{

			return $query->row_array();

		}

		else

		{

			return false;

		}

   }

   

   public function getTeamLeaderList()

   {

   		$query = "SELECT id,user_name FROM ".$this->tables['users']." WHERE user_role = '1'";

		return $this->get_drop_down($query,"id","user_name","TEAM LEADER");

   }

   public function getmyteamleader()
   {
   		$query = "SELECT id,user_name FROM ".$this->tables['users']." WHERE id NOT IN (SELECT team_leader_id FROM ".$this->tables['team'].") AND user_role = '1'";
		return $this->get_drop_down($query,"id","user_name","TEAM LEADER");
   }

   public function getmemberlist()

   {

   		$query = "SELECT id,user_name FROM ".$this->tables['users']." WHERE user_type = 2";

		return $this->get_drop_down($query,"id","user_name","TEAM MEMBER");

   }

   

   public function getusers()

   {

	   $query = "SELECT id,user_name FROM ".$this->tables['users']." WHERE status=1";
		//$result = $this->query($query);
		return $this->get_drop_down($query,"id","user_name","USER");

   }
   
   public function getuserdropdown()
   {
	   	$query 	= "SELECT id,user_name FROM ".$this->tables['users']." WHERE status=1";
		$result = $this->query($query);
		if($result->num_rows() > 0 )
			return $result->result();
		else
			return false;
   }


   public function getuserbyrole($id)
   {	
		
   				$q="select id,user_name,email from users order by user_name";
   				$result=$this->query($q);
   				if ($result->num_rows() > 0) {
   					return $result->result();
   				}
   				else
   				{
   					return false;
   				}
   }

   /* Insert user */

    public function save()

    {

   		return $this->insert($this->tables['role_manager'],$this->data);

	}

	

	/* Get Image Path */

	public function getImagePath($id)

	{

		$query = $this->query("SELECT profile_image from ".$this->tables['users']." WHERE id='".$id."'");

		if($query->num_rows() > 0)

		{

			return $query->row_array();

		}

		return false;

	}

	

	/* Update user */

	public function do_update()

	{

		$where['id'] = $this->data['id'];

		unset($this->data['id']);

		$this->update($this->tables['role_manager'],$this->data,$where);

	}

	

	/* Delete Users */

	public function do_delete($role_id)
	{	

		$where['id'] = $role_id;

		$this->delete($this->tables['role_manager'],$where);

		return;

	}

	public function changeUserStatus($id,$data)

	{

		$where['id'] = $id;

		$this->update($this->tables['users'],$data,$where);

		return;

	}
	
        function getEmail($uid)
        {

            	$res=$this->db->query('SELECT email FROM users WHERE user_role="Captain" or id IN('.$uid.')');
											$edata=$res->result();
										if ($res->num_rows()>0) {
											
											return $edata;
											//var_dump($edata);
										}
										else
										{
											return false;
											
        }
										}
										
										public function get_username($email)
										{
										        $res=$this->db->select('first_name,last_name')->from('users')->where('email',$email)->get()->result();   
										       return $res[0];
										}
										
		function get_user_name($email)
        {
           $res= $this->get_username($email);
           if(!empty($res))
           {
          // var_dump($res);
              return $res->first_name.' '.$res->last_name;
           }
           else
           {
               return $email;
           }
        }

}