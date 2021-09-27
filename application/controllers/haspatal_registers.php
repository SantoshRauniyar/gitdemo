<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class haspatal_registers extends Template
{
	public function __construct()
	{
		parent::__construct();
		
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->model('team_model');
		//$this->load->model('program_model');
		$this->load->model('authentication_model');
		$this->load->model('users_model');
		$this->load->model('user_classification_model');
		$this->user_classification_model->set_role();
		$this->load->model('user_role_model');
		$this->load->model('plan_model');
		$this->set_header_path('blocks/header');
		//	$this->set_header_path('administrator/blocks/footer');
		$this->set_template('template');
		$this->set_title('Team Management');
		
		$this->assets_load->add_css(array(base_url('assets/administrator/css/bootstrap-formhelpers.css'),
						  				  base_url('assets/administrator/css/bootstrap-formhelpers.min.css')),"header");
						  
		$this->assets_load->add_js(array(base_url('assets/administrator/js/bootstrap-formhelpers.js'),
				  						 base_url('assets/administrator/js/ckeditor/ckeditor.js'),
										 base_url('assets/administrator/js/vendors/team.js')),"footer");

		if(!$this->session->userdata('id'))
			redirect("authentication/");
	}


                function countBusiness()
                {
                    if($this->input->post('btype'))
                    {
                        
                       $inputdata= array(
                           
                         'btype' => $this->input->post('btype'),
                        'country' => $this->input->post('country'),
                        'state' => $this->input->post('state'),
                        'district' => $this->input->post('district'),
                        'city' => $this->input->post('city'),
                        'pincode' => $this->input->post('pincode'),
                        'start_date' => $this->input->post('start_date'),
                        'end_date' => $this->input->post('end_date')
                    );
                        
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/business_filter',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$inputdata,
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijk2YTEwY2FlNTYzY2I5N2RlYTdmODA5ODc5NmVjOGM0ODFhMDk5OThmMjQ0MzdlY2E1NjI5ZmZmZjQ2OWUxZWE2MGFhYTVlOWM5NDQzNzgzIn0.eyJhdWQiOiIxIiwianRpIjoiOTZhMTBjYWU1NjNjYjk3ZGVhN2Y4MDk4Nzk2ZWM4YzQ4MWEwOTk5OGYyNDQzN2VjYTU2MjlmZmZmNDY5ZTFlYTYwYWFhNWU5Yzk0NDM3ODMiLCJpYXQiOjE2Mjg2ODE0MDYsIm5iZiI6MTYyODY4MTQwNiwiZXhwIjoxNjYwMjE3NDA2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.mvkFLdckLngyqR8Yyi_ywMojl7OXccMwwqjwAf7lxl9rzcNsVRzpQtPSGxrjsReWiG0MpjrHCb8hOOAgcTtxku_MyfTRhg6LNbGegSIgCxuVybobzw0UyoUQnjIQrSegrR483Vhez-Ivu6AQExntpd-zUl3KqG66wxIfbjX46THzCZigpsL2t9V9ZsVvxXKnohghJfx_pOfhkeqkybmzlvj8vw95ZWdHoU3xrENzAOND-rHb9rPZYLmI1OlUT_3_GB4ISGm5gvfzHnApCX_prcs3KBY_r1g0l9q4oZindZmnqFMPn5OLpp2zOBG87ezr4GxUK_rDNlZXwSLegS5Xnmwy6iLYgEBvuPJ5GJ9QwOT4Bt3cFQJBphFCoKXklh8bTG7lPHTPu4zoeoGbR2ny2XLCvR-AtACXk__uh5qngFLhUtxwG7AqvWr-VAeB2gOnQjSDb7TNLZ3ZzrZdFKSAh6TkFw_cP1FnYDhWvkhKNmv5-Q4xabrBvp33mrCH8mqh-A1XS-peeIw83A65i-RMTeClqfNimjaZyR6YHz06_ke90dagA6ORKMTcfO46ptOq-5-_-hqe7Omfv6s0QcIvC_jjM7PnQgN5c2dvojQyxznbA-g3KyCsrXSwDqLtloDxdsZAwLtRyYl3kdrIInYUZRN8lDX9M6mmP7qcf5D33Q4',
    'Cookie: XSRF-TOKEN=eyJpdiI6ImIyekR4QU1WaXJrVG9iV2lFVWFvMmc9PSIsInZhbHVlIjoiUHl5TmhNZ0RTeHd5U2Q4bXNUQkdWYUM0THFmYnE1SndEam9qWEZzRjY3WmdYSkZSYis1ZVJuRFhvSVJPcUJNaiIsIm1hYyI6IjQ5NmE1NmQzOGViM2Q0OTM4M2ZkMmIyN2FiMGY1NTZkNWVmZjQ0MmI3MzVhNTZjMjE3M2FhOWU5NzliZGIxODMifQ%3D%3D; haspatal_session=eyJpdiI6IllzK3JQSUNZSVwvUzdTQWxudERtY2VBPT0iLCJ2YWx1ZSI6IlNQVVVnU09lVUloaDdPU1VFNGNuQkRVU1RhSnV3VDVaa1wvd0lUZGZNcFY1MWh1XC81Nlc2SnlIa0JTZHoyYWhSQSIsIm1hYyI6IjNmNGNiY2Q4YjBiMDA1ZmNkZWZkOTU0MmNiMzMxODQwNDJmYWRlNDM1NjNiNjhlMTIxYmZjM2MxZjMwY2MzZmIifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
                    
                    return print_r($response);
                    }
                    else
                    {
                        return print_r(json_encode(['status'=>false,'message'=>'Please check Business type']));
                    }
                }

	public function index()
	{
		

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/khaspatalusers',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRiY2UxYjFjODAwOTY0YjVkMTAxMGQzZmM4YTI5NmFkOThkYWRkMjBiYWY2OGJjMzhhMWZjMGZiOThlNTllZTM5MzA3YWU1ODMzYmY3YmEyIn0.eyJhdWQiOiIxIiwianRpIjoiNGJjZTFiMWM4MDA5NjRiNWQxMDEwZDNmYzhhMjk2YWQ5OGRhZGQyMGJhZjY4YmMzOGExZmMwZmI5OGU1OWVlMzkzMDdhZTU4MzNiZjdiYTIiLCJpYXQiOjE2MTM2MzYzMzQsIm5iZiI6MTYxMzYzNjMzNCwiZXhwIjoxNjQ1MTcyMzM0LCJzdWIiOiIyMzUiLCJzY29wZXMiOltdfQ.TXQAemLc1dGZLQIxF5qEIqFduMK60FSzSKTKfznezwxQKHiKD3yvPRNbPFjv_WHQyfnRxkRMb1Eko-UVsD6Kdxp7S6bu8Uv5dJjAPQ-kUWyA6-gk_S0_fyZOWF8LIB9N1hOiiv86XSQQiKrmrNtuXbKZTNm_3g7phC0yBf38J6_Oo5o-pdJSrD5nTFDwb_1s5VUwX6UbfKv_qtaGvUhkCGBRTl4KAWPDjgclpfxah6O4OELUwPOoAP4i8KYi1Glj1hBcFN6sq8IlJYYV0pVkonJsZrrxDacKHzQEvSWioj8HYMZbMrxohgiMEa7gXtvCJ64BEJ_dCQ-xyfThOcquRjYkzoeMm6FdVWraOWxa1bW2k4H2KmP0fb5BDhsrtHohzfWN80cNyTbo8BWf0wOyLj4MdoL_Frr6hRYewM_oNT-EJGK-X0LiQ_3S0NNS1lDmL4PMLqtG09gEpFOc9dri--G3Yae_D2efIW-IxupDcfOqIyllvCc6NQyAp9VJNoZ0LyLliuEMN-IiLj3y2OiHuJ3N-ch-ceqZBh31_xZRBFI8-n6eE9hSULLigd_qFFFyCEosFS7m7wbDjwg8as-aIrUSC3nNr6OovKQMkiJEqtOhb9xS7qiHdO6rBouiFnVSQfH11ajxNDtYqNkU8xz97z0Rw39OdasGyxO-c4MtNqE'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
         $obj=json_decode($response);
         if($obj->status)
         {
             $data['haspatal_data']=$obj->data;
             
         }
         else
         {
             $data['haspatal_data']=null;
         }
         
         $this->view('haspatal/registers',$data);

	}

          function view_haspatal($id)
          {
          
            $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/single_hospital',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id' =>$id),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRiY2UxYjFjODAwOTY0YjVkMTAxMGQzZmM4YTI5NmFkOThkYWRkMjBiYWY2OGJjMzhhMWZjMGZiOThlNTllZTM5MzA3YWU1ODMzYmY3YmEyIn0.eyJhdWQiOiIxIiwianRpIjoiNGJjZTFiMWM4MDA5NjRiNWQxMDEwZDNmYzhhMjk2YWQ5OGRhZGQyMGJhZjY4YmMzOGExZmMwZmI5OGU1OWVlMzkzMDdhZTU4MzNiZjdiYTIiLCJpYXQiOjE2MTM2MzYzMzQsIm5iZiI6MTYxMzYzNjMzNCwiZXhwIjoxNjQ1MTcyMzM0LCJzdWIiOiIyMzUiLCJzY29wZXMiOltdfQ.TXQAemLc1dGZLQIxF5qEIqFduMK60FSzSKTKfznezwxQKHiKD3yvPRNbPFjv_WHQyfnRxkRMb1Eko-UVsD6Kdxp7S6bu8Uv5dJjAPQ-kUWyA6-gk_S0_fyZOWF8LIB9N1hOiiv86XSQQiKrmrNtuXbKZTNm_3g7phC0yBf38J6_Oo5o-pdJSrD5nTFDwb_1s5VUwX6UbfKv_qtaGvUhkCGBRTl4KAWPDjgclpfxah6O4OELUwPOoAP4i8KYi1Glj1hBcFN6sq8IlJYYV0pVkonJsZrrxDacKHzQEvSWioj8HYMZbMrxohgiMEa7gXtvCJ64BEJ_dCQ-xyfThOcquRjYkzoeMm6FdVWraOWxa1bW2k4H2KmP0fb5BDhsrtHohzfWN80cNyTbo8BWf0wOyLj4MdoL_Frr6hRYewM_oNT-EJGK-X0LiQ_3S0NNS1lDmL4PMLqtG09gEpFOc9dri--G3Yae_D2efIW-IxupDcfOqIyllvCc6NQyAp9VJNoZ0LyLliuEMN-IiLj3y2OiHuJ3N-ch-ceqZBh31_xZRBFI8-n6eE9hSULLigd_qFFFyCEosFS7m7wbDjwg8as-aIrUSC3nNr6OovKQMkiJEqtOhb9xS7qiHdO6rBouiFnVSQfH11ajxNDtYqNkU8xz97z0Rw39OdasGyxO-c4MtNqE'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

            $obj=json_decode($response);
                
                        if($obj->status)
                        {
                           // var_dump($obj->data);
                 $data['haspatal']=$obj->data;
               $this->view('haspatal/single_view',$data);
                        }
            
        
                
               
            


                                                    

              
          }
          

            function assigned_task()
            {
                $this->form_validation->set_rules('member','Member','required|trim');
                $this->form_validation->set_rules('priority','Priority','required|trim');
                $this->form_validation->set_rules('remark','Remarks','required');
                
                //$this->form_validation->set_rules('id','Remarks','required');
                
                
                if($this->form_validation->run()==false)
                {
                    $this->session->set_userdata('fail_assign','Failed ! Try Again to ssigned');
                    redirect('unit/taskboard');
                }
                else
                {
                    $arr=[
                        "assign_uid"=>$this->input->post('member'),
                        "priority"=>$this->input->post('priority'),
                        "description"=>$this->input->post('remark'),
                        "status"=>1,
                        "created_by"=>$this->session->userdata('id')
                        
                        ];
                        
                        
                        $email=$this->user_role_model->getEmail($arr['assign_uid']);
                    
                    var_dump($email[1]);

                    
                       $id=$this->input->post('id');
                        $this->db->where('id',$id);
                    if($this->db->update('taskk',$arr))
                    {
                    
                    if(!empty($email))
                    {
                    
                                        $email=$email[0]->email;
                        //$email="santoshrauniyar20408@gmail.com";
                    
                     if($email != '')
			{
				if(filter_var($email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/task/task.html");
					$emailBody = str_replace("<@unit_head@>","Santosh",$emailBody);

					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($email, "Task Management - Task Assigned to you from  Team.", $emailBody, $headers))
					{
						echo "email not sent";
						$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
					else
					{
					    echo "Mail sent";
					}
					
					
				
					
					
				}
				else 
				{
					echo"InValid Email";
					$this->session->set_flashdata( "errors", "Please enter valid email address.");
			
				}
				         
	            	}
                }
                    //$emailBody = str_replace("<@email@>",$data['email'],$emailBody);
                        
                        
                        
                     
                        redirect('unit/taskboard');
                    }
                    
                }
            }
            
            
            
            function haspatal_status($id,$status)
            {
                   
                   
              // echo $id."  ".$status;             


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/user_status',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id' => $id,'status' => $status,'updated_by' => $this->session->userdata('user_name')),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRiY2UxYjFjODAwOTY0YjVkMTAxMGQzZmM4YTI5NmFkOThkYWRkMjBiYWY2OGJjMzhhMWZjMGZiOThlNTllZTM5MzA3YWU1ODMzYmY3YmEyIn0.eyJhdWQiOiIxIiwianRpIjoiNGJjZTFiMWM4MDA5NjRiNWQxMDEwZDNmYzhhMjk2YWQ5OGRhZGQyMGJhZjY4YmMzOGExZmMwZmI5OGU1OWVlMzkzMDdhZTU4MzNiZjdiYTIiLCJpYXQiOjE2MTM2MzYzMzQsIm5iZiI6MTYxMzYzNjMzNCwiZXhwIjoxNjQ1MTcyMzM0LCJzdWIiOiIyMzUiLCJzY29wZXMiOltdfQ.TXQAemLc1dGZLQIxF5qEIqFduMK60FSzSKTKfznezwxQKHiKD3yvPRNbPFjv_WHQyfnRxkRMb1Eko-UVsD6Kdxp7S6bu8Uv5dJjAPQ-kUWyA6-gk_S0_fyZOWF8LIB9N1hOiiv86XSQQiKrmrNtuXbKZTNm_3g7phC0yBf38J6_Oo5o-pdJSrD5nTFDwb_1s5VUwX6UbfKv_qtaGvUhkCGBRTl4KAWPDjgclpfxah6O4OELUwPOoAP4i8KYi1Glj1hBcFN6sq8IlJYYV0pVkonJsZrrxDacKHzQEvSWioj8HYMZbMrxohgiMEa7gXtvCJ64BEJ_dCQ-xyfThOcquRjYkzoeMm6FdVWraOWxa1bW2k4H2KmP0fb5BDhsrtHohzfWN80cNyTbo8BWf0wOyLj4MdoL_Frr6hRYewM_oNT-EJGK-X0LiQ_3S0NNS1lDmL4PMLqtG09gEpFOc9dri--G3Yae_D2efIW-IxupDcfOqIyllvCc6NQyAp9VJNoZ0LyLliuEMN-IiLj3y2OiHuJ3N-ch-ceqZBh31_xZRBFI8-n6eE9hSULLigd_qFFFyCEosFS7m7wbDjwg8as-aIrUSC3nNr6OovKQMkiJEqtOhb9xS7qiHdO6rBouiFnVSQfH11ajxNDtYqNkU8xz97z0Rw39OdasGyxO-c4MtNqE'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

        $obj=json_decode($response);
                                
                            if($obj->status)
                            {
                                
                                if (!empty($id)) 
                                
                {

							if ($status==2) {
								
								date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
								//4 is approved status in kizaku and 2 is in haspatal

								$arr=[
											"status"=>4,
											"completed_at"=>date("Y-m-d H:i:s")
								];
						$this->db->where('hs_id',$id);		
						$this->db->update('taskk',$arr);
						
							}

							else
						{
						$this->db->where('hs_id',$id);
						$this->db->set('status',$status);
						$this->db->update('taskk');
						
					 }
			}
                                
                                
                                if($status==2)
                                {
                                $email=$obj->haspatal->email;
                                
                                $fullname=$obj->haspatal->first_name.' '.$obj->haspatal->last_name;
                                
                                 if($email != '')
			{
				if(filter_var($email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents(base_url()."assets/email/approval.html");
					//$emailBody = str_replace("<@unit_head@>",'Task Status',$emailBody);
					$emailBody = str_replace("<@user_name@>",$fullname,$emailBody);
				

					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($email, "Registration Approved", $emailBody, $headers))
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
                            
                                
                                
                                
                                redirect('haspatal_registers/view_haspatal/'.$id);
                            }


                                
            }
                            function check_business()
                            {
                                if($mob=$this->input->post('m'))
                                {
                                    

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/is_business_exist',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('mobile' => $mob),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRiY2UxYjFjODAwOTY0YjVkMTAxMGQzZmM4YTI5NmFkOThkYWRkMjBiYWY2OGJjMzhhMWZjMGZiOThlNTllZTM5MzA3YWU1ODMzYmY3YmEyIn0.eyJhdWQiOiIxIiwianRpIjoiNGJjZTFiMWM4MDA5NjRiNWQxMDEwZDNmYzhhMjk2YWQ5OGRhZGQyMGJhZjY4YmMzOGExZmMwZmI5OGU1OWVlMzkzMDdhZTU4MzNiZjdiYTIiLCJpYXQiOjE2MTM2MzYzMzQsIm5iZiI6MTYxMzYzNjMzNCwiZXhwIjoxNjQ1MTcyMzM0LCJzdWIiOiIyMzUiLCJzY29wZXMiOltdfQ.TXQAemLc1dGZLQIxF5qEIqFduMK60FSzSKTKfznezwxQKHiKD3yvPRNbPFjv_WHQyfnRxkRMb1Eko-UVsD6Kdxp7S6bu8Uv5dJjAPQ-kUWyA6-gk_S0_fyZOWF8LIB9N1hOiiv86XSQQiKrmrNtuXbKZTNm_3g7phC0yBf38J6_Oo5o-pdJSrD5nTFDwb_1s5VUwX6UbfKv_qtaGvUhkCGBRTl4KAWPDjgclpfxah6O4OELUwPOoAP4i8KYi1Glj1hBcFN6sq8IlJYYV0pVkonJsZrrxDacKHzQEvSWioj8HYMZbMrxohgiMEa7gXtvCJ64BEJ_dCQ-xyfThOcquRjYkzoeMm6FdVWraOWxa1bW2k4H2KmP0fb5BDhsrtHohzfWN80cNyTbo8BWf0wOyLj4MdoL_Frr6hRYewM_oNT-EJGK-X0LiQ_3S0NNS1lDmL4PMLqtG09gEpFOc9dri--G3Yae_D2efIW-IxupDcfOqIyllvCc6NQyAp9VJNoZ0LyLliuEMN-IiLj3y2OiHuJ3N-ch-ceqZBh31_xZRBFI8-n6eE9hSULLigd_qFFFyCEosFS7m7wbDjwg8as-aIrUSC3nNr6OovKQMkiJEqtOhb9xS7qiHdO6rBouiFnVSQfH11ajxNDtYqNkU8xz97z0Rw39OdasGyxO-c4MtNqE'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
        $obj=json_decode($response);
        
                if($obj->status)
                {
                    echo $obj->data->id.'/'.$obj->data->full_name.'/'.$obj->data->email.'/'.$obj->data->b_type;
                }
                else
                {
                    echo'0';
                }

                                }
                            }
                        
                            function business_register()
                            {
                                $this->view('haspatal/business_register/business_register.php');
                            }
                        
                        function save_business()
                        {
                           $b_lic_tmp=$_FILES['b_lic']['tmp_name'];
                           $b_shop_tmp=$_FILES['b_shop_pic']['tmp_name'];
                           $b_card_tmp=$_FILES['b_card_pic']['tmp_name'];
                                    
                                  $postFields=  array(
                                      'user_id' => $this->input->post('user_id'),
                                      'b_id' => $this->input->post('b_type'),
                                      'b_name' => $this->input->post('b_name'),
                                      'country_id' => $this->input->post('country'),
                                      'state_id' => $this->input->post('state'),
                                      'district' => $this->input->post('district'),
                                      'city_id' => $this->input->post('city'),
                                      'pincode' => $this->input->post('pincode'),
                                      'description' => $this->input->post('profile'),
                                      );
                                      
                $postFields['b_lic']= $_FILES['b_lic']['name'] ? new CURLFILE($b_lic_tmp,$_FILES['b_lic']['type'],$_FILES['b_lic']['name']):'';
                
                $postFields['b_card_pic'] = $_FILES['b_card_pic']['name'] ? new CURLFILE($b_card_tmp,$_FILES['b_card_pic']['type'],$_FILES['b_card_pic']['name']):'';
                
                $postFields['shop_pic']= $_FILES['b_shop_pic']['name'] ? new CURLFILE($b_shop_tmp,$_FILES['b_shop_pic']['type'],$_FILES['b_shop_pic']['name']):'';
                           
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/save_business',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $postFields,
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRiY2UxYjFjODAwOTY0YjVkMTAxMGQzZmM4YTI5NmFkOThkYWRkMjBiYWY2OGJjMzhhMWZjMGZiOThlNTllZTM5MzA3YWU1ODMzYmY3YmEyIn0.eyJhdWQiOiIxIiwianRpIjoiNGJjZTFiMWM4MDA5NjRiNWQxMDEwZDNmYzhhMjk2YWQ5OGRhZGQyMGJhZjY4YmMzOGExZmMwZmI5OGU1OWVlMzkzMDdhZTU4MzNiZjdiYTIiLCJpYXQiOjE2MTM2MzYzMzQsIm5iZiI6MTYxMzYzNjMzNCwiZXhwIjoxNjQ1MTcyMzM0LCJzdWIiOiIyMzUiLCJzY29wZXMiOltdfQ.TXQAemLc1dGZLQIxF5qEIqFduMK60FSzSKTKfznezwxQKHiKD3yvPRNbPFjv_WHQyfnRxkRMb1Eko-UVsD6Kdxp7S6bu8Uv5dJjAPQ-kUWyA6-gk_S0_fyZOWF8LIB9N1hOiiv86XSQQiKrmrNtuXbKZTNm_3g7phC0yBf38J6_Oo5o-pdJSrD5nTFDwb_1s5VUwX6UbfKv_qtaGvUhkCGBRTl4KAWPDjgclpfxah6O4OELUwPOoAP4i8KYi1Glj1hBcFN6sq8IlJYYV0pVkonJsZrrxDacKHzQEvSWioj8HYMZbMrxohgiMEa7gXtvCJ64BEJ_dCQ-xyfThOcquRjYkzoeMm6FdVWraOWxa1bW2k4H2KmP0fb5BDhsrtHohzfWN80cNyTbo8BWf0wOyLj4MdoL_Frr6hRYewM_oNT-EJGK-X0LiQ_3S0NNS1lDmL4PMLqtG09gEpFOc9dri--G3Yae_D2efIW-IxupDcfOqIyllvCc6NQyAp9VJNoZ0LyLliuEMN-IiLj3y2OiHuJ3N-ch-ceqZBh31_xZRBFI8-n6eE9hSULLigd_qFFFyCEosFS7m7wbDjwg8as-aIrUSC3nNr6OovKQMkiJEqtOhb9xS7qiHdO6rBouiFnVSQfH11ajxNDtYqNkU8xz97z0Rw39OdasGyxO-c4MtNqE'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
//echo $response;
//echo realpath($_FILES['b_lic']['name']);
                                            $obj=json_decode($response);
                                            var_dump($obj);
                             if($obj->status)
                             {
                           return  $this->view('haspatal/success_business');
                             }
                             else
                             {
                                  return  $this->view('haspatal/failed_business');
                             }
                             
                        }
                        
                        public function serviceDashboard()
                        {
                         

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/Haspatal360ServiceCount',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('status' => '1','business_type' => '11'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6InNKd3lyM21TVytDeGtBTUhqNzQyTGc9PSIsInZhbHVlIjoiR1wvTURTZzc5d2c3blZoWmdzM1FPQTdmMFBHYmd5XC9DOTFxOVRvN01kdXBlemFhaFp3bDV3NnZoemVRWmE1S2ZSIiwibWFjIjoiMjVjM2U1YWEzYWJhZTk5MzA4YjNmMjY2ODUyYTVhYmJhNzBlNTg5ZTNiMzVkZGFlMmYwOTVmMjA3OGI3MzU0NiJ9; haspatal_session=eyJpdiI6ImxVRXRLUktmXC9uVlR5bzlzblp4N3hnPT0iLCJ2YWx1ZSI6ImtlRHRFa0cyS05lbmt2TW5sMk15RlB4d3ZVSlFrSVM2WmowaU5PUHpRTDJGazZKelA4RENHcDhCemxMaFRVRFgiLCJtYWMiOiI1NGRlNzczODJlMmMyYmM0N2VjYmUxNWYxYTM2NmIzZGQ2ZGRiYWFmZTRhZTA5N2YwZTNlNGE4MDBjZjY1MGYyIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;                 
if(!empty($response))
                                            {
                                                 $data=json_decode($response);
                                                 $drdata['today']=$data->today;
                                                 $drdata['month']=$data->month;
                                                 $drdata['week']=$data->week;
                                                 $drdata['yesterday']=$data->yesterday;
                                                $drdata['fortnight']=$data->fortnight;
                                                 $drdata['year']=$data->year;
                                                 $drdata['total']=$data->total;
                                                 $drdata['heading']='Pharmacy ';
                                                 $drdata['link']='1/11';
                                                 $drdata['st']=1;
                                                 $drdata['btype']=11;
                                                return $this->view('haspatal/dr_dashboard',compact('drdata'));
                                            }
                                            else
                                            {
                                                $this->session->set_flashdata('errors','Please Check your Internet');
                                                return redirect('/taskoard');
                                            }
   
                        }
                        
                        
                        public function TherapyDashboard()
                        {
                         

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/Haspatal360ServiceCount',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('status' => '1','business_type' => '16'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6InNKd3lyM21TVytDeGtBTUhqNzQyTGc9PSIsInZhbHVlIjoiR1wvTURTZzc5d2c3blZoWmdzM1FPQTdmMFBHYmd5XC9DOTFxOVRvN01kdXBlemFhaFp3bDV3NnZoemVRWmE1S2ZSIiwibWFjIjoiMjVjM2U1YWEzYWJhZTk5MzA4YjNmMjY2ODUyYTVhYmJhNzBlNTg5ZTNiMzVkZGFlMmYwOTVmMjA3OGI3MzU0NiJ9; haspatal_session=eyJpdiI6ImxVRXRLUktmXC9uVlR5bzlzblp4N3hnPT0iLCJ2YWx1ZSI6ImtlRHRFa0cyS05lbmt2TW5sMk15RlB4d3ZVSlFrSVM2WmowaU5PUHpRTDJGazZKelA4RENHcDhCemxMaFRVRFgiLCJtYWMiOiI1NGRlNzczODJlMmMyYmM0N2VjYmUxNWYxYTM2NmIzZGQ2ZGRiYWFmZTRhZTA5N2YwZTNlNGE4MDBjZjY1MGYyIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;                 
if(!empty($response))
                                            {
                                                 $data=json_decode($response);
                                                 $drdata['today']=$data->today;
                                                 $drdata['month']=$data->month;
                                                 $drdata['week']=$data->week;
                                                 $drdata['yesterday']=$data->yesterday;
                                                $drdata['fortnight']=$data->fortnight;
                                                 $drdata['year']=$data->year;
                                                 $drdata['total']=$data->total;
                                                 $drdata['heading']='Therapy ';
                                                 $drdata['link']='1/16';
                                                 $drdata['st']=1;
                                                 $drdata['btype']=16;
                                                return $this->view('haspatal/dr_dashboard',compact('drdata'));
                                            }
                                            else
                                            {
                                                $this->session->set_flashdata('errors','Please Check your Internet');
                                                return redirect('/taskoard');
                                            }
   
                        }
                        
                           
                            public function LabDashboard()
                        {
                         

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/Haspatal360ServiceCount',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('status' => '1','business_type' => '12'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6InNKd3lyM21TVytDeGtBTUhqNzQyTGc9PSIsInZhbHVlIjoiR1wvTURTZzc5d2c3blZoWmdzM1FPQTdmMFBHYmd5XC9DOTFxOVRvN01kdXBlemFhaFp3bDV3NnZoemVRWmE1S2ZSIiwibWFjIjoiMjVjM2U1YWEzYWJhZTk5MzA4YjNmMjY2ODUyYTVhYmJhNzBlNTg5ZTNiMzVkZGFlMmYwOTVmMjA3OGI3MzU0NiJ9; haspatal_session=eyJpdiI6ImxVRXRLUktmXC9uVlR5bzlzblp4N3hnPT0iLCJ2YWx1ZSI6ImtlRHRFa0cyS05lbmt2TW5sMk15RlB4d3ZVSlFrSVM2WmowaU5PUHpRTDJGazZKelA4RENHcDhCemxMaFRVRFgiLCJtYWMiOiI1NGRlNzczODJlMmMyYmM0N2VjYmUxNWYxYTM2NmIzZGQ2ZGRiYWFmZTRhZTA5N2YwZTNlNGE4MDBjZjY1MGYyIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;                 
if(!empty($response))
                                            {
                                                 $data=json_decode($response);
                                                 $drdata['today']=$data->today;
                                                 $drdata['month']=$data->month;
                                                 $drdata['week']=$data->week;
                                                 $drdata['yesterday']=$data->yesterday;
                                                $drdata['fortnight']=$data->fortnight;
                                                 $drdata['year']=$data->year;
                                                 $drdata['total']=$data->total;
                                                 $drdata['heading']='Lab ';
                                                 $drdata['link']='1/12';
                                                 $drdata['st']=1;
                                                 $drdata['btype']=12;
                                                return $this->view('haspatal/dr_dashboard',compact('drdata'));
                                            }
                                            else
                                            {
                                                $this->session->set_flashdata('errors','Please Check your Internet');
                                                return redirect('/taskoard');
                                            }
   
                        }
                        
                            public function ImagingsCentre()
                        {
                         

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/Haspatal360ServiceCount',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('status' => '1','business_type' => '13'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6InNKd3lyM21TVytDeGtBTUhqNzQyTGc9PSIsInZhbHVlIjoiR1wvTURTZzc5d2c3blZoWmdzM1FPQTdmMFBHYmd5XC9DOTFxOVRvN01kdXBlemFhaFp3bDV3NnZoemVRWmE1S2ZSIiwibWFjIjoiMjVjM2U1YWEzYWJhZTk5MzA4YjNmMjY2ODUyYTVhYmJhNzBlNTg5ZTNiMzVkZGFlMmYwOTVmMjA3OGI3MzU0NiJ9; haspatal_session=eyJpdiI6ImxVRXRLUktmXC9uVlR5bzlzblp4N3hnPT0iLCJ2YWx1ZSI6ImtlRHRFa0cyS05lbmt2TW5sMk15RlB4d3ZVSlFrSVM2WmowaU5PUHpRTDJGazZKelA4RENHcDhCemxMaFRVRFgiLCJtYWMiOiI1NGRlNzczODJlMmMyYmM0N2VjYmUxNWYxYTM2NmIzZGQ2ZGRiYWFmZTRhZTA5N2YwZTNlNGE4MDBjZjY1MGYyIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;                 
if(!empty($response))
                                            {
                                                 $data=json_decode($response);
                                                 $drdata['today']=$data->today;
                                                 $drdata['month']=$data->month;
                                                 $drdata['week']=$data->week;
                                                 $drdata['yesterday']=$data->yesterday;
                                                $drdata['fortnight']=$data->fortnight;
                                                 $drdata['year']=$data->year;
                                                 $drdata['total']=$data->total;
                                                 $drdata['heading']='Imagings centre ';
                                                 $drdata['link']='1/13';
                                                 $drdata['st']=1;
                                                 $drdata['btype']=13;
                                                return $this->view('haspatal/dr_dashboard',compact('drdata'));
                                            }
                                            else
                                            {
                                                $this->session->set_flashdata('errors','Please Check your Internet');
                                                return redirect('/taskoard');
                                            }
   
                        }
                        
                        
                            public function CounsellingDashboard()
                        {
                         

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/Haspatal360ServiceCount',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('status' => '1','business_type' => '17'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6InNKd3lyM21TVytDeGtBTUhqNzQyTGc9PSIsInZhbHVlIjoiR1wvTURTZzc5d2c3blZoWmdzM1FPQTdmMFBHYmd5XC9DOTFxOVRvN01kdXBlemFhaFp3bDV3NnZoemVRWmE1S2ZSIiwibWFjIjoiMjVjM2U1YWEzYWJhZTk5MzA4YjNmMjY2ODUyYTVhYmJhNzBlNTg5ZTNiMzVkZGFlMmYwOTVmMjA3OGI3MzU0NiJ9; haspatal_session=eyJpdiI6ImxVRXRLUktmXC9uVlR5bzlzblp4N3hnPT0iLCJ2YWx1ZSI6ImtlRHRFa0cyS05lbmt2TW5sMk15RlB4d3ZVSlFrSVM2WmowaU5PUHpRTDJGazZKelA4RENHcDhCemxMaFRVRFgiLCJtYWMiOiI1NGRlNzczODJlMmMyYmM0N2VjYmUxNWYxYTM2NmIzZGQ2ZGRiYWFmZTRhZTA5N2YwZTNlNGE4MDBjZjY1MGYyIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;                 
if(!empty($response))
                                            {
                                                 $data=json_decode($response);
                                                 $drdata['today']=$data->today;
                                                 $drdata['month']=$data->month;
                                                 $drdata['week']=$data->week;
                                                 $drdata['yesterday']=$data->yesterday;
                                                $drdata['fortnight']=$data->fortnight;
                                                 $drdata['year']=$data->year;
                                                 $drdata['total']=$data->total;
                                                 $drdata['heading']='Counselling ';
                                                 $drdata['link']='1/17';
                                                 $drdata['st']=1;
                                                 $drdata['btype']=17;
                                                return $this->view('haspatal/dr_dashboard',compact('drdata'));
                                            }
                                            else
                                            {
                                                $this->session->set_flashdata('errors','Please Check your Internet');
                                                return redirect('/taskoard');
                                            }
   
                        }
                        
                            public function HomecareDashboard()
                        {
                         

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/Haspatal360ServiceCount',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('status' => '1','business_type' => '14'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6InNKd3lyM21TVytDeGtBTUhqNzQyTGc9PSIsInZhbHVlIjoiR1wvTURTZzc5d2c3blZoWmdzM1FPQTdmMFBHYmd5XC9DOTFxOVRvN01kdXBlemFhaFp3bDV3NnZoemVRWmE1S2ZSIiwibWFjIjoiMjVjM2U1YWEzYWJhZTk5MzA4YjNmMjY2ODUyYTVhYmJhNzBlNTg5ZTNiMzVkZGFlMmYwOTVmMjA3OGI3MzU0NiJ9; haspatal_session=eyJpdiI6ImxVRXRLUktmXC9uVlR5bzlzblp4N3hnPT0iLCJ2YWx1ZSI6ImtlRHRFa0cyS05lbmt2TW5sMk15RlB4d3ZVSlFrSVM2WmowaU5PUHpRTDJGazZKelA4RENHcDhCemxMaFRVRFgiLCJtYWMiOiI1NGRlNzczODJlMmMyYmM0N2VjYmUxNWYxYTM2NmIzZGQ2ZGRiYWFmZTRhZTA5N2YwZTNlNGE4MDBjZjY1MGYyIn0%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;                 
if(!empty($response))
                                            {
                                                 $data=json_decode($response);
                                                 $drdata['today']=$data->today;
                                                 $drdata['month']=$data->month;
                                                 $drdata['week']=$data->week;
                                                 $drdata['yesterday']=$data->yesterday;
                                                $drdata['fortnight']=$data->fortnight;
                                                 $drdata['year']=$data->year;
                                                 $drdata['total']=$data->total;
                                                 $drdata['heading']='Homecare ';
                                                 $drdata['link']='1/14';
                                                 $drdata['st']=1;
                                                 $drdata['btype']=14;
                                                return $this->view('haspatal/dr_dashboard',compact('drdata'));
                                            }
                                            else
                                            {
                                                $this->session->set_flashdata('errors','Please Check your Internet');
                                                return redirect('/taskoard');
                                            }
   
                        }
                        
                         public function service_list($filterby=null,$status=null,$b_type=null)
	                            {
                                                
                                                switch($b_type)
                                                {
                                                    case 11:
                                                        $btype='Pharmacy';
                                                        break;
                                                        case 12:
                                                        $btype='Lab';
                                                        break;
                                                        case 13:
                                                        $btype='Imaging Center';
                                                        break;
                                                        case 16:
                                                        $btype='Therapy Center';
                                                        break;
                                                        case 17:
                                                        $btype='Counselling Center';
                                                        break;
                                                        case 14:
                                                        $btype='Homecare';
                                                        break;
                                                }
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                $url='';
	                                        
	                                             switch($filterby)
                                        {
                                            
                                            case 'todaylist':
                                                echo"Today  List".$status;
                                                $url='Today';
                                                                            break;
                                            
                                            case 'yesterdaylist':
                                                echo"Yesterday  List".$status;
                                                $url='Yesterday';
                                                break;
                                                
                                                case 'fortnightlist':
                                                echo"Fortnight  List".$status;
                                                $url='Fortnight';
                                                break;
                                            
                                            case 'monthlist':
                                                echo"Month  List".$status;
                                                $url='Month';
                                                break;
                                                case 'weeklist':
                                                echo"Week  List".$status;
                                                $url='Week';
                                                break;
                                            
                                            case 'yearlist':
                                                echo"Year  List".$status;
                                                  $url='Year';
                            


                                                break;
                                                default:
                                                    echo"Default".$status;
                                                
                                        }
	                                        
	                                     
                    



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/businessListToKizaku'.$url.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('status' =>$status,'business_type' =>$b_type),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;



$data=json_decode($response);
                    if(!empty($response))
                    {
                        $responseData=$data->data;
                        $heading=$url;
                        return $this->view('haspatal/businessList',compact('responseData','heading','btype'));
                    }
	                               
	                            }
	                            
	                           
                        
}