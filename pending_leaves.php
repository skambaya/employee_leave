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
                            <h4 class="page-header">Leaves In Category</h4>
                        </div>
                    </div>
                   
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Pending Leaves
                                </div>
                                <!-- /.panel-heading -->
                                
                                <div class="panel-body">
                                            <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>S/n</th>
                                                    <th>Employee Name</th>
                                                    <th>Leave Type</th>
                                                    <th>Date Applied</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include('include/config.php');
                                                    $search = "SELECT * from leaves JOIN leave_type JOIN employee on leaves.employee_ID=employee.employee_ID
                                                    AND leaves.type_ID = leave_type.type_ID WHERE leave_status='Pending'";
                                                    $run_query = mysqli_query($con, $search);
                                                    $i = 1;
                                                    while($row = mysqli_fetch_array($run_query)){
                                                        ?>
                                                        <tr class="odd gradeX">
                                                            <td width="10px"><?php echo $i ?></td>
                                                            <td><?php echo $row['employee_fname']." ". $row['employee_lname']?></td>
                                                            <td><?php echo $row['type_name']?></td>
                                                            <td><?php echo $row['date_of_application']?></td>
                                                            <td>
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
                                                        
                                                    <?php $i++; } ?>
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
