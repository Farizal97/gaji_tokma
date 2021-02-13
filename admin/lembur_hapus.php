<?php
	include("sess_check.php");
		$id = $_GET['lem'];	
		$sql = "DELETE FROM lembur WHERE lembur_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: lembur.php?act=delete&msg=success");
?>