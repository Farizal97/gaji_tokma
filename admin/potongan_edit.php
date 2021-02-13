<?php
	include("sess_check.php");
	
	if(isset($_GET['pot'])) {
		$sql = "SELECT * FROM potongan WHERE potongan_id='". $_GET['pot'] ."'";
		$ress = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($ress);
	}
	// deskripsi halaman
	$pagedesc = "Data Potongan";
	$menuparent = "potongan";
	include("layout_top.php");
	
	if(isset($_POST['perbarui'])){
		$desc = $_POST['desc'];
		$jml = $_POST['jml'];
		$id = $_POST['id'];
		$sql  = "UPDATE potongan SET potongan_desc='".$desc."', potongan_jml='".$jml."' WHERE potongan_id='".$id."'";
		$ress = mysqli_query($conn, $sql);
		if($ress){
			echo "<script>alert('Update Data Berhasil!');</script>";
			echo "<script type='text/javascript'> document.location = 'potongan.php'; </script>";
		}else{
		//	echo("Error description: " . mysqli_error($conn));
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'potongan_edit.php?pot=$id'; </script>";
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
								<div class="panel-heading"><h3>Edit Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">Deskripsi</label>
										<div class="col-sm-4">
											<input type="text" name="desc" class="form-control" placeholder="Deskripsi Potongan" value="<?php echo $data['potongan_desc'] ?>" required>
											<input type="hidden" name="id" class="form-control" placeholder="ID" value="<?php echo $data['potongan_id'] ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Jumlah</label>
										<div class="col-sm-4">
											<input type="number" name="jml" min=0 class="form-control" placeholder="Jumlah Potongan" value="<?php echo $data['potongan_jml'] ?>" required>
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