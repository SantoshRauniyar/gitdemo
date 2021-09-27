<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Dashboard extends Template
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
		$this->user_classification_model->set_role();
		//var_dump($data);exit();
		$this->set_header_path('blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->load->model('user_classification_model');
		//$data['$deliveryData']=$this->user_classification_model->set_role();
		$this->load->library('merchant');

		$this->set_template('template');

		$this->set_title('Dashboard');
		
		if(!$this->session->userdata('id'))
			redirect("authentication/");

	}

	public function index()
	{
		$data = array();
	//	$data['deliveryData']=$this->user_classification_model->set_role();
		$this->set_title('Dashboard');
		//$this->view("blocks/header",$data);
		$this->view("dashboard",array());
		
	}
	
	            function testRole()
	            {
	                var_dump($this->user_classification_model->set_role());
	            }
	                
	        function view_haspatal_dashboard($today=null)
			{
			                        
			                         $data['st']=$data['dis']=$data['cit']=$data['cz']=0;
			                        if($this->session->userdata('user_role')==19)
                    {
                    $cz=$this->db->select('cityzone')->from('users')->where('id',$this->session->userdata('id'))->get()->result();
                    
                 $pincodes=$this->db->select('city_zone,pincodes')->from('city_zone')->where('id',$cz[0]->cityzone)->get()->result();
                 $data['zoneDetails']="You are looking for ".'<b>'.$pincodes[0]->city_zone.'</b>'." City Zones";
                 			        
                    }
                                 $state=$this->users_model->get_state_ByUid();
			                    if(!empty($state))
			                     {
			                         $this->session->set_userdata('statename',$state->state);
			                     }
	                                
	                                $dist=$this->db->select('district')->where('id',$this->session->userdata('id'))->get('users');
                                                    $district=$dist->result();
                                                    $d_id=$district[0]->district;
	                                
	                                    switch($this->session->userdata('user_role'))
	                                    {
	                                        case 19:
	                                            //exit();
	                                            if(!empty($today))
	                                            {
	                                                     
        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/user_by_role?pins='.$pincodes[0]->pincodes.'&today=today',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$result=json_decode($response);
$data['data']=$result->data;
$data['status']='Today Registrants';
	                                            }
	                                            else
	                                            {
	                                                $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/user_by_role?pins='.$pincodes[0]->pincodes.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
        $result=json_decode($response);
$data['data']=$result->data;
$data['today']='today';
        
	                                            }
	                                            break;
	                                            case 21:
	                                                
	                                                 $data['dis']=$data['cit']=$data['cz']=1;
	                                                // $data['stateData']=$this->users_model->get_state_ByUid();
	                                                   // $data['districtData']=$this->users_model->get_district_ByUid();
	                                                    
	                                                    $stateId=$this->db->select('state_id')->from('users')->where('id',$this->session->userdata('id'))->get()->result();
	                                                    $stateId=$stateId[0]->state_id;
	                                                    //var_dump($stateId);exit();
	                                                    /*  $this->db->select('district.district_name,district.id');
	                                                    $this->db->from('district');
	                                                    $this->db->where('state_id',$stateId);
	                                                    $res=$this->db->get();
	                                                    $data['dlist']=$res->result();
	                                    $heading=$data['stateData']->state." State";*/
	                                                    
	                                               
	                                                        
	                                                        if(empty($today))
{
	                                                        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/userByState?state_id='.$stateId.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IkJ0NDlqb1JwSCtSMDlMN0ErMjFwalE9PSIsInZhbHVlIjoiN2h5bENHdGJDRm9senhrZjJaVzJcL00wbElyanpFdHNGcnpJMnl6MFNqRnlmWGFyNHhxdHQ2ekM5c2hBMlwvSStYIiwibWFjIjoiOWUzOTgxOWM0MTM4ODdhMzJjNDNlODZjY2RmNWU1ZjdkMDk1MTBiOTQ5NjMyNGM1YjNjMWYzY2I4MzUyZGZiOSJ9; haspatal_session=eyJpdiI6Im5YQnZlTDRKN0oyc3hHMEJ1S1UyekE9PSIsInZhbHVlIjoiOERNMHdVenlBdWNVVklGMWlHZGp3T2pPWlFnUk9oK0FUZmVaZ3VHeTIzSFN2SlJteVA5WElSWUl5MmJUWXRHRiIsIm1hYyI6IjIwY2JiYjVhYzAyOWZiZjFhODZiM2ZhNDFiZGNiNWNlNDgwMjBlYjNkZTdjNmU3OGU0Yzk1OTE0ZTVmMDY1YzAifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);
$data['data']=$result->data;
$data['status']='Today Registrants';

                 }
    
                     else
    
                {
                        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/userByState?today=today&state_id='.$data['stateData']->id.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IkJ0NDlqb1JwSCtSMDlMN0ErMjFwalE9PSIsInZhbHVlIjoiN2h5bENHdGJDRm9senhrZjJaVzJcL00wbElyanpFdHNGcnpJMnl6MFNqRnlmWGFyNHhxdHQ2ekM5c2hBMlwvSStYIiwibWFjIjoiOWUzOTgxOWM0MTM4ODdhMzJjNDNlODZjY2RmNWU1ZjdkMDk1MTBiOTQ5NjMyNGM1YjNjMWYzY2I4MzUyZGZiOSJ9; haspatal_session=eyJpdiI6Im5YQnZlTDRKN0oyc3hHMEJ1S1UyekE9PSIsInZhbHVlIjoiOERNMHdVenlBdWNVVklGMWlHZGp3T2pPWlFnUk9oK0FUZmVaZ3VHeTIzSFN2SlJteVA5WElSWUl5MmJUWXRHRiIsIm1hYyI6IjIwY2JiYjVhYzAyOWZiZjFhODZiM2ZhNDFiZGNiNWNlNDgwMjBlYjNkZTdjNmU3OGU0Yzk1OTE0ZTVmMDY1YzAifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);
$data['data']=$result->data;
$data['status']='Today Registrants';
}
	                                                        
	                                                break;
	                                                
	                                                case 22:
	                                                    $data['cit']=$data['cz']=1;
	                                                    
	                                                    $data['stateData']=$this->users_model->get_state_ByUid();
	                                                    $data['districtData']=$this->users_model->get_district_ByUid();
	                                                    
	                                                      $this->db->select('city.city,city.id');
	                                                    $this->db->from('city');
	                                                    $this->db->where('district_id',$data['districtData']->id);
	                                                    $res=$this->db->get();
	                                                    $data['clist']=$res->result();
	                                                    
	                                                    $heading=$data['districtData']->district_name." District";
	                                               
	                                               
	                                                    
	                                                   
if(empty($today))
{
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/userByDistrict?district='.$d_id.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IkZqaVJkcVU3NkFnVWVRM25mYkVmV3c9PSIsInZhbHVlIjoiYTRLbUZwK0VkT1BCbmhFS1Zzc3draDV5UWUzVE4rQWdTNkVsdmowWHZcL0pCWkFFYStxZjBybU5GSktQSE9PdnkiLCJtYWMiOiI1NDk2ZTI5MDhhNWRjZWY0NDBjMDc2OGQ1NWM0NzUyYjBiYjkyYTA5NGJjYmY1ZmQwYWEzMmQzYTA3ZTRmZGIyIn0%3D; haspatal_session=eyJpdiI6IlJVcStsd2kyNk0wMUZhUlJhN2tQSkE9PSIsInZhbHVlIjoiZFwvcnhkT2dwc2F0UnF4Tit4VWRiWlJcL1dISFZNR2pJeEZcL3pVNEhldmt6YmprM3lwUVJ3VVZJcHNrNjEzSGxyaiIsIm1hYyI6ImIzMzEzZTEyZWU5OGZhNTYyZWNhNzY5ZmI0ZWMxZjczYTI3MmNhNjg2NWRjZDBiMDBjMDJkNDhlZTkzOThhZWEifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);
$data['data']=$result->data;
$data['status']='Today Registrants';
//echo $response;
}
else
{
    

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/userByDistrict?district='.$d_id.'&today=today',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IkZqaVJkcVU3NkFnVWVRM25mYkVmV3c9PSIsInZhbHVlIjoiYTRLbUZwK0VkT1BCbmhFS1Zzc3draDV5UWUzVE4rQWdTNkVsdmowWHZcL0pCWkFFYStxZjBybU5GSktQSE9PdnkiLCJtYWMiOiI1NDk2ZTI5MDhhNWRjZWY0NDBjMDc2OGQ1NWM0NzUyYjBiYjkyYTA5NGJjYmY1ZmQwYWEzMmQzYTA3ZTRmZGIyIn0%3D; haspatal_session=eyJpdiI6IlJVcStsd2kyNk0wMUZhUlJhN2tQSkE9PSIsInZhbHVlIjoiZFwvcnhkT2dwc2F0UnF4Tit4VWRiWlJcL1dISFZNR2pJeEZcL3pVNEhldmt6YmprM3lwUVJ3VVZJcHNrNjEzSGxyaiIsIm1hYyI6ImIzMzEzZTEyZWU5OGZhNTYyZWNhNzY5ZmI0ZWMxZjczYTI3MmNhNjg2NWRjZDBiMDBjMDJkNDhlZTkzOThhZWEifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);
$data['data']=$result->data;
$data['status']='Today Registrants';
//echo $response;

}

	                                                    
	                                                   
	                                                      break;
	                                                
	                                                case 39:
	                                                    $data['cit']=$data['cz']=1;
	                                                    
	                                                    $data['stateData']=$this->users_model->get_state_ByUid();
	                                                    $data['districtData']=$this->users_model->get_district_ByUid();
	                                                    
	                                                      $this->db->select('city.city,city.id');
	                                                    $this->db->from('city');
	                                                    $this->db->where('district_id',$data['districtData']->id);
	                                                    $res=$this->db->get();
	                                                    $data['clist']=$res->result();
	                                                    
	                                                    $heading=$data['districtData']->district_name." District";
	                                               
	                                               
	                                                    
	                                                   
if(empty($today))
{
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/userByDistrict?district='.$d_id.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IkZqaVJkcVU3NkFnVWVRM25mYkVmV3c9PSIsInZhbHVlIjoiYTRLbUZwK0VkT1BCbmhFS1Zzc3draDV5UWUzVE4rQWdTNkVsdmowWHZcL0pCWkFFYStxZjBybU5GSktQSE9PdnkiLCJtYWMiOiI1NDk2ZTI5MDhhNWRjZWY0NDBjMDc2OGQ1NWM0NzUyYjBiYjkyYTA5NGJjYmY1ZmQwYWEzMmQzYTA3ZTRmZGIyIn0%3D; haspatal_session=eyJpdiI6IlJVcStsd2kyNk0wMUZhUlJhN2tQSkE9PSIsInZhbHVlIjoiZFwvcnhkT2dwc2F0UnF4Tit4VWRiWlJcL1dISFZNR2pJeEZcL3pVNEhldmt6YmprM3lwUVJ3VVZJcHNrNjEzSGxyaiIsIm1hYyI6ImIzMzEzZTEyZWU5OGZhNTYyZWNhNzY5ZmI0ZWMxZjczYTI3MmNhNjg2NWRjZDBiMDBjMDJkNDhlZTkzOThhZWEifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);
$data['data']=$result->data;
$data['status']='Today Registrants';
//echo $response;
}
else
{
    

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/userByDistrict?district='.$d_id.'&today=today',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IkZqaVJkcVU3NkFnVWVRM25mYkVmV3c9PSIsInZhbHVlIjoiYTRLbUZwK0VkT1BCbmhFS1Zzc3draDV5UWUzVE4rQWdTNkVsdmowWHZcL0pCWkFFYStxZjBybU5GSktQSE9PdnkiLCJtYWMiOiI1NDk2ZTI5MDhhNWRjZWY0NDBjMDc2OGQ1NWM0NzUyYjBiYjkyYTA5NGJjYmY1ZmQwYWEzMmQzYTA3ZTRmZGIyIn0%3D; haspatal_session=eyJpdiI6IlJVcStsd2kyNk0wMUZhUlJhN2tQSkE9PSIsInZhbHVlIjoiZFwvcnhkT2dwc2F0UnF4Tit4VWRiWlJcL1dISFZNR2pJeEZcL3pVNEhldmt6YmprM3lwUVJ3VVZJcHNrNjEzSGxyaiIsIm1hYyI6ImIzMzEzZTEyZWU5OGZhNTYyZWNhNzY5ZmI0ZWMxZjczYTI3MmNhNjg2NWRjZDBiMDBjMDJkNDhlZTkzOThhZWEifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);
$data['data']=$result->data;
$data['status']='Today Registrants';
//echo $response;

}

	                                                    break;
	                                                    
	                                                     case 23:
	                                                    $data['cz']=1;
	                                                    
	                                                    $data['stateData']=$this->users_model->get_state_ByUid();
	                                                    $data['districtData']=$this->users_model->get_district_ByUid();
	                                                    $data['cityData']=$this->users_model->get_city_ByUid();
	                                                    
	                                                    
	                                                    if($this->session->userdata('user_role')==19)
	                                                    {
	                                                      $this->db->select('city_zone.city_zone,city_zone.id');
	                                                    $this->db->from('city_zone');
	                                                    $this->db->where('city_id',$data['cityData']->id);
	                                                    $res=$this->db->get();
	                                                    $data['czlist']=$res->result();
	                                                    }
	                                                    else
	                                                    {
	                                                         $this->db->select('pincode.id,pincode.pincode');
	                                                    $this->db->from('pincode');
	                                                    $this->db->where('city_id',$data['cityData']->id);
	                                                    $res=$this->db->get();
	                                                    $data['plist']=$res->result();
	                                                    }
	                                                    
	                                                    $heading=$data['cityData']->city." city";
	                                                    
//return var_dump($city_name);
	                                               // exit();
	                                                    $this->session->set_userdata('statename',$heading);
	                                               
	                                                    
	                                                   
if(empty($today))
{
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/userByCity?city='.$data['cityData']->id.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IkZqaVJkcVU3NkFnVWVRM25mYkVmV3c9PSIsInZhbHVlIjoiYTRLbUZwK0VkT1BCbmhFS1Zzc3draDV5UWUzVE4rQWdTNkVsdmowWHZcL0pCWkFFYStxZjBybU5GSktQSE9PdnkiLCJtYWMiOiI1NDk2ZTI5MDhhNWRjZWY0NDBjMDc2OGQ1NWM0NzUyYjBiYjkyYTA5NGJjYmY1ZmQwYWEzMmQzYTA3ZTRmZGIyIn0%3D; haspatal_session=eyJpdiI6IlJVcStsd2kyNk0wMUZhUlJhN2tQSkE9PSIsInZhbHVlIjoiZFwvcnhkT2dwc2F0UnF4Tit4VWRiWlJcL1dISFZNR2pJeEZcL3pVNEhldmt6YmprM3lwUVJ3VVZJcHNrNjEzSGxyaiIsIm1hYyI6ImIzMzEzZTEyZWU5OGZhNTYyZWNhNzY5ZmI0ZWMxZjczYTI3MmNhNjg2NWRjZDBiMDBjMDJkNDhlZTkzOThhZWEifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);
$data['data']=$result->data;
$data['status']='Today Registrants';
//echo $response;
}
else
{
    

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/userByCity?city='.$data['cityData']->id.'&today=today',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IkZqaVJkcVU3NkFnVWVRM25mYkVmV3c9PSIsInZhbHVlIjoiYTRLbUZwK0VkT1BCbmhFS1Zzc3draDV5UWUzVE4rQWdTNkVsdmowWHZcL0pCWkFFYStxZjBybU5GSktQSE9PdnkiLCJtYWMiOiI1NDk2ZTI5MDhhNWRjZWY0NDBjMDc2OGQ1NWM0NzUyYjBiYjkyYTA5NGJjYmY1ZmQwYWEzMmQzYTA3ZTRmZGIyIn0%3D; haspatal_session=eyJpdiI6IlJVcStsd2kyNk0wMUZhUlJhN2tQSkE9PSIsInZhbHVlIjoiZFwvcnhkT2dwc2F0UnF4Tit4VWRiWlJcL1dISFZNR2pJeEZcL3pVNEhldmt6YmprM3lwUVJ3VVZJcHNrNjEzSGxyaiIsIm1hYyI6ImIzMzEzZTEyZWU5OGZhNTYyZWNhNzY5ZmI0ZWMxZjczYTI3MmNhNjg2NWRjZDBiMDBjMDJkNDhlZTkzOThhZWEifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);
$data['data']=$result->data;
$data['status']='Today Registrants';
//echo $response;

}

	                                                    
	                                                    break;
	                                                    
	                                                    
	                                                
	                                                default:
	                                                    $data['st']=$data['dis']=$data['cit']=$data['cz']=1;
	                                                     $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/user_by_role',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
        $result=json_decode($response);
$data['data']=$result->data;
$data['today']='today';
	                                                    
	                                    }
	                                
	                                
	                                
                    
                        
                    
			return $this->view('dashboard/haspatal_dashboard',$data);

			}
			
				public function filter_byRange_dashboard()
				{
				    
				    $data['st']=$data['dis']=$data['cit']=$data['cz']=0;
					if ($this->input->post('submit')) {
						
							$start_date=$this->input->post('start_date');
							$end_date=$this->input->post('end_date');
							$country=$this->input->post('country');
							$state=$this->input->post('state');
							$city=$this->input->post('city');
							$pincode=$this->input->post('pincode');
							$district=$this->input->post('district');
							
							$datal['country']=$this->db->select('country')->from('country')->where('id',$country)->get()->result();
							
							$datal['state']=$this->db->select('state')->from('state')->where('id',$state)->get()->result();
							$datal['district']=$this->db->select('district_name')->from('district')->where('id',$district)->get()->result();
							$datal['city']=$this->db->select('city')->from('city')->where('id',$city)->get()->result();
							$datal['pincode']=$pincode;
							
							//var_dump($datal['country'][0]->country);exit();
       $loc=$datal['country'][0]->country.' '.$datal['state'][0]->state.' '.$datal['district'][0]->district_name.' '.$datal['city'][0]->city.' '.$pincode;
       $data['wildvalue']=$loc;
      // exit();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/change_dashboard?start_date='.$start_date.'&end_date='.$end_date.'&country='.$country.'&state='.$state.'&city='.$city.'&pincode='.$pincode.'&district='.$district.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

$obj=json_decode($response);
//$data['post']=$this->input->post('country');
//$data['link']='http://13.59.46.134/api/change_dashboard?start_date='.$start_date.'&end_date='.$end_date.'&country='.$country.'&state='.$state.'&city='.$city.'&pincode='.$pincode.'&district='.$district.'';
                                          
                                          if($obj->status)
                                          {
                                    $data['data']=$obj->data;
					
					$this->view('dashboard/haspatal_dashboard',$data);
                                    }
                                    else
                                    {
                                          redirect('dashboard/view_haspatal_dashboard');
                                    }

					}
				}
				
				 public function compare_byRange_dashboard()
                        {
                              if ($this->input->post('submit')) {
                                    
                                        /*  $start_date1=$this->input->post('start_date1');
                                        //  $comp_end_date1=$this->input->post('end_date1');
                                         // $comp_country1=$this->input->post('comp_country1');
                                          $comp_state1=$this->input->post('comp_state1');
                                          $comp_city1=$this->input->post('comp_city1');
                                          $comp_pincode1=$this->input->post('comp_pincode1');
                                          $comp_district1=$this->input->post('comp_district1');



                                         $start_date2=$this->input->post('start_date2');
                                          $comp_end_date2=$this->input->post('end_date2');
                                          $comp_country2=$this->input->post('comp_country2');
                                          $comp_state2=$this->input->post('comp_state2');
                                          $comp_city2=$this->input->post('comp_city2');
                                          $comp_pincode2=$this->input->post('comp_pincode2');
                                          $comp_district2=$this->input->post('comp_district2');*/

$arr_data=array('start_date1' => $this->input->post('start_date1'),'end_date1' =>$this->input->post('end_date1'),'comp_country1' =>$this->input->post('comp_country1'),'comp_state1' => $this->input->post('comp_state1'),'comp_district1' => $this->input->post('comp_district1'),'comp_city1' =>$this->input->post('comp_city1'),'pincode1' =>$this->input->post('comp_pincode1'),'start_date2' =>$this->input->post('start_date2'),'end_date2' => $this->input->post('end_date2'),'comp_country2' => $this->input->post('comp_country2'),'comp_state2' =>$this->input->post('comp_state2'),'comp_district2' =>$this->input->post('comp_district2'),'comp_city2' => $this->input->post('comp_city2'),'pincode2' => $this->input->post('comp_pincode2'),'label1' => $this->input->post('range_label1'),'label2' =>$this->input->post('range_label2'));





$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/compare_dashboard',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$arr_data,
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;



$obj=json_decode($response);
$res=$obj->data;//get class data and create object to access response1 and response2

      $response1=$res->response1;
      $response2=$res->response2;

//$growth=$response2->users/$response1->users*100;
//$growth=abs($growth);

//var_dump($response2);
//var_dump($response1);

//$data['post']=$this->input->post('country');
//$data['link']='http://13.59.46.134/api/change_dashboard?start_date='.$start_date.'&end_date='.$end_date.'&country='.$country.'&state='.$state.'&city='.$city.'&pincode='.$pincode.'&district='.$district.'';
                                          
                                         if($res->status)
                                          {
                                          $data['score']=true;
                                   $data['data']=$response1;
                                   $data['data2']=$response2;
                              
                              $this->view('dashboard/haspatal_dashboard',$data);
                                    }
                                    else
                                    {
                                          redirect('dashboard/view_haspatal_dashboard');
                                    }

                              }
                        }
                        
                        
                           function approved_user()
                              {
                                                
                                                
                                                $curl = curl_init();
                                                
                                                curl_setopt_array($curl, array(
                                                  CURLOPT_URL => 'http://13.59.46.134/api/approved_user',
                                                  CURLOPT_RETURNTRANSFER => true,
                                                  CURLOPT_ENCODING => '',
                                                  CURLOPT_MAXREDIRS => 10,
                                                  CURLOPT_TIMEOUT => 0,
                                                  CURLOPT_FOLLOWLOCATION => true,
                                                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                  CURLOPT_CUSTOMREQUEST => 'GET',
                                                ));
                                                
                                                $response = curl_exec($curl);
                                                
                                                curl_close($curl);
                                                //echo $response;
                                                $res=json_decode($response);
                                               //this api for count all users
                                                $curl = curl_init();
                                                
                                                curl_setopt_array($curl, array(
                                                  CURLOPT_URL => 'http://13.59.46.134/api/user_by_role',
                                                  CURLOPT_RETURNTRANSFER => true,
                                                  CURLOPT_ENCODING => '',
                                                  CURLOPT_MAXREDIRS => 10,
                                                  CURLOPT_TIMEOUT => 0,
                                                  CURLOPT_FOLLOWLOCATION => true,
                                                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                  CURLOPT_CUSTOMREQUEST => 'GET',
                                                ));
                                                
                                                $response = curl_exec($curl);
                                                
                                                curl_close($curl);
                                                $result=json_decode($response);
                                                $data['data']=$result->data;
                                                


                        if ($res->status) {
                        

                              $data['approved']=$res->data->approved_user;
                              $data['pending']=$res->data->pending_user;
                              $data['hold']=$res->data->hold_user;

                              $this->view('dashboard/haspatal_dashboard',$data);
                        }

                              }
                              
                              
                              function business_list($type)
                              {
                    
                    
                                    if($this->session->userdata('user_role')==19)
                         {
                                             $cz=$this->db->select('cityzone')->from('users')->where('id',$this->session->userdata('id'))->get()->result();
                    
                                             $pincodes=$this->db->select('city_zone,pincodes')->from('city_zone')->where('id',$cz[0]->cityzone)->get()->result();
                                              $data['zoneDetails']="You are looknig for ".'<b>'.$pincodes[0]->city_zone.'</b>'." City Zones";
                         

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/business_by_pins?type='.$type.'&pins='.$pincodes[0]->pincodes.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$obj= json_decode($response);
}
else if($this->session->userdata('id')==102)
{
    

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/pending_business?type='.$type.'&country=3',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$obj= json_decode($response);

}
else if($this->session->userdata('user_role')==21)
{
    
$state=$this->db->select('state_id')->where('id',$this->session->userdata('id'))->get('users');
$slist=$state->result();
//return var_dump($slist[0]->state_id);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/get_state_business',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('type' => $type,'state'=>$slist[0]->state_id),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IlwvU01OVjVRNGl1emRxVU9IOUFlMGdRPT0iLCJ2YWx1ZSI6IlpzTU12bTRhOGpyNDJSMkRtVUxEWVBkWTFid1lZOUVwY2s3T1gycW9KaWs3XC9KYjB4ejl5WnNSNkxUeDV0XC9yRSIsIm1hYyI6IjU1NzhmYzZlNDhhNWY4YjFlNzUyNDJhZDg3MmJhOTIxMDBkNzUzNmMxNDdkZjcxNDk2NDQ5OTg5NWJiZGZiMDEifQ%3D%3D; haspatal_session=eyJpdiI6IkdKeG9Qb3RIV3VIOFBseDZCSWViT1E9PSIsInZhbHVlIjoiTUhhayt3NUZrSmdtOGNKYVwvaXNDekJXNGQ4am4xU0NzXC9uYWdta2p1TmJuaEx5K0dBTnFPN2ZJV2t4T0tTTFJ6IiwibWFjIjoiMzA2YjYxMWRmMTJkNjgwODFjODczNGI0MzdkODVhYzk5MThkYWE5MDI3MTNkNDBhMmYyNzMxMzBiNmM5Y2EwOSJ9'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$obj= json_decode($response);



}
else if($this->session->userdata('user_role')==22)
{
    
    $district=$this->db->select('district')->where('id',$this->session->userdata('id'))->get('users');
$dlist=$district->result();
   // return var_dump($dlist);
   // exit();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/get_district_business',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('district' =>$dlist[0]->district,'type' => $type),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IlRPMWN0T2RWSkJUVkJVNFBLQU9mekE9PSIsInZhbHVlIjoiK3pvbVhqWGlCS1Z1K3VBc3k3TzlFWGJiSFwvYzNUMm5FXC96aE5GK2dlTVA0ZkFFWk9aZWh0SzE4N0ltUUJBaDV2IiwibWFjIjoiMjUzZjMyZThkNjFmN2Q0M2U1YzIxNzE5NzMzOWUxZDNmMzAwODUzNjJkNGVmNDdkODQ5NTczZGRhNzc5MjI5MiJ9; haspatal_session=eyJpdiI6ImEzVVJEQWQwM2lwWFwvbG9GWm94N1J3PT0iLCJ2YWx1ZSI6Imx3UHdodzJ0R1hzMGVcL29DcTZDSnFvK1huMXJkZDJVNmc0RXFjeXVsU21RcFwvN2d5ZnhWYW1QZStGMmk2R2JpRiIsIm1hYyI6ImE0MzI4M2ZjYzE1ZjJiOWQwN2RlM2I2NDA1OWM0NGZlN2Q0OWU2MGM1NjRjOWFlMmY2NTkzMDhmZDdjZjUyYzMifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$obj= json_decode($response);


}
else if($this->session->userdata('user_role')==23)
{
    
    $district=$this->db->select('city_id')->where('id',$this->session->userdata('id'))->get('users');
$clist=$district->result();
   // return var_dump($dlist);
   // exit();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/get_city_business',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('city' =>$clist[0]->city_id,'type' => $type),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IlRPMWN0T2RWSkJUVkJVNFBLQU9mekE9PSIsInZhbHVlIjoiK3pvbVhqWGlCS1Z1K3VBc3k3TzlFWGJiSFwvYzNUMm5FXC96aE5GK2dlTVA0ZkFFWk9aZWh0SzE4N0ltUUJBaDV2IiwibWFjIjoiMjUzZjMyZThkNjFmN2Q0M2U1YzIxNzE5NzMzOWUxZDNmMzAwODUzNjJkNGVmNDdkODQ5NTczZGRhNzc5MjI5MiJ9; haspatal_session=eyJpdiI6ImEzVVJEQWQwM2lwWFwvbG9GWm94N1J3PT0iLCJ2YWx1ZSI6Imx3UHdodzJ0R1hzMGVcL29DcTZDSnFvK1huMXJkZDJVNmc0RXFjeXVsU21RcFwvN2d5ZnhWYW1QZStGMmk2R2JpRiIsIm1hYyI6ImE0MzI4M2ZjYzE1ZjJiOWQwN2RlM2I2NDA1OWM0NGZlN2Q0OWU2MGM1NjRjOWFlMmY2NTkzMDhmZDdjZjUyYzMifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

$obj= json_decode($response);


}
else

{
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/business_by_pins?type='.$type.'&country=3',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$obj= json_decode($response);
}

                        if($obj->status)
                        {
                            $data['business']=$obj->data;
                            $this->view('dashboard/business_list',$data);
                        }
                        else
                        {
                           return var_dump($obj);
                           // redirect('dashboard/view_haspatal_dashboard');
                        }

                              }
				        
				        function support_ticket($b_type,$id)
				        {
				            

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/single_pending_business?type='.$b_type.'&id='.$id.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
                        $obj=json_decode($response);
         
                        if($obj->status)
                        {
                            $d['1']=$obj->data;
                            $data['data']=$d[1][0];
                            var_dump($data);
                          return $this->view('dashboard/businesss/support_ticket',$data);
                        }


				        }
				        
				        function discard_business($id,$b_type)
				        {
				            

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/discard2business',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('business_id' =>$id,'assign_to' => '82','discard_by' =>$this->session->userdata('id'),'b_type'=>$b_type),
));

$response = curl_exec($curl);

curl_close($curl);
                $obj=json_decode($response);
                             if($obj->status)
                            {
                                return redirect('dashboard/business_list/'.$obj->b_type);
                            }
				        }
				        
				        
				        
				        
				        function all_business_list($type)
				        {
				                $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/business_by_pins?type='.$type.'&country=3',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$obj= json_decode($response);


                        if($obj->status)
                        {
                            $data['business']=$obj->data;
                            $this->view('dashboard/business_list',$data);
                        }
                        else
                        {
                           return var_dump($obj);
                            redirect('dashboard/view_haspatal_dashboard');
                        }

                              }
				        
				        
				        
				        
				        
				
}