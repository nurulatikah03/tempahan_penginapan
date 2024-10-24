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
                                            <li class="breadcrumb-item"><a href="dewan.php">Dewan</a></li>
                                            <li class="breadcrumb-item"><?php echo $nama_dewan; ?></a></li>
                                            <li class="breadcrumb-item active">Kemaskini</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Kemaskini Dewan</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->       
                        
						
						<div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
										<form class="form-horizontal" method="post" action="controller/kemaskiniDewan_process.php" enctype="multipart/form-data">
											<div class="row mb-3">
												<label for="id_dewan" class="col-3 col-form-label">ID Dewan</label>
												<div class="col-9">
													<input type="text" class="form-control" id="id_dewan" name="id_dewan" value="<?php echo $id_dewan; ?>" readonly>
												</div>
											</div>
											<div class="row mb-3">
												<label for="nama_dewan" class="col-3 col-form-label">Nama Dewan</label>
												<div class="col-9">
													<input type="text" class="form-control" id="nama_dewan" name="nama_dewan" value="<?php echo $nama_dewan;?>" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="kadar_sewa" class="col-3 col-form-label">Kadar Sewa (RM)</label>
												<div class="col-9">
													<input type="number" step="0.01" class="form-control" id="kadar_sewa" name="kadar_sewa" value="<?php echo $kadar_sewa;?>" min="1" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="bilangan_muatan" class="col-3 col-form-label">Bilangan Muatan</label>
												<div class="col-9">
													<input type="number" class="form-control" id="bilangan_muatan" name="bilangan_muatan" value="<?php echo $bilangan_muatan;?>" min="1" required>
												</div>
											</div>
											<div class="row mb-3">
												<label for="penerangan" class="col-3 col-form-label">Penerangan</label>
												<div class="col-9">
													<textarea class="form-control" id="penerangan" name="penerangan" rows="4" required><?php echo $penerangan; ?></textarea>
												</div>
											</div>
											<div class="row mb-3">
												<label for="status_dewan" class="col-3 col-form-label">Status</label>
												<div class="col-9">
													<select class="form-control" id="status_dewan" name="status_dewan" value="<?php echo $status_dewan;?>" required>
														<option value="tersedia" <?php if($status_dewan == 'tersedia') echo 'selected'; ?>>Tersedia</option>
														<option value="tidak_tersedia" <?php if($status_dewan == 'tidak_tersedia') echo 'selected'; ?>>Tidak Tersedia</option>
													</select>
												</div>
											</div>
											<div class="row mb-3">
												<label for="fileinput" class="col-3 col-form-label">Muat Naik Gambar</label>
												<div class="col-9">
													<!-- Display the currently uploaded image if it exists -->
													<?php if(!empty($gambar)): ?>
														<div class="mb-2">
															<img src="controller/uploads/<?php echo $gambar; ?>" alt="Gambar Sedia Ada" class="img-thumbnail" style="max-width: 150px;">
															<p>Gambar sedia ada: <?php echo $gambar; ?></p>
														</div>
													<?php endif; ?>
													
													<!-- File input for uploading a new image -->
													<input type="file" id="fileinput" name="fileinput" class="form-control" accept="image/*">
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
