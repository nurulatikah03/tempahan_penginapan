<?php
include 'db-connect.php';
include 'controller/get_dewan.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>eTempahan INSKET</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logoLKTN.png">
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

<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid"
    data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">

        <?php include 'partials/left-sidemenu.php';?>

        <div class="content-page">
            <div class="content">

                <?php include 'partials/topbar.php'; ?>

                <!-- Start Content-->
                <div class="container-fluid">

                    <?php
											if (isset($_GET['id_dewan'])) {
												$id_dewan = $_GET['id_dewan']; // Capture the id_dewan from the URL
											} else {
												// If id_dewan is not found in the URL, show an error or redirect
												echo '<div class="alert alert-danger">ID Dewan tidak ditemui.</div>';
												exit;
											}

											$query = "
												SELECT 
													dewan.id_dewan, 
													dewan.nama_dewan, 
													dewan.kadar_sewa, 
													dewan.bilangan_muatan, 
													dewan.penerangan, 
													dewan.penerangan_ringkas, 
													dewan.penerangan_kemudahan, 
													dewan.status_dewan, 
													dewan.max_capacity, 
													dewan_pic.url_gambar,
													dewan_pic.jenis_gambar
												FROM dewan
												LEFT JOIN dewan_pic ON dewan.id_dewan = dewan_pic.id_dewan
												WHERE dewan.id_dewan = ?
											";  // Use prepared statement to prevent SQL injection

											$stmt = $conn->prepare($query);
											$stmt->bind_param("i", $id_dewan); // Bind the id_dewan to the query
											$stmt->execute();
											$result = $stmt->get_result();

											// Check if there are any records for the given id_dewan
											if ($result->num_rows > 0) {
												echo '<div class="row">';
												// Variables to store images by type
												$utama_image = '';
												$banner_image = '';
												$tambahan_images = [];

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
													$url_gambar = $row['url_gambar'];
													$jenis_gambar = $row['jenis_gambar'];

													// Sort the images based on jenis_gambar
													if ($jenis_gambar == 'Utama') {
														$utama_image = $url_gambar; // Set the 'utama' image
													} elseif ($jenis_gambar == 'Banner') {
														$banner_image = $url_gambar; // Set the 'banner' image
													} elseif ($jenis_gambar == 'Tambahan') {
														$tambahan_images[] = $url_gambar; // Add to additional images array
													}
												}
												echo '</div>';
											} else {
												echo '<div class="alert alert-info">Tiada rekod dewan ditemui untuk ID Dewan: ' . $id_dewan . '.</div>';
											}

										
											$stmt->close();
											$conn->close();
											?>
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="dewan.php">Dewan</a></li>
                                        <li class="breadcrumb-item">
                                            <?php echo $nama_dewan; ?></a>
                                        </li>
                                        <li class="breadcrumb-item active">Kemaskini</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Kemaskini Kemudahan Dewan</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="form-horizontal" method="post"
                                        action="controller/kemaskiniDewan_process.php" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <label for="id_dewan" class="col-3 col-form-label">ID Dewan</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="id_dewan" name="id_dewan"
                                                    value="<?php echo $id_dewan; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="nama_dewan" class="col-3 col-form-label">Nama Dewan</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="nama_dewan"
                                                    name="nama_dewan" value="<?php echo $nama_dewan;?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="kadar_sewa" class="col-3 col-form-label">Kadar Sewa (RM)</label>
                                            <div class="col-9">
                                                <input type="number" step="0.01" class="form-control" id="kadar_sewa"
                                                    name="kadar_sewa" value="<?php echo $kadar_sewa;?>" min="1"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="bilangan_muatan" class="col-3 col-form-label">Bilangan
                                                Muatan</label>
                                            <div class="col-9">
                                                <input type="number" class="form-control" id="bilangan_muatan"
                                                    name="bilangan_muatan" value="<?php echo $bilangan_muatan;?>"
                                                    min="1" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="penerangan" class="col-3 col-form-label">Penerangan</label>
                                            <div class="col-9">
                                                <textarea class="form-control" id="penerangan" name="penerangan"
                                                    rows="4" required><?php echo $penerangan; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="penerangan_ringkas" class="col-3 col-form-label">Penerangan Ringkas</label>
                                            <div class="col-9">
                                                <textarea class="form-control" id="penerangan_ringkas" name="penerangan_ringkas"
                                                    rows="3" required><?php echo $penerangan_ringkas; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="penerangan_kemudahan" class="col-3 col-form-label">Penerangan Kemudahan</label>
                                            <div class="col-9">
                                                <textarea class="form-control" id="penerangan_kemudahan" name="penerangan_kemudahan"
                                                    rows="3" required><?php echo $penerangan_kemudahan; ?></textarea>
                                            </div>
                                        </div>
										<div class="row mb-3">
                                            <label for="max_capacity" class="col-3 col-form-label">Kapasiti Dewan</label>
                                            <div class="col-9">
                                                <input type="number" class="form-control" id="max_capacity"
                                                    name="max_capacity" value="<?php echo $max_capacity;?>"
                                                    min="1" required>
                                            </div>
                                        </div>
										<div class="row mb-3">
											<label class="col-3 col-form-label">Kemudahan</label>
											<div class="col-9">
												<div class="row">
													<?php
													$servername = "localhost";
													$username = "root";
													$password = "";
													$dbname = "tempahan_penginapan";

													// Create connection
													$conn = new mysqli($servername, $username, $password, $dbname);

													if ($conn->connect_error) {
														die("Connection failed: " . $conn->connect_error);
													}

													$conn->set_charset("utf8");

													// Fetch the selected kemudahan for the current dewan (assuming the current dewan id is passed via the URL)
													$id_dewan = $_GET['id_dewan']; // Get the dewan id from URL

													// Query to fetch the selected kemudahan for the current dewan
													$selected_kemudahan_query = "
														SELECT id_kemudahan 
														FROM dewan_kemudahan 
														WHERE id_dewan = '$id_dewan'
													";
													$selected_kemudahan_result = $conn->query($selected_kemudahan_query);

													// Store the selected kemudahan ids in an array
													$selected_kemudahan = [];
													if ($selected_kemudahan_result->num_rows > 0) {
														while ($row = $selected_kemudahan_result->fetch_assoc()) {
															$selected_kemudahan[] = $row['id_kemudahan'];
														}
													}

													// Fetch all kemudahan
													$query = "SELECT id_kemudahan, nama, icon_url FROM kemudahan";
													$result = $conn->query($query);

													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															$id_kemudahan = $row['id_kemudahan'];
															$nama = $row['nama'];
															$icon_url = $row['icon_url'];

															// Check if the kemudahan is selected
															$checked = in_array($id_kemudahan, $selected_kemudahan) ? 'checked' : '';

															echo '<div class="col-4">';
															echo '<div class="form-check">';
															echo '<input class="form-check-input" type="checkbox" name="kemudahan[]" value="' . $id_kemudahan . '" id="kemudahan_' . $id_kemudahan . '" ' . $checked . '>';
															echo '<label class="form-check-label" for="kemudahan_' . $id_kemudahan . '">';

															// Display the icon if available
															if ($icon_url) {
																echo '<img src="../' . $icon_url . '" alt="' . $nama . '" style="height: 25px; margin-right: 5px;">';
															}

															// Display the name of the facility
															echo $nama;
															echo '</label>';
															echo '</div>';
															echo '</div>';
														}
													} else {
														echo '<div class="col-12">No kemudahan available.</div>';
													}

													// Close connection
													$conn->close();
													?>
												</div>
											</div>
										</div>
                                        <div class="row mb-3">
                                            <label for="status_dewan" class="col-3 col-form-label">Status</label>
                                            <div class="col-9">
                                                <select class="form-control" id="status_dewan" name="status_dewan" value="<?php echo $status_dewan;?>" required>
													<option value="tersedia" <?php echo ($status_dewan == 'tersedia') ? 'selected' : ''; ?>>Tersedia</option>
													<option value="tidak tersedia" <?php echo ($status_dewan == 'tidak tersedia') ? 'selected' : ''; ?>>Tidak Tersedia</option>
												</select>
                                            </div>
                                        </div>
                                        <div class="justify-content-end row">
                                            <div class="col-9">
                                                <button type="submit" class="btn btn-info">Kemaskini</button>
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