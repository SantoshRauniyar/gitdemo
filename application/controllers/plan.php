<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

class Plan extends Template
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
		$data = array();
		$this->set_title("Plan Slection");
	
		$data['mode'] 			= "Display";

		//set role in session
			if ($this->session->userdata('user_role')!="Captain") {
				$this->db->where('id',$this->session->userdata('user_role'));
   				 	$res=$this->db->get('user_roles');
   				 $deliveryData=$res->result_array();
   				 $deliveryData=$deliveryData[0];
   				 $this->session->set_userdata('deliverdata1', $deliveryData);         #to set the session with the above array
				
   						 ### for retrieving the session values ###
   	  	 $deliveryData   = $this->session->userdata('deliverdata1');          #will return the whole array
			}


		$data['planDetails'] = $this->plan_model->getPlanDetails();
		$this->view("plan_details",$data);





	}
	
	public function getPlanList()
	{
		$this->load->model('plan_model');
		$data   = array();
		$result = $this->plan_model->getPlanList();
		
		
		if(!empty($result))
		{			
			$data['status'] = "success";
			$data['data']	 = $result;
		}
		else 
		{
			$data['status'] = "error";
			$data['data']	 = $result;
		}
		
		echo json_encode($data);
		exit;
	}
	
	public function getPlanDetails($plan_id)
	{
		$data = array();
		if($this->input->is_ajax_request())
		{
			//$plan_id  = $this->input->post('plan_id');
			if($plan_id == '')
			{
				$data['status'] = "error";
				$data['data']	= "No Plan Selected . Please select any plan .";
				
				echo json_encode($data);
				exit;
			}
			$plan_details = $this->plan_model->getplanfeaturebyid($plan_id);
			if($plan_details)
			{
				$data['status'] = "success";
				$data['data']	= $plan_details;
				echo json_encode($data);
				exit;
			}
		}
		else 
		{
			$plan_details = $this->plan_model->getplanfeaturebyid($plan_id);
			if($plan_details)
			{
				$this->set_title("Payment");

				$data['mode'] 			= "Payment";
				$data['planDetails'] = $plan_details;
				$this->view("plan_details",$data);
			}
		}
	}
	
	public function payment_checkout($plan_id = null,$price = null)
	{
		$data		= array();
		$plan_title = $this->input->post('plan_title');
		$validiti   = $this->input->post('validiti_period');
		if($price == null && $plan_id == null)
		{
			$plan_id	= $this->input->post('plan_id');
			$price 	= $this->input->post('price');
			if($price == '')
			{	
				$data['id']			  = $this->session->userdata('id');
    			$data['plan_id']	  = $plan_id;
    			//$data['payment_ref']  = $gateway_reference;
    			$data['payment_date'] = date('d m y'); 
    			//print_r($data);exit;
    			$this->users_model->set_fields($data);
    			$result = $this->users_model->do_update();
    			
    			if($result > 0)
    			{
    				$this->session->set_userdata('plan_id',$data['plan_id']);
    				$data['mode'] = "Success_Payment";
    				$data['price'] = '';
    				$this->view("plan_details",$data);
    			}
			}
			else
			{
				$order  	= array(
									'name' => $plan_title,
									'desc' => $plan_title."Plan for ".$validiti." years.",
									'amt'	 => $price
								); 
				$params 	= array(
    								'amount' 	=> $price,
    								'currency' 	=> 'USD',
    								'items'		=> $order,
    								'return_url' => base_url().'plan/payment_checkout/'.$plan_id.'/'.$price.'/',
    								'cancel_url' => 'https://www.example.com/checkout'    								
    							);

				$response = $this->merchant->purchase($params);
			}
		}
		else 
		{
			$order  = array(
									'name' => $plan_title,
									'desc' => $plan_title."Plan for ".$validiti." years.",
									'amt'	 => $price
								); 
			$params = array(
    								'amount' 	=> $price,
    								'currency' 	=> 'USD',
    								'items'		 => $order,
    								'return_url' => base_url().'plan/payment_checkout/'.$plan_id.'/'.$price.'/',
    								'cancel_url' => 'https://www.example.com/checkout'
    							);
			$response = $this->merchant->purchase_return($params);

			if ($response->success())
			{
    			$gateway_reference 	 = $response->reference();
    			
    			$data['id']			  = $this->session->userdata('id');
    			$data['plan_id']	  = $plan_id;
    			$data['payment_ref']  = $gateway_reference;
    			$data['payment_date'] = date('d m y'); 
    			//print_r($data);exit;
    			$this->users_model->set_fields($data);
    			$result = $this->users_model->do_update();
    			
    			if($result > 0)
    			{
    				$this->session->set_userdata('plan_id',$data['plan_id']);
    				$data['mode'] = "Success_Payment";
    				$data['price'] = $price;
    				$this->view("plan_details",$data);
    			}
    			//redirect('plan/');
			}
			else
			{
    			$message = $response->message();
    			echo('Error processing payment: ' . $message);
    			exit;
    		}
    	}
	}
}