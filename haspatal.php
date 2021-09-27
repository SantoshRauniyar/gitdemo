<?php

	
	$con=mysqli_connect('localhost','kizaku29','navneet@2020#','kizaku')or die(mysqli_connect_error());
	//extract($_POST);

		if (isset($_POST['token'])) {
			
			        date_default_timezone_set("Asia/Calcutta");
			        $start=date("Y-m-d H:i:s");
			       //$now = date("Y-m-d H:i:s");
                
                //$end = date("Y-m-d H:i:s", strtotime('+2 hours', $start)); // $now + 3 hours
                //Get the current date and time.
$current = new DateTime();

//The number of hours to add.
$hoursToAdd = 1;

//Add the hours by using the DateTime::add method in
//conjunction with the DateInterval object.
$current->add(new DateInterval("PT{$hoursToAdd}H"));

//Format the new time into a more human-friendly format
//and print it out.
$newTime = $current->format('Y-m-d H:i:s');
echo $newTime;
			            $link=$_POST['token'];
			            $title=$_POST['title'];
			            $uhead=$_POST['assign_to'];
			            $unit=$_POST['unit_id'];
			            $hs_id=$_POST['hs_id'];
		$sql="INSERT  into taskk(hs_id,start_date,end_date,title,program,department,section,unit,assign_uid,link)values('$hs_id','$start','$newTime','$title','17','13','3','$unit','$uhead','$link')";
		if (mysqli_query($con,$sql)) {
			
			        $email='santoshrauniyar20408@gmail.com';
			
			  if($email != '')
			{
				if(filter_var($email,FILTER_VALIDATE_EMAIL))
				{

				

					$emailBody = file_get_contents("http://kizaku.haspatal.com/assets/email/task/task.html");
					$emailBody = str_replace("<@hospital_name@>",$_POST['title'],$emailBody);
					$emailBody = str_replace("<@unit_head@>",'Santosh Rauniyar',$emailBody);
					
					$headers  = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
					$headers .= "From: His Kizaku <his@haspatal.com> \r\n";
					$headers .= 'X-Mailer: PHP/' . phpversion();
					
					if(!mail($email, "Task Management - Task Created for you", $emailBody, $headers))
					{
						echo "email not sent";
						//$this->session->set_flashdata( "errors", "Email Address is wrong.");
					}
					
				
					
					
				}
				else 
				{
					echo"InValid Email";
					//$this->session->set_flashdata( "errors", "Please enter valid email address.");
			
				}
			}
			
			
			$response=['status'=>'200','message'=>'Data Saved Successfully'];
			http_response_code(200);
		}
		else
		{
			$response=['status'=>'false','message'=>'Failed Insertion'];
			die('error'.mysqli_error($con));
					}
					http_response_code(200);
				$data=json_encode($response);
				print_r($data);
		}

?>