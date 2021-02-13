<?php
	include("sess_check.php");
	
	// deskripsi halaman
	$pagedesc = "Laporan Gaji";
	include("layout_top.php");
	include("dist/function/format_tanggal.php");
	include("dist/function/format_rupiah.php");
?>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Gaji Karyawan</h1>
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
										<label>Tanggal Awal</label>
										<input type="date" class="form-control" name="awal" placeholder="From Date(dd/mm/yyyy)" required>
									</div>
									<div class="col-sm-4">
										<label>Tanggal Akhir</label>
										<input type="date" class="form-control" name="akhir" placeholder="To Date(dd/mm/yyyy)" required>
									</div>
									<div class="col-sm-4">
										<label>&nbsp;</label><br/>
										<input type="submit" name="submit" value="Lihat" class="btn btn-primary">
									</div>
								</div>
							</form>
							</div>
						</div>
						<?php
							if(isset($_GET['submit'])){
								$no=0;
								$mulai 	 = $_GET['awal'];
								$selesai = $_GET['akhir'];
								/*$sqlabsen = "SELECT karyawan.*, posisi.* FROM karyawan, posisi 
											WHERE karyawan.posisi_id=posisi.posisi_id 
											AND karyawan.karyawan_status='Aktif' 
											ORDER BY karyawan.karyawan_nama ASC";
								
								$sqlabsen = "SELECT absensi.*, karyawan.*,posisi.* FROM absensi, karyawan,posisi 
										WHERE absensi.karyawan_id=karyawan.karyawan_id AND karyawan.posisi_id=posisi.posisi_id
										AND absensi.absen_tgl BETWEEN '$mulai' AND '$selesai' ORDER BY absensi.absen_id DESC";
										*/
								$sqlabsen = "SELECT DISTINCT karyawan_id FROM absensi 
								WHERE absen_tgl BETWEEN '$mulai' AND '$selesai' ORDER BY absen_id DESC";
								$ressabsen = mysqli_query($conn, $sqlabsen);
							?>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th width="8%">ID Karyawan</th>
											<th width="10%">Nama</th>
											<th width="8%">Posisi</th>
											<th width="8%">Gaji Kotor</th>
											<th width="8%">Gaji Bersih</th>
											<th width="5%">Opsi</th>
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
												echo '<td class="text-center">';?>
													<a href="gaji_slip.php?awal=<?php echo $mulai;?>&akhir=<?php echo $selesai;?>&kry=<?php echo $idkry;?>" target="_blank" class="btn btn-danger btn-xs">Cetak Slip</a>
												<?php
													  echo '</td>';
												echo '</tr>';												
												$i++;
											}
										?>
									</tbody>
								</table>
							<div class="form-group">
									<a href="gaji_cetak.php?awal=<?php echo $mulai;?>&akhir=<?php echo $selesai;?>" target="_blank" class="btn btn-warning">Cetak Laporan</a>
									<a href="gaji_slip_all.php?awal=<?php echo $mulai;?>&akhir=<?php echo $selesai;?>" target="_blank" class="btn btn-primary">Cetak Semua Slip</a>
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