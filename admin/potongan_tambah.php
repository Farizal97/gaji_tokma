<?php
	include("sess_check.php");
	
	// deskripsi halaman
	$pagedesc = "Data Potongan";
	$menuparent = "potongan";
	include("layout_top.php");

	if(isset($_POST['simpan'])){
		$adm = $sess_admid;
		$desc = $_POST['desc'];
		$jml = $_POST['jml'];
		$sql  = "INSERT INTO potongan(potongan_desc,potongan_jml,id_adm)VALUES('$desc','$jml','$adm')";
		$ress = mysqli_query($conn, $sql);
		if($ress){
			echo "<script>alert('Tambah Data Berhasil!');</script>";
			echo "<script type='text/javascript'> document.location = 'potongan.php'; </script>";
		}else{
		//	echo("Error description: " . mysqli_error($conn));
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'potongan_tambah.php'; </script>";
		}
	}
?>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Data Potongan</h1>
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
										<label class="control-label col-sm-3">Deskripsi</label>
										<div class="col-sm-4">
											<input type="text" name="desc" class="form-control" placeholder="Deskripsi Potongan" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jumlah</label>
										<div class="col-sm-4">
											<input type="number" min=0 name="jml" class="form-control" placeholder="Jumlah Potongan" required>
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