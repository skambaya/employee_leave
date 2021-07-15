<?php
    session_start();
    include "../include/config.php";
    if($_SESSION['token']==$_POST['token']){
        if(isset($_POST['submit'])){
            $name = $_FILES['file']['name'];  
            $temp_name = $_FILES['file']['tmp_name'];
            $leave_from = mysqli_real_escape_string($con, $_POST['leave_from']);
            $leave_to = mysqli_real_escape_string($con, $_POST['leave_to']);
            $from_place = mysqli_real_escape_string($con, $_POST['from_place']);
            $to_place = mysqli_real_escape_string($con, $_POST['to_place']);
            $leave_description  = mysqli_real_escape_string($con, $_POST['leave_description']);
            $type_ID  = mysqli_real_escape_string($con, $_POST['type_ID']);
            $transport_cost  = mysqli_real_escape_string($con, $_POST['transport_cost']);
            $transport_type  = mysqli_real_escape_string($con, $_POST['transport_type']);

            if($type_ID != ""){
            $search ="SELECT * FROM employee JOIN user ON employee.employee_ID=user.employee_ID 
            WHERE email = '$_SESSION[email]'";
            $run_search = mysqli_query($con, $search);
            $row = mysqli_fetch_array($run_search);
            $employee_ID = $row['employee_ID'];
            if($row == TRUE){
                if(isset($name) and !empty($name)){
                    $location = '../employee_image/';      
                    if(move_uploaded_file($temp_name, $location.$name)){
                        $add = "INSERT INTO leaves (leave_from, leave_to, from_place, to_place, leave_description, date_of_application, attachment, type_ID, employee_ID)
                        VALUES ('$leave_from', '$leave_to', '$from_place', '$to_place', '$leave_description', now(), '$name', '$type_ID', '$employee_ID')";
                        $send= mysqli_query($con, $add);           
                        if(!$send)
                        {   // Store a string into the variable which  need to be Encrypted 
                           echo "<script type=\"text/javascript\">
                              alert(\"Failed: Leave not applied.\");
                              window.location = \"../apply_leave\"
                              </script>";   
                        }
                        else {
                            $add2 = "INSERT INTO transport(transport_cost, transport_type, date_of_application)
                             VALUES ('$transport_cost', '$transport_type', now())";
                            $send2 = mysqli_query($con, $add2);
                            if(!$send2){
                                echo "<script type=\"text/javascript\">
                              alert(\"Failed: Leave not applied.\");
                              window.location = \"../apply_leave\"
                              </script>";   
                            }else{
                                
                                $search2 ="SELECT * FROM employee JOIN leave_history JOIN user ON employee.employee_ID=leave_history.employee_ID AND employee.employee_ID=user.employee_ID
                                WHERE email = '$_SESSION[email]'";
                                $run_search2 = mysqli_query($con, $search2);
                                $row2 = mysqli_fetch_array($run_search2);
                                $leave_remained_days = $row2['leave_remained_days'];
                                if($row2 == TRUE){
                                    $diff1 = strtotime($leave_to) - strtotime($leave_from);
                                    $days1 = abs(round($diff1 / 86400));
                                    $remained1 = $leave_remained_days - $days1;
                                    $add3 = "INSERT INTO leave_history(last_leave_date, leave_remained_days, employee_ID) 
                                VALUES('$leave_to', '$remained1', '$employee_ID')";
                                $send3 = mysqli_query($con, $add3);
                                if(!$send3){
                                    echo "<script type=\"text/javascript\">
                              alert(\"Failed: Leave not applied.\");
                              window.location = \"../apply_leave\"
                              </script>";
                                }else{
                                    $simple_string = "Leave applied Successful";
                                    header("Location: ../apply_leave?success=$simple_string");
                                }
                                }else{
                                    $diff = strtotime($leave_to) - strtotime($leave_from);
                                    $days = abs(round($diff / 86400));
                                    $remained = 30 - $days;
               
                                   $add4 = "INSERT INTO leave_history(last_leave_date, leave_remained_days, employee_ID) 
                                   VALUES('$leave_to', '$remained', '$employee_ID')";
                                   $send3 = mysqli_query($con, $add4);
                                   if(!$send3){
                                       echo "<script type=\"text/javascript\">
                                 alert(\"Failed: Leave not applied.\");
                                 window.location = \"../apply_leave\"
                                 </script>";   
                                   }else{
                                       $simple_string = "Leave applied Successful";
                                       header("Location: ../apply_leave?success=$simple_string");
                                   }
                                }
            
            
                                 
                            }
                            
                        }
                     }else{
                    }
                    }
                }
            }else{
                $simple_string = "LEAVE TYPE IS EMPTY!! Please Fill all mandatory fields";
                header("Location: ../apply_leave?fill=$simple_string");

            }

           
    }
}else{
        header('Location: ../apply_leave');
    }
?>