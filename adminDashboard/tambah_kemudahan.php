<?php 
require_once __DIR__ . '/require/UserAUTH.php';
require_once __DIR__ . '/require/onlyAdminView.php';
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
		
		.form-check {
    margin-bottom: 10px; /* Adjust this value for the desired space */
}

.col-4 {
    padding-right: 15px; /* Optional: Add padding for more space */
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
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="tetapan.php">Tetapan</a></li>
                                            <li class="breadcrumb-item"><a href="kemudahan.php">Kemudahan</a></li>
                                            <li class="breadcrumb-item active">Tambah Kemudahan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Tambah Kemudahan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->       
                        
						
						<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
										<form class="form-horizontal" method="post" action="controller/tambahKemudahan_process.php" enctype="multipart/form-data">
											<div class="row mb-3">
												<label for="nama" class="col-3 col-form-label">Nama Kemudahan</label>
												<div class="col-9">
													<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kemudahan" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="icon_file" class="col-3 col-form-label">Muat Naik Icon (SVG)</label>
												<div class="col-9">
													<input type="file" class="form-control" id="icon_file" name="icon_file" accept=".svg" required>
												</div>
											</div>
											<div class="justify-content-end row">
												<div class="col-9">
													<button type="submit" class="btn btn-info">Tambah</button>
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
