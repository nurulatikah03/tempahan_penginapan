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

		<?php include 'partials/left-sidemenu.php';
		include_once '../Models\room.php'; ?>

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
										<li class="breadcrumb-item active">Tambah</li>
									</ol>
								</div>
								<h4 class="page-title">Tambah Kemudahan Penginapan</h4>
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
											<label for="nama_bilik" class="col-3 col-form-label">Nama Bilik</label>
											<div class="col-9">
												<input type="text" class="form-control" id="nama_bilik" name="nama_bilik" placeholder="Nama Bilik" required>
											</div>
										</div>
										<div class="row mb-3">
											<label for="jenis_bilik" class="col-3 col-form-label">Jenis Bilik</label>
											<div class="col-9">
												<input type="text" class="form-control" id="jenis_bilik" name="jenis_bilik" placeholder="Jenis Bilik" required>
											</div>
										</div>
										<div class="row mb-3">
											<label for="bilanganPenyewa" class="col-3 col-form-label">Bilangan Penyewa per Bilik (Orang)</label>
											<div class="col-9">
												<input type="number" class="form-control" id="bilanganPenyewa" name="bilanganPenyewa" placeholder="Bilangan Penyewa" min="1" required>
											</div>
										</div>
										<div class="row mb-3">
											<label for="jumlahBilik" class="col-3 col-form-label">Jumlah Bilik</label>
											<div class="col-9">
												<input type="number" class="form-control" id="jumlahBilik" name="jumlah_bilik" placeholder="Jumlah Bilik" min="1" required>
											</div>
										</div>
										<div class="row mb-3">
											<label for="kadarSewa" class="col-3 col-form-label">Kadar Sewa (RM)</label>
											<div class="col-9">
												<input type="number" step="0.01" class="form-control" id="kadarSewa" name="kadar_sewa" placeholder="Kadar Sewa" min="1" required>
											</div>
										</div>
										<div class="row mb-3">
											<label for="penerangan_panjang" class="col-3 col-form-label">Penerangan Panjang</label>
											<div class="col-9">
												<textarea class="form-control" id="penerangan_panjang" name="penerangan_panjang" placeholder="Masukkan Penerangan Panjang" rows="4" required></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<label for="penerangan_pendek" class="col-3 col-form-label">Penerangan Pendek</label>
											<div class="col-9">
												<textarea class="form-control" id="penerangan_pendek" name="penerangan_pendek" placeholder="Masukkan Penerangan Pendek" rows="4" required></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<label for="penerangan_kemudahan" class="col-3 col-form-label">Penerangan Kemudahan</label>
											<div class="col-9">
												<textarea class="form-control" id="penerangan_kemudahan" name="penerangan_kemudahan" placeholder="Masukkan Penerangan Kemudahan" rows="4" required></textarea>
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
																<input class="form-check-input" type="checkbox" name="kemudahan[]" value="<?php echo $aminity['name']; ?>" id="<?php echo $aminity['name']; ?>" >
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
										<div class="row mb-3">
											<label for="fileinput_utama" class="col-3 col-form-label">Muat Naik Gambar Utama</label>
											<div class="col-9">
												<input type="file" id="fileinput_utama" name="fileinput_utama" class="form-control" accept="image/*" required>
											</div>
										</div>
										<div class="row mb-3">
											<label for="fileinput_banner" class="col-3 col-form-label">Muat Naik Gambar Banner</label>
											<div class="col-9">
												<input type="file" id="fileinput_banner" name="fileinput_banner" class="form-control" accept="image/*" required>
											</div>
										</div>
										<div class="row mb-3">
											<label for="fileinput_tambahan" class="col-3 col-form-label">Muat Naik Gambar Tambahan</label>
											<div class="col-9">
												<input type="file" id="fileinput_tambahan" name="fileinput_tambahan[]" class="form-control" accept="image/*" multiple>
											</div>
										</div>
										<div class="justify-content-end row">
											<div class="col-9">
												<input type="hidden" name="process" value="addRoom">
												<button type="submit" name="Submit" class="btn btn-info">Tambah</button>
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