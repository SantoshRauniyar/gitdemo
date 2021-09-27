<?php
class task_cron extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('task_model');
		$this->load->model('user_role_model');
		$this->load->model('notification_model');
	}
	
	public function invite_user_cron()
	{
		
	}
	
	            public function task_reminder()
	            {
	                    
				         $this->db->select('users.email,taskk.priority,taskk.description,taskk.link,taskk.id,taskk.status,taskk.created_at,users.user_name,program.pro_name,department.dtitle,unit.unit_name,section.section_name,taskk.title,taskk.end_date,taskk.completed_at');
				        $this->db->from('taskk');
				        $this->db->join('program','program.pid=taskk.program','left');
				        $this->db->join('section','section.id=taskk.section','left');
				        $this->db->join('unit','unit.id=taskk.unit','left');
				        $this->db->join('department','department.did=taskk.department','left');
				        $this->db->join('users','users.id=taskk.created_by','left');
				        $res=$this->db->get();
				        $data['tasklisto']=$res->result();
				        
                                   foreach($data['tasklisto'] as $value)
				                        {
				                        	$end_date = strtotime($value->end_date);
											$completed_at = strtotime($value->completed_at);
											$date=strtotime(date('d-m-Y'));

				                        
				                            if($end_date<$date and $value->status<=2){
				                                
				                                //echo$value->id;
				                                 
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/cron_email.html");
					$emailBody = str_replace("<@edate@>",$value->end_date,$emailBody);
					$emailBody = str_replace("<@id@>",$value->id,$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
					$emailBody = str_replace("<@title@>",$value->title,$emailBody);
				//	$emailBody = str_replace("<@pro_name@>",$pro_name,$emailBody);
					//	$emailBody = str_replace("<@dept_name@>",$dept_name,$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@kizaku.haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Warning Pending Task", $emailBody, $headers))
					{
						echo "email not sent";
						$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
					else
					{
					    echo'mail sent'.'<br>'.$value->email.' Task Name '.$value->title;
					}
					
				
					
					
				}
				else 
				{
					echo"InValid Email";
					$this->session->set_flashdata( "errors", "Please enter valid email address.");
			
				}
				         
			}
				                                 }
				                            }
				                        }
				                        
				                        
				                        
				                        public function set_notification_cron()
				                        {
				                            
								$this->db->select('id,first_name,last_name');
								$this->db->where_not_in('user_role',[22,36,24,37,21]);
								//$this->db->where_not_in('id',);
								$this->db->order_by('user_name','asc');
							$res=$this->db->get('users');
							$users=$res->result();
						
							$birthday_users=$this->notification_model->get_bday_users();
							//var_dump($birthday_users);exit;
							
							foreach($users as $row)//to send these users
							{
							    if(isset($birthday_users) and !empty($birthday_users)){
							    foreach($birthday_users as $bday){//they aree that users who has born day
							        if($bday->id==$row->id)
							        {
							            $message="Happy Birthday".$bday->first_name.' '.$bday->last_name;
							        }
							        else
							        {
							             $message="Wish  ".$bday->first_name.' '.$bday->last_name.'  '.$bday->user_role_name." Today's Birthday ";
							        }
							        
							        //echo $message;
							        date_default_timezone_set('Asia/Kolkata');


							        $data=[
							            'message'=> $message,
							             'to_users'=> $row->id,
							             'bdayId'=>$bday->id,
							             'link'=>'',
							             'date'=>date("d M G:i ")
							            
							            ];
							        $this->notification_model->sent_notification($data);
							    }
							}
							    
							}
							
							
						//	return var_dump($data);
				                            
				                        }
				                        
	
	public function add_task_cron()
	{
		$result = $this->task_model->getalltask();
		if($result)
		{
			foreach($result as $data)
			{
				if($data['recurrence'] == "1")
				{
					if($data['recurrence_start_date'] < date('Y-m-d') && $data['recurrence_end_date'] > date('Y-m-d'))
					{
						if($data['frequency_type'] == '1')
						{	$i=0;
							foreach($result as $data1)
							{
								if($data1['task'] == $data['task'])
								{	
									$i++;
									$get_last_acurrence_date = $data1['date'];
								}	
							}
							
							if($data['no_of_recurrence']+1 >= $i)
							{
								if($data['fix_time'] == 1)
								{
									//echo date('Y-m-d');exit;
									if(strtotime(date('Y-m-d h:i:sa')) >= strtotime($get_last_acurrence_date)+3600)
									{
									//echo $data['no_of_recurrence']+1;
							//echo "<br>".$i;exit;
										unset($data['id']);
										$data['recurrence'] = 2;
										unset($data['recurrence_start_date']);
										unset($data['recurrence_end_date']);
										unset($data['no_of_recurrence']);
										unset($data['fix_time']);
										unset($data['date']);
										unset($data['frequency_type']);
										$this->task_model->set_fields($data);
										$this->task_model->save();
									}
								}
								else if($data['fix_time'] == 2)
								{
									if(strtotime(date('Y-m-d h:i:sa')) >= strtotime($get_last_acurrence_date)+(3600*24))
									{
										unset($data['id']);
										$data['recurrence'] = 2;
										unset($data['recurrence_start_date']);
										unset($data['recurrence_end_date']);
										unset($data['no_of_recurrence']);
										unset($data['fix_time']);
										unset($data['date']);
										unset($data['frequency_type']);
										$this->task_model->set_fields($data);
										$this->task_model->save();
									}
								}
								else if($data['fix_time'] == 3)
								{
									if(strtotime(date('Y-m-d h:i:sa')) >= strtotime($get_last_acurrence_date)+(3600*24*6))
									{
										unset($data['id']);
										$data['recurrence'] = 2;
										unset($data['recurrence_start_date']);
										unset($data['recurrence_end_date']);
										unset($data['no_of_recurrence']);
										unset($data['fix_time']);
										unset($data['date']);
										unset($data['frequency_type']);
										$this->task_model->set_fields($data);
										$this->task_model->save();
									}
								}
								else if($data['fix_time'] == 4)
								{
									if(strtotime(date('Y-m-d h:i:sa')) >= strtotime($get_last_acurrence_date)+(3600*24*7))
									{
										unset($data['id']);
										$data['recurrence'] = 2;
										unset($data['recurrence_start_date']);
										unset($data['recurrence_end_date']);
										unset($data['no_of_recurrence']);
										unset($data['fix_time']);
										unset($data['date']);
										unset($data['frequency_type']);
										$this->task_model->set_fields($data);
										$this->task_model->save();
									}
								}
								else if($data['fix_time'] == 5)
								{
									if(strtotime(date('Y-m-d h:i:sa')) >= strtotime($get_last_acurrence_date)+(3600*24*15))
									{
										unset($data['id']);
										$data['recurrence'] = 2;
										unset($data['recurrence_start_date']);
										unset($data['recurrence_end_date']);
										unset($data['no_of_recurrence']);
										unset($data['fix_time']);
										unset($data['date']);
										unset($data['frequency_type']);
										$this->task_model->set_fields($data);
										$this->task_model->save();
									}
								}
								else if($data['fix_time'] == 6)
								{
									if(strtotime(date('Y-m-d h:i:sa')) >= strtotime($get_last_acurrence_date)+(3600*24*30))
									{
										unset($data['id']);
										$data['recurrence'] = 2;
										unset($data['recurrence_start_date']);
										unset($data['recurrence_end_date']);
										unset($data['no_of_recurrence']);
										unset($data['fix_time']);
										unset($data['date']);
										unset($data['frequency_type']);
										$this->task_model->set_fields($data);
										$this->task_model->save();
									}
								}
								else if($data['fix_time'] == 7)
								{
									if(strtotime(date('Y-m-d h:i:sa')) >= strtotime($get_last_acurrence_date)+(3600*24*30*6))
									{
										unset($data['id']);
										$data['recurrence'] = 2;
										unset($data['recurrence_start_date']);
										unset($data['recurrence_end_date']);
										unset($data['no_of_recurrence']);
										unset($data['fix_time']);
										unset($data['date']);
										unset($data['frequency_type']);
										$this->task_model->set_fields($data);
										$this->task_model->save();
									}
								}
								else if($data['fix_time'] == 8)
								{
									if(strtotime(date('Y-m-d h:i:sa')) >= strtotime($get_last_acurrence_date)+(3600*24*30*12))
									{
										unset($data['id']);
										$data['recurrence'] = 2;
										unset($data['recurrence_start_date']);
										unset($data['recurrence_end_date']);
										unset($data['no_of_recurrence']);
										unset($data['fix_time']);
										unset($data['date']);
										unset($data['frequency_type']);
										$this->task_model->set_fields($data);
										$this->task_model->save();
									}
								}
							}
						}
						
					}
				}
			}
		}
	}
}