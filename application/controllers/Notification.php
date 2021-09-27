<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Notification extends Template
{
	public function __construct()
	{
		parent::__construct();
		
		//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		//header("Cache-Control: no-store,no-cache, must-revalidate");
		
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('myaccount_model');
		
		$this->load->model('notification_model');
		$this->load->model('users_model');
		$this->load->model('user_role_model');
		$this->load->model('plan_model');
		$this->set_header_path('blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->load->model('user_classification_model');
		$this->user_classification_model->set_role();
		$this->load->library('merchant');

		$this->set_template('template');

		$this->set_title('Dashboard');
		
		if(!$this->session->userdata('id'))
			redirect("authentication/");

	}

		function set_notification()
		{
			$this->db->select('*');
			$this->db->from('taskk');
			$this->db->where('status',3);
			$this->db->where('reminded',0);
			$this->db->where('assign_uid',$this->session->userdata('id'));
			$res=$this->db->get();
			$data=$res->result();
			if($res->num_rows()>0)
			{

							foreach ($data as $value) {
								
								$emails=$this->user_role_model->getEmail($value->assign_uid.','.$value->created_by);
								echo $value->title;
						
								//var_dump($emails);

								/*foreach($emails as $key=>$email)
								{
									echo "<h4>Mail Sent to </h4>".$email->email.'<br>';
								}*/


								$arr['message']='Your '.$value->title.' task is pending please complete it as soon as possible';
								$arr['to_users']=$value->assign_uid;
								if(!empty($value->link))
								{
									$arr['link']=$value->link;
								}
								else{
									$arr['link']='/users/taskboard';
								}
								
								$this->db->insert('notification',$arr);

								$this->db->where('id',$value->id);
								$this->db->update('taskk',['reminded'=>1]);

							}
			}
			
							$data=$this->db->select('*')->from('notification')->where('read_status',0)->where('to_users',$this->session->userdata('id'))->get()->result();
				return print_r(json_encode(['data'=>'false','message'=>count($data),'data'=>$data]));

			
		}

					/**
					 * This function is used to set the read_status 0 to 1 from Notification Modal
					 * @param id notification_id
					 * @return response  real-time-notification function of Ajax on header page 
					 */
					 
					 public function test()
					{
						
						    $bdayres=$this->db->select('bdayId')->from('notification')->where('id',260)->where('read_status !=',1)->get();
						    $res=$bdayres->result();
						    
						    if($bdayres->num_rows()>0)
						    {
						        
						         $emp_bdayid=$res[0]->bdayId;
						         date_default_timezone_set('Asia/Kolkata');


						         
						         $data=[
						             
						             'message'=>$this->session->userdata('first_name').' '.$this->session->userdata('last__name')." Wishing you Happy Birthday !",
						             'date'=>date("d M  G:i"),
						             'link'=>'',
						             'to_users'=>$emp_bdayid
						             
						             ];
						             $suc=$this->notification_model->sent_notification($data);
						            // $data["success"]=$suc;
						            // var_dump($data);
						      
						        
						    }
						   
						    
						
					}
					 

					public function read_status()
					{
						if($id=$this->input->post('id'))
						{
						    //wishing bday on mouse move
							    $bdayres=$this->db->select('bdayId')->from('notification')->where('id',$id)->where('read_status',0)->get();
						    
							$this->db->where('id',$id);
							$res=$this->db->update('notification',['read_status'=>1]);
							if($res)
							{
							    
							    
							   
						    $res=$bdayres->result();
						    
						    if($bdayres->num_rows()>0)
						    {
						        
						         $emp_bdayid=$res[0]->bdayId;
						         date_default_timezone_set('Asia/Kolkata');


						         
						         $data=[
						             
						             'message'=>$this->session->userdata('first_name').' '.$this->session->userdata('last__name')." Wishing you Happy Birthday !",
						             'date'=>date("d M j G:i"),
						             'link'=>'',
						             'to_users'=>$emp_bdayid
						             
						             ];
						             $suc=$this->notification_model->sent_notification($data);
						            // $data["success"]=$suc;
						            // var_dump($data);
						      
						        
						    }
						    //closed wishing bday on mouse hover or move
								http_response_code(200);
								return print_r(json_encode(['status'=>true,'message'=>'Read Updated']));
							}
							else{

								http_response_code(200);
								return print_r(json_encode(['status'=>false,'message'=>'could not Read Updated']));

							}
						}
					}

}