<?php
	include("sess_check.php");
	
	if(isset($_GET['pss'])) {
		$sql = "SELECT * FROM posisi WHERE posisi_id='". $_GET['pss'] ."'";
		$ress = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($ress);
	}
	// deskripsi halaman
	$pagedesc = "Data Posisi";
	$menuparent = "posisi";
	include("layout_top.php");
	
	if(isset($_POST['perbarui'])){
		$nama = $_POST['nama'];
		$rate = $_POST['rate'];
		$lembur = $_POST['lembur'];
		$id = $_POST['id'];
		$sql  = "UPDATE posisi SET posisi_nama='".$nama."', posisi_rate='".$rate."', posisi_lembur='".$lembur."' WHERE posisi_id='".$id."'";
		$ress = mysqli_query($conn, $sql);
		if($ress){
			echo "<script>alert('Update Data Berhasil!');</script>";
			echo "<script type='text/javascript'> document.location = 'posisi.php'; </script>";
		}else{
		//	echo("Error description: " . mysqli_error($conn));
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'posisi_edit.php?pss=$id'; </script>";
		}
	}
?>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Data Posisi</h1>
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
										<label class="control-label col-sm-3">Nama Posisi</label>
										<div class="col-sm-4">
											<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $data['posisi_nama'] ?>" required>
											<input type="hidden" name="id" class="form-control" placeholder="ID" value="<?php echo $data['posisi_id'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Rate Posisi</label>
										<div class="col-sm-4">
											<input type="number" name="rate" min=0 class="form-control" placeholder="Rate Posisi" value="<?php echo $data['posisi_rate'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Rate Lembur</label>
										<div class="col-sm-4">
											<input type="number" name="lembur" min=0 class="form-control" placeholder="Rate Posisi" value="<?php echo $data['posisi_lembur'] ?>" required>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<button type="submit" name="perbarui" class="btn btn-success">Update</button>
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