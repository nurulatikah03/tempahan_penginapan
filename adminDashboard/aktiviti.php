<?php
include '../database/DBConnec.php';

session_start();
$query = "
    SELECT 
        a.id_aktiviti, 
        a.nama_aktiviti, 
        a.kadar_harga, 
        a.penerangan_kemudahan,
        a.penerangan, 
        a.status_aktiviti, 
        ap.url_gambar AS gambar_utama
    FROM 
        aktiviti a
    LEFT JOIN 
        url_gambar ap
    ON 
        a.id_aktiviti = ap.id_aktiviti AND ap.jenis_gambar = 'main';
";
$conn = DBConnection::getConnection();
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>eTempahan INSKET</title>
	<link rel="icon" type="image/x-icon" href="assets/images/logo/logo2.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="assets/css/style.css">
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
								<h4 class="page-title">Kemudahan Aktiviti</h4>
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
											<a href="tambah_aktiviti.php" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Tambah Aktiviti</a>
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
													<th>Nama Aktiviti</th>
													<th>Kadar Sewa (RM)</th>
													<th>Penerangan Kemudahan</th>
													<th>Penerangan</th>
													<th>Status</th>
													<th>Tindakan</th>
												</tr>
											</thead>
											<tbody>
												<?php
												// Check if there are results and display them
												if ($result->num_rows > 0) {
													while ($row = $result->fetch_assoc()) {
														// Ambil data dari hasil
														$id_aktiviti = $row['id_aktiviti'];
														$nama_aktiviti = $row['nama_aktiviti'];
														$kadar_harga = $row['kadar_harga'];
														$penerangan_kemudahan = $row['penerangan_kemudahan'];
														$penerangan = $row['penerangan'];
														$status_aktiviti = $row['status_aktiviti'];
														$gambar_utama = $row['gambar_utama'] ?? '';
												?>
														<tr>
															<td>
																<div class="form-check">
																	<input type="checkbox" class="form-check-input" id="customCheck<?php echo htmlspecialchars($id_aktiviti); ?>">
																	<label class="form-check-label" for="customCheck<?php echo htmlspecialchars($id_aktiviti); ?>">&nbsp;</label>
																</div>
															</td>
															<td>
																<img src="controller/<?php echo $gambar_utama; ?>" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />

															</td>
															<td>
																<p class="m-0 d-inline-block align-middle font-16">
																	<span class="text-body"><?php echo $nama_aktiviti; ?></span>
																</p>
															</td>
															<td><?php echo $kadar_harga; ?></td>
															<td class="limited-text"><?php echo $penerangan_kemudahan; ?></td>
															<td class="limited-text"><?php echo $penerangan; ?></td>
															<td><?php echo $status_aktiviti; ?></td>
															<td class="table-action">
																<a href="aktiviti_details.php?id_aktiviti=<?php echo isset($id_aktiviti) ? $id_aktiviti : '0'; ?>" class="action-icon"><i class="mdi mdi-eye" style="color: #3299d1;"></i></a>
																<a href="kemaskini_aktiviti.php?id_aktiviti=<?php echo isset($id_aktiviti) ? $id_aktiviti : '0'; ?>" class="action-icon"><i class="mdi mdi-square-edit-outline" style="color: #d9d76a;"></i></a>
															</td>
														</tr>
												<?php
													}
												} else {
													echo "<tr><td colspan='8'>Tiada data untuk dipaparkan.</td></tr>";
												}
												?>
											</tbody>
										</table>
										<?php
										if (isset($_SESSION['statusDelete'])) {
											echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['statusDelete']) . '</div>';
											unset($_SESSION['statusDelete']); // Hapus mesej selepas dipaparkan
										} elseif (isset($_SESSION['statusTambah'])) {
											echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['statusTambah']) . '</div>';
											unset($_SESSION['statusTambah']); // Hapus mesej selepas dipaparkan
										} elseif (isset($_SESSION['statusKemaskini'])) {
											echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['statusKemaskini']) . '</div>';
											unset($_SESSION['statusKemaskini']); // Hapus mesej selepas dipaparkan
										}
										?>
									</div>

									<?php
									// Close the database connection
									$conn->close();
									?>

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