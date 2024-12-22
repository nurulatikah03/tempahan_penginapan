<?php 
require_once __DIR__ . '/require/UserAUTH.php';
?>
<!DOCTYPE html>
<html lang="en">
    
	<head>
        <meta charset="utf-8" />
		<title>eTempahan INSKET</title>
		<link rel="icon" type="image/x-icon" href="assets/images/logoLKTN.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>
		<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
		<style>
		body {
			font-family: 'Poppins';
		}
		
		body[data-leftbar-theme=dark] {
			--ct-bg-leftbar: #254222;
		}
		
		.end-bar .rightbar-title {
			background-color: #254222;
		}
		
		.form-check {
    margin-bottom: 10px; /* Adjust this value for the desired space */
}

.col-4 {
    padding-right: 15px; /* Optional: Add padding for more space */
}
		</style>
    </head>

    <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
        <!-- Begin page -->
        <div class="wrapper">
		
           <?php include 'partials/left-sidemenu.php';?>

            <div class="content-page">
                <div class="content">
                    
					<?php include 'partials/topbar.php'; ?>

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="dewan.php">Dewan</a></li>
                                            <li class="breadcrumb-item active">Tambah</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Tambah Kemudahan Dewan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->       
                        
						
						<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
										<form class="form-horizontal" method="post" action="controller/tambahDewan_process.php" enctype="multipart/form-data">
											<div class="row mb-3">
												<label for="nama_dewan" class="col-3 col-form-label">Nama Dewan</label>
												<div class="col-9">
													<input type="text" class="form-control" id="nama_dewan" name="nama_dewan" placeholder="Nama Dewan" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="kadar_sewa" class="col-3 col-form-label">Kadar Sewa (RM)</label>
												<div class="col-9">
													<input type="number" step="0.01" class="form-control" id="kadar_sewa" name="kadar_sewa" placeholder="Kadar Sewa" min="1" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="bilangan_muatan" class="col-3 col-form-label">Bilangan Muatan (Orang)</label>
												<div class="col-9">
													<input type="number" class="form-control" id="bilangan_muatan" name="bilangan_muatan" placeholder="Bilangan Muatan" min="1" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="penerangan" class="col-3 col-form-label">Penerangan</label>
												<div class="col-9">
													<textarea class="form-control" id="penerangan" name="penerangan" placeholder="Masukkan Penerangan" rows="4" required></textarea>
												</div>
											</div>
											<div class="row mb-3">
												<label for="penerangan_ringkas" class="col-3 col-form-label">Penerangan Ringkas</label>
												<div class="col-9">
													<textarea class="form-control" id="penerangan_ringkas" name="penerangan_ringkas" placeholder="Masukkan Penerangan Ringkas" rows="3" required></textarea>
												</div>
											</div>
											<div class="row mb-3">
												<label for="penerangan_kemudahan" class="col-3 col-form-label">Penerangan Kemudahan</label>
												<div class="col-9">
													<textarea class="form-control" id="penerangan_kemudahan" name="penerangan_kemudahan" placeholder="Masukkan Penerangan Kemudahan" rows="3" required></textarea>
												</div>
											</div>
											<div class="row mb-3">
												<label class="col-3 col-form-label">Kemudahan</label>
												<div class="col-9">
													<div class="row g-2">
														<?php

														$query = "SELECT id_kemudahan, nama, icon_url FROM kemudahan";
														$conn = DBConnection::getConnection();
														$result = $conn->query($query);

														if ($result->num_rows > 0) {
															while ($row = $result->fetch_assoc()) {
																$id_kemudahan = $row['id_kemudahan'];
																$nama = $row['nama'];
																$icon_url = $row['icon_url'];

																echo '<div class="col-md-4">';
																echo '<div class="form-check">';
																echo '<input class="form-check-input" type="checkbox" name="kemudahan[]" value="' . $id_kemudahan . '" id="kemudahan_' . $id_kemudahan . '">';
																echo '<label class="form-check-label" for="kemudahan_' . $id_kemudahan . '">';
																
																if ($icon_url) {
																	echo '<img src="../' . $icon_url . '" alt="' . $nama . '" style="height: 25px; margin-right: 5px;">';
																}
																
																echo $nama;
																echo '</label>';
																echo '</div>';
																echo '</div>';
															}
														} else {
															echo '<div class="col-12">No kemudahan available.</div>';
														}

														$conn->close();
														?>
													</div>
												</div>
											</div>
											<div class="row mb-3">
												<label for="status_dewan" class="col-3 col-form-label">Status</label>
												<div class="col-9">
													<select class="form-control" id="status_dewan" name="status_dewan" required>
														<option value="">Pilih Status</option>
														<option value="tersedia">Tersedia</option>
														<option value="tidak tersedia">Tidak Tersedia</option>
													</select>
												</div>
											</div>
											<div class="row mb-3">
												<label for="max_capacity" class="col-3 col-form-label">Kapasiti Dewan</label>
												<div class="col-9">
													<input type="number" class="form-control" id="max_capacity" name="max_capacity" placeholder="Bilangan Kapasiti Dewan" min="1" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="fileinputUtama" class="col-3 col-form-label">Muat Naik Gambar (Utama)</label>
												<div class="col-9">
													<input type="file" id="fileinputUtama" name="fileinputUtama" class="form-control" accept="image/*" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="fileinputBanner" class="col-3 col-form-label">Muat Naik Gambar (Banner)</label>
												<div class="col-9">
													<input type="file" id="fileinputBanner" name="fileinputBanner" class="form-control" accept="image/*" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="fileinputTambahan" class="col-3 col-form-label">Muat Naik Gambar (Tambahan)</label>
												<div class="col-9">
													<input type="file" id="fileinputTambahan" name="fileinputTambahan[]" class="form-control" accept="image/*" multiple>
												</div>
											</div>
											<div class="justify-content-end row">
												<div class="col-9">
													<button type="submit" class="btn btn-info">Tambah</button>
												</div>
											</div>
										</form>
                                    </div> 
                                </div>
                            </div> 
                        </div>
                    </div>
                </div> 
                <?php include 'partials/footer.php'; ?>

            </div>
            <?php include 'partials/right-sidemenu.php'; ?>
        </div>

		
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>
        <script src="assets/js/vendor/jquery.dataTables.min.js"></script>
        <script src="assets/js/vendor/dataTables.bootstrap5.js"></script>
        <script src="assets/js/vendor/dataTables.responsive.min.js"></script>
        <script src="assets/js/vendor/responsive.bootstrap5.min.js"></script>
        <script src="assets/js/vendor/dataTables.checkboxes.min.js"></script>
        <script src="assets/js/pages/demo.products.js"></script>

    </body>
</html>
