<?php
    session_start();
    include('include/db_connect.php');
    include('include/tools.php'); 
    if(!isset($_SESSION["type"]))
    {
        // if($_SESSION["type"] == 'admin'){
            header("location:login");
        // }
    } 

    include('include/header.php'); 
?>
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="page-header">Dashboard:
                            <?php
                                    echo "" . date("l");
                                    echo ", " . date("Y-m-d") . "";
                                    
                                    ?>
                            </h4>
                        </div>
                        <!-- /.col-lg-12 -->
                        <?php
                        if($_SESSION["type"] == 'admin'){
                                include ('include/config.php');
                                $query = "SELECT * FROM user INNER JOIN employee on user.employee_ID = employee.employee_ID WHERE employee.email = '$_SESSION[email]'";
                                $run_query = mysqli_query($con, $query);
                                $row = mysqli_fetch_array($run_query);
                                $show = $row['employee_fname']." ". $row['employee_lname'];
                                echo "<div class='col-md-12'><div class='alert alert-info alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        $show
                                    </div></div>";
                                }
                            ?>   

                            <?php
                            if(!empty($_GET['success'])) {
                                $show = $_GET['success'];
                                  $decryption=openssl_decrypt ($show, $ciphering, $decryption_key, $options, $decryption_iv);
                                echo "<div class='col-md-12'><div class='alert alert-info alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        $decryption
                                    </div></div>";
                            }
                            
                                    ?>
                    </div>
                    <!-- /.row -->
                  <div class="row">
                        <div class="col-lg-12">
                        <?php 
                                if($_SESSION['type'] == "admin"){
                                    ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Dashboard 
                                    

                                </div>
                                <!-- /.panel-heading -->
                                
                                <div class="panel-body">
                                
                                <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel-primary">
                                <div class="panel-heading">
                                   Employees <i class="fa fa-users"></i>
                                </div>
                                <a href="manage_employee">
                                    <div class="panel-footer">
                                        <span class="pull-left">View All
                                        <?php
                                                    include 'include/config.php';
                                                    $query1 = "SELECT * FROM employee";
                                                    $good1 = mysqli_query($con, $query1);
                                                    $count = mysqli_num_rows($good1);
                                                    echo $count;
                                                 ?>
                                                 Employees
                                        </span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel-green">
                                <div class="panel-heading">
                                  All Leave Requests
                                  
                                </div>
                                <a href="all_leaves">
                                    <div class="panel-footer">
                                        <span class="pull-left">View all 
                                        <?php
                                                    include 'include/config.php';
                                                    $query1 = "SELECT * FROM leaves";
                                                    $good1 = mysqli_query($con, $query1);
                                                    $count = mysqli_num_rows($good1);
                                                    echo $count;
                                                 ?>
                                                 Requests
                                        </span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6">
                            <div class="panel-red">
                                <div class="panel-heading">
                                    Departments <span class="fa fa-bar-chart-o"></span>
                                </div>
                                <a href="manage_department">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details 
                                        <?php
                                                    include 'include/config.php';
                                                    $query1 = "SELECT * FROM department";
                                                    $good1 = mysqli_query($con, $query1);
                                                    $count = mysqli_num_rows($good1);
                                                    echo $count;
                                                 ?>
                                        </span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bell fa-fw"></i> Notifications Panel
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="list-group">
                                        <a href="pending_leaves" class="list-group-item">
                                        <label class="text-danger">
                                            <?php
                                                    include 'include/config.php';
                                                    $query1 = "SELECT * FROM leaves WHERE leave_status='Pending'";
                                                    $good1 = mysqli_query($con, $query1);
                                                    $count = mysqli_num_rows($good1);
                                                    echo $count;
                                                 ?>
                                             Pending Leaves
                                             </label>
                                        </a>
                                    </div>
                                    <!-- /.list-group -->
                                </div>
                                <!-- /.panel-body -->
                        </div>
                    </div>
                    <!-- /.row -->
                    
                        </div><hr>
                        <div class="row">
                        <div class="col-lg-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Manage Leave Type
                                </div>
                                <!-- /.panel-heading -->
                                
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>S/n</th>
                                                    <th>Leave type</th>
                                                    <th>Category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include('include/config.php');
                                                    $search = "SELECT * FROM leave_type";
                                                    $run_query = mysqli_query($con, $search);
                                                    $i = 1;
                                                    while($row = mysqli_fetch_array($run_query)){
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?php echo $i ?></td>
                                                            <td><?php echo $row['type_name']?></td>
                                                            <td><?php echo $row['type_category']?></td>
                                                            <td><center>
                                                                <a title="Edit Leave Type" href="edit_leave?edit_leave=<?php echo $row['type_ID']?>" onclick="return confirm('Are you sure! you are going to edit this Leave type?');" class=""><i class="fa fa-edit" style="color:green;"></i></a>
                                                                <a title="Delete Leave Type" href="controller/delete_leave?delete=<?php echo $row['type_ID']?>" onclick="return confirm('Are you sure! you are going to delete this Leave type?');" class=""><i class="fa fa-trash" style="color:red;"></i></a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                        
                                                    <?php $i++; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-share fa-fw"></i> Quick Links
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="list-group">
                                        <a href="add_employee" class="list-group-item">
                                            <i class="fa fa-user fa-fw"></i> Add Employee
                                        </a>
                                        <a href="all_leaves" class="list-group-item">
                                            <i class="fa fa-bell fa-fw"></i> View All Leaves Requests
                                        </a>
                                        <a href="manage_department" class="list-group-item">
                                            <i class="fa fa-bar-chart-o fa-fw"></i> Manage Departments
                                        </a>
                                        <a href="manage_leave" class="list-group-item">
                                            <i class="fa fa-random fa-fw"></i> Manage Leave Type
                                        </a>
                                        <a href="report" class="list-group-item">
                                            <i class="fa fa-clipboard fa-fw"></i> Generate Leaves Reports
                                        </a>
                                       
                                    </div>
                                    <!-- /.list-group -->
                                </div>
                                <!-- /.panel-body -->
                    </div>
                        </div>
                <!-- /.container-fluid -->
            </div>
              <?php } ?>
            
            <?php
            if($_SESSION['type'] == "User"){
                ?>
            <div class="row">
               <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Leave History <a href="apply_leave" class="btn btn-sm btn-primary pull-right">Apply Leave</a>
                                </div>
                                <!-- /.panel-heading -->
                                
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>S/n</th>
                                                    <th>Date</th>
                                                    <th>Locations</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include('include/config.php');
                                                    if($_SESSION['type'] == "User"){
                                                    $search = "SELECT * FROM leaves WHERE employee_ID='$_SESSION[employee_ID]'";
                                                    $run_query = mysqli_query($con, $search);
                                                    $i = 1;
                                                    while($row = mysqli_fetch_array($run_query)){
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center" width="10px"><?php echo $i ?></td>
                                                            <td width="150px"><?php echo $row['leave_from']."".$row['leave_to']?></td>
                                                            <td width="160px"><?php echo $row['from_place']." -  ".$row['to_place']?></td>
                                                            <td width="700px"><?php if($row['leave_description'] == ""){echo "-";}else{ echo $row['leave_description']; }?></td>
                                                            <td  width="300px">
                                                                <?php
                                                                    if($row['leave_status'] == "Pending"){
                                                                        echo "<span style='color: blue'><b></b>Waiting for approval</b></span>";
                                                                    }elseif ($row['leave_status'] == "Approved") {
                                                                        echo "<span style='color: green'>Approved</span>";
                                                                    }elseif ($row['leave_status'] == "Not Approved") {
                                                                        echo "<span style='color: red'>Not Approved</span>";
                                                                    }
                                                                 ?>
                                                            </td>
                                                            <td>
                                                                <a href="leave_details?leaveID=<?php echo $row['leave_ID']?>" class="btn btn-primary btn-sm">View Details</a>
                                                            </td>
                                                        </tr>
                                                        
                                                    <?php $i++; 
                                                }}elseif ($_SESSION['type'] == "admin") {
                                                    $search = "SELECT * FROM leaves";
                                                    $run_query = mysqli_query($con, $search);
                                                    $i = 1;
                                                    while($row = mysqli_fetch_array($run_query)){
                                                        ?>
                                                         <tr class="odd gradeX">
                                                            <td class="center" width="10px"><?php echo $i ?></td>
                                                            <td width="150px"><?php echo $row['leave_from']."".$row['leave_to']?></td>
                                                            <td width="160px"><?php echo $row['from_place']." -  ".$row['to_place']?></td>
                                                            <td width="700px"><?php if($row['leave_description'] == ""){echo "-";}else{ echo $row['leave_description']; }?></td>
                                                            <td  width="300px">
                                                                <?php
                                                                    if($row['leave_status'] == "Pending"){
                                                                        echo "<span style='color: blue'><b></b>Waiting for approval</b></span>";
                                                                    }elseif ($row['leave_status'] == "Approved") {
                                                                        echo "<span style='color: green'>Approved</span>";
                                                                    }elseif ($row['leave_status'] == "Not Approved") {
                                                                        echo "<span style='color: red'>Not Approved</span>";
                                                                    }
                                                                 ?>
                                                            </td>
                                                            <td>
                                                                <a href="leave_details?leaveID=<?php echo $row['leave_ID']?>" class="btn btn-primary btn-sm">View Details</a>
                                                            </td>
                                                        </tr>

                                                   <?php $i++; } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <?php } ?>

            <!-- /#page-wrapper -->
            <?php include('include/footer.php'); ?>
