<?php
	include("sess_check.php");
		$id = $_GET['abs'];	
		$sql = "DELETE FROM absensi WHERE absen_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: absensi.php?act=delete&msg=success");
?>