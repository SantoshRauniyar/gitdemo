<?php
class Projects_model extends MY_Generic_Model 
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
   
   public function getprojectslist($sort,$type)
   {
		$fields = 'p.id,p.project_name,p.description,p.team_id,(SELECT t.team_title FROM '.$this->tables['team'].' t WHERE t.id=p.team_id)as team_title,p.start_date,p.end_date,p.no_of_milestone,p.status';
      $where =  ' ORDER BY '.$sort." ".$type;
		return $this->model_pagination->query_pagination(base_url()."administrator/projects/all/",$fields,'projects p',$where);
   }
   
   public function getuserprojectslist($sort,$type,$created_by,$team_id)
   {
   	$this->model_pagination->set_uri_segment(3);
	   $fields = 'p.id,p.project_name,p.description,(SELECT team_title FROM '.$this->tables['team'].' t WHERE t.id = p.team_id)as team_name,p.team_id,p.start_date,p.end_date,p.no_of_milestone,p.status';
      $where =  " WHERE p.team_id = '".$team_id."' AND p.created_by = '".$created_by."' ORDER BY ".$sort." ".$type;
	  return $this->model_pagination->query_pagination(base_url()."projects/all/",$fields,'projects p',$where);
   }

   public function getProjectbyid($id)

   {

   		$query = $this->query("SELECT * FROM ".$this->tables['projects']." WHERE id=".$id);

		if($query->num_rows() > 0)

		{

			return $query->row_array();

		}

		else

		{

			return false;

		}

   }

   

   public function get_no_of_milestone($id)

   {

   		$query = $this->query("SELECT no_of_milestone,budget FROM ".$this->tables['projects']." WHERE id='".$id."'");

		

		if($query->num_rows() > 0)

		{

			return $query->row_array();

		}

   }

   

   public function getprojectbudget($id)

   {

	   $query = $this->query("SELECT budget FROM ".$this->tables['projects']." WHERE id='".$id."'");

	   $result = $query->row_array();

	   return $result['budget'];

   }

	public function getprojectlist($team_id)
	{
		$query = "SELECT id,project_name FROM ".$this->tables['projects']." WHERE team_id='".$team_id."'";
		return $this->get_drop_down($query,"id","project_name","Project");
	}
	
	public function isProjectExist($project_name,$team_id,$id=null)
   	{
   		$idcondition = ($id==NULL)?'':" AND id!=".$id;
   		$query = $this->query("SELECT id FROM ".$this->tables['projects']." WHERE project_name = '".$project_name."' AND team_id='".$team_id."' ".$idcondition);
   		
   		if($query->num_rows() > 0)
   			return true;
   		else 
   			return false;
   	}
   /* Insert user */

    public function save()

    {

   		return $this->insert($this->tables['projects'],$this->data);

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

	

	public function getPrjectList($created_by)
   {
   		$query = "SELECT id,project_name FROM ".$this->tables['projects']." WHERE created_by ='".$created_by."'";
		return $this->get_drop_down($query,"id","project_name","PROJECT NAME");

   }

   

	/* Update user */

	public function do_update()

	{

		$where['id'] = $this->data['id'];

		unset($this->data['id']);

		$this->update($this->tables['projects'],$this->data,$where);

	}

	

	/* Delete Project */

	public function do_delete($id)

	{

		$where['id']  = $id;

		$this->delete($this->tables['projects'],$where);

		return $this->db->affected_rows();

	}
	
	/* Chabge Status of Project */
	public function change_status($project_id,$status)
	{
		$where['id'] 	= $project_id;
		$data['status'] = $status;
		$this->update($this->tables['projects'],$data,$where);
		return $this->db->affected_rows();
	}

}