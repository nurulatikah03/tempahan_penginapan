<?php session_start(); ?>
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
	<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
	<link rel="stylesheet" href="assets/css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<style>
	.preview-link {
			position: relative;
			display: inline-block;
			text-decoration: none;
		}

		.preview-image {
			max-width: 200px;
			max-height: 200px;
			object-fit: cover;
			border-radius: 25px;
			transition: opacity 0.3s;
		}

		.remove-button {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			background-color: rgba(255, 0, 0, 0.7);
			color: white;
			padding: 5px 10px;
			border-radius: 5px;
			opacity: 0;
			transition: opacity 0.3s;
			pointer-events: none;
		}

		.preview-link:hover .preview-image {
			opacity: 0.7;
		}

		.preview-link:hover .remove-button {
			opacity: 1;
			pointer-events: auto;
		}

		.preview-box {
			position: relative;
		}

		.preview-box .delete-btn {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			background-color: rgba(255, 0, 0, 0.7);
			color: white;
			padding: 5px 10px;
			border-radius: 5px;
			opacity: 0;
			transition: opacity 0.3s;
			pointer-events: none;
			z-index: 2;
		}

		.preview-box:hover .preview-link img {
			opacity: 0.7;
		}

		.preview-box:hover .delete-btn {
			opacity: 1;
			pointer-events: auto;
		}
	</style>
</head>

