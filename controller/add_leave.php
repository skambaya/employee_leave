<?php
    session_start();
    include "../include/config.php";
    if($_SESSION['token']==$_POST['token']){
        if(isset($_POST['submit'])){
            $type_name = mysqli_real_escape_string($con, $_POST['type_name']);
            $type_category = mysqli_real_escape_string($con, $_POST['type_category']);
            $description = mysqli_real_escape_string($con, $_POST['description']);
            $add = "INSERT INTO leave_type (type_name, type_category, description)
            VALUES ('$type_name', '$type_category', '$description')";
            $send= mysqli_query($con, $add);           
            if(!$send)
            {   // Store a string into the variable which  need to be Encrypted 
               echo "<script type=\"text/javascript\">
                  alert(\"Failed: Department not added.\");
                  window.location = \"../add_leave\"
                  </script>";   
            }
            else {
                $simple_string = "Leave Type added Successful";
                header("Location: ../add_leave?success=$simple_string");
            }
         }
        
        
}else{
        header('Location: ../add_leave');
    }
?>