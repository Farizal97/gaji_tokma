<?php
	include("sess_check.php");
	
	// deskripsi halaman
	$pagedesc = "Data Kasbon";
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
                        <h1 class="page-header">Data Kasbon</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<a href="kasbon_tambah.php" class="btn btn-success">Tambah</a>
							</div>
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th width="10%">ID Karyawan</th>
											<th width="10%">Nama</th>
											<th width="10%">Tanggal</th>
											<th width="10%">Jumlah</th>
											<th width="5%">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											$sql = "SELECT kasbon.*, karyawan.* FROM kasbon, karyawan 
													WHERE karyawan.karyawan_id=kasbon.karyawan_id AND karyawan.karyawan_status='Aktif'
													ORDER BY kasbon.kasbon_tgl DESC";
											$ress = mysqli_query($conn, $sql);
											while($data = mysqli_fetch_array($ress)) {
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['karyawan_id'] .'</td>';
												echo '<td class="text-center">'. $data['karyawan_nama'] .'</td>';
												echo '<td class="text-center">'. format_tanggal($data['kasbon_tgl']) .'</td>';
												echo '<td class="text-center">'. format_rupiah($data['kasbon_jml']) .'</td>';
												echo '<td class="text-center">
													  <a href="kasbon_edit.php?kas='. $data['kasbon_id'] .'" class="btn btn-warning btn-xs">Edit</a>';?>
													  <a href="kasbon_hapus.php?kas=<?php echo $data['kasbon_id'];?>" onclick="return confirm('Apakah anda yakin akan menghapus kasbon <?php echo $data['karyawan_nama'];?>?');" class="btn btn-danger btn-xs">Hapus</a></td>
												<?php
													  echo '</td>';
												echo '</tr>';												
												$i++;
											}
										?>
									</tbody>
								</table>
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
				{ "orderable": false, "targets": [5] }
			]
		});
		
		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>
<?php
	include("layout_bottom.php");
?>