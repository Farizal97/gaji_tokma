<?php
	include("sess_check.php");
	
	$tgl = date('Y-m-d');
	$tlt = "Terlambat";
	$tpt = "Tepat Waktu";
	$sqltelat = "SELECT * FROM absensi WHERE absen_tgl='$tgl' AND absen_status='$tlt'";
	$resstelat = mysqli_query($conn, $sqltelat);
	$jmltelat = mysqli_num_rows($resstelat);

	$sqltpt = "SELECT * FROM absensi WHERE absen_tgl='$tgl' AND absen_status='$tpt'";
	$resstpt = mysqli_query($conn, $sqltpt);
	$jmltpt = mysqli_num_rows($resstpt);

	$sqlkry = "SELECT * FROM karyawan WHERE karyawan_status='Aktif'";
	$resskry = mysqli_query($conn, $sqlkry);
	$jmlkry = mysqli_num_rows($resskry);

	// deskripsi halaman
	$pagedesc = "Beranda";
	include("layout_top.php");
?>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Beranda</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-check-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $jmltpt; ?></div>
										<div><h4>Tepat waktu hari ini</h4></div>
									</div>
								</div>
							</div>
							<a href="absensi.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
					
					<div class="col-lg-6 col-md-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-minus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $jmltelat; ?></div>
										<div><h4>Terlambat hari ini</h4></div>
									</div>
								</div>
							</div>
							<a href="absensi.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $jmlkry; ?></div>
										<div><h4>Jumlah Karyawan</h4></div>
									</div>
								</div>
							</div>
							<a href="karyawan.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Rincian</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
					
				</div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<!-- bottom of file -->
<?php
	include("layout_bottom.php");
?>