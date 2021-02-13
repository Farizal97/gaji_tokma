<?php
include("sess_check.php");

include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");
$tgl 	 = $_GET['tgl'];
$ket 	 = $_GET['ktr'];
if ($ket == 'Semua') {
	$st = "";
	$sql = "SELECT absensi.*, karyawan.* FROM absensi, karyawan 
				WHERE absensi.karyawan_id=karyawan.karyawan_id 
				AND absensi.absen_tgl='$tgl' ORDER BY absensi.absen_id DESC";
} else {
	$st = $ket;
	$sql = "SELECT absensi.*, karyawan.* FROM absensi, karyawan 
				WHERE absensi.karyawan_id=karyawan.karyawan_id 
				AND absensi.absen_tgl='$tgl' AND absensi.absen_status='$ket'
				ORDER BY absensi.absen_id DESC";
}
$ress = mysqli_query($conn, $sql);
// deskripsi halaman
$pagedesc = "Laporan Data Absensi " . $st . " - Tanggal " . IndonesiaTgl($tgl);
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
							Telp: 021-449856 <br>
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
			<h5 class="text-center">Laporan Absensi <?php echo $st; ?> Tanggal <?php echo IndonesiaTgl($tgl); ?></h5>
			<br />
			<table class="table table-striped table-bordered table-hover" id="tabel-data">
				<thead>
					<tr>
						<th width="1%">No</th>
						<th width="10%">ID Karyawan</th>
						<th width="10%">Nama</th>
						<th width="8%">Jam Masuk</th>
						<th width="8%">Jam Keluar</th>
						<th width="10%">Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					while ($data = mysqli_fetch_array($ress)) {
						$msk = $data['absen_masuk'];
						$plg = $data['absen_pulang'];
						if ($msk == $plg) {
							$ket = "Belum absen pulang";
						} else {
							$ket = $plg;
						}
						echo '<tr>';
						echo '<td class="text-center">' . $i . '</td>';
						echo '<td class="text-center">' . $data['karyawan_id'] . '</td>';
						echo '<td class="text-center">' . $data['karyawan_nama'] . '</td>';
						echo '<td class="text-center">' . $data['absen_masuk'] . '</td>';
						echo '<td class="text-center">' . $ket . '</td>';
						echo '<td class="text-center">' . $data['absen_status'] . '</td>';
						echo '</tr>';
						$i++;
					}
					?>
				</tbody>
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