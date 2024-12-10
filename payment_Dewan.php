<?php

include 'database/DBConnec.php';
include 'adminDashboard/controller/get_dewan.php';

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
		$result = $conn->query($sql);
		
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Retrieve data
            $nama_dewan = htmlspecialchars($row['nama_dewan']);
            $gambar_banner = htmlspecialchars($row['gambar_banner']);
            $kadar_sewa = $row['kadar_sewa'];
            ?>

            <!-- Page Title -->
            <div class="page-title" style="
                        background-image: url('adminDashboard/controller/<?php echo $gambar_banner; ?>');
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
						<li><a
								href="dewanDetail.php?id_dewan=<?php echo htmlspecialchars($id_dewan); ?>"><?php echo $nama_dewan ?></a>
						</li>
						<li>Pengesahan</li>
					</ul>
				</div>
			</div>
		
		<?php
        } else {
            echo "<p>Tiada butiran ditemui untuk dewan yang dipilih.</p>";
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
                <div class="card-footer">
					<form action="Controller\3_to_payment_GW.php?id_dewan=<?php echo htmlspecialchars($row['id_dewan']); ?>" method="POST">
                        <label class="fs-5 my-3" for="payment-method">Pilih cara bayaran:</label>
                            <select class="mb-4" id="payment-method" name="payment_method" required>
                                <option value="FPX">FPX</option>
                                <option value="Tunai">Tunai</option>
                                <option value="LO">LO</option>
                                <option value="E-Perolehanan">E-perolehanan</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                            </select>
                        <div class="my-1 text-end">
                            <button type="submit" name="submit" value="dewan" class="btn-1">Proceed to Payment<span></span></button>
                            <a href="tempah_dewan.php?id_dewan=<?php echo htmlspecialchars($row['id_dewan']); ?>" class="btn-1 mx-2">ubah Butiran Peribadi<span></span></a>
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