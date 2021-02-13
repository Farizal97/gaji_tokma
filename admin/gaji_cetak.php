<?php
	include("sess_check.php");

	include("dist/function/format_tanggal.php");
	include("dist/function/format_rupiah.php");
	$mulai 	 = $_GET['awal'];
	$selesai = $_GET['akhir'];
	$sqlabsen = "SELECT DISTINCT karyawan_id FROM absensi 
				WHERE absen_tgl BETWEEN '$mulai' AND '$selesai' ORDER BY absen_id DESC";
	$ressabsen = mysqli_query($conn, $sqlabsen);

	// deskripsi halaman
	$pagedesc = "Laporan Gaji Karyawan - Periode " . IndonesiaTgl($mulai) ." s/d ". IndonesiaTgl($selesai);
	$pagetitle = str_replace(" ", "_", $pagedesc)
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">

	<title><?php echo $pagetitle ?></title>
	
	<link href="foto/tokma.png" rel="icon" type="images/x-icon">


	<!-- Bootstrap Core CSS -->
	<link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="dist/css/offline-font.css" rel="stylesheet">
	<link href="dist/css/custom-report.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- jQuery -->
	<script src="libs/jquery/dist/jquery.min.js"></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<section id="header-kop">
		<div class="container-fluid">
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td class="text-left" width="20%">
							<img src="foto/tokma.png" alt="logo-tds" width="70" />
						</td>
						<td class="text-center" width="60%">
						<b>PT. Panca Tokma Lestari</b> <br>
						jalan, Kondangjaya, Kec. Klari, Kabupaten Karawang, Jawa Barat 41371<br>
						Telp: 021-449856  <br>
						<td class="text-right" width="20%">
						</td>
					</tr>
				</tbody>
			</table>
			<hr class="line-top" />
		</div>
	</section>

	<section id="body-of-report">
		<div class="container-fluid">
			<h5 class="text-center">Laporan Gaji Karyawan Periode Tanggal <?php echo IndonesiaTgl($mulai);?> s/d <?php echo IndonesiaTgl($selesai);?></h5>
			<br />	

								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th width="8%">ID Karyawan</th>
											<th width="10%">Nama</th>
											<th width="8%">Posisi</th>
											<th width="8%">Gaji Kotor</th>
											<th width="8%">Gaji Bersih</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$ttl=0;
											$i = 1;
											$brt=0;
											while($data = mysqli_fetch_array($ressabsen)) {
												
												$idkry = $data['karyawan_id'];
												$sqlkry = "SELECT karyawan.*, posisi.* FROM karyawan, posisi 
															WHERE karyawan.posisi_id=posisi.posisi_id 
															AND karyawan.karyawan_id='$idkry'";
												$resskry = mysqli_query($conn, $sqlkry);
												$datakry = mysqli_fetch_array($resskry);
												$idpss = $datakry['posisi_id'];
												
												$jamabsen = 0;
												$jamlembur = 0;
												$kasbon = 0;
												$pot = 0;
												$kotor = 0;
												$bersih = 0;
												
												//cari posisi
												$sqlpss = "SELECT * FROM posisi WHERE posisi_id='$idpss'";
												$resspss = mysqli_query($conn, $sqlpss);
												$datapss = mysqli_fetch_array($resspss);
												$rate = $datapss['posisi_rate'];
												$lembur = $datapss['posisi_lembur'];
												
												//cari absensi
												$sqlabs = "SELECT * FROM absensi WHERE karyawan_id='$idkry' AND absen_tgl BETWEEN '$mulai' AND '$selesai'";
												$ressabs = mysqli_query($conn, $sqlabs);
												while($dataabs = mysqli_fetch_array($ressabs)){
													$jamabsen+=$dataabs['absen_jam'];
												}												
												$ttlabsen = $jamabsen*$rate;
												
												//cari lembur
												$sqllem = "SELECT * FROM lembur WHERE karyawan_id='$idkry' AND lembur_tgl BETWEEN '$mulai' AND '$selesai'";
												$resslem = mysqli_query($conn, $sqllem);
												while($datalem = mysqli_fetch_array($resslem)){
													$jamlembur+=$datalem['lembur_jam'];
												}												
												$ttllembur = $jamlembur*$lembur;
												
												
												
												//cari kasbon
												$sqlkas = "SELECT * FROM kasbon WHERE karyawan_id='$idkry' AND kasbon_tgl BETWEEN '$mulai' AND '$selesai'";
												$resskas = mysqli_query($conn, $sqlkas);
												while($datakas = mysqli_fetch_array($resskas)){
													$kasbon+=$datakas['kasbon_jml'];
												}

												//cari potongan
												$sqlpot = "SELECT * FROM potongan";
												$resspot = mysqli_query($conn, $sqlpot);
												while($datapot = mysqli_fetch_array($resspot)){
													$pot+=$datapot['potongan_jml'];
												}
												
												$kotor = $ttlabsen+$ttllembur;
												$kurang = $pot+$kasbon;
												
												$bersih = $kotor-$kurang;
												
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['karyawan_id'] .'</td>';
												echo '<td class="text-center">'. $datakry['karyawan_nama'] .'</td>';
												echo '<td class="text-center">'. $datakry['posisi_nama'] .'</td>';
												echo '<td class="text-left">'. format_rupiah($kotor).'</td>';
												echo '<td class="text-left">'. format_rupiah($bersih).'</td>';
												echo '</tr>';												
												$i++;
											}
										?>
									</tbody>
								</table>
			<br />
		</div><!-- /.container -->
	</section>

	<script type="text/javascript">
		$(document).ready(function() {
			window.print();
		});
	</script>

	<!-- Bootstrap Core JavaScript -->
	<script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- jTebilang JavaScript -->
	<script src="libs/jTerbilang/jTerbilang.js"></script>

</body>
</html>