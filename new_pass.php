<?php
    include ('include/tools.php');
    if (empty($_SESSION['token'])) { 
    $length = 32;
    $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length); 
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Employee Leave Management System</title>

        <!-- Bootstrap Core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="assets/css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="assets/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Enter new Password</h3>
                                <?php
                                    if(!empty($_GET['error'])){
                                        $decryption=openssl_decrypt ($_GET['error'], $ciphering, $decryption_key, $options, $decryption_iv);
                                        echo $decryption;
                                    }
                                ?>
                        </div>
                        <div class="panel-body">
                            <form action="controller/change_password.php" method="post" role="form">
                                <fieldset>
                                    <div class="form-group">
                                         <input type="password" id="password" name="password" class="form-control" placeholder="New Password" required>
                                    </div>
                                    <div class="form-group">
                                         <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                                    </div>
<!--                                     <input type="text" name="token" value="<?=$_SESSION['token'] ?>" hidden>
 -->                                    <button class="btn btn-sm btn-success btn-block" type="submit" name="recover">Next</button>
                                    Go Back. <a href="login">Login</a>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="assets/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="assets/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="assets/js/startmin.js"></script>

        <script>
                var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");
                function validatePassword(){
                    if(password.value != confirm_password.value) {
                        confirm_password.setCustomValidity("Passwords Don't Match");
                        } else {
                            confirm_password.setCustomValidity('');
                        }
                }
                
                password.onchange = validatePassword;
                confirm_password.onkeyup = validatePassword;
                
            </script>

    </body>
</html>