<body class="" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
	<!-- Begin page -->
	<div class="wrapper">

		<?php include 'partials/left-sidemenu.php'; ?>

		<div class="content-page">
			<div class="content">

				<?php include 'partials/topbar.php';
				include_once '../Models/pekejPerkahwinan.php';
				include_once '../Models/dewan.php';
				$dewans = dewan::getAllDewan();
				$pekej = PekejPerkahwinan::getPekejPerkahwinanById($_GET['id_perkahwinan']) ?>

				<!-- Start Content-->
				<div class="container-fluid">

					<!-- start page title -->
					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								<div class="page-title-right">
									<ol class="breadcrumb m-0">
										<li class="breadcrumb-item"><a href="perkahwinan.php">Perkahwinan</a></li>
										<li class="breadcrumb-item"><?php echo $pekej->getNamaPekej(); ?></a></li>
										<li class="breadcrumb-item active">Kemaskini</li>
									</ol>
								</div>
								<h4 class="page-title">Kemaskini Pakej Perkahwinan</h4>
							</div>
						</div>
					</div>
					<!-- end page title -->


					<div class="row">
						<div class="col-12">
							<h2 class="text-center mt-4">Kemaskini Gambar Perkahwinan</h2>
							<div class="card" style="border-radius: 25px;">
								<div class="card-body">
									<div>
										<!-- PICTURE -->
										<div class="images">
											<div class="row mb-3">
												<div class="col-4 img-content-text" style="height: 425px;">
													<h3>Image main</h3>
													<!-- TRIGGER Edit -->
													<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-1">
														<div class="action-icon swap">
															<img src="assets/icon-svg/swap.svg" alt="swap Icon" style="height: 30px;">
														</div>
														<img src="../<?php echo $pekej->getGambarMainKahwin(); ?>" alt="Main Image" class="img-fluid" style="border-radius:25px; height: 100%; width: 100%; object-fit: cover;">
													</a>
												</div>
												<div class="col-8">
													<div class="row" style="height: 200px; width:auto">
														<div class="col-12 img-content-text">
															<h3>Banner</h3>
															<!-- TRIGGER Edit -->
															<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-2">
																<div class="action-icon swap">
																	<img src="assets/icon-svg/swap.svg" alt="swap Icon" style="height: 30px;">
																</div>
																<img src="../<?php echo $pekej->getGambarBannerKahwin(); ?>" alt="ImgBanner" class="img-fluid" style="border-radius:25px; height: 200px; width: 100%; object-fit: cover;">
															</a>
														</div>
													</div>
													<div class="row">
														<?php $imgList = $pekej->getGambarAddKahwin();
														for ($i = 0; $i < 3; $i++): ?>
															<div class="col-3 pt-2 img-content-text" style="height: 225px;">
																<?php if (!empty($imgList[$i])): ?>
																	<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-3">
																		<div class="action-icon swap">
																			<img src="assets/icon-svg/swap.svg" alt="swap Icon" style="height: 30px;">
																		</div>
																		<img src="../<?php echo $imgList[$i]; ?>" alt="Additional Image <?php echo $i + 1; ?>" class="img-fluid" style="border-radius:25px; height: 100%; width: 100%; object-fit: cover;">
																	</a>
																<?php elseif ($i == 0): ?>
																	<h2 style="overflow: visible; text-align: center; margin-top: 70px; white-space: nowrap;"><strong>~No Image Available</strong></h2>
																<?php endif; ?>
															</div>
														<?php endfor; ?>

														<?php if (count($imgList) > 3): ?>
															<div class="col-3 pt-2 more-images" style="position: relative;">
																<img src="../<?php echo $imgList[3]; ?>" alt="View More Image" class="img-fluid" style="border-radius:25px; height: 213px; width: 100%; object-fit: cover;">
																<?php if (count($imgList) > 4): ?>
																	<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-3">
																		<div class="overlay">
																			+<?php echo count($imgList) - 4; ?> gambar
																		</div>
																	</a>
																<?php endif; ?>
															</div>
														<?php endif; ?>
													</div>
												</div>
											</div>
										</div>
										<div>
											<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-1">
												<button type="button" class="btn btn-primary rounded-button">Kemaskini Gambar Utama</button>
											</a>
											<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-2">
												<button type="button" class="btn btn-primary rounded-button">Kemaskini Gambar Banner</button>
											</a>
											<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-3">
												<button type="button" class="btn btn-primary rounded-button">Kemaskini Gambar Tambahan</button>
											</a>
										</div>
									</div>
									<?php
									if (isset($_SESSION['status'])) {
										echo '<div class="alert alert-success" role="alert">' . $_SESSION['status'] . '.</div>';
										unset($_SESSION['status']);
									}
									?>
								</div>
							</div>

							<!-- Kemaskini Details Perkahwinan -->
							<h2 class="text-center mt-4">Kemaskini Maklumat Pekej Perkahwinan</h2>
							<div class="card" style="border-radius: 25px;">
								<div class="card-body">
									<form class="form-horizontal" method="post" action="controller/kemaskiniPerkahwinan_process.php" enctype="multipart/form-data">
										<div class="row mb-3">
											<label for="id_perkahwinan" class="col-3 col-form-label">Perkahwinan ID</label>
											<div class="col-9">
												<input type="text" class="form-control" id="id_perkahwinan" name="id_perkahwinan" value="<?php echo $pekej->getIdPekej(); ?>" readonly>
											</div>
										</div>
										<div class="row mb-3">
											<label for="namaPekej" class="col-3 col-form-label">Nama Pekej</label>
											<div class="col-9">
												<input type="text" class="form-control" id="namaPekej" name="nama_Pekej" value="<?php echo $pekej->getNamaPekej(); ?>" required>
											</div>
										</div>
										<div class="row mb-3">
											<label class="col-3 col-form-label">Nama Dewan</label>
											<div class="col-9">
												<select class="form-control" id="nama_dewan" name="id_dewan" required>
													<?php foreach ($dewans as $dewan) { ?>
														<option value="<?php echo $dewan->getIdDewan(); ?>" <?php echo ($dewan->getIdDewan() == $pekej->getIdDewan()) ? 'selected' : ''; ?>>
															<?php echo $dewan->getNamaDewan(); ?>
														</option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="row mb-3">
											<label for="kadar_harga" class="col-3 col-form-label">Kadar Harga(RM)</label>
											<div class="col-9">
												<input type="number" class="form-control" id="kadar_harga" name="kadar_harga" value="<?php echo $pekej->getHargaPekej(); ?>" min="1" step="1" required>
											</div>
										</div>
										<div class="row mb-3">
											<label for="penerangan" class="col-3 col-form-label">Penerangan pendek</label>
											<div class="col-9">
												<textarea class="form-control" id="penerangan" name="penerangan_pendek" rows="4" required><?php echo $pekej->getPeneranganPendek(); ?></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<label for="penerangan" class="col-3 col-form-label">Penerangan panjang</label>
											<div class="col-9">
												<textarea class="form-control" id="penerangan" name="penerangan_panjang" rows="4" required><?php echo $pekej->getPeneranganPenuh(); ?></textarea>
											</div>
										</div>
										<div class="justify-content-end row">
											<div class="col-9">
												<button type="submit" name="process" value="kemaskiniDetailPerkahwinan" class="btn btn-info">Kemaskini</button>
											</div>
										</div>
									</form>
								</div> <!-- end card-body-->
							</div> <!-- end card-->
						</div> <!-- end col -->
					</div>
					<!-- end row -->
					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								<h2>Kemaskini Add ons</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="card" style="border-radius: 25px;">
								<div class="card-body">
									<form class="form-horizontal" method="post" action="controller/kemaskiniPerkahwinan_process.php">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Nama Add on</th>
													<th>Harga (RM)</th>
													<th class="text-center">Padam</th>
												</tr>
											</thead>
											<tbody>
												<?php $addOns = PekejPerkahwinan::getAllAddOn();
												foreach ($addOns as $addOn) { ?>
													<tr>
														<td><input type="text" class="form-control" name="add_on_nama[]" value="<?php echo $addOn['add_on_nama']; ?>" required></td>
														<td><input type="number" class="form-control" name="harga[]" value="<?php echo $addOn['harga']; ?>" min="0" step="1" required></td>
														<input type="hidden" name="id_addon[]" value="<?php echo $addOn['add_on_id']; ?>">
														<td class="text-center"><a href="#" class="action-icon" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $addOn['add_on_id']; ?>"><i class="mdi mdi-delete" style="color: red;"></i></a></td>
													</tr>
													<!-- Modal -->
													<div class="modal fade modal-backdrop-del" id="deleteModal<?php echo $addOn['add_on_id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $addOn['add_on_id']; ?>" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
																<div class="modal-body">
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 25px; top: 25px;"></button>
																	<div class="text-center p-4">
																		<img src="assets/icon-svg/alert.svg" alt="Alert Icon" class="mb-3" style="height: 100px">
																	</div>
																	<div class="text-center">
																		<h1 class="modal-title fs-5" id="deleteModalLabel">Padam <?php echo $addOn['add_on_nama']; ?></h1>

																		<p class="pt-3"> Tindakan tidak boleh undur semula. </p>
																	</div>
																	<form action="controller/kemaskiniPerkahwinan_process.php" method="post">
																		<input type="hidden" name="addon_id" value="<?php echo $addOn['add_on_id']; ?>">
																		<div class="text-center">
																			<button type="button" class="btn btn-secondary rounded-button" data-bs-dismiss="modal">Tidak, Kembali semula.</button>
																			<button type="submit" name="process" value="delAddon" class="btn btn-danger rounded-button">Ya, Padam</button>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div>
												<?php } ?>
											</tbody>
										</table>
										<button type="submit" name="process" value="kemaskiniAddOn" class="btn btn-info">Kemaskini</button>
										<button type="button" class="btn btn-success" id="tambahRow">Tambah</button>

									</form>


								</div> <!-- end card-body-->
							</div> <!-- end card-->
						</div> <!-- end col -->
					</div>

				</div> <!-- container -->

			</div> <!-- content -->
			<!-- Add Add-On Modal -->
			<div class="modal fade" id="addAddOnModal" tabindex="-1" aria-labelledby="addAddOnModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
						<div class="modal-header">
							<h5 class="modal-title" id="addAddOnModalLabel">Tambah Add On</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<form id="addAddOnForm" method="post" action="controller/kemaskiniPerkahwinan_process.php">
								<div class="mb-3">
									<label for="add_on_nama" class="form-label">Nama Add On</label>
									<input type="text" class="form-control" id="add_on_nama" name="add_on_nama" required>
								</div>
								<div class="mb-3">
									<label for="harga" class="form-label">Harga (RM)</label>
									<input type="number" class="form-control" id="harga" name="harga" min="0" step="0.01" required>
								</div>
								<div class="text-end">
									<input type="hidden" name="id_pekej" value="<?php echo $pekej->getIdPekej(); ?>">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
									<button type="submit" name="process" value="addAddon" class="btn btn-primary">Tambah</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- start edit MODAL -->
			<div class="modal fade modal-backdrop-edit" id="uploadModal-1" tabindex="-1">
				<div class="modal-dialog modal-lg-custom">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="uploadModalLabel">Tukar Gambar Utama</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>
						<div class="modal-body">
							<!-- Main image preview 1-->
							<div class="text-center mt-1 mb-3">
								<h3>Gambar sekarang</h3>
							</div>
							<div class="preview-container">
								<img src="../<?php echo $pekej->getGambarMainKahwin(); ?>" class="img-responsive" id="mainImage" style="border-radius: 25px;">
							</div>

							<form id="upload-form-1" action="controller/kemaskiniPerkahwinan_process.php" method="post" enctype="multipart/form-data">
								<div id="new-image-message-1" class="text-center mt-1 mb-3" style="display: none;">
									<h3>Gambar baru</h3>
								</div>
								<div class="text-center">
									<div id="drop-area-1" class="drop-area">Tarik atau Tekan gambar baru</div>
									<input type="file" id="fileElem-1" accept="image/jpeg, image/png, image/jpg" style="display:none" name="file">
								</div>
								<input type="hidden" name="URLgambarLama" value="<?php echo $pekej->getGambarMainKahwin(); ?>">
								<input type="hidden" name="process" value="UpdateImageMainAndBanner">
								<input type="hidden" name="imgType" value="main">
								<input type="hidden" name="idPekej" value="<?php echo $pekej->getIdPekej(); ?>">
								<button type="submit" name="Submit" class="btn btn-primary rounded-button">Tukar Gambar Utama</button>
							</form>

						</div>
					</div>
				</div>
			</div>

			<div class="modal fade modal-backdrop-edit" id="uploadModal-2" tabindex="-1">
				<div class="modal-dialog modal-lg-custom">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="uploadModalLabel">Tukar Gambar Banner</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>
						<div class="modal-body">
							<!-- Banner image preview -->
							<div class="text-center mt-1 mb-3">
								<h3>Gambar sekarang</h3>
							</div>
							<div class="preview-container" style="width: 800px; height:auto; margin: 0 auto;">
								<img src="../<?php echo $pekej->getGambarBannerKahwin(); ?>" class="img-responsive" style="border-radius: 25px;">
							</div>
							<div class="text-center mt-3 mb-1">
								<div id="new-image-message-2" class="text-center m-0 p-0" style="display: none;">
									<h3>Gambar Banner baru</h3>
								</div>
							</div>
							<form id="upload-form-2" action="controller/kemaskiniPerkahwinan_process.php" method="post" enctype="multipart/form-data">
								<div class="text-center">
									<div id="drop-area-2" class="drop-area">Tarik atau Tekan gambar baru</div>
									<input type="file" id="fileElem-2" accept="image/*" style="display:none" name="file">
								</div>
								<div id="preview-container-2" class="preview-container"></div>
								<input type="hidden" name="URLgambarLama" value="<?php echo $pekej->getGambarBannerKahwin(); ?>">
								<input type="hidden" name="idPekej" value="<?php echo $pekej->getIdPekej(); ?>">
								<input type="hidden" name="process" value="UpdateImageMainAndBanner">
								<input type="hidden" name="imgType" value="banner">
								<button type="submit" name="Submit" class="btn btn-primary rounded-button">Tukar Gambar Banner</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade modal-backdrop-edit" id="uploadModal-3" tabindex="-1">
				<div class="modal-dialog modal-lg-custom">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="uploadModalLabel">Ubah Gambar Tambahan</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>
						<div class="modal-body">
							<!-- Image slots -->
							<?php if (!empty($imgList[0])): ?>
								<div class="text-center mt-1 mb-3">
									<h3>Gambar Tambahan Sekarang</h3>
								</div>
							<?php endif; ?>
							<div class="row justify-content-center">
								<?php for ($i = 0; $i < count($imgList); $i++): ?>
									<div class="col-4 d-flex justify-content-center align-items-center img-content-text mb-3">
										<div class="position-relative preview-link" style="border: 2px solid #ccc; border-radius: 25px; height: 250px; width: 250px; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
											<?php if (!empty($imgList[$i])): ?>
												<img src="<?php echo "../" . ($imgList[$i]); ?>"
													class="img-fluid"
													style="width: 100%; height: 100%; object-fit: cover;">
											<?php endif; ?>
											<!-- Replace the form with modal trigger button -->
											<button type="button" class="btn btn-danger btn-sm position-absolute remove-button" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal<?php echo $i; ?>">
												Padam
											</button>
										</div>
									</div>
								<?php endfor; ?>
							</div>
							<div class="text-center mt-1 mb-3">
								<h3>Tambah Gambar disini</h3>
							</div>
							<form id="upload-form-3" action="controller/kemaskiniPerkahwinan_process.php" method="post" enctype="multipart/form-data">
								<!-- Container for both previews and upload box -->
								<div class="d-flex justify-content-start align-items-start flex-wrap gap-3">
									<!-- Preview container for uploaded images -->
									<div id="imagePreviewContainer" class="d-flex flex-wrap gap-3">
										<!-- Previews will be inserted here dynamically -->
									</div>

									<!-- Upload box -->
									<div class="preview-box">
										<label for="fileElemAdd" style="cursor: pointer;">
											<div id="previewAdd" class="image-preview" style="border: 2px dashed #ccc; border-radius: 25px; height: 250px; width: 250px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
												<span style="font-size: 24px; color: #999;">+</span>
												<input type="file" id="fileElemAdd"
													name="images[]"
													accept="image/png, image/jpeg, image/jpg, image.webp"
													style="display: none;"
													multiple
													onchange="handleFileSelect(this)">
											</div>
										</label>
									</div>
								</div>

								<div class="text-center mt-3">
									<input type="hidden" name="idPekej" value="<?php echo $pekej->getIdPekej(); ?>">
									<input type="hidden" name="process" value="UpdateImageAdd">
									<input type="hidden" name="imgType" value="add">
									<button type="submit" name="Submit" class="btn btn-primary rounded-button">Kemaskini Gambar Tambahan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<?php for ($i = 0; $i < count($imgList); $i++): ?>
				<div class="modal fade modal-backdrop-del" id="deleteConfirmModal<?php echo $i; ?>" tabindex="-1" aria-labelledby="deleteConfirmModalLabel">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 25px; top: 25px;"></button>
								<div class="text-center p-4">
									<img src="assets/icon-svg/alert.svg" alt="Alert Icon" class="mb-2" style="height: 100px">
									<h1 class="modal-title fs-5">Padam Gambar ini?</h1>
								</div>
								<div class="text-center">
									<?php if (!empty($imgList[$i])): ?>
										<img src="<?php echo "../" . ($imgList[$i]); ?>"
											class="img-fluid"
											style="width: 100%; height: 100%; object-fit: cover; border-radius:25px">
									<?php endif; ?>
									<p class="pt-3"> Tindakan tidak boleh undur semula. </p>
								</div>
								<div class="text-center">
									<button type="button" class="btn btn-secondary rounded-button" data-bs-toggle="modal" data-bs-target="#uploadModal-3">Tidak, Kembali semula.</button>
									<form action="controller/kemaskiniPerkahwinan_process.php" method="post" class="d-inline">
										<input type="hidden" name="imgType" value="add">
										<input type="hidden" name="idPekej" value="<?php echo $pekej->getIdPekej(); ?>">
										<input type="hidden" name="URLgambar" value="<?php echo $imgList[$i] ?>">
										<button type="submit" name="process" value="DeleteImage" class="btn btn-danger rounded-button">Ya, Padam</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endfor; ?>

			<script>
				document.getElementById('tambahRow').addEventListener('click', function() {
					var addOnModal = new bootstrap.Modal(document.getElementById('addAddOnModal'));
					addOnModal.show();
				});
			</script>

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
	<script src="assets/js/imagesScript.js"></script>

	<!-- third party js ends -->

	<!-- demo app -->
	<script src="assets/js/pages/demo.products.js"></script>
	<!-- end demo js-->

</body>

</html>