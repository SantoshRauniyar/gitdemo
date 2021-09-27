<?php

/**
 * API Controller
 */
class Api extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}

	function get_country()
	{

		if($this->input->get('token'))
			
			{
				$data=$this->users_model->get_country();
				
				if (!empty($data)) {
				http_response_code(200);
			 $response=['status'=>true,"data"=>$data,"message"=>"Country Fetched Successfully"];
			}
			else
			{
				
				http_response_code(403);
			 $response=["status"=>false,"message"=>"Country not fetched"];
				
			}
			
			return print_r(json_encode($response));
	
}
}

                	function get_stateById()
	{

		if($id=$this->input->get('country_id'))
			
			{
				$data=$this->users_model->get_state_byCountry_api(3);
				
				if (!empty($data)) {
				http_response_code(200);
			 $response=['status'=>true,"data"=>$data,"message"=>"State Fetched Successfully"];
			}
			else
			{
				
				http_response_code(200);
			 $response=["status"=>false,"message"=>"State not fetched"];
				
			}
			
			
	
}
else
{
	http_response_code(200);
	$response=["status"=>false,"message"=>"Invalid Keyword"];
}
		return print_r(json_encode($response));
}

}
?>