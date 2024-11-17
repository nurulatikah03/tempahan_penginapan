<?php session_start();
if (!isset($_SESSION['room_name'])) {
    header("Location: index.php");
    exit();
}?>

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
        
        <?php include 'partials/header.php';?>

        <div class="page-title" style="background-image: url(<?php echo $_SESSION['room_imgBanner']; ?>);">
            <div class="auto-container">
                <h1><?php echo $_SESSION['room_name']?></h1>
            </div>
        </div>
        <div class="bredcrumb-wrap">
            <div class="auto-container">
                <ul class="bredcrumb-list">
                    <li><a href="index.php">Laman Utama</a></li>
                    <li><a href="pakejPenginapan.php">Penginapan</a></li>
                    <li><a href="room_details.php?room_id=<?php echo htmlspecialchars($_SESSION["room_id"]); ?>"><?php echo $_SESSION['room_name']?></a></li>
                    <li>Pengesahan Berjaya</li>
                </ul>
            </div>
        </div>
        
        <div class="container-md mt-5" style="max-width: 800px;">
            <h2 class="text-center mb-4">Tempahan Anda Berjaya!</h2>
            
            <!-- Booking Summary -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Butiran Tempahan Anda</h4>
                    <a href="#.php" class="btn" style="background-color: white; border :solid; border-radius :50px; ">View invoice<span></span></a>
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
                            <strong>Nama Bilik:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["room_name"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nama Penuh:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["cust_name"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Alamat Email:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["form-email"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Nombor Telefon:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["phone_number"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Tarikh masuk:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["checkInDate"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Tarikh keluar:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["checkOutDate"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Bilangan Hari</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["num_of_night"]?> Hari
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Harga keseluruhan:</strong>
                        </div>
                        <div class="col-sm-8">
                            RM<?php echo $_SESSION["total_price"]?>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 25px; margin-bottom: 50px;">
                <h3>An email was sent to <span style="color: green;"><?php echo $_SESSION["form-email"]?></span> for the invoice</h3>
            </div>
            <div class="text-left" style="margin-bottom: 25px;">
                <a href="ses.php" class="btn-1">Kembali ke Laman Utama<span></span></a>
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


</body>
</html>