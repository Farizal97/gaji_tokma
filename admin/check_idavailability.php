<?php 
require_once("dist/config/koneksi.php");
// code user username availablity
if(!empty($_POST["id"])) {
	$id= $_POST["id"];
	$sql = "SELECT * FROM karyawan WHERE karyawan_id='$id'";
	$query = mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)>0){
		echo "<span style='color:red'> ID sudah terdaftar.</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	}else{
		echo "<span style='color:green'> ID bisa digunakan.</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}

?>
