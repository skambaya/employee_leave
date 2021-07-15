<?php
 include "../include/config.php";
    $department_ID = $_GET['delete'];
    $query="DELETE FROM department WHERE department_ID='" . $department_ID . "'";
    $run=mysqli_query($con, $query);
    if($run==TRUE){
        $simple_string = "Department Deleted Successful";
        header("Location: ../manage_department?del=$simple_string");
    }