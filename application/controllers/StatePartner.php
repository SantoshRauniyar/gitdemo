<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class StatePartner extends Template
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
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('plan_model');
		$this->load->model('users_model');
		$this->load->model('user_classification_model');

		$this->load->model('users_model');
	
		$this->user_classification_model->set_role();
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
		
		if(!$this->session->userdata('user_role'))
			redirect("authentication/");

	}

	

    
                
                function create()
            {
                
                            $this->session->userdata('user_role');$data['stateData']=$this->users_model->get_state_ByUid();
                    
                            $heading='state Partner Officer';
                            $assign_role=21;
                            $loc=21;
                           $cdata=$this->users_model->get_country_ByUid();
                                                    //var_dump($cdata->id);exit();
                             $data['statelist']=$this->db->select('id,state')->from('state')->where('country_id',$cdata->id)->order_by('state','asc')->get()->result();
                                   
                                           $action=base_url('StatePartner/do_save');        
                                                   
                
                
                $this->view('partner/state/add',compact('heading','assign_role','data','loc','action'));
            }
            
                        function do_save()
                        {
                            
                                $config = array(
	             		array(
	                     'field'   => 'business_name', 
	                     'label'   => 'Business name', 
	                     'rules'   => 'trim|required|is_unique[partner.business_name]'
	                  ),
					  array(
	                     'field'   => 'password', 
	                     'label'   => 'password', 
	                     'rules'   => 'callback_valid_password'
	                  ),
					  array(
	                     'field'   => 'cpassword', 
	                     'label'   => 'confirm password', 
	                     'rules'   => 'trim|required|matches[password]'
	                  ),
					 
					  array(
	                     'field'   => 'birth_date', 
	                     'label'   => 'birth date', 
	                     'rules'   => 'trim|required'
	                  ),
	                  array(
	                     'field'   => 'revenue', 
	                     'label'   => 'revenue', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'gender', 
	                     'label'   => 'gender', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'address', 
	                     'label'   => 'address', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'email', 
	                     'label'   => 'email address', 
	                     'rules'   => 'trim|required|valid_email|is_unique[users.email]'
	                  ),
	                  array(
	                     'field'   => 'user_name', 
	                     'label'   => 'User Name', 
	                     'rules'   => 'trim|required|is_unique[users.user_name]'
	                  ),
	                  array(
	                     'field'   => 'phone', 
	                     'label'   => 'Contact Person Phone', 
	                     'rules'   => 'trim|required'
	                  ),
	                  array(
	                     'field'   => 'contact_person_name', 
	                     'label'   => 'Contact Person Name', 
	                     'rules'   => 'trim|required'
	                  ),
	                  
	                  array(
	                     'field'   => 'state', 
	                     'label'   => 'state', 
	                     'rules'   => 'trim|is_unique[partner.state_id]'
	                  ),
	                  array(
	                     'field'   => 'state', 
	                     'label'   => 'State', 
	                     'rules'   => 'trim|is_unique[partner.state_id]'
	                  ),
	                  array(
	                     'field'   => 'district', 
	                     'label'   => 'District', 
	                     'rules'   => 'trim|is_unique[partner.district_id]'
	                  ),array(
	                     'field'   => 'city', 
	                     'label'   => 'city', 
	                     'rules'   => 'trim|is_unique[partner.city_id]'
	                  )
					 
                	);
                	
                	//get downwqard user role
                	
                	 
                	
		$this->form_validation->set_rules($config);
		/*$fields 	= array ("business_name","password","birth_date","gender","address","email","contact_person");

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}*/
		
		            $userCred=[
		                'email'=>$this->input->post('email'),
		                'password'=>md5($this->input->post('password')),
		                'address'=>$this->input->post('address'),
		                'created_by'=>$this->session->userdata('id'),
		                'user_role'=>21,
		                'user_name'=>$this->input->post('user_name'),
		                'birth_date'=>$this->input->post('birth_date'),
		                'gender'=>$this->input->post('gender'),
		                'state_id'=>$this->input->post('state'),
		                'state_id'=>$this->input->post('state'),
		                'district'=>$this->input->post('district'),
		                'city_id'=>$this->input->post('city')
		                ];
		
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
		//	$this->session->set_flashdata('adduserdata',$data);
			redirect('/StatePartner/create');
		}
		
                                else
                                {
                                   if($do=$this->db->insert('users',$userCred))
                                   {
                                       //address	user_id	contact_person	phone	
                                       $user_id=$this->db->insert_id();
                                       $business_details=[
                                           'business_name'=>$this->input->post('business_name'),
                                           'address'=>$this->input->post('address'),
                                           'contact_person'=>$this->input->post('contact_person_name'),
                                           'revenue'=>$this->input->post('revenue'),
                                           'phone'=>$this->input->post('phone'),
                                           'user_id'=>$user_id,
                                           'state_id'=>$this->input->post('state'),
		                                    'state_id'=>$this->input->post('state'),
		                                    'district_id'=>$this->input->post('district'),
		                                    'city_id'=>$this->input->post('city'),
		                                    'created_by'=>$this->session->userdata('id')
                                           ];
                                       if($this->db->insert('partner',$business_details))
                                       {
                                           $this->session->set_flashdata('success');
                                          return redirect('StatePartner/index/view');
                                       }
                                       else
                                       {
                                           //$this->db->where('id',$user_id);
                                           $this->db->delete('users',['id'=>$user_id]);
                                       }
                                   }
                                }
                            
                        }
                        
                        
                        
                        public function index($action=null)
                        {
                            
                            if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_state_partner'))
                            {
                            
                            $data['main_heading']='state Partner';
                     
                            $this->db->select('partner.id,users.email,users.status,partner.business_name,state.state,state.state,district.district_name,city.city,partner.contact_person,users.user_name');
                            $this->db->from('partner');
                            $this->db->join('state','state.id=partner.state_id','left');
                            $this->db->join('city','city.id=partner.city_id','left');
                            $this->db->join('district','district.id=partner.district_id','left');
                            $this->db->join('users','users.id=partner.user_id');
                            $this->db->where('users.user_role',21);
                           // $this->db->where('partner.created_by',$this->session->userdata('id'));
                            $data['partnerlist']=$this->db->get()->result();
                                
                                         $data['heading']='View List';
                            $data['view_as']='viewlist';
                        
                            
                            
                            return $this->view('partner/state/index',$data);
                            }
                            else
                            {
                                $this->session->set_flashdata('errors','Sorry You have not Permission');
                                return redirect('users/taskboard'); 
                            }
                            
                        }
                        
                        
                        
                        
                        public function edit_list()
                        {
                            
                            if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_state_partner'))
                            {
                            
                            $data['main_heading']='state Partner';
                     
                            $this->db->select('partner.id,users.email,users.status,partner.business_name,state.state,state.state,district.district_name,city.city,partner.contact_person,users.user_name');
                            $this->db->from('partner');
                            $this->db->join('state','state.id=partner.state_id','left');
                            $this->db->join('city','city.id=partner.city_id','left');
                            $this->db->join('district','district.id=partner.district_id','left');
                            $this->db->join('users','users.id=partner.user_id');
                            $this->db->where('users.user_role',21);
                            $this->db->where('partner.created_by',$this->session->userdata('id'));
                            $data['partnerlist']=$this->db->get()->result();
                                
                                         $data['heading']='Edit List';
                            $data['view_as']='editlist';
                        
                            
                            
                            return $this->view('partner/state/index',$data);
                            }
                            else
                            {
                                $this->session->set_flashdata('errors','Sorry You have not Permission');
                                return redirect('users/taskboard'); 
                            }
                            
                        }
                        
                        
                        
                        
                        public function delete_list()
                        {
                            
                            if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_state_partner'))
                            {
                            
                            $data['main_heading']='state Partner';
                     
                            $this->db->select('partner.id,users.email,users.status,partner.business_name,state.state,state.state,district.district_name,city.city,partner.contact_person,users.user_name');
                            $this->db->from('partner');
                            $this->db->join('state','state.id=partner.state_id','left');
                            $this->db->join('city','city.id=partner.city_id','left');
                            $this->db->join('district','district.id=partner.district_id','left');
                            $this->db->join('users','users.id=partner.user_id');
                            $this->db->where('users.user_role',21);
                            $this->db->where('partner.created_by',$this->session->userdata('id'));
                            $data['partnerlist']=$this->db->get()->result();
                                
                                         $data['heading']='Delete List';
                            $data['view_as']='deletelist';
                        
                            
                            
                            return $this->view('partner/state/index',$data);
                            }
                            else
                            {
                                $this->session->set_flashdata('errors','Sorry You have not Permission');
                                return redirect('users/taskboard'); 
                            }
                            
                        }
                        
                                    
                                    public function destroy($id)
                                    {
                            
                            
                             if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_state_partner'))
                            {
                                                                     $isExist=$this->db->select('user_id')->from('partner')->where('id',$id)->where('created_by',$this->session->userdata('id'))->get()->result();
                                                if(!empty($isExist[0]->user_id))
                                                {
                                                    if($this->db->delete('partner',['id'=>$id]) and $this->db->delete('users',['id'=>$isExist[0]->user_id]))
                                        {
                                           
                                            $this->session->set_flashdata('success','Partner Delete Successfully');
                                            return redirect('StatePartner/edit_list/');
                                        }
                                                }
                                                else
                                                {
                                                    $this->session->set_flashdata('errors','Sorry! You an not destroy this');
                                                return  redirect('StatePartner/');
                                                }
                            }
                            else
                            {
                                 $this->session->set_flashdata('errors','Sorry You have not Permission');
                                return redirect('users/taskboard'); 
                            }
                            
                                    }
                        
                        
                        
                                            public function edit_partner($id)
                                            {
                                            
                            if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_state_partner'))
                            {
                                            
                                            $data['stateData']=$this->users_model->get_state_ByUid();
                        
                                            $data['statelist']=$this->db->select('id,state')->from('state')->order_by('state','asc')->get()->result();
	                                                    
                          
                                                    $cdata=$this->users_model->get_state_ByUid();
                                                $data['statelist']=$this->db->select('id,state')->from('state')->order_by('state','asc')->get()->result();
                                    
                                                    $cdata=$this->users_model->get_state_ByUid();
                            $data['districtlist']=$this->db->select('id,district_name')->from('district')->order_by('district_name','asc')->get()->result();
                            
                           
                                                    $cdata=$this->users_model->get_district_ByUid();
                                                   // var_dump($cdata);exit();
                            $data['citylist']=$this->db->select('id,city')->from('city')->order_by('city','asc')->get()->result();
                            $heading='State Field  Officer Edit';
                            $assign_role=37;
                           
                
                                                    //$userID=$this->db->select('user_id')->from('partner')->where('id',$id)->where('created_by',$this->session->userdata('user_role'))->get()->result();
                                                  $pt=$this->db->where('id',$id)->where('created_by',$this->session->userdata('id'))->get('partner')->result(); 
                                                 $data['partner']=$pt[0];
                                                 return  $this->view('partner/state/edit',compact('data','heading'));
                                                
                                            
                                            
                                            }
                                            else
                                            {
                                 $this->session->set_flashdata('errors','Sorry You have not Permission');
                                return redirect('users/taskboard'); 
                                            }
                                }
                                            
                                        
                            function do_update()
                        {
                            
                                $config = array(
	             		array(
	                     'field'   => 'business_name', 
	                     'label'   => 'Business name', 
	                     'rules'   => 'trim|required'
	                  ),
					
	                  array(
	                     'field'   => 'revenue', 
	                     'label'   => 'revenue', 
	                     'rules'   => 'trim|required'
	                  ),
					 
					  array(
	                     'field'   => 'address', 
	                     'label'   => 'address', 
	                     'rules'   => 'trim|required'
	                  ),
	                  array(
	                     'field'   => 'phone', 
	                     'label'   => 'Contact Person Phone', 
	                     'rules'   => 'trim|required'
	                  ),
	                  array(
	                     'field'   => 'contact_person_name', 
	                     'label'   => 'Contact Person Name', 
	                     'rules'   => 'trim|required'
	                  ),
	                  
	                  array(
	                     'field'   => 'state', 
	                     'label'   => 'state', 
	                     'rules'   => 'trim'
	                  ),
	                  array(
	                     'field'   => 'state', 
	                     'label'   => 'State', 
	                     'rules'   => 'trim'
	                  ),
	                  array(
	                     'field'   => 'district', 
	                     'label'   => 'District', 
	                     'rules'   => 'trim'
	                  ),array(
	                     'field'   => 'city', 
	                     'label'   => 'city', 
	                     'rules'   => 'trim'
	                  )
					 
                	);
                	
                	//get downwqard user role
                	
                	 
                	
		$this->form_validation->set_rules($config);
		/*$fields 	= array ("business_name","birth_date","gender","address","contact_person");

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}*/
		
		            $userCred=[
		                
		                'address'=>$this->input->post('address'),
		                
		                
		                'state_id'=>$this->input->post('state'),
		                'state_id'=>$this->input->post('state'),
		                'district'=>$this->input->post('district'),
		                'city_id'=>$this->input->post('city')
		                ];
		        $id=$this->input->post('pid');
		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
			//unset($data['password']);
		//	$this->session->set_flashdata('adduserdata',$data);
			redirect('partner/state/partner_registration');
		}
		
                                else
                                {
                                     $isExist=$this->db->select('user_id')->from('partner')->where('id',$id)->where('created_by',$this->session->userdata('id'))->get()->result();
                                        //var_dump($isExist);exit();
                                   if($do=$this->db->where('id',$isExist[0]->user_id)->update('users',$userCred))
                                   {
                                       //address	user_id	contact_person	phone	
                                       //$user_id=$this->db->insert_id();
                                       $business_details=[
                                           'business_name'=>$this->input->post('business_name'),
                                           'address'=>$this->input->post('address'),
                                           'contact_person'=>$this->input->post('contact_person_name'),
                                           'revenue'=>$this->input->post('revenue'),
                                           'phone'=>$this->input->post('phone'),
                                           
                                           'state_id'=>$this->input->post('state'),
		                                    
		                                    //'created_by'=>$this->session->userdata('id')
                                           ];
                                       if($this->db->where('id',$id)->update('partner',$business_details))
                                       {
                                           $this->session->set_flashdata('success','Updated Successfully');
                                          return redirect('StatePartner/edit_list');
                                       }
                                       
                                   }
                                }
                            
                        }
                        
                        
                         public function view_partner($id)
                                            {
                                            
                            if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_state_partner'))
                            {
                                            
                                                     $heading="State View";
                                                    $cdata=$this->users_model->get_country_ByUid();
                                                    $data['statelist']=$this->db->select('id,state')->from('state')->where('country_id',$cdata->id)->order_by('state','asc')->get()->result();
                            
                           
                                                  
                
                                                    //$userID=$this->db->select('user_id')->from('partner')->where('id',$id)->where('created_by',$this->session->userdata('user_role'))->get()->result();
                                                  $pt=$this->db->where('id',$id)->get('partner')->result(); 
                                                 $data['partner']=$pt[0];
                                                 //var_dump($pt);exit();
                                                 return  $this->view('partner/state/view',compact('data','heading'));
                                                
                                            
                                            
                                            }
                                            else
                                            {
                                 $this->session->set_flashdata('errors','Sorry You have not Permission');
                                return redirect('users/taskboard'); 
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