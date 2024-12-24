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
	<link href="assets/css/preloader.css" rel="stylesheet">
    <link href="assets/css/color.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap"
        rel="stylesheet">
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

        <?php include 'partials/header.php'; ?>
		<?php
		$conn = DBConnection::getConnection();
		if (isset($_GET['id_aktiviti'])) {
            $id_aktiviti = $_GET['id_aktiviti'];
        } else {
            echo '<div class="alert alert-danger">ID Aktiviti tidak ditemui.</div>';
            exit;
        }
			
			$query = "
			SELECT 
				aktiviti.id_aktiviti, 
				aktiviti.nama_aktiviti, 
				aktiviti.kadar_harga, 
				aktiviti.penerangan_kemudahan,
				aktiviti.penerangan, 
				aktiviti.status_aktiviti, 
				url_gambar.url_gambar,
				url_gambar.jenis_gambar
			FROM aktiviti
				LEFT JOIN url_gambar ON aktiviti.id_aktiviti = url_gambar.id_aktiviti
				WHERE aktiviti.id_aktiviti = ?
				";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_aktiviti);
        $stmt->execute();
        $result = $stmt->get_result();      
		
        if ($result->num_rows > 0) {

            echo '<div class="row">';
            $utama_image = '';
            $banner_image = '';
            $tambahan_images = [];

        while ($row = $result->fetch_assoc()) {
			$id_aktiviti = $row['id_aktiviti'];
            $nama_aktiviti = $row['nama_aktiviti'];
			$kadar_harga = $row['kadar_harga'];
            $penerangan_kemudahan = $row['penerangan_kemudahan'];
            $penerangan = $row['penerangan'];
            $status_aktiviti = $row['status_aktiviti'];
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
            <div class="page-title" style="
                        background-image: url('adminDashboard/controller/<?php echo $banner_image; ?>');
                        background-repeat: no-repeat;
                        background-size: cover;
                        background-position: center;
                    ">
                <div class="auto-container">
                    <h1><?php echo $nama_aktiviti; ?></h1>
                </div>
            </div>
			
			<div class="bredcrumb-wrap">
				<div class="auto-container">
					<ul class="bredcrumb-list">
						<li><a href="index.php">Laman Utama</a></li>
						<li><a href="pakejAktiviti.php">Aktiviti</a></li>
						<li><a
								href="aktivitiDetail.php?id_aktiviti=<?php echo htmlspecialchars($id_aktiviti); ?>"><?php echo $nama_aktiviti ?></a>
						</li>
						<li>Pengesahan</li>
					</ul>
				</div>
			</div>
		
		<?php
        } else {
            echo "<p>Tiada butiran ditemui untuk aktiviti yang dipilih.</p>";
        }
		?>
			
        <div class="container-md mt-5" style="max-width: 800px;">
            <h2 class="text-center mb-4">Pengesahan Tempahan</h2>

            <!-- Booking Summary -->
            <div class="card mb-5" >
                <div class="card-header">
                    <h4>Butiran Tempahan Anda</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nama Aktiviti:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo htmlspecialchars($nama_aktiviti); ?>
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
                            <strong>Tarikh Masuk:</strong>
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
                            <strong>Bilangan Peserta</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["total_person"] ?> Peserta
                        </div>
                    </div>
					<div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nama Bilik</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["nama_bilik"] ?>
                        </div>
                    </div>
					<div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nama Dewan</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["nama_dewan"] ?> 
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Jumlah Harga:</strong>
                        </div>
                        <div class="col-sm-8">
                            RM <?php echo $_SESSION["total_price"] ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
					<form action="Controller\3_to_payment_GW.php?id_aktiviti=<?php echo htmlspecialchars($id_aktiviti); ?>" method="POST">
                        <label class="fs-5 my-3" style="text-align: left;" for="payment-method">Pilih cara bayaran:</label>
                            <select class="mb-4" id="payment-method" name="payment_method" required>
								<option value="FPX">FPX</option>
                                <option value="cash">Tunai</option>
                                <option value="local order">LO</option>
                                <option value="e-perolehan">e-perolehan</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                        <div class="my-1 text-end">
                            <button type="submit" name="submit" value="aktiviti" class="btn-1">Proceed to Payment<span></span></button>
                            <a href="tempah_aktiviti.php?id_aktiviti=<?php echo htmlspecialchars($id_aktiviti); ?>" class="btn-1 mx-2">ubah Butiran Peribadi<span></span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'partials/footer.php'; ?>
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