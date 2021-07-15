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
                                    if(!empty($_GET['success'])) {
                                        $show = $_GET['success'];
                                        echo "<div class='col-md-12'><div class='alert alert-info alert-dismissible'>
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
                                    Add Leave Type
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- /.col-lg-6 (nested) -->
                                        <div class="col-lg-12">                                            
                                            <form action="controller/add_leave.php" method="post" role="form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <div class="row form-group">
                                                                <input type="text" name="type_name" class="form-control" placeholder="Leave Type">
                                                            </div>
                                                            <div class="row form-group">
                                                                <textarea name="type_category" class="form-control" placeholder="Categoty"></textarea>
                                                            </div>
                                                            <div class="row form-group">
                                                                <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                                            </div>
                                                            <input type="text" name="token" value="<?=$_SESSION['token'] ?>" hidden>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button name="submit" class="btn btn-sm btn-primary"><span class="fa fa-save"></span> Save</button>
                                            </form>
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