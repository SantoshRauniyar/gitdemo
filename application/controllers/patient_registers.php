<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');
class patient_registers extends Template
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
	
	                    
	                     function countPatients()
                {
                    if($this->input->post('start_date'))
                    {
                        
                       $inputdata= array(
                           
                        
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
  CURLOPT_URL => 'http://13.59.46.134/api/patient_filter',
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
                        return print_r(json_encode(['status'=>false,'message'=>'Please check Start Date']));
                    }
                }

	            
	
	
	        public function view_patient($id)
	        {
	            
	            
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://care.haspatal.com/api/patient_details_to_kizaku',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id' => $id),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRiY2UxYjFjODAwOTY0YjVkMTAxMGQzZmM4YTI5NmFkOThkYWRkMjBiYWY2OGJjMzhhMWZjMGZiOThlNTllZTM5MzA3YWU1ODMzYmY3YmEyIn0.eyJhdWQiOiIxIiwianRpIjoiNGJjZTFiMWM4MDA5NjRiNWQxMDEwZDNmYzhhMjk2YWQ5OGRhZGQyMGJhZjY4YmMzOGExZmMwZmI5OGU1OWVlMzkzMDdhZTU4MzNiZjdiYTIiLCJpYXQiOjE2MTM2MzYzMzQsIm5iZiI6MTYxMzYzNjMzNCwiZXhwIjoxNjQ1MTcyMzM0LCJzdWIiOiIyMzUiLCJzY29wZXMiOltdfQ.TXQAemLc1dGZLQIxF5qEIqFduMK60FSzSKTKfznezwxQKHiKD3yvPRNbPFjv_WHQyfnRxkRMb1Eko-UVsD6Kdxp7S6bu8Uv5dJjAPQ-kUWyA6-gk_S0_fyZOWF8LIB9N1hOiiv86XSQQiKrmrNtuXbKZTNm_3g7phC0yBf38J6_Oo5o-pdJSrD5nTFDwb_1s5VUwX6UbfKv_qtaGvUhkCGBRTl4KAWPDjgclpfxah6O4OELUwPOoAP4i8KYi1Glj1hBcFN6sq8IlJYYV0pVkonJsZrrxDacKHzQEvSWioj8HYMZbMrxohgiMEa7gXtvCJ64BEJ_dCQ-xyfThOcquRjYkzoeMm6FdVWraOWxa1bW2k4H2KmP0fb5BDhsrtHohzfWN80cNyTbo8BWf0wOyLj4MdoL_Frr6hRYewM_oNT-EJGK-X0LiQ_3S0NNS1lDmL4PMLqtG09gEpFOc9dri--G3Yae_D2efIW-IxupDcfOqIyllvCc6NQyAp9VJNoZ0LyLliuEMN-IiLj3y2OiHuJ3N-ch-ceqZBh31_xZRBFI8-n6eE9hSULLigd_qFFFyCEosFS7m7wbDjwg8as-aIrUSC3nNr6OovKQMkiJEqtOhb9xS7qiHdO6rBouiFnVSQfH11ajxNDtYqNkU8xz97z0Rw39OdasGyxO-c4MtNqE'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

                            $res=json_decode($response);
       
       
                    if($res->status)
                    {
                    $data['data']=$res->data;
                    $data['lang']=$res->lang;
                    return $this->view('patients/show',$data);
                    }
                            /* if($res->status)
                             {
                                // echo $res->status;
                                 $data['data']=$res->data;
                                 return view('patients/show',$data);
                             }*/
                              
                    // 
                          
	        }
	        
	        public function patient_status($id,$status)
	        {
	           

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://care.haspatal.com/api/dr_status',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('id' =>$id,'status_type' =>$status),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjRiY2UxYjFjODAwOTY0YjVkMTAxMGQzZmM4YTI5NmFkOThkYWRkMjBiYWY2OGJjMzhhMWZjMGZiOThlNTllZTM5MzA3YWU1ODMzYmY3YmEyIn0.eyJhdWQiOiIxIiwianRpIjoiNGJjZTFiMWM4MDA5NjRiNWQxMDEwZDNmYzhhMjk2YWQ5OGRhZGQyMGJhZjY4YmMzOGExZmMwZmI5OGU1OWVlMzkzMDdhZTU4MzNiZjdiYTIiLCJpYXQiOjE2MTM2MzYzMzQsIm5iZiI6MTYxMzYzNjMzNCwiZXhwIjoxNjQ1MTcyMzM0LCJzdWIiOiIyMzUiLCJzY29wZXMiOltdfQ.TXQAemLc1dGZLQIxF5qEIqFduMK60FSzSKTKfznezwxQKHiKD3yvPRNbPFjv_WHQyfnRxkRMb1Eko-UVsD6Kdxp7S6bu8Uv5dJjAPQ-kUWyA6-gk_S0_fyZOWF8LIB9N1hOiiv86XSQQiKrmrNtuXbKZTNm_3g7phC0yBf38J6_Oo5o-pdJSrD5nTFDwb_1s5VUwX6UbfKv_qtaGvUhkCGBRTl4KAWPDjgclpfxah6O4OELUwPOoAP4i8KYi1Glj1hBcFN6sq8IlJYYV0pVkonJsZrrxDacKHzQEvSWioj8HYMZbMrxohgiMEa7gXtvCJ64BEJ_dCQ-xyfThOcquRjYkzoeMm6FdVWraOWxa1bW2k4H2KmP0fb5BDhsrtHohzfWN80cNyTbo8BWf0wOyLj4MdoL_Frr6hRYewM_oNT-EJGK-X0LiQ_3S0NNS1lDmL4PMLqtG09gEpFOc9dri--G3Yae_D2efIW-IxupDcfOqIyllvCc6NQyAp9VJNoZ0LyLliuEMN-IiLj3y2OiHuJ3N-ch-ceqZBh31_xZRBFI8-n6eE9hSULLigd_qFFFyCEosFS7m7wbDjwg8as-aIrUSC3nNr6OovKQMkiJEqtOhb9xS7qiHdO6rBouiFnVSQfH11ajxNDtYqNkU8xz97z0Rw39OdasGyxO-c4MtNqE'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$data=json_decode($response);
if($data->status)
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
                                $email=$data->data->email;
                                
                                $fullname=$data->data->first_name.' '.$data->data->last_name;
                                
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
                                
                            
    return redirect('patient_registers/view_patient/'.$id);
}
else
{
    return redirect('patient_registers/view_patient/'.$id);
}
	        }
	        
	                public function dashboard()
	                {
	                    
	           

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/totalpatients',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IjZ1NTl6N0pBTWJvekNEUmZ4RmhIRnc9PSIsInZhbHVlIjoieSs5TGk0THE2aGRJNFJZWkNkdWl0R3BtK09XME5wNDBZS3hFSGJtUEc0TUk1Y1JEZVRxbmZBc2FXcHdkSXRBMCIsIm1hYyI6IjZiNWE4NDZmNjY0NDg2ZDE2YjYwNjc2OWNhM2M1ZjI1OTg2NGNiOWZhNWJhYjIzNmIzNTRlNTc3OWQxZTE5NzIifQ%3D%3D; haspatal_session=eyJpdiI6InRrMFRjRjJaNCtCMlNlUk1tRlh6dnc9PSIsInZhbHVlIjoibzFMUDNPN0hMVkk0N3BDbG9oZEw1TzVYYVhOc0YwUE9oMllBZTV1K0cxbHNLUlBDQU16bFpkZ0xDTGlMQkhJRiIsIm1hYyI6ImM4OGQxYjdmOTFiOTI2N2FlNGU2MWQzY2I2Yzc2MzJkOGI2YWQzNmViZWY4NjU5Y2E0YmI0YzBmNjMwMzhiNzEifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
//exit();


                                            if(!empty($response))
                                            {
                                                 $data=json_decode($response);
                                                 $ptdata['today']=$data->today;
                                                 $ptdata['month']=$data->month;
                                                 $ptdata['week']=$data->week;
                                                 $ptdata['yesterday']=$data->yesterday;
                                                $ptdata['fortnight']=$data->fortnight;
                                                 $ptdata['year']=$data->year;
                                                 $ptdata['total']=$data->total;
                                                 $ptdata['heading']='Approved';
                                                 $ptdata['link']='0';
                                                return $this->view('patients/dr_dashboard',compact('ptdata'));
                                            }
                                            else
                                            {
                                                $this->session->set_flashdata('errors','Please Check your Internet');
                                                return redirect('/taskoard');
                                            }
                                

	                }
	                
	                
	                //pending patients
	                
	                 public function dashboard_pending()
	                {
	                    
	           

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/totalPendingpatients',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IjZ1NTl6N0pBTWJvekNEUmZ4RmhIRnc9PSIsInZhbHVlIjoieSs5TGk0THE2aGRJNFJZWkNkdWl0R3BtK09XME5wNDBZS3hFSGJtUEc0TUk1Y1JEZVRxbmZBc2FXcHdkSXRBMCIsIm1hYyI6IjZiNWE4NDZmNjY0NDg2ZDE2YjYwNjc2OWNhM2M1ZjI1OTg2NGNiOWZhNWJhYjIzNmIzNTRlNTc3OWQxZTE5NzIifQ%3D%3D; haspatal_session=eyJpdiI6InRrMFRjRjJaNCtCMlNlUk1tRlh6dnc9PSIsInZhbHVlIjoibzFMUDNPN0hMVkk0N3BDbG9oZEw1TzVYYVhOc0YwUE9oMllBZTV1K0cxbHNLUlBDQU16bFpkZ0xDTGlMQkhJRiIsIm1hYyI6ImM4OGQxYjdmOTFiOTI2N2FlNGU2MWQzY2I2Yzc2MzJkOGI2YWQzNmViZWY4NjU5Y2E0YmI0YzBmNjMwMzhiNzEifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;


                                            if(!empty($response))
                                            {
                                                 $data=json_decode($response);
                                                 $ptdata['today']=$data->today;
                                                 $ptdata['month']=$data->month;
                                                 $ptdata['week']=$data->week;
                                                 $ptdata['yesterday']=$data->yesterday;
                                                $ptdata['fortnight']=$data->fortnight;
                                                 $ptdata['year']=$data->year;
                                                 $ptdata['total']=$data->total;
                                                 $ptdata['heading']='Pending';
                                                 $ptdata['link']='1';
                                                return $this->view('patients/dr_dashboard',compact('ptdata'));
                                            }
                                            else
                                            {
                                                $this->session->set_flashdata('errors','Please Check your Internet');
                                                return redirect('/taskoard');
                                            }
                                

	                }
	           
	           //     total rejected
	           
	               public function dashboard_rejected()
	                {
	                    
	           

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/totalRejectedpatients',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM',
    'Cookie: XSRF-TOKEN=eyJpdiI6IjZ1NTl6N0pBTWJvekNEUmZ4RmhIRnc9PSIsInZhbHVlIjoieSs5TGk0THE2aGRJNFJZWkNkdWl0R3BtK09XME5wNDBZS3hFSGJtUEc0TUk1Y1JEZVRxbmZBc2FXcHdkSXRBMCIsIm1hYyI6IjZiNWE4NDZmNjY0NDg2ZDE2YjYwNjc2OWNhM2M1ZjI1OTg2NGNiOWZhNWJhYjIzNmIzNTRlNTc3OWQxZTE5NzIifQ%3D%3D; haspatal_session=eyJpdiI6InRrMFRjRjJaNCtCMlNlUk1tRlh6dnc9PSIsInZhbHVlIjoibzFMUDNPN0hMVkk0N3BDbG9oZEw1TzVYYVhOc0YwUE9oMllBZTV1K0cxbHNLUlBDQU16bFpkZ0xDTGlMQkhJRiIsIm1hYyI6ImM4OGQxYjdmOTFiOTI2N2FlNGU2MWQzY2I2Yzc2MzJkOGI2YWQzNmViZWY4NjU5Y2E0YmI0YzBmNjMwMzhiNzEifQ%3D%3D'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;


                                            if(!empty($response))
                                            {
                                                 $data=json_decode($response);
                                                 $ptdata['today']=$data->today;
                                                 $ptdata['month']=$data->month;
                                                 $ptdata['week']=$data->week;
                                                 $ptdata['yesterday']=$data->yesterday;
                                                $ptdata['fortnight']=$data->fortnight;
                                                 $ptdata['year']=$data->year;
                                                 $ptdata['total']=$data->total;
                                                 $ptdata['heading']='Rejected';
                                                 $ptdata['link']='3';
                                                return $this->view('patients/dr_dashboard',compact('ptdata'));
                                            }
                                            else
                                            {
                                                $this->session->set_flashdata('errors','Please Check your Internet');
                                                return redirect('/taskoard');
                                            }
                                

	                }
	           
	           
	           
	                //total registration
	                
	                public function dashboard_registration()
	                {
	                    
	   

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://13.59.46.134/api/totalpatients',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('status' => '1'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM5ZDhjOTNjODIwOTExYTg5YzJkNjFjYjdkNjg5YmJkNzEyYzYzNDQ5NDFhNTU0YTkxY2RmZWJjM2EwZjhjMTg4ZmQxZTk0ZDAyNGUyMTRmIn0.eyJhdWQiOiIxIiwianRpIjoiYzlkOGM5M2M4MjA5MTFhODljMmQ2MWNiN2Q2ODliYmQ3MTJjNjM0NDk0MWE1NTRhOTFjZGZlYmMzYTBmOGMxODhmZDFlOTRkMDI0ZTIxNGYiLCJpYXQiOjE2Mjc3MzI5MTYsIm5iZiI6MTYyNzczMjkxNiwiZXhwIjoxNjU5MjY4OTE2LCJzdWIiOiI3MTgiLCJzY29wZXMiOltdfQ.K9SG6rKW_koTLH43nV6iT1ZRR0WTFwW6V2o7AUuZtQEnDI8QadqNQw3qahIyrcdUDOd9UFb30D2n0pRBS7jHhC5lIPNVq2hSxfbizXO0Wm9R2TH5xR0gIN1SPyp7EYcwS2iKSY3RdWbCa82EDOL9aw7yqZEmxhYgsk7arqYhPp7SqTpKfrFTk_ld4uxVHnB7Uifc4jZy9ZoOvLvOnYSfd3_wC6BZ8Q115Dw0q5PahBfYRFG03f0buohrJ88JM2KHEBIEEM0wzXp5ggEgDYYJhibYtQfF5ZkaaGQqNv14Q2yK3NUiDw-CP-jFER0jPiHNt0VB8o8jVgzXuN19ycS-TeunM1PyI_HrqZIzn7V7vMw3CCoU-gKY5hsk1qXM__HtsLIO7EHsE9NYHdBum62NiHCPLCkzdAV43N6q7SMP3r_UhvJ9mBncjWfqFkGmrO_R2EyCWgZFpDc8jcUbtUDucwaXRuKWXyi5zlDa7o3xUHFIsVIkf81HJG-JVpGf8j36SZUy3N89EPvNk7otSG7M5TGQu6b7FM5ymo3H09X7xOH613bQ0-jpOgwqwOUZyeLO4AWt892Ex3GcPb0MVmnwWV7F7-9NUpVDrL2mIb-y8PSK9DzLnP1PuKeDTqDcTQqnOfHIT8yuDgujuRbEGehj61zv8TmlEp3h5BI35YY-5OM'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;



                                            if(!empty($response))
                                            {
                                                 $data=json_decode($response);
                                                 $ptdata['today']=$data->today;
                                                 $ptdata['month']=$data->month;
                                                 $ptdata['week']=$data->week;
                                                 $ptdata['yesterday']=$data->yesterday;
                                                $ptdata['fortnight']=$data->fortnight;
                                                 $ptdata['year']=$data->year;
                                                 $ptdata['total']=$data->total;
                                                 $ptdata['heading']='Registration';
                                                 $ptdata['link']='';
                                                return $this->view('patients/dr_dashboard',compact('ptdata'));
                                            }
                                            else
                                            {
                                                $this->session->set_flashdata('errors','Please Check your Internet');
                                                return redirect('/taskoard');
                                            }
                                

	                }
	                
	                            /****
	                             * @param status boolean
	                             * @param filterby play with day and dates
	                             ****/
	                            public function patient_list($filterby=null,$status=null)
	                            {
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
  CURLOPT_URL => 'http://13.59.46.134/api/patientListToKizaku'.$url.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('status' => $status),
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
                        return $this->view('patients/dlist',compact('responseData','heading'));
                    }
	                               
	                            }
	                            
	                            
	                            
	                            
	                            
	        
}
?>