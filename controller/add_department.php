<?php
    session_start();
    include "../include/config.php";
    if($_SESSION['token']==$_POST['token']){
        if(isset($_POST['submit'])){
            $department_name = mysqli_real_escape_string($con, $_POST['department_name']);
            $department_short_name = mysqli_real_escape_string($con, $_POST['department_short_name']);
            $HOD = mysqli_real_escape_string($con, $_POST['HOD']);
            $description = mysqli_real_escape_string($con, $_POST['description']);
            $add = "INSERT INTO department (department_name, department_short_name, department_HOD_name, description)
            VALUES ('$department_name', '$department_short_name', '$HOD', '$description')";
            $send= mysqli_query($con, $add);           
            if(!$send)
            {   // Store a string into the variable which  need to be Encrypted 
               echo "<script type=\"text/javascript\">
                  alert(\"Failed: Department not added.\");
                  window.location = \"../add_department\"
                  </script>";   
            }
            else {
                $simple_string = "Department added Successful";
                header("Location: ../add_department?success=$simple_string");
            }
         }
        
        
}else{
        header('Location: ../add_department');
    }
?>