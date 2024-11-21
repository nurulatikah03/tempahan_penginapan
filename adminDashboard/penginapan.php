<?php
session_start();
include_once '../Models\room.php';
include_once '../Models\tempahanBilik.php';

// Fetch data from the database
$roomList = Room::getAllRooms();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>INSKET Booking</title>
	<link rel="icon" type="image/x-icon" href="assets/images/logo/logo2.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
	<link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
	<link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<link rel="stylesheet" href="assets/css/style.css">
	<style>
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
										<li class="breadcrumb-item"><a href="#">Fasiliti</a></li>
										<li class="breadcrumb-item active">Penginapan</li>
									</ol>
								</div>
								<h4 class="page-title">Kemudahan Penginapan</h4>
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
											<a href="tambah_penginapan.php" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Tambah Penginapan</a>
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
													<th class="all">Nama</th>
													<th>Kadar Sewa (RM)</th>
													<th>Jenis Penginapan</th>
													<th>Bilangan Penyewa</th>
													<th>Penerangan</th>
													<th>Ketersediaan (Hari ini)</th>
													<th>Tindakan</th>
												</tr>
											</thead>
											<tbody>
												<?php
												// Check if there are results and display them
												if (!empty($roomList)) {
													foreach ($roomList as $room) {
														$roomId = $room->getId();
														$nama_bilik = $room->getName();
														$capacity = $room->getCapacity();
														$jenis_bilik = $room->getType();
														$kadar_sewa = $room->getPrice();
														$maxCapacity = $room->getMaxCapacity();
														$date = date('d/m/Y');
														$availablity = countRoomAvailable($roomId, $date, $date);
														$penerangan = $room->getLongDesc();
														$gambar = $room->getImgMain();
														$penginapan_id = $room->getId();
												?>
														<tr>
															<td>
																<div class="form-check">
																	<input type="checkbox" class="form-check-input" id="customCheck<?php echo $penginapan_id; ?>">
																	<label class="form-check-label" for="customCheck<?php echo $penginapan_id; ?>">&nbsp;</label>
																</div>
															</td>
															<td>
																<img src="../<?php echo $gambar; ?>" alt="contact-img" class="rounded me-3" width="78" height="48" />
																<p class="m-0 d-inline-block align-middle font-16">
																	<span class="text-body"><?php echo $nama_bilik; ?></span>
																</p>
															</td>
															<td class="text-center"><?php echo number_format($kadar_sewa, 2); ?></td>
															<td class="text-center"><?php echo ucfirst($jenis_bilik); ?></td>
															<td class="text-center"><?php echo $capacity . ' Orang'; ?></td>
															<td class="limited-text"><?php echo $penerangan; ?></td>
															<td class="text-center"><?php echo $availablity . " / " . $maxCapacity ?></td>
															<td class="table-action">

																<!-- Button trigger modal -->
																<a href="#" class="action-icon" data-bs-toggle="modal" data-bs-target="#detailsModal<?php echo $penginapan_id; ?>"><i class="mdi mdi-eye" style="color: #3299d1;"></i></a>

																<!-- Modal Start -->
																<div class="modal fade modal-backdrop-view" id="detailsModal<?php echo $penginapan_id; ?>" tabindex="-1" aria-labelledby="detailsModalLabel<?php echo $penginapan_id; ?>" aria-hidden="true">
																	<div class="modal-dialog modal-lg" style="box-shadow: 0 4px 8px rgba(6, 92, 29, 0.3); border-radius: 10px">
																		<div class="modal-content dialog" style="max-width: 100%; width: auto;">
																			<div class="modal-header">
																				<h4 class="modal-title text-center" id="detailsModalLabel<?php echo $penginapan_id; ?>">Details for <?php echo $nama_bilik; ?></h4>
																				<button type="button" class="btn-close x" data-bs-dismiss="modal" aria-label="Close"></button>
																			</div>
																			<div class="modal-body mx-3">
																				<!-- Add the content you want to display in the modal here -->
																				<div class="text-center mb-3">
																					<h3>Image main</h4>
																						<img src="../<?php echo $gambar; ?>" alt="contact-img" title="contact-img" class="rounded me-3 img-responsive" />
																				</div>
																				<div class="row">
																					<h4 class="text-center">Additional images</h4>
																					<?php
																					$imgList = $room->getImgList();
																					if (!empty($imgList)) {
																						foreach ($imgList as $img) {
																					?>
																							<div class="col-md-4 mb-3">
																								<img src="../<?php echo $img; ?>" alt="room-img" class="img-fluid rounded">
																							</div>
																					<?php
																						}
																					} else {
																						echo "<p class='text-center text-danger'>No images available.</p>";
																					}
																					?>
																				</div>

																				<div class="row mt-2">
																					<div class="col-md-6">
																						<p><strong>Nama:</strong> <?php echo $nama_bilik; ?></p>
																					</div>
																					<div class="col-md-6">
																						<p><strong>Kadar Sewa:</strong> RM<?php echo number_format($kadar_sewa, 2); ?></p>
																					</div>
																				</div>
																				<p><strong>Jenis Penginapan:</strong> <?php echo ucfirst($jenis_bilik); ?></p>
																				<p><strong>Bilangan Penyewa:</strong> <?php echo $capacity . ' Orang'; ?></p>
																				<p style="max-height: auto; overflow: hidden; white-space: normal;"><strong>Penerangan:</strong> <?php echo htmlspecialchars($penerangan); ?></p>
																				<p style="max-height: auto; overflow: hidden; white-space: normal;"><strong>Penerangan Pendek:</strong> <?php echo htmlspecialchars($room->getShortDesc()); ?></p>

																				<p><strong>Bilangan penginapan:</strong> <?php echo $room->getMaxCapacity() ?></p>
																				<p><strong>Ketersediaan (Hari ini):</strong> <?php echo $availablity . " / " . $maxCapacity ?></p>

																				<p><strong>Penerangan Kemudahan:</strong> <?php echo $room->getAmenDesc() ?></p>

																				<p><strong>Senarai kemudahan:</strong></p>
																				<?php
																				$amenities = $room->getAminitiesList();
																				if (!empty($amenities)) {
																					foreach ($amenities as $row) {
																						echo '<div class="col-md-4 col-sm-6 mb_45">';
																						echo '<div class="d-flex align-items-center">';
																						echo '<img src="../' . $row['icon_url'] . '" alt="' . $row['name'] . ' icon" class="theme-color" style="width: 30px; height: 30px; margin-right: 25px;">';
																						echo '<p class="fw_medium mb_0">' . $row['name'] . '</p>';
																						echo '</div>';
																						echo '</div>';
																					}
																				} else {
																					echo "<p class='text-danger' >Tiada kemudahan disediakan</p>";
																				}
																				?>
																			</div>
																			<div class="modal-footer">

																				<a href="kemaskini_penginapan.php?penginapan_id=<?php echo $roomId; ?>" class="btn btn-primary">Kemaskini</a>

																				<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $penginapan_id; ?>">Delete</button>
																				<!---->
																				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
																			</div>
																		</div>
																	</div>
																</div>
																<!-- End Modal -->

																<a href="kemaskini_penginapan.php?penginapan_id=<?php echo $roomId; ?>" class="action-icon"><i class="mdi mdi-square-edit-outline" style="color: #d9d76a;"></i></a>

																<a href="#" class="action-icon" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $penginapan_id; ?>"><i class="mdi mdi-delete" style="color: red;"></i></a>

																<!-- DELETE ALERT -->
																<div class="modal fade modal-backdrop-del" id="deleteModal<?php echo $penginapan_id; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $penginapan_id; ?>" aria-hidden="true">
																	<div class="modal-dialog">
																		<div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
																			<div class="modal-body">
																				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 25px; top: 25px;"></button>
																				<div class="text-center p-4">
																					<img src="assets/icon-svg/alert.svg" alt="Alert Icon" class="mb-3" style="height: 100px">
																				</div>
																				<div class="text-center">
																					<h1 class="modal-title fs-5" id="deleteModalLabel">Padam <?php echo $nama_bilik; ?></h1>

																					<p class="pt-3"> Tindakan tidak boleh undur semula. </p>
																				</div>
																				<form action="controller\kemaskiniPenginapan_process.php" method="post">
																					<input type="hidden" name="process" value="deleteRoom">
																					<input type="hidden" name="room_id" value="<?php echo $penginapan_id; ?>">
																					<div class="text-center">
																						<button type="button" class="btn btn-secondary rounded-button" data-bs-dismiss="modal">Tidak, Kembali semula.</button>
																						<button type="submit" name="Submit" class="btn btn-danger rounded-button">Ya, Padam</button>
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
										if (isset($_SESSION['status'])) {
											echo '<div class="alert alert-success" role="alert">' . $_SESSION['status'] . '</div>';
											unset($_SESSION['status']);
										}
										?>
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
	<script>
	</script>
	<!-- third party js ends -->

	<!-- demo app -->
	<script src="assets/js/pages/demo.products.js"></script>
	<!-- end demo js-->

</body>

</html>