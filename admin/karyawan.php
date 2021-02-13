<?php
	include("sess_check.php");
	
	// deskripsi halaman
	$pagedesc = "Data Karyawan";
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
                        <h1 class="page-header">Data Karyawan</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<a href="karyawan_tambah.php" class="btn btn-success">Tambah</a>
							</div>
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th width="8%">ID</th>
											<th width="10%">Nama</th>
											<th width="8%">Telepon</th>
											<th width="10%">Posisi</th>
											<th width="10%">Jadwal</th>
											<th width="10%">Status</th>
											<th width="10%">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											$sql = "SELECT karyawan.*, posisi.*, jadwal.* FROM karyawan, posisi, jadwal
													WHERE karyawan.posisi_id=posisi.posisi_id AND karyawan.jadwal_id=jadwal.jadwal_id
													ORDER BY karyawan.karyawan_nama ASC";
											$ress = mysqli_query($conn, $sql);
											while($data = mysqli_fetch_array($ress)) {
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['karyawan_id'] .'</td>';
												echo '<td class="text-nowrap">'. $data['karyawan_nama'] .'</td>';
												echo '<td class="text-center">'. $data['karyawan_telp'] .'</td>';
												echo '<td class="text-center">'. $data['posisi_nama'] .'</td>';
												echo '<td class="text-center">'. $data['jadwal_nama'] .'</td>';
												echo '<td class="text-center">'. $data['karyawan_status'] .'</td>';
												echo '<td class="text-center">
													<a href="#myModal" data-toggle="modal" data-load-id="'.$data['karyawan_id'].'" data-remote-target="#myModal .modal-body" class="btn btn-primary btn-xs">Detail</a>
													<a href="karyawan_edit.php?kry='. $data['karyawan_id'] .'" class="btn btn-warning btn-xs">Edit</a>';?>
													<a href="karyawan_hapus.php?kry=<?php echo $data['karyawan_id'];?>" onclick="return confirm('Apakah anda yakin akan menghapus <?php echo $data['karyawan_nama'];?>?');" class="btn btn-danger btn-xs">Hapus</a></td>
												<?php
												echo '</tr>';												
												$i++;
											}
										?>
									</tbody>
								</table>
							</div>
			<!-- Large modal -->
			<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-body">
							<p>Sedang memproses…</p>
						</div>
					</div>
				</div>
			</div>    
						</div><!-- /.panel -->
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<!-- bottom of file -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#tabel-data').DataTable({
			"responsive": true,
			"processing": true,
			"columnDefs": [
				{ "orderable": false, "targets": [7] }
			]
		});
		
		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>
<script>
		var app = {
			code: '0'
		};
		
		$('[data-load-id]').on('click',function(e) {
					e.preventDefault();
					var $this = $(this);
					var code = $this.data('load-id');
					if(code) {
						$($this.data('remote-target')).load('karyawan_view.php?code='+code);
						app.code = code;
						
					}
		});		
</script>
<?php
	include("layout_bottom.php");
?>