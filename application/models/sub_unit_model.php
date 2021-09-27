<?php
class Sub_unit_model extends MY_Generic_Model 
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


				public function getsubunitdropdown()
	{
		$query = "SELECT id,sub_uname FROM sub_unit";
		return $this->get_drop_down($query,"id","sub_uname","Sub Unit");
	}


}	