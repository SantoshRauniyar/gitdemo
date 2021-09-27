<?php if(!defined('BASEPATH')) exit("No direct script access allowed.");
class Users_model extends MY_Generic_Model 
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->library('pagination');
		$this->model_pagination->set_ref($this);
   	$this->model_pagination->set_uri_segment(4);
		$this->model_pagination->set_per_page(10);
	}
	
	public function get_userdetails_by_id($id)
	{
		$query	= $this->query("SELECT id,user_name,first_name,last_name,email FROM ".$this->tables['users']." WHERE id='".$id."'");
		if($query->num_rows() > 0)
			return $query->row_array();
		else
			return false;
	}
   public function admin_getuserslist($sort,$type)
   {
		$fields = 'u.id,u.user_name,u.first_name,u.last_name,u.user_role,u.profile_image,u.email,u.contact_no,u.status';
      $where =  " WHERE u.user_role = 'Captain' ORDER BY ".$sort." ".$type;
		return $this->model_pagination->query_pagination(base_url()."administrator/users/all/",$fields,'users u',$where);
   }
   public function getuserslist($sort,$type,$create_id,$team_id)
   {
   	$this->model_pagination->set_uri_segment(3);
   	$fields = 'u.id,u.user_name,u.first_name,u.last_name,u.user_role,(SELECT ur.user_role_name FROM '.$this->tables['user_roles'].' ur WHERE ur.id=u.user_role)as user_role_name,(SELECT team_title FROM '.$this->tables['team'].' t WHERE t.id=u.team_id)as team_name,u.profile_image,u.email,u.contact_no,u.status';
      $where =  " WHERE created_by = '".$create_id."' AND team_id = '".$team_id."' ORDER BY ".$sort." ".$type;
	   return $this->model_pagination->query_pagination(base_url()."users/all/",$fields,'users u',$where);
   }
   public function getuserbyid($id)
   {
   		$query = $this->query("SELECT * FROM ".$this->tables['users']." WHERE id=".$id);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
   }

   public function getTeamLeaderList()
   {
   		$query = "SELECT id,user_name FROM ".$this->tables['users']." WHERE user_role = '1'";
		return $this->get_drop_down($query,"id","user_name","TEAM LEADER");
   }
   
   public function getmyteamleader()
   {
   		$query = "SELECT id,user_name FROM ".$this->tables['users']." WHERE id NOT IN (SELECT team_leader_id FROM ".$this->tables['team'].") AND user_role = '1'";
		return $this->get_drop_down($query,"id","user_name","TEAM LEADER");
   }

   public function getmemberlist()
   {
   		$query = "SELECT id,user_name FROM ".$this->tables['users']." WHERE user_type = 2";
		return $this->get_drop_down($query,"id","user_name","TEAM MEMBER");
   }
   
   public function getUserByTeamId($team_id)
   {
   		$query = "SELECT id,user_name FROM ".$this->tables['users']." WHERE user_role NOT IN(22,36,24,37,21)";
   		return $this->get_drop_down($query,"id","user_name","Select User");
   }

   		

   public function get_user_list($team_id)
   {
   		$query =$this->query("Select id,user_name FROM ".$this->tables['users']." WHERE team_id='".$team_id."'");
   		
   		if($query->num_rows() > 0)
   		{
   			return $query->result_array();
   		}
   		else
   		{
   			return array();
   		}
   }

   public function getusers()
   {
	   $query = "SELECT id,user_name FROM ".$this->tables['users']." WHERE status=1";
		//$result = $this->query($query);
		return $this->get_drop_down($query,"id","user_name","USER");
   }

   public function getuserdropdown($team_id)
   {
	   	$query 	= "SELECT id,user_name FROM ".$this->tables['users']." WHERE team_id='".$team_id."' AND status=1";
		$result = $this->query($query);
		if($result->num_rows() > 0 )
			return $result->result();
		else
			return false;
   }
   
   public function count_no_of_user($team_id)
   {
   		$query = $this->query("select count(id)total_user FROM ".$this->tables['users']." WHERE team_id='".$team_id."'");
   		
   		if($query->num_rows() > 0)
   		{
   			return $query->row_array();
   		}
   		else
   		{
   			return false; 
   		}
   }

	public function isEmailExist($email)
	{
		$query  = "Select id FROM ".$this->tables['users']." WHERE email = '".$email."'";
		$result = $this->query($query);
		if($result->num_rows() > 0)
			return true;
		else
			return false;
	}

	public function isUserNameExists($id,$username)
	{
		$query  = "Select id FROM ".$this->tables['users']." WHERE user_name = '".$username."' AND id !=".$id;
		$result = $this->query($query);
		if($result->num_rows() > 0)
			return true;
		else
			return false;
	}
	
	public function isUserExist($user_name,$team_id,$id=null)
	{
		$idcondition = ($id==null)?'':"AND id !=".$id;
		$query = $this->query("SELECT id FROM ".$this->tables['users']." WHERE user_name='".$user_name."' AND team_id='".$team_id."' ".$idcondition);
		
		if($query->num_rows() > 0)
			return true;
		else
			return false;
	}

   /* Insert user */
    public function save()
    {
   		return $this->insert($this->tables['users'],$this->data);
	}

	/* Get Image Path */
	public function getImagePath($id)
	{
		$query = $this->query("SELECT profile_image from ".$this->tables['users']." WHERE id='".$id."'");
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		return false;
	}
	
	/* Update user */
	public function do_update()
	{
		$where['id'] = $this->data['id'];
		unset($this->data['id']);
		$this->update($this->tables['users'],$this->data,$where);
		return $this->db->affected_rows();
	}

	/* Delete Users */
	public function do_delete($user_id)
	{
		$path = $this->getImagePath($user_id);
		//print_r($path);exit;
		if($path['profile_image'] != '')
		{
			if(file_exists("assets/upload/users/".$path['profile_image']))
			{
				unlink("assets/upload/users/".$path['profile_image']);
			}
		}
		$where['id'] = $user_id;
		$this->delete($this->tables['users'],$where);
		return;
	}

	public function getUserId($data)
	{
		$query = $this->query("SELECT id FROM ".$this->tables['users']." WHERE user_name = '".$data['user_name']."' OR password = '".$data['password']."' OR email = '".$data['email']."'");
		if($query->num_rows() > 0)
			return $query->row_array();
		else
			return false;
	}

	public function changeUserStatus($id,$data)
	{
		$where['id'] = $id;
		$this->update($this->tables['users'],$data,$where);
		return $this->db->affected_rows();
	}
	
	public function get_state_list($country_id)
	{
		$query = $this->query("SELECT id,state FROM ".$this->tables['state']." WHERE country_id ='".$country_id."'");
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	public function get_city_list($state_id)
	{
		$query = $this->query("SELECT id,city FROM ".$this->tables['city']." WHERE state_id ='".$state_id."'");
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}
	
	        	//Santosh rauniyar

					public function get_avenue()
					{
					$res=$this->db->get('avenue');
					$data=$res->result();

					if ($res->num_rows()>0) {
						return $data;
					}
					else
					{
						return false;
					}

					}




			public function get_audience()
					{
					$res=$this->db->get('audience');
					$data=$res->result();

					if ($res->num_rows()>0) {
						return $data;
					}
					else
					{
						return false;
					}

					}



				public function get_phonecode()
					{
						$this->db->select('phonecode,id');
						
						$this->db->from('phonecode');
						$this->db->order_by('id','asc');
					$res=$this->db->get();
					$data=$res->result();

					if ($res->num_rows()>0) {
						return $data;
					}
					else
					{
						return false;
					}

					}

                       public function save_country()
						{
							$arr=["id"=>random_int(100,9999),"country"=>$this->input->post('c_name'),"code"=>$this->input->post('c_code'),"created_by"=>$this->session->userdata('id'),"updated_by"=>$this->session->userdata('id')];
								//var_dump($arr);


								$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/add_country',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$arr,
));

