<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class Task extends Template
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
		$this->load->helper('form');
		$this->load->model('users_model');
		$this->load->model('projects_model');
		$this->load->model('pyramid_model');
		$this->load->model('milestone_model');
		$this->load->model('authentication_model');
		$this->load->model('notification_model');
		$this->load->model('groups_model');
		$this->load->model('user_classification_model');
		$this->load->model('user_role_model');
		$this->load->model('task_model');
		$this->load->model('task_type_model');
		$this->set_header_path('blocks/header');
    $this->user_classification_model->set_role();
		    $this->user_classification_model->set_role();

		$this->set_template('template');
		$this->set_title('Task Management');

		$this->assets_load->add_css(array(base_url('assets/administrator/css/bootstrap-datetimepicker.min.css')),"header");
		$this->assets_load->add_js(array(base_url('assets/administrator/js/bootstrap-datetimepicker.js'),
										 base_url('assets/administrator/js/bootstrap-datetimepicker.fr.js'),
										 base_url('assets/administrator/js/vendors/task.js')),"footer");

		if(!$this->session->userdata('id'))
			redirect("authentication/");
	}

	public function index()
	{
		$this->all();
	}

	/*
		Manage users view
	*/
	public function all()
	{
		//$this->data['current_page'] = 'viewdetail';
					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_gtask'))
		{



		$this->set_title["title"] = $this->set_title('Task Management');

		$sort = !isset($_REQUEST['sort'])?'task':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		
					$this->db->select('taskk.status,users.first_name,taskk.assign_uid,users.last_name,taskk.id,taskk.title,taskk.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program','left');
					$this->db->join('projects','projects.id=taskk.project','left');
					$this->db->join('users','users.id=taskk.assign_uid');
					$this->db->where('taskk.assign_uid',$this->session->userdata('id'));
					$this->db->where('taskk.status !=',4);

					$res=$this->db->get();
					$tasklist=$res->result();
					//var_dump($tasklist);
					$data['tasklist']=$tasklist;
		$this->view("task_list",$data);
	}
}

                public function assigned_by_task()
	{
		//$this->data['current_page'] = 'viewdetail';
					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_gtask'))
		{



		$this->set_title["title"] = $this->set_title('Task Management');



		
					$this->db->select('taskk.status,users.first_name,taskk.assign_uid,users.last_name,taskk.id,taskk.title,taskk.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program','left');
					$this->db->join('projects','projects.id=taskk.project','left');
					$this->db->join('users','users.id=taskk.assign_uid');
					$this->db->where('taskk.assign_uid',$this->session->userdata('id'));

					$res=$this->db->get();
					$tasklist=$res->result();
					//var_dump($tasklist);
					$data['tasklist']=$tasklist;
		$this->view("task/task_history",$data);
	}
}


public function created_by_task()
	{
		//$this->data['current_page'] = 'viewdetail';
					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_gtask'))
		{



		$this->set_title["title"] = $this->set_title('Task Management');



		
					$this->db->select('taskk.status,users.first_name,taskk.assign_uid,users.last_name,taskk.id,taskk.title,taskk.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program','left');
					$this->db->join('projects','projects.id=taskk.project','left');
					$this->db->join('users','users.id=taskk.assign_uid');
					$this->db->where('taskk.created_by',$this->session->userdata('id'));

					$res=$this->db->get();
					$tasklist=$res->result();
					//var_dump($tasklist);
					$data['tasklist']=$tasklist;
		$this->view("task/task_history",$data);
	}
}


				function complete_view()
				{

										if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_comp_gtask'))
		{

							$this->db->select('taskk.status,users.first_name,users.last_name,taskk.id,taskk.title,taskk.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program','left');
					$this->db->join('projects','projects.id=taskk.project','left');
					$this->db->join('users','users.id=taskk.assign_uid','left');
					$this->db->or_where('taskk.assign_uid',$this->session->userdata('id'));
					$this->db->or_where('taskk.created_by',$this->session->userdata('id'));
					$res=$this->db->get();
					$tasklist=$res->result();
					//var_dump($tasklist);
					$data['tasklist']=$tasklist;

        //    var_dump($tasklist);
		$this->view("task/complete_list",$data);
	}	
				}


public function task_editor_list()
	{

							if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_gtask'))
		{

		//$this->data['current_page'] = 'viewdetail';
		$this->set_title["title"] = $this->set_title('Task Management');

		$sort = !isset($_REQUEST['sort'])?'task':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];

		
					$this->db->select('taskk.status,users.first_name,users.last_name,taskk.id,taskk.title,taskk.created_by,taskk.created_at,taskk.priority,taskk.project,projects.project_name,program.pro_name,taskk.end_date');
					$this->db->from('taskk');
					$this->db->join('program','program.pid=taskk.program','left');
					$this->db->join('projects','projects.id=taskk.project','left');
					$this->db->join('users','users.id=taskk.assign_uid');
					$this->db->where('taskk.created_by',$this->session->userdata('id'));
					$res=$this->db->get();
					$tasklist=$res->result();
					//var_dump($tasklist);
					$data['tasklist']=$tasklist;

      //$this->view('administrator/admin_category_templet',$this->data);
		$this->view("task/task_editor_list",$data);

			}
	}

/*

	TASK 	Edit List
*/



		function single_edit_task($id)
		{


					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_gtask'))
		{

                $this->db->order_by('user_name','asc');
				$q=$this->db->get('users');
				$data['users']=$q->result();


					$this->db->order_by('dtitle','asc');
								$q=$this->db->get('department');
				$data['dept']=$q->result();

                                              $this->db->order_by('pro_name','asc');
					            			$q=$this->db->get('program');
			                        	$data['program']=$q->result();


                                $this->db->order_by('unit_name','asc');
								$q=$this->db->get('unit');
			                	$data['unit']=$q->result();
			                	
			                	  $this->db->order_by('section_name','asc');
								$q=$this->db->get('section');
			                	$data['section']=$q->result();

                                $this->db->order_by('milestone_title','asc');
								$q=$this->db->get('milestone');
				$data['milestone']=$q->result();

				$this->db->order_by('project_name','asc');
				$q=$this->db->get('projects');
				$data['projects']=$q->result();


		
			//get task data by id
				$this->db->where('id',$id);
				$res=$this->db->get('taskk');
				$data['singledata']=$res->result();
				//print_r($data);

				$this->view("task/single_edit_task",$data);
		}

	}

					function change_status($id,$status)
				{

						if(!$this->task_model->is_task_approved($id,$status))

		{
			if (!empty($id)) {




							if ($status==3) {
								$this->db->where('id',$id);
								date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

								$arr=[
											"status"=>$status,
											"completed_at"=>date("Y-m-d H:i:s")

								];
						 if($this->db->update('taskk',$arr))
						 {
					 $this->session->set_flashdata('success','Task has been Marked Completed');
					redirect('task/all');
						 }
						 else
						 {
				$this->session->set_flashdata('errors','Task could not been Mark Complete');
					redirect('task/all');
						 }
							}

							else
						{
						
						
						if($status==4 or $status==6 or $status==5){
						    
						  $this->db->where('id',$id);
						$this->db->where('created_by',$this->session->userdata('id'));
						$this->db->set('status',$status);
						$res=$this->db->update('taskk');
						}
						else if($status==3 or $status==2  )//complete/opened
						{
						
						
						$this->db->where('id',$id);
                        $this->db->where('assig_uid',$this->session->userdata('id'));
						$this->db->set('status',$status);
						$res=$this->db->update('taskk');
						
						
						}
						if($res)
						{
						    $this->session->set_flashdata('success','Status has been updated !');
						  redirect('task/all');
						}
						else{

						}
						}
					 }

		}
		else
		 {
			
		 		$this->session->set_flashdata('errors','Sorry task already approved can not update !');
						  redirect('task/all');
		}


					}


				


				function change_status_to_production($id,$status)
				{

					if (!empty($id)) {


									

							if ($status==3) {
								$this->db->where('poid',$id);
						//$this->db->set('status',$status,'completed_at',date_create());
						
								date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

								$arr=[
											"status"=>$status,
											"completed_at"=>date("Y-m-d H:i:s")

								];
						$this->db->update('content_production_order',$arr);
						redirect('task/content_production_order_view_list');
							}

							else
						{
						$this->db->where('poid',$id);
						$this->db->set('status',$status);
						$this->db->update('content_production_order');
						redirect('task/content_production_order_view_list');
					 }


					}


				}


				function change_status_to_published($id,$status)
				{

					if (!empty($id)) {


									

							if ($status==3) {
								$this->db->where('id',$id);
						//$this->db->set('status',$status,'completed_at',date_create());
						
								date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

								$arr=[
											"status"=>$status,
											"completed_at"=>date("Y-m-d H:i:s")

								];
						$this->db->update('content_published',$arr);
						redirect('task/published_list/view');
							}

							else
						{
						$this->db->where('id',$id);
						$this->db->set('status',$status);
						$this->db->update('content_published');
						redirect('task/published_list/view');
					 }


					}


				}

				function create_content_category()
				{
													if($this->session->userdata('user_role')=="Captain")
		{

					$this->view('task/create_content_category');
				}

			}
				function update_cont_cat($id,$static_view=null)
				{		
		if($this->session->userdata('user_role')=="Captain")
		{


					if (!empty($static_view)) {
						$data['static_view']=$static_view;
					}
					$this->db->where('cid',$id);
					$res=$this->db->get('content_category');
					$cdata=$res->result();
					$cdata=$cdata[0];
					$data['cat_data']=$cdata;

					$this->view('task/update_content_category',$data);
				}
			}



								 function category_save()
								 {

								 		$this->form_validation->set_rules('cname','Content Category Name','trim|required|is_unique[content_category.cname]');

								 			if ($this->form_validation->run()==FALSE) {
														$this->view('task/create_content_category');
								 			}
								 			else
								 			{
								 	if ($this->input->post('submit')) {
								 		
								 		$arr=[

								 	"cname"=>$this->input->post('cname')
								 		];

								 		$this->db->insert('content_category',$arr);
								 		$this->session->set_flashdata('create_category',"Created Successfully");
								 		redirect('task/category_list');
								 	}
								 }
								 }
								 function category_update($id)
								 {

								 		$this->form_validation->set_rules('cname','Content Category Name','trim|required|is_unique[content_category.cname]');

								 			if ($this->form_validation->run()==FALSE) {
														$this->view('task/update_content_category/'.$id);
								 			}
								 			else
								 			{
								 	if ($this->input->post('submit')) {
								 		
								 		$arr=[

								 	"cname"=>$this->input->post('cname')
								 		];
								 					$this->db->where('cid',$id);
								 		$this->db->update('content_category',$arr);
								 		$this->session->set_flashdata('create_category',"Created Successfully");
								 		redirect('task/category_list');
								 	}
								 }
								 }


								 function category_list($action)
								 {
								 
								 											if($this->session->userdata('user_role')=="Captain")
		{	
								 	if (!empty($action)) {
								 	
								 				switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Category View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="Category Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Category Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Category View List";
								 						break;
								 				}

								 	$res=$this->db->get('content_category');
								 	$cat_list=$res->result();
								 	$data['cat_list']=$cat_list;
								 	$this->view('task/content_category_list',$data);
								 }

								 }
			}					 
								


								 


								 				function delete_cont_cat($cid)
								 				{

								 			if($this->session->userdata('user_role')=="Captain")
										{
												$this->db->where('cid',$cid);
								 					$this->db->delete('content_category');
								 							redirect('task/category_list');
								 		}
								 				}		

