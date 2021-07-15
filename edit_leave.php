<?php
include('include/db_connect.php');
session_start();
if(!isset($_SESSION["type"]))
{
	header("location:login");
} 
include('include/header.php'); 
?>
<head>
    <style>
        .input{
            border-top: none;
        }
    </style>
</head>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="page-header">Leaves</h4>
                        </div>
                        <!-- /.col-lg-12 -->
                        <?php
                                    include ('include/config.php');
                                    $leave_type_ID = $_GET['edit_leave'];
                                    if(isset($_POST['submit'])){
                                    $type_name= mysqli_real_escape_string($con, $_POST['type_name']);
                                    $type_category= mysqli_real_escape_string($con, $_POST['type_category']);
                                    $description = mysqli_real_escape_string($con, $_POST['description']);
                                    $update = "UPDATE leave_type SET type_name = '$type_name', type_category = '$type_category', description= '$description' WHERE type_ID='$leave_type_ID'";
                                    $update_query = mysqli_query($con, $update);
                                    if($update_query){
                                        echo "<div class='col-md-12'><div class='alert alert-info alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        Updated Successful
                                        </div></div>";
                                    }else{
                                        echo "<div class='col-md-12'><div class='alert alert-info alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        Failed!, Please try again.
                                        </div></div>";
                                    }
                                }
                                    ?>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Edit Leave Type
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- /.col-lg-6 (nested) -->
                                        <div class="col-lg-12">
                                        <?php
                                          include('include/config.php');
                                          $leave_type_ID = $_GET['edit_leave'];
                                          $search = "SELECT * FROM leave_type WHERE type_ID='$leave_type_ID'";
                                          $run_query = mysqli_query($con, $search);
                                          while($row = mysqli_fetch_array($run_query)){
                                          ?>                                                                                      
                                            <form action="" method="post" role="form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <div class="row form-group">
                                                                <input type="text" name="type_name" value="<?php echo $row['type_name'] ?>" class="form-control" placeholder="Leave Type">
                                                            </div>
                                                            <div class="row form-group">
                                                                <textarea name="type_category" class="form-control" placeholder="Category"><?php echo $row['type_category'] ?></textarea>
                                                            </div>
                                                            <div class="row form-group">
                                                                <textarea name="description" class="form-control" placeholder="Description"><?php echo $row['description'] ?></textarea>
                                                            </div>
                                                            <input type="text" name="token" value="<?=$_SESSION['token'] ?>" hidden>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button name="submit" name="submit" class="btn btn-sm btn-primary"><span class="fa fa-save"></span> Save</button>
                                            </form>
                                          <?php } ?>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        <?php include('include/footer.php') ?>