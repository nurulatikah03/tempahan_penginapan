<?php

include 'controller/get_aktiviti.php';
require_once __DIR__ . '/require/UserAUTH.php';

$conn = DBConnection::getConnection();

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
		
		#modalImage {
			max-width: 100%;
			max-height: 90vh; /* Supaya gambar tidak melebihi ketinggian skrin */
		}
		
		.hover-effect {
			transition: transform 0.3s ease, opacity 0.3s ease;
			cursor: pointer;
		}

		.hover-effect:hover {
			transform: scale(1.05); /* Zoom in pada hover */
			opacity: 0.8; /* Sedikit transparan */
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Tambahkan bayangan */
		}

		/* Ukuran seragam untuk gambar banner dan tambahan */
		.uniform-image {
			width: 200px; /* Ukuran seragam */
			height: 200px; /* Ukuran seragam */
			object-fit: cover; /* Pastikan gambar tidak terdistorsi */
			border-radius: 5px; /* Tambahkan sedikit rounding jika diperlukan */
		}


		/* Ukuran gambar banner */
		.img-thumbnail {
			max-width: 150px; /* Lebarkan gambar banner */
			height: auto;
			object-fit: cover;
		}



		</style>
    </head>

    <body class="" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
        <!-- Begin page -->
        <div class="wrapper">
		
           <?php include 'partials/left-sidemenu.php';?>

            <div class="content-page">
                <div class="content">
                    
					<?php include 'partials/topbar.php'; ?>

                    <!-- Start Content-->
                    <div class="container-fluid">
					
					<?php
						if (isset($_GET['id_aktiviti'])) {
							$id_aktiviti = $_GET['id_aktiviti'];
						} else {
							echo '<div class="alert alert-danger">ID Aktiviti tidak ditemui.</div>';
								exit;
							}

							$query = "
								SELECT 
									aktiviti.id_aktiviti, 
									aktiviti.nama_aktiviti, 
									aktiviti.kadar_harga, 
									aktiviti.penerangan_kemudahan, 
									aktiviti.penerangan, 
									aktiviti.status_aktiviti, 
									aktiviti_pic.url_gambar,
									aktiviti_pic.jenis_gambar
								FROM aktiviti
								LEFT JOIN aktiviti_pic ON aktiviti.id_aktiviti = aktiviti_pic.id_aktiviti
								WHERE aktiviti.id_aktiviti = ?
							"; 

							$stmt = $conn->prepare($query);
							$stmt->bind_param("i", $id_aktiviti);
							$stmt->execute();
							$result = $stmt->get_result();

							if ($result->num_rows > 0) {
								echo '<div class="row">';			
								$utama_image = '';
								$banner_image = '';
								$tambahan_images = [];

								while ($row = $result->fetch_assoc()) {
									$id_aktiviti = $row['id_aktiviti'];
									$nama_aktiviti = $row['nama_aktiviti'];
									$kadar_harga = $row['kadar_harga'];
									$penerangan_kemudahan = $row['penerangan_kemudahan'];
									$penerangan = $row['penerangan'];
									$status_aktiviti = $row['status_aktiviti'];
									$url_gambar = $row['url_gambar'];
									$jenis_gambar = $row['jenis_gambar'];

									if ($jenis_gambar == 'Utama') {
										$utama_image = $url_gambar;
									} elseif ($jenis_gambar == 'Banner') {
										$banner_image = $url_gambar;
									} elseif ($jenis_gambar == 'Tambahan') {
										$tambahan_images[] = $url_gambar;
										}
								}
								echo '</div>';
							} else {
								echo '<div class="alert alert-info">Tiada rekod aktiviti ditemui untuk ID Aktiviti: ' . $id_aktiviti . '.</div>';
								}

								$stmt->close();
						?>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="aktiviti.php">Aktiviti</a></li>
                                            <li class="breadcrumb-item active"><?php echo $nama_aktiviti; ?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Maklumat Aktiviti</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
											<div class="col-lg-5">
												<!-- Gambar Utama -->
												<?php if ($utama_image): ?>
													<a href="javascript:void(0);" class="text-center d-block mb-4" onclick="showImage('controller/<?php echo $utama_image; ?>', 'Gambar Utama')">
														<img src="controller/<?php echo $utama_image; ?>" 
															 class="img-fluid hover-effect" 
															 style="max-width: 500px;" 
															 alt="Gambar Utama" />
													</a>
												<?php endif; ?>

												<!-- Gambar Banner dan Tambahan -->
												<div class="d-lg-flex d-none justify-content-center">
													<!-- Gambar Banner -->
													<?php if ($banner_image): ?>
														<a href="javascript:void(0);" class="text-center d-block mb-4" onclick="showImage('controller/<?php echo $banner_image; ?>', 'Gambar Banner')">
															<img src="controller/<?php echo $banner_image; ?>" 
																 class="img-fluid img-thumbnail p-2 uniform-image hover-effect" 
																 alt="Gambar Banner" />
														</a>
													<?php endif; ?>

													<!-- Gambar Tambahan -->
													<?php if (!empty($tambahan_images)): ?>
														<?php foreach ($tambahan_images as $tambahan): ?>
															<a href="javascript:void(0);" class="ms-2" onclick="showImage('controller/<?php echo $tambahan; ?>', 'Gambar Tambahan')">
																<img src="controller/<?php echo $tambahan; ?>" 
																	 class="img-fluid img-thumbnail p-2 uniform-image hover-effect" 
																	 alt="Gambar Tambahan" />
															</a>
														<?php endforeach; ?>
													<?php else: ?>
														<p>Tiada gambar tambahan tersedia.</p>
													<?php endif; ?>
												</div>
											</div>

											<!-- Modal untuk Memperbesar Gambar -->
											<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered">
													<div class="modal-content">
														<div class="modal-header">
															<h5 id="imageModalLabel" class="modal-title"></h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body text-center">
															<img id="modalImage" src="" style="max-width: 450px; height: 400px; object-fit: cover;" class="img-fluid" alt="Gambar Besar" />
														</div>
													</div>
												</div>
											</div>
                                            <div class="col-lg-7">
                                                <form class="ps-lg-4">
                                                    <h3 class="mt-0"><?php echo $nama_aktiviti; ?><a href="kemaskini_aktiviti.php?id_aktiviti=<?php echo isset($id_aktiviti) ? $id_aktiviti : '0';?>" class="text-muted"><i class="mdi mdi-square-edit-outline ms-2"></i></a> </h3>

                                                    <div class="mt-4">
                                                        <h6 class="font-14">Kadar Harga</h6>
                                                        <h3><?php echo 'RM ' . $kadar_harga; ?></h3>
                                                    </div>
                                        
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Penerangan Kemudahan</h6>
                                                        <p><?php echo $penerangan_kemudahan; ?></p>
                                                    </div>
													
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Penerangan</h6>
                                                        <p><?php echo $penerangan; ?></p>
                                                    </div>
                                                    <div class="mt-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <h6 class="font-14">Status Aktiviti</h6>
                                                                <p class="text-sm lh-150"><?php echo $status_aktiviti; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
													
													<div class="mt-4">
														<h6 class="font-14">Kemudahan</h6>
														<div class="row">
															<?php
															if (isset($_GET['id_aktiviti'])) {
																$id_aktiviti = $_GET['id_aktiviti'];
															} else {
																echo '<div class="alert alert-danger">ID Aktiviti tidak ditemui.</div>';
																exit;
															}

															$query = "
																SELECT k.nama, k.icon_url
																FROM kemudahan k
																JOIN aktiviti_kemudahan ak ON k.id_kemudahan = ak.id_kemudahan
																WHERE ak.id_aktiviti = '$id_aktiviti'
															";
															$conn = DBConnection::getConnection();

															$result = $conn->query($query);

															if ($result->num_rows > 0) {
																while ($row = $result->fetch_assoc()) {
																	$nama = $row['nama'];
																	$icon_url = $row['icon_url'];

																	echo '<div class="col-4 d-flex align-items-center my-2">';
																	
																	if ($icon_url) {
																		echo '<img src="../' . $icon_url . '" alt="' . htmlspecialchars($nama) . '" style="height: 30px; margin-right: 10px;">';
																	}

																	echo '<span>' . htmlspecialchars($nama) . '</span>';
																	echo '</div>';
																}
															} else {
																echo '<div class="col-12">Tiada kemudahan tersedia untuk aktiviti ini.</div>';
															}

															$conn->close();
															
													
															?>
															
														</div>
													</div>
                                                </form>
                                            </div> 
                                        </div> 
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
        <script src="assets/js/pages/demo.products.js"></script><!-- Bootstrap CSS -->

		<script>
		function showImage(imageUrl, jenisGambar) {
			document.getElementById('modalImage').src = imageUrl;
			document.getElementById('imageModalLabel').innerText = jenisGambar;
			var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
			imageModal.show();
		}
		</script>
    </body>
</html>
