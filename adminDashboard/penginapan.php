<?php
include 'db-connect.php';

// Fetch data from the database
$query = "SELECT jenis_bilik, jumlah_bilik, kadar_sewa, bilanganPenyewa, statusBilik, penerangan, penginapan_id, gambar FROM penginapan";
$result = $conn->query($query);
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
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>
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
		
		.limited-text {
			max-width: 150px; /* Set a maximum width for the table cell */
        white-space: nowrap; /* Prevent text from wrapping to the next line */
        overflow: hidden; /* Hide the overflowing text */
        text-overflow: ellipsis; /* Show '...' for truncated text */
		}
		</style>
    </head>

    <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
        <!-- Begin page -->
        <div class="wrapper">
		
           <?php include 'partials/left-sidemenu.php';?>

            <div class="content-page">
                <div class="content">
                    
					<?php include 'partials/topbar.php'; ?>

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
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
                                                <a href="tambah_penginapan.php" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Tambah</a>
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
														<th class="all">Jenis bilik</th>
														<th>Kadar Sewa (RM)</th>
														<th>Jumlah Bilik</th>
														<th>Bilangan Penyewa</th>
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
															$jenis_bilik = $row['jenis_bilik'];
															$kadar_sewa = $row['kadar_sewa'];
															$jumlah_bilik = $row['jumlah_bilik'];
															$bilanganPenyewa = $row['bilanganPenyewa'];
															$penerangan = $row['penerangan']; // Corrected from bilanganPenyewa
															$statusBilik = $row['statusBilik']; // Corrected from penerangan
															$gambar = $row['gambar'];
															$penginapan_id = $row['penginapan_id'];
															?>
															<tr>
																<td>
																	<div class="form-check">
																		<input type="checkbox" class="form-check-input" id="customCheck<?php echo $penginapan_id; ?>">
																		<label class="form-check-label" for="customCheck<?php echo $penginapan_id; ?>">&nbsp;</label>
																	</div>
																</td>
																<td>
																	<img src="controller/uploads/<?php echo $gambar; ?>" alt="contact-img" title="contact-img" class="rounded me-3" height="48" />
																	<p class="m-0 d-inline-block align-middle font-16">
																		<span class="text-body"><?php echo $jenis_bilik; ?></span>
																	</p>
																</td>
																<td><?php echo number_format($kadar_sewa, 2); ?></td>
																<td><?php echo $jumlah_bilik; ?></td>
																<td><?php echo $bilanganPenyewa . ' Orang'; ?></td>
																<td class="limited-text"><?php echo $penerangan; ?></td>
																<td><?php echo $statusBilik; ?></td>
																<td class="table-action">
																	<a href="penginapan_details.php?penginapan_id=<?php echo isset($penginapan_id) ? $penginapan_id : '0'; ?>" class="action-icon"><i class="mdi mdi-eye"></i></a>
																	<a href="kemaskini_penginapan.php?penginapan_id=<?php echo isset($penginapan_id) ? $penginapan_id : '0'; ?>" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>
																	<a href="controller/delete_penginapan.php?penginapan_id=<?php echo isset($penginapan_id) ? $penginapan_id : '0'; ?>" 
																	   class="action-icon" 
																	   onclick="return confirm('Adakah anda pasti mahu memadamnya?');">
																	   <i class="mdi mdi-delete"></i>
																	</a>
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
