<?php
include 'db-connect.php';
include 'controller/get_dewan.php';

?>

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
					
					<?php
											if (isset($_GET['id_dewan'])) {
												$id_dewan = $_GET['id_dewan']; // Capture the id_dewan from the URL
											} else {
												// If id_dewan is not found in the URL, show an error or redirect
												echo '<div class="alert alert-danger">ID Dewan tidak ditemui.</div>';
												exit;
											}

											$query = "
												SELECT 
													dewan.id_dewan, 
													dewan.nama_dewan, 
													dewan.kadar_sewa, 
													dewan.bilangan_muatan, 
													dewan.penerangan, 
													dewan.penerangan_ringkas, 
													dewan.penerangan_kemudahan, 
													dewan.status_dewan, 
													dewan.max_capacity, 
													dewan_pic.url_gambar,
													dewan_pic.jenis_gambar
												FROM dewan
												LEFT JOIN dewan_pic ON dewan.id_dewan = dewan_pic.id_dewan
												WHERE dewan.id_dewan = ?
											";  // Use prepared statement to prevent SQL injection

											$stmt = $conn->prepare($query);
											$stmt->bind_param("i", $id_dewan); // Bind the id_dewan to the query
											$stmt->execute();
											$result = $stmt->get_result();

											// Check if there are any records for the given id_dewan
											if ($result->num_rows > 0) {
												echo '<div class="row">';
												// Variables to store images by type
												$utama_image = '';
												$banner_image = '';
												$tambahan_images = [];

												while ($row = $result->fetch_assoc()) {
													$id_dewan = $row['id_dewan'];
													$nama_dewan = $row['nama_dewan'];
													$kadar_sewa = $row['kadar_sewa'];
													$bilangan_muatan = $row['bilangan_muatan'];
													$penerangan = $row['penerangan'];
													$penerangan_ringkas = $row['penerangan_ringkas'];
													$penerangan_kemudahan = $row['penerangan_kemudahan'];
													$max_capacity = $row['max_capacity'];
													$status_dewan = $row['status_dewan'];
													$url_gambar = $row['url_gambar'];
													$jenis_gambar = $row['jenis_gambar'];

													// Sort the images based on jenis_gambar
													if ($jenis_gambar == 'Utama') {
														$utama_image = $url_gambar; // Set the 'utama' image
													} elseif ($jenis_gambar == 'Banner') {
														$banner_image = $url_gambar; // Set the 'banner' image
													} elseif ($jenis_gambar == 'Tambahan') {
														$tambahan_images[] = $url_gambar; // Add to additional images array
													}
												}
												echo '</div>';
											} else {
												echo '<div class="alert alert-info">Tiada rekod dewan ditemui untuk ID Dewan: ' . $id_dewan . '.</div>';
											}

										
											$stmt->close();
											$conn->close();
											?>
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="dewan.php">Dewan</a></li>
                                            <li class="breadcrumb-item active"><?php echo $nama_dewan; ?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Maklumat Dewan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                           <div class="col-lg-5">
												<!-- Product image -->
												<?php if ($utama_image): ?>
													<a href="javascript: void(0);" class="text-center d-block mb-4">
														<img src="controller/<?php echo $utama_image; ?>" class="img-fluid" style="max-width: 500px;" alt="Gambar Utama" />
													</a>
												<?php endif; ?>

												<!-- Gambar tambahan -->
												<div class="d-lg-flex d-none justify-content-center">

													<!-- Gambar banner -->
													<?php if ($banner_image): ?>
														<a href="javascript: void(0);" class="text-center d-block mb-4">
															<img src="controller/<?php echo $banner_image; ?>" class="img-fluid img-thumbnail p-2" style="max-width: 150px;" alt="Gambar Banner" />
														</a>
													<?php endif; ?>
													
													<?php if (!empty($tambahan_images)): ?>
														<?php foreach ($tambahan_images as $tambahan): ?>
															<a href="javascript: void(0);" class="ms-2">
																<img src="controller/<?php echo $tambahan; ?>" class="img-fluid img-thumbnail p-2" style="max-width: 150px;" alt="Gambar Tambahan" />
															</a>
														<?php endforeach; ?>
													<?php else: ?>
														<p>Tiada gambar tambahan tersedia.</p>
													<?php endif; ?>
												</div>
											</div>
                                            <div class="col-lg-7">
                                                <form class="ps-lg-4">
                                                    <!-- Product title -->
                                                    <h3 class="mt-0"><?php echo $nama_dewan; ?><a href="kemaskini_dewan.php?id_dewan=<?php echo isset($id_dewan) ? $id_dewan : '0';?>" class="text-muted"><i class="mdi mdi-square-edit-outline ms-2"></i></a> </h3>

                                                    <!-- Product description -->
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Kadar Sewa</h6>
                                                        <h3><?php echo 'RM ' . $kadar_sewa; ?></h3>
                                                    </div>
                                        
                                                    <!-- Product description -->
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Penerangan</h6>
                                                        <p><?php echo $penerangan; ?></p>
                                                    </div>
													
													
                                                    <!-- Product description -->
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Penerangan Ringkas</h6>
                                                        <p><?php echo $penerangan_ringkas; ?></p>
                                                    </div>
													
													
                                                    <!-- Product description -->
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Penerangan Kemudahan</h6>
                                                        <p><?php echo $penerangan_kemudahan; ?></p>
                                                    </div>

                                                    <!-- Product information -->
                                                    <div class="mt-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <h6 class="font-14">Status Dewan</h6>
                                                                <p class="text-sm lh-150"><?php echo $status_dewan; ?></p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h6 class="font-14">Bilangan Muatan</h6>
                                                                <p class="text-sm lh-150"><?php echo $bilangan_muatan.' Orang'; ?></p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h6 class="font-14">Kapasiti Dewan</h6>
                                                                <p class="text-sm lh-150"><?php echo $max_capacity; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
													
													<div class="mt-4">
														<h6 class="font-14">Kemudahan</h6>
														<div class="row">
															<?php
															$servername = "localhost";
															$username = "root";
															$password = "";
															$dbname = "tempahan_penginapan";

															// Create connection
															$conn = new mysqli($servername, $username, $password, $dbname);

															if ($conn->connect_error) {
																die("Connection failed: " . $conn->connect_error);
															}

															$conn->set_charset("utf8");

															// Semak id_dewan daripada URL
															if (isset($_GET['id_dewan'])) {
																$id_dewan = $_GET['id_dewan'];
															} else {
																echo '<div class="alert alert-danger">ID Dewan tidak ditemui.</div>';
																exit;
															}

															// Query untuk mendapatkan kemudahan berkaitan dengan dewan ini
															$query = "
																SELECT k.nama, k.icon_url
																FROM kemudahan k
																JOIN dewan_kemudahan dk ON k.id_kemudahan = dk.id_kemudahan
																WHERE dk.id_dewan = '$id_dewan'
															";

															$result = $conn->query($query);

															// Semak dan papar kemudahan
															if ($result->num_rows > 0) {
																while ($row = $result->fetch_assoc()) {
																	$nama = $row['nama'];
																	$icon_url = $row['icon_url'];

																	echo '<div class="col-4 d-flex align-items-center my-2">';
																	
																	// Paparkan ikon jika ada
																	if ($icon_url) {
																		echo '<img src="../' . $icon_url . '" alt="' . htmlspecialchars($nama) . '" style="height: 30px; margin-right: 10px;">';
																	}

																	// Paparkan nama kemudahan
																	echo '<span>' . htmlspecialchars($nama) . '</span>';
																	echo '</div>';
																}
															} else {
																echo '<div class="col-12">Tiada kemudahan tersedia untuk dewan ini.</div>';
															}

															// Tutup sambungan
															$conn->close();
															?>
														</div>
													</div>
                                                </form>
                                            </div> <!-- end col -->
                                        </div> <!-- end row-->
                                        
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->       
                        
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
