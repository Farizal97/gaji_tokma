<?php
	include("sess_check.php");
	
	// query database memperbarui data pada database
	if(isset($_POST['perbarui'])) {
		$id_pengguna = $_POST['id_pengguna'];
		$password_old = md5($_POST['password_old']);
		$password_old2 = $_POST['password_old2'];
		$password_new = md5($_POST['password_new']);
		$password_new2 = md5($_POST['password_new2']);
		
		if($password_old == $password_old2) {
			if($password_new == $password_new2) {
				$sql = "UPDATE admin SET password='". $password_new ."' WHERE id_adm='". $id_pengguna ."'";
				$ress = mysqli_query($conn, $sql);
				
				header("location: pengaturan.php?act=update&msg=success");
			}
			else {
				header("location: pengaturan.php?act=update&msg=pwd_err_2");
			}
		}
		else {
			header("location: pengaturan.php?act=update&msg=pwd_err_1");
		}
	}
?>