$response = curl_exec($curl);

curl_close($curl);
								$result=json_decode($response);

											if($result->status)
											{

							if($this->db->insert('country',$arr))
							{



								return true;
							}
							else
							{
								return false;
							}

						}

						else
						{
							return false;
						}
						}



						public function get_countries()
						{
							$this->db->order_by('country','asc');
							$res=$this->db->get('country');

							if ($res->num_rows()>0) 
							{
								return $res->result();

							}
							else
							{
								return false;
							}
						}

						public function get_country_api()
						{
							$this->db->select('id,country');
							$this->db->from('country');
							$this->db->order_by('country','asc');
							$res=$this->db->get();

							if ($res->num_rows()>0) 
							{
								return $res->result();

							}
							else
							{
								return false;
							}

						}

								function get_state_byCountry_api($country_id)
								{
											$this->db->select('id,state');
											$this->db->from('state');
											$this->db->where('country_id',$country_id);
											$res=$this->db->get();
											if ($res->num_rows()>0) {
												
												return $res->result();
											}
											else
											{
												return false;
											}
								}


							public function edit_country_ByID($id)
							{
								$this->db->where('id',$id);
								$res=$this->db->get('country');
								if ($res->num_rows()>0) {
									
									return $res->result();
								}
								else
								{
									return false;
								}
							}

								public function update_country($id)
						{
							$arr=["country"=>$this->input->post('c_name'),"code"=>$this->input->post('c_code'),"updated_by"=>$this->session->userdata('id')];
								//var_dump($arr);\
							$arr['id']=$id;



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '13.59.46.134/api/update_country',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$arr,
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$result=json_decode($response);


		if ($result->status) {
			$this->db->where('id',$id);
							
							if ($this->db->update('country',$arr)) {
								return true;
							}
		}
							
							
						}


								public function save_state()
						{
							$arr=["id"=>random_int(100,9999),"state"=>$this->input->post('state_name'),"country_id"=>$this->input->post('c_id'),"created_by"=>$this->session->userdata('id'),"updated_by"=>$this->session->userdata('id')];
								//var_dump($arr);




$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '13.59.46.134/api/add_state',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $arr,
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);


			if ($result->status) {
				if($this->db->insert('state',$arr))
							{
								return true;
							}
							else
							{
								return false;
							}
			}
			else
			{
			    return false;
			}
		
			}

						public function get_stateByCid($cid) 
						{
						$this->db->select('state.id,state.state,country.country');
						
						$this->db->order_by('state','asc');
						$this->db->from('state');
						$this->db->join('country','country.id=state.country_id');
						$this->db->where('country_id',$cid);
						$res=$this->db->get(); 
						//echo "<pre>";
						//print_r($res->result());
						return $res->result();
						 }

						function delete_state($id)
						 	{


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '13.59.46.134/api/destroy_state',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id' => $id),
));

