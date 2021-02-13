<?php
	include("sess_check.php");
	
	if(isset($_GET['lem'])) {
		$sql = "SELECT lembur.*, karyawan.* FROM lembur, karyawan 
				WHERE lembur.karyawan_id=karyawan.karyawan_id 
				AND lembur.lembur_id='". $_GET['lem'] ."'";
		$ress = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($ress);
	}
	// deskripsi halaman
	$pagedesc = "Data Lembur";
	$menuparent = "lembur";
	include("layout_top.php");

	if(isset($_POST['simpan'])) {
		$id = addslashes($_POST['id']);
		$kry = addslashes($_POST['kry']);
		$tgl = addslashes($_POST['tgl']);
		$jml = addslashes($_POST['jml']);
		$sql = "UPDATE lembur SET
					karyawan_id='". $kry ."',
					lembur_tgl='". $tgl ."',
					lembur_jam='". $jml ."'
				WHERE lembur_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);
				if($ress){
					echo "<script>alert('Edit Data Berhasil!');</script>";
					echo "<script type='text/javascript'> document.location = 'lembur.php'; </script>";
				}else{
				//	echo("Error description: " . mysqli_error($conn));
					echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
					echo "<script type='text/javascript'> document.location = 'lembur_edit.php?lem=$id'; </script>";
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
								<div class="panel-heading"><h3>Edit Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">Karyawan</label>
										<div class="col-sm-4">
											<select class="form-control" name="kry" required>
													<?php
														$mySql = "SELECT * FROM karyawan WHERE karyawan_status='Aktif' ORDER BY karyawan_id ASC";
														$myQry = mysqli_query($conn, $mySql);
														while ($myData = mysqli_fetch_array($myQry)) {
															$dataKry=$data['karyawan_id'];
															if ($myData['karyawan_id']== $dataKry) {
															$cek = " selected";
															} else { $cek=""; }
															echo "<option value='$myData[karyawan_id]' $cek>$myData[karyawan_id] - $myData[karyawan_nama] </option>";
														}
													?>
											</select>
											<input type="hidden" name="id" class="form-control" placeholder="ID" value="<?php echo $data['lembur_id'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Tanggal</label>
										<div class="col-sm-4">
											<input type="date" name="tgl" class="form-control" value="<?php echo $data['lembur_tgl'];?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jumlah</label>
										<div class="col-sm-4">
											<input type="number" name="jml" min="0" class="form-control" placeholder="Jumlah Jam" value="<?php echo $data['lembur_jam'];?>" required>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<button type="submit" name="simpan" class="btn btn-success">Update</button>
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