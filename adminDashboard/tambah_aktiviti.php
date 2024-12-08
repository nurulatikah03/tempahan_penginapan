<!DOCTYPE html>
<html lang="en">
    
	<head>
        <meta charset="utf-8" />
		<title>INSKET Booking</title>
		<link rel="icon" type="image/x-icon" href="assets/images/logo/logo2.png">
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
                                            <li class="breadcrumb-item"><a href="aktiviti.php">Aktiviti</a></li>
                                            <li class="breadcrumb-item active">Tambah</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Tambah Pakej Aktiviti INSKET</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->       
                        
						
						<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
										<form class="form-horizontal" method="post" action="controller/tambahAktiviti_process.php" enctype="multipart/form-data">
											<div class="row mb-3">
												<label for="nama_aktiviti" class="col-3 col-form-label">Nama Aktiviti</label>
												<div class="col-9">
													<input type="text" class="form-control" id="nama_aktiviti" name="nama_aktiviti" placeholder="Nama Aktiviti" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="kadar_harga" class="col-3 col-form-label">Kadar Harga (RM)</label>
												<div class="col-9">
													<input type="number" class="form-control" id="kadar_harga" name="kadar_harga" placeholder="Kadar Harga" min="1" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="kemudahan" class="col-3 col-form-label">Kemudahan</label>
												<div class="col-9">
													<textarea class="form-control" id="kemudahan" name="kemudahan" placeholder="Masukkan Kemudahan yang disediakan" rows="2" required></textarea>
												</div>
											</div>
											<div class="row mb-3">
												<label for="penerangan" class="col-3 col-form-label">Penerangan</label>
												<div class="col-9">
													<textarea class="form-control" id="penerangan" name="penerangan" placeholder="Masukkan Penerangan" rows="4" required></textarea>
												</div>
											</div>
											<div class="row mb-3">
												<label class="col-3 col-form-label">Kemudahan</label>
												<div class="col-9">
													<div class="row g-2">
														<?php
														$servername = "localhost";
														$username = "root";
														$password = ""; 
														$dbname = "tempahan_penginapan"; 

														$conn = new mysqli($servername, $username, $password, $dbname);

														if ($conn->connect_error) {
															die("Connection failed: " . $conn->connect_error);
														}

														$conn->set_charset("utf8");

														$query = "SELECT id_kemudahan, nama, icon_url FROM kemudahan";
														$result = $conn->query($query);

														if ($result->num_rows > 0) {
															while ($row = $result->fetch_assoc()) {
																$id_kemudahan = $row['id_kemudahan'];
																$nama = $row['nama'];
																$icon_url = $row['icon_url'];

																echo '<div class="col-md-4">';
																echo '<div class="form-check">';
																echo '<input class="form-check-input" type="checkbox" name="kemudahanAktiviti[]" value="' . $id_kemudahan . '" id="kemudahan_' . $id_kemudahan . '">';
																echo '<label class="form-check-label" for="kemudahan_' . $id_kemudahan . '">';
																
																// Check if the icon_url is provided
																if ($icon_url) {
																	echo '<img src="../' . $icon_url . '" alt="' . $nama . '" style="height: 25px; margin-right: 5px;">';
																}
																
																// Display the name of the facility
																echo $nama;
																echo '</label>';
																echo '</div>';
																echo '</div>';
															}
														} else {
															echo '<div class="col-12">Tiada kemudahan disediakan.</div>';
														}

														// Close connection
														$conn->close();
														?>
													</div>
												</div>
											</div>
											
											
											<div class="row mb-3">
												<label for="status_aktiviti" class="col-3 col-form-label">Status</label>
												<div class="col-9">
													<select class="form-control" id="status_aktiviti" name="status_aktiviti" required>
														<option value="">Pilih Status</option>
														<option value="tersedia">Tersedia</option>
														<option value="tidak_tersedia">Tidak Tersedia</option>
													</select>
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
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->   
						
                    </div> <!-- container -->

                </div> <!-- content -->

                
                <?php include 'partials/footer.php'; ?>

            </div>

            <?php include 'partials/right-sidemenu.php'; ?>
        </div>
        <!-- END wrapper -->

		


        <!-- bundle -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>

        <!-- third party js -->
        <script src="assets/js/vendor/jquery.dataTables.min.js"></script>
        <script src="assets/js/vendor/dataTables.bootstrap5.js"></script>
        <script src="assets/js/vendor/dataTables.responsive.min.js"></script>
        <script src="assets/js/vendor/responsive.bootstrap5.min.js"></script>
        <script src="assets/js/vendor/dataTables.checkboxes.min.js"></script>

        <!-- third party js ends -->

        <!-- demo app -->
        <script src="assets/js/pages/demo.products.js"></script>
        <!-- end demo js-->

    </body>
</html>