$response = curl_exec($curl);

curl_close($curl);
 $result=json_decode($response);

 			if($result->status) {
 				
						 			$this->db->where('id',$id);
						 			
							 			if ($this->db->delete('state'))
							 			 {
							 			
							 				return true;

							 			} 	
							 			else
							 			{
							 				return false;
							 			}		
										}
							else
							 			{
							 				return false;
							 			}
						 		}



						 	function get_state_ById($id)
						 	{
						 		$this->db->where('id',$id);
						 		$res=$this->db->get('state');
						 		if ($res->num_rows()>0) {
						 			$d=$res->result();
						 			return $d[0];
						 		}
						 		else
						 		{
						 			return false;
						 		}
						 	}

					function update_state($id)
						 		{
										$arr=["state"=>$this->input->post('state_name'),"country_id"=>$this->input->post('c_id'),"updated_by"=>$this->session->userdata('id')];
										$arr['id']=$id;


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '13.59.46.134/api/update_state',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $arr,
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);


												if($result->status)
						 		{
						 			$this->db->where('id',$id);
						 			if ($this->db->update('state',$arr)) {
						 				return true;
						 			}
						 		}
						 		else
						 		{
						 		    return false;
						 		}
						 	}


						 		function get_state_CountryId($id)
						 		{
						 			$this->db->select('id,state');
						 			$this->db->from('state');
						 			$this->db->where('country_id',$id);
						 			$this->db->order_by('state','asc');
						 			$res=$this->db->get();
						 			if ($res->num_rows()>0) {
						 				
						 				$data=$res->result();
						 				return $data;
						 			}
						 			else
						 			{
						 				return false;
						 			}
						 		}

						 			public function save_district()
						 		{
						 			$arr=[
						 				"id"=>random_int(100,99999),
						 				"country_id"=>$this->input->post('country'),
						 				"state_id"=>$this->input->post('state'),
						 				"district_name"=>$this->input->post('district_name'),
						 				"created_by"=>$this->session->userdata('id')
						 			];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => '13.59.46.134/api/add_district',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$arr,
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);


										if($result->status)
										{
						 			if($this->db->insert('district',$arr))
						 			{
						 				return true;
						 			}
						 		}
						 		}

						 		public function get_District($cid=null,$sid=null)
						 		{

						 			if(!empty($cid) and !empty($sid))
						 			
								{
						 			$this->db->select('country.country,state.state,district.district_name,district.id');
						 			$this->db->from('district');
						 			$this->db->join('country','country.id=district.country_id','left');
						 			$this->db->join('state','state.id=district.state_id','left');
						 			$this->db->where('district.country_id',$cid);
						 			$this->db->where('district.state_id',$sid);
						 			$res=$this->db->get();

						 		}
						 		else
						 		{
						 			$res=$this->db->select('id,district_name')->from('district')->get();
						 		}
						 			if ($res->num_rows()>0) {
						 				
						 				return $res->result();
						 			}
						 			else
						 			{
						 				return false;
						 			}
						 		}



						 			 function delete_district_byId($id)
						 		 {						 		 		
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/destroy_district',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id' => $id),
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);

						if($result->status)
						{
						 		 	$this->db->where('id',$id);
						 		 	if($this->db->delete('district'))
						 		 		{ return true; }
						 		 	else
						 		 	{
						 		 		return false;
						 		 	}

						 	}
					 }

		

						 	function get_district_ById($id)
						 		 {
						 		 				$this->db->where('id',$id);
						 		 				$res=$this->db->get('district');
						 		 					if ($res->num_rows>0) {
						 		 						$data=$res->result();
						 		 						return $data[0];
						 		 					}
						 		 					else
						 		 					{
						 		 						return false;
						 		 					}
						 		 }


						 function update_district($id)
						 		 {
						 		 			$arr=[
						 				"country_id"=>$this->input->post('country'),
						 				"state_id"=>$this->input->post('state'),
						 				"district_name"=>$this->input->post('district_name')
						 			];
						 			$arr['id']=$id
;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/update_district',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$arr,
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);

								if($result->status)
								{														
						 			$this->db->where('id',$id);
						 			if ($this->db->update('district',$arr)) {
						 				
						 				return true;
						 			}
						 			else
						 			{
						 				return false;
						 			}
						 			
						 						}
						 		 }

						 		 function set_districtByStateId($state)
						 		 {
						 		 	$this->db->select('id,district_name');
						 		 	$this->db->from('district');
						 		 	$this->db->order_by('district_name','asc');
						 		 	$this->db->where('state_id',$state);
						 		 	$res=$this->db->get();
						 		 	return $res->result();
						 		 }

					 function save_city()
						 		 {
						 		 	$arr=[
						 		 		"id"=>random_int(5000,999999),
						 		 		"country_id"=>$this->input->post('country'),
						 		 		"state_id"=>$this->input->post('state'),
						 		 		"district_id"=>$this->input->post('district'),
						 		 		"city"=>$this->input->post('city'),
						 		 		"is_cityzone"=>$this->input->post('cz'),
						 		 		"created_by"=>$this->session->userdata('id')
						 		 	];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/add_city',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $arr,
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
$result=json_decode($response);

							if($result->status)
								{
						 		 	if($this->db->insert('city',$arr))
						 		 	{
						 		 		return true;
						 		 	}	
						 		 	else
						 		 	{
						 		 		return false;
						 		 	}

						 		 }
						 		 		 }


						 function update_city($id)
						 		 {
						 		 	$arr=[

						 		 		"country_id"=>$this->input->post('country'),
						 		 		"state_id"=>$this->input->post('state'),
						 		 		"district_id"=>$this->input->post('district'),
						 		 		"city"=>$this->input->post('city'),
						 		 		"updated_by"=>$this->session->userdata('id')
						 		 	];


						 				$arr['id']=$id;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/update_city',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$arr,
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);

								if($result->status)
								{
						 		 		$this->db->where('id',$id);
								
						 		 	if($this->db->update('city',$arr))
						 		 	{
						 		 		return true;
						 		 	}	
						 		 	else
						 		 	{
						 		 		return false;
						 		 	}

						 		 }
						 		 else
						 		 {
						 		 	return false;
						 		 }
						 		 						 		 }


						 		 function get_city($district_id=null)
						 		 {

						 		 		if(!empty($district_id))
						 		 		{
						 		 		$this->db->select('city.city,city.id as city_id,country.country,state.state,district.district_name');
						 		 		$this->db->from('city');
						 		 		$this->db->join('country','country.id=city.country_id','left');
						 		 		$this->db->join('state','state.id=city.state_id','left');
						 		 		$this->db->join('district','district.id=city.district_id','left');
			
						 		 		$this->db->where('city.district_id',$district_id);
						 		 		$res=$this->db->get();
						 		 		$city=$res->result();
						 		 		return $city;
						 		 	}
						 		 	else
						 		 	{

						 		 		$city=$this->db->select('id as city_id,city')->from('city')->get()->result();
						 		 		return $city;
						 		 	}
						 		 }

						 		 		function get_city_api($id)
						 		 		{
						 		 				$res=$this->db->select('id,city')->from('city')->where('district_id',$id)->get()->result();
						 		 				return $res;
						 		 		}


						 		 function get_city_ById($id)
						 		 {
						 		 	$this->db->where('id',$id);
						 		 	$res=$this->db->get('city');
						 		 	if ($res->num_rows()>0)
						 		 	{
						 		 		$data=$res->result();
						 		 		return $data[0];
						 		 	}
						 		 	else
						 		 	{
						 		 		return false;
						 		 	}
						 		 }

						 		 function del_city($id)
						 		 {




$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/destroy_city',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id' =>$id),
));

