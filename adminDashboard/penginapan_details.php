<?php
include_once '../Models\room.php';
$penginapan_id = $_GET['penginapan_id'];
$room = Room::getRoomById($penginapan_id);
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
                                            <li class="breadcrumb-item"><a href="penginapan.php">Penginapan</a></li>
                                            <li class="breadcrumb-item active"><?php echo $room->getName(); ?></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Maklumat Kemudahan Penginapan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-5 d-flex justify-content-center align-items-center">
                                                <!-- Product image -->
                                                <img src="../<?php echo $room->getImgMain(); ?>" class="img-fluid" style="width: auto; height: auto;" alt="Product-img" />
                                            </div> 
                                            <!-- end col -->
                                            <div class="col-lg-7">
                                                <form class="ps-lg-4">
                                                    <!-- Product title -->
                                                    <h3 class="mt-0"><?php echo $room->getName(); ?><a href="kemaskini_penginapan.php?penginapan_id=<?php echo isset($penginapan_id) ? $penginapan_id : '0';?>" class="text-muted"><i class="mdi mdi-square-edit-outline ms-2"></i></a> </h3>

                                                    <!-- Product description -->
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Kadar Sewa (RM):</h6>
                                                        <h3><?php echo $room->getPrice(); ?></h3>
                                                    </div>
                                        
                                                    <!-- Product description -->
                                                    <div class="mt-4">
                                                        <h6 class="font-14">Penerangan:</h6>
                                                        <p><?php echo $room->getLongDesc(); ?></p>
                                                    </div>

                                                    <!-- Product information -->
                                                    <div class="mt-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <h6 class="font-14">Jumlah Bilik</h6>
                                                                <p class="text-sm lh-150"><?php echo $room->getMaxCapacity(); ?></p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h6 class="font-14">Bilangan Penyewa per bilik</h6>
                                                                <p class="text-sm lh-150"><?php echo $room->getCapacity() .' Orang'; ?></p>
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
