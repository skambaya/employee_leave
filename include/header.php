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
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- MetisMenu CSS -->

        <!-- Timeline CSS -->
        <link href="css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->

        <!-- Morris Charts CSS -->
        <link href="css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index">Employee Leave System</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown navbar-inverse">
                    <?php
                        if($_SESSION['type'] == "admin"){
                    ?>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i><span class="label label-danger">
                                <?php
                                    include('include/config.php');
                                     $search = "SELECT count(*) from leaves WHERE leave_status='Pending' AND isRead='0'";
                                     $run_query = mysqli_query($con, $search);
                                     $row = mysqli_fetch_array($run_query);
                                     echo $row[0];
                                ?>
                                                   
                            </span> <b class="caret"></b>
                        </a>
                        <?php }elseif ($_SESSION['type'] == "User") {
                            ?>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i><span class="label label-danger">
                                <?php
                                    include('include/config.php');
                                     $search = "SELECT count(*) from leaves WHERE leave_status !='Pending' AND isRead='1' AND employee_ID = '$_SESSION[employee_ID]'";
                                     $run_query = mysqli_query($con, $search);
                                     $row = mysqli_fetch_array($run_query);
                                     echo $row[0];
                                ?>
                                                   
                            </span> <b class="caret"></b>
                        </a>
                        <?php }
                         ?>
                        <ul class="dropdown-menu dropdown-alerts">
                            <?php
                        if($_SESSION['type'] == "admin"){
                            ?>
                        <li>
                                <a class="text-center" href="#">
                                    <strong>Leaves Request</strong>
                                </a>
                            </li>
                            <?php
                                    include('include/config.php');
                                    $search = "SELECT * from leaves JOIN employee ON leaves.employee_ID=employee.employee_ID WHERE leave_status='Pending' AND isRead='0'";
                                     $run_query = mysqli_query($con, $search);
                                     while($row = mysqli_fetch_array($run_query)){
                                         ?>
                                        <li>
                                        <a href="leave_details?leaveID=<?php echo $row['leave_ID']?>">
                                            <div>
                                                <i class="fa fa-bell fa-fw text-warning"> </i> <?php echo $row['employee_fname']." ". $row['employee_lname']; ?>
                                                <br>
                                                <span class="text-muted small"> applied for leave at <?php echo $row['date_of_application'] ?></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                            
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="pending_leaves">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                            <?php }elseif($_SESSION['type'] == "User") {
                                ?>
                                 <li>
                                <a class="text-center" href="#">
                                    <strong>Notifications</strong>
                                </a>
                            </li>
                            <?php
                                    include('include/config.php');
                                    $search = "SELECT * from leaves JOIN employee ON leaves.employee_ID=employee.employee_ID WHERE leaves.leave_status !='Pending' AND leaves.isRead='1' AND leaves.employee_ID = '$_SESSION[employee_ID]'";
                                     $run_query = mysqli_query($con, $search);
                                     while($row = mysqli_fetch_array($run_query)){
                                         ?>
                                        <li>
                                        <a>
                                            <div>
                                                <form action="controller/clear_notification?leaveID=<?php echo $row['leave_ID']?>" method="post">
                                                    <button type="submit" name="update" >
                                                        <i class="fa fa-bell fa-fw text-warning"> </i> <?php echo $row['leave_status']; ?>
                                                        <br>
                                                        <span class="text-muted small"> application reviewed at <?php echo $row['remark_date'] ?></span>
                                                    </button>
                                            </form>
                                            </div>
                                        </a>
                                    </li>
                                    <?php } ?>
                            
                            <li class="divider"></li>
                            <!-- <li>
                                <a class="text-center" href="pending_leaves">
                                    <strong>See All Notifications</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li> -->
                               
                           <?php }

                             ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <!-- <i class="fa fa-user fa-fw"></i> -->
                            <?php
                                include ('include/config.php');
                                $query = "SELECT * FROM user INNER JOIN employee on user.employee_ID = employee.employee_ID WHERE employee.email = '$_SESSION[email]'";
                                $run_query = mysqli_query($con, $query);
                                $row = mysqli_fetch_array($run_query);
                            ?>
                            <img  height="22px" width="50px" src="employee_image/<?php echo $row['file']; ?>">
                            <?php echo $_SESSION["email"]; ?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="profile"><i class="fa fa-user fa-fw"></i> My Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="logout"><i class="fa fa-sign-out fa-fw"></i>Sign out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="index" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <?php
                                if($_SESSION['type'] == "admin"){
                            ?>
                            <li>
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Department<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="add_department">Add Department</a>
                                    </li>
                                    <li>
                                        <a href="manage_department">Manage Department</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-random fa-fw"></i> Leave Type<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="add_leave">Add Leave Type</a>
                                    </li>
                                    <li>
                                        <a href="manage_leave">Manage Leave Type</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                                <?php } ?>
                            <li>
                            <?php
                                if($_SESSION['type'] == "User"){
                            ?>
                                <a href="#"><i class="fa fa-level-down fa-fw"></i> Leave<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="apply_leave">Apply leave</a>
                                    </li>
                                    <li>
                                        <a href="leave_history">Leave history</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <?php } ?>
                            <?php
                                if($_SESSION['type'] == "admin"){
                            ?>
                            <li>
                                <a href="#"><i class="fa fa-users fa-fw"></i> Employee<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="add_employee">Add Employee</a>
                                    </li>
                                    <li>
                                        <a href="manage_employee">Manage Employee</a>
                                    </li>
                                    </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-th fa-fw"></i> Leave Management<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                        
                                    <li>
                                        <a href="all_leaves">All Leaves</a>
                                    </li>
                                    <li>
                                        <a href="pending_leaves">Pending Leaves</a>
                                    </li>
                                    <li>
                                        <a href="approved_leaves">Approved Leaves</a>
                                    </li>
                                    <li>
                                        <a href="notapproved_leaves">Not Approved Leaves</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="report" target="_blank"><i class="fa fa-clipboard fa-fw"></i> Report</a>
                            </li>
                                <?php } ?>
                            <li>
                                <a href="profile"><i class="fa fa-user fa-fw"></i> My profile</a>
                            </li>
                            <li>
                                <a href="change_password"><i class="fa fa-expeditedssl fa-fw"></i> Change password</a>
                            </li>
                            <li>
                                <a href="logout"><i class="fa fa-sign-out fa-fw"></i> Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>