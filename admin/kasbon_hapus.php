<?php
	include("sess_check.php");
		$id = $_GET['kas'];	
		$sql = "DELETE FROM kasbon WHERE kasbon_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: kasbon.php?act=delete&msg=success");
?>