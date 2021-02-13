<?php
	include("sess_check.php");
	
	if(isset($_GET['jdw'])) {
		$sql = "SELECT * FROM jadwal WHERE jadwal_id='". $_GET['jdw'] ."'";
		$ress = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($ress);
	}
	// deskripsi halaman
	$pagedesc = "Data Jadwal";
	$menuparent = "jadwal";
	include("layout_top.php");
	
	if(isset($_POST['perbarui'])){
		$nama = $_POST['nama'];
		$in = $_POST['in'];
		$out = $_POST['out'];
		$id = $_POST['id'];
		$sql  = "UPDATE jadwal SET jadwal_nama='".$nama."', jadwal_in='".$in."', jadwal_out='".$out."' WHERE jadwal_id='".$id."'";
		$ress = mysqli_query($conn, $sql);
		if($ress){
			echo "<script>alert('Update Data Berhasil!');</script>";
			echo "<script type='text/javascript'> document.location = 'jadwal.php'; </script>";
		}else{
		//	echo("Error description: " . mysqli_error($conn));
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'jadwal_edit.php?jdw=$id'; </script>";
		}
	}
?>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Data Jadwal</h1>
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
										<label class="control-label col-sm-3">Nama Jadwal</label>
										<div class="col-sm-4">
											<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $data['jadwal_nama'] ?>" required>
											<input type="hidden" name="id" class="form-control" placeholder="ID" value="<?php echo $data['jadwal_id'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jadwal Masuk</label>
										<div class="col-sm-4">
											<input type="time" name="in" class="form-control" placeholder="Jadwal Masuk" value="<?php echo $data['jadwal_in'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jadwal Pulang</label>
										<div class="col-sm-4">
											<input type="time" name="out" class="form-control" placeholder="Jadwal Masuk" value="<?php echo $data['jadwal_out'] ?>" required>
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