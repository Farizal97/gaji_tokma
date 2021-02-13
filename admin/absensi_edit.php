<?php
	include("sess_check.php");
	
	if(isset($_GET['abs'])) {
		$sql = "SELECT absensi.*, karyawan.* FROM absensi, karyawan 
				WHERE absensi.karyawan_id=karyawan.karyawan_id AND absensi.absen_id='". $_GET['abs'] ."'";
		$ress = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($ress);
	}
	// deskripsi halaman
	$pagedesc = "Data Absensi";
	$menuparent = "absensi";
	include("layout_top.php");
	
	if(isset($_POST['perbarui'])){
		$id = $_POST['id'];
		$idkry = $_POST['idkry'];
		$in = $_POST['in'];
		$out = $_POST['out'];

		$sqlcekjdw = "SELECT karyawan.*, jadwal.* FROM karyawan, jadwal 
					  WHERE karyawan.jadwal_id=jadwal.jadwal_id AND karyawan.karyawan_id='$idkry'";
		$resscekjdw = mysqli_query($conn, $sqlcekjdw);
		$datajdw = mysqli_fetch_array($resscekjdw);
		$jdwin = $datajdw['jadwal_in'];
		$jdwout = $datajdw['jadwal_out'];
		$st="";	
		if($jdwin<=$in){
			$st = "Terlambat";
		}else{
			$st = "Tepat Waktu";
		}
			
		if($st=="Terlambat"){
			$awal = $in;
		}else{
			$awal = $jdwin;
		}
			
		if($jdwout<=$out){
			//menghitung interval waktu
			$time_in = new DateTime($awal);
			$time_out = new DateTime($jdwout);
			$interval = $time_in->diff($time_out);
			$hrs = $interval->format('%h');
			$mins = $interval->format('%i');
			$mins = $mins/60;
			$int = $hrs + $mins;
			if($int > 4){
				$int = $int - 1;
			}
			$sqlupd = "UPDATE absensi SET absen_masuk='$in', absen_pulang = '$out', absen_status='$st',
						absen_jam='$int' WHERE absen_id = '$id'";
			$resssqlupd = mysqli_query($conn, $sqlupd);
		}else{
			//menghitung interval waktu
			$time_in = new DateTime($awal);
			$time_out = new DateTime($out);
			$interval = $time_in->diff($time_out);
			$hrs = $interval->format('%h');
			$mins = $interval->format('%i');
			$mins = $mins/60;
			$int = $hrs + $mins;
			if($int > 4){
				$int = $int - 1;
			}
			$sqlupd = "UPDATE absensi SET absen_masuk='$in', absen_pulang = '$out', absen_status='$st',
						absen_jam='$int' WHERE absen_id = '$id'";
			$resssqlupd = mysqli_query($conn, $sqlupd);
		}

		if($resssqlupd){
			echo "<script>alert('Update Data Berhasil!');</script>";
			echo "<script type='text/javascript'> document.location = 'absensi.php'; </script>";
		}else{
			echo("Error description: " . mysqli_error($conn));
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'absensi_edit.php?abs=$id'; </script>";
		}
	}
?>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Data Absensi</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->

				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Edit Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">ID Karyawan</label>
										<div class="col-sm-4">
											<input type="text" name="idkry" class="form-control" placeholder="Nama" value="<?php echo $data['karyawan_id'] ?>" readonly>
											<input type="hidden" name="id" class="form-control" placeholder="ID" value="<?php echo $data['absen_id'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Nama</label>
										<div class="col-sm-4">
											<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $data['karyawan_nama'] ?>" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jam Masuk</label>
										<div class="col-sm-4">
											<input type="time" name="in" class="form-control" placeholder="Jam Keluar" value="<?php echo $data['absen_masuk'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jam Keluar</label>
										<div class="col-sm-4">
											<input type="time" name="out" class="form-control" placeholder="Jam Keluar" value="<?php echo $data['absen_pulang'] ?>" required>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<button type="submit" name="perbarui" class="btn btn-success">Update</button>
								</div>
							</div><!-- /.panel -->
						</form>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<!-- bottom of file -->
<?php
	include("layout_bottom.php");
?>