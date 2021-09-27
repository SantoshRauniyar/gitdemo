<?php
class Unit_model extends MY_Generic_Model 
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


				public function getunitdropdown()
	{
		$query = "SELECT id,unit_name FROM unit";
		return $this->get_drop_down($query,"id","unit_name","Please");
	}


}	