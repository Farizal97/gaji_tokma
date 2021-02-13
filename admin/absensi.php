<?php
	include("sess_check.php");
	
	// deskripsi halaman
	$pagedesc = "Data Absensi";
	include("layout_top.php");
	include("dist/function/format_tanggal.php");
	include("dist/function/format_rupiah.php");
	$now = date('Y-m-d');
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
						<div class="panel panel-default">
							<div class="panel-body">
					        <form method="get" name="laporan" onSubmit="return valid();"> 
								<div class="form-group">
									<div class="col-sm-4">
										<label>Tanggal</label>
										<input type="date" class="form-control" name="tgl" value="<?php echo $now?>" required>
									</div>
									<div class="col-sm-4">
										<label>Keterangan</label>
											<select class="form-control" name="ktr" required>
												<option value="Semua" selected>Semua</option>
												<option value="Terlambat">Terlambat</option>
												<option value="Tepat Waktu">Tepat Waktu</option>
											</select>
									</div>
									<div class="col-sm-4">
										<label>&nbsp;</label><br/>
										<input type="submit" name="submit" value="Lihat Absensi" class="btn btn-primary">
									</div>
								</div>
							</form>
							</div>
						</div>
						<?php
							if(isset($_GET['submit'])){
								$no=0;
								$tgl = $_GET['tgl'];
								$ktr = $_GET['ktr'];
								if($ktr=='Semua'){									
									$sql = "SELECT absensi.*, karyawan.* FROM absensi, karyawan 
											WHERE absensi.karyawan_id=karyawan.karyawan_id 
											AND absensi.absen_tgl='$tgl' ORDER BY absensi.absen_id DESC";
								}else{
									$sql = "SELECT absensi.*, karyawan.* FROM absensi, karyawan 
											WHERE absensi.karyawan_id=karyawan.karyawan_id 
											AND absensi.absen_tgl='$tgl' AND absensi.absen_status='$ktr'
											ORDER BY absensi.absen_id DESC";
								}
								$ress = mysqli_query($conn, $sql);
							?>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading"><h3>Data Absensi <?php echo $ktr;?> Tanggal <?php echo IndonesiaTgl($tgl);?></h3></div>
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th width="10%">ID Karyawan</th>
											<th width="10%">Nama</th>
											<th width="8%">Jam Masuk</th>
											<th width="8%">Jam Keluar</th>
											<th width="10%">Keterangan</th>
											<th width="8%">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											while($data = mysqli_fetch_array($ress)) {
												$msk = $data['absen_masuk'];
												$plg = $data['absen_pulang'];
												if($msk==$plg){
													$ket = "Belum absen pulang";
												}else{
													$ket = $plg;
												}
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['karyawan_id'] .'</td>';
												echo '<td class="text-center">'. $data['karyawan_nama'] .'</td>';
												echo '<td class="text-center">'. $data['absen_masuk'] .'</td>';
												echo '<td class="text-center">'. $ket .'</td>';
												echo '<td class="text-center">'. $data['absen_status'] .'</td>';
												echo '<td class="text-center">
													  <a href="absensi_edit.php?abs='. $data['absen_id'] .'" class="btn btn-warning btn-xs">Edit</a>';?>
													  <a href="absensi_hapus.php?abs=<?php echo $data['absen_id'];?>" onclick="return confirm('Apakah anda yakin akan menghapus absensi <?php echo $data['karyawan_nama'];?>?');" class="btn btn-danger btn-xs">Hapus</a></td>
												<?php
													  echo '</td>';
												echo '</tr>';												
												$i++;
											}
										?>
									</tbody>
								</table>
							<div class="form-group">
									<a href="absensi_cetak.php?tgl=<?php echo $tgl;?>&ktr=<?php echo $ktr;?>" target="_blank" class="btn btn-warning">Cetak</a>
							</div>
							</div>
			<!-- Large modal -->
			<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-body">
							<p>One fine body…</p>
						</div>
					</div>
				</div>
			</div>    
						</div><!-- /.panel -->
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
			<?php }else{ 
								$no=0;
								$tgl 	 = $now;
								$sql = "SELECT absensi.*, karyawan.* FROM absensi, karyawan WHERE
										absensi.karyawan_id=karyawan.karyawan_id AND absensi.absen_tgl='$tgl' ORDER BY absensi.absen_id DESC";
								$ress = mysqli_query($conn, $sql);
							?>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading"><h3>Data Absensi Tanggal <?php echo IndonesiaTgl($tgl);?></h3></div>
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th width="10%">ID Karyawan</th>
											<th width="10%">Nama</th>
											<th width="8%">Jam Masuk</th>
											<th width="8%">Jam Keluar</th>
											<th width="10%">Keterangan</th>
											<th width="8%">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											while($data = mysqli_fetch_array($ress)) {
												$msk = $data['absen_masuk'];
												$plg = $data['absen_pulang'];
												if($msk==$plg){
													$ket = "Belum absen pulang";
												}else{
													$ket = $plg;
												}
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['karyawan_id'] .'</td>';
												echo '<td class="text-center">'. $data['karyawan_nama'] .'</td>';
												echo '<td class="text-center">'. $data['absen_masuk'] .'</td>';
												echo '<td class="text-center">'. $ket .'</td>';
												echo '<td class="text-center">'. $data['absen_status'] .'</td>';
												echo '<td class="text-center">
													  <a href="absensi_edit.php?abs='. $data['absen_id'] .'" class="btn btn-warning btn-xs">Edit</a>';?>
													  <a href="absensi_hapus.php?abs=<?php echo $data['absen_id'];?>" onclick="return confirm('Apakah anda yakin akan menghapus absensi <?php echo $data['karyawan_nama'];?>?');" class="btn btn-danger btn-xs">Hapus</a></td>
												<?php
													  echo '</td>';
												echo '</tr>';												
												$i++;
											}
										?>
									</tbody>
								</table>
							<div class="form-group">
									<a href="absensi_cetak.php?tgl=<?php echo $tgl;?>&ktr=<?php echo 'Semua';?>" target="_blank" class="btn btn-warning">Cetak</a>
							</div>
							</div>
			<!-- Large modal -->
			<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-body">
							<p>One fine body…</p>
						</div>
					</div>
				</div>
			</div>    
						</div><!-- /.panel -->
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
			<?php }?>
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<!-- bottom of file -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#tabel-data').DataTable({
			"responsive": true,
			"processing": true,
			"columnDefs": [
				{ "orderable": false, "targets": [6] }
			]
		});
		
		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>
<script>
		var app = {
			code: '0'
		};
</script>
<?php
	include("layout_bottom.php");
?>