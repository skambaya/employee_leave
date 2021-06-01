<?php
    session_start();
    include "../include/config.php";
    if($_SESSION['token']==$_POST['token']){
        if(isset($_POST['submit'])){
            $employee_ID = mysqli_real_escape_string($con, $_POST['employee_ID']);
            $employee_fname = mysqli_real_escape_string($con, $_POST['employee_fname']);
            $employee_lname = mysqli_real_escape_string($con, $_POST['employee_lname']);
            $date_of_birth = mysqli_real_escape_string($con, $_POST['date_of_birth']);
            $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $address = mysqli_real_escape_string($con, $_POST['address']);  
            $gender = mysqli_real_escape_string($con, $_POST['gender']);
            $city = mysqli_real_escape_string($con, $_POST['city']);
            $country = mysqli_real_escape_string($con, $_POST['country']);
            $marital_status = mysqli_real_escape_string($con, $_POST['marital_status']);
            $department_ID = mysqli_real_escape_string($con, $_POST['department_ID']);
            $password = password_hash(mysqli_real_escape_string($con, $_POST['password']), PASSWORD_DEFAULT);
            $confirm_password = password_hash(mysqli_real_escape_string($con, $_POST['confirm_password']), PASSWORD_DEFAULT);
            $name = $_FILES['file']['name'];
            $work_place = mysqli_real_escape_string($con, $_POST['work_place']);
            $position = mysqli_real_escape_string($con, $_POST['position']);
            $role = mysqli_real_escape_string($con, $_POST['role']); 

            $target_dir = "../employee_image/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");

            $search ="SELECT * FROM employee WHERE employee_ID = '$employee_ID' OR email = '$email'";
            $run_search = mysqli_query($con, $search);
            $row = mysqli_fetch_array($run_search);
            if($row == FALSE){

            $add = "INSERT INTO employee (employee_ID, employee_fname, employee_lname, date_of_birth, phone_number, email, address, gender, city, country, marital_status, file, department_ID)
            VALUES ('$employee_ID', '$employee_fname', '$employee_lname', '$date_of_birth', '$phone_number', '$email', '$address', '$gender', '$city', '$country', '$marital_status', '$name', '$department_ID')";
            
            
            $send = mysqli_query($con, $add);
            if( in_array($imageFileType,$extensions_arr) ){
             
                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
           
             }
            if(!$send)
            {   // Store a string into the variable which  need to be Encrypted 
               echo "<script type=\"text/javascript\">
                  alert(\"Failed: Employee not added.\");
                 
                  </script>";   
            }
            else {
                $add2 = "INSERT INTO user (username, password, work_place, position, role, status, employee_ID)VALUES ('$email', '$password', '$work_place', '$position', '$role', 'Active', '$employee_ID')";

                $send2 = $send = mysqli_query($con, $add2); 
                if(!$send2){
                    echo "<script type=\"text/javascript\">
                  alert(\"Failed: Employee not added.\");
                 
                  </script>"; 
              }else{
                $simple_string = "Employee added Successful";
                header("Location: ../add_employee?success=$simple_string");
            }
            }
         }else{
            $simple_string = "Employee ID or Email arleady Exist";
            header("Location: ../add_employee?exist=$simple_string");
         }
        
        
}else{
        header('Location: ../add_employee');
    }
}
?>