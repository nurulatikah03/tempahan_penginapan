<?php 
include 'database/DBConnec.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>eTempahan INSKET</title>
<link rel="icon" type="image/x-icon" href="assets/images/logoLKTN.png">
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<link href="assets/css/color.css" rel="stylesheet">
    <link href="assets/css/preloader.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>
<body>

	<!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
		<div class="spinner-grow" style="width: 2rem; height: 2rem; color:green;">
		  <span class="visually-hidden">Loading...</span>
		</div>
		<div class="spinner-grow" style="width: 2rem; height: 2rem; color:green;">
		  <span class="visually-hidden">Loading...</span>
		</div>
		<div class="spinner-grow" style="width: 2rem; height: 2rem; color:green;">
		  <span class="visually-hidden">Loading...</span>
		</div>
    </div>
    <!-- ***** Preloader End ***** -->
	
    <div class="page-wrapper">
        
        <?php include 'partials/header.php';?>

        	<?php
        $conn = DBConnection::getConnection();

        if (isset($_GET['id_dewan'])) {
            $id_dewan = $_GET['id_dewan'];
        } else {
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
				url_gambar.url_gambar,
				url_gambar.jenis_gambar
			FROM dewan
				LEFT JOIN url_gambar ON dewan.id_dewan = url_gambar.id_dewan
				WHERE dewan.id_dewan = ?
				";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_dewan);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<div class="row">';
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

                if ($jenis_gambar == 'main') {
                    $utama_image = $url_gambar;
                } elseif ($jenis_gambar == 'banner') {
                    $banner_image = $url_gambar;
                } elseif ($jenis_gambar == 'add') {
                    $tambahan_images[] = $url_gambar;
                }
            }
            echo '</div>';
            ?>
				<!-- Page Title -->
				<div class="page-title" 
					 style="
						background-image: url('adminDashboard/controller/<?php echo $banner_image; ?>');
						background-repeat: no-repeat;
						background-size: cover;
						background-position: center;
					">
					<div class="auto-container">
						<h1><?php echo $nama_dewan; ?></h1>
					</div>
				</div>
				
				<div class="bredcrumb-wrap">
					<div class="auto-container">
						<ul class="bredcrumb-list">
							<li><a href="index.php">Laman Utama</a></li>
							<li><a href="kemudahanDewan.php">Dewan</a></li>
							<li>
								<a href="dewanDetail.php?id_dewan=<?php echo htmlspecialchars($_GET["id_dewan"]); ?>">
									<?php echo htmlspecialchars($nama_dewan); ?>
								</a>
							</li>
							<li>Pengesahan Berjaya</li>
						</ul>
					</div>
				</div>
				<?php
			} else {
				echo "<p>No details found for the selected hall.</p>";
			}
		?>
				
        <div class="container-md mt-5" style="max-width: 800px;">
            <h2 class="text-center mb-4">Tempahan Anda Berjaya!</h2>
            
            <!-- Booking Summary -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Butiran Tempahan Anda</h4>
                    <?php
					if (isset($_SESSION['booking_number'])) {
						echo '<a href="assets/PDF/PDF_dewan.php?booking_number=' . htmlspecialchars($_SESSION['booking_number']) . '" target="_blank" class="btn" style="background-color: white; border: solid; border-radius: 50px;">View invoice<span></span></a>';
					} else {
						echo "ID tempahan tidak tersedia.";
					}
					?>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nombor Tempahan:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo "#" . $_SESSION["booking_number"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nama Dewan:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo htmlspecialchars($nama_dewan); ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nama Penuh:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["cust_name"] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Alamat Email:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["form-email"] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nombor Telefon:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["phone_number"] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Tarkkh Masuk:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["checkInDate"] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Tarikh Keluar:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["checkOutDate"] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Bilangan Hari</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["num_of_night"] ?> Hari
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Jumlah Harga:</strong>
                        </div>
                        <div class="col-sm-8">
                            RM<?php echo $_SESSION["total_price"] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 25px; margin-bottom: 50px;">
                <h3 class="text-start">Satu email akan dihantar ke email <span class="text-success"><?php echo $_SESSION["form-email"] ?></span> untuk butiran invoice</h3>
                <h4 class="mt-5">Terima kasih kerana berurusan dengan kami!</h4>
            </div>
            <div class="text-left" style="margin-bottom: 25px;">
                <a href="index.php" class="btn-1">Kembali ke Laman Utama<span></span></a>
            </div>
		</div>
        <!-- Booking Summary END -->
        

        <?php include 'partials/footer.php';?>
        
    </div>


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/jquery.fancybox.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/appear.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/TweenMax.min.js"></script>
    <script src="assets/js/swiper.min.js"></script>
    <script src="assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/parallax-scroll.js"></script>
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="assets/js/booking-form.js"></script>
    <script src="assets/js/odometer.min.js"></script>
    <script src="assets/js/script.js"></script>
	<script>
	window.addEventListener("load", function () {
		setTimeout(function () {
			document.querySelector(".js-preloader").classList.add("loaded");
		}, 1000);
	});
	</script>


</body>
</html>