function set_complete($id)
		{
				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_comp_gtask'))
		{

				$this->db->order_by('user_name','asc');
				$q=$this->db->get('users');
				$data['users']=$q->result();


					$this->db->order_by('dtitle','asc');
								$q=$this->db->get('department');
				$data['dept']=$q->result();

$this->db->order_by('pro_name','asc');
								$q=$this->db->get('program');
				$data['program']=$q->result();


$this->db->order_by('unit_name','asc');
								$q=$this->db->get('unit');
				$data['unit']=$q->result();

					$this->db->order_by('milestone_title','asc');
								$q=$this->db->get('milestone');
				$data['milestone']=$q->result();

				$this->db->order_by('project_name','asc');
				$q=$this->db->get('projects');
				$data['projects']=$q->result();


		
					//get task data by id
				$this->db->where('id',$id);

				$res=$this->db->get('taskk');
				$data['singledata']=$res->result();
				//print_r($data);

				$this->view("task/set_complete_form",$data);
		}
}



	/*
		Following task list
	*/
	public function following_task_list()
	{
		$this->set_title["title"] = $this->set_title('Following Task');

		$sort = !isset($_REQUEST['sort'])?'id':$_REQUEST['sort'];
		$type = !isset($_REQUEST['type'])?'desc':$_REQUEST['type'];
		
		$userdata = $this->task_model->getfollowingtasklist($sort,$type);
		if($type=='asc')
			$type ='desc';
		else
			$type ='asc';

      	$data['type'] = $type;
      	$data['sort'] = $sort;

		if(count($userdata['results'])>0)
			$data['userdata'] = $userdata;

      	$data['url']  = $_SERVER['PHP_SELF'].'?sort='.$sort.'&type='.$type;
	     //$this->view('administrator/admin_category_templet',$this->data);
		$this->view("following_task_list",$data);
	}
	
	/* 
		Add User Process
	*/
	public function add_task()
	{


							if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_gtask'))
		{

                    $data['followers']='';
			$data["users"]=$this->pyramid_model->usersExceptRole();
				$data['followers']=$this->authentication_model->taskfollowers();


					$this->db->order_by('dtitle','asc');
								$q=$this->db->get('department');
				$data['dept']=$q->result();

$this->db->order_by('pro_name','asc');
								$q=$this->db->get('program');
				$data['program']=$q->result();


$this->db->order_by('unit_name','asc');
								$q=$this->db->get('unit');
				$data['unit']=$q->result();

					$this->db->order_by('milestone_title','asc');
								$q=$this->db->get('milestone');
				$data['milestone']=$q->result();

				$this->db->order_by('project_name','asc');
				$q=$this->db->get('projects');
				$data['projects']=$q->result();
		$this->view("task/create_task",$data);
	}

}	



		function sort_by($type)
		{
			$this->db->select('created_at');
			$this->db->from('taskk');
			$res=$this->db->get();
			$data=$res->result();
			print_r($data);

		}



// 	public function add_comments($task_id)
// 	{
// 		$data['task_details'] = $this->task_model->gettaskdetailbyid($task_id);
// 		$data['comment_list'] = $this->task_model->gettaskcommentbyid($task_id);
// 		$data['heading']	 	= "Add Comments";
// 		$this->view("task_comment",$data);
// 	}
// 	public function do_add_comment()
// 	{
// 		$config = array(
// 					array(
// 					 'field'   => 'comment', 
// 					 'label'   => 'comment', 
// 					 'rules'   => 'trim|required'
// 				  )
// 		);
// 		//$fields = array('comment');
// 		$this->form_validation->set_rules($config);
// 		$fields = array("task_id","comment");
		
// 		foreach($fields as $field)
// 		{
// 			$data[$field] = $this->input->post($field);
// 		}

// 		if($this->form_validation->run() == FALSE)
// 		{
// 			$this->session->set_flashdata( "errors", validation_errors());
// 			//unset($data['password']);
// 			//$this->session->set_flashdata('addtaskdata',$data);
// 			redirect('task/add_comments/'.$data['task_id']);
// 		}			
// 		else
// 		{
// 			$data['user_id'] = $this->session->userdata('id');	
// 			$this->task_model->set_fields($data);
			
// 			$result = $this->task_model->do_save_comment();
			