$response = curl_exec($curl);

curl_close($curl);
				$result=json_decode($response);


									if($result->status)
									{
						 		 		$this->db->where('id',$id);

						 		 		if($this->db->delete('city'))
						 		 		{
						 		 			return true;
						 		 		}
						 		 		else
						 		 		{
						 		 			return false;
						 		 		}
						 		 	}
						 		 	else
						 		 	{
						 		 		return false;
						 		 	}

						 		 }


						 		 function get_dist_ById($id)
						 		 {

						 		 		$this->db->where('district_id',$id);
						 		 		$this->db->order_by('city','asc');
						 		 		$res=$this->db->get('city');
						 		 		if ($res->num_rows()>0) {
						 		 			
						 		 			return$res->result();
						 		 		}
						 		 		else
						 		 		{
						 		 			return false;
						 		 		}
						 		 		
						 		 }

						 		function save_pincode()
						 		 {


						 		 	$arr=[
						 		 		"id"=>random_int(10000,99999),	
						 		 		"country_id"=>$this->input->post('country'),
						 		 		"state_id"=>$this->input->post('state'),
						 		 		"district_id"=>$this->input->post('district'),
						 		 		"city_id"=>$this->input->post('city'),
						 		 		"pincode"=>$this->input->post('pincode'),
						 		 		"created_by"=>$this->session->userdata('id')
						 		 	];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/add_pincode',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $arr,
));

