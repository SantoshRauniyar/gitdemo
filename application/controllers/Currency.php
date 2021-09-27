<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Currency extends Template
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
	
	
	
                            public function create()
                            {
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_currency'))
		{
                               return $this->view('currency/add'); 
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                            }
                            
                            public function do_save()
                            {
                                $config=array(
                                    
                        array(
	                     'field'   => 'cname', 
	                     'label'   => 'Currency  Name', 
	                     'rules'   => 'trim|required|is_unique[currency.cname]'
	                  ),
	            		array(
	                     'field'   => 'csign', 
	                     'label'   => 'Currency Sign', 
	                     'rules'   => 'trim|required'
	                  )
                                    
                                    );
                                    
                                    $this->form_validation->set_rules($config);
                                    if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
                	 return redirect('Currency/create');
		}
		else
		{
		    $cur=[
		        'cname'=>$this->input->post('cname'),
		        'csign'=>$this->input->post('csign'),
		        'created_by'=>$this->session->userdata('id')
		        ];
		                        if($this->db->insert('currency',$cur))
		                        {
		                            
		                            $this->session->set_flashdata('success','Currency Successfully');
		                            return redirect('Currency/');
		                        }

		}
                            }
                            
                            
                            public function index()
                            {
                                    
                                    
                                    		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_currency'))
		{
                                    
                                    $this->db->where('created_by',$this->session->userdata('id'));
                                    $res=$this->db->get('currency');
                                    
                                
                                        $data['currencylist']=$res->result();
                                        $data['view_as']='viewlist';
                                        $data['heading']='Currency View List';
                                        return $this->view('currency/index',$data);
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                                    
                                    
                                
                            }
                            
                            
                            public function editlist()
                            {
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_currency'))
		{
                                    
                                
                                                                        $this->db->where('created_by',$this->session->userdata('id'));
                                    $res=$this->db->get('currency');
                                    
                                
                                        $data['currencylist']=$res->result();
                                        $data['view_as']='editlist';
                                        $data['heading']='Currency  Edit List';
                                        return $this->view('currency/index',$data);
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                                    
                            }
                            
                            
                            public function deletelist()
                            {
                                
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_currency'))
		{
                                    
                                    $this->db->where('created_by',$this->session->userdata('id'));
                                    $res=$this->db->get('currency');
                                        $data['currencylist']=$res->result();
                                        $data['view_as']='deletelist';
                                        $data['heading']='Currency Delete List';
                                        return $this->view('currency/index',$data);
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                                
                            }
                            
                            public function edit($id)
                            {
                                
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_currency'))
		{
                                    
                                
                                $data['cur']=$this->db->where('id',$id)->get('currency')->result();
                                return $this->view('currency/edit',$data);
            }
            else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                            }
                            
                            
                              public function do_update()
                            {
                                $config=array(
                                    
                        array(
	                     'field'   => 'cname', 
	                     'label'   => 'Currency name', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'csign', 
	                     'label'   => 'Currency Sign', 
	                     'rules'   => 'trim|required'
	                  )
                                    
                                    );
                                    
                                    $this->form_validation->set_rules($config);
                                    if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
                	 return redirect('Currency/create');
		}
		else
		{
		    $cur=[
		        'cname'=>$this->input->post('cname'),
		        'csign'=>$this->input->post('csign'),
		        'created_by'=>$this->session->userdata('id')
		        ];
		        $id=$this->input->post('id');
		                        if($this->db->where('id',$id)->where('created_by',$this->session->userdata('id'))->update('currency',$cur))
		                        {
		                            $this->session->set_flashdata('success','Currency Updated Successfully');
		                            return redirect('Currency/');
		                        }

		}
                            }
                          
                            public function view_currency($id)
                            {
                                
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_currency'))
		{
                                    
                                $data['cur']=$this->db->where('id',$id)->get('currency')->result();
                                return $this->view('currency/view',$data);
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		    
		    
		}
                            }
                            
                            public function destroy($id)
                            {
                                
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_currency'))
		{
                                    
                                        $this->db->where('created_by',$this->session->userdata('id'))->where('id',$id)->delete('currency'); 
                                       $this->session->set_flashdata('success','Currency  Deleted');

                                        return redirect('Currency/');
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                            }
                }