<?php
    session_start();
    include('../include/config.php');
    include ('../include/tools.php');

    $pin = mysqli_real_escape_string($con, $_POST['pin']);
    $catched_pinID = $_SESSION['pinId'];

    if(isset($_POST["verify"])){
        $query = "SELECT * FROM employee JOIN user on employee.employee_ID = user.employee_ID WHERE email = '$_SESSION[email]'";
        $statement = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($statement)){
            $_SESSION['type'] = $row['role'];
            $_SESSION['employee_ID'] = $row['employee_ID'];
            $_SESSION['file'] = $row['file'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['employee_lname'] = $row['employee_lname'];
            $_SESSION['phone_number'] = $row['phone_number'];
            $email = $row['email'];

            //LETS PROCESS SMS TO USER
            $api_key='e4dabbd0e5ea9e73';
            $secret_key = 'ZDIxOGJlZjg5MTRjMzE5MzU3MmIyMDY0MTQ0NzRkOTI5MjNmNmY0OTBkYWYxNjJiNWRjNGUwMzJiMmEyNTdmMw==';
            $postData = array(
                'pinId' => $catched_pinID,
                'pin' => $pin,
            );
            $Url ='https://apiotp.beem.africa/v1/verify';
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
            
            
            $catch_code = $decoded_response['data']['message']['code'];
            $catch_message = $decoded_response['data']['message']['message'];
            $message = "<label class='text-danger'>$catch_message</label>";
            $encrypt_message=openssl_encrypt ($message, $ciphering, $encryption_key, $options, $encryption_iv);
            $encrypt_pinID=openssl_encrypt ($catched_pinID, $ciphering, $encryption_key, $options, $encryption_iv);
            $encrypt_email=openssl_encrypt ($email, $ciphering, $encryption_key, $options, $encryption_iv);

            if($catch_code == 113){                            
                header("Location: ../recover_pass?suc=$encrypt_message&on=$encrypt_pinID");
            }elseif($catch_code == 114){
                header("Location: ../recover_pass?suc=$encrypt_message&on=$encrypt_pinID");
            }elseif($catch_code == 117){
                header("Location: ../new_pass?us=$encrypt_email");
            }
                        
        }
                
    }

?>

