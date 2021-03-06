<?php
	include("sess_check.php");
	
	// deskripsi halaman
	$pagedesc = "Data Lembur";
	$menuparent = "lembur";
	include("layout_top.php");
	$now = date("Y-m-d");
	
	if(isset($_POST['simpan'])) {
		$kry = addslashes($_POST['kry']);
		$tgl = addslashes($_POST['tgl']);
		$jml = addslashes($_POST['jml']);
		$sql = "INSERT INTO lembur(karyawan_id,lembur_tgl,lembur_jam)VALUES('$kry','$tgl','$jml')";
		$ress = mysqli_query($conn, $sql);		
		if($ress){
			echo "<script>alert('Tambah Data Berhasil!');</script>";
			echo "<script type='text/javascript'> document.location = 'lembur.php'; </script>";
		}else{
		//	echo("Error description: " . mysqli_error($conn));
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'lembur_tambah.php'; </script>";
		}
	}
?>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Data Lembur</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->

				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Tambah Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">Karyawan</label>
										<div class="col-sm-4">
											<select class="form-control" name="kry" required>
													<?php
														$mySql = "SELECT * FROM karyawan WHERE karyawan_status='Aktif' ORDER BY karyawan_id ASC";
														$myQry = mysqli_query($conn, $mySql);
															echo "<option value=''>====== Pilih Karyawan ======</option>";
														while ($myData = mysqli_fetch_array($myQry)) {
															if ($myData['karyawan_id']== $dataMerek) {
															$cek = " selected";
															} else { $cek=""; }
															echo "<option value='$myData[karyawan_id]' $cek>$myData[karyawan_id] - $myData[karyawan_nama] </option>";
														}
													?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Tanggal</label>
										<div class="col-sm-4">
											<input type="date" name="tgl" class="form-control" value="<?php echo $now;?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jumlah Jam</label>
										<div class="col-sm-4">
											<input type="number" name="jml" min="0" class="form-control" placeholder="Jumlah Jam" required>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<button type="submit" name="simpan" class="btn btn-success">Simpan</button>
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