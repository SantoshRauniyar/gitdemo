<?php
class Groups_model extends MY_Generic_Model 
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

	public function admin_getgroupslist($sort,$type)
   {
  	  $fields = 'g.id,g.groups_title,g.description,g.team_id,(SELECT team_title FROM '.$this->tables['team'].' t WHERE t.id=g.team_id)as team_name';
      $where =  ' ORDER BY '.$sort." ".$type;
	  return $this->model_pagination->query_pagination(base_url()."administrator/groups/all/",$fields,'groups g',$where);
   }
   

   public function getgroupslist($sort,$type,$leader_id,$team_id = null)
   {
      $this->model_pagination->set_uri_segment(3);
  	  $fields = 'g.id,g.groups_title,g.description,g.team_id,(SELECT team_title FROM '.$this->tables['team'].' t WHERE t.id=g.team_id)as team_name,g.manager_id,(SELECT u.user_name FROM '.$this->tables['users'].' u WHERE u.id= g.manager_id)as manager_name';
      $where =  " WHERE g.team_id = '".$team_id."'  ORDER BY ".$sort." ".$type;
	  return $this->model_pagination->query_pagination(base_url()."groups/all/",$fields,'groups g',$where);
   }

   public function getgrouplist()
   {
	   $query = "SELECT id,groups_title FROM ".$this->tables['groups'];
		$result = $this->query($query);
		if($result->num_rows() > 0)
		{
			return $result->result();
		}
		return array();
   }

   public function getgroupbyid($id)
   {

   		$query = $this->query("SELECT * FROM ".$this->tables['groups']." WHERE id=".$id);

		if($query->num_rows() > 0)

		{

			return $query->row_array();

		}

		else

		{

			return false;

		}

   }

   public function check_group_leader($manager_id)
   {
   		$query = $this->query("SELECT manager_id FROM ".$this->tables['groups']." WHERE manager_id = '".$manager_id."'");
		if($query->num_rows() > 0)
		{
			return "group_manager";
		}
		else
		{
			return "group_member";
		}
   }
   public function getmembersbyid($id)

   {

	   $query = $this->query("SELECT member_id FROM ".$this->tables['group_members']." WHERE group_id ='".$id."'" );

	   return $query->result_array();

   }
   
   public function isGroupExist($groups_title,$team_id,$id=null)
   {
   		$idcondition = ($id==null)?'':" AND id !=".$id;
   		$query = $this->query("SELECT id FROM ".$this->tables['groups']." WHERE groups_title='".$groups_title."' AND team_id='".$team_id."' ".$idcondition);
   		
   		if($query->num_rows() > 0)
   			return true;
   		else
   			return false;
   }

   /* Insert user */

    public function save()

    {

   		return $this->insert($this->tables['groups'],$this->data);

	}

	

	/* Insert member */

	public function add_members()

	{

		return $this->insert($this->tables['group_members'],$this->data);

	}

	

	/* Update user */

	public function do_update()

	{

		$where['id'] = $this->data['id'];

		unset($this->data['id']);

		$this->update($this->tables['groups'],$this->data,$where);

	}

	

	public function do_delete($id)

	{	$this->do_delete_members($id);

		$where['id'] = $id;

		$this->delete($this->tables['groups'],$where);

		return $this->db->affected_rows();

	}

	public function do_delete_members($id)

	{

		$where['group_id'] = $id;

		$this->delete($this->tables['group_members'],$where);

	}

	        public function  getdept()
		{


				$this->db->select('department.dtitle,users.email,department.did');
				$this->db->from('department');
				$this->db->join('users','users.id=department.manager_id');
			$this->db->order_by('dtitle','asc');
			$res=$this->db->get();
			$data=$res->result();
			return $data;
		}

}	