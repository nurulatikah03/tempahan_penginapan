<?php 
require_once __DIR__ . '/require/UserAUTH.php';
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
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .form-control-display {
            background-color: #edf7f0;
        }
    </style>
</head>

<body class="" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">

        <?php include 'partials/left-sidemenu.php'; ?>

        <div class="content-page">
            <div class="content">

                <?php 
				include 'partials/topbar.php';
				
				$query = "
					SELECT 
						t.id_tempahan,
						t.nombor_tempahan,
						t.nama_penuh,
						t.numbor_fon, 
						t.email,
						t.tarikh_tempahan,
						t.tarikh_daftar_masuk,
						t.tarikh_daftar_keluar,
						t.harga_keseluruhan,
						t.cara_bayar,
						t.reference_id,
						a.id_aktiviti,
						a.nama_aktiviti
					FROM 
						tempahan t
					LEFT JOIN 
						aktiviti a
					ON 
						t.id_aktiviti = a.id_aktiviti
					WHERE 
						t.id_aktiviti IS NOT NULL		
				";
				$conn = DBConnection::getConnection();
				$result = $conn->query($query);

				if (!$result) {
					die("Query gagal: " . $conn->error);
				}
				?>

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Tempahan</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Tempahan Kemudahan Aktiviti</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
											<thead class="table-light">
												<tr>
													<th style="width: 20px;">
														<div class="form-check">
															<input type="checkbox" class="form-check-input" id="customCheck1">
                                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
														</div>
													</th>
													<th class="all">Nombor Tempahan</th>
													<th>Nama</th>
													<th>Nombor fon</th>
													<th>Email</th>
													<th>Tarikh Masuk</th>
													<th>Tarikh Keluar</th>
													<th>Tindakan</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if ($result->num_rows > 0) {
													while ($row = $result->fetch_assoc()) {
														$id_tempahan = $row['id_tempahan'];
														$nombor_tempahan = $row['nombor_tempahan'];
														$nama_penuh = $row['nama_penuh'];
														$numbor_fon = $row['numbor_fon'];
														$email = $row['email'];
														$tarikh_daftar_masuk = $row['tarikh_daftar_masuk'];
														$tarikh_daftar_keluar = $row['tarikh_daftar_keluar'];
														$cara_bayar = $row['cara_bayar'];
														$tarikh_tempahan = $row['tarikh_tempahan'];
														$nama_aktiviti = $row['nama_aktiviti'];
														$harga_keseluruhan = $row['harga_keseluruhan'];
														
														?>
														<tr>
															<td class="all" style="width: 20px;">
																<div class="form-check">
																	<input type="checkbox" class="form-check-input" id="customCheck<?php echo $id_tempahan; ?>">
																	<label class="form-check-label" for="customCheck<?php echo $id_tempahan; ?>">&nbsp;</label>
																</div>
															</td>
															<td><?php echo $nombor_tempahan; ?></td>
															<td><?php echo $nama_penuh; ?></td>
															<td><?php echo $numbor_fon; ?></td>
															<td><?php echo $email; ?></td>
															<td><?php echo $tarikh_daftar_masuk; ?></td>
															<td><?php echo $tarikh_daftar_keluar; ?></td>
															<td class="table-action">
																<a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal"
																	data-bs-target="#viewModal<?php echo $nombor_tempahan; ?>">
																	<i class="mdi mdi-eye" style="color: #3299d1;"></i>
																</a>
																<a href="https://wa.me/6<?php echo $numbor_fon ?>" class="action-icon" target="_blank">
																	<img src="assets/icon-svg/whatsapp.svg" alt="whatsapp" style="width: 20px; height: 20px;">
																</a>
																<a href="mailto:<?php echo $email ?>" class="action-icon" target="_blank">
																	<img src="assets/icon-svg/gmail.svg" style="width: 20px; height: 20px;">
																</a>
															</td>
														</tr>
														<div class="modal fade modal-backdrop-view" id="viewModal<?php echo $nombor_tempahan; ?>" tabindex="-1"
															aria-labelledby="viewModalLabel<?php echo $nombor_tempahan; ?>" aria-hidden="true">
															<div class="modal-dialog modal-lg">
																<div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
																	<div class="modal-body">
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
																			style="position: absolute; right: 25px; top: 25px;"></button>
																		<div class="text-center p-4">
																			<h3>Maklumat tempahan #<?php echo $nombor_tempahan; ?></h3>
																		</div>

																		<div class="row">
																			<div class="col-md-6 ps-5 pe-2">
																				<div class="mb-3">
																					<label class="form-label">Nama penyewa</label>
																					<input type="text" class="form-control"
																						value="<?php echo $nama_penuh; ?>" readonly
																						style="background-color: white;">
																				</div>
																				<?php
																				$datetime1 = new DateTime($tarikh_daftar_masuk);
																				$datetime2 = new DateTime($tarikh_daftar_keluar);
																				$interval = $datetime1->diff($datetime2);
																				$bilangan_hari = $interval->days;
																				?>
																				<div class="mb-3">
																					<label class="form-label">Nombor Telefon</label>
																					<input type="text" class="form-control"
																						value="<?php echo $numbor_fon; ?>" readonly
																						style="background-color: white;">
																				</div>
																				<div class="mb-3">
																					<label class="form-label">Email</label>
																					<input type="text" class="form-control" value="<?php echo $email; ?>"
																						readonly style="background-color: white;">
																				</div>
																				<div class="mb-3">
																					<label class="form-label">Bilangan Hari</label>
																					<input type="text" class="form-control" value="<?php echo $bilangan_hari; ?>"
																						readonly style="background-color: white;">
																				</div>
																				<div class="mb-3">
																					<label class="form-label">Cara pembayaran</label>
																					<input type="text" class="form-control"
																						value="<?php echo $cara_bayar; ?>" readonly
																						style="background-color: white;">
																				</div>
																			</div>
																			
																			
																			<div class="col-md-6 ps-2 pe-5">
																				<div class="mb-3">
																					<label class="form-label">Tarikh dan masa tempahan</label>
																					<input type="text" class="form-control"
																						value="<?php echo date('d/m/Y', strtotime($tarikh_tempahan)) . ' @ ' . date('H:i', strtotime($tarikh_tempahan)); ?>" readonly
																						style="background-color: white;">
																				</div>
																				<div class="mb-3">
																					<label class="form-label">Tarikh Masuk</label>
																					<input type="text" class="form-control"
																						value="<?php echo date('d/m/Y', strtotime($tarikh_daftar_masuk)); ?>" readonly
																						style="background-color: white;">
																				</div>
																				<div class="mb-3">
																					<label class="form-label">Tarikh Keluar</label>
																					<input type="text" class="form-control"
																						value="<?php echo date('d/m/Y', strtotime($tarikh_daftar_keluar)); ?>" readonly
																						style="background-color: white;">
																				</div>
																				<div class="mb-3">
																					<label class="form-label">Nama Aktiviti</label>
																					<input type="text" class="form-control" value="<?php echo $nama_aktiviti; ?>" readonly
																						style="background-color: white;">
																				</div>
																				<div class="mb-3">
																					<label class="form-label">Jumlah Bayaran</label>
																					<input type="text" class="form-control" value="<?php echo $harga_keseluruhan; ?>" readonly
																						style="background-color: white;">
																				</div>
																			</div>
																		</div>
																		<div class="text-center">
																			<h1 class="modal-title fs-5" id="viewModalLabel">Hubungi penempah</h1>
																		</div>
																		<div class="text-center">
																			<button type="button" class="btn btn-secondary rounded-button"
																				data-bs-dismiss="modal">Tutup</button>
																			<a href="../assets/PDF/PDF_aktiviti.php?booking_number=<?php echo htmlspecialchars($nombor_tempahan); ?>" target="_blank" class="btn btn-primary rounded-button">Lihat Resit</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<?php
													}
												} else {
													echo "<tr><td colspan='8'>Tiada data untuk dipaparkan.</td></tr>";
												}
												?>
											</tbody>
										</table>
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

</body>

</html>