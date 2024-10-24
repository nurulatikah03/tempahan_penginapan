<?php
include 'db-connect.php';
include 'controller/get_perkahwinan.php';

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
                                            <li class="breadcrumb-item"><a href="perkahwinan.php">Perkahwinan</a></li>
                                            <li class="breadcrumb-item active"><?php echo $nama_dewan; ?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Maklumat Pakej Perkahwinan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-5">
												<!-- Product image -->
												<img src="controller/uploads/<?php echo $gambar; ?>" class="img-fluid" style="width: 500; height: 400;" alt="Product-img" />
											</div> <!-- end col -->
                                            <div class="col-lg-7">
                                                <form class="ps-lg-4">
                                                    <!-- Product title -->
                                                    <h3 class="mt-0"><?php echo $nama_dewan; ?><a href="kemaskini_perkahwinan.php?id_perkahwinan=<?php echo isset($id_perkahwinan) ? $id_perkahwinan : '0';?>" class="text-muted"><i class="mdi mdi-square-edit-outline ms-2"></i></a> </h3>

                                                    <!-- Product description -->
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Kadar Harga (RM):</h6>
                                                        <h3><?php echo $kadar_harga; ?></h3>
                                                    </div>
                                        
                                                    <!-- Product description -->
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Penerangan:</h6>
                                                        <p><?php echo $penerangan; ?></p>
                                                    </div>

                                                    <!-- Product information -->
                                                    <div class="mt-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <h6 class="font-14">Tambahan yang disediakan</h6>
                                                                <p class="text-sm lh-150"><?php echo $tambahan; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div> <!-- end col -->
                                        </div> <!-- end row-->
                                        
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row-->       
                        
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
