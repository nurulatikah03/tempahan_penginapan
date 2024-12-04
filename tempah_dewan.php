<?php
session_start();
include 'database/database.php';
include 'adminDashboard/controller/get_dewan.php';


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

    <div class="page-wrapper">
        <?php include 'partials/header.php'; ?>

        <?php
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Retrieve data
            $nama_dewan = htmlspecialchars($row['nama_dewan']);
            $gambar_utama = htmlspecialchars($row['gambar_utama']);
            $gambar_banner = htmlspecialchars($row['gambar_banner']);
            $gambar_tambahan = htmlspecialchars($row['gambar_tambahan']);
            $kadar_sewa = $row['kadar_sewa'];
            $bilangan_muatan = $row['bilangan_muatan'];
            $penerangan = $row['penerangan'];
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
                        <li><?php echo htmlspecialchars($nama_dewan); ?></li>
                    </ul>
                </div>
            </div>
            <?php
        } else {
            echo "<p>Tiada butiran ditemui untuk dewan yang dipilih.</p>";
        }

        // Ambil id_dewan (contoh)
        $row['id_dewan'] = isset($_GET['id_dewan']) ? htmlspecialchars($_GET['id_dewan']) : 0;

        ?>

        <section class="section-padding">
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget mb_40 gray-bg p_40" style="padding-top: 10px;">
                            <u>
                                <h4 class="mb_20">Pengesahan Tempahan</h4>
                            </u>
                            <p><strong>Tarikh Masuk:</strong> <?php echo htmlspecialchars($_SESSION['checkInDate']); ?></p>
							<p><strong>Tarikh Keluar:</strong> <?php echo htmlspecialchars($_SESSION['checkOutDate']); ?></p>
							<p><strong>Bilangan Hari:</strong> <?php echo $_SESSION['num_of_night']; ?></p>
							<p><strong>Harga keseluruhan: </strong>RM<?php echo htmlspecialchars($_SESSION['total_price']); ?></p>
                            <a href="dewanDetail.php?id_dewan=<?php echo htmlspecialchars($row['id_dewan']); ?>"
                                class="btn-1">Ubah
                                Tarikh<span></span></a>
                        </div>
                    </div>
                    <div class="col-lg-8 pe-lg-35">
                        <div class="single-post">
                            <h3 class="mb_40">Masukkan maklumat peribadi anda</h3>
                            <form action="Controller/2_reservation.php?id_dewan=<?php echo htmlspecialchars($row['id_dewan']); ?>"
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


</body>

</html>