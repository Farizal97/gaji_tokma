<?php
	include("sess_check.php");
		$id = $_GET['jdw'];	
		$sql = "DELETE FROM jadwal WHERE jadwal_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: jadwal.php?act=delete&msg=success");
?>