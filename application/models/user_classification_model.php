<?php
class User_classification_model extends MY_Generic_Model 
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
	
	public function user_role_list_pagination($sort,$type,$user_id,$team_id)
    {
    	$this->model_pagination->set_uri_segment(3);
		$fields = 'id,user_role_name,description';
		$where =  "WHERE created_by_user_id = '".$user_id."' AND team_id = '".$team_id."' ORDER BY user_role_name asc";
		return $this->model_pagination->query_pagination(base_url()."user_role/all/",$fields,$this->tables['user_roles'],$where);
    }
    
    public function edituser_role_list_pagination($sort,$type,$user_id,$team_id)
    {
    	$this->model_pagination->set_uri_segment(3);
		$fields = 'id,user_role_name,description';
		$where =  "WHERE created_by_user_id = '".$user_id."' AND team_id = '".$team_id."' ORDER BY user_role_name asc";
		return $this->model_pagination->query_pagination(base_url()."user_role/editlist/",$fields,$this->tables['user_roles'],$where);
    }
    
    public function deleteuser_role_list_pagination($sort,$type,$user_id,$team_id)
    {
    	$this->model_pagination->set_uri_segment(3);
		$fields = 'id,user_role_name,description';
		$where =  "WHERE created_by_user_id = '".$user_id."' AND team_id = '".$team_id."' ORDER BY user_role_name asc";
		return $this->model_pagination->query_pagination(base_url()."user_role/deletelist/",$fields,$this->tables['user_roles'],$where);
    }

    public function get_user_role_dropdown($created_by_user_id,$team_id)
    {
    	$query = "SELECT id,user_role_name FROM ".$this->tables['user_roles']." WHERE created_by_user_id=".$created_by_user_id." AND team_id=".$team_id;
    	
    	if($this->session->userdata('user_role')==22)
    	{
    	    		$query = "SELECT id,user_role_name FROM ".$this->tables['user_roles']." WHERE id=24 or id=39";
    	}

    	return $this->get_drop_down($query,"id","user_role_name","USER Role");
    }
    
    public function get_role_privillages($created_by_user_id)
    {
    	$query = $this->query("SELECT id,user_role_name,is_groups,is_task,is_sub_task FROM ".$this->tables['user_roles']." WHERE created_by_user_id = ".$created_by_user_id);
    	if($query->num_rows() > 0)
    	{
    		return $query->result_array(); 
    	}
    	else
    	{
    		return array();
    	}
    }

   public function get_role_details($id,$created_by_user_id)
   {
   		$query = $this->query("SELECT id,user_role_name,description,roles_master FROM ".$this->tables['user_roles']." WHERE id=".$id." AND created_by_user_id=".$created_by_user_id);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
   }
   
   public function getprivillages($user_role_id)
   {
   		$query = $this->query("SELECT * FROM ".$this->tables['user_roles']." WHERE id=".$user_role_id);
   		if($query->num_rows() > 0)
   		{
   			return $query->row_array();
   		}
   		else
   		{
   			return array();
   		}
   }

   public function is_role_exist($user_role_name,$created_by_user_id,$team_id,$id = '')
   {
   		if($id != '')
   		{
   			$query = $this->query("SELECT id FROM ".$this->tables['user_roles']." WHERE id != ".$id." AND user_role_name= '".$user_role_name."' AND created_by_user_id=".$created_by_user_id." AND team_id = ".$team_id);
   		}
   		else
   		{
   			$query = $this->query("SELECT id FROM ".$this->tables['user_roles']." WHERE user_role_name= '".$user_role_name."' AND created_by_user_id=".$created_by_user_id." AND team_id = ".$team_id);
   		}
   		if($query->num_rows() > 0)
   		{
   			return true;
   		}
   		else
   		{
   			return false;
   		}
   }


   /* Insert user */
	public function save()
    {
   		return $this->insert($this->tables['user_roles'],$this->data);
	}



	/* Update user */

	public function do_update()

	{

		$where['id'] = $this->data['id'];

		unset($this->data['id']);

		$this->update($this->tables['user_roles'],$this->data,$where);

	}

	

	/* Delete Users */

	public function do_delete($role_id)
	{	

		$where['id'] = $role_id;

		$this->delete($this->tables['user_roles'],$where);

		return;

	}

	public function changestatus()
	{	//print_r($this->data);exit;
		$where['id'] = $this->data['id'];
		unset($this->data['id']);
		$this->update($this->tables['user_roles'],$this->data,$where);
		return $this->db->affected_rows();
	}

