<?php 
include "../include/config.php";
    if(isset($_POST['update'])){
        $employee_ID = $_POST['employee_ID'];
        $name = $_FILES['file']['name'];  
        $temp_name = $_FILES['file']['tmp_name'];  
        if(isset($name) and !empty($name)){
            $location = '../assets/employee_image/';      
            if(move_uploaded_file($temp_name, $location.$name)){
                $update = "UPDATE employee SET file = '$name' WHERE employee_ID = '$employee_ID'";
                $run = mysqli_query($con, $update);
                if($run){
                    header("Location: ../profile");
                }else{
                    $simple_string = "Not uploaded";
                    header("Location: ../profile?error=$simple_string");
                }
            }
        } else {
                    $simple_string = "You should select a file to upload !!";
                    header("Location: ../profile?empty=$simple_string");
        }
    }
?>

