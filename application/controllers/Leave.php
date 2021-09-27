<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Leave extends Template
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
		
		$this->load->model('user_classification_model');
		$this->load->model('users_model');
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

                public function apply_leave()
                {
                            	 if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_take_leave'))
	                       	{
                    
                    $data['action']=base_url('/Leave/do_save');
                    $data['heading']="Apply for a Leave";
                    $data['users']=$this->db->select('first_name,last_name,id')->from('users')->get()->result();
                    $data['dept']=$this->db->select('dtitle,did')->from('department')->get()->result();
                    return $this->view('leave/appyleave',$data);
	                       	}
                }
        
        public function do_save()
        {
                           $config = array(
	             		array(
	                     'field'   => 'emp_name', 
	                     'label'   => 'Employee Name', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'emp_id', 
	                     'label'   => 'Employee ID', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'department', 
	                     'label'   => 'Department', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
					  	'field'   => 'assigned', 
	                     'label'  => 'Assigned', 
	                     'rules'  => 'trim|required'
					  ),
					   array(
					  	'field'   => 'reason_to_leave', 
	                     'label'  => 'Reason to Leave', 
	                     'rules'  => 'trim|required'
					  ),
					  array(
					  	'field'   => 's_date', 
	                     'label'  => 'Start Date', 
	                     'rules'  => 'trim|required'
					  ),
					  array(
					  	'field'   => 'e_date', 
	                     'label'  => 'Last Date', 
	                     'rules'  => 'trim|required'
					  ),
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("e_date","s_date","reason_to_leave","assigned","department","emp_id","emp_name");
			
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		
		        $data['emp_name']=$this->session->userdata('user_name');
		         $data['emp_id']=$this->session->userdata('id');
		
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
                	 $data['action']=base_url('/Leave/do_save');
                    $data['heading']="Apply for a Leave";
                    $data['users']=$this->db->select('first_name,last_name,id')->from('users')->get()->result();
                    $data['dept']=$this->db->select('dtitle,did')->from('department')->get()->result();
                    return $this->view('leave/appyleave',$data);
		}
		else
		{
		    $data['created_by']=$this->session->userdata('id');
		    $this->db->insert('leave_emp',$data);
		    redirect('Leave/leave_list/view');
		}
        }
        
                    function leave_list($action)
                    {
                         $this->db->select('leave_emp.*,users.user_name');
	                                    $this->db->from('leave_emp');
	                                    $this->db->join('users', 'users.id=leave_emp.created_by');
	                                    $this->db->where('leave_emp.created_by',$this->session->userdata('id'));
	                                    $res=$this->db->get();
	                                    $data['leavelist']=$res->result();
	                                   
	                                   if (!empty($action)) {
								 	
								 				switch ($action) {
								 					case 'view':
								 	        	 if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_leave'))
	                       	{
								 	$data['view_as']="view_list";
								 	$data['heading']="Leave View List";
								 	return $this->view('leave/list',$data);
	                       	}
								 						break;
								 							case 'edit':
								 							    	 if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_leave'))
	                       	{
								 	$data['heading']="Leave Edit List";
								 	$data['view_as']="edit_list";
								 	return $this->view('leave/list',$data);
	                       	}
								 						break;
								 							case 'delete':
								 							    	 if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_delete_leave'))
	                       	{
								 	$data['heading']="Leave Delete List";
								 	$data['view_as']="delete_list";
								 	return $this->view('leave/list',$data);
	                       	}
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Leave View List";
								 	return $this->view('leave/list',$data);
								 						break;
								 				}


	                                    
	                                }
	                   
                    }
                    
                                        function delete_leave($id)
	                                    {
	                if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_delete_leave'))
	                       	{
	                                        
	                                        $this->db->where('id',$id);
	                                       
	                                        $this->db->delete('leave_emp');
	                                        
	                                        return redirect('/Leave_list/delete');
	                       	}
	                                    }
	                                    
	                                        
	                                        function edit_leave($id)
	                                        {
	                                            
	                                            	 if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_leave'))
	                       	{
	                                             $response['users']=$this->db->select('first_name,last_name,id')->from('users')->get()->result();
                    $response['dept']=$this->db->select('dtitle,did')->from('department')->get()->result();
	                                            $response['heading']=" Edit Leave Form ";
	                                            $response['action']=base_url('Leave/do_update');
	                                            $this->db->where('id',$id);
	                                            $res=$this->db->get('leave_emp');
	                                            $dt=$res->result();
	                                            $response['data']=$dt[0];
	                                            return $this->view('leave/leave_edit',$response);
	                                            
	                       	}
	                                        }
	                                        
	                                        function view_leave($id)
	                                        {
	                                            
	                                            	 if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_leave'))
	                       	{
	                                             $response['users']=$this->db->select('first_name,last_name,id')->from('users')->get()->result();
                    $response['dept']=$this->db->select('dtitle,did')->from('department')->get()->result();
	                                            $response['heading']=" View Leave Form ";
	                                            $response['action']=base_url('Leave/do_update');
	                                            $this->db->where('id',$id);
	                                            $res=$this->db->get('leave_emp');
	                                            $dt=$res->result();
	                                            $response['data']=$dt[0];
	                                            return $this->view('leave/view',$response);
	                       	}
	                                        }
	                                        
	                                         public function do_update()
        {
                           $config = array(
	             		array(
	                     'field'   => 'emp_name', 
	                     'label'   => 'Employee Name', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'emp_id', 
	                     'label'   => 'Employee ID', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'department', 
	                     'label'   => 'Department', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
					  	'field'   => 'assigned', 
	                     'label'  => 'Assigned', 
	                     'rules'  => 'trim|required'
					  ),
					   array(
					  	'field'   => 'reason_to_leave', 
	                     'label'  => 'Reason to Laeve', 
	                     'rules'  => 'trim|required'
					  ),
					  array(
					  	'field'   => 's_date', 
	                     'label'  => 'Start Date', 
	                     'rules'  => 'trim|required'
					  ),
					  array(
					  	'field'   => 'e_date', 
	                     'label'  => 'Last Date', 
	                     'rules'  => 'trim|required'
					  ),
                	);
		$this->form_validation->set_rules($config);
		$fields 	= array ("e_date","s_date","reason_to_leave","assigned","department","emp_id","emp_name");
			
		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
                	 $data['action']=base_url('/Leave/do_save');
                    $data['heading']="Apply for a Leave";
                    $data['users']=$this->db->select('first_name,last_name,id')->from('users')->get()->result();
                    $data['dept']=$this->db->select('dtitle,did')->from('department')->get()->result();
                    return $this->view('leave/appyleave',$data);
		}
		else
		{
		    $data['created_by']=$this->session->userdata('id');
		    $data['updated_by']=$this->session->userdata('id');
		    $id=$this->input->post('id');
		    $this->db->where('id',$id);
		    $this->db->update('leave_emp',$data);
		    redirect('Leave/leave_list/edit');
		}
        }
        
                    public function change_status($status,$id)
                    {
                            	 if($this->session->userdata('user_role')=="Captain")
	                       	{
                                $this->db->where('id',$id);
                                $this->db->update('leave_emp',['status'=>$status]);
                                $this->session->set_flashdata('status','Status has been changed !');
                                
                                $this->db->select('users.email,users.first_name,users.last_name');
                                $this->db->from('leave_emp');
                                $this->db->join('users','users.id=leave_emp.emp_id');
                                $this->db->where('leave_emp.id',$id);
                                $res=$this->db->get();
                                $data=$res->result();
                                $email=$data[0]->email;
                                
                                        if($email!='')
                                        {
                        	if(filter_var($email,FILTER_VALIDATE_EMAIL))
        	{
					$emailBody = file_get_contents("./assets/email/registretionformlink.html");
					$emailBody=str_replace("<@link@>",base_url()."Leave/view_leave/".$id,$emailBody);
					//echo $emailBody;
					$headers = "MIME-Version: 1.0\r\n"; 
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: Kizaku <system@kizaku.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();

					if(!mail($email, "Leave Notification - Approval Link", $emailBody, $headers))
					{
					    					$this->session->set_flashdata('success',"Failed mail".$email);

					    return redirect('Leave/view_leave/'.$id);
					}
					}

					$this->session->set_flashdata('success',"Please check your email Approved Link sent to Your Email:".$email);
           
                         return redirect('Leave/view_leave/'.$id);
            }
                                        
                                        }
                                
                                
                              // return redirect('Leave/view_leave/'.$id);
                            
                    }
        
}