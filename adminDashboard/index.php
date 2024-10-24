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
		</style>
    </head>

    <body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
        <!-- Begin page -->
		
        <div class="wrapper">
            
           <?php include 'partials/left-sidemenu.php';?>

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    
					<?php include 'partials/topbar.php'; ?>
					
					<!-- Start Content-->
                    <div class="container-fluid">

						<!-- start page title -->
						<div class="row">
							<div class="col-12">
								<div class="page-title-box">
									<h4 class="page-title">Dashboard</h4>
								</div>
							</div>
						</div>
						<!-- end page title -->

						<div class="row">
							<div class="col-sm-3">
								<div class="card widget-flat">
									<div class="card-body">
										<div class="float-end">
											<i class="uil uil-users-alt widget-icon"></i>
										</div>
										<h5 class="text-muted fw-normal mt-0" title="Bilangan Pelanggan">Pelanggan</h5>
										<h3 class="mt-3 mb-3">36</h3>
									</div>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="card widget-flat">
									<div class="card-body">
										<div class="float-end">
											<i class="uil uil-clipboard-alt widget-icon"></i>
										</div>
										<h5 class="text-muted fw-normal mt-0" title="Bilangan Tempahan">Tempahan</h5>
										<h3 class="mt-3 mb-3">5</h3>
									</div>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="card widget-flat">
									<div class="card-body">
										<div class="float-end">
											<i class="mdi mdi-cash-multiple widget-icon"></i>
										</div>
										<h5 class="text-muted fw-normal mt-0" title="Jumlah Pendapatan">Pendapatan</h5>
										<h3 class="mt-3 mb-3">3</h3>
									</div>
								</div>
							</div>

							<div class="col-sm-3">
								<div class="card widget-flat">
									<div class="card-body">
										<div class="float-end">
											<i class="mdi mdi-account-group-outline widget-icon"></i>
										</div>
										<h5 class="text-muted fw-normal mt-0" title="Pengguna yang sedang aktif">Pengguna Aktif</h5>
										<h3 class="mt-3 mb-3">6</h3>
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