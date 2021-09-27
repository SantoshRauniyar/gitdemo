<?php
class Section_model extends MY_Generic_Model 
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


				public function getsectiondropdown()
	{
		$query = "SELECT id,section_name FROM section";
		return $this->get_drop_down($query,"id","section_name","Please");
	}


}	