// 			if($result > 0)
// 			{
// 				$this->session->set_flashdata('success',"Comment Added Successfully.");
// 				redirect('task/add_comments/'.$data['task_id']);
// 			}
// 		}
// 	}



				function do_save1()
				{



	$config = array(
	             		array(
	                     'field'   => 'title', 
	                     'label'   => 'title', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'description', 
	                     'label'   => 'description', 
	                     'rules'   => 'trim'
	                  ),
						array(
								'field'   => 'assign_uid',
								'label'   => 'Assign User',
								'rules'   => 'trim|required'
						),
					  array(
	                     'field'   => 'department', 
	                     'label'   => 'department', 
	                     'rules'   => 'trim'
	                  ),
					  array(
	                     'field'   => 'unit', 
	                     'label'   => 'unit name', 
	                     'rules'   => 'trim'
	                  ),
					  array(
					  		'field'   => 'priority',
					  		'label'   => 'Task priority',
					  		'rules'   => 'trim'
					  ),
					  array(
	                     'field'   => 'budget', 
	                     'label'   => 'budget', 
	                     'rules'   => 'trim|numeric'
	                  ),
					  array(
	                     'field'   => 'start_date', 
	                     'label'   => 'start date', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'end_date', 
	                     'label'   => 'end date', 
	                     'rules'   => 'trim|required'
	                  ),
				  
				  array(
	                     'field'   => 'milestone', 
	                     'label'   => 'Milestone', 
	                     'rules'   => 'trim'
	                  )
				  
				  
               	);
		$this->form_validation->set_rules($config);

		$fields 	= array ("title","program","project","description","start_date","end_date","assign_uid","priority","budget","department","milestone","unit","section");

	
					if ($this->form_validation->run()==true) {
					
		
	$insertaraay=[

			"title"=>$this->input->post('title'),
			"program"=>$this->input->post('program'),
			"project"=>$this->input->post('project'),
			"start_date"=>$this->input->post('start_date').' '.$this->input->post('start_time'),
			"end_date"=>$this->input->post('end_date').' '.$this->input->post('end_time'),
			"assign_uid"=>$this->input->post('assign_uid'),
			"priority"=>$this->input->post('priority'),
			"budget"=>$this->input->post('budget'),
			"department"=>$this->input->post('department'),
			"milestone"=>$this->input->post('milestone'),
			"unit"=>$this->input->post('unit'),
			"section"=>$this->input->post('section'),
			"description"=>$this->input->post('description'),
			"created_by"=>$this->session->userdata('id')
		];


			if ($this->input->post('assign_uid')) {
				$insertaraay['status']=1;
			}
			else
			{
				$insertaraay['status']=0;
			}
    $followers=[];
			$followers=$user_ar=$this->input->post('users');
			//print_r($user_ar);
			if(isset($followers) and !empty($followers))
			{
			$uid=implode('-',$user_ar);//array to string 
			//echo $uid;
			$insertaraay['users']=$uid;
			}


                //set end date is always >start date
                							$start = new DateTime($insertaraay["start_date"]);
											$end = new DateTime($insertaraay["end_date"]);
											
											if($start>$end)
											{
											    $this->session->set_flashdata('errors','End date can not be before start');
											    return redirect("/task/add_task");
											}
                
                
                
                
                
			$img='';
     foreach($_FILES['file']['error'] as $k=>$v)
 {
    $uploadfile = 'upload/'. basename($_FILES['file']['name'][$k]);

    $ext=explode('.',$uploadfile);
    $ext=end($ext);
    $f=rand().'.'.$ext;
    if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $f)) 
    {
        $img.=$_FILES['file']['name'][$k].'-';
    }

    

				}
									//print_r($insertaraay);
									$insertaraay['files']=$img;


                	
		                                if($this->db->insert('taskk',$insertaraay))
		                                {
		                                    $tid=$this->db->insert_id();
		                                                //create recurrence
		                                                
		                                                $this->session->set_flashdata('success','Tast Created Successfully');
		                                                
		                                                if($this->input->post('is_recurring'))
		                                                {
		              $sql = "CREATE EVENT `".$insertaraay['title']."` ON SCHEDULE EVERY 1 MINUTE STARTS '".$this->input->post('rec_start')."' ENDS '".$this->input->post('rec_end')."' ON COMPLETION NOT PRESERVE ENABLE DO insert into taskk(title,program,project,start_date,end_date,budget,priority,department,milestone,assign_uid,section)
		              values('".$insertaraay['title']."','".$insertaraay['program']."','".$insertaraay['project']."','".$insertaraay['start_date']."','".$insertaraay['end_date']."','".$insertaraay['budget']."','".$insertaraay['priority']."','".$insertaraay['department']."','".$insertaraay['milestone']."','".$insertaraay['assign_uid']."','".$insertaraay['section']."')";    
                        
                        $query = $this->db->query($sql);
                                                                            /* if($query)
                                                                                  {
                                                                                  	echo "string";
                                                                                  	exit();
                                                                                  }  */           
		                                                }
		                                    
		                                    
		                                    
		                                    //set get 
		                                    $ph=$this->db->select('pro_name,pro_head')->where('pid',$insertaraay['program'])->from('program')->get()->result();
		                            $dh=$this->db->select('dtitle,manager_id')->where('did',$insertaraay['department'])->from('department')->get()->result();
		                            $sh=$this->db->select('section_name,section_head')->where('id',$insertaraay['section'])->from('section')->get()->result();
		                            $uh=$this->db->select('unit_name,uhead')->where('id',$insertaraay['unit'])->from('unit')->get()->result();
			
			                $unit_name=$unit_head=$section_head=$section_name=$dept_name=$dept_head=$pro_name=$pro_head=0;
			                     if(isset($ph) and !empty($ph))
			                     {
		                            $pro_head=$ph[0]->pro_head;
		                             $pro_name=$ph[0]->pro_name;
			                     }
			                     
			                     if(isset($dh) and !empty($dh))
			                     {
		                            $dept_head=$dh[0]->manager_id;
		                             $dept_name=$dh[0]->dtitle;
			                     }
		                            if(isset($sh) and !empty($sh))
			                     {
                                    $section_name=$sh[0]->section_name;
		                            $section_head=$sh[0]->section_head;
			                     }
			                     
			                       if(isset($uh) and !empty($uh))
			                     {
                                     $unit_head=$uh[0]->uhead;
		                            $unit_name=$uh[0]->unit_name;
			
			                     }
		                           
		                           
		      
		                            
		    
	
			           
			            $to=$pro_head.','.$dept_head.','.$section_head.','.$unit_head.','.$insertaraay['assign_uid'];
			            $emails=$this->user_role_model->getEmail($to); 
                                               /**
                                                * Notification module
                                                * 
                                                * */
                                                date_default_timezone_set('Asia/Kolkata');
                                               $sentdata=[
								'message'=>'New '.$insertaraay['title'].' Task  Created.',
								'link'=>'task/opentask/'.$tid.'/2',
								'date'=>date("d M  G:i")
							];
							$users=[$insertaraay['assign_uid'],$unit_head,$section_head,$dept_head,$pro_head,$this->session->userdata('id')];
							
							if(isset($followers) and !empty($followers))
							{
														$users=array_merge($users,$followers);
							}
							$users=array_unique($users);
	;						foreach($users as $user)
							{
								$sentdata['to_users']=$user;
								$isn=$this->notification_model->sent_notification($sentdata);
	                                                   // var_dump($isn);
				
							}
						//	exit();
                                            //$emails=$this->user_role_model->getEmail($insertaraay['assign_uid']);
                                            	 foreach($emails as $value) {
					         if($value->email != '')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/program.html");
					$emailBody = str_replace("<@pro_name@>",$insertaraay['title'],$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
				
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Task Management - Task Created ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
					{
						echo "email not sent";
						$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
					
				
					
					
				}
				else 
				{
					echo"InValid Email";
					$this->session->set_flashdata( "errors", "Please enter valid email address.");
			
				}
				         
	            	}	           
			        	}
			        	
				
                        


				redirect('task/all');
		                                }
                                                        
                                    
			}
			else
			{
                $data['users']=$this->pyramid_model->usersExceptRole();


					$this->db->order_by('dtitle','asc');
								$q=$this->db->get('department');
				$data['dept']=$q->result();

$this->db->order_by('pro_name','asc');
								$q=$this->db->get('program');
				$data['program']=$q->result();


$this->db->order_by('unit_name','asc');
								$q=$this->db->get('unit');
				$data['unit']=$q->result();

					$this->db->order_by('milestone_title','asc');
								$q=$this->db->get('milestone');
				$data['milestone']=$q->result();
            $data['followers']=$this->authentication_model->taskfollowers();
				$this->db->order_by('project_name','asc');
				$q=$this->db->get('projects');
				$data['projects']=$q->result();
				$this->view('task/create_task',$data);
			}
		}




		
		/*foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}		
		print_r($fields);


			/*$this->form_validation->set_rules('task_title','trim|required');
			$this->form_validation->set_rules('desc','trim|required');



			
		}

		function newtask()
		{
				$q=$this->db->get('users');
				$data['users']=$q->result();

								$q=$this->db->get('groups');
				$data['dept']=$q->result();

								$q=$this->db->get('program');
				$data['program']=$q->result();

								$q=$this->db->get('unit');
				$data['unit']=$q->result();

								$q=$this->db->get('milestone');
				$data['milestone']=$q->result();

								$q=$this->db->get('projects');
				$data['projects']=$q->result();

			$this->view('task/secondtask',$data);
		}





				


	function do_save()
	{

			$this->form_validation->set_rules('program','trim|required');
			$this->form_validation->set_rules('dept','trim|required');
			$this->form_validation->set_rules('project','trim|required');
			$this->form_validation->set_rules('task','trim|required');
			$this->form_validation->set_rules('desc','trim|required');
			$this->form_validation->set_rules('priority','trim|required');
			$this->form_validation->set_rules('start_date','trim|required');
			$this->form_validation->set_rules('end_date','trim|required');
			$this->form_validation->set_rules('budget','trim|required');


			if ($this->form_validation->run()==true) {
					
						$array=[
			'program'=>$this->input->post('program'),
			'department'=>$this->input->post('dept'),
			'project'=>$this->input->post('project'),
			'title'=>$this->input->post('task'),
			'program'=>$this->input->post('program'),
						'priority'=>$this->input->post('priority'),
			'start_date'=>$this->input->post('start_date'),
			'end_date'=>$this->input->post('end_date'),
			'budget'=>$this->input->post('budget'),
			'description'=>$this->input->post('desc')
		];

			$img='';
     foreach($_FILES['file']['error'] as $k=>$v)
 {
    $uploadfile = 'upload/'. basename($_FILES['file']['name'][$k]);

    $ext=explode('.',$uploadfile);
    $ext=end($ext);
    $f=rand().'.'.$ext;
    if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $f)) 
    {
        $img.=$_FILES['file']['name'][$k].'-';
    }

    /*else 
    {
        $error=$_FILES['file']['name'][$k], " upload attack!\n";
    } 
    echo $img;  

    $array['files']=$img;

 }



    


		$this->db->insert('taskk',$array);

		print_r($array);



			}


	
	}*/

		

	public function getMilestoneByProjectId($project_id)
	{
		$result = $this->milestone_model->getMilestone_By_Project_Id($project_id);
		$data['milestone_list'] = $result;
		if(empty($result))
		{
			$results['status'] = 404;
			$results['data']   = "No data found.";
			echo json_encode($results);
			exit;
		}	
		$results['status'] = 200;
		$results['data']   = $data;
		echo json_encode($results);
		exit;
	}

	

	public function edit_task($id)
	{
							if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_gtask'))
		{

		$data = array();
		$this->set_title('Edit Task');

		$adduserdata = $this->task_model->gettaskbyid($id);

		if(!$adduserdata)
			redirect("task/all");
		else
			$data = $adduserdata;

		$data['projects_list']  = $this->projects_model->getprojectlist($this->session->userdata('team_id'));
		$data['milestonelist'] 	= $this->milestone_model->getMilestonseList($this->session->userdata('team_id'));
		$data['userlist']		= $this->users_model->getuserdropdown($this->session->userdata('team_id'));
		$data['grouplist']		= $this->groups_model->getgrouplist();
		$data['task_type_list'] = $this->task_type_model->gettypelist();
		$data['parent_task_list'] = $this->task_model->getparenttasklist();
		$data['mode'] 	= "edit";
		$data['action'] = base_url()."task/do_update";
		$data['heading']= "Edit Task";
		$this->view("add_edit_task",$data);
	}
}
	

	public function do_update($id)
	{
$config = array(
	             		array(
	                     'field'   => 'title', 
	                     'label'   => 'title', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'description', 
	                     'label'   => 'description', 
	                     'rules'   => 'trim|required'
	                  ),
						array(
								'field'   => 'assign_uid',
								'label'   => 'Assign User',
								'rules'   => 'trim|required'
						),
					  array(
	                     'field'   => 'department', 
	                     'label'   => 'department', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'unit', 
	                     'label'   => 'unit name', 
	                     'rules'   => 'trim'
	                  ),
					  array(
					  		'field'   => 'priority',
					  		'label'   => 'Task priority',
					  		'rules'   => 'trim|required'
					  ),
					  array(
	                     'field'   => 'budget', 
	                     'label'   => 'budget', 
	                     'rules'   => 'trim|required|numeric'
	                  ),
					  array(
	                     'field'   => 'start_date', 
	                     'label'   => 'start date', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'end_date', 
	                     'label'   => 'end date', 
	                     'rules'   => 'trim|required'
	                  ),
				  
				  array(
	                     'field'   => 'milestone', 
	                     'label'   => 'Milestone', 
	                     'rules'   => 'trim|required'
	                  )
				  
				  
               	);
		$this->form_validation->set_rules($config);

		$fields 	= array ("title","program","project","description","start_date","end_date","assign_uid","priority","budget","department","milestone","unit");

	
					if ($this->form_validation->run()==true) {
					
		
	$insertaraay=[

			"title"=>$this->input->post('title'),
			"program"=>$this->input->post('program'),
			"project"=>$this->input->post('project'),
			"start_date"=>$this->input->post('start_date'),
			"end_date"=>$this->input->post('end_date'),
			"assign_uid"=>$this->input->post('assign_uid'),
			"priority"=>$this->input->post('priority'),
			"budget"=>$this->input->post('budget'),
			"department"=>$this->input->post('department'),
			"milestone"=>$this->input->post('milestone'),
			"unit"=>$this->input->post('unit'),
			"section"=>$this->input->post('section'),
			"description"=>$this->input->post('description'),
			"created_by"=>$this->session->userdata('id')
		];


			if ($this->input->post('assign_uid')) {
				$insertaraay['status']=1;
			}
			else
			{
				$insertaraay['status']=0;
			}

				if($this->input->post('users'))
				{
			$user_ar=$this->input->post('users');
			//print_r($user_ar);
			$uid=implode('-',$user_ar);//array to string 
			//echo $uid;
			$insertaraay['users']=$uid;
		}




			$img='';
     foreach($_FILES['file']['error'] as $k=>$v)
 {
    $uploadfile = 'upload/'. basename($_FILES['file']['name'][$k]);

    $ext=explode('.',$uploadfile);
    $ext=end($ext);
    $f=rand().'.'.$ext;
    if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $f)) 
    {
        $img.=$_FILES['file']['name'][$k].'-';
    }

    

				}
									//print_r($insertaraay);
									$insertaraay['files']=$img;

								$this->db->where('id',$id);
		$this->db->update('taskk',$insertaraay);

				redirect('task/task_editor_list');
			}
			else
			{
				$this->db->order_by('user_name','asc');
				$q=$this->db->get('users');
				$data['users']=$q->result();


					$this->db->order_by('dtitle','asc');
								$q=$this->db->get('department');
				$data['dept']=$q->result();

$this->db->order_by('pro_name','asc');
								$q=$this->db->get('program');
				$data['program']=$q->result();


$this->db->order_by('unit_name','asc');
								$q=$this->db->get('unit');
				$data['unit']=$q->result();
				
				
				$this->db->order_by('section_name','asc');
								$q=$this->db->get('section');
				$data['section']=$q->result();

					$this->db->order_by('milestone_title','asc');
								$q=$this->db->get('milestone');
				$data['milestone']=$q->result();

				$this->db->order_by('project_name','asc');
				$q=$this->db->get('projects');
				$data['projects']=$q->result();
				$this->view('task/create_task',$data);
			}
		}	
	public function changePriority($id,$task_priority)
	{
		$data = array();
		$result = $this->task_model->changePriority($id,$task_priority);

		if($result > 0)
		{
			$data['status'] = 200;
			$data['message'] = "Saved....";
			echo json_encode($data);
			exit;
		}
	}
	
	public function changeStatus($id,$status)
	{
		$data = array();
		$result = $this->task_model->changeStatus($id,$status);
	
		if($result > 0)
		{
			$data['status'] = 200;
			$data['message'] = "Saved....";
			echo json_encode($data);
			exit;
		}
	}

	
	public function get_task_discussion($task_id)
	{
		$data = array();
		$discussion_list = $this->task_model->gettaskcommentbyid($task_id);
		
		if($this->input->is_ajax_request())
		{
			if(!empty($discussion_list))
			{
				$data['status'] = "success";
				$data['data']   = $discussion_list;
				echo json_encode($data);
				exit;
			}
			else
			{
				$data['status'] = "error";
				$data['message'] = "No data found";
				echo json_encode($data);
				exit;
			}
		}
	}
	
	public function do_add_comment()
	{	
		$data = array();
		$config = array(
						array(
								'field'   => 'comment',
								'label'   => 'comment',
								'rules'   => 'trim|required'
							)
						);
		$this->form_validation->set_rules($config);
		
		$fields = array("task_id","comment");
		
		foreach ($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
		if($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data['user_id'] = $this->session->userdata('id');
			$this->task_model->set_fields($data);
				
			$result = $this->task_model->do_save_comment();
				
			if($result > 0)
			{
				
				if($this->input->is_ajax_request())
				{
					$res['status'] = "success";
					$res['message']= "Inserted Successfully";
					echo json_encode($res);
					exit;
				}
				//$this->session->set_flashdata('success',"Comment Added Successfully.");
				//redirect('task/add_comments/'.$data['task_id']);
			}
			else 
			{
				if($this->input->is_ajax_request())
				{
					$res['status'] = "error";
					$res['message']= "Not Inserted";
					echo json_encode($res);
					exit;
				}
			}
		}
	}


	function opentask($id,$status)
	{
		//echo "task id is ".$id."and status is".$status;
		$this->db->select('status');
		$this->db->from('taskk');
		$this->db->where('id',$id);
		$res=$this->db->get();
		$tdata=$res->result();
		$tdata=$tdata[0];

		if($tdata->status==1 or $tdata->status==2)
		{
			$this->change_status($id,$status);
		}

			$this->db->order_by('user_name','asc');
				$q=$this->db->get('users');
				$data['users']=$q->result();


					$this->db->order_by('dtitle','asc');
								$q=$this->db->get('department');
				$data['dept']=$q->result();

$this->db->order_by('pro_name','asc');
								$q=$this->db->get('program');
				$data['program']=$q->result();


$this->db->order_by('unit_name','asc');
								$q=$this->db->get('unit');
				$data['unit']=$q->result();

					$this->db->order_by('milestone_title','asc');
								$q=$this->db->get('milestone');
				$data['milestone']=$q->result();

				$this->db->order_by('project_name','asc');
				$q=$this->db->get('projects');
				$data['projects']=$q->result();


		
			//get task data by id
				$this->db->where('id',$id);
				$res=$this->db->get('taskk');
				$data['singledata']=$res->result();
				//print_r($data);

				$this->view("task/set_complete_form",$data);
		}
	
	/*
		Delete Single Task
	*/
	public function single_task_delete($task_id)
	{
						if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_gtask'))
		{
		$this->task_model->do_delete($task_id);
		echo 1;
		exit;
	}
}
	
	

								function set_score()
								{	
									$this->db->select('*');
									$this->db->from('taskk');
									$this->db->where('created_by',$this->session->userdata('id'));
										$res=$this->db->get();
										$data=$res->result();

												$score=0;
											foreach ($data as $value) {
												
											$end= new DateTime($value->end_date);
											$comp=new DateTime($value->completed_at);
												//var_dump($end>$comp);
												if ($value->status==4 and $comp<$end) {
														
														echo "good ".$value->end_date;
													$score+=2;
															
												}
												else if($value->status==4 and $comp>$end)
												{
													echo " little good.".$value->end_date."<br>";
													$score+=1;
												}
											}
											echo "Task score is".$score;

								}



	/*public function change_user_status($id,$status)
	{
		if($status == 0)
			$data['status'] = 1;
		else
			$data['status'] = 0;
		
		$this->users_model->changeUserStatus($id,$data);
		echo 1;
		exit();
	}*/


				 function generateRandomString($length) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $code=$randomString;
    return $code;
}

							function create_code()
							{
								$res=$this->db->query("select max(poid) as'code' FROM content_production_order");
								//$this->db->from('content_production_order');
								//$res=$this->db->get();
								$data=$res->result();
								$data=$data[0];
										$digit=$data->code;
										$max=$digit;					
								 $max = str_pad($max+1, 5, '0', STR_PAD_LEFT);
								
								 	return $max;
								}



						function content_production_order()
						{
				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_mtask'))
		{

												$this->db->order_by('pro_name','asc');
											$pres=$this->db->get('program');
											$data['program']=$pres->result();

											$this->db->order_by('cname','asc');
											$cres=$this->db->get('content_category');
											$data['category']=$cres->result();

											$this->db->order_by('user_name','asc');
											$ures=$this->db->get('users');
											$data['users']=$ures->result();

											$this->db->order_by('audi_name','asc');
											$ad_res=$this->db->get('audience');
											$data['audience']=$ad_res->result();

											$this->db->order_by('content_name','asc');
											$cont_res=$this->db->get('content');
											$data['content']=$cont_res->result();
											$data['secure_code']=$this->create_code();


										$this->view('task/content_production_order',$data);
						}

					}

										//$this->form_validation->set_rules('number', 'Number', 'callback_validate_24hourtimestamp');

