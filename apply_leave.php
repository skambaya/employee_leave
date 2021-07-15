<?php
session_start();
if(!isset($_SESSION["type"]))
{
	header("location:login");
} 
if (empty($_SESSION['token'])) {  
    $length = 32;
    $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length); 
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
                                    if(!empty($_GET['success'])) {
                                        $show = $_GET['success'];
                                        echo "<div class='col-md-12'><div class='alert alert-info alert-dismissible'>
                                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                        $show
                                    </div></div>";
                                    }

                                    if(!empty($_GET['fill'])) {
                                        $show = $_GET['fill'];
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
                                    Apply Leave
                                    <a href="leave_history" class="btn btn-sm btn-primary pull-right">My Leaves History</a>
                                </div>
                                <!-- /.panel-heading -->
                               
<!--                                 <script type="text/javascript">
function getValue(x) {
  if(x.value == 'No'){
    document.getElementById("yourfield").style.display = 'none'; // you need a identifier for changes
  }
  else{
    document.getElementById("yourfield").style.display = 'block';  // you need a identifier for changes
  }
}
</script> -->
                                <div class="panel-body">
                                    <div class="row">
                                        <!-- /.col-lg-6 (nested) -->
                                        <div class="col-lg-12">                                            
                                            <form action="controller/add_apply_leave.php" method="post" role="form" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="col-md-12"><!-- 

                                                        <input type="radio" name="HSC" value="Yes" onChange="getValue(this)">Annual Leave
                                                        <input type="radio" name="HSC" value="No" onChange="getValue(this)"> No<br>  -->
                                                            <div class="row form-group">
                                                            <select name="type_ID" class="form-control" required>
                                                                    <option disabled selected value="">Leave Type...</option>
                                                                        <?php
                                                                            include ("include/config.php");
                                                                            $query = "SELECT * FROM leave_type";
                                                                            $run_query = mysqli_query($con, $query);
                                                                            while($row = mysqli_fetch_array($run_query)){
                                      echo "<option value='".$row['type_ID']."'>".$row['type_name']."</option>";
                                                                                }
                                                                            ?>
                                                                </select>
                                                            </div>
                                                            <div class="row">
                                                            <div class="col-md-6">
                                                                    <div class="row form-group">
                                                                    <label class="label-control">From Date</label>
                                                                        <input type="date" min="<?php echo date("Y-m-d"); ?>" name="leave_from" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row form-group">
                                                                    <label class="label-control">To Date</label>
                                                                        <input type="date" name="leave_to" min="<?php echo date("Y-m-d"); ?>" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="col-md-6">
                                                                    <div class="row form-group">
                                                                        <label class="label-control">From</label>
                                                                        <input type="text" name="from_place" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row form-group">
                                                                        <label class="label-control">To</label>
                                                                        <input type="text" name="to_place" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                
                                                            </div>
                                                            <div class="row form-group">
                                                        <textarea class="form-control" name="leave_description" placeholder="Description"></textarea>
                                                            </div>

                                                            <div class="row form-group">
                                                            <label class="label-control">Attach Files to support your request</label>
                                                            
                                                                <input type="file" name="file" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <input type="text" name="token" value="<?=$_SESSION['token'] ?>" hidden>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <div class="row form-group">
                                                                
                                                                <table class="table table-sm table-condensed table-responsive table-hover table-stripped">
                                                                    <tr>
                                                                        <td>Transport Type</td>
                                                                        <td>
                                                                            <select class="form-control" name="transport_type">
                                                                                <option>Public</option>
                                                                                <option>Private</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                </table>                                                                
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="text-danger">ONLY FOR ANNUAL LEAVE</label>
                                                                <label>(Dependents)</label>
                                                                <table class="table table-sm">
                                                                    <tr>
                                                                        <td> Husband / Wife</td>
                                                                        <td><input type="number" id="num1" onkeyup="sum();" class="form-control"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Children</td>
                                                                        <td><input type="number" id="num2" onkeyup="sum();" class="form-control"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> Relatives</td>
                                                                        <td><input type="number" id="num3" onkeyup="sum();" class="form-control"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Transport Cost @ 1</td>
                                                                        <td><input type="number" id="num4" onkeyup="sum();" class="form-control"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>TOTAL</b></td>
                                                                        <td><input type="number" id="final" name="transport_cost" class="form-control"></td>
                                                                    </tr>
                                                                </table>
                                                                    <script type="text/javascript">
                                                                        function sum()
                                                                        {
                                                                        var w = document.getElementById('num1').value || 0;
                                                                        var x = document.getElementById('num2').value || 0;
                                                                        var y = document.getElementById('num3').value || 0;
                                                                        var s = document.getElementById('num4').value || 0;
                                                                        var z=(1+parseInt(w)+parseInt(x)+parseInt(y))*parseInt(s);
                                                                        document.getElementById('final').value=z;
                                                                        };      
                                                                    </script>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-sm btn-primary"><span class="fa fa-check"></span> APPLY</button>
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