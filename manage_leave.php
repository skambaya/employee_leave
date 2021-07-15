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
                            <h4 class="page-header">Leave Type</h4>
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
                                                    <th>Description</th>
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
                                                            <td><?php echo $row['description']?></td>
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
                    </div>
                </div>
            </div>

        <?php include('include/footer.php'); ?>
