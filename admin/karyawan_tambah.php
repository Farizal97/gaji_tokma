<?php
	include("sess_check.php");

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
						<form class="form-horizontal" action="karyawan_insert.php" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Tambah Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">ID Karyawan</label>
										<div class="col-sm-4">
											<input type="text" name="id" id="id" onBlur="checkIdAvailability()" class="form-control" placeholder="ID Karyawan" required>
											<span id="user-availability-status" style="font-size:12px;"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Nama</label>
										<div class="col-sm-4">
											<input type="text" name="nama" class="form-control" placeholder="Nama" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jenis Kelamin</label>
										<div class="col-sm-4">
											<select class="form-control" name="jk" required>
												<option value="" selected>== Pilih Jenis Kelamin ==</option>
												<option value="Laki-Laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Telepon</label>
										<div class="col-sm-4">
											<input type="number" min=0 name="telp" class="form-control" placeholder="Telepon" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Alamat</label>
										<div class="col-sm-4">
											<textarea name="alamat" class="form-control" placeholder="Alamat" rows="4" required></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Tempat Lahir</label>
										<div class="col-sm-4">
											<input type="text" name="tpt" class="form-control" placeholder="Tempat Lahir" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Tanggal Lahir</label>
										<div class="col-sm-4">
											<input type="date" name="tgl" class="form-control" placeholder="Tanggal Lahir" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Posisi</label>
										<div class="col-sm-4">
											<select class="form-control" name="pss" required>
												<option value="">== Pilih Posisi ==</option>
													<?php
														$mySql = "SELECT * FROM posisi ORDER BY posisi_nama ASC";
														$myQry = mysqli_query($conn, $mySql);
														while ($myData = mysqli_fetch_array($myQry)) {
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
												<option value="">== Pilih Jadwal ==</option>
													<?php
														$mySql = "SELECT * FROM jadwal ORDER BY jadwal_nama ASC";
														$myQry = mysqli_query($conn, $mySql);
														while ($myData = mysqli_fetch_array($myQry)) {
															if ($myData['jadwal_id']== $dataMerek) {
															$cek = " selected";
															} else { $cek=""; }
															echo "<option value='$myData[jadwal_id]' $cek>$myData[jadwal_nama] | $myData[jadwal_in] - $myData[jadwal_out]</option>";
														}
													?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Mulai Bekerja</label>
										<div class="col-sm-4">
											<input type="date" name="krj" class="form-control" placeholder="Mulai Bekerja" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Foto</label>
										<div class="col-sm-4">
											<input type="file" name="foto" class="form-control" accept="image/*" required>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<button type="submit" name="simpan" class="btn btn-success">Simpan</button>
									<a href="sim.php" class="btn btn-default">Batal</a>
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