$response = curl_exec($curl);

curl_close($curl);
$obj=json_decode($response);



												if($obj->status)
						 		 {
						 		 	if($this->db->insert('pincode',$arr))
						 		 	{
						 		 		return true;
						 		 	}
						 		 	else
						 		 	{
						 		 		return false;
						 		 	}
						 		 }
						 		 else
						 		 {
						 		 	return false;
						 		 }
						 		 }
						 		  function update_pincode($id)
						 		 {
						 		 	$arr=[
                                        "id"=>$id,
						 		 		"country_id"=>$this->input->post('country'),
						 		 		"state_id"=>$this->input->post('state'),
						 		 		"district_id"=>$this->input->post('district'),
						 		 		"city_id"=>$this->input->post('city'),
						 		 		"pincode"=>$this->input->post('pincode'),
						 		 		
						 		 	];
						 		 	
						 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/update_pincode',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $arr,
));

$response = curl_exec($curl);

curl_close($curl);
$obj=json_decode($response);

						 		 	if($obj->status)
						 		 	{
						 		 	$this->db->where('id',$id);
						 		 	if($this->db->update('pincode',$arr))
						 		 	{
						 		 		return true;
						 		 	}
						 		 	else
						 		 	{
						 		 		return false;
						 		 	}
						 		 	}
						 		 	else
						 		 	{
						 		 	    return false;
						 		 	}
						 		 }


						 		 function get_pincodes($city_id)
						 		 {

						 		 	$this->db->select('pincode.pincode,pincode.id,country.country,state.state,district.district_name,city.city');
						 		 		$this->db->from('pincode');
						 		 		$this->db->join('country','country.id=pincode.country_id','left');
						 		 		$this->db->join('state','state.id=pincode.state_id','left');
						 		 		$this->db->join('district','district.id=pincode.district_id','left');
						 		 		$this->db->join('city','city.id=pincode.city_id','left');
						 		 		$this->db->where('pincode.city_id',$city_id);
						 		 	$res=$this->db->get();
						 		 	if($res->num_rows()>0)
						 		 	{
						 		 		return $res->result();
						 		 	}
						 		 	else
						 		 	{
						 		 		return false;
						 		 	}

						 		 }


						 		 function pincode_byId($id)
						 		 {
						 		 		$this->db->where('id',$id);
						 		 		$res=$this->db->get('pincode');
						 		 		if ($res->num_rows()>0) {
						 		 			$data=$res->result();
						 		 			return $data[0];
						 		 		}
						 		 		else
						 		 		{
						 		 			return false;
						 		 		}
						 		 }

						 		 function get_state()
						 		 {
						 		 	$res=$this->db->get('state')->result();
						 		 	return $res;
						 		 }	

						 		 function get_districts()
						 		 {
						 		 	$res=$this->db->get('district')->result();
						 		 	return $res;
						 		 }
						 		 
						 		 
						 	function get_pins($id)
						 		 {
						 		 		
						 		 		$this->db->where('city_id',$id);
						 		 		$this->db->order_by('pincode','asc');
						 		 		$res=$this->db->get('pincode');
						 		 		if ($res->num_rows()>0) {
						 		 			
						 		 			return$res->result();
						 		 		}
						 		 		else
						 		 		{
						 		 			return false;
						 		 		}
						 		 		
						 		 }
						 		 
						 		 function get_city_zones($city_id)
                        		{
                        		    $this->db->select('city_zone.id,city_zone.city_zone,city.city,district.district_name,state.state');
                        		    $this->db->from('city_zone');
                        		    $this->db->join('city','city.id=city_zone.city_id');
                        		    $this->db->join('state','state.id=city_zone.state_id');
                        		    $this->db->join('district','district.id=city_zone.district_id');
                        		    $this->db->where('city_zone.city_id',$city_id);
                        		    $res=$this->db->get();
                        		    $result=$res->result();
                        		    
                        		    if($res->num_rows()>0)
                        		    {
                        		    
                        		        return $result;
                        		    }
                        		    else
                        		    {
                        		        return false;
                        		    }
                        		    //var_dump($res->result());
                        		}
						 		 
						 public function get_state_ByUid()
						 {
						            $this->db->select('state.state,state.id');
	                                $this->db->from('users');
	                                $this->db->join('state','state.id=users.state_id');
	                                $this->db->where('users.id',$this->session->userdata('id'));
	                                $res=$this->db->get();
	                                $data=$res->result();
	                                if($res->num_rows()>0)
	                                {
	                                    return $data[0];
	                                }else
	                                {
	                                    return false;
	                                }
						 }
						 
						 
						  public function get_district_ByUid()
						 {
						            $this->db->select('district.district_name,district.id');
	                                $this->db->from('users');
	                                $this->db->join('district','district.id=users.district');
	                                $this->db->where('users.id',$this->session->userdata('id'));
	                                $res=$this->db->get();
	                                $data=$res->result();
	                                if($res->num_rows()>0)
	                                {
	                                    return $data[0];
	                                }else
	                                {
	                                    return false;
	                                }
						 }
						 
						  public function get_city_ByUid()
						 {
						            $this->db->select('city.city,city.id');
	                                $this->db->from('users');
	                                $this->db->join('city','city.id=users.city_id');
	                                $this->db->where('users.id',$this->session->userdata('id'));
	                                $res=$this->db->get();
	                                $data=$res->result();
	                                if($res->num_rows()>0)
	                                {
	                                    return $data[0];
	                                }else
	                                {
	                                    return false;
	                                }
						 }
						 
						  public function get_cityZone_ByUid()
						 {
						            $this->db->select('city_zone.city_zone,city_zone.id');
	                                $this->db->from('users');
	                                $this->db->join('city_zone','city_zone.id=users.city_zone');
	                                $this->db->where('users.id',$this->session->userdata('id'));
	                                $res=$this->db->get();
	                                $data=$res->result();
	                                if($res->num_rows()>0)
	                                {
	                                    return $data[0];
	                                }else
	                                {
	                                    return false;
	                                }
						 }
                
                       public function get_Country_ByUid()
						 {
						            $this->db->select('country.country,country.id');
	                                $this->db->from('users');
	                                $this->db->join('country','country.id=users.country_id');
	                                $this->db->where('users.id',$this->session->userdata('id'));
	                                $res=$this->db->get();
	                                $data=$res->result();
	                                if($res->num_rows()>0)
	                                {
	                                    return $data[0];
	                                }else
	                                {
	                                    return false;
	                                }
						 }
						 
						 /**
						  * We need coz if program 
						  * 
						  * */
						  public function getlocationforPartner()
						 {
						            $this->db->select('country_id,state_id,district_id,city_id');
	                                $this->db->from('users');
	                                $this->db->where('id',$this->session->userdata('id'));
	                                $res=$this->db->get();
	                                $data=$res->result();
	                                if($res->num_rows()>0)
	                                {
	                                    return $data[0];
	                                }else
	                                {
	                                    return false;
	                                }
						 }
                        
   

			 	           		public function setColorDanger($task_priority)

			 	           		{
			 	           			if ($task_priority==4) {
			 	           				
			 	           				echo 'style="color:red;"';
			 	           			}
			 	           		}

}