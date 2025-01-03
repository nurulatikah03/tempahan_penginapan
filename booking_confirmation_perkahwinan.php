<script>
  window.onload = function() {
    window.scrollTo(0, 480); 
  };
</script>
<?php session_start();
if (!isset($_SESSION['id_perkahwinan'])) {
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

<link rel="shortcut icon" href="assets/images/logoLKTN.png" type="image/x-icon">
<link rel="icon" href="assets/images/logoLKTN.png" type="image/x-icon">
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

	

    <div class="page-title" style="background-image: url(<?php echo $_SESSION['gambar_pekej']; ?>);">
    <?php include 'partials/header.php';?>
        <div class="auto-container">
            <h1><?php echo $_SESSION['nama_pekej']?></h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.php">Laman Utama</a></li>
                <li><a href="pakejPerkahwinan.php">Pakej Perkahwinan</a></li>
                <li><?php echo $_SESSION['nama_pekej']?></li>
            </ul>
        </div>
    </div>

    <?php
        include_once 'Models/tempahanBilik.php';
        ?>
        
    <section class="section-padding">
        <div class="auto-container">
            <div class="row">
            <div class="col-lg-4">
                    <div class="widget mb_40 gray-bg p_40" style="padding-top: 10px;">
                        <u><h4 class="mb_20">Pengesahan Tempahan</h4></u>
                            <p><strong>Nama Dewan:</strong> <?php echo htmlspecialchars($_SESSION['nama_dewan']); ?></p>

                            <p><strong>Tarikh Kenduri:</strong> <?php echo htmlspecialchars($_SESSION['tarikh_kenduri']); ?></p>
                            <?php if ($_SESSION['num_of_days'] > 1): ?>
                                <p><strong>Tarikh Akhir Kenduri :</strong> <?php echo htmlspecialchars($_SESSION['tarikh_kenduri_end']); ?></p>
                            <?php endif; ?>

                            <p><strong>Bilangan Pax:</strong> <?php echo htmlspecialchars($_SESSION['kapasiti']); ?></p>
                            <?php
                            if (isset($_SESSION['addons']) && is_array($_SESSION['addons']) && count($_SESSION['addons']) > 0) {
                                echo "<p class='mb-0'><strong>Add-ons:</strong></p>";
                                echo "<ul>";
                                foreach ($_SESSION['addons'] as $addon) {
                                    echo "<li>" . htmlspecialchars($addon['name']) . " x " . htmlspecialchars($addon['quantity']) . "</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<p class='mb-0'><strong>Add-ons:</strong> No add-ons</p>";
                            }
                            ?>
                            <p class="mt_20"><strong>Harga keseluruhan: </strong>RM<?php echo htmlspecialchars($_SESSION['total_price_kahwin']); ?></p>
                            <a href="perkahwinanDetail.php?id_perkahwinan=<?php echo $_SESSION["id_perkahwinan"]?>" class="btn-1">Ubah matlumat tempahan<span></span></a>
                        </div>
                </div>
                <div class="col-lg-8 pe-lg-35">
                    <div class="single-post"> 
                        <h3 class="mb_40">Masukkan maklumat peribadi anda</h3>

                        <!-- Booking Form -->
                        <form class="hotel-booking-form-1-form d-block" action="Controller/2_reservation.php" method="POST">
                            <div class="form-group">
                                <p class="hotel-booking-form-1-label">Nama Penuh: </p>
                                <div class="form-floating">
                                    <input class="form-control" type="text" name="full_name" value="" placeholder="Nama" required />
                                    <label for = "text">Nama</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="hotel-booking-form-1-label">Alamat Email: </p>
                                        <div class="form-floating">
                                            <input class="form-control" type="email" name="form-email" value="" placeholder="" required />
                                            <label for="email">E-mail</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <p class="hotel-booking-form-1-label">Nombor telefon:</p>
                                        <div class="form-floating">
                                            <input class="form-control" type="text" name="phone_number" id="phone_number" placeholder="" value="" required />
                                            <label for="phone_number">Nombor fon</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="process" value ="kahwin">
                            
                            <div class="form-group mb-0 text-end">
                                <button type="submit" class="btn-1" >Bayar<span></span></button>
                            </div>
                        </form>
                        <?php
                            if (isset($_SESSION['err'])) {
                                echo '<div class="alert alert-danger mt-4" role="alert">' . $_SESSION['err'] . '</div>';
                                unset($_SESSION['err']);
                            }
                            ?>
                </div>
                
            </div>
        </div>
    </section>

    
    <?php 
    
    include 'partials/additional_pekejKahwin.php';
    include 'partials/footer.php';
    ?>
	
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