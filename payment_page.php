<?php session_start();
if (!isset($_SESSION['room_name'])) {
    header("Location: index.php");
    exit();
}
?>

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
    <link href="assets/css/preloader.css" rel="stylesheet">

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

        <div class="page-title" style="background-image: url(<?php echo $_SESSION['room_imgBanner']; ?>);">
            <div class="auto-container">
                <h1><?php echo $_SESSION['room_name'] ?></h1>
            </div>
        </div>
        <div class="bredcrumb-wrap">
            <div class="auto-container">
                <ul class="bredcrumb-list">
                    <li><a href="index.php">Laman Utama</a></li>
                    <li><a href="pakejPenginapan.php">Penginapan</a></li>
                    <li><a href="room_details.php?room_id=<?php echo htmlspecialchars($_SESSION["room_id"]); ?>"><?php echo $_SESSION['room_name'] ?></a></li>
                    <li>Pengesahan</li>
                </ul>
            </div>
        </div>

        <div class="container-md mt-5" style="max-width: 800px;">
            <h2 class="text-center mb-4">Booking Confirmation</h2>

            <!-- Booking Summary -->
            <div class="card mb-5">
                <div class="card-header">
                    <h4>Your Booking Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Room name:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["room_name"] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Full Name:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["cust_name"] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Email Address:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["form-email"] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Phone Number:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["phone_number"] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Bilangan Bilik:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION['roomsNum'] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Check-in Date:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["checkInDate"] ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Check-out Date:</strong>
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
                            <strong>Harga keseluruahan:</strong>
                        </div>
                        <div class="col-sm-8">
                            RM<?php echo $_SESSION["total_price"] ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-start">
                    <form action="Controller\3_to_payment_GW.php" method="POST">
                        <label class="fs-5 my-3" for="payment-method">Pilih cara bayaran:</label>
                        <select class="mb-4" id="payment-method" name="payment_method" required>
                            <option value="FPX">FPX</option>
                            <option value="Tunai">Tunai</option>
                            <option value="LO">LO</option>
                            <option value="E-Perolehanan">E-perolehanan</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
                        <div class="my-1">
                            <button type="submit" name="submit" value="room" class="btn-1">Pergi ke pembayaran<span></span></button>
                            <a href="booking_confirmation.php" class="btn-1 mx-2">ubah Butiran Peribadi<span></span></a>
                        </div>
                    </form>

                    <?php
                    include_once 'Models\tempahanBilik.php';
                    $conn = DBConnection::getConnection();
                    $_SESSION['booking_number'] = generateBookingNumber($conn); ?>

                    <form action="https://e-payment.lktn.gov.my/v4/req2pay_tempahan.php" method="post">
                        <input type="hidden" name="req_appid" value="eTempahan">
                        <input type="hidden" name="req_amount" value="<?= $_SESSION["total_price"] ?>">
                        <input type="hidden" name="req_orderid" value="<?= $_SESSION['booking_number'] ?>">
                        <input type="hidden" name="req_email" value="<?= $_SESSION["form-email"] ?>">
                        <input type="hidden" name="req_rtnurl" value="https://apps.lktn.gov.my/eTempahanPenginapan/index.php">
                        <input type="hidden" name="hash_key" value="">
                        <button type="submit" name="submit" class="btn-1">Pergi ke test<span></span></button>

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
    <script>
        window.addEventListener("load", function() {
            setTimeout(function() {
                document.querySelector(".js-preloader").classList.add("loaded");
            }, 1000);
        });
    </script>


</body>

</html>