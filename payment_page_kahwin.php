<?php session_start();
if (!isset($_SESSION['id_perkahwinan'])) {
    header("Location: index.php");
    exit();
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>INSKET Room Booking</title>
    <!-- Stylesheets -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Responsive File -->
    <link href="assets/css/responsive.css" rel="stylesheet">
    <!-- Color File -->
    <link href="assets/css/color.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>
    <div class="page-wrapper">

        <?php include 'partials/header.php'; ?>

        <div class="page-title" style="background-image: url(<?php echo $_SESSION['gambar_pekej']; ?>);">
            <div class="auto-container">
                <h1><?php echo $_SESSION['nama_pekej'] ?></h1>
            </div>
        </div>
        <div class="bredcrumb-wrap">
            <div class="auto-container">
                <ul class="bredcrumb-list">
                    <li><a href="index.php">Laman Utama</a></li>
                    <li><a href="pakejPerkahwinan.php">Pakej Perkahwinan</a></li>
                    <li><a href="perkahwinanDetail.php?id_perkahwinan=<?php echo htmlspecialchars($_SESSION["id_perkahwinan"]); ?>"><?php echo $_SESSION['nama_pekej'] ?></a></li>
                    <li>Pengesahan</li>
                </ul>
            </div>
        </div>

        <div class="container-md mt-5" style="max-width: 800px;">
            <h2 class="text-center mb-4">Booking Confirmation</h2>

            <!-- Booking Summary -->
            <div class="card mb-5">
                <div class="card-header">
                    <h4>Maklumat tempahan anda</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nama pekej:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION['nama_pekej'] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nama Dewan:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION['nama_dewan'] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Tarikh kenduri:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION['tarikh_kenduri'] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nama penuh:</strong>
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
                            <strong>Nombor telefon:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["phone_number"] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Bilangan pax:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION['kapasiti'] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Add ons:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php
                            if (isset($_SESSION['addons']) && is_array($_SESSION['addons'])) {
                                echo "<ul>";
                                foreach ($_SESSION['addons'] as $addon) {
                                    echo "<li>" . htmlspecialchars($addon['name']) . " x " . htmlspecialchars($addon['quantity']) . "</li>";
                                }
                                echo "</ul>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Harga keseluruhan:</strong>
                        </div>
                        <div class="col-sm-8">
                            RM<?php echo $_SESSION['total_price_kahwin'] ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-start">
                    <form action="Controller\3_room_booking_success.php" method="POST">
                        <label class="fs-5 my-3" for="payment-method">Pilih cara bayaran:</label>
                        <select class="mb-4" id="payment-method" name="payment_method" required>
                            <option value="cash">Tunai</option>
                            <option value="local order">LO</option>
                            <option value="e-perolehan">e-perolehan</option>
                            <option value="bank_transfer">Bank Transfer</option>
                        </select>
                        <div class="my-1">
                            <button type="submit" class="btn-1">Proceed to Payment<span></span></button>
                            <a href="booking_confirmation_perkahwinan.php" class="btn-1 mx-2">ubah Butiran Peribadi<span></span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Booking Summary END -->


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