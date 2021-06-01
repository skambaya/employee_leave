<?php
	include "../include/config.php";
	
	if(ISSET($_POST['update'])){
		$leave_ID = $_POST['leave_ID'];
		$leave_status = $_POST['leave_status'];
		$remark = $_POST['remark'];
		$query = "UPDATE leaves SET leave_status = '$leave_status', remark = '$remark', remark_date = now(), isRead = '1' WHERE leave_ID = '$leave_ID'";
		$run = mysqli_query($con, $query);
		if($run){
			$search = "SELECT remark_date, employee.employee_ID, leaves.leave_status, leaves.isRead, leaves.remark, leaves.leave_description, leaves.attachment, leaves.leave_to, leaves.leave_from, leaves.from_place, leaves.to_place, leaves.date_of_application, employee.employee_fname, employee.phone_number, employee.email, employee.employee_lname, employee.gender from leaves JOIN employee JOIN user on leaves.employee_ID=employee.employee_ID AND user.employee_ID=employee.employee_ID WHERE remark_date IN (SELECT MAX(remark_date) FROM leaves) ORDER BY leave_ID ASC , remark_date DESC";
              $run_query = mysqli_query($con, $search);
              while($row = mysqli_fetch_array($run_query)){
              	$isRead = $row['isRead'];
              	$phone_number = $row['phone_number'];
              	// echo $phone_number;
              	if($leave_status == "Pending"){
              		$api_key='d5cadf9142569b69';
$secret_key = '
Y2IzNzU0YjZkYmY4MDNkNjE5Zjk5MzUxZjRkYzU1NzU2NTljMDVhMjdlZmFiOThkZTUxZTRkMGM1MGU2OTRjMA==';
// The data to send to the API
$postData = array(
    'source_addr' => 'INFO',
    'encoding'=>0,
    'schedule_time' => '',
    'message' => 'Maombi ya likizo, Maombi yako ya likizo yamepokelewa, utapokea majibu ndani ya masaa 24.',
    'recipients' => [array('recipient_id' => '1','dest_addr'=>$phone_number)]
);
//.... Api url
$Url ='https://apisms.bongolive.africa/v1/send';

// Setup cURL
$ch = curl_init($Url);
error_reporting(E_ALL);
ini_set('display_errors', 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

// Send the request
$response = curl_exec($ch);

// Check for errors
if($response === FALSE){
        echo $response;

    die(curl_error($ch));
}
// var_dump($response);
$simple_string = "Action taken and applied Successful";
        header("Location: ../all_leaves?success=$simple_string");
              	}elseif ($leave_status == "Approved") {
              		$api_key='d5cadf9142569b69';
$secret_key = '
Y2IzNzU0YjZkYmY4MDNkNjE5Zjk5MzUxZjRkYzU1NzU2NTljMDVhMjdlZmFiOThkZTUxZTRkMGM1MGU2OTRjMA==';
// The data to send to the API
$postData = array(
    'source_addr' => 'INFO',
    'encoding'=>0,
    'schedule_time' => '',
    'message' => 'Habari, Maombi yako ya likizo yamekubaliwa, uwe na likizo njema.',
    'recipients' => [array('recipient_id' => '1','dest_addr'=>$phone_number)]
);
//.... Api url
$Url ='https://apisms.bongolive.africa/v1/send';

// Setup cURL
$ch = curl_init($Url);
error_reporting(E_ALL);
ini_set('display_errors', 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

// Send the request
$response = curl_exec($ch);

// Check for errors
if($response === FALSE){
        echo $response;

    die(curl_error($ch));
}
// var_dump($response);
$simple_string = "Action taken and applied Successful";
        header("Location: ../all_leaves?success=$simple_string");
              	}elseif ($leave_status == "Not Approved") {
              		$api_key='d5cadf9142569b69';
$secret_key = '
Y2IzNzU0YjZkYmY4MDNkNjE5Zjk5MzUxZjRkYzU1NzU2NTljMDVhMjdlZmFiOThkZTUxZTRkMGM1MGU2OTRjMA==';
// The data to send to the API
$postData = array(
    'source_addr' => 'INFO',
    'encoding'=>0,
    'schedule_time' => '',
    'message' => 'Habari, Tunasikitika kuwa Maombi yako ya likizo hayajafanikiwa.',
    'recipients' => [array('recipient_id' => '1','dest_addr'=>$phone_number)]
);
//.... Api url
$Url ='https://apisms.bongolive.africa/v1/send';

// Setup cURL
$ch = curl_init($Url);
error_reporting(E_ALL);
ini_set('display_errors', 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => json_encode($postData)
));

// Send the request
$response = curl_exec($ch);

// Check for errors
if($response === FALSE){
        echo $response;

    die(curl_error($ch));
}
// var_dump($response);
$simple_string = "Action taken and applied Successful";
        header("Location: ../all_leaves?success=$simple_string");
              	}

              }

		}

		

		
	}
?>