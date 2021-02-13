<?php $pagedesc = "Absensi";
$time = date('H:i:s');
$date = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>PT. Tokma Panca Lestari - <?php echo $pagedesc ?></title>

	<link href="admin/foto/tokma.png" rel="icon" type="images/x-icon">

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
				<div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
					<h1 class="text-center" id="timestamp"></h1>
				</div>
			</div><!-- /.row -->
			<div class="row">
				<div id="page-wrapper" class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4" style="background-color: #ffffff; border-radius: 3px; webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05); box-shadow: 0 1px 1px rgba(0,0,0,.05)">
					<div class="row">
						<div class="col-lg-12">
							<center><img src="admin/foto/tokma.png" width="130" height="120"></center>
							<h2 class="text-center">PT. Tokma Panca Lestari</h2>
						</div>
					</div><!-- /.row -->
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<form action="absen_check.php" method="post">
										<div class="form-group">
											<select class="form-control" name="jam" required>
												<option value="masuk">Jam Masuk</option>
												<option value="pulang">Jam Pulang</option>
											</select>
										</div>
										<div class="form-group">
											<input type="text" class="form-control" name="id" placeholder="ID Karyawan" required>
											<input type="hidden" class="form-control" name="time" value="<?php echo $time; ?>" required>
											<input type="hidden" class="form-control" name="date" value="<?php echo $date; ?>" required>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-success btn-block" name="login" value="Absen">
										</div>
									</form>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.col -->
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
	<script>
		// Function ini dijalankan ketika Halaman ini dibuka pada browser
		$(function() {
			setInterval(timestamp, 1000); //fungsi yang dijalan setiap detik, 1000 = 1 detik
		});

		//Fungi ajax untuk Menampilkan Jam dengan mengakses File ajax_timestamp.php
		function timestamp() {
			$.ajax({
				url: 'timestamp.php',
				success: function(data) {
					$('#timestamp').html(data);
				},
			});
		}
	</script>
</body>

</html>