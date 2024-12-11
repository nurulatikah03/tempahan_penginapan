<?php
include '../database/DBConnec.php';

session_start();
$query = "
    SELECT 
        d.id_dewan, 
        d.nama_dewan, 
        d.kadar_sewa, 
        d.bilangan_muatan, 
        d.penerangan, 
		d.penerangan_ringkas,
		d.penerangan_kemudahan,
        d.status_dewan, 
		d.max_capacity,
        dp.url_gambar AS gambar_utama
    FROM 
        dewan d
    LEFT JOIN 
        dewan_pic dp
    ON 
        d.id_dewan = dp.id_dewan AND dp.jenis_gambar = 'Utama';
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
	<div class="wrapper">

		<?php include 'partials/left-sidemenu.php'; ?>

		<div class="content-page">
			<div class="content">

				<?php include 'partials/topbar.php'; ?>

				<div class="container-fluid">

					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								<h4 class="page-title">Kemudahan Dewan</h4>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
									<div class="row mb-2">
										<div class="col-sm-5">
											<a href="tambah_dewan.php" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Tambah Dewan</a>
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
													<th class="all">Nama Dewan</th>
													<th>Kadar Sewa (RM)</th>
													<th>Bilangan Muatan</th>
													<th>Penerangan</th>
													<th>Penerangan Ringkas</th>
													<th>Status</th>
													<th>Tindakan</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($result->num_rows > 0) {
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
														$gambar_utama = $row['gambar_utama'] ?? '';
												?>
														<tr>
															<td>
																<div class="form-check">
																	<input type="checkbox" class="form-check-input" id="customCheck<?php echo htmlspecialchars($id_dewan); ?>">
																	<label class="form-check-label" for="customCheck<?php echo htmlspecialchars($id_dewan); ?>">&nbsp;</label>
																</div>
															</td>
															<td>
																<img src="controller/<?php echo $gambar_utama; ?>" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />
																<p class="m-0 d-inline-block align-middle font-16">
																	<span class="text-body"><?php echo $nama_dewan; ?></span>
																</p>
															</td>
															<td><?php echo $kadar_sewa; ?></td>
															<td><?php echo $bilangan_muatan; ?></td>
															<td class="limited-text"><?php echo $penerangan; ?></td>
															<td class="limited-text"><?php echo $penerangan_ringkas; ?></td>
															<td><?php echo $status_dewan; ?></td>
															<td class="table-action">
																<a href="dewan_details.php?id_dewan=<?php echo isset($id_dewan) ? $id_dewan : '0'; ?>" class="action-icon"><i class="mdi mdi-eye" style="color: #3299d1;"></i></a>
																<a href="kemaskini_dewan.php?id_dewan=<?php echo isset($id_dewan) ? $id_dewan : '0'; ?>" class="action-icon"><i class="mdi mdi-square-edit-outline" style="color: #d9d76a;"></i></a>
																<a href="#" class="action-icon" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id_dewan; ?>">
																	<i class="mdi mdi-delete" style="color: red;"></i>
																</a>

																<!-- DELETE ALERT -->
																<div class="modal fade modal-backdrop-del" id="deleteModal<?php echo $id_dewan; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $id_dewan; ?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
																			<div class="modal-body">
																				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 25px; top: 25px;"></button>
																				<div class="text-center p-4">
																					<img src="assets/icon-svg/alert.svg" alt="Alert Icon" class="mb-3" style="height: 100px">
																				</div>
																				<div class="text-center">
																					<h1 class="modal-title fs-5" id="deleteModalLabel">Padam <?php echo htmlspecialchars($nama_dewan); ?></h1>
																					<p class="pt-3"> Tindakan tidak boleh undur semula. </p>
																				</div>
																				<form action="controller/delete_dewan.php" method="post">
																					<input type="hidden" name="process" value="deleteDewan">
																					<input type="hidden" name="id_dewan" value="<?php echo $id_dewan; ?>">
																					<div class="text-center">
																						<button type="button" class="btn btn-secondary rounded-button" data-bs-dismiss="modal">Tidak, Kembali semula.</button>
																						<button type="submit" class="btn btn-danger rounded-button">Ya, Padam</button>
																					</div>
																				</form>
																			</div>
																		</div>
																	</div>
																</div>
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
											unset($_SESSION['statusDelete']); 
										} elseif (isset($_SESSION['statusTambah'])) {
											echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['statusTambah']) . '</div>';
											unset($_SESSION['statusTambah']);
										} elseif (isset($_SESSION['statusKemaskini'])) {
											echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($_SESSION['statusKemaskini']) . '</div>';
											unset($_SESSION['statusKemaskini']);
										}
										?>
									</div>

									<?php
									$conn->close();
									?>

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

</body>

</html>