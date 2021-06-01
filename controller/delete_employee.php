<?php
 include "../include/config.php";
    $employee_ID = $_GET['delete'];
    $query="DELETE FROM employee WHERE employee_ID='" . $employee_ID . "'";
    $run=mysqli_query($con, $query);
    if($run==TRUE){
        $simple_string = "Employee Deleted Successful";
        header("Location: ../manage_employee?del=$simple_string");
    }