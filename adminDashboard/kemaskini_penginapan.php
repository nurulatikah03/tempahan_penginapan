<?php
require_once __DIR__ . '/require/UserAUTH.php';
require_once __DIR__ . '/require/onlyAdminView.php';

try {

	include_once '../Models\room.php';
	$penginapan_id = $_GET['penginapan_id'];
	$room = Room::getRoomById($penginapan_id);
	$imgList = $room->getImgList();
} catch (Exception $e) {
	die("Error loading room: " . $e->getMessage());
} ?>
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
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="assets/css/style.css">
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

<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
	<!-- Begin page -->
	<div class="wrapper">

		<?php include 'partials/left-sidemenu.php'; ?>

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
										<li class="breadcrumb-item"><a href="penginapan.php">Penginapan</a></li>
										<li class="breadcrumb-item"><?php echo $room->getName(); ?></a></li>
										<li class="breadcrumb-item active">Kemaskini</li>
									</ol>
								</div>
								<h4 class="page-title">Kemaskini Kemudahan Penginapan</h4>
							</div>
						</div>
					</div>
					<!-- end page title -->
					<h2 class="text-center mt-4">Kemaskini Maklumat bilik</h2>
					<div class="card" style="border-radius: 25px;">
						<div class="card-body">
							<div>
								<!-- PICTURE -->
								<div class="images">
									<div class="row mb-3">
										<div class="col-4 img-content-text" style="height: 425px;">
											<h3>Gambar Utama</h3>
											<!-- TRIGGER Edit -->
											<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-1">
												<div class="action-icon swap">
													<img src="assets/icon-svg/swap.svg" alt="swap Icon" style="height: 30px;">
												</div>
												<img src="../<?php echo $room->getImgMain(); ?>" alt="Main Image" class="img-fluid" style="border-radius:25px; height: 100%; width: 100%; object-fit: cover;">
											</a>
										</div>
										<div class="col-8">
											<div class="row" style="height: 200px; width:auto">
												<div class="col-12 img-content-text">
													<h3>Gambar Banner</h3>
													<!-- TRIGGER Edit -->
													<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-2">
														<div class="action-icon swap">
															<img src="assets/icon-svg/swap.svg" alt="swap Icon" style="height: 30px;">
														</div>
														<img src="../<?php echo $room->getImgBanner(); ?>" alt="ImgBanner" class="img-fluid" style="border-radius:25px; height: 200px; width: 100%; object-fit: cover;">
													</a>
												</div>
											</div>
											<div class="row">
												<?php for ($i = 0; $i < 3; $i++): ?>
													<div class="col-3 pt-2 img-content-text" style="height: 225px;">
														<?php if (!empty($imgList[$i])): ?>
															<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-3">
																<div class="action-icon swap">
																	<img src="assets/icon-svg/swap.svg" alt="swap Icon" style="height: 30px;">
																</div>
																<img src="../<?php echo $imgList[$i]; ?>" alt="Additional Image <?php echo $i + 1; ?>" class="img-fluid" style="border-radius:25px; height: 100%; width: 100%; object-fit: cover;">
															</a>
														<?php elseif ($i == 0): ?>
															<h2 style="overflow: visible; text-align: center; margin-top: 70px; white-space: nowrap;"><strong>~Tiada gambar tambahan</strong></h2>
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
								echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . $_SESSION['status'];
								echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
								echo '</div>';
								unset($_SESSION['status']);
							} elseif (isset($_SESSION['error'])) {
								echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $_SESSION['error'];
								echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
								echo '</div>';
								unset($_SESSION['error']);
							}
							?>
						</div>
					</div>
					<h2 class="text-center mt-4">Kemaskini Maklumat bilik</h2>
					<div class="card" style="border-radius: 25px;">
						<div class="card-body">

							<!-- Form for updating the room details -->
							<form class="form-horizontal" method="post" action="controller/kemaskiniPenginapan_process.php">
								<div class="row my-3">
									<label for="nama_penginapan" class="col-3 col-form-label">Nama bilik</label>
									<div class="col-3">
										<input type="text" class="form-control" id="nama_penginapan" name="nama_penginapan" value="<?php echo $room->getName(); ?>" required>
									</div>
									<label for="jenis_bilik" class="col-3 col-form-label">Jenis Bilik</label>
									<div class="col-3">
										<input type="text" class="form-control" id="jenis_bilik" name="jenis_bilik" value="<?php echo ucfirst($room->getType()); ?>" required>
									</div>
								</div>
								<div class="row mb-3">
									<label for="jumlah_bilik" class="col-3 col-form-label">Jumlah Bilik</label>
									<div class="col-9">
										<input type="number" class="form-control" id="jumlah_bilik" name="jumlah_bilik" value="<?php echo $room->getMaxCapacity(); ?>" min="1" required>
									</div>
								</div>
								<div class="row mb-3">
									<label for="kadar_sewa" class="col-3 col-form-label">Kadar Sewa (RM)</label>
									<div class="col-9">
										<input type="number" class="form-control" id="kadar_sewa" name="kadar_sewa" value="<?php echo $room->getPrice(); ?>" min="1" required>
									</div>
								</div>
								<div class="row mb-3">
									<label for="bilanganPenyewa" class="col-3 col-form-label">Bilangan Penyewa per Bilik (Orang)</label>
									<div class="col-9">
										<input type="number" class="form-control" id="bilanganPenyewa" name="bilanganPenyewa" value="<?php echo $room->getCapacity(); ?>" min="1" required>
									</div>
								</div>
								<div class="row mb-3">
									<label for="penerangan_panjang" class="col-3 col-form-label">Penerangan panjang</label>
									<div class="col-9">
										<textarea class="form-control" id="penerangan_panjang" name="penerangan_panjang" rows="4" required><?php echo $room->getLongDesc(); ?></textarea>
									</div>
								</div>
								<div class="row mb-3">
									<label for="penerangan_pendek" class="col-3 col-form-label">Penerangan pendek</label>
									<div class="col-9">
										<textarea class="form-control" id="penerangan_pendek" name="penerangan_pendek" rows="4" required><?php echo $room->getShortDesc(); ?></textarea>
									</div>
								</div>
								<div class="row mb-3">
									<label for="penerangan_kemudahan" class="col-3 col-form-label">Penerangan kemudahan</label>
									<div class="col-9">
										<textarea class="form-control" id="penerangan_kemudahan" name="penerangan_kemudahan" rows="4" required><?php echo $room->getAmenDesc(); ?></textarea>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-3 col-form-label">Kemudahan</label>
									<div class="col-9">
										<div class="row">
											<?php $aminities = (Room::getAllAminities()) ?>
											<?php foreach ($aminities as $aminity): ?>
												<div class="col-4 pb-2">
													<div class="form-check">
														<input class="form-check-input" type="checkbox" name="kemudahan[]" value="<?php echo $aminity['name']; ?>" id="<?php echo $aminity['name']; ?>" <?php echo in_array($aminity['name'], array_column((array)$room->getAminitiesList(), 'name')) ? 'checked' : ''; ?>>
														<label class="form-check-label" for="<?php echo $aminity['name']; ?>">
															<img src="../<?php echo $aminity['icon_url']; ?>" alt="<?php echo $aminity['name']; ?>" style="height: 25px; margin-right: 5px;">
															<?php echo $aminity['name']; ?>
														</label>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
								<div class="justify-content-end row">
									<div class="col-9">
										<input type="hidden" name="penginapan_id" value="<?php echo $room->getId(); ?>">
										<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
										<input type="hidden" name="process" value="UpdateMetaData">
										<button type="submit" name="Submit" class="btn btn-info rounded-button m-0">Kemaskini Maklumat Bilik</button>
									</div>
								</div>
							</form>
						</div> <!-- end card-body-->
					</div> <!-- end card-->

					<!-- start edit table Unit -->
					<h2 class="text-center mt-4">Kemaskini Unit Bilik</h2>
					<div class="card" style="border-radius: 25px;">
						<div class="card-body">
							<?php $allRoomUnits = Room::getAllRoomUnits($room->getId()) ?>
							<div class="table-responsive">
								<form method="post" action="controller/updateRoomUnit.php">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>No</th>
												<th>Room Number</th>
												<th>Aras</th>
												<th>Status</th>
												<th>Tarikh Aktif Semula</th>
												<th class="text-center">Tindakan</th>
											</tr>
										</thead>
										<tbody>
											<?php $allStatus = array('aktif', 'tak aktif', 'penyelenggaraan'); ?>
											<?php foreach ($allRoomUnits as $index => $roomUnit): ?>
												<tr>
													<td><?php echo $index + 1; ?></td>
													<td><input type="text" class="form-control" name="nombor_bilik[]" value="<?php echo $roomUnit['nombor_bilik']; ?>" required></td>
													<td><input type="number" class="form-control" name="aras[]" value="<?php echo $roomUnit['aras']; ?>" required></td>
													<td>
														<select class="form-control status-dropdown" name="status[]" id="statusBilik<?php echo $index + 1; ?>" data-index="<?php echo $index + 1; ?>">
															<?php foreach ($allStatus as $status): ?>
																<option value="<?php echo $status; ?>" <?php echo ($roomUnit['status_bilik'] == $status) ? 'selected' : ''; ?>>
																	<?php echo ucfirst($status); ?>
																</option>
															<?php endforeach; ?>
														</select>
													</td>
													<td>
														<input
															type="date"
															class="form-control tarikh-input"
															name="tarikh_aktif_semula[]"
															value="<?php echo !empty($roomUnit['tarikh_aktif_semula']) ? $roomUnit['tarikh_aktif_semula'] : ''; ?>"
															min="<?php echo date('Y-m-d'); ?>"
															id="tarikhAktifSemula<?php echo $index + 1; ?>"
															<?php echo $roomUnit['status_bilik'] != 'penyelenggaraan' ? 'readonly' : ''; ?>>
													</td>
													<input type="hidden" name="UB_id[]" value="<?php echo $roomUnit['id_ub']; ?>">
													<td class="text-center">
														<form action="controller/updateRoomUnit.php" method="POST">
															<input type="hidden" name="roomId" value="<?php echo $room->getId(); ?>">
															<input type="hidden" name="UB_idDel" value="<?php echo $roomUnit['id_ub']; ?>">
															<button type="submit" name="process" value="delRoom" class="btn btn-danger rounded-button" <?php echo count($allRoomUnits) <= 1 ? 'disabled' : ''; ?>>Padam</button>
														</form>
													</td>
												</tr>
											<?php endforeach; ?>
											<?php if (empty($allRoomUnits)): ?>
												<tr>
													<td colspan="6" class="text-center">Tiada Data Bilik</td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
									<div class="text-end">
										<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
										<button type="submit" name="process" value="updateRoomUnit" class="btn btn-info rounded-button m-0">Kemaskini Unit Bilik</button>
										<button type="button" data-bs-toggle="modal" data-bs-target="#modalTambahBilik" class="btn btn-success rounded-button m-0 ms-3">Tambah unit bilik</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div><!-- container -->
			</div> <!-- content -->
		</div><!-- content -->

		<!-- Modal  tambah Unit bilik-->
		<div class="modal fade modal-backdrop-edit" id="modalTambahBilik" tabindex="-1">
			<div class="modal-dialog modal-lg-custom">
				<div class="modal-content">
					<form action="controller/kemaskiniPenginapan_process.php" method="POST">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Unit Bilik</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<h4>Jumlah Bilik</h4>
							<input type="number" class="form-control" id="jumlahBilik" placeholder="Jumlah Bilik" min="1" max="100" required>
							<table class="table table-bordered mt-3">
								<thead>
									<tr>
										<th>Nombor Unit Bilik</th>
										<th>Aras</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="text" class="form-control" name="nomborUnitBilikAdd[]" placeholder="Nombor Unit Bilik" required></td>
										<td><input type="number" step="1" class="form-control" name="arasAdd[]" placeholder="Aras Bilik" required></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary rounded-button" data-bs-dismiss="modal">Tutup</button>
							<input type="hidden" name="roomId" value="<?php echo $room->getId(); ?>">
							<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
							<input type="hidden" name="process" value="addUnitBilik">
							<button type="submit" name="Submit" class="btn btn-primary rounded-button">Tambah unit bilik</button>
						</div>
					</form>
				</div>
			</div>
			<script>
				document.getElementById('jumlahBilik').addEventListener('input', function() {
					var jumlahBilik = Math.min(this.value, 100);
					this.value = jumlahBilik;

					var tableBody = document.querySelector('#modalTambahBilik table tbody');
					tableBody.innerHTML = '';

					for (var i = 0; i < jumlahBilik; i++) {
						var row = document.createElement('tr');

						var cell1 = document.createElement('td');
						var input1 = document.createElement('input');
						input1.type = 'text';
						input1.className = 'form-control';
						input1.name = 'nomborUnitBilikAdd[]';
						input1.placeholder = 'Nombor Unit Bilik';
						input1.required = true;
						cell1.appendChild(input1);

						var cell2 = document.createElement('td');
						var input2 = document.createElement('input');
						input2.type = 'number';
						input2.step = '1';
						input2.className = 'form-control';
						input2.name = 'arasAdd[]';
						input2.placeholder = 'Aras Bilik';
						input2.required = true;
						cell2.appendChild(input2);

						row.appendChild(cell1);
						row.appendChild(cell2);

						tableBody.appendChild(row);
					}
				});
			</script>

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
							<img src="../<?php echo $room->getImgMain(); ?>" class="img-responsive" id="mainImage" style="border-radius: 25px;">
						</div>

						<form id="upload-form-1" action="controller/kemaskiniPenginapan_process.php" method="post" enctype="multipart/form-data">
							<div id="new-image-message-1" class="text-center mt-1 mb-3" style="display: none;">
								<h3>Gambar baru</h3>
							</div>
							<div class="text-center">
								<div id="drop-area-1" class="drop-area">Tarik atau Tekan gambar baru</div>
								<input type="file" id="fileElem-1" accept="image/jpeg, image/png, image/jpg" style="display:none" name="file" required>
							</div>
							<input type="hidden" name="URLgambarLama" value="<?php echo $room->getImgMain(); ?>">
							<input type="hidden" name="process" value="UpdateImageMainAndBanner">
							<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
							<input type="hidden" name="imgType" value="main">
							<input type="hidden" name="roomId" value="<?php echo $room->getId(); ?>">
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
							<img src="../<?php echo $room->getImgBanner(); ?>" class="img-responsive" style="border-radius: 25px;">
						</div>
						<div class="text-center mt-3 mb-1">
							<div id="new-image-message-2" class="text-center m-0 p-0" style="display: none;">
								<h3>Gambar Banner baru</h3>
							</div>
						</div>
						<form id="upload-form-2" action="controller/kemaskiniPenginapan_process.php" method="post" enctype="multipart/form-data">
							<div class="text-center">
								<div id="drop-area-2" class="drop-area">Tarik atau Tekan gambar baru</div>
								<input type="file" id="fileElem-2" accept="image/*" style="display:none" name="file" required>
							</div>
							<div id="preview-container-2" class="preview-container"></div>
							<input type="hidden" name="URLgambarLama" value="<?php echo $room->getImgBanner(); ?>">
							<input type="hidden" name="roomId" value="<?php echo $room->getId(); ?>">
							<input type="hidden" name="process" value="UpdateImageMainAndBanner">
							<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
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
						<form id="upload-form-3" action="controller/kemaskiniPenginapan_process.php" method="post" enctype="multipart/form-data">
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
												required
												onchange="handleFileSelect(this)">
										</div>
									</label>
								</div>
							</div>

							<div class="text-center mt-3">
								<input type="hidden" name="roomId" value="<?php echo $room->getId(); ?>">
								<input type="hidden" name="process" value="UpdateImageAdd">
								<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
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
								<form action="controller/kemaskiniPenginapan_process.php" method="post" class="d-inline">
									<input type="hidden" name="process" value="DeleteImage">
									<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
									<input type="hidden" name="imgType" value="add">
									<input type="hidden" name="roomId" value="<?php echo $room->getId(); ?>">
									<input type="hidden" name="URLgambar" value="<?php echo $imgList[$i] ?>">
									<button type="submit" name="Submit" class="btn btn-danger rounded-button">Ya, Padam</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endfor; ?>

		<?php include 'partials/footer.php'; ?>
		<?php include 'partials/right-sidemenu.php'; ?>
	</div>
	<!-- END wrapper -->




	<!-- bundle -->
	<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/imagesScript.js"></script>
	<script src="assets/js/app.min.js"></script>

	<!-- third party js -->
	<script src="assets/js/vendor/jquery.dataTables.min.js"></script>
	<script src="assets/js/vendor/dataTables.bootstrap5.js"></script>
	<script src="assets/js/vendor/dataTables.responsive.min.js"></script>
	<script src="assets/js/vendor/responsive.bootstrap5.min.js"></script>
	<script src="assets/js/vendor/dataTables.checkboxes.min.js"></script>

	<!-- my js ends -->


	<!-- demo app -->
	<script src="assets/js/pages/demo.products.js"></script>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Get all status dropdowns
			const statusDropdowns = document.querySelectorAll('.status-dropdown');

			statusDropdowns.forEach(function(dropdown) {
				const index = dropdown.dataset.index;
				const tarikhInput = document.getElementById(`tarikhAktifSemula${index}`);

				dropdown.addEventListener('change', function() {
					if (this.value === 'penyelenggaraan') {
						tarikhInput.readOnly = false;
						tarikhInput.required = true;
					} else {
						tarikhInput.readOnly = true;
						tarikhInput.value = '';
					}
				});

				// Initialize the readonly state based on the default value
				if (dropdown.value !== 'penyelenggaraan') {
					tarikhInput.readOnly = true;
				}
			});
		});
	</script>

	<!-- end demo js-->
</body>

</html>