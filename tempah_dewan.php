<?php
session_start();
include 'database/DBConnec.php';


?>

<script>
    window.onload = function () {
        window.scrollTo(0, 480);
    };
</script>

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
    <link rel="shortcut icon" href="assets/images/logoLKTN.png" type="image/x-icon">
    <link rel="icon" href="assets/images/logoLKTN.png" type="image/x-icon">
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
            <div class="page-title" style="
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
                        <li><?php echo htmlspecialchars($nama_dewan); ?></li>
                    </ul>
                </div>
            </div>
            <?php
        } else {
            echo "<p>No details found for the selected hall.</p>";
        }
        ?>

        <section class="section-padding">
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget mb_40 gray-bg p_40" style="padding-top: 10px;">
                            <u>
                                <h4 class="mb_20">Pengesahan Tempahan</h4>
                            </u>
                            <p><strong>Tarikh Masuk:</strong> 
								<?php 
									$checkInDate = DateTime::createFromFormat('Y-m-d', $_SESSION['checkInDate']);
									echo $checkInDate ? $checkInDate->format('d/m/Y') : ''; 
								?>
							</p>

							<p><strong>Tarikh Keluar:</strong> 
								<?php 
									$checkOutDate = DateTime::createFromFormat('Y-m-d', $_SESSION['checkOutDate']);
									echo $checkOutDate ? $checkOutDate->format('d/m/Y') : ''; 
								?>
							</p>
							<p><strong>Bilangan Hari:</strong> <?php echo $_SESSION['num_of_night']; ?></p>
							<p><strong>Harga keseluruhan: </strong>RM<?php echo htmlspecialchars($_SESSION['total_price']); ?></p>
                            <a href="dewanDetail.php?id_dewan=<?php echo htmlspecialchars($id_dewan); ?>"
                                class="btn-1">Ubah
                                Tarikh<span></span></a>
                        </div>
                    </div>
                    <div class="col-lg-8 pe-lg-35">
                        <div class="single-post">
                            <h3 class="mb_40">Masukkan maklumat peribadi anda</h3>
                            <form action="Controller/2_reservation.php?id_dewan=<?php echo htmlspecialchars($id_dewan); ?>"
                                method="POST">
                                <div class="form-group">
                                    <p class="hotel-booking-form-1-label">Nama Penuh: </p>
                                    <div class="form-floating">
                                        <input class="form-control" type="text" name="full_name" value=""
                                            placeholder="Nama" required />
                                        <label for="text">Nama</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="hotel-booking-form-1-label">Alamat Email: </p>
                                            <div class="form-floating">
                                                <input class="form-control" type="email" name="form-email" value=""
                                                    placeholder="" required />
                                                <label for="email">E-mail</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="hotel-booking-form-1-label">Nombor telefon:</p>
                                            <div class="form-floating">
                                                <input class="form-control" type="text" name="phone_number"
                                                    id="phone_number" placeholder="" value="" required />
                                                <label for="phone_number">Nombor fon</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="total_price" value="<?php echo $_SESSION['total_price']; ?>">
								<input type="hidden" name="num_of_night" value="<?php echo $_SESSION['num_of_night']; ?>">
								<input type="hidden" name="process" value ="dewan">
								
								<div class="form-group mb-0 text-end">
									<button type="submit" class="btn-1">Teruskan ke Pembayaran<span></span></button>
								</div>
                            </form>
                        </div>

                    </div>
                </div>
        </section>

        <?php include 'partials/additional_dewan.php'; ?>
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