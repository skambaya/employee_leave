<?php
    session_start();
    include('../include/db_connect.php');
    include('../include/tools.php');
   
    if(isset($_POST["login"])){
    	$query = "SELECT * FROM employee JOIN user on employee.employee_ID = user.employee_ID WHERE email = :email";
    	$statement = $connect->prepare($query);
    	$statement->execute(
    		array(
    				'email'	=>	$_POST["email"]
    			)
    	);
    	$count = $statement->rowCount();
    	if($count > 0){
    		$result = $statement->fetchAll();
    		foreach($result as $row){
    			if($row['status'] == 'Active'){
                        $_SESSION['type'] = $row['role'];
                        $_SESSION['employee_ID'] = $row['employee_ID'];
                        $_SESSION['file'] = $row['file'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['employee_lname'] = $row['employee_lname'];
                        $_SESSION['phone_number'] = $row['phone_number'];

                            //LETS PROCESS SMS TO USER
                            $api_key='e4dabbd0e5ea9e73';
                            $secret_key = 'ZDIxOGJlZjg5MTRjMzE5MzU3MmIyMDY0MTQ0NzRkOTI5MjNmNmY0OTBkYWYxNjJiNWRjNGUwMzJiMmEyNTdmMw==';
                            $phone = $row['phone_number'];

                            // The data to send to the API
                            $postData = array(
                                'appId' => '162',
                                'msisdn' => $phone,
                            );

                            $Url ='https://apiotp.beem.africa/v1/request';

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
                            var_dump($response); 
                            $decoded_response =json_decode($response, true);
                            $catch_pinID = $decoded_response['data']['pinId'];
                            $catch_message = $decoded_response['data']['message'];
                             $_SESSION['pinId'] = $catch_pinID;

                            // $simple_string = "Ingiza password ulizopokea";
                            $encrypt_message=openssl_encrypt ($catch_pinID, $ciphering, $encryption_key, $options, $encryption_iv);
                            header("Location: ../recover_pass?on=$encrypt_message");
                            // header("location:../index");
                        
    				
    			}
    			else{
                    $message = "<label class='text-danger'>Sorry, Your account is disabled, Contact Systeam Administrator!!</label>";
                    $encrypt_message=openssl_encrypt ($message, $ciphering, $encryption_key, $options, $encryption_iv);
                    header("Location: ../forgot_password?error=$encrypt_message");
    			}
    		}
    	}
    	else
    	{
            $message = "<label class='text-danger'>Wrong Password!!</label>";
            $encrypt_message=openssl_encrypt ($message, $ciphering, $encryption_key, $options, $encryption_iv);
            header("Location: ../forgot_password?error=$encrypt_message");
    	}
    }

?>