/****
* Code By : Santosh Rauniyar
* check user role available or not
****/
    

      function check_role_auth($role_id,$for_field)
      {


        if($role_id!="Captain")
        {
         $res=$this->db->query("select *from user_roles where id=$role_id");
         if ($res->num_rows()>0) {
         


          $this->db->select("".$for_field."");
          $this->db->from('user_roles');
            $this->db->where('id',$role_id);
            $res=$this->db->get();
            $data=$res->result();
            $data=$data[0];

              if ($data->$for_field==1) {
                return true;
              }
              else
              {
                return false;
              }

            }

      }
      else
      {
        return true;
      }
    }
                            
                            	function set_role()
	{
	    //	$this->set_header_path('administrator/blocks/footer');
			//set role in session
			if ($this->session->userdata('user_role')!="Captain") {
				$this->db->where('id',$this->session->userdata('user_role'));
   				 	$res=$this->db->get('user_roles');
   				  $deliveryData=$res->result_array();
   				 $deliveryData=$deliveryData[0];
   		//	$this->session->set_userdata('deliverdata1', $deliveryData);         #to set the session with the above array
   		
   			$_SESSION['deliverdata1']=$deliveryData;
				return $_SESSION['deliverdata1'];
   						 ### for retrieving the session values ###
   	  	// $deliveryData   = $this->session->userdata('deliverdata1');          #will return the whole array
			}
	}
	
	
	/**
	 * We get database's ID+1 as New ID
	 *
	 **/
	    function getIdExsitPlusOne($column_name,$table_name)
							{
								$res=$this->db->query("select max($column_name) as'code' FROM ".$table_name."");
								//$this->db->from('content_production_order');
								//$res=$this->db->get();
								$data=$res->result();
								$data=$data[0];
										$digit=$data->code;
										$max=$digit;					
								 //$max = str_pad($max+1, 5, '0', STR_PAD_LEFT);
								if($max>0)
								{
								 	return $max+1;
								}
								else
								{
								    return $max=1;
								}
								}
								
								
								function get_pins($cid)
								{
								    $data=$this->db->select('pincode')->where('city_id',$cid)->from('pincode')->get()->result();
								    if(!empty($data))
								    {
								        return $data;
								    }
								    else
								    {
								        return false;
								    }
								}
								            
								            public function is_head($columnName,$tableName)
								            {
								                
								                $this->db->select('*');
								                $this->db->from($tableName);
								                $this->db->where($columnName,$this->session->userdata('id'));
								                $res=$this->db->get();
								                $data=$res->result();
								               if($res->num_rows()>0)
								               {
								                   return $data;
								               }
								               else
								               {
								                  return  false;
								               }
								                
								            }
								            
								            
								            
				 function get_task_details($coltype,$colVal,$status_code,$for_count_coulmn,$status,$end_date=null,$start_date=null)
			{

						//$end= new DateTime($end_date);
						//$start= new DateTime($start_date);
                        $res=$this->user_classification_model->is_head('pro_head','program');
				    $this->db->select('count('.$for_count_coulmn.') as '.$status.'');
					$this->db->from('taskk');
					if($status_code<7){
					$this->db->where($for_count_coulmn,$status_code);}

					//$this->db->where('assign_uid',$this->session->userdata('id'));
					$this->db->where($coltype,$colVal);
					if(!empty($end_date))
					{$this->db->where('taskk.start_date >=',$start_date);
					$this->db->where('taskk.end_date <=',$end_date);}

					$res=$this->db->get();
					$data=$res->result();
					$data=$data[0];
					return $data->$status;
			}       
								
								
}