<?php
class Task_model extends MY_Generic_Model 
{
   public function __construct()
   {
        // Call the Model constructor
	  parent::__construct();
	  $this->load->library('pagination');
	  $this->model_pagination->set_ref($this);
      $this->model_pagination->set_uri_segment(4);
	  $this->model_pagination->set_per_page(10);
	  $this->changePriorityToHigh();
   }
   
   public function admin_gettasklist($sort,$type)
   {
		$fields = 't.id,t.task,t.description,t.milestone_id,(SELECT m.milestone_title FROM '.$this->tables['milestone'].' m WHERE m.id=t.milestone_id)as milestone_title,t.member_id,if(t.member_id like \'user_%\',(SELECT u.user_name FROM '.$this->tables['users'].' u WHERE u.id=replace(t.member_id,\'user_\',\'\')),(SELECT g.groups_title FROM '.$this->tables['groups'].' g WHERE g.id=replace(t.member_id,\'group_\',\'\')))as member_name,t.start_date,t.end_date,t.status,t.budget,t.task_type,t.task_priority,t.task_mode,t.recurrence,(SELECT COUNT(tf.id) FROM '.$this->tables['task_followers'].' tf WHERE tf.task_id = t.id)as total_followers,(SELECT COUNT(tc.task_id) FROM '.$this->tables['task_comments'].' tc WHERE tc.task_id = t.id )as total_comments,(SELECT tc.comment FROM '.$this->tables['task_comments'].' tc WHERE tc.task_id = t.id Order By date desc limit 1)as last_comment,(SELECT tt.task_type_name FROM '.$this->tables['task_type'].' tt WHERE tt.id = t.task_type)as task_type_name';
		$where = " ORDER BY '".$sort."' ".$type;
	   return $this->model_pagination->query_pagination(base_url()."administrator/task/all/",$fields,'task t',$where);
   }
   
   public function gettasklist($sort,$type,$team_id,$user_id)
   {
		$this->model_pagination->set_uri_segment(3);

		$fields = 't.id,t.task,t.description,t.milestone_id,t.member_id,(SELECT m.milestone_title FROM '.$this->tables['milestone'].' m WHERE m.id=t.milestone_id)as milestone_title,t.member_id,if(t.member_id like \'user_%\',(SELECT u.user_name FROM '.$this->tables['users'].' u WHERE u.id=replace(t.member_id,\'user_\',\'\')),(SELECT g.groups_title FROM '.$this->tables['groups'].' g WHERE g.id=replace(t.member_id,\'group_\',\'\')))as member_name,t.start_date,t.end_date,t.status,t.budget,t.task_type,t.task_priority,t.task_mode,t.recurrence,(SELECT COUNT(tf.id) FROM '.$this->tables['task_followers'].' tf WHERE tf.task_id = t.id)as total_followers,(SELECT COUNT(tc.task_id) FROM '.$this->tables['task_comments'].' tc WHERE tc.task_id = t.id )as total_comments,(SELECT tc.comment FROM '.$this->tables['task_comments'].' tc WHERE tc.task_id = t.id Order By date desc limit 1)as last_comment,(SELECT tt.task_type_name FROM '.$this->tables['task_type'].' tt WHERE tt.id = t.task_type)as task_type_name';
		$where = " WHERE (t.member_id='user_".$user_id."' OR t.created_by=".$user_id.") ORDER BY '".$sort."' ".$type;
	   return $this->model_pagination->query_pagination(base_url()."task/all/",$fields,'task t',$where);
   }
   
   
   
   
   public function getfollowingtasklist($sort,$type)
   {
   	$fields = 't.id,t.task';
		$where  = 'ORDER BY '.$sort." ".$type;
		return $this->model_pagination->query_pagination(base_url()."administator/task/following_task_list/",$fields,'task t',$where);
   } 
   
   public function gettaskcommentbyid($task_id)
   {
   		$query = $this->query("SELECT c.id,c.comment,(SELECT u.user_name FROM ".$this->tables['users']." u WHERE u.id=c.user_id)as user_name,(SELECT u.profile_image FROM ".$this->tables['users']." u WHERE u.id=c.user_id)as user_image , c.user_id  FROM ".$this->tables['task_comments']." c WHERE task_id = '".$task_id."'");
		
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
   }
	
