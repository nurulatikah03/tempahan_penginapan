<?php 
require_once __DIR__ . '/require/UserAUTH.php';
require_once __DIR__ . '/require/onlyAdminView.php';
?>
<!DOCTYPE html>
    <html lang="en">
	<head>
        <meta charset="utf-8" />
		<title>INSKET Booking</title>
		<link rel="icon" type="image/x-icon" href="assets/images/logo/logo2.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
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
		
		/* Add this CSS to your stylesheet */
		.card-hover:hover {
			background-color: #E6F0DC; 
			box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow on hover */
			transition: background-color 0.3s, box-shadow 0.3s;
		}

		.card-hover a:hover {
			color: #007bff; /* Change text color on hover */
		}

		.card-hover a i {
			transition: transform 0.3s;
		}

		.card-hover a:hover i {
			transform: scale(1.1); /* Slightly enlarge the icon on hover */
		}
		</style>
    </head>

    <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
		
        <div class="wrapper">
            
           <?php include 'partials/left-sidemenu.php';?>

            <div class="content-page">
                <div class="content">
                    
					<?php include 'partials/topbar.php'; ?>
					
                    <div class="container-fluid">

						<div class="row">
							<div class="col-12">
								<div class="page-title-box">
									<h4 class="page-title">Tetapan</h4>
								</div>
							</div>
						</div>
						<?php
						// Sambungan ke database

						// Query untuk mendapatkan jumlah kemudahan
						$conn = DBConnection::getConnection();
						$query = "SELECT COUNT(*) AS total_kemudahan FROM kemudahan";
						$result = $conn->query($query);

						// Paparkan jumlah kemudahan
						if ($result->num_rows > 0) {
							$row = $result->fetch_assoc();
							$total_kemudahan = $row['total_kemudahan'];
						} else {
							$total_kemudahan = 0;
						}

						// Tutup sambungan
						$conn->close();
						?>

						<div class="row">
                            <div class="col-sm-3">
								<div class="card widget-flat">
									<div class="card-body card-hover">
										<a href="kemudahan.php" class="text-decoration-none">
											<div class="float-end">
												<i class="uil uil-list-ui-alt widget-icon"></i>
											</div>
											<h5 class="text-muted fw-normal mt-0" title="Kemudahan">Kemudahan</h5>
											<h3 class="mt-3 mb-3"><?php echo $total_kemudahan; ?></h3>
										</a>
									</div>
								</div>
							</div>
                        </div> <!-- end row --> 

					</div>

                </div>
                <!-- content -->

                <?php include 'partials/footer.php'; ?>

            </div>

        </div>
        <!-- END wrapper -->
		
		<?php include 'partials/right-sidemenu.php'; ?>

        <!-- bundle -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/js/app.min.js"></script>

        <!-- third party js -->
        <script src="assets/js/vendor/apexcharts.min.js"></script>
        <script src="assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="assets/js/pages/demo.dashboard.js"></script>
        <!-- end demo js-->
    </body>
</html>