<?php
include('include/db_connect.php');
session_start();
if(!isset($_SESSION["type"]))
{
    header("location:login");
} 
include('include/header.php'); 
?>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="page-header">Leaves</h4>
                        </div>
                        <!-- /.col-lg-12 -->
                        <?php
                                    if(!empty($_GET['del'])) {
                                        $show = $_GET['del'];
                                        echo "<div class='col-md-12'><div class='alert alert-danger alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        $show
                                    </div></div>";
                                    }
                                    ?>
                    </div>
                   
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Leave History
                                    <a href="apply_leave" class="btn btn-sm btn-primary pull-right">Apply Leave</a>
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
                </div>
            </div>

        <?php include('include/footer.php'); ?>
