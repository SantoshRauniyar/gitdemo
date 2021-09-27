<?php
class Task_type_model extends MY_Generic_Model 

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

   

   public function gettasktypelist($sort,$type)

   {

   	  $fields = 'id,task_type_name';

      $where =  'ORDER BY '.$sort." ".$type;

	  return $this->model_pagination->query_pagination(base_url()."administrator/task_type/all/",$fields,'task_type',$where);

   }

   public function gettasktypebyid($id)

   {

   		$query = $this->query("SELECT * FROM ".$this->tables['task_type']." WHERE id=".$id);

		if($query->num_rows() > 0)

		{

			return $query->row_array();

		}

		else

		{

			return false;

		}

   }

   
	public function gettypelist()
	{
		$query = "SELECT id,task_type_name From ".$this->tables['task_type'];
		return $this->get_drop_down($query,"id","task_type_name","Task Type"); 
	}
  
   

   /* Insert user */

    public function save()

    {

   		return $this->insert($this->tables['task_type'],$this->data);

	}

	

	

	

	/* Update user */

	public function do_update()

	{

		$where['id'] = $this->data['id'];

		unset($this->data['id']);

		$this->update($this->tables['task_type'],$this->data,$where);

	}

	

	/* Delete task */

	public function do_delete($task_id)

	{	

		$where['id'] = $task_id;

		$this->delete($this->tables['task_type'],$where);

		return;// $this->db->affected_rows();

	}

}