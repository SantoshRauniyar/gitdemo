<?php
class Milestone_model extends MY_Generic_Model 
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

	public function getmilestonelist($sort,$type)
   {
		$fields = 'm.id,m.milestone_title,m.description,m.project_id,(SELECT p.project_name FROM '.$this->tables['projects'].' p WHERE p.id=m.project_id)as project_name,m.budget';
      $where =  'ORDER BY '.$sort." ".$type;
		return $this->model_pagination->query_pagination(base_url()."administrator/projects/all/",$fields,'milestone m',$where);
   }
	
	public function get_user_project_milestone_list($sort,$type,$created_by,$team_id)
   {
		$this->model_pagination->set_uri_segment(3);
      $fields = 'm.id,m.milestone_title,m.description,m.project_id,(SELECT p.project_name FROM '.$this->tables['projects'].' p WHERE p.id=m.project_id)as project_name,m.budget';
      $where =  " WHERE m.project_id in (SELECT p.id FROM ".$this->tables['projects']." p WHERE p.team_id = '".$team_id."') ORDER BY ".$sort." ".$type;
	   return $this->model_pagination->query_pagination(base_url()."projects/all/",$fields,'milestone m',$where);
   }
   
	public function getMilestonebyid($id)
   {
		$query = $this->query("SELECT * FROM ".$this->tables['milestone']." WHERE id=".$id);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
   }

   public function getMilestonseList($team_id)
	{
  		$query = "SELECT id,milestone_title FROM ".$this->tables['milestone']." WHERE project_id IN (SELECT p.id FROM ".$this->tables['projects']." p  WHERE p.team_id='".$team_id."')";
		return $this->get_drop_down($query,"id","milestone_title","MILESTONE");
   }

   public function getMilestone_By_Project_Id($project_id)
   {
   	//echo "SELECT id,milestone_title FROM ".$this->tables['milestone']." WHERE project_id = ".$project_id;exit;
   	$query = $this->query("SELECT id,milestone_title FROM ".$this->tables['milestone']." WHERE project_id=".$project_id);
		//echo $query->num_rows();
		return $query->result_array();
   }

   public function count_milestone($project_id)
   {
  		$query	= $this->query("SELECT count(id)as total_milestone FROM ".$this->tables['milestone']." WHERE project_id='".$project_id."'");
		return $query->row_array();
   }

   public function gettotalbudget($project_id)
   {
  		$query = $this->query("SELECT sum(budget)as totalbudget FROM ".$this->tables['milestone']." WHERE project_id='".$project_id."'");
		return $query->row_array();
   }
 
   public function get_total_budget($project_id,$id)
   {
	   $query = $this->query("SELECT sum(budget)as total FROM ".$this->tables['milestone']." WHERE project_id = '".$project_id."' AND id != '".$id."'");
	   $result = $query->row_array();
	   return $result['total'];
   }

   public function get_milestone_budget($milestone_id)
	{
	   $query  = $this->query("SELECT budget FROM ".$this->tables['milestone']." WHERE id = '".$milestone_id."'");
	   $result = $query->row_array();
	   return $result['budget'];
   }
  
   public function isMilestoneExist($milestone_title,$project_id,$id=null)
   {
  		$idcondition = ($id==null)?'':" AND id!=".$id;
  		$query = $this->query("SELECT id FROM ".$this->tables['milestone']." WHERE milestone_title = '".$milestone_title."' AND project_id = '".$project_id."' ".$idcondition);
  		if($query->num_rows() > 0)
  			return true;
  		else
  			return false;
	}

   /* Insert user */
	public function save()
	{
		return $this->insert($this->tables['milestone'],$this->data);
	}

	/* Update user */
	public function do_update()
	{
		$where['id'] = $this->data['id'];
		unset($this->data['id']);
		$this->update($this->tables['milestone'],$this->data,$where);
	}

	public function do_delete($id)
	{
		$where['id'] = $id;
		$this->delete($this->tables['milestone'],$where);
		return $this->db->affected_rows();
	}
}