	public function gettaskdetailbyid($task_id)
	{
		$query = $this->query("SELECT id,description FROM ".$this->tables['task']." WHERE id='".$task_id."'");
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
   public function gettaskbyid($id)
   {
   		$query = $this->query("SELECT * FROM ".$this->tables['task']." WHERE id=".$id);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
   }

   

   public function get_sum_of_budget($milestone_id,$task_id = null)
   {
   	if($task_id != null) 
	   	$query = $this->query("SELECT sum(budget)as totalbudget FROM ".$this->tables['task']." WHERE milestone_id = '".$milestone_id."' AND id !=".$task_id);
	   else 
	   	$query = $this->query("SELECT sum(budget)as totalbudget FROM ".$this->tables['task']." WHERE milestone_id = '".$milestone_id."'");
	   
	   if($query->num_rows() > 0)
	   	   $result = $query->row_array();
	   else
	   		$result['totalbudget'] = 0; 
	   return  $result['totalbudget'];
   }

   

   public function get_sum($milestone_id,$task_id)

   {

	   $query = $this->query("SELECT sum(budget)as totalbudget FROM ".$this->tables['task']." WHERE milestone_id = '".$milestone_id."' AND id != '".$task_id."'");

	   $result = $query->row_array();

	   return $result['totalbudget'];

   }
   public function getparenttasklist()
   {
   		$query = "SELECT id,task FROM ".$this->tables['task']." WHERE task_mode=1";
		return $this->get_drop_down($query,"id","task","Parent Task");
   }

   public function getalltask()
   {
   		$query = $this->query("SELECT * FROM ".$this->tables['task']);
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
   }
   
   public function getTaskCountByUserId($user_id)
   {
   		$data = array();
   		$query  = $this->query("SELECT COUNT(id)as Total_Completed_Task FROM ".$this->tables['task']." WHERE member_id='user_".$user_id."' AND status = '5'");   
   		$query1 = $this->query("SELECT COUNT(id)as Total_Not_Completed_Task FROM ".$this->tables['task']." WHERE member_id='user_".$user_id."' AND status != '5'");
   		if($query->num_rows() > 0 && $query1->num_rows() > 0)
   		{
   			$res  = $query->row_array();
   			$res1 = $query1->row_array();
   			
   			
   			$data['Total_Completed_Task'] = $res['Total_Completed_Task'];
   			$data['Total_Not_Completed_Task'] = $res1['Total_Not_Completed_Task'];
   			
   			return $data;
   		}
   		else 
   		{
   			return false;
   		}
   }
   
   public function getTaskOldBudget($task_id)
   {
   	$query = $this->query("Select budget FROm ".$this->tables['task']." WHERE id=".$task_id);
   	if($query->num_rows() > 0)
   	{
   		$result = $query->result_array();
   		return $result['budget'];
   	}
   	else 
   	{
   		return 0;
   	}
   }
   
   /* Insert user */

    public function save()
    {
   		return $this->insert($this->tables['task'],$this->data);
	}

	public function do_save_comment()
	{
		return $this->insert($this->tables['task_comments'],$this->data);
	}
	
/* Insert Task Followers */
	public function add_followers()
	{
		return $this->insert($this->tables['task_followers'],$this->data);
	}

	

	/* Update user */

	public function do_update()
	{
		$where['id'] = $this->data['id'];
		unset($this->data['id']);
		$this->update($this->tables['task'],$this->data,$where);
		return $this->db->affected_rows();
	}

	

	/* Delete task */

	public function do_delete($task_id)

	{	

		$where['id'] = $task_id;

		$this->delete($this->tables['task'],$where);

		return;// $this->db->affected_rows();

	}
	
		
	public function changeStatus($id,$status)
	{
		$data = array();
		$where['id'] = $id;
		$data['status'] = $status;
		$this->update($this->tables['task'],$data,$where);
		return $this->db->affected_rows();
	}
	
	        public function get_published_post()
			{
				$res=$this->db->get('content_published');
				$data=$res->result();
				return $data;
			}
			public function lead_list()
			{
				$this->db->select('lead_generation.id,lead_generation.service_type,lead_generation.source,lead_generation.lead_name,lead_generation.lead_code,lead_generation.rdate,lead_generation.created_at,lead_generation.lead_type,lead_generation.status');
				$this->db->from('lead_generation');
			//	$this->db->join('department','department.did=lead_generation.assign_to','left');
				$res=$this->db->get();
				if ($res->num_rows()>0) {
					$data=$res->result();
					return $data;
				}
				else
				{
					return false;
				}

			}


			 public  function lead_list_by_id($id)
			{

					if (!empty($id)) {
						$this->db->where('id',$id);
						$res=$this->db->get('lead_generation');
						if ($res->num_rows()>0) {
							$data=$res->result();
							return $data[0];
						}
						else
						{
							return false;
						}
					}
			}
			
			
public function qualified_lead_list()
			{
				$this->db->select('qualified_lead.id,qualified_lead.priority,qualified_lead.qlead_id,qualified_lead.action_on_lead,qualified_lead.created_at,department.dtitle');
				$this->db->from('qualified_lead');
				$this->db->join('department','department.did=qualified_lead.assigned_for','left');
				$res=$this->db->get();
				if ($res->num_rows()>0) {
					$data=$res->result();
					return $data;
				}
				else
				{
					return false;
				}

			}

				 public  function qlead_list_by_id($id)//qualified list
			{

					if (!empty($id)) {
						$this->db->where('id',$id);
						$res=$this->db->get('qualified_lead');
						if ($res->num_rows()>0) {
							$data=$res->result();
							return $data[0];
						}
						else
						{
							return false;
						}
					}
			}
			          
			          		//get task status 

			public function is_task_approved($id,$status)
			{

					$data=$this->db->select('status')->from('taskk')->where('id',$id)->get()->result();
					if(isset($data) and !empty($data))
					{
					
						 if($data[0]->status==4)
						 return true;
					}
					else
					{
						return false;
					}

			}
			          //call from constructor
			 	public function changePriorityToHigh()
			 	           {
			 	           					

			 	           		$res=$this->db->get('taskk');
				        $data['tasklisto']=$res->result();
				        				
				        				$is_done=0;
                                   foreach($data['tasklisto'] as $value)
				                        {
				                        	$end_date = strtotime($value->end_date);
											$completed_at = strtotime($value->completed_at);
											$date=strtotime(date('d-m-Y'));

				                        
				                            if($end_date<$date and $value->status<=2){
				                                
				                                //echo$value->id;
				                                $arr=[
				                                    'priority'=>4
				                                    ];
				                                    
				                                     $this->db->where('id',$value->id);
				                             $this->db->update('taskk',$arr);
				                             
				                             
				                            }

				                            
				                        }
				       								


			 	           }           



}