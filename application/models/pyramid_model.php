<?php
class pyramid_model extends MY_Generic_Model 
{
   public function __construct()
   {
      //Call the Model constructor
	  parent::__construct();
	  $this->load->library('pagination');
	  $this->model_pagination->set_ref($this);
      $this->model_pagination->set_uri_segment(4);
	  $this->model_pagination->set_per_page(10);
   }
   
   public function DepartmentDown()
   {
   			
   			$this->db->select('users.id,users.user_name,user_roles.user_role_name,program.pro_name');
   			$this->db->from('users');
   			$this->db->join('program','program.pro_head=users.id','left');
            $this->db->join('user_roles','user_roles.id=users.user_role');
   			$this->db->where('program.pro_head',null);
   			$res=$this->db->get();
   				$data=$res->result();

               if($res->num_rows()>0)
               {
                  return $data;
               }
               else
               {
                 return false;
               }
   				

   }

   public function SectionDown()
   {
            
            $this->db->select('users.id,users.user_name');
            $this->db->from('users');
            $this->db->join('program','program.pro_head=users.id','left');
            $this->db->where('program.pro_head',null);
            $this->db->join('groups','groups.manager_id=users.id','left');
            $this->db->where('groups.manager_id',null);
            $res=$this->db->get();
               $data=$res->result();

               if($res->num_rows()>0)
               {
                  return $data;
               }
               else
               {
                 return false;
               }
               

   }
         public function UnitDown()
   {
            
            $this->db->select('users.id,users.user_name');
            $this->db->from('users');
            $this->db->join('program','program.pro_head=users.id','left');
            $this->db->where('program.pro_head',null);
            $this->db->join('groups','groups.manager_id=users.id','left');
            $this->db->where('groups.manager_id',null);
            $this->db->join('section','section.section_head=users.id','left');
            $this->db->where('section.section_head',null);
            $res=$this->db->get();
               $data=$res->result();

               if($res->num_rows()>0)
               {
                  return $data;
               }
               else
               {
                 return false;
               }
               

   }


   public function ExecutiveDown()
   {
            
            $this->db->select('users.id,users.user_name');
            $this->db->from('users');
            $this->db->join('program','program.pro_head=users.id','left');
            $this->db->where('program.pro_head',null);
            $this->db->join('groups','groups.manager_id=users.id','left');
            $this->db->where('groups.manager_id',null);
            $this->db->join('section','section.section_head=users.id','left');
            $this->db->where('section.section_head',null);
             $this->db->join('unit','unit.uhead=users.id','left');
            $this->db->where('unit.uhead',null);
            $res=$this->db->get();
               $data=$res->result();

               if($res->num_rows()>0)
               {
                  return $data;
               }
               else
               {
                 return false;
               }
               

   }

            public function usersExceptRole()
            {
               $filter=[];

                            $role=(int)$this->session->userdata('user_role');
               //$role='Captain';//Main Admin
               if($role=='Captain')//main
               {
               $filter=[22,36,24,37,21];//not partners
               }
               else if($role==43)//program head
               {
                        $filter=['Captain',22,36,24,37,21];//[main admin]
               }
               else if($role=25)//department
               {
                   $filter=['Captain',25,22,36,24,37,21];//[program,dept,section]   
               }
               else if($role=26)//section
               {
                   $filter=['Captain',25,26,22,36,24,37,21];//[program,dept,section]   
               }
               else if($role=27)//unit
               {
                   $filter=['Captain',26,25,27,22,36,24,37,21];//[program,dept,section]   
               }
               else if($role=28)//intern
               {
                   $filter=['Captain',25,26,27,28,22,36,24,37,21];//[program,dept,section,unit]   
               }
               
                    //$filter=array_merge($filter,[22,36,24,37,21]);//
                           // print_r($filter);
               $this->db->select('users.id,users.user_name,users.first_name,users.last_name,user_roles.user_role_name');
               $this->db->from('users');
               $this->db->join('user_roles','user_roles.id=users.user_role');
               $this->db->where_not_in('users.user_role',$filter);
               $this->db->where('users.created_by',$this->session->userdata('id'));
               $this->db->order_by('users.first_name','asc');
               $res=$this->db->get()->result();
               
                
                    if(count($res)>0)
                    {
                        return $res;
                    }
                    else
                    {
                        return false;
                    }

            }

}	