function validate_code()
{
   $c= preg_match('/(?:([\w]{3}))-+([\w]{3})-+([\w]{3})-+([\d]{5})/',"xxx-yyy-zzz-00000");//true
   var_dump($c);
}


										 function pro_order_do_save()
										 {

										 					

										 					$this->form_validation->set_rules('content_category','Content Category','required|trim');
										 					$this->form_validation->set_rules('title','Content Title','required|trim|is_unique[content_production_order.title]');
										 					$this->form_validation->set_rules('code_program','Content Code Program','required');
										 					$this->form_validation->set_rules('audience','Target Audience','required');
										 					$this->form_validation->set_rules('content_type','Content type','required');
										 					$this->form_validation->set_rules('secure_code','Secure','vali');
										 					$this->form_validation->set_rules('task_details','Task Details','required|trim');
										 					$this->form_validation->set_rules('assign_to','Assign To','required|trim');
										 					$this->form_validation->set_rules('users','Task Followers','required');
										 					$this->form_validation->set_rules('end_date','Target Completion Date','required');
															$this->form_validation->set_rules('code_program','Content Code Program','required|trim');
															$this->form_validation->set_rules('department','department','required|trim');
															$this->form_validation->set_rules('unit','Unit','required|trim');
															$this->form_validation->set_rules('program','Program','required|trim');
															$this->form_validation->set_rules('project','project','required|trim');
															$this->form_validation->set_rules('gu_doc','Google Documents','required|trim');
															$this->form_validation->set_rules('milestone','Milestone','required|trim');




															if ($this->form_validation->run()==FALSE) {
																
																$this->db->order_by('pro_name','asc');
											$pres=$this->db->get('program');
											$data['program']=$pres->result();

											$this->db->order_by('cname','asc');
											$cres=$this->db->get('content_category');
											$data['category']=$cres->result();

											$this->db->order_by('user_name','asc');
											$ures=$this->db->get('users');
											$data['users']=$ures->result();

											$this->db->order_by('audi_name','asc');
											$ad_res=$this->db->get('audience');
											$data['audience']=$ad_res->result();

											$this->db->order_by('content_name','asc');
											$cont_res=$this->db->get('content');
											$data['content']=$cont_res->result();
																$this->view('task/content_production_order',$data);
															}
															else
															{

		$arr=[

			"title"=>$this->input->post("title"),
			"content_category"=>$this->input->post("content_category"),
			//"program_of_content_code"=>$this->input->post("code_program"),
			//"target_audience"=>$this->input->post("audience"),
			//"content_type"=>$this->input->post("content_type"),
			"secure_code"=>$this->input->post("secure_code"),
			"task_details"=>$this->input->post("task_details"),
			"gu_doc"=>$this->input->post("gu_doc"),
			
			"assign_to"=>$this->input->post("assign_to"),
			//"followers"=>$this->input->post("users"),
			"end_date"=>$this->input->post("end_date"),
			"program"=>$this->input->post("program"),
			"milestone"=>$this->input->post("milestone"),
			"department"=>$this->input->post("department"),
			"unit"=>$this->input->post("unit"),
			"section"=>$this->input->post("section"),
			"project"=>$this->input->post("project"),
			"created_by"=>$this->session->userdata('id'),
			"status"=>1



			];

					//string to array coz heere two value 1->audience value 2->audi code

					$str=$this->input->post("audience");
					$aud=explode('-',$str);
					$arr["target_audience"]=$aud[0];

					//string to array coz heere two value 1->audience value 2->audi code

					$str1=$this->input->post("code_program");
					$pro=explode('-',$str1);
					$arr["program_of_content_code"]=$pro[0];

							//string to array coz heere two value 1->audience value 2->audi code

					$str2=$this->input->post("content_type");
					$typ=explode('-',$str2);
					$arr["content_type"]=$typ[0];					


										

				if($this->input->post('users')) {
				
			$user_ar=$this->input->post('users');
			//print_r($user_ar);
			$uid=implode('-',$user_ar);//array to string 
			//echo $uid;
			$arr['followers']=$uid;
		}
			



			$img='';
     foreach($_FILES['file']['error'] as $k=>$v)
 {
    $uploadfile = 'upload/'. basename($_FILES['file']['name'][$k]);

    $ext=explode('.',$uploadfile);
    $ext=end($ext);
    $f=rand().'.'.$ext;
    if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $f)) 
    {
        $img.=$_FILES['file']['name'][$k].'-';
    }

    

				}
									//print_r($arr);
									$arr['files']=$img;

                    
								$isSaved=$this->db->insert("content_production_order",$arr);
								            
								            if($isSaved)
								            {
								                $emails=$this->user_role_model->getEmail($arr['assign_to']);
                                            	 foreach ($emails as $value) {
					         if($value->email != '' and $value->email != 'aapnavneet@gmail.com')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/program.html");
					$emailBody = str_replace("<@pro_name@>",$arr['title'],$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
				
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Marketing Task Management - Production Task Created ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
					{
						echo "email not sent";
						$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
					
				
					
					
				}
				else 
				{
					echo"InValid Email";
					$this->session->set_flashdata( "errors", "Please enter valid email address.");
			
				}
				         
	            	}	           
			        	}
			        	// var_dump($emails);
								            }
								
									redirect('task/content_production_order_list');
								


															}
										 					
										 }


										 function content_production_order_list()
										 {


				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_mtask'))
		{

							$this->db->select('content_production_order.status,users.user_name,content_production_order.poid,content_production_order.title,content_production_order.created_by,content_production_order.created_at,content_production_order.secure_code,content_production_order.project,program.pro_name,content_production_order.end_date,audience.audi_name,content_category.cname,content.content_name,content_production_order.assign_to');
					$this->db->from('content_production_order');
					$this->db->join('program','program.pid=content_production_order.program');
					$this->db->join('audience','audience.aid=content_production_order.target_audience');
					$this->db->join('users','users.id=content_production_order.assign_to');
					$this->db->join('content_category','content_category.cid=content_production_order.content_category');
					$this->db->join('content','content.cont_id=content_production_order.content_type');
						
					//$this->db->where('content_production_order.assign_to',$this->session->userdata('id'));

						$data=$this->db->get();
						$res=$data->result();
						$mydata['productionlist']=$res;
						
									$this->view('task/content_production_order_list',$mydata);


												}

										 }



										 function content_production_order_delete_list()
										 {


				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_mtask'))
		{

							$this->db->select('content_production_order.status,users.user_name,content_production_order.poid,content_production_order.title,content_production_order.created_by,content_production_order.created_at,content_production_order.secure_code,content_production_order.project,program.pro_name,content_production_order.end_date,audience.audi_name,content_category.cname,content.content_name,content_production_order.assign_to');
					$this->db->from('content_production_order');
					$this->db->join('program','program.pid=content_production_order.program');
					$this->db->join('audience','audience.aid=content_production_order.target_audience');
					$this->db->join('users','users.id=content_production_order.assign_to');
					$this->db->join('content_category','content_category.cid=content_production_order.content_category');
					$this->db->join('content','content.cont_id=content_production_order.content_type');
						
					//$this->db->where('content_production_order.assign_to',$this->session->userdata('id'));

						$data=$this->db->get();
						$res=$data->result();
						$mydata['productionlist']=$res;
						
									$this->view('task/content_production_order_delete',$mydata);
					}
										 }





										 		function  production_delete($poid,$created_by)
									{
														

														if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_mtask'))
								{

														if ($created_by==$this->session->userdata('id')&& !empty($poid)) {
												

												$this->db->where('poid',$poid);
												$this->db->delete('content_production_order');
												redirect('task/content_production_order_delete_list');

												}
												else
												{
											$this->view('error');
										}

									}

								}




									function content_production_order_edit_list()
										 {

							if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_mtask'))
				{

							$this->db->select('content_production_order.status,users.user_name,content_production_order.poid,content_production_order.title,content_production_order.created_by,content_production_order.created_at,content_production_order.secure_code,content_production_order.project,program.pro_name,content_production_order.end_date,audience.audi_name,content_category.cname,content.content_name,content_production_order.assign_to');
					$this->db->from('content_production_order');
					$this->db->join('program','program.pid=content_production_order.program');
					$this->db->join('audience','audience.aid=content_production_order.target_audience');
					$this->db->join('users','users.id=content_production_order.assign_to');
					$this->db->join('content_category','content_category.cid=content_production_order.content_category');
					$this->db->join('content','content.cont_id=content_production_order.content_type');
						
					//$this->db->where('content_production_order.assign_to',$this->session->userdata('id'));

						$data=$this->db->get();
						$res=$data->result();
						$mydata['productionlist']=$res;

						
									$this->view('task/content_production_order_edit_list',$mydata);
										 }

								}


										 function  production_edit($poid,$created_by)
									{
										
														if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_mtask'))
		{

										if ($created_by==$this->session->userdata('id')&& !empty($poid)) {
												

													$this->db->order_by('pro_name','asc');
											$pres=$this->db->get('program');
											$data['program']=$pres->result();

											$this->db->order_by('cname','asc');
											$cres=$this->db->get('content_category');
											$data['category']=$cres->result();

											$this->db->order_by('user_name','asc');
											$ures=$this->db->get('users');
											$data['users']=$ures->result();

											$this->db->order_by('audi_name','asc');
											$ad_res=$this->db->get('audience');
											$data['audience']=$ad_res->result();

											$this->db->order_by('content_name','asc');
											$cont_res=$this->db->get('content');
											$data['content']=$cont_res->result();
											
												$this->db->order_by('section_name','asc');
											$cont_res=$this->db->get('section');
											$data['section']=$cont_res->result();

											$mile_res=$this->db->get('milestone');
											$data['milestone']=$mile_res->result();

										$project_res=$this->db->get('projects');
											$data['projects']=$project_res->result();

										$unit_res=$this->db->get('unit');
											$data['unit']=$unit_res->result();

										$dept_res=$this->db->get('department');
											$data['dept']=$dept_res->result();





												$this->db->where('poid',$poid);

												$this->db->where('created_by',$created_by);
												
												$res=$this->db->get('content_production_order');
												$production_data=$res->result();
												$data['production_data']=$production_data[0];
												$this->view('task/edit_production',$data);

										}
										else
										{
											$this->view('error');
										}
											}
									}



	function content_production_order_view_list()
										 {


		if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_mtask'))
		{

							$this->db->select('content_production_order.status,users.user_name,content_production_order.poid,content_production_order.title,content_production_order.created_by,content_production_order.created_at,content_production_order.secure_code,content_production_order.project,program.pro_name,content_production_order.end_date,audience.audi_name,content_category.cname,content.content_name,content_production_order.assign_to');
									$this->db->from('content_production_order');
									$this->db->join('program','program.pid=content_production_order.program');
									$this->db->join('audience','audience.aid=content_production_order.target_audience');
									$this->db->join('users','users.id=content_production_order.assign_to');
									$this->db->join('content_category','content_category.cid=content_production_order.content_category');
									$this->db->join('content','content.cont_id=content_production_order.content_type');
						
					//$this->db->where('content_production_order.assign_to',$this->session->userdata('id'));

						$data=$this->db->get();
						$res=$data->result();
						$mydata['productionlist']=$res;
						
									$this->view('task/content_production_order_view_list',$mydata);
										 }

										}

												//view production 
										 function  production_view($poid)
									{
	if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_mtask'))
		{

										if (!empty($poid)) {
												

													$this->db->order_by('pro_name','asc');
											$pres=$this->db->get('program');
											$data['program']=$pres->result();

											$this->db->order_by('cname','asc');
											$cres=$this->db->get('content_category');
											$data['category']=$cres->result();

											$this->db->order_by('user_name','asc');
											$ures=$this->db->get('users');
											$data['users']=$ures->result();

											$this->db->order_by('audi_name','asc');
											$ad_res=$this->db->get('audience');
											$data['audience']=$ad_res->result();

											$this->db->order_by('content_name','asc');
											$cont_res=$this->db->get('content');
											$data['content']=$cont_res->result();

											$mile_res=$this->db->get('milestone');
											$data['milestone']=$mile_res->result();

										$project_res=$this->db->get('projects');
											$data['projects']=$project_res->result();

										$unit_res=$this->db->get('unit');
											$data['unit']=$unit_res->result();

										$dept_res=$this->db->get('department');
											$data['dept']=$dept_res->result();





												$this->db->where('poid',$poid);

												
												
												$res=$this->db->get('content_production_order');
												$production_data=$res->result();
												$data['production_data']=$production_data[0];
												$this->view('task/view_production',$data);

										}
										else
										{
											$this->view('error');
										}
												}
									}







											function pro_order_do_update($poid,$created_by)
											{

			if(!empty($poid) and $this->session->userdata('id')==$created_by)
{
					$this->form_validation->set_rules('content_category','Content Category','required|trim');
					$this->form_validation->set_rules('title','Content Title','required|trim');
					$this->form_validation->set_rules('code_program','Content Code Program','required|trim');
					$this->form_validation->set_rules('audience','Target Audience','required|trim');
					$this->form_validation->set_rules('content_type','Content type','required|trim');
					$this->form_validation->set_rules('secure_code','Secure','vali');
					$this->form_validation->set_rules('task_details','Task Details','required|trim');
					$this->form_validation->set_rules('assign_to','Assign To','required|trim');
					$this->form_validation->set_rules('users','Task Followers','required');
					$this->form_validation->set_rules('end_date','Target Completion Date','required');
					$this->form_validation->set_rules('code_program','Content Code Program','required|trim');
					$this->form_validation->set_rules('department','department','required|trim');
					$this->form_validation->set_rules('unit','Unit','required|trim');
					$this->form_validation->set_rules('program','Program','required|trim');
					$this->form_validation->set_rules('project','project','required|trim');
					$this->form_validation->set_rules('gu_doc','Google Documents','required|trim');
					$this->form_validation->set_rules('milestone','Milestone','required|trim');




															if ($this->form_validation->run()==FALSE) {
																
																$this->db->order_by('pro_name','asc');
											$pres=$this->db->get('program');
											$data['program']=$pres->result();

											$this->db->order_by('cname','asc');
											$cres=$this->db->get('content_category');
											$data['category']=$cres->result();

											$this->db->order_by('user_name','asc');
											$ures=$this->db->get('users');
											$data['users']=$ures->result();

											$this->db->order_by('audi_name','asc');
											$ad_res=$this->db->get('audience');
											$data['audience']=$ad_res->result();

											$this->db->order_by('content_name','asc');
											$cont_res=$this->db->get('content');
											$data['content']=$cont_res->result();
																$this->view('task/content_production_order',$data);
															}
															else
															{

		$arr=[

			"title"=>$this->input->post("title"),
			"content_category"=>$this->input->post("content_category"),
			"program_of_content_code"=>$this->input->post("code_program"),
			"target_audience"=>$this->input->post("audience"),
			"content_type"=>$this->input->post("content_type"),
			"secure_code"=>$this->input->post("secure_code"),
			"task_details"=>$this->input->post("task_details"),
			"gu_doc"=>$this->input->post("gu_doc"),
			
			"assign_to"=>$this->input->post("assign_to"),
			//"followers"=>$this->input->post("users"),
			"end_date"=>$this->input->post("end_date"),
			"program"=>$this->input->post("program"),
			"milestone"=>$this->input->post("milestone"),
			"department"=>$this->input->post("department"),
			"unit"=>$this->input->post("unit"),
			"project"=>$this->input->post("project"),
			"section"=>$this->input->post("section"),
			"created_by"=>$this->session->userdata('id'),
			"status"=>1



			];


			if ($this->input->post('users')) {
			
		$user_ar=$this->input->post('users');
			//print_r($user_ar);
			$uid=implode('-',$user_ar);//array to string 
			//echo $uid;
			$arr['followers']=$uid;

			}



			$img='';
     foreach($_FILES['file']['error'] as $k=>$v)
 {
    $uploadfile = 'upload/'. basename($_FILES['file']['name'][$k]);

    $ext=explode('.',$uploadfile);
    $ext=end($ext);
    $f=rand().'.'.$ext;
    if (move_uploaded_file($_FILES['file']['tmp_name'][$k], $f)) 
    {
        $img.=$_FILES['file']['name'][$k].'-';
    }

    

				}
									//print_r($arr);
									$arr['files']=$img;

										$this->db->where('poid',$poid);
								$isSaved=$this->db->update("content_production_order",$arr);
								if($isSaved)
								            {
								                $emails=$this->user_role_model->getEmail($arr['assign_to']);
                                            	 foreach ($emails as $value) {
					         if($value->email != '' and $value->email != 'aapnavneet@gmail.com')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/program.html");
					$emailBody = str_replace("<@pro_name@>",$arr['title'],$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
				
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Marketing Task Management - Production Task Updated ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
					{
						echo "email not sent";
						$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
					
				
					
					
				}
				else 
				{
					echo"InValid Email";
					$this->session->set_flashdata( "errors", "Please enter valid email address.");
			
				}
				         
	            	}	           
			        	}
			        	// var_dump($emails);
								            }
								redirect('task/content_production_order_list');
								


															}
														}

											}



											function content_publish()
											{

						if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_pub_task'))
		{

											$this->db->order_by('pro_name','asc');
											$pres=$this->db->get('program');
											$data['program']=$pres->result();

											$this->db->order_by('cname','asc');
											$cres=$this->db->get('content_category');
											$data['category']=$cres->result();

											$this->db->order_by('group_name','asc');
											$gres=$this->db->get('avenue_group');
											$data['group_avenue']=$gres->result();

										$this->db->order_by('channel_name','asc');
											$chres=$this->db->get('channel');
											$data['channel']=$chres->result();

											$this->db->order_by('user_name','asc');
											$ures=$this->db->get('users');
											$data['users']=$ures->result();

											$this->db->order_by('audi_name','asc');
											$ad_res=$this->db->get('audience');
											$data['audience']=$ad_res->result();

											$this->db->order_by('content_name','asc');
											$cont_res=$this->db->get('content');
											$data['content']=$cont_res->result();

													$this->view('task/publish/content_publish',$data);
												}

											}





