<?php
class Team_model extends MY_Generic_Model 
{
   public function __construct()
   {
      //Call the Model constructor
	  parent::__construct();
	  $this->load->library('pagination');
	  $this->model_pagination->set_ref($this);
      $this->model_pagination->set_uri_segment(4);
	  $this->model_pagination->set_per_page(10);
   }
   
   public function admin_getteamslist($sort,$type)
   {
   	$this->model_pagination->set_per_page(2);
   	$fields = 't.id,t.team_title,t.description,t.team_leader_id,(SELECT u.user_name FROM '.$this->tables['users'].' u WHERE u.id = t.team_leader_id)as team_leader_name,t.logo_image';
      $where =  ' ORDER BY '.$sort." ".$type;
	   return $this->model_pagination->query_pagination(base_url()."administrator/team/all/",$fields,'team t',$where);
   }

   public function getteamslist($sort,$type,$team_leader_id)
   {
   	$this->model_pagination->set_uri_segment(3);
   	$fields = 't.id,t.team_title,t.description,t.team_leader_id,(SELECT u.user_name FROM '.$this->tables['users'].' u WHERE u.id = t.team_leader_id)as team_leader_name,t.logo_image,t.plan_id,(SELECT p.plan_title FROM '.$this->tables['plan'].' p WHERE p.id = t.plan_id)as plan_title';
      $where =  ' WHERE team_leader_id = '.$team_leader_id.' ORDER BY '.$sort." ".$type;
	   return $this->model_pagination->query_pagination(base_url()."team/all/",$fields,'team t',$where);
   }


	public function getteamlistdropdown($created_by)
	{
		$query = "SELECT id,team_title FROM ".$this->tables['team']." WHERE team_leader_id = '".$created_by."'";

		return $this->get_drop_down($query,"id","team_title","TEAM");
	}
//santosh rauniyar 
	public function count_team()
	{
			$query = $this->db->query('SELECT *FROM team');
			$s=$query->num_rows();
			return$s;

	}
   

   public function getteambyid($leader_id)
   {
   		$query = "SELECT id,team_title FROM ".$this->tables['team']." WHERE team_leader_id = '".$leader_id."'";

		return $this->get_drop_down($query,"id","team_title","TEAM");

   }

   public function getteamDetails($id)
   {
   		$query = $this->query("SELECT id,team_title,description,logo_image,background_image,background_color,panel_heading_color,panel_body_color FROM ".$this->tables['team']." WHERE id=".$id);
   		if($query->num_rows() > 0)
   		{
   			return $query->row_array();
   		}
   		else
   		{
   			return false;
   		}
   }

   public function getteams($leader_id)
   {

	   $query = "SELECT id,team_title FROM ".$this->tables['team']." WHERE team_leader_id = '".$leader_id."' AND group_creation='1'";

		return $this->get_drop_down($query,"id","team_title","TEAM");

   }
   
   public function count_no_of_team($leader_id)
   {
   		$query = $this->query("SELECT count(id)total_team FROM ".$this->tables['team']." WHERE team_leader_id = ".$leader_id);
   		
   		if($query->num_rows() > 0)
   		{
   			return $query->row_array();
   		}
   		else
   		{
   			return false;
   		}
   }
   
   public function getlistteam($team_leader_id)
   {
   		$query = $this->query("SELECT id,team_title FROM ".$this->tables['team']." WhERE team_leader_id=".$team_leader_id);
   		
   		if($query->num_rows() > 0)
   			return $query->result_array();
   		else 
   			return array();
   }
   
   public function isTeamExist($team_title,$team_leader_id,$id=null)
   {
   		$idcondition = ($id==NULL)?'':" AND id!=".$id;
   		$query = $this->query("SELECT id FROM ".$this->tables['team']." WHERE team_title = '".$team_title."' AND team_leader_id='".$team_leader_id."' ".$idcondition);
   		
   		if($query->num_rows() > 0)
   			return true;
   		else 
   			return false;
   }

   /* Insert user */

    public function save()

    {

   		return $this->insert($this->tables['team'],$this->data);

	}

	

	/* Get Image Path */

	public function getImagePath($id)
	{
		$query = $this->query("SELECT logo_image from ".$this->tables['team']." WHERE id='".$id."'");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		return false;
	}
	
	public function getBackgroundImagePath($id)
	{
		$query = $this->query("SELECT background_image from ".$this->tables['team']." WHERE id='".$id."'");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		return false;
	}

	public function check_team_leaderid($leader_id)
	{
		$query = $this->query("SELECT team_leader_id FROM ".$this->tables['team']." WHERE team_leader_id = '".$leader_id."'");
		if($query->num_rows() > 0)
		{
			return "team_leader";
		}
		else
		{
			return "team_member";
		}
	}

	/* Update user */

	public function do_update()

	{

		$where['id'] = $this->data['id'];

		unset($this->data['id']);

		$this->update($this->tables['team'],$this->data,$where);

	}

	public function set_configuration($team_id,$data)
	{
		//unset($this->data['id']);
		$where['id'] = $team_id;
		$this->update($this->tables['team'],$data,$where);
	}
	
	public function getTeamFeatures($team_id)
	{
		$query = $this->query("SELECT multi_groups_creation,multi_time_zone,multi_currency,leave_management,rejoin,mis_chart,theam,limit_member_size,announcements,group_creation,subgroup_creation,group_discussion_board,recurrence_task,subsequent_task,budget_task,task_followers,task_approval,task_discussion,auto_abort,subtask,reassign_task FROM ".$this->tables['team']." WHERE id='".$team_id."'");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	public function do_delete($id)
	{
		$path = $this->getImagePath($id);
		//print_r($path);exit;
		if($path['logo_image'] != '')
		{
			if(file_exists("assets/upload/team/".$path['logo_image']))
			{
				unlink("assets/upload/team/".$path['logo_image']);
			}
		}
		
		$where['id'] = $id;
		$this->delete($this->tables['team'],$where);
		return $this->db->affected_rows();
	}
}	