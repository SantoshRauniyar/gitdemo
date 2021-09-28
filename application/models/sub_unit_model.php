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

	public function followers($id)
	{
		$this->db->select('first_name,last_name,id');
		$this->db->from('users');
		$this->db->where_in('user_role',[12,28]);
		$this->db->where_not_in('id',$id);
		$res=$this->db->get();
		if($res->num_rows()>0)
		{
			$data=$res->result();
			return $data;
		}
		else
		{
			return false;
		}
	}


		 public function  do_save($input)
		 {

								if($this->db->insert('sub_unit',$input))
								{
									$this->session->set_flashdata('success','Sub Unit Saved Successfully');
									return $this->db->insert_id();
								}
								else
								{
									return false;
								}
		 }

		 			public function  do_update($input)
		 {
		 						
		 						$this->db->where('id',$input['id']);
								if($this->db->update('sub_unit',$input))
								{
									$this->session->set_flashdata('success','Sub Unit Update Successfully');
									return true;
								}
								else
								{
									return false;
								}
		 }


		 			public function getUserDetailsBy($pid,$did,$sid,$uid,$suid=null,$head=null)
		 			{
		 				$this->db->select('users.id,users.first_name,users.last_name,users.email,program.pro_name as title');
		 				$this->db->from('users');
		 				$this->db->join('program','program.pro_head=users.id');
		 				$this->db->where('program.pid',$pid);

		 					$res=$this->db->get();
		 					$program=$res->result();
		 					$department=$this->getdeptusers($did);
		 					$section=$this->getsecusers($sid);
		 					$unit=$this->getunitusers($uid);
		 					$subunit=$this->getsubunitusers($suid);

		 					$headuser=$this->getsubunitusers($head);
		 					$final=array_merge($program,$department,$section,$unit,$subunit,$headuser);
		 				return $final;
		 			}

		 			//these all function return user's details according to function
		 				public function getdeptusers($did)
		 			{
		 				$this->db->select('users.id,users.first_name,users.last_name,users.email, department.dtitle as title');
		 				$this->db->from('users');
		 				$this->db->join('department','department.manager_id=users.id');
		 				$this->db->where('department.did',$did);

		 					$res=$this->db->get();
		 				return $res->result();
		 			}


		 				public function getsecusers($sid)
		 			{
		 				$this->db->select('users.id,users.first_name,users.last_name,users.email, section.section_name as title');
		 				$this->db->from('users');
		 				$this->db->join('section','section.section_head=users.id');
		 				$this->db->where('section.id',$sid);

		 					$res=$this->db->get();
		 				return $res->result();
		 			}

		 				public function getunitusers($uid)
		 			{
		 				$this->db->select('users.id,users.first_name,users.last_name,users.email, unit.unit_name as title');
		 				$this->db->from('users');
		 				$this->db->join('unit','unit.uhead=users.id');
		 				$this->db->where('unit.id',$uid);

		 					$res=$this->db->get();
		 				return $res->result();
		 			}


		 				public function getsubunitusers($suid)
		 			{
		 				$this->db->select('users.id,users.first_name,users.last_name,users.email, sub_unit.sub_uname as title');
		 				$this->db->from('users');
		 				$this->db->join('sub_unit','sub_unit.sub_uhead=users.id');
		 				$this->db->where('sub_unit.id',$suid);

		 					$res=$this->db->get();
		 				return $res->result();
		 			}


		 				public function getheadusers($head)
		 			{
		 				$this->db->select('users.id,users.first_name,users.last_name,users.email, users.user_name as title');
		 				$this->db->from('users');
		 				$this->db->where('users.id',$head);

		 					$res=$this->db->get();
		 				return $res->result();
		 			}



		 			public function getallsubunit($uid)
		 			{		


		 		$this->db->select('sub_unit.*, program.pro_name,department.dtitle,section.section_name,unit.unit_name,sub_unit.sub_uname');
		 					$this->db->from('sub_unit');
		 					$this->db->join('program','program.pid=sub_unit.program_id','left');
		 					$this->db->join('department','department.did=sub_unit.department_id','left');
		 					$this->db->join('section','section.id=sub_unit.section_id','left');
		 					$this->db->join('unit','unit.id=sub_unit.unit_id','left');
		 					$this->db->where('sub_unit.unit_id',$uid);
		 					$res=$this->db->get();
		 					if($res->num_rows()>0)
		 					{
		 						return $res->result();
		 					}
		 					else
		 					{
		 						return false;
		 					}
		 					}


		 					public function destroy($id)
		 					{
		 						$this->db->where('id',$id);
		 						if($this->db->delete('sub_unit'))
		 							return true;
		 						else 
		 							return false;
		 					}

		 					public function getdatabyId($value)
		 					{
		 						
		 						$this->db->where('id',$value);
		 						$res=$this->db->get('sub_unit');
		 						if($res->num_rows()>0)
		 						{
		 							$data=$res->result();
		 							return $data[0];
		 						}
		 						else
		 						{
		 							return false;
		 						}
		 					}
		 			
}	