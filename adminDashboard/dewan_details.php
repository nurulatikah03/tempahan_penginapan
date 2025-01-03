<?php
include 'controller/get_dewan.php';
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
			max-height: 90vh;
			width: 350px;
			height: 250px;
			object-fit: cover;
		}

		.hover-effect {
			transition: transform 0.3s ease, opacity 0.3s ease;
			cursor: pointer;
		}

		.hover-effect:hover {
			transform: scale(1.05);
			opacity: 0.8;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
		}

		.modal-body {
			padding: 1rem;
			display: flex;
			justify-content: center;
			align-items: center;
		}


		@media (max-width: 576px) {
			#modalImage {
				max-height: 70vh;
			}
		}

		
		/* Ukuran gambar banner */
		.img-thumbnail {
			width: 150px; 
			height: 100px;
			object-fit: cover;
		}
		
		.img_utama {
			width: auto; 
			max-width: 330px;
			height: 280px; 
			object-fit: cover;
		}

		@media (max-width: 768px) {
			.img_utama {
				max-width: 100%; 
				height: auto; 
			}
		}

		@media (max-width: 480px) {
			.img_utama {
				max-width: 100%;
				height: auto;
			}
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
						if (isset($_GET['id_dewan'])) {
							$id_dewan = $_GET['id_dewan'];
						} else {
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
									dewan.mula_tidak_tersedia, 
									dewan.tamat_tidak_tersedia, 
									url_gambar.url_gambar,
									url_gambar.jenis_gambar
								FROM dewan
								LEFT JOIN url_gambar ON dewan.id_dewan = url_gambar.id_dewan
								WHERE dewan.id_dewan = ?
							"; 

							$stmt = $conn->prepare($query);
							$stmt->bind_param("i", $id_dewan);
							$stmt->execute();
							$result = $stmt->get_result();

							if ($result->num_rows > 0) {
								echo '<div class="row">';			
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
									$mula_tidak_tersedia = $row['mula_tidak_tersedia'];
									$tamat_tidak_tersedia = $row['tamat_tidak_tersedia'];

									if ($jenis_gambar == 'main') {
										$utama_image = $url_gambar;
									} elseif ($jenis_gambar == 'banner') {
										$banner_image = $url_gambar;
									} elseif ($jenis_gambar == 'add') {
										$tambahan_images[] = $url_gambar;
										}
								}
								echo '</div>';
							} else {
								echo '<div class="alert alert-info">Tiada rekod dewan ditemui untuk ID Dewan: ' . $id_dewan . '.</div>';
								}

								$stmt->close();
						?>
                        
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

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
											<div class="col-lg-5">
												<?php if ($utama_image): ?>
													<a href="javascript:void(0);" class="text-center d-block mb-4" onclick="showImage('controller/<?php echo $utama_image; ?>', 'Gambar Utama')">
														<img src="controller/<?php echo $utama_image; ?>" 
															 class="img-fluid hover-effect img_utama" 
															 style="max-width: 500px;" 
															 alt="Gambar Utama" />
													</a>
												<?php endif; ?>

												<div class="row justify-content-center">
													<?php if ($banner_image): ?>
														<div class="col-md-4 text-center mb-4">
															<a href="javascript:void(0);" onclick="showImage('controller/<?php echo $banner_image; ?>', 'Gambar Banner')">
																<img src="controller/<?php echo $banner_image; ?>" 
																	 class="img-fluid img-thumbnail p-2 uniform-image hover-effect" 
																	 alt="Gambar Banner" />
															</a>
														</div>
													<?php endif; ?>

													<?php if (!empty($tambahan_images)): ?>
														<?php foreach ($tambahan_images as $tambahan): ?>
															<div class="col-md-4 text-center mb-4">
																<a href="javascript:void(0);" onclick="showImage('controller/<?php echo $tambahan; ?>', 'Gambar Tambahan')">
																	<img src="controller/<?php echo $tambahan; ?>" 
																		 class="img-fluid img-thumbnail p-2 uniform-image hover-effect" 
																		 alt="Gambar Tambahan" />
																</a>
															</div>
														<?php endforeach; ?>
													<?php else: ?>
														<p class="text-center">Tiada gambar tambahan tersedia.</p>
													<?php endif; ?>
												</div>
											</div>

											<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered">
													<div class="modal-content">
														<div class="modal-header">
															<h5 id="imageModalLabel" class="modal-title"></h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body">
															<img id="modalImage" src="" class="img-fluid" alt="Gambar Besar" />
														</div>
													</div>
												</div>
											</div>
                                            <div class="col-lg-7">
                                                <form class="ps-lg-4">
                                                    <h3 class="mt-0"><?php echo $nama_dewan; ?><a href="kemaskini_dewan.php?id_dewan=<?php echo isset($id_dewan) ? $id_dewan : '0';?>" class="text-muted"><i class="mdi mdi-square-edit-outline ms-2"></i></a> </h3>

                                                    <div class="mt-4">
                                                        <h6 class="font-14">Kadar Sewa</h6>
                                                        <h3><?php echo 'RM ' . $kadar_sewa; ?></h3>
                                                    </div>
                                        
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Penerangan</h6>
                                                        <p><?php echo $penerangan; ?></p>
                                                    </div>
													
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Penerangan Ringkas</h6>
                                                        <p><?php echo $penerangan_ringkas; ?></p>
                                                    </div>
													
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Penerangan Kemudahan</h6>
                                                        <p><?php echo $penerangan_kemudahan; ?></p>
                                                    </div>

                                                    <div class="mt-4">
                                                        <div class="row">
                                                           <div class="col-md-4">
																<h6 class="font-14">Status Dewan</h6>
																<p class="text-sm lh-150">
																	<?php 
																		echo htmlspecialchars($status_dewan); 
																		
																		if ($status_dewan == 'Tidak Tersedia') {
																			function formatDate($datetime) {
																				if (!empty($datetime)) {
																					$dateObj = new DateTime($datetime);
																					return $dateObj->format('d/m/Y H:i:s');
																				}
																				return "Tidak ditentukan";
																			}

																			echo "<br><span class='fw-bold text-success'>Mula:</span> " . formatDate($mula_tidak_tersedia);
																			echo "<br><span class='fw-bold text-success'>Tamat:</span> " . formatDate($tamat_tidak_tersedia);
																		}
																	?>
																</p>
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
															if (isset($_GET['id_dewan'])) {
																$id_dewan = $_GET['id_dewan'];
															} else {
																echo '<div class="alert alert-danger">ID Dewan tidak ditemui.</div>';
																exit;
															}

															$query = "
																SELECT k.nama, k.icon_url
																FROM kemudahan k
																JOIN dewan_kemudahan dk ON k.id_kemudahan = dk.id_kemudahan
																WHERE dk.id_dewan = '$id_dewan'
															";

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
																echo '<div class="col-12">Tiada kemudahan tersedia untuk dewan ini.</div>';
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
        <script src="assets/js/pages/demo.products.js"></script>

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
