<?php
	include("sess_check.php");
	
	// query database memperbarui data pada database
	if(isset($_POST['perbarui'])) {
		$idold = addslashes($_POST['idold']);
		$id = $_POST['id'];
		$nama = addslashes($_POST['nama']);
		$jk = $_POST['jk'];
		$telepon = $_POST['telp'];
		$alamat = addslashes($_POST['alamat']);
		$tpt = $_POST['tpt'];
		$tgl = $_POST['tgl'];
		$pss = $_POST['pss'];
		$jdw = $_POST['jdw'];
		$krj = $_POST['krj'];
		$stt = $_POST['stt'];
		
		$cekfoto=$_FILES["foto"]["name"];
		$namafoto = date('mdYHis');
		
	if($id!=$idold){
		$sqlcek = "SELECT * FROM karyawan WHERE karyawan_id='$id'";
		$resscek = mysqli_query($conn, $sqlcek);
		$rows = mysqli_num_rows($resscek);
		if($rows<1){		
			if($cekfoto!=""){
				$foto=substr($_FILES["foto"]["name"],-5);
				$newfoto = $namafoto.$foto;				
				$sql = "UPDATE karyawan SET
					karyawan_id='". $id ."',
					karyawan_nama='". $nama ."',
					karyawan_jk='". $jk ."',
					karyawan_alamat='". $alamat ."',
					karyawan_telp='". $telepon ."',
					karyawan_tgllhr='". $tgl ."',
					karyawan_tptlhr='". $tpt ."',
					karyawan_foto='". $newfoto ."',
					karyawan_masuk='". $krj ."',
					posisi_id='". $pss ."',
					jadwal_id='". $jdw ."',
					karyawan_status='". $stt ."'
					WHERE karyawan_id='". $idold ."'";
				$ress = mysqli_query($conn, $sql);
				if($ress){
					move_uploaded_file($_FILES["foto"]["tmp_name"],"foto/".$newfoto);
					echo "<script>alert('Edit Data Berhasil!');</script>";
					echo "<script type='text/javascript'> document.location = 'karyawan.php'; </script>";
				}else{
				//	echo("Error description: " . mysqli_error($conn));
					echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
				echo "<script type='text/javascript'> document.location = 'karyawan_edit.php?kry=$idold'; </script>";
				}
			}else{
				$sql = "UPDATE karyawan SET
					karyawan_id='". $id ."',
					karyawan_nama='". $nama ."',
					karyawan_jk='". $jk ."',
					karyawan_alamat='". $alamat ."',
					karyawan_telp='". $telepon ."',
					karyawan_tgllhr='". $tgl ."',
					karyawan_tptlhr='". $tpt ."',
					karyawan_masuk='". $krj ."',
					posisi_id='". $pss ."',
					jadwal_id='". $jdw ."',
					karyawan_status='". $stt ."'
					WHERE karyawan_id='". $idold ."'";
				$ress = mysqli_query($conn, $sql);
				if($ress){
					echo "<script>alert('Edit Data Berhasil!');</script>";
					echo "<script type='text/javascript'> document.location = 'karyawan.php'; </script>";
				}else{
				//	echo("Error description: " . mysqli_error($conn));
					echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
				echo "<script type='text/javascript'> document.location = 'karyawan_edit.php?kry=$idold'; </script>";
				}
			}
		}else{
			header("location: karyawan_edit.php?kry=$idold&act=add&msg=double");			
		}
	}else{
			if($cekfoto!=""){
				$foto=substr($_FILES["foto"]["name"],-5);
				$newfoto = $namafoto.$foto;				
				$sql = "UPDATE karyawan SET
					karyawan_nama='". $nama ."',
					karyawan_jk='". $jk ."',
					karyawan_alamat='". $alamat ."',
					karyawan_telp='". $telepon ."',
					karyawan_tgllhr='". $tgl ."',
					karyawan_tptlhr='". $tpt ."',
					karyawan_foto='". $newfoto ."',
					karyawan_masuk='". $krj ."',
					posisi_id='". $pss ."',
					jadwal_id='". $jdw ."',
					karyawan_status='". $stt ."'
					WHERE karyawan_id='". $idold ."'";
				$ress = mysqli_query($conn, $sql);
				if($ress){
					move_uploaded_file($_FILES["foto"]["tmp_name"],"foto/".$newfoto);
					echo "<script>alert('Edit Data Berhasil!');</script>";
					echo "<script type='text/javascript'> document.location = 'karyawan.php'; </script>";
				}else{
				//	echo("Error description: " . mysqli_error($conn));
					echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
				echo "<script type='text/javascript'> document.location = 'karyawan_edit.php?kry=$idold'; </script>";
				}
			}else{
				$sql = "UPDATE karyawan SET
					karyawan_nama='". $nama ."',
					karyawan_jk='". $jk ."',
					karyawan_alamat='". $alamat ."',
					karyawan_telp='". $telepon ."',
					karyawan_tgllhr='". $tgl ."',
					karyawan_tptlhr='". $tpt ."',
					karyawan_masuk='". $krj ."',
					posisi_id='". $pss ."',
					jadwal_id='". $jdw ."',
					karyawan_status='". $stt ."'
					WHERE karyawan_id='". $idold ."'";
				$ress = mysqli_query($conn, $sql);
				if($ress){
					echo "<script>alert('Edit Data Berhasil!');</script>";
					echo "<script type='text/javascript'> document.location = 'karyawan.php'; </script>";
				}else{
				//	echo("Error description: " . mysqli_error($conn));
					echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
					echo "<script type='text/javascript'> document.location = 'karyawan_edit.php?kry=$idold'; </script>";
				}
			}
	
	}
}
?>