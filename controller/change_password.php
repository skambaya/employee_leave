<?php
    session_start();
    include ('../include/config.php');
    include ('../include/tool.php');
    if($_SESSION['token']==$_POST['token']){
        if(isset($_POST['submit'])){
            $password = password_hash(mysqli_real_escape_string($con, $_POST['password']), PASSWORD_DEFAULT);
            
            //check if old password is correct
            if (count($_POST) > 0) {
            $search ="SELECT * FROM employee JOIN user on employee.employee_ID = user.employee_ID WHERE  employee.email = '".$_SESSION["email"]."'";
            $run_search = mysqli_query($con, $search);
            $row = mysqli_fetch_array($run_search);

            if (password_verify($_POST['old_password'], $row["password"])) {
                    mysqli_query($con, "UPDATE user set password='" . $password . "' WHERE employee_ID='" . $_SESSION["employee_ID"] . "'");
                    $simple_string = "Password Changed Successful";
                    header("Location: ../change_password?success=$simple_string");
            } else {
                $simple_string = "Curtent password is not Correct, Please Try again";
                header("Location: ../change_password?fail=$simple_string");
            }
        
}
        }
        }else{
        header('Location: ../new_pass');
 }
        if(isset($_POST['recover'])){
            $password = password_hash(mysqli_real_escape_string($con, $_POST['password']), PASSWORD_DEFAULT);

            mysqli_query($con, "UPDATE user set password='" . $password . "' WHERE employee_ID='" . $_SESSION["employee_ID"] . "'");
            $message=openssl_encrypt ("Password Changed Successful", $ciphering, $encryption_key, $options, $encryption_iv);
            header("Location: ../index?success=$message");
        }
    
?>