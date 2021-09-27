<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class visited_leads extends Template
{
    //protected $session_id=$this->session->userdata('id'); 
	public function __construct()
	{
		parent::__construct();
		
		//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		//header("Cache-Control: no-store,no-cache, must-revalidate");
		
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->helper('url', 'form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('plan_model');
		$this->load->model('users_model');
		$this->set_header_path('blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->load->library('merchant');
		$this->load->library('form_validation');
				$this->set_template('template');

		//$this->set_title('Dashboard');
		/*$this->assets_load->add_css(array(base_url('assets/css/bootstrap-datetimepicker.min.css')),"header");
		$this->assets_load->add_js(array(base_url('assets/js/bootstrap-datetimepicker.js'),

										 base_url('assets/js/bootstrap-datetimepicker.fr.js'),

										 base_url('assets/js/vendors/users.js')),"footer");*/
		
		if(!$this->session->userdata('id'))
			redirect("authentication/");
			
			
			
			
           /* if($this->session->userdata('user_role')!=37)
            $this->session->set_flashdata('errors','Sorry Only DFO can use this form');
			redirect("users/taskboard");*/
	}

	
                function up_img($file_name)
                {
                     $config['upload_path'] ='./upload/';
                                   // var_dump($config['upload_path']);
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);
            $this->upload->initialize($config);
        if (!$this->upload->do_upload($file_name)) 
		{
            $error = array('error' => $this->upload->display_errors());
           // return redirect('visited_leads/create');
           $this->session->set_flashdata('errors',validation_errors());
           // var_dump($error);
        } 
		else 
		{
              $data =$this->upload->data();

           return $file_name=$data['file_name'];
           //var_dump($lead);
        }
                }
    
                
                function create()
            {
                        $heading='Visit Lead Form';
                                
                                $did=$this->db->select('district_id')->from('partner')->where('user_id',$this->session->userdata('id'))->get()->result();
                               //var_dump($did);exit();
                               $dis=empty($did[0]->district_id)?'':$did[0]->district_id;
                                $pincode=$this->db->select('pincode')->from('pincode')->where('district_id',$dis)->get()->result();
                                

//var_dump($pincode);exit();
                          return $this->view('visitlead/add',compact('heading','pincode'));
            }
            
                        function do_save()
                        {
                            
                                $config = array(
	             		array(
	                     'field'   => 'lead_comments', 
	                     'label'   => 'lead_comments ', 
	                     'rules'   => 'trim|required'
	                  ),
	                  array(
	                     'field'   => 'lead_name', 
	                     'label'   => 'lead_name', 
	                     'rules'   => 'trim|required'
	                  ),
					  
					 
					  array(
	                     'field'   => 'pincode', 
	                     'label'   => 'Lead Pincode', 
	                     'rules'   => 'trim|required'
	                  ),
	                  array(
	                     'field'   => 'your_comments', 
	                     'label'   => 'your_comments', 
	                     'rules'   => 'trim|required'
	                  ),
				array(
	                     'field'   => 'date', 
	                     'label'   => 'lead Date', 
	                     'rules'   => 'trim|required'
	                  )
					 
                	);
                	
                	//get downwqard user role
                	
                	 
                	
		$this->form_validation->set_rules($config);
		/*$fields 	= array ("business_name","password","birth_date","gender","address","email","contact_person");

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}*/
		
		            $lead=[
		                'lead_comments'=>$this->input->post('lead_comments'),
		                'your_comments'=>$this->input->post('your_comments'),
		                'is_next_visit'=>$this->input->post('is_next_visit'),
		                'created_by'=>$this->session->userdata('id'),
		                'pincode'=>$this->input->post('pincode'),
		                'date'=>$this->input->post('date'),
		                
		                ];
		
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
		//	$this->session->set_flashdata('adduserdata',$data);
			redirect('visited_leads/create');
		}
		
                                else
                                {
                                    $lead['card_pic']=$this->up_img('card_pic');
                                     $lead['shop_pic']=$this->up_img('shop_pic');
                                   if($do=$this->db->insert('visited_lead',$lead))
                                   {
                                      
                                            $this->session->userdata('success','Lead Created Successfully');
                                            return redirect('visited_leads/');
                                       
                                   }
                                      
                                   
                                }
                            
                        }
                        
                        
                        
                        public function index($action=null)
                        {
                            
                            
                           // $this->db->select('id','lead_comments','shop_pic','card_pic');
                           // $this->db->get('visited_lead');
                            $this->db->where('visited_lead.created_by',$this->session->userdata('id'));
                            $data['visited_list']=$this->db->get('visited_lead')->result();
                                
                                switch($action)
                                {
                                    case 'edit':
                                         $data['heading']='Lead Edit List';
                            $data['view_as']='editlist';
                            break;
                            case 'view':
                                         $data['heading']='Lead View List';
                            $data['view_as']='viewlist';
                            break;
                            case 'delete':
                                         $data['heading']=' Lead Delete List';
                            $data['view_as']='deletelist';
                            break;
                            default:
                                         $data['heading']=' Lead View List';
                            $data['view_as']='viewlist';
                            
                                }
                            
                            //var_dump($data['visited_list'][0]);exit();
                            return $this->view('visitlead/index',$data);
                            
                            
                        }
                        
                                    
                                    public function destroy($id)
                                    {
                                                
                                                
                                                
                                                    if($this->db->delete('visited_lead',['id'=>$id]))
                                        {
                                           
                                            $this->session->set_flashdata('success','Visited Lead Delete Successfully');
                                            return redirect('visited_leads/');
                                        }
                            
                                                else
                                                {
                                                    $this->session->set_flashdata('errors','Sorry! You an not destroy this');
                                                return  redirect('visited_leads/');
                                                }
                                        
                                    }
                        
                        
                        
                                            public function edit($id)
                                            {
                                            $data['heading']='Visit Lead Edit Details';
                                               
                       
                                                  $pt=$this->db->where('id',$id)->where('created_by',$this->session->userdata('id'))->get('visited_lead')->result(); 
                                                 $data['visited']=$pt[0];
                                                 
                                                 if(count($pt)>0)
                                                 {
                                                     //var_dump($data);exit();
                                                 return  $this->view('visitlead/edit',$data);
                                                 }
                                                 else
                                                 {
                                                     $this->session->set_flashdata('errors','Sorry Data not found');
                                                     return redirect('visited_leads/index/edit');
                                                 }
                                                 
                                                
                                            }
                                            
                                        
                        
                                    function do_update()
                        {
                            
                                $config = array(
	             		array(
	                     'field'   => 'lead_comments', 
	                     'label'   => 'lead_comments ', 
	                     'rules'   => 'trim|required'
	                  ),
					  
					 
					  array(
	                     'field'   => 'pincode', 
	                     'label'   => 'Lead Pincode', 
	                     'rules'   => 'trim|required'
	                  ),
	                  array(
	                     'field'   => 'your_comments', 
	                     'label'   => 'your_comments', 
	                     'rules'   => 'trim|required'
	                  ),
				array(
	                     'field'   => 'date', 
	                     'label'   => 'lead Date', 
	                     'rules'   => 'trim|required'
	                  )
					 
                	);
                	
                	//get downwqard user role
                	
                	 
                	
		$this->form_validation->set_rules($config);
		/*$fields 	= array ("business_name","password","birth_date","gender","address","email","contact_person");

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}*/
		
		            $lead=[
		                'lead_comments'=>$this->input->post('lead_comments'),
		                'your_comments'=>$this->input->post('your_comments'),
		                'is_next_visit'=>$this->input->post('is_next_visit'),
		                'created_by'=>$this->session->userdata('id'),
		                'pincode'=>$this->input->post('pincode'),
		                'date'=>$this->input->post('date'),
		                
		                ];
		//var_dump($lead);exit();
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "error", validation_errors());
			//unset($data['password']);
		//	$this->session->set_flashdata('adduserdata',$data);
			//redirect('visited_leads/create');
			var_dump(validation_errors());
		}
		
                                else
                                {
                                    
                                    var_dump($this->up_img('shop_pic'));
                                    $lead['shop_pic']=$this->input->post('old_shop_pic');
                                    if(!empty($this->up_img('shop_pic')))
                                    {
                                    $lead['shop_pic']=$this->up_img('shop_pic');
                                            var_dump($lead);
                                    }
                                   
                                    
                                    $lead['card_pic']=$this->input->post('old_card_pic');
                                    if(!empty($this->up_img('card_pic')))
                                    {
                                    $lead['card_pic']=$this->up_img('card_pic');
                                     var_dump($lead);
                                    }
                                    
                                     
                                     
                                   if($do=$this->db->where('id',$this->input->post('id'))->update('visited_lead',$lead))
                                   {
                                      
                                            $this->session->userdata('success','Lead Created Successfully');
                                            return redirect('visited_leads/');
                                       
                                   }else
                                   {
                                       $this->session->set_flashdata('errors','Sorry Something wrong !! Contact Your Admin');
                                       return redirect('visited_leads/index/edit');
                                   }
                                      
                                   
                                }
                            
                        }
                        
                         public function view_visited_lead($id)
                                            {
                                            $data['heading']='Visit Lead Edit Details';
                                               
                       
                                                  $pt=$this->db->where('id',$id)->where('created_by',$this->session->userdata('id'))->get('visited_lead')->result(); 
                                                 $data['visited']=$pt[0];
                                                 
                                                 if(count($pt)>0)
                                                 {
                                                     //var_dump($data);exit();
                                                 return  $this->view('visitlead/view',$data);
                                                 }
                                                 else
                                                 {
                                                     $this->session->set_flashdata('errors','Sorry Data not found');
                                                     return redirect('visited_leads/index/view');
                                                 }
                                                 
                                                
                                            }
                 
                        
                 
                            
                        
                        //Create strong password 
	public function valid_password($password = '')
	{
		$password = trim($password);

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';

		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The Password field is required.');

			return FALSE;
		}

		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The Password field must be at least one lowercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The Password field must be at least one uppercase letter.');

			return FALSE;
		}

		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The Password field must have at least one number.');

			return FALSE;
		}

		if (preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The Password field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>ยง~'));

			return FALSE;
		}

		if (strlen($password) < 5)
		{
			$this->form_validation->set_message('valid_password', 'The Password field must be at least 5 characters in length.');

			return FALSE;
		}

		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'The Password field cannot exceed 32 characters in length.');

			return FALSE;
		}

		return TRUE;
	}

                      
}