function do_save_publish_content()
{



		$this->form_validation->set_rules('cont_cat','Content category','required|trim');
		$this->form_validation->set_rules('content_code','Content Code','required|trim');
		$this->form_validation->set_rules('content_type','','required|trim');
		$this->form_validation->set_rules('task_id','task ID','required|trim');
		$this->form_validation->set_rules('task_name','Task Name','required|trim');
		$this->form_validation->set_rules('is_text','Include Text','valid_url');
		$this->form_validation->set_rules('is_video','Video Include','valid_url');
		$this->form_validation->set_rules('is_image','Image Include','valid_url');
		$this->form_validation->set_rules('is_keywords','Keywords Include','valid_url');
		$this->form_validation->set_rules('is_landing','Lnading Page','required');
		$this->form_validation->set_rules('task_details','Task Details','required|trim');
		$this->form_validation->set_rules('channel','Channel','required|trim');
		$this->form_validation->set_rules('group','group_name','required|trim');
		$this->form_validation->set_rules('users','Followers','required');
		$this->form_validation->set_rules('end_date','Target Completion date','required');
		$this->form_validation->set_rules('start_date','Target Start Date','required');
		$this->form_validation->set_rules('program','Program','required|trim');
		$this->form_validation->set_rules('milestone','Milestone','required|trim');
		$this->form_validation->set_rules('unit','Unit','required|trim');
		$this->form_validation->set_rules('project','Prroject','required|trim');
		$this->form_validation->set_rules('department','Department','required|trim');
		$this->form_validation->set_rules('assign_to','Assign To','required|trim');


		if ($this->form_validation->run()==FALSE) {
								

								$this->db->order_by('pro_name','asc');
											$pres=$this->db->get('program');
											$data['program']=$pres->result();

											$this->db->order_by('cname','asc');
											$cres=$this->db->get('content_category');
											$data['category']=$cres->result();

											$this->db->order_by('group_name','asc');
											$gres=$this->db->get('avenue_group');
											$data['group_avenue']=$gres->result();

										$this->db->order_by('channel_name','asc');
											$chres=$this->db->get('channel');
											$data['channel']=$chres->result();

											$this->db->order_by('user_name','asc');
											$ures=$this->db->get('users');
											$data['users']=$ures->result();

											$this->db->order_by('cname','asc');
											$ad_res=$this->db->get('content_category');
											$data['category']=$ad_res->result();

											$this->db->order_by('content_name','asc');
											$cont_res=$this->db->get('content');
											$data['content']=$cont_res->result();

							$this->view('task/publish/content_publish',$data);	
		}
		else
		{


						$arr=[

		"cont_cat"=>$this->input->post('cont_cat'),
	"content_code"=>$this->input->post('content_code'),
	"content_type"=>$this->input->post('content_type'),
	     "task_id"=>$this->input->post('task_id'),
   	  "task_name"=>$this->input->post('task_name'),
		"is_text"=>$this->input->post('is_text'),
		"is_video"=>$this->input->post('is_video'),
		"is_image"=>$this->input->post('is_image'),
		"is_keyword"=>$this->input->post('is_keyword'),
		"is_landing"=>$this->input->post('is_landing'),
		"task_details"=>$this->input->post('task_details'),
		"channel"=>$this->input->post('channel'),
		"avenue_group"=>$this->input->post('avenue_group'),
		//"followers"=>$this->input->post('followers'),
		"end_date"=>$this->input->post('end_date'),
		"start_date"=>$this->input->post('start_date'),
		"program"=>$this->input->post('program'),
		"milestone"=>$this->input->post('milestone'),
		"unit"=>$this->input->post('unit'),
		"section"=>$this->input->post('section'),
		"project"=>$this->input->post('project'),
				"assign_to"=>$this->input->post('assign_to'),
		"department"=>$this->input->post('department'),
				"avenue_group"=>$this->input->post('group'),
				"channel"=>$this->input->post('channel'),
		
		"created_by"=>$this->session->userdata('id'),
		"status"=>1
		];
			
			if ($this->input->post('users')) {
			
			$user_ar=$this->input->post('users');
			//print_r($user_ar);
			$uid=implode('-',$user_ar);//array to string 
			//echo $uid;
			$arr['followers']=$uid;
		}	
							
							$isSaved=$this->db->insert('content_published',$arr);
							if($isSaved)
								            {
								                $emails=$this->user_role_model->getEmail($arr['assign_to']);
                                            	 foreach ($emails as $value) {
					         if($value->email != '' and $value->email != 'aapnavneet@gmail.com')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/program.html");
					$emailBody = str_replace("<@pro_name@>",$arr['task_name'],$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
				
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Marketing Task Management - Published Task Created ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
					{
						echo "email not sent";
						$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
					
				
					
					
				}
				else 
				{
					echo"InValid Email";
					$this->session->set_flashdata( "errors", "Please enter valid email address.");
			
				}
				         
	            	}	           
			        	}
			        	// var_dump($emails);
								            }
							redirect('task/published_list/view');
		}





}


			function published_list($action)
			{

								if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_pub_task') or $this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_pub_task') or $this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_pub_task'))
		{
							if (!empty($action)) {
								
											switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Published View List";
								 						break;
								 							case 'edit':
								 	$data['heading']="Published Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Published Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Published View List";
								 						break;
								 				}

								 				$this->db->select('content_published.status,content_published.id,content_published.task_name,content_category.cname,content_published.task_id,channel.channel_name,avenue_group.group_name,users.user_name,content_published.end_date,program.pro_name');
								 				$this->db->from('content_published');
								 				$this->db->join('channel','channel.id=content_published.channel');
								 				$this->db->join('users','users.id=content_published.assign_to','left');
								 				$this->db->join('content_category','content_category.cid=content_published.cont_cat');
								 				$this->db->join('program','program.pid=content_published.program');
								 				$this->db->join('avenue_group','avenue_group.gid=content_published.avenue_group');
								 					$res=$this->db->get();
								 			$data['published_list']=$res->result();
								 				
								 				$this->view('task/publish/published_list',$data);

								}


							}
			}	


							function edit_published_content($id,$static_view=null)
							{
						if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_pub_task'))
											if (!empty($id)) {
												
											if (!empty($static_view)) {
												$data['static_view']=$static_view;
											}


								$this->db->order_by('dtitle','asc');
								$q=$this->db->get('department');
				$data['dept']=$q->result();



								$this->db->order_by('unit_name','asc');
								$q=$this->db->get('unit');
				$data['unit']=$q->result();

					$this->db->order_by('milestone_title','asc');
								$q=$this->db->get('milestone');
				$data['milestone']=$q->result();

				$this->db->order_by('project_name','asc');
				$q=$this->db->get('projects');
				$data['projects']=$q->result();

														$this->db->order_by('pro_name','asc');
											$pres=$this->db->get('program');
											$data['program']=$pres->result();

											$this->db->order_by('cname','asc');
											$cres=$this->db->get('content_category');
											$data['category']=$cres->result();

											$this->db->order_by('group_name','asc');
											$gres=$this->db->get('avenue_group');
											$data['group_avenue']=$gres->result();

										$this->db->order_by('channel_name','asc');
											$chres=$this->db->get('channel');
											$data['channel']=$chres->result();

											$this->db->order_by('user_name','asc');
											$ures=$this->db->get('users');
											$data['users']=$ures->result();

											$this->db->order_by('audi_name','asc');
											$ad_res=$this->db->get('audience');
											$data['audience']=$ad_res->result();

											$this->db->order_by('content_name','asc');
											$cont_res=$this->db->get('content');
											$data['content']=$cont_res->result();

											$this->db->where('id',$id);
											$pubres=$this->db->get('content_published');
											$published_data=$pubres->result();
												$data['published_data']=$published_data[0];

											$this->view('task/publish/edit_published_content',$data);


										}

									}		
									
									
									
									
									function view_published_content($id)
							{
						if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_pub_task'))
								if (!empty($id)) {
												
											


								$this->db->order_by('dtitle','asc');
								$q=$this->db->get('department');
				$data['dept']=$q->result();



								$this->db->order_by('unit_name','asc');
								$q=$this->db->get('unit');
				$data['unit']=$q->result();

					$this->db->order_by('milestone_title','asc');
								$q=$this->db->get('milestone');
				$data['milestone']=$q->result();

				$this->db->order_by('project_name','asc');
				$q=$this->db->get('projects');
				$data['projects']=$q->result();

														$this->db->order_by('pro_name','asc');
											$pres=$this->db->get('program');
											$data['program']=$pres->result();

											$this->db->order_by('cname','asc');
											$cres=$this->db->get('content_category');
											$data['category']=$cres->result();

											$this->db->order_by('group_name','asc');
											$gres=$this->db->get('avenue_group');
											$data['group_avenue']=$gres->result();

										$this->db->order_by('channel_name','asc');
											$chres=$this->db->get('channel');
											$data['channel']=$chres->result();

											$this->db->order_by('user_name','asc');
											$ures=$this->db->get('users');
											$data['users']=$ures->result();

											$this->db->order_by('audi_name','asc');
											$ad_res=$this->db->get('audience');
											$data['audience']=$ad_res->result();

											$this->db->order_by('content_name','asc');
											$cont_res=$this->db->get('content');
											$data['content']=$cont_res->result();
											
											
											$this->db->order_by('section_name','asc');
											$cont_res=$this->db->get('section');
											$data['section']=$cont_res->result();

											$this->db->where('id',$id);
											$pubres=$this->db->get('content_published');
											$published_data=$pubres->result();
												$data['published_data']=$published_data[0];



											$this->view('task/publish/view_published_content',$data);


										}

									}		

								


							function do_update_publish_content($id,$static_view=null)
{



		$this->form_validation->set_rules('cont_cat','Content category','required|trim');
		$this->form_validation->set_rules('content_code','Content Code','required|trim');
		$this->form_validation->set_rules('content_type','','required|trim');
		$this->form_validation->set_rules('task_id','task ID','required|trim');
		$this->form_validation->set_rules('task_name','Task Name','required|trim');
		$this->form_validation->set_rules('is_text','Include Text','valid_url');
		$this->form_validation->set_rules('is_video','Video Include','valid_url');
		$this->form_validation->set_rules('is_image','Image Include','valid_url');
		$this->form_validation->set_rules('is_keywords','Keywords Include','valid_url');
		$this->form_validation->set_rules('is_landing','Lnading Page','required');
		$this->form_validation->set_rules('task_details','Task Details','required|trim');
		$this->form_validation->set_rules('channel','Channel','required|trim');
		$this->form_validation->set_rules('group','group_name','required|trim');
		$this->form_validation->set_rules('users','Followers','required');
		$this->form_validation->set_rules('end_date','Target Completion date','required');
		$this->form_validation->set_rules('start_date','Target Start Date','required');
		$this->form_validation->set_rules('program','Program','required|trim');
		$this->form_validation->set_rules('milestone','Milestone','required|trim');
		$this->form_validation->set_rules('unit','Unit','required|trim');
		$this->form_validation->set_rules('project','Prroject','required|trim');
		$this->form_validation->set_rules('department','Department','required|trim');
		$this->form_validation->set_rules('assign_to','Assign To','required|trim');


		if ($this->form_validation->run()==FALSE) {
								

								$this->db->order_by('pro_name','asc');
											$pres=$this->db->get('program');
											$data['program']=$pres->result();

											$this->db->order_by('cname','asc');
											$cres=$this->db->get('content_category');
											$data['category']=$cres->result();

											$this->db->order_by('group_name','asc');
											$gres=$this->db->get('avenue_group');
											$data['group_avenue']=$gres->result();

										$this->db->order_by('channel_name','asc');
											$chres=$this->db->get('channel');
											$data['channel']=$chres->result();

											$this->db->order_by('user_name','asc');
											$ures=$this->db->get('users');
											$data['users']=$ures->result();

											$this->db->order_by('cname','asc');
											$ad_res=$this->db->get('content_category');
											$data['category']=$ad_res->result();

											$this->db->order_by('content_name','asc');
											$cont_res=$this->db->get('content');
											$data['content']=$cont_res->result();
											
											
											$this->db->order_by('section_name','asc');
											$cont_res=$this->db->get('section');
											$data['section']=$cont_res->result();

							$this->view('task/publish/content_publish',$data);	
		}
		else
		{


						$arr=[

		"cont_cat"=>$this->input->post('cont_cat'),
	"content_code"=>$this->input->post('content_code'),
	"content_type"=>$this->input->post('content_type'),
	     "task_id"=>$this->input->post('task_id'),
   	  "task_name"=>$this->input->post('task_name'),
		"is_text"=>$this->input->post('is_text'),
		"is_video"=>$this->input->post('is_video'),
		"is_image"=>$this->input->post('is_image'),
		"is_keyword"=>$this->input->post('is_keyword'),
		"is_landing"=>$this->input->post('is_landing'),
		"task_details"=>$this->input->post('task_details'),
		"channel"=>$this->input->post('channel'),
		"avenue_group"=>$this->input->post('avenue_group'),
		//"followers"=>$this->input->post('followers'),
		"end_date"=>$this->input->post('end_date'),
		"start_date"=>$this->input->post('start_date'),
		"program"=>$this->input->post('program'),
		"milestone"=>$this->input->post('milestone'),
		"unit"=>$this->input->post('unit'),
			"section"=>$this->input->post('section'),
		"project"=>$this->input->post('project'),
				"assign_to"=>$this->input->post('assign_to'),
		"department"=>$this->input->post('department'),
				"avenue_group"=>$this->input->post('group'),
				"channel"=>$this->input->post('channel'),
		
		"created_by"=>$this->session->userdata('id')
		];

			$user_ar=$this->input->post('users');
			//print_r($user_ar);
			$uid=implode('-',$user_ar);//array to string 
			//echo $uid;
			$arr['followers']=$uid;
							
							$this->db->where('id',$id);
							$isSaved=$this->db->update('content_published',$arr);
							if($isSaved)
								            {
								                $emails=$this->user_role_model->getEmail($arr['assign_to']);
                                            	 foreach ($emails as $value) {
					         if($value->email != '' and $value->email != 'aapnavneet@gmail.com')
			{
				if(filter_var($value->email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/program.html");
					$emailBody = str_replace("<@pro_name@>",$arr['task_name'],$emailBody);
					$emailBody = str_replace("<@user_name@>",$this->user_role_model->get_user_name($value->email),$emailBody);
				
					$emailBody = str_replace("<@admin@>",$this->session->userdata('user_name'),$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($value->email, "Marketing Task Management - Published Task Updated ".$this->session->userdata('user_name')."'s Team.", $emailBody, $headers))
					{
						echo "email not sent";
						$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
					
				
					
					
				}
				else 
				{
					echo"InValid Email";
					$this->session->set_flashdata( "errors", "Please enter valid email address.");
			
				}
				         
	            	}	           
			        	}
			        	// var_dump($emails);
								            }
							redirect('task/published_list/edit');
		}





}
				function delete_published_content($id)
				{
						if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_pub_task'))
						{
					$this->db->where('id',$id);
					$this->db->delete('content_published');
					redirect('task/published_list/delete');
						}//close	
				}


				function add_response_recorder()
				{

					if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_response_task'))
						{
						$this->db->order_by('avenue_name','asc');
						$res=$this->db->get('avenue');
						$data['avenue']=$res->result();
												$this->db->order_by('channel_name','asc');
						$cres=$this->db->get('channel');
						$data['channel']=$cres->result();
												$this->db->order_by('dtitle','asc');
						$dres=$this->db->get('department');
						$data['department']=$dres->result();
						$this->db->order_by('user_name','asc');
						$res=$this->db->get('users');
						$data['users']=$res->result();

						$this->db->order_by('type_name','asc');
						$res=$this->db->get('response_type');
						$data['response_type']=$res->result();


						$this->db->order_by('id','asc');
						$res=$this->db->get('replies');
						$data['replies']=$res->result();


						$this->view('task/response_recorder/add_response_recorder',$data);
				}//close
			}	



				function do_save_recorder()
				{

									$this->form_validation->set_rules('avenue_name','Avenue','required|trim');
									$this->form_validation->set_rules('title','Response Title','required|trim');
									$this->form_validation->set_rules('res_type','Response Type','required|trim');
									$this->form_validation->set_rules('response','Response','required|trim');
									$this->form_validation->set_rules('rdate','Response Date','required');
									$this->form_validation->set_rules('rtime','Response Time','required|trim');
									$this->form_validation->set_rules('suggested_reply','Suggested Reply','required');
									$this->form_validation->set_rules('post_url','Post URL','required');
									$this->form_validation->set_rules('responder_url','Responder Url','required');
									$this->form_validation->set_rules('given_reply','Given Reply','required');
									$this->form_validation->set_rules('reply_by','Reply By','required|trim');
									$this->form_validation->set_rules('dept','Department','');



									if ($this->form_validation->run()==FALSE) {
										
						$this->db->order_by('avenue_name','asc');
						$res=$this->db->get('avenue');
						$data['avenue']=$res->result();
												$this->db->order_by('channel_name','asc');
						$cres=$this->db->get('channel');
						$data['channel']=$cres->result();
												$this->db->order_by('dtitle','asc');
						$dres=$this->db->get('department');
						$data['department']=$dres->result();
						$this->db->order_by('user_name','asc');
						$res=$this->db->get('users');
						$data['users']=$res->result();

						$this->db->order_by('type_name','asc');
						$res=$this->db->get('response_type');
						$data['response_type']=$res->result();


						$this->db->order_by('id','asc');
						$res=$this->db->get('replies');
						$data['replies']=$res->result();


						$this->view('task/response_recorder/add_response_recorder',$data);

									}
									else
									{
										$recorderdata=[

													"avenue_name"=>$this->input->post("avenue_name"),
													"title"=>$this->input->post("title"),
													"res_type"=>$this->input->post("res_type"),
													"response"=>$this->input->post("response"),
													"rdate"=>$this->input->post("rdate"),
													"rtime"=>$this->input->post("rtime"),
													"suggested_reply"=>$this->input->post("suggested_reply"),
													"post_url"=>$this->input->post("post_url"),
													"responder_url"=>$this->input->post("responder_url"),
													"given_reply"=>$this->input->post("given_reply"),
													"reply_by"=>$this->input->post("reply_by"),
													"reply_time"=>$this->input->post("reply_time"),
													"dept"=>$this->input->post("dept"),
													"created_by"=>$this->session->userdata('id')
												];

														$this->db->insert('response_recorder',$recorderdata);



														redirect('task/response_recorder_list/view');


									}

				}



		function response_recorder_list($action)
		{

				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_response_task') or $this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_response_task') or $this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_response_task'))
						{

							if (!empty($action)) {
								
											switch ($action) {
								 					case 'view':
								 	
								 	$data['view_as']="view_list";
								 	$data['heading']="Response Recorder View";
								 						break;
								 							case 'edit':
								 	$data['heading']="Response Recorder Edit List";
								 	$data['view_as']="edit_list";
								 						break;
								 							case 'delete':
								 	$data['heading']="Response Recorder Delete List";
								 	$data['view_as']="delete_list";
								 						break;
								 					
								 					default:
								 					$data['view_as']="view_list";
								 	$data['heading']="Response Recorder View List";
								 						break;
								 				}

								 	$this->db->select('response_recorder.rec_id,response_recorder.title,response_type.type_name,response_recorder.reply_by,avenue.avenue_name');
								 	$this->db->from('response_recorder');
								$this->db->join('avenue','avenue.id=response_recorder.avenue_name');

								$this->db->join('response_type','response_type.id=response_recorder.res_type');
								$res=$this->db->get();
								$recordlist=$res->result();
								$data['recordlist']=$recordlist;
								$this->view('task/response_recorder/response_list',$data);
				}
			}
		}			
											

			function edit_response_recorder($id,$static_view=null)
				{
						

						if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_response_task'))
						{
					if(!empty($id))
						
					{

						if ($static_view=='static_view') {
							
							$data['static_view']=$static_view;
						}

						$this->db->order_by('avenue_name','asc');
						$res=$this->db->get('avenue');
						$data['avenue']=$res->result();
												$this->db->order_by('channel_name','asc');
						$cres=$this->db->get('channel');
						$data['channel']=$cres->result();
												$this->db->order_by('dtitle','asc');
						$dres=$this->db->get('department');
						$data['department']=$dres->result();
						$this->db->order_by('user_name','asc');
						$res=$this->db->get('users');
						$data['users']=$res->result();

						$this->db->order_by('type_name','asc');
						$res=$this->db->get('response_type');
						$data['response_type']=$res->result();


						$this->db->order_by('id','asc');
						$res=$this->db->get('replies');
						$data['replies']=$res->result();

						$this->db->where('rec_id',$id);
						$resl=$this->db->get('response_recorder');
						$response=$resl->result();
						$data['responselist']=$response[0];



						$this->view('task/response_recorder/edit_response_recorder',$data);
					}

				}//close
				}	


							function view_response_recorder($id,$static_view=null)
				{
						

						if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_response_task'))
						{
					if(!empty($id))
						
					{

						if ($static_view=='static_view') {
							
							$data['static_view']=$static_view;
						}

						$this->db->order_by('avenue_name','asc');
						$res=$this->db->get('avenue');
						$data['avenue']=$res->result();
												$this->db->order_by('channel_name','asc');
						$cres=$this->db->get('channel');
						$data['channel']=$cres->result();
												$this->db->order_by('dtitle','asc');
						$dres=$this->db->get('department');
						$data['department']=$dres->result();
						$this->db->order_by('user_name','asc');
						$res=$this->db->get('users');
						$data['users']=$res->result();

						$this->db->order_by('type_name','asc');
						$res=$this->db->get('response_type');
						$data['response_type']=$res->result();


						$this->db->order_by('id','asc');
						$res=$this->db->get('replies');
						$data['replies']=$res->result();

						$this->db->where('rec_id',$id);
						$resl=$this->db->get('response_recorder');
						$response=$resl->result();
						$data['responselist']=$response[0];



						$this->view('task/response_recorder/view_response_recorder',$data);
					}

				}//close
				}	


				function do_update_recorder($id)
				{

									
					if (!empty($id)) {
					

									$this->form_validation->set_rules('avenue_name','Avenue','required|trim');
									$this->form_validation->set_rules('title','Response Title','required|trim');
									$this->form_validation->set_rules('res_type','Response Type','required|trim');
									$this->form_validation->set_rules('response','Response','required|trim');
									$this->form_validation->set_rules('rdate','Response Date','required');
									$this->form_validation->set_rules('rtime','Response Time','required|trim');
									$this->form_validation->set_rules('suggested_reply','Suggested Reply','required');
									$this->form_validation->set_rules('post_url','Post URL','');
									$this->form_validation->set_rules('responder_url','Responder Url','');
									$this->form_validation->set_rules('given_reply','Given Reply','required');
									$this->form_validation->set_rules('reply_by','Reply By','required|trim');
									$this->form_validation->set_rules('dept','Department','');



									if ($this->form_validation->run()==FALSE) {
										
						$this->db->order_by('avenue_name','asc');
						$res=$this->db->get('avenue');
						$data['avenue']=$res->result();
												$this->db->order_by('channel_name','asc');
						$cres=$this->db->get('channel');
						$data['channel']=$cres->result();
												$this->db->order_by('dtitle','asc');
						$dres=$this->db->get('department');
						$data['department']=$dres->result();
						$this->db->order_by('user_name','asc');
						$res=$this->db->get('users');
						$data['users']=$res->result();

						$this->db->order_by('type_name','asc');
						$res=$this->db->get('response_type');
						$data['response_type']=$res->result();


						$this->db->order_by('id','asc');
						$res=$this->db->get('replies');
						$data['replies']=$res->result();
						$this->db->where('rec_id',$id);
						$resl=$this->db->get('response_recorder');
						$response=$resl->result();
						$data['responselist']=$response[0];


						$this->view('task/response_recorder/edit_response_recorder',$data);

									}
									else
									{
										$recorderdata=[

													"avenue_name"=>$this->input->post("avenue_name"),
													"title"=>$this->input->post("title"),
													"res_type"=>$this->input->post("res_type"),
													"response"=>$this->input->post("response"),
													"rdate"=>$this->input->post("rdate"),
													"rtime"=>$this->input->post("rtime"),
													"suggested_reply"=>$this->input->post("suggested_reply"),
													"post_url"=>$this->input->post("post_url"),
													"responder_url"=>$this->input->post("responder_url"),
													"given_reply"=>$this->input->post("given_reply"),
													"reply_by"=>$this->input->post("reply_by"),
													"reply_time"=>$this->input->post("reply_time"),
													"dept"=>$this->input->post("dept"),
											
												];
														$this->db->where('rec_id',$id);
														$this->db->update('response_recorder',$recorderdata);



														redirect('task/response_recorder_list/view');


									}
								}

				}


											function delete_response_recorder($id)
											{

										if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_del_response_task'))	{
												if (!empty($id)) {
													
													$this->db->where('rec_id',$id);
													$this->db->delete('response_recorder');
													redirect('task/response_list');
												}

											}//close
										}


				function create_code2()
							{
								$res=$this->db->query("select max(id) as'code' FROM lead_generation");
								//$this->db->from('content_production_order');
								//$res=$this->db->get();
								$data=$res->result();
								$data=$data[0];
										$digit=$data->code;
										$max=$digit;					
								 $max = str_pad($max+1, 8, '0', STR_PAD_LEFT);
								
								 	return $max;
								}

