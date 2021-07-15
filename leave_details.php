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
                            <h4 class="page-header">Leave Details</h4>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                   
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Details
                                </div>
                                <!-- /.panel-heading -->
                                
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped ">
                                            <tbody>
                                                <?php
                                                    include('include/config.php');
                                                    $leave_ID = $_GET['leaveID'];
                                                    // $update = "UPDATE leaves SET isRead = 1 WHERE leave_ID = '$leave_ID'";
                                                    $search = "SELECT * from leaves JOIN leave_type JOIN employee JOIN user on leaves.employee_ID=employee.employee_ID
                                                    AND leaves.type_ID = leave_type.type_ID AND user.employee_ID=employee.employee_ID WHERE leaves.leave_ID = '$leave_ID'";
                                                    $run_query = mysqli_query($con, $search);
                                                    while($row = mysqli_fetch_array($run_query)){
                                                        ?>
                                                        <tr>
                                                            <td><b>Employee Name</b></td>
                                                            <td><a href="edit_employee?edit_employee=<?php echo $row['employee_ID']?>" target="_blank"><?php echo $row['employee_fname']." ". $row['employee_lname']?></a></td>
                                                            <td><b>Emp ID</b></td>
                                                            <td><?php echo $row['employee_ID']?></td>
                                                            <td><b>Gender</b></td>
                                                            <td><?php echo $row['gender']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Email ID</b></td>
                                                            <td><?php echo $row['email']?></td>
                                                            <td><b>Contact no</b></td>
                                                            <td><?php echo $row['phone_number']?></td>
                                                            <td>&nbsp;</td>
                                                             <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Leave Type</b></td>
                                                            <td><?php echo $row['type_name']?></td>
                                                            <td><b>Leave Date</b></td>
                                                            <td><?php echo $row['leave_from']." to ".$row['leave_from']?></td>
                                                            <td><b>Date Applied</b></td>
                                                            <td><?php echo $row['date_of_application']?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Attachment</b></td>
                                                            <td><a href="attachment?id=<?php echo $row['leave_ID']?>&take=<?php echo $row['attachment']; ?>">
                                                            <span style='color: red'><b><?php echo $row['attachment']; ?></b></span></a></td>
                                                            <td  colspan="4">
                                                            <iframe src="employee_image/<?php echo $row['attachment']; ?>"></iframe>
                                                            </td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td><b>Employee Leave Description</b></td>
                                                            <td colspan="5">
                                                            <?php
                                                                if($row['leave_description'] == ""){
                                                                    echo "NA";
                                                                }else{
                                                                    echo $row['leave_description'];
                                                                }
                                                                   ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Leave Status</td>
                                                            <td colspan="5">
                                                            <?php
                                                                    if($row['leave_status'] == "Pending"){
                                                                        echo "<span style='color: blue'><b>Waiting for approval</b></span>";
                                                                    }elseif ($row['leave_status'] == "Approved") {
                                                                        echo "<span style='color: green'><b>Approved</b></span>";
                                                                    }elseif ($row['leave_status'] == "Not Approved") {
                                                                        echo "<span style='color: red'><b>Not Approved</b></span>";
                                                                    }
                                                                 ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Supervisor Remark</b></td>
                                                            <td colspan="5">
                                                                <?php
                                                                if($row['remark'] == ""){
                                                                    echo "NA";
                                                                }else{
                                                                    echo $row['remark'];
                                                                }
                                                                   ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Supervisor Action taken date</b></td>
                                                            <td colspan="5"><?php echo $row['remark_date']?></td>
                                                        </tr>
                                                        <?php
                                                            if($row['leave_status'] == "Pending" && $_SESSION['type'] == "admin"){
                                                            ?>
                                                        <tr>
                                                            <td>
                                                                <a href="" type="button" class="btn btn-sm btn-primary" data-toggle="modal" 
                                                                data-target="#myModal<?php echo $row['leave_ID']?>">Take Action</a>
                                                            </td>
                                                        </tr>
                                                        <?php include('take_action.php') ?>
                                                        <?php } ?>
                                                        
                                                    <?php } ?>
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
