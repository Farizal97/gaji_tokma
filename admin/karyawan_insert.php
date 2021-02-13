<?php
	include("sess_check.php");

	// query database memasukan data ke database
	if(isset($_POST['simpan'])) {
		$adm = $sess_admid;
		$id = addslashes($_POST['id']);
		$nama = addslashes($_POST['nama']);
		$jk = $_POST['jk'];
		$telepon = $_POST['telp'];
		$alamat = addslashes($_POST['alamat']);
		$tpt = $_POST['tpt'];
		$tgl = $_POST['tgl'];
		$pss = $_POST['pss'];
		$jdw = $_POST['jdw'];
		$mulai = $_POST['krj'];
		
		$stt = "Aktif";

		$skrg = date('Y-m-d');
		$now = date('dmYHms');
		$foto=substr($_FILES["foto"]["name"],-5);
		$newfoto = $now.$foto;

		$sqlcek = "SELECT * FROM karyawan WHERE karyawan_id='$id'";
		$resscek = mysqli_query($conn, $sqlcek);
		$rows = mysqli_num_rows($resscek);
		if($rows<1){
			$sql = "INSERT INTO karyawan(karyawan_id,karyawan_nama,karyawan_jk,karyawan_alamat,
					karyawan_telp,karyawan_tgllhr,karyawan_tptlhr,karyawan_foto,karyawan_masuk,
					posisi_id,jadwal_id,karyawan_status,karyawan_create,id_adm)
					VALUES('$id','$nama','$jk','$alamat','$telepon','$tgl','$tpt',
					'$newfoto','$mulai','$pss','$jdw','$stt','$skrg','$adm')";
			$ress = mysqli_query($conn, $sql);		

			if($ress){
			move_uploaded_file($_FILES["foto"]["tmp_name"],"foto/".$newfoto);
				echo "<script>alert('Tambah Data Berhasil!');</script>";
				echo "<script type='text/javascript'> document.location = 'karyawan.php'; </script>";
			}else{
			//	echo("Error description: " . mysqli_error($conn));
				echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
				echo "<script type='text/javascript'> document.location = 'karyawan_tambah.php'; </script>";
			}
		}else{
			header("location: karyawan_tambah.php?act=add&msg=double");				
		}
}
?>