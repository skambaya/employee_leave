<?php
	include "../include/config.php";
		
	$leaveID = $_GET['leaveID'];
	if(ISSET($_POST['update'])){
		$query = "UPDATE leaves SET isRead = '2' WHERE leave_ID = '$leaveID'";
		$run = mysqli_query($con, $query);

		$simple_string = "Action taken and applied Successful";
        header("Location: ../leave_details?leaveID=$leaveID");
	}
?>