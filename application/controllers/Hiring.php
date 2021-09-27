<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Hiring extends Template
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
		$this->load->model('plan_model');
		$this->load->model('users_model');
		$this->set_header_path('blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->load->library('merchant');
		$this->merchant->load('paypal_express');
		
		$settings = array(
    							'username' => 'shah_kartik00-facilitator_api1.yahoo.com',
    							'password' => 'WPVLCUDBDBGP7SPL',
    							'signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AVjtNs2xy-QdXdeAsxW9VgN73tI7',
    							'test_mode' => true
    						  );

		$this->merchant->initialize($settings);
		$this->set_template('template');

		//$this->set_title('Dashboard');
		/*$this->assets_load->add_css(array(base_url('assets/css/bootstrap-datetimepicker.min.css')),"header");
		$this->assets_load->add_js(array(base_url('assets/js/bootstrap-datetimepicker.js'),

										 base_url('assets/js/bootstrap-datetimepicker.fr.js'),

										 base_url('assets/js/vendors/users.js')),"footer");*/
		
		if(!$this->session->userdata('id'))
			redirect("authentication/");

	}

	public function index()
	{
		    
		    return "Hiring list";


	}
	
	    public function hireAnemployee()
	    {
					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_hire'))
					{
	        return $this->view('hiring/hireEmployee');
	        }
	       
	    }
	    
	                function do_save()
	                {
	                                   
       // $this->load->helper('security');
                

	                    
	                        $this->form_validation->set_rules('job_title','Job Title','required'); 
	                        $this->form_validation->set_rules('job_time','job_time','required'); 
	                        $this->form_validation->set_rules('contract_type','contract_type','required'); 
	                        $this->form_validation->set_rules('int_date','int_date','required'); 
	                        $this->form_validation->set_rules('int_person','int_person','required'); 
	                        $this->form_validation->set_rules('int_location','int_location','required'); 
	                        $this->form_validation->set_rules('deadline','deadline','required'); 
	                        $this->form_validation->set_rules('email','email','required|valid_email'); 
	                        $this->form_validation->set_rules('job_desc','Job Descriptiion','required'); 
	                        $this->form_validation->set_rules('s_min','Min Salary','required|numeric'); 
	                        $this->form_validation->set_rules('s_max','Max Salary','required|numeric'); 
	                        $this->form_validation->set_rules('quli_type','Min Salary','required');
	                        $this->form_validation->set_rules('supplement_pay','Supplement Pay','required'); 
	                        $this->form_validation->set_rules('OtherBenefitsType','Other Benefits Type','required'); 
	                            
	                             $post = array();
                    foreach ( $_POST as $key => $value )
                {
                       $post[$key] = $this->input->post($key);
                }
                        $post['submit']=$this->session->userdata('id');
                
                                    $data=$this->db->insert('hiring',$post);
                                    
                                 return redirect('Hiring/hire_list/view');
                                    
                                /*var_dump($post);
	                            if($this->form_validation->run()==false)  
	                            {                   
	                                echo'<pre>';
	                                var_dump($post);
	                            var_dump($this->form_validation->run());
	                                print_r($this->form_validation->get_all_errors());
	                               echo validation_errors();

	                   	                                $this->view('hiring/hireEmployee');
	                            }
	                            
	                            else
	                            {
	                                $post = array();
                    foreach ( $_POST as $key => $value )
                {
                       $post[$key] = $this->input->post($key);
                }
                                var_dump($post);

	                            }*/
 
       /* $arr= [   
        "job_title"=> ,
        "job_time"=> ,
        "contract_type"=>  ,
        "int_date"]=> ,
        "int_person"=> ,
        "int_location"=>,  
        "deadline"=> ,
        "email"=>
        
        ];	  */                              
	                                
	                    
	                }
	                
	                                public function hire_list($action)
	                                {
	                       	
	                                  
	                                    $this->db->select('hiring.*,users.user_name');
	                                    $this->db->from('hiring');
	                                    $this->db->join('users', 'users.id=hiring.submit');
	                                    $res=$this->db->get();
	                                    $data['hirelist']=$res->result();
	                                   
	                                   if (!empty($action)) {
								 	
								 				switch ($action) {
								 					case 'view':
								 	if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_hire'))
	                       	{
								 	$data['view_as']="view_list";
								 	$data['heading']="Hire View List";
								 	return $this->view('hiring/list',$data);
	                       	}
								 						break;
								 							case 'edit':
								 if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_hire'))
	                       	{
								 	$data['heading']="Hire Edit List";
								 	$data['view_as']="edit_list";
								 	return $this->view('hiring/list',$data);
	                       	}
								 						break;
								 							case 'delete':
						 if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_delete_hire'))
	                       	{
								 	$data['heading']="Hire Delete List";
								 	$data['view_as']="delete_list";
								 	return $this->view('hiring/list',$data);
	                       	}
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Hire View List";
								 	return $this->view('hiring/list',$data);
								 						break;
								 				}


	                                   
	                                }
	                       	}
	                   
	                   
	                                    function delete_hire($id)
	                                    {
	                                        
	                   					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_delete_hire'))
	                   					{
	                                        $this->db->where('id',$id);
	                                        $this->db->delete('hiring');
	                                        
	                                        return redirect('/hire_list/delete');
	                   				}
	                                    }
	                                    
	                                        
	                                        function edit_hire($id)
	                                        {
	                                       	 if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_hire'))
	                       	{
	                                            
	                                            $this->db->where('id',$id);
	                                            $res=$this->db->get('hiring');
	                                            $dt=$res->result();
	                                            $response['data']=$dt[0];
	                                            return $this->view('hiring/edithire',$response);
	                       	}
	                                        }
	                                        
	                                        
	                                        
	                                        function view_hire($id)
	                                        {
	                                            
	                                            	 if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_hire'))
	                       	{
	                                            $this->db->where('id',$id);
	                                            $res=$this->db->get('hiring');
	                                            $dt=$res->result();
	                                            $response['data']=$dt[0];
	                                            return $this->view('hiring/view',$response);
	                         
	                                        }
	                                        }
	                                                    
	                                                public  function do_update()
	                            {
	            
       // $this->load->helper('security');
                
	                    
	                        $this->form_validation->set_rules('job_title','Job Title','required'); 
	                        $this->form_validation->set_rules('job_time','job_time','required'); 
	                        $this->form_validation->set_rules('contract_type','contract_type','required'); 
	                        $this->form_validation->set_rules('int_date','int_date','required'); 
	                        $this->form_validation->set_rules('int_person','int_person','required'); 
	                        $this->form_validation->set_rules('int_location','int_location','required'); 
	                        $this->form_validation->set_rules('deadline','deadline','required'); 
	                        $this->form_validation->set_rules('email','email','required|valid_email'); 
	                        $this->form_validation->set_rules('job_desc','Job Descriptiion','required'); 
	                        $this->form_validation->set_rules('s_min','Min Salary','required|numeric'); 
	                        $this->form_validation->set_rules('s_max','Max Salary','required|numeric'); 
	                        $this->form_validation->set_rules('quli_type','Min Salary','required');
	                        $this->form_validation->set_rules('supplement_pay','Supplement Pay','required'); 
	                        $this->form_validation->set_rules('OtherBenefitsType','Other Benefits Type','required'); 
	                            
	                             $post = array();
                    foreach ( $_POST as $key => $value )
                {
                       $post[$key] = $this->input->post($key);
                }
                        $post['submit']=$this->session->userdata('id');
                                            
                                            
                                           $id=$this->input->post('id');
                                     $this->db->where('id',$id);
                                    $data=$this->db->update('hiring',$post);
                                    
                                    
                                 return redirect('Hiring/hire_list/view');
                                        
	                                                    }
            
}