<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
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
		body {
			font-family: 'Poppins';
		}

		body[data-leftbar-theme=dark] {
			--ct-bg-leftbar: #254222;
		}

		.end-bar .rightbar-title {
			background-color: #254222;
		}

		.limited-text {
			max-width: 150px;
			/* Set a maximum width for the table cell */
			white-space: nowrap;
			/* Prevent text from wrapping to the next line */
			overflow: hidden;
			/* Hide the overflowing text */
			text-overflow: ellipsis;
			/* Show '...' for truncated text */
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
								<h4 class="page-title">Pakej Perkahwinan</h4>
							</div>
						</div>
					</div>
					<!-- end page title -->

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="row mb-2">
										<div class="col-sm-5">
											<a href="tambah_perkahwinan.php" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Tambah Pekej Perkahwinan</a>
										</div>
									</div>

									<div class="table-responsive">
										<table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
											<thead class="table-light">
												<tr>
													<th class="all" style="width: 20px;">
														<div class="form-check">
															<input type="checkbox" class="form-check-input" id="customCheck1">
															<label class="form-check-label" for="customCheck1">&nbsp;</label>
														</div>
													</th>
													<th class="all"></th>
													<th>Nama Pekej</th>
													<th>Nama Dewan</th>
													<th>Kadar Harga (RM)</th>
													<th>Tambahan</th>
													<th>Penerangan</th>
													<th>Tindakan</th>
												</tr>
											</thead>
											<tbody>
												<?php include_once '../Models/pekejPerkahwinan.php';
												$semuaPekej = PekejPerkahwinan::getAllPekejPerkahwinan();
												if (count($semuaPekej) > 0) {
													foreach ($semuaPekej as $pekej) { ?>
														<tr>
															<td>
																<div class="form-check">
																	<input type="checkbox" class="form-check-input" id="customCheck<?php echo $pekej->getIdPekej() ?>">
																	<label class="form-check-label" for="customCheck<?php echo $pekej->getIdPekej() ?>">&nbsp;</label>
																</div>
															</td>
															<td>
																<img src="../<?php echo $pekej->getGambarPekej() ?>" alt="gambar pekej" title="gambar pekej" class="rounded me-3" height="48px" />
															</td>
															<td>
																<p class="m-0 d-inline-block align-middle font-16">
																	<span class="text-body"><?php echo $pekej->getNamaPekej() ?></span>
																</p>
															</td>
															<td>
																<p class="m-0 d-inline-block align-middle font-16">
																	<span class="text-body"><?php echo $pekej->getNamaDewanKahwin() ?></span>
																</p>
															</td>
															<td><?php echo $pekej->getHargaPekej() ?></td>
															<td class="limited-text"><?php echo $pekej->getPeneranganPenuh() ?></td>
															<td class="limited-text"><?php echo $pekej->getPeneranganPendek() ?></td>
															<td class="table-action">
																<a href="perkahwinan_details.php?id_perkahwinan=<?php echo $pekej->getIdPekej() ?>" class="action-icon"><i class="mdi mdi-eye" style="color: #3299d1;"></i></a>
																<a href="kemaskini_perkahwinan.php?id_perkahwinan=<?php echo $pekej->getIdPekej() ?>" class="action-icon"><i class="mdi mdi-square-edit-outline" style="color: #d9d76a;"></i></a>
																<a href="#" class="action-icon" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $pekej->getIdPekej(); ?>"><i class="mdi mdi-delete" style="color: red;"></i></a>
															</td>
														</tr>
														<!-- Modal -->
														<div class="modal fade modal-backdrop-del" id="deleteModal<?php echo $pekej->getIdPekej(); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $pekej->getIdPekej(); ?>" aria-hidden="true">
															<div class="modal-dialog">
																<div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
																	<div class="modal-body">
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 25px; top: 25px;"></button>
																		<div class="text-center p-4">
																			<img src="assets/icon-svg/alert.svg" alt="Alert Icon" class="mb-3" style="height: 100px">
																		</div>
																		<div class="text-center">
																			<h1 class="modal-title fs-5" id="deleteModalLabel">Padam <?php echo $pekej->getNamaPekej(); ?></h1>

																			<p class="pt-3"> Tindakan tidak boleh undur semula. </p>
																		</div>
																		<form action="controller/process_Perkahwinan.php" method="post">
																			<input type="hidden" name="process" value="delete_pekej">
																			<input type="hidden" name="id_pekej" value="<?php echo $pekej->getIdPekej(); ?>">
																			<input type="hidden" name="gambar_url" value="<?php echo $pekej->getGambarPekej(); ?>">
																			<div class="text-center">
																				<button type="button" class="btn btn-secondary rounded-button" data-bs-dismiss="modal">Tidak, Kembali semula.</button>
																				<button type="submit" name="Submit" class="btn btn-danger rounded-button">Ya, Padam</button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														</div>
													<?php }
												} else { ?>
													<tr>
														<td colspan="8" class="text-center">Tiada rekod ditemui</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
										<?php if (isset($_SESSION['success'])) { ?>
											<div class="alert alert-success alert-dismissible fade show" role="alert">
												<?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
												<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
											</div>
										<?php } ?>
									</div>
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