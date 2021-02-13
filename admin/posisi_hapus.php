<?php
	include("sess_check.php");
		$id = $_GET['pss'];	
		$sql = "DELETE FROM posisi WHERE posisi_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: posisi.php?act=delete&msg=success");
?>