function	create_lead_generation()
		{


						if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_add_lead_gen_task'))
			{


					$data['avenue']=$this->users_model->get_avenue();
					$data['audience']=$this->users_model->get_audience();
					$data['post']=$this->task_model->get_published_post();
					$data['phonecode']=$this->users_model->get_phonecode();
					$data['dept']=$this->groups_model->getdept();
					$data['code']=	$this->create_code2();
			

			$this->view('task/lead/create_lead',$data);

				}
		}

		


			function do_save_lead()
			{

					$config = array(
	             		array(
	                     'field'   => 'avenue', 
	                     'label'   => 'Avenue ', 
	                     'rules'   => 'trim'
	                  ),
	            		array(
	                     'field'   => 'rdate', 
	                     'label'   => 'Lead Date', 
	                     'rules'   => ''
	                  ),
					  array(
	                     'field'   => 'post', 
	                     'label'   => 'Post', 
	                     'rules'   => ''
	                  ),
					  array(
	                     'field'   => 'lead_type', 
	                     'label'   => 'Lead Type', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'lead_name', 
	                     'label'   => 'Lead Name', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'lead_email', 
	                     'label'   => 'Lead Email', 
	                     'rules'   => 'trim|required|valid_email'
	                  ),
					   array(
	                     'field'   => 'phonecode', 
	                     'label'   => 'Phone Code', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'phone', 
	                     'label'   => 'Phone', 
	                     'rules'   => 'trim|required|max_length[10]|numeric'
	                  ),
					   array(
	                     'field'   => 'lead_comment', 
	                     'label'   => 'Lead Comment', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'lead_code', 
	                     'label'   => 'Lead Code', 
	                     'rules'   => 'trim|required'
	                  )
                	);
		$this->form_validation->set_rules($config);
						//print_r($_POST);
/*Array ( [market_response_post] => on [avenue] => Select Aveneue [rdate] => [post] => Select Post [lead_type] => Select Lead Type [lead_name] => [lead_email] => [phonecode] => 0 [phone] => [lead_comment] => [priority] => 1 [assign_to] => Select Please [team_comments] => [end_date] => L91-00000001 [next] => Next )*/
		$fields 	= array ("source","avenue","rdate","post","lead_type","lead_name","lead_email","lead_comment","lead_code","phonecode","phone");
					


		if ($this->form_validation->run()==false) {
										$data['avenue']=$this->users_model->get_avenue();
					$data['audience']=$this->users_model->get_audience();
					$data['post']=$this->task_model->get_published_post();
					$data['phonecode']=$this->users_model->get_phonecode();
					$data['dept']=$this->groups_model->getdept();
					$data['code']=	$this->create_code();
			

			$this->view('task/lead/create_lead',$data);
		}
else{

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
					//$data['phone']=$this->input->post('phonecode').$this->input->post('phone');//mobile number
					

					/****
					*		$assign_to is-> department manager ID 
					*	explode for find  email to send department manager and ID to store in db
					*
					****/
					$dept=$this->input->post('assign_to');
					if (!empty($dept)) {
						$str_dept=explode('-',$dept);

					$data['assign_to']=$str_dept[0];
					}

					$data['created_by']=$this->session->userdata('id');
					$data['team_id']=$this->session->userdata('team_id');
					$this->db->insert('lead_generation',$data);
					redirect('task/view_lead_generation_list');
				}
					
					
			}

					function view_lead_generation_list()
					{

								if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_lead_gen_task'))
		{
							$data['heading']="View Lead Generation List";
							$data['view_as']="view_list";

							$result=$this->task_model->lead_list();
							if (!empty($result)) {
								
								$data['lead_list']=$result;
								$this->view('task/lead/view_lead_generation_list',$data);

							}
					}
				}


					function edit_lead_generation_list()
					{

												if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_lead_gen_task'))
		{

							$data['heading']="Edit Lead Generation List";
							$data['view_as']="edit_list";

							$result=$this->task_model->lead_list();
							if (!empty($result)) {
								
								$data['lead_list']=$result;
								$this->view('task/lead/view_lead_generation_list',$data);

							}
					}
				}

					function delete_lead_generation_list()
					{

												if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_delete_lead_gen_task'))
				{
							$data['heading']="Delete Lead Generation List";
							$data['view_as']="delete_list";

							$result=$this->task_model->lead_list();
							if (!empty($result)) {
								
								$data['lead_list']=$result;
								$this->view('task/lead/view_lead_generation_list',$data);

							}
					}

				}


					function delete_lead_generation($id)
					{

	if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_delete_lead_gen_task'))
		{
						$this->db->where('id',$id);
						$this->db->delete('lead_generation');
						redirect('task/delete_lead_generation_list');
					}

				}



				function   edit_lead_generation($id)
		{
										if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_lead_gen_task'))
		{
					$data['avenue']=$this->users_model->get_avenue();
					$data['audience']=$this->users_model->get_audience();
					$data['post']=$this->task_model->get_published_post();
					$data['phonecode']=$this->users_model->get_phonecode();
					$data['dept']=$this->groups_model->getdept();
					$data['lead']=$this->task_model->lead_list_by_id($id);
				
				

			$this->view('task/lead/edit_lead',$data);
		}

	}

										function   view_lead_generation($id)
		{


									if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_lead_gen_task'))
			{
					$data['avenue']=$this->users_model->get_avenue();
					$data['audience']=$this->users_model->get_audience();
					$data['post']=$this->task_model->get_published_post();
					$data['phonecode']=$this->users_model->get_phonecode();
					$data['dept']=$this->groups_model->getdept();
					$data['lead']=$this->task_model->lead_list_by_id($id);
					$this->view('task/lead/view_lead',$data);

			}
		}



					function do_update_lead($id)
			{

					$config = array(
	             		array(
	                     'field'   => 'avenue', 
	                     'label'   => 'Avenue ', 
	                     'rules'   => 'trim'
	                  ),
	            		array(
	                     'field'   => 'rdate', 
	                     'label'   => 'Lead Date', 
	                     'rules'   => ''
	                  ),
					  array(
	                     'field'   => 'post', 
	                     'label'   => 'Post', 
	                     'rules'   => ''
	                  ),
					  array(
	                     'field'   => 'lead_type', 
	                     'label'   => 'Lead Type', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'lead_name', 
	                     'label'   => 'Lead Name', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'lead_email', 
	                     'label'   => 'Lead Email', 
	                     'rules'   => 'trim|required|valid_email'
	                  ),
					   array(
	                     'field'   => 'phonecode', 
	                     'label'   => 'Phone Code', 
	                     'rules'   => 'trim|required'
	                  ),
					  array(
	                     'field'   => 'phone', 
	                     'label'   => 'Phone', 
	                     'rules'   => 'trim|required|max_length[10]|numeric'
	                  ),
					   array(
	                     'field'   => 'lead_comment', 
	                     'label'   => 'Lead Comment', 
	                     'rules'   => 'trim|required'
	                  ),
					   
                	);
		$this->form_validation->set_rules($config);
						//print_r($_POST);
/*Array ( [market_response_post] => on [avenue] => Select Aveneue [rdate] => [post] => Select Post [lead_type] => Select Lead Type [lead_name] => [lead_email] => [phonecode] => 0 [phone] => [lead_comment] => [priority] => 1 [assign_to] => Select Please [team_comments] => [end_date] => L91-00000001 [next] => Next )*/
		$fields 	= array ("source","avenue","rdate","post","lead_type","lead_name","lead_email","lead_comment","phonecode","phone");
					


		if ($this->form_validation->run()==false) {
					
					$data['avenue']=$this->users_model->get_avenue();
					$data['audience']=$this->users_model->get_audience();
					$data['post']=$this->task_model->get_published_post();
					$data['phonecode']=$this->users_model->get_phonecode();
					$data['dept']=$this->groups_model->getdept();
					//$data['code']=	$this->create_code();
			

			$this->view('task/lead/create_lead',$data);
		}
else{

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
					//$data['phone']=$this->input->post('phonecode').$this->input->post('phone');//mobile number
					

						$this->db->where('id',$id);
					$this->db->update('lead_generation',$data);
					redirect('task/edit_lead_generation_list');
				}
					
					
			}


						function create_lead_qualification()
		{		
				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_lead_quali_task'))
			{
							$res=$this->db->get('lead_generation');
							$lead=$res->result();
								$data['lead']=$lead;
								$data['dept']=$this->groups_model->getdept();
								//var_dump($lead);
							$this->view('task/lead/qualified/create_lead_qualification',$data);
			}
						

		}


						//ajax request come here
								function get_lead()
								{



									if($data=$this->input->get('pid'))
											{
												$data_ar=explode('#',$data);
													if(count($data_ar)==4){
									$this->db->select('created_at,lead_name,lead_email,phone,status');
									$this->db->from('lead_generation');
									$this->db->where('lead_email',$data_ar[2]);

									$this->db->where('phone',$data_ar[1]);
									
									$data=$this->db->get();
									$res=$data->result();
									$lead=$res[0];
									if ($data->num_rows()>1) {

										?>

											<div class="alert alert-success">


														<strong>Name</strong>
														<span><?= $lead->lead_name ?></span>
														
														<strong>Created On</strong>
														<span><?= $lead->created_at ?></span>
														
														<strong>Email</strong>
														<span><?= $lead->lead_email ?></span>
														<strong>Name</strong>
														<span><?= $lead->lead_name ?></span>

														<strong>Status</strong>
														<span>
															<?php

																switch ($lead->status) {
																	case 0:
															echo "Lead Generated";
															break;
															case 2:
															echo "Qualified";
															break;
															case 3:
															echo "Under Nurture";
															break;
															case 4:
															echo "Converted";
															break;
															case 5:
															echo "Rejected";
															break;	
															case 6:
															echo "Aborted";
															break;													
														default:
															echo "not valid";
															break;
																}

															?>

														</span>
													</div>




<?php
									}


									else
									{
										echo "<div class='alert alert-danger'>No Duplicat Data</div>";
									}
								
									
								}
								else
								{
									echo "<div class='alert alert-danger'>Please Select Valid Lead</div>";
								}
								}
							}





												function do_save_lead_qualified()
												{



	$config = array(
	             		array(
	                     'field'   => 'action_on_lead', 
	                     'label'   => 'Action On Lead ', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'priority', 
	                     'label'   => 'Priority', 
	                     'rules'   => 'required|trim'
	                  ),
					                 
					 
					   array(
	                     'field'   => 'assign_for', 
	                     'label'   => 'Assign For', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'team_comment', 
	                     'label'   => 'Team Comment', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'qlead_id', 
	                     'label'   => 'Lead ID', 
	                     'rules'   => 'trim|required'
	                  )
                	);
		$this->form_validation->set_rules($config);
					

							$fields 	= array ("priority","team_comment","qlead_id","action_on_lead");
					


		if ($this->form_validation->run()==false) {
											$res=$this->db->get('lead_generation');
							$lead=$res->result();
								$data['lead']=$lead;
								$data['dept']=$this->groups_model->getdept();
								//var_dump($lead);
							$this->view('task/lead/qualified/create_lead_qualification',$data);
		}
else{

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
					//$data['phone']=$this->input->post('phonecode').$this->input->post('phone');//mobile number
					

					/****
					*		$assign_to is-> department manager ID 
					*	explode for find  email to send department manager and ID to store in db
					*
					****/
					$dept=$this->input->post('assign_for');
					if (!empty($dept)) {
						$str_dept=explode('-',$dept);

					$data['assigned_for']=$str_dept[0];
					}

					$data['created_by']=$this->session->userdata('id');
					$data['team_id']=$this->session->userdata('team_id');
					$this->db->insert('qualified_lead',$data);
					redirect('task/view_lead_generation_list');
				}
					

			}



										function view_lead_qualified_list()
					{
								if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_lead_quali_task'))
			{
							$data['heading']="View Lead Qualified List";
							$data['view_as']="view_list";

							$result=$this->task_model->qualified_lead_list();
							if (!empty($result)) {
								
								$data['lead_list']=$result;
								$this->view('task/lead/qualified/view_lead_qualified_list',$data);

							}
					}
				}


					function edit_lead_qualified_list()
					{

							if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_lead_quali_task'))
			{
							$data['heading']="Edit Lead Qualified List";
							$data['view_as']="edit_list";

							$result=$this->task_model->qualified_lead_list();
							if (!empty($result)) {
								
								$data['lead_list']=$result;
								$this->view('task/lead/qualified/view_lead_qualified_list',$data);

							}
					}
				}

					function delete_lead_qualified_list()
					{

							if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_delete_lead_quali_task'))
			{
							$data['heading']="Delete Lead Qualified List";
							$data['view_as']="delete_list";

							$result=$this->task_model->qualified_lead_list();
						
								
								$data['lead_list']=$result;
								$this->view('task/lead/qualified/view_lead_qualified_list',$data);

							}

						}
					



				function   edit_lead_qualified($id)
		{

				if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_edit_lead_quali_task'))
			{
									
							$res=$this->db->get('lead_generation');
							$lead_generation=$res->result();
								$data['lead']=$lead_generation;

								$data['dept']=$this->groups_model->getdept();
								//var_dump($lead);
					$data['qlead']=$this->task_model->qlead_list_by_id($id);
				
				

			$this->view('task/lead/qualified/edit_qualified_lead',$data);
			}
		}


					function do_update_lead_qualified($id)
			{

					$config = array(
	             		array(
	                     'field'   => 'action_on_lead', 
	                     'label'   => 'Action On Lead ', 
	                     'rules'   => 'trim|required'
	                  ),
	            		array(
	                     'field'   => 'priority', 
	                     'label'   => 'Priority', 
	                     'rules'   => 'required|trim'
	                  ),
					                 
					 
					   array(
	                     'field'   => 'assign_for', 
	                     'label'   => 'Assign For', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'team_comment', 
	                     'label'   => 'Team Comment', 
	                     'rules'   => 'trim|required'
	                  ),
					   array(
	                     'field'   => 'qlead_id', 
	                     'label'   => 'Lead ID', 
	                     'rules'   => 'trim|required'
	                  )
                	);
		$this->form_validation->set_rules($config);
					

							$fields 	= array ("priority","team_comment","qlead_id","action_on_lead");
					


		if ($this->form_validation->run()==false) {
											$res=$this->db->get('lead_generation');
							$lead=$res->result();
								$data['lead']=$lead;
								$data['dept']=$this->groups_model->getdept();
								//var_dump($lead);
							$this->view('task/lead/qualified/create_lead_qualification',$data);
		}
else{

		foreach($fields as $field)
		{
			$data[$field] = $this->input->post($field);
		}
					//$data['phone']=$this->input->post('phonecode').$this->input->post('phone');//mobile number
					

					/****
					*		$assign_to is-> department manager ID 
					*	explode for find  email to send department manager and ID to store in db
					*
					****/
					$dept=$this->input->post('assign_for');
					if (!empty($dept)) {
						$str_dept=explode('-',$dept);

					$data['assigned_for']=$str_dept[0];
					}

					$data['created_by']=$this->session->userdata('id');
					$data['team_id']=$this->session->userdata('team_id');
			
						$this->db->where('id',$id);
					$this->db->update('qualified_lead',$data);
					redirect('task/edit_lead_qualified_list');
				}
					
					
			}



									function delete_qualified_lead($id)
									{
												if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_delete_lead_quali_task'))
							{
												$this->db->where('id',$id);
											$this->db->delete('qualified_lead');
											redirect('task/delete_lead_qualified_list');
										}
									}


								 function view_lead_qualified($id)
					{
						if($this->user_classification_model->check_role_auth($this->session->userdata('user_role'),'is_view_lead_quali_task'))
			{

														$res=$this->db->get('lead_generation');
							$lead_generation=$res->result();
								$data['lead']=$lead_generation;

								$data['dept']=$this->groups_model->getdept();
								//var_dump($lead);
					$data['qlead']=$this->task_model->qlead_list_by_id($id);
				
				

			$this->view('task/lead/qualified/view_qualified_lead',$data);

		}
				}


			}


					
?>