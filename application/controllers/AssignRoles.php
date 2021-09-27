<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class AssignRoles extends Template
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
		$this->load->model('authentication_model');
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
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_assign'))
		{
                                    
                                $data['users']	 = $this->authentication_model->getusersdropdown();
                                $data['user_roles']=$this->db->select('id,user_role_name')->from('user_roles')->where('created_by_user_id',$this->session->userdata('id'))->order_by('user_role_name','asc')->get()->result();
                               return $this->view('assign_role/add',$data); 
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
	                     'field'   => 'user_id', 
	                     'label'   => 'Select Member Name', 
	                     'rules'   => 'trim|required|is_unique[assign_role.user]'
	                  ),
	            		array(
	                     'field'   => 'user_role', 
	                     'label'   => 'Select User Role', 
	                     'rules'   => 'trim|required'
	                  )
                                    
                                    );
                                    
                                    $this->form_validation->set_rules($config);
                                    if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
                	 return redirect('AssignRoles/create');
		}
		else
		{
		    $assign=[
		        'user_role'=>$this->input->post('user_role'),
		        'user'=>$this->input->post('user_id'),
		        'created_by'=>$this->session->userdata('id')
		        ];
		                        if($this->db->insert('assign_role',$assign))
		                        {
		                            $assign_id=$this->db->insert_id();
		                            //var_dump($assign_id);exit();
		                            $this->db->where('id',$assign['user'])->where('created_by',$this->session->userdata('id'))->update('users',['user_role'=>$assign['user_role'],'assign_id'=>$assign_id]);
		                            $this->session->set_flashdata('success','User Role Assigned Successfully');
		                            return redirect('AssignRoles/');
		                        }

		}
                            }
                            
                            
                            public function index()
                            {
                                
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_assign'))
		{
                                    
                                    $this->db->select('users.user_name,user_roles.user_role_name,assign_role.id');
                                    $this->db->from('assign_role');
                                    $this->db->join('users','users.id=assign_role.user');
                                    $this->db->join('user_roles','user_roles.id=assign_role.user_role');
                                    $this->db->where('assign_role.created_by',$this->session->userdata('id'));
                                    $res=$this->db->get();
                                    
                                
                                        $data['assignlist']=$res->result();
                                        $data['view_as']='viewlist';
                                        $data['heading']='Assign Role View List';
                                        return $this->view('assign_role/index',$data);
                                    
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                                    
                                
                            }
                            
                            
                            public function editlist()
                            {	
                                
                                if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_assign'))
		{
                                    
                                
                                
                                
                                    $this->db->select('users.user_name,user_roles.user_role_name,assign_role.id');
                                    $this->db->from('assign_role');
                                    $this->db->join('users','users.id=assign_role.user');
                                    $this->db->join('user_roles','user_roles.id=assign_role.user_role');
                                    $this->db->where('assign_role.created_by',$this->session->userdata('id'));
                                    $res=$this->db->get();
                                    
                                    
                                    
                                        $data['assignlist']=$res->result();
                                        $data['view_as']='editlist';
                                        $data['heading']='Assign Role Edit List';
                                        return $this->view('assign_role/index',$data);
                                    
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                                    
                                        
                                    
                                
                            }
                            
                            
                            public function deletelist()
                            {
                                
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_assign'))
		{
                                    
                                
                                    $this->db->select('users.user_name,user_roles.user_role_name,assign_role.id');
                                    $this->db->from('assign_role');
                                    $this->db->join('users','users.id=assign_role.user');
                                    $this->db->join('user_roles','user_roles.id=assign_role.user_role');
                                    $this->db->where('assign_role.created_by',$this->session->userdata('id'));
                                    $res=$this->db->get();
                                    
                                    
                                    
                                        $data['assignlist']=$res->result();
                                        $data['view_as']='deletelist';
                                        $data['heading']='Assign Role Delete List';
                                        return $this->view('assign_role/index',$data);
                                        
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                                   
                                
                            }
                            
                            public function edit($id)
                            {
                                
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_assign'))
		{
                                    
                                
                                $data['users']=$this->db->select('id,user_name')->from('users')->where('created_by',$this->session->userdata('id'))->get()->result();
                                $data['user_roles']=$this->db->select('id,user_role_name')->from('user_roles')->where('created_by_user_id',$this->session->userdata('id'))->get()->result();
                                $data['assign']=$this->db->where('id',$id)->get('assign_role')->result();
                                return $this->view('assign_role/edit',$data);
                                
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
	                     'field'   => 'user_id', 
	                     'label'   => 'Select Member Name', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'user_role', 
	                     'label'   => 'Select User Role', 
	                     'rules'   => 'trim|required'
	                  )
                                    
                                    );
                                    
                                    $this->form_validation->set_rules($config);
                                    if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata( "errors", validation_errors());
                	 return redirect('AssignRoles/create');
		}
		else
		{
		    $assign=[
		        'user_role'=>$this->input->post('user_role'),
		        'user'=>$this->input->post('user_id'),
		        'created_by'=>$this->session->userdata('id')
		        ];
		        $id=$this->input->post('id');
		                        if($this->db->where('id',$id)->where('created_by',$this->session->userdata('id'))->update('assign_role',$assign))
		                        {
		                            //$assign_id=$this->db->insert_id();
		                            //var_dump($assign_id);exit();
		                            $this->db->where('assign_id',$id)->where('created_by',$this->session->userdata('id'))->update('users',['user_role'=>$assign['user_role']]);
		                            $this->session->set_flashdata('success','User Role Assigned Updated Successfully');
		                            return redirect('AssignRoles/');
		                        }

		}
                            }
                          
                            public function view_assign($id)
                            {
                                		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_assign'))
		{
                                    
                                
                                $data['users']=$this->db->select('id,user_name')->from('users')->where('created_by',$this->session->userdata('id'))->get()->result();
                                $data['user_roles']=$this->db->select('id,user_role_name')->from('user_roles')->where('created_by_user_id',$this->session->userdata('id'))->get()->result();
                                $data['assign']=$this->db->where('id',$id)->get('assign_role')->result();
                                return $this->view('assign_role/view',$data);
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                            }
                            
                            public function destroy($id)
                            {
                                        		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_assign'))
		{
                                    
                                
                                        $this->db->where('created_by',$this->session->userdata('id'))->where('id',$id)->delete('assign_role'); 
                                       $this->session->set_flashdata('success','Role Assign Deleted');

                                        return redirect('AssignRoles/');
		}
		else
		{
		    return redirect('/users/dashboard');
		    
		    $this->session->set_flashdata('errors','Sorry You have not permission');
		}
                            }
                }