<?php 
include("admin/dist/config/koneksi.php");
$pagedesc = "Absensi"; 
	if(isset($_POST['id'])) {
		$id = $_POST['id'];
		$jam = $_POST['jam'];
		$now = date('Y-m-d');
		$time = $_POST['time'];
		$date = $_POST['date'];
		$null =0;
		$sql = "SELECT * FROM karyawan WHERE karyawan_status='Aktif' AND karyawan_id='$id'";
		$ress = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($ress);
		if($num<1){
			header("location: index.php?err=not_found");			
		}else{
			if($jam=='masuk'){
				$sqlcekmasuk = "SELECT * FROM absensi WHERE karyawan_id='$id' AND absen_tgl='$now'";
				$resscekmasuk = mysqli_query($conn, $sqlcekmasuk);
				$numcekmasuk = mysqli_num_rows($resscekmasuk);
				if($numcekmasuk>0){
					header("location: index.php?err=double");			
				}else{
					$sqlcekjdw = "SELECT karyawan.*, jadwal.* FROM karyawan, jadwal 
								  WHERE karyawan.jadwal_id=jadwal.jadwal_id AND karyawan.karyawan_id='$id'";
					$resscekjdw = mysqli_query($conn, $sqlcekjdw);
					$datajdw = mysqli_fetch_array($resscekjdw);
					$jdwmasuk = $datajdw['jadwal_in'];
					if($jdwmasuk<=$time){
						$stt = "Terlambat";						
					}else{
						$stt = "Tepat Waktu";
					}
					$sqlinsert  = "INSERT INTO absensi(karyawan_id,absen_tgl,absen_masuk,absen_pulang,absen_status,absen_jam)
							VALUES('$id','$date','$time','$time','$stt','$null')";
					$ressinsert = mysqli_query($conn, $sqlinsert);
					//select karyawan
					$sqlemp = "SELECT karyawan.*, posisi.* FROM karyawan, posisi 
								  WHERE karyawan.posisi_id=posisi.posisi_id AND karyawan.karyawan_id='$id'";
					$ressemp = mysqli_query($conn, $sqlemp);
					$dataemp = mysqli_fetch_array($ressemp);
					
				}
			}else{
			//absen pulang	
				$sqlcekmasuk = "SELECT * FROM absensi WHERE karyawan_id='$id' AND absen_tgl='$now'";
				$resscekmasuk = mysqli_query($conn, $sqlcekmasuk);
				$numcekmasuk = mysqli_num_rows($resscekmasuk);
				$datacekmasuk = mysqli_fetch_array($resscekmasuk);
				$sttabsen = $datacekmasuk['absen_status'];
				$masukabsen = $datacekmasuk['absen_masuk'];
				$idabsen = $datacekmasuk['absen_id'];
				if($numcekmasuk<1){
					header("location: index.php?err=belum");			
				}else{
					$sqlcekjdw = "SELECT karyawan.*, jadwal.* FROM karyawan, jadwal 
								  WHERE karyawan.jadwal_id=jadwal.jadwal_id AND karyawan.karyawan_id='$id'";
					$resscekjdw = mysqli_query($conn, $sqlcekjdw);
					$datajdw = mysqli_fetch_array($resscekjdw);
					$jdwin = $datajdw['jadwal_in'];
					$jdwout = $datajdw['jadwal_out'];
					
					if($sttabsen=="Terlambat"){
						$awal = $masukabsen;
					}else{
						$awal = $jdwin;
					}
					
					if($jdwout<=$time){
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
						$sqlupd = "UPDATE absensi SET absen_pulang = '$time',
									absen_jam='$int' WHERE absen_id = '$idabsen'";
						$resssqlupd = mysqli_query($conn, $sqlupd);

					}else{
						//menghitung interval waktu
						$time_in = new DateTime($awal);
						$time_out = new DateTime($time);
						$interval = $time_in->diff($time_out);
						$hrs = $interval->format('%h');
						$mins = $interval->format('%i');
						$mins = $mins/60;
						$int = $hrs + $mins;
						if($int > 4){
							$int = $int - 1;
						}
						$sqlupd = "UPDATE absensi SET absen_pulang = '$time',
									absen_jam='$int' WHERE absen_id = '$idabsen'";
						$resssqlupd = mysqli_query($conn, $sqlupd);
					}


					$sqlemp = "SELECT karyawan.*, posisi.* FROM karyawan, posisi 
								  WHERE karyawan.posisi_id=posisi.posisi_id AND karyawan.karyawan_id='$id'";
					$ressemp = mysqli_query($conn, $sqlemp);
					$dataemp = mysqli_fetch_array($ressemp);
					
				}
				
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta http-equiv="refresh" content="4;url=index.php">
	<title>PT. Triwarga Dian Sakti - <?php echo $pagedesc ?></title>

	<link href="admin/foto/honda.jpg" rel="icon" type="images/x-icon">

	<!-- Bootstrap Core CSS -->
	<link href="admin/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="admin/dist/css/offline-font.css" rel="stylesheet">
	<link href="admin/dist/css/custom.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="admin/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- jQuery -->
	<script src="admin/libs/jquery/dist/jquery.min.js"></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body style="background-color: #f1f4f7">

	<section id="main-wrapper" style="margin-top: 120px">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4"><?php include("layout_alert.php"); ?></div>
			</div><!-- /.row -->
			<div class="row">
				<div id="page-wrapper" class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4" style="background-color: #ffffff; border-radius: 3px; webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05); box-shadow: 0 1px 1px rgba(0,0,0,.05)">
					<div class="row">
						<div class="col-lg-12">
							<br/>
							<center><img src="admin/foto/<?php echo $dataemp['karyawan_foto'];?>" width="130" height="120"></center>
							<h2 class="text-center"><?php echo $dataemp['karyawan_id'].' - '.$dataemp['karyawan_nama'];?></h2>
							<h2 class="text-center"><?php echo $dataemp['posisi_nama'];?></h2>
							<h2 class="text-center"><b>Absensi Berhasil!</b></h2>
						</div>
					</div><!-- /.row -->
		</div><!-- /.container -->
	</section>
	
	<!-- footer-bottom -->
	<div class="navbar navbar-inverse navbar-fixed-bottom footer-bottom">
		<div class="container text-center">
			<p class="text-center" style="color: #D1C4E9; margin: 0 0 5px; padding: 0"><small>PT. Triwarga Dian Sakti</small></p>
		</div>
	</div><!-- /.footer-bottom -->

	<!-- Bootstrap Core JavaScript -->
	<script src="admin/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	
</body>
</html>