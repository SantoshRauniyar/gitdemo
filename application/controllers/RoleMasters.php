<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class RoleMasters extends Template
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
	
	
	                            public function test()
	                            {
	                                echo"hii";
	                            }
	
                            public function create()
                            {
                if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_master'))
		{
                                    
                                $data['users']=$this->db->select('id,user_name')->from('users')->where('created_by',$this->session->userdata('id'))->order_by('user_name','asc')->get()->result();
                                $data['user_roles']=$this->db->select('id,user_role_name')->from('user_roles')->where('created_by_user_id',$this->session->userdata('id'))->order_by('user_role_name','asc')->get()->result();
                               return $this->view('role_master/add',$data); 
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
	                     'field'   => 'master_name', 
	                     'label'   => 'Master Name', 
	                     'rules'   => 'trim|required|is_unique[role_master.name]'
	                  )
                                    
                                    );
                                    
                                    $this->form_validation->set_rules($config);
                                    if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
                	 return redirect('RoleMasters/create');
		}
		else
		{
		    $master=[

		        'name'=>$this->input->post('master_name'),
		        'created_by'=>$this->session->userdata('id')
		        ];
		                        if($this->db->insert('role_master',$master))
		                        {
		                            $this->session->set_flashdata('success','User Role Master Created Successfully');
		                            return redirect('RoleMasters/');
		                        }

		}
                            }
                            
                            
                            public function index()
                            {
                                
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_master'))
		{
                                    
                                    $this->db->select('role_master.name,role_master.id');
                                    $this->db->from('role_master');
                                    $this->db->where('created_by',$this->session->userdata('id'));
                                    $this->db->order_by('name','asc');
                                    $res=$this->db->get();
                                    
                                
                                        $data['masterlist']=$res->result();
                                        $data['view_as']='viewlist';
                                        $data['heading']='Roles Masters View List';
                                        return $this->view('role_master/index',$data);
                                    
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                                    
                                
                            }
                            
                            
                            public function editlist()
                            {	
                                
                                if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_master'))
		{
                                    
                                
                                
                                

                                $this->db->select('role_master.name,role_master.id');
                                    $this->db->from('role_master');
                                    $this->db->where('created_by',$this->session->userdata('id'));
                                    $this->db->order_by('name','asc');
                                    
                                    $res=$this->db->get();
                                    
                                    
                                    
                                        $data['masterlist']=$res->result();
                                        $data['view_as']='editlist';
                                        $data['heading']='Roles Masters Edit List';
                                        return $this->view('role_master/index',$data);
                                    
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                                    
                                        
                                    
                                
                            }
                            
                            
                            public function deletelist()
                            {
                                
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_master'))
		{
                                    
                                
                                $this->db->select('role_master.name,role_master.id');
                                    $this->db->from('role_master');
                                    $this->db->where('created_by',$this->session->userdata('id'));
                                    $this->db->order_by('name','asc');
                                    
                                    $res=$this->db->get();
                                    
                                    
                                    
                                        $data['masterlist']=$res->result();
                                        $data['view_as']='deletelist';
                                        $data['heading']='Roles Masters Delete List';
                                        return $this->view('role_master/index',$data);
                                        
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                                   
                                
                            }
                            
                            public function edit($id)
                            {
                                
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_master'))
		{
                                    
                                
                                $data['users']=$this->db->select('id,user_name')->from('users')->where('created_by',$this->session->userdata('id'))->get()->result();
                                $data['user_roles']=$this->db->select('id,user_role_name')->from('user_roles')->where('created_by_user_id',$this->session->userdata('id'))->get()->result();
                                $data['master']=$this->db->where('id',$id)->get('role_master')->result();
                                return $this->view('role_master/edit',$data);
                                
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
	                     'field'   => 'master_name', 
	                     'label'   => 'Master Name', 
	                     'rules'   => 'trim|required'
	                  )
                                    );
                                    
                                    $this->form_validation->set_rules($config);
                                    if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
                	 return redirect('RoleMasters/create');
		}
		else
		{
		    $master=[
		        'name'=>$this->input->post('master_name'),
		        'created_by'=>$this->session->userdata('id')
		        ];
		        $id=$this->input->post('id');
		                        if($this->db->where('id',$id)->where('created_by',$this->session->userdata('id'))->update('role_master',$master))
		                        {
		                           
		                            $this->session->set_flashdata('success','Roles Masters Updated Successfully');
		                            return redirect('RoleMasters/');
		                        }

		}
                            }
                          
                            public function view_master($id)
                            {
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_master'))
		{
                                    
                                
                                
                                $data['master']=$this->db->where('id',$id)->get('role_master')->result();
                                return $this->view('role_master/view',$data);
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                            }
                            
                            public function destroy($id)
                            {
                                        		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_master'))
		{
                                    
                                
                                        $this->db->where('created_by',$this->session->userdata('id'))->where('id',$id)->delete('role_master'); 
                                       $this->session->set_flashdata('success','Roles Master Deleted');

                                        return redirect('RoleMasters/');
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                            }
                }