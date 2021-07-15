<?php
    include ('include/tools.php')
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
                    <?php 
                        if(!empty($_GET['on']) OR !empty($_GET['suc'])) {?>
                    
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Enter received CODE from your Phone</h3>
                            <?php 
                            if(!empty($_GET['suc'])){
                                    $show = $_GET['suc'];
                                      $decryption=openssl_decrypt ($show, $ciphering, $decryption_key, $options, $decryption_iv);
                                        echo $decryption;
                                        }
                            ?>
                        </div>
                        <div class="panel-body">
                            <form action="controller/verify_login" method="post" role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="OTP CODE" name="pin" type="text" value="">
                                    </div>
                                     <input type="text" name="token" value="<?=$_SESSION['token'] ?>" hidden>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button class="btn btn-sm btn-success btn-block" type="submit" name="verify">Authenticate</button>
                                    Go Back. <a href="login">Login</a>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
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

    </body>
</html>
