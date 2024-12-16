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

		<?php include 'partials/left-sidemenu.php'; ?>

		<div class="content-page">
			<div class="content">

				<?php include 'partials/topbar.php';
				include_once '../Models/dewan.php';
				$dewans = dewan::getAllDewan(); ?>

				<!-- Start Content-->
				<div class="container-fluid">

					<!-- start page title -->
					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								<div class="page-title-right">
									<ol class="breadcrumb m-0">
										<li class="breadcrumb-item"><a href="perkahwinan.php">Perkahwinan</a></li>
										<li class="breadcrumb-item active">Tambah</li>
									</ol>
								</div>
								<h4 class="page-title">Tambah Pakej Perkahwinan</h4>
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
											<label for="nama_Pekej" class="col-3 col-form-label">Nama Pekej</label>
											<div class="col-9">
												<input type="text" class="form-control" id="nama_Pekej" name="nama_Pekej" placeholder="Nama Pekej" required>
											</div>
										</div>
										<div class="row mb-3">
											<label for="nama_dewan" class="col-3 col-form-label">Pilih Dewan</label>
											<div class="col-9">
												<select class="form-control" id="nama_dewan" name="id_dewan" required>
													<?php foreach ($dewans as $dewan) { ?>
														<option value="<?php echo $dewan->getIdDewan(); ?>"><?php echo $dewan->getNamaDewan(); ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="row mb-3">
											<label for="kadar_harga" class="col-3 col-form-label">Kadar Harga (RM)</label>
											<div class="col-9">
												<input type="number" class="form-control" id="kadar_harga" name="kadar_harga" placeholder="Kadar Harga" min="1" required>
											</div>
										</div>
										<div class="row mb-3">
											<label for="penerangan_pendek" class="col-3 col-form-label">Penerangan Pendek</label>
											<div class="col-9">
												<textarea class="form-control" id="penerangan_pendek" name="penerangan_pendek" placeholder="Masukkan Penerangan Pendek" rows="4" required></textarea>
											</div>
										</div>
										<div class="row mb-3">
											<label for="penerangan_panjang" class="col-3 col-form-label">Penerangan Panjang</label>
											<div class="col-9">
												<textarea class="form-control" id="penerangan_panjang" name="penerangan_panjang" placeholder="Masukkan Penerangan Panjang" rows="4" required></textarea>
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
												<input type="hidden" name="process" value="tambah_pekej">
												<button type="submit" name="submit" class="btn btn-info">Tambah</button>
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