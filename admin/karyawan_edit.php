<?php
	include("sess_check.php");
	
	// query database mencari data bendahara
	if(isset($_GET['kry'])) {
		$sql = "SELECT karyawan.*, jadwal.*, posisi.* FROM karyawan, jadwal, posisi 
				WHERE karyawan.jadwal_id=jadwal.jadwal_id AND karyawan.posisi_id=posisi.posisi_id
				AND karyawan.karyawan_id='$_GET[kry]'";
		$ress = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($ress);
	}
	
	// deskripsi halaman
	$pagedesc = "Data Karyawan";
	$menuparent = "karyawan";
	include("layout_top.php");
?>
<script type="text/javascript">
	function checkIdAvailability() {
	$("#loaderIcon").show();
	jQuery.ajax({
		url: "check_idavailability.php",
		data:'id='+$("#id").val(),
		type: "POST",
		success:function(data){
			$("#user-availability-status").html(data);
			$("#loaderIcon").hide();
		},
		error:function (){}
	});
	}
</script>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Data Karyawan</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="karyawan_update.php" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Edit Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">ID Karyawan</label>
										<div class="col-sm-4">
											<input type="text" name="id" id="id" onBlur="checkIdAvailability()" class="form-control" placeholder="ID Karyawan" value="<?php echo $data['karyawan_id'];?>" required>
											<span id="user-availability-status" style="font-size:12px;"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Nama</label>
										<div class="col-sm-4">
											<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $data['karyawan_nama'];?>" required>
											<input type="hidden" name="idold" class="form-control" placeholder="NIM" value="<?php echo $data['karyawan_id'];?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jenis Kelamin</label>
										<div class="col-sm-4">
											<select class="form-control" name="jk" required>
												<option value="<?php echo $data['karyawan_jk'];?>" selected><?php echo $data['karyawan_jk'];?></option>
												<option value="Laki-Laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Telepon</label>
										<div class="col-sm-4">
											<input type="number" min=0 name="telp" class="form-control" placeholder="Telepon" value="<?php echo $data['karyawan_telp'];?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Alamat</label>
										<div class="col-sm-4">
											<textarea name="alamat" class="form-control" placeholder="Alamat" rows="4" required><?php echo $data['karyawan_alamat'];?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Tempat Lahir</label>
										<div class="col-sm-4">
											<input type="text" name="tpt" class="form-control" placeholder="Tempat Lahir" value="<?php echo $data['karyawan_tptlhr'];?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Tanggal Lahir</label>
										<div class="col-sm-4">
											<input type="date" name="tgl" class="form-control" placeholder="Tanggal Lahir" value="<?php echo $data['karyawan_tgllhr'];?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Posisi</label>
										<div class="col-sm-4">
											<select class="form-control" name="pss" required>
													<?php
														$mySql = "SELECT * FROM posisi ORDER BY posisi_nama ASC";
														$myQry = mysqli_query($conn, $mySql);
														while ($myData = mysqli_fetch_array($myQry)) {
															$dataMerek=$data['posisi_id'];
															if ($myData['posisi_id']== $dataMerek) {
															$cek = " selected";
															} else { $cek=""; }
															echo "<option value='$myData[posisi_id]' $cek>$myData[posisi_nama] </option>";
														}
													?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jadwal Kerja</label>
										<div class="col-sm-4">
											<select class="form-control" name="jdw" required>
													<?php
														$mySql = "SELECT * FROM jadwal ORDER BY jadwal_nama ASC";
														$myQry = mysqli_query($conn, $mySql);
														while ($myData = mysqli_fetch_array($myQry)) {
															$dataMerek=$data['jadwal_id'];
															if ($myData['jadwal_id']== $dataMerek) {
															$cek = " selected";
															} else { $cek=""; }
															echo "<option value='$myData[jadwal_id]' $cek>$myData[jadwal_nama] | $myData[jadwal_in] - $myData[jadwal_out] </option>";
														}
													?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Mulai Bekerja</label>
										<div class="col-sm-4">
											<input type="date" name="krj" class="form-control" placeholder="Mulai Bekerja" value="<?php echo $data['karyawan_masuk'];?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Status</label>
										<div class="col-sm-4">
											<select class="form-control" name="stt" required>
												<option value="<?php echo $data['karyawan_status'];?>" selected><?php echo $data['karyawan_status'];?></option>
												<option value="Aktif">Aktif</option>
												<option value="Nonaktif">Nonaktif</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Foto (Abaikan jika tidak diubah.)</label>
										<div class="col-sm-4">
											<input type="file" name="foto" class="form-control" accept="image/*">
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<button type="submit" name="perbarui" class="btn btn-warning">Perbarui</button>
									<a href="karyawan.php" class="btn btn-default">Batal</a>
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