<?php
include 'controller/get_aktiviti.php';
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
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
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
		
		.img-thumbnail {
			transition: transform 0.3s ease, opacity 0.3s ease;
			cursor: pointer;
		}

		.img-thumbnail:hover {
			transform: scale(1.05); /* Zoom in sedikit */
			opacity: 0.8; /* Sedikit transparan */
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Tambahkan bayangan */
		}
		
		.img-tambahan {
			max-width: 300px;
			height: 250px; 
			object-fit: cover;
			border: 1px solid #ddd;
			border-radius: 5px;
			margin: 10px; 
		}
    </style>
</head>

<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid"
    data-rightbar-onstart="true">
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
							$id_aktiviti = $_GET['id_aktiviti']; // Capture the id_aktiviti from the URL
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
							WHERE aktiviti.id_aktiviti = ?";
							
							
							$conn = DBConnection::getConnection();
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
                                        <li class="breadcrumb-item">
                                            <?php echo $nama_aktiviti; ?></a>
                                        </li>
                                        <li class="breadcrumb-item active">Kemaskini</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Kemaskini Kemudahan Aktiviti</h4>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="form-horizontal" method="post"
                                        action="controller/kemaskiniAktiviti_process.php" enctype="multipart/form-data">
										<div class="container">
											<div class="row justify-content-center">
												<!-- Gambar Utama -->
												<div class="col-md-6 text-center">
													<label for="fileinputUtama" class="form-label">Gambar Utama</label>
													<?php if (!empty($utama_image)): ?>
														<img src="controller/<?php echo $utama_image; ?>" 
															 alt="Gambar Utama" 
															 class="img-thumbnail mx-auto d-block" 
															 style="width: 100%; max-width: 500px; height: auto; object-fit: cover;" 
															 data-bs-toggle="modal" 
															 data-bs-target="#uploadModal-utama" 
															 onclick="showImage('controller/<?php echo $utama_image; ?>', 'Gambar Utama')">
													<?php endif; ?>
												</div>

												<!-- Gambar Banner dan Tambahan -->
												<div class="col-md-3 text-center">
													<label for="fileinputBanner" class="form-label">Gambar Banner</label>
													<div class="mb-3">
														<?php if (!empty($banner_image)): ?>
															<img src="controller/<?php echo $banner_image; ?>" 
																 alt="Gambar Banner" 
																 class="img-thumbnail mx-auto d-block" 
																 style="max-width: 240px; height: auto; object-fit: cover;" 
																 data-bs-toggle="modal" 
																 data-bs-target="#uploadModal-banner" 
																 onclick="showImage('controller/<?php echo $banner_image; ?>', 'Gambar Banner')">
														<?php endif; ?>
													</div>

													<!-- Gambar Tambahan -->
													<label for="fileinputTambahan" class="form-label">Gambar Tambahan</label>
													<div class="d-flex flex-wrap justify-content-center">
														<?php if (!empty($tambahan_images) && is_array($tambahan_images)): ?>
															<?php foreach ($tambahan_images as $tambahan): ?>
																<img src="controller/<?php echo $tambahan; ?>" 
																	 alt="Gambar Tambahan" 
																	 class="img-thumbnail me-2 mb-2" 
																	 style="width: 100px; height: 100px; object-fit: cover;" 
																	 data-bs-toggle="modal" 
																	 data-bs-target="#uploadModal-tambahan" 
																	 onclick="showImage('controller/<?php echo $tambahan; ?>', 'Gambar Tambahan')">
															<?php endforeach; ?>
														<?php elseif (!empty($tambahan_images)): ?>
															<img src="controller/<?php echo $tambahan_images; ?>" 
																 alt="Gambar Tambahan" 
																 class="img-thumbnail me-2 mb-2" 
																 style="width: 100px; height: 100px; object-fit: cover;" 
																 data-bs-toggle="modal" 
																 data-bs-target="#uploadModal-tambahan" 
																 onclick="showImage('controller/<?php echo $tambahan_images; ?>', 'Gambar Tambahan')">
														<?php endif; ?>
													</div>
												</div>
											</div>
											
											<!-- Modal for uploading the image -->
											<div class="modal fade" id="uploadModal-utama" tabindex="-1" aria-hidden="true">
											  <div class="modal-dialog modal-lg">
												<div class="modal-content">
												  <div class="modal-header">
													<h5 class="modal-title" id="imageModalLabel">
													  <p class="mt-2">Gambar Utama</p>
													</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												  </div>
												  <div class="modal-body text-center">
													<img id="modalImage-utama" src="controller/<?php echo $utama_image; ?>" alt="Gambar Utama" class="img-fluid" style="max-width: auto; height: auto; object-fit: full;">
													<p id="imageDescription-utama" class="mt-2"></p>

													<!-- Input untuk memuat naik gambar baru -->
													<div class="mt-3">
													  <label for="imageUpload-utama" class="form-label">Kemaskini Gambar Utama</label>
													  <input type="file" id="imageUpload-utama" name="imageUpload" class="form-control" accept="image/*">
													</div>
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
													<button type="button" class="btn btn-primary" onclick="updateImage('utama')">Kemas Kini Gambar</button>
												  </div>
												</div>
											  </div>
											</div>

											<!-- Modal for Banner Image -->
											<div class="modal fade" id="uploadModal-banner" tabindex="-1" aria-hidden="true">
											  <div class="modal-dialog modal-lg">
												<div class="modal-content">
												  <div class="modal-header">
													<h5 class="modal-title" id="imageModalLabel">
													  <p class="mt-2">Gambar Banner</p>
													</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												  </div>
												  <div class="modal-body text-center">
													<img id="modalImage-banner" src="controller/<?php echo $banner_image; ?>" alt="Gambar Banner" class="img-fluid" style="max-width: auto; height: auto; object-fit: full;">
													<p id="imageDescription-banner" class="mt-2"></p>

													<!-- Input untuk memuat naik gambar baru -->
													<div class="mt-3">
														<label for="imageUpload-banner" class="form-label">Kemaskini Gambar Banner</label>
														<input type="file" id="imageUpload-banner" name="imageUpload" class="form-control" accept="image/*">
													</div>
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
													<button type="button" class="btn btn-primary" onclick="updateImage('banner')">Kemas Kini Gambar</button>
												  </div>
												</div>
											  </div>
											</div>

											<!-- Modal for Additional Images -->
											<div class="modal fade" id="uploadModal-tambahan" tabindex="-1" aria-hidden="true">
											  <div class="modal-dialog modal-lg">
												<div class="modal-content">
												  <div class="modal-header">
													<h5 class="modal-title" id="imageModalLabel">
													  <p class="mt-2">Gambar Tambahan</p>
													</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												  </div>
												  <div class="modal-body text-center">
													<?php if (!empty($tambahan_images) && is_array($tambahan_images)): ?>
														<div class="mb-2">
															<?php foreach ($tambahan_images as $tambahan): ?>
																<div class="d-inline-block text-center me-2">
																	<img src="controller/<?php echo $tambahan; ?>" 
																		 alt="Gambar Tambahan" 
																		 class="img-tambahan" 
																		 data-bs-toggle="modal" 
																		 data-bs-target="#uploadModal-tambahan" 
																		 onclick="showImage('controller/<?php echo $tambahan; ?>', 'Gambar Tambahan')">
																</div>
															<?php endforeach; ?>
														</div>
													<?php elseif (!empty($tambahan_images)): ?>
														<div class="mb-2">
															<img src="controller/<?php echo $tambahan_images; ?>" 
																 alt="Gambar Tambahan" 
																 class="img-tambahan" 
																 data-bs-toggle="modal" 
																 data-bs-target="#uploadModal-tambahan" 
																 onclick="showImage('controller/<?php echo $tambahan_images; ?>', 'Gambar Tambahan')">
														</div>
													<?php endif; ?>
													<p id="imageDescription-tambahan" class="mt-2"></p>

													<!-- Input untuk memuat naik gambar baru -->
													<div class="mt-3">
														<label for="imageUpload-tambahan" class="form-label">Kemaskini Gambar Tambahan</label>
														<input type="file" id="imageUpload-tambahan" name="imageUpload" class="form-control" accept="image/*" multiple>
													</div>
												</div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
													<button type="button" class="btn btn-primary" onclick="updateImage('tambahan')">Kemas Kini Gambar</button>
												  </div>
												</div>
											  </div>
											</div>
										</div>
										
										
                                        <div class="row mb-3 mt-5">
                                            <label for="id_aktiviti" class="col-3 col-form-label">ID Aktiviti</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="id_aktiviti" name="id_aktiviti"
                                                    value="<?php echo $id_aktiviti; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="nama_aktiviti" class="col-3 col-form-label">Nama Aktiviti</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="nama_aktiviti"
                                                    name="nama_aktiviti" value="<?php echo $nama_aktiviti;?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="kadar_harga" class="col-3 col-form-label">Kadar Harga (RM)</label>
                                            <div class="col-9">
                                                <input type="number" step="0.01" class="form-control" id="kadar_harga"
                                                    name="kadar_harga" value="<?php echo $kadar_harga;?>" min="1"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="penerangan" class="col-3 col-form-label">Penerangan</label>
                                            <div class="col-9">
                                                <textarea class="form-control" id="penerangan" name="penerangan"
                                                    rows="4" required><?php echo $penerangan; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="penerangan_kemudahan" class="col-3 col-form-label">Penerangan Kemudahan</label>
                                            <div class="col-9">
                                                <textarea class="form-control" id="penerangan_kemudahan" name="penerangan_kemudahan"
                                                    rows="3" required><?php echo $penerangan_kemudahan; ?></textarea>
                                            </div>
                                        </div>
										 <div class="row mb-5">
                                            <label for="status_aktiviti" class="col-3 col-form-label">Status</label>
                                            <div class="col-9">
                                                <select class="form-control" id="status_aktiviti" name="status_aktiviti" value="<?php echo $status_aktiviti;?>" required>
													<option value="tersedia" <?php echo ($status_aktiviti == 'tersedia') ? 'selected' : ''; ?>>Tersedia</option>
													<option value="tidak tersedia" <?php echo ($status_aktiviti == 'tidak tersedia') ? 'selected' : ''; ?>>Tidak Tersedia</option>
												</select>
                                            </div>
                                        </div>
										
										<div class="row mb-3">
											<label class="col-3 col-form-label">Kemudahan</label>
											<div class="col-9">
												<div class="row g-2">
													<?php
													$id_aktiviti = $_GET['id_aktiviti'];

													$selected_kemudahan_query = "
														SELECT id_kemudahan 
														FROM aktiviti_kemudahan 
														WHERE id_aktiviti = '$id_aktiviti'
													";
													$selected_kemudahan_result = $conn->query($selected_kemudahan_query);

													$selected_kemudahan = [];
													if ($selected_kemudahan_result->num_rows > 0) {
														while ($row = $selected_kemudahan_result->fetch_assoc()) {
															$selected_kemudahan[] = $row['id_kemudahan'];
														}
													}

													$query = "SELECT id_kemudahan, nama, icon_url FROM kemudahan";
													$result = $conn->query($query);

													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$id_kemudahan = $row['id_kemudahan'];
															$nama = $row['nama'];
															$icon_url = $row['icon_url'];

															$checked = in_array($id_kemudahan, $selected_kemudahan) ? 'checked' : '';

															echo '<div class="col-md-4">';
															echo '<div class="form-check">';
															echo '<input class="form-check-input" type="checkbox" name="kemudahan[]" value="' . $id_kemudahan . '" id="kemudahan_' . $id_kemudahan . '" ' . $checked . '>';
															echo '<label class="form-check-label d-flex align-items-center" for="kemudahan_' . $id_kemudahan . '">';

															if ($icon_url) {
																echo '<img src="../' . $icon_url . '" alt="' . $nama . '" style="height: 25px; margin-right: 10px;">';
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
                                       
                                        <div class="justify-content-end row text-end mt-3">
                                            <div class="col-9">
                                                <button type="submit" class="btn btn-info">Kemaskini</button>
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
	
	<script>
	function showImage(imageUrl, description) {
		// Dynamically set image source and description based on clicked image
		const modalImage = document.getElementById('modalImage-' + description.toLowerCase());
		const imageDescription = document.getElementById('imageDescription-' + description.toLowerCase());

		modalImage.src = imageUrl;
		imageDescription.textContent = description;

		// Update image upload name based on the type of image
		document.getElementById('imageUpload-' + description.toLowerCase()).setAttribute('name', description.toLowerCase());
	}
	</script>
	
	<script>
	function updateImage(imageType) {
		const fileInput = document.getElementById(`imageUpload-${imageType}`);
		const imageFile = fileInput.files[0];

		if (!imageFile) {
			alert('Sila pilih gambar terlebih dahulu.');
			return;
		}

		const formData = new FormData();
		formData.append('imageUpload', imageFile);
		formData.append('image_type', imageType);

		const idAktiviti = <?php echo $_GET['id_aktiviti']; ?>;

		fetch(`controller/imageUpdated.php?id_aktiviti=${idAktiviti}`, {
			method: 'POST',
			body: formData
		})
			.then(response => response.text())
			.then(data => {
				if (data.trim() === "success") {
					alert("Gambar telah dikemaskini!");
					const modalId = `uploadModal-${imageType}`;
					const modal = document.getElementById(modalId);
					const modalInstance = bootstrap.Modal.getInstance(modal); // Bootstrap modal instance
					modalInstance.hide(); // Close the modal
					setTimeout(() => {
						location.reload(); // Refresh the page
					}, 500);
				} else {
					alert(data); // Display error message
				}
			})
			.catch(error => {
				console.error('Error:', error);
				alert('There was an error updating the image.');
			});
	}
	</script>

</body>

</html>