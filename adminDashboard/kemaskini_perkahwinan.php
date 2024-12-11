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
							<div class="card">
								<div class="card-body">
									<form class="form-horizontal" method="post" action="controller/process_Perkahwinan.php" enctype="multipart/form-data">
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
										<div class="row mb-3">
											<label for="fileinput" class="col-3 col-form-label">Muat Naik Gambar</label>
											<div class="col-9">
												<!-- Display the currently uploaded image if it exists -->
												<?php $gambar = $pekej->getGambarMainKahwin();
												if (!empty($gambar)): ?>
													<div class="mb-2">
														<img src="../<?php echo $gambar; ?>" alt="Gambar Sedia Ada" class="img-thumbnail" style="max-width: 150px;">
														<p>Gambar sedia ada: <?php echo $gambar; ?></p>
													</div>
												<?php endif; ?>

												<!-- File input for uploading a new image -->
												<input type="file" id="fileinput" name="fileinput" class="form-control" accept="image/*">
												<input type="hidden" name="URL_gambar_lama" value="<?php echo $gambar; ?>">
											</div>
										</div>
										<div class="justify-content-end row">
											<div class="col-9">
												<button type="submit" name="process" value="kemaskiniPerkahwinan" class="btn btn-info">Kemaskini</button>
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
								<h4 class="page-title">Kemaskini Add ons</h4>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="card">
								<div class="card-body">
									<form class="form-horizontal" method="post" action="controller/process_Perkahwinan.php">
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
																	<form action="controller\process_Perkahwinan.php" method="post">
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
							<form id="addAddOnForm" method="post" action="controller/process_Perkahwinan.php">
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

	<!-- third party js ends -->

	<!-- demo app -->
	<script src="assets/js/pages/demo.products.js"></script>
	<!-- end demo js-->

</body>

</html>