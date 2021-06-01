<?php
 include "../include/config.php";
    $leave_type_ID = $_GET['delete'];
    $query="DELETE FROM leave_type WHERE type_ID='" . $leave_type_ID . "'";
    $run=mysqli_query($con, $query);
    if($run==TRUE){
        $simple_string = "Leave Type Deleted Successful";
        header("Location: ../manage_leave?del=$simple_string"); 
    }