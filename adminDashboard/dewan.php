<?php
include 'db-connect.php';

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
                                    <h4 class="page-title">Kemudahan Dewan</h4>
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
														<th class="all"></th>
														<th>Nama Dewan</th>
														<th>Kadar Sewa (RM)</th>
														<th>Bilangan Muatan</th>
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
																	<a href="dewan_details.php?id_dewan=<?php echo isset($id_dewan) ? $id_dewan : '0'; ?>" class="action-icon"><i class="mdi mdi-eye"></i></a>
																	<a href="kemaskini_dewan.php?id_dewan=<?php echo isset($id_dewan) ? $id_dewan : '0'; ?>" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>
																	<a href="controller/delete_dewan.php?id_dewan=<?php echo isset($id_dewan) ? $id_dewan : '0'; ?>" 
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
