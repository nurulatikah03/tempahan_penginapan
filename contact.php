<?php 
include 'database/database.php';
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
    
	<?php include'partials/header.php'; ?>
                    
    <div class="page-title" style="background-image: url(assets/images/background/lktnkenaf.jpg);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center;
		">
        <div class="auto-container">
            <h1>Hubungi Kami</h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.php">Laman Utama</a></li>
                <li>Hubungi Kami</li>
            </ul>
        </div>
    </div>


    <section class="section-padding">
		<div class="auto-container">  
			<div class="section_heading text-center"> <!-- Added text-center class -->
				<h2 class="section_heading_title_big mb_40">Institut Latihan Kenaf dan Tembakau Negara (INSKET)</h2>
				<span class="section_heading_title_small">Untuk Maklumat Lanjut:- <br> Sila Hubungi:</span>
			</div>
			<ul class="contact-info-1 d-flex flex-wrap mb_40 justify-content-center">
				<li>
					<h4 class="fs_20 mb_10"><i class="icon-28 mr_10 fs_18"></i>No. Telefon</h4>
					<p><a href="tel:013-9996121">013-999 6121</a></p>
				</li>
				<li>
					<h4 class="fs_20 mb_10"><i class="icon-29 mr_10 fs_15"></i>E-mel</h4>
					<p><a href="mailto:chehafizah@lktn.gov.my">chehafizah@lktn.gov.my</a></p>
				</li>
				<li>
					<h4 class="fs_20 mb_10"><i class="icon-27 mr_10 fs_18"></i>Location</h4>
					<p>Padang Pak Amat, Pasir Puteh</p>
				</li>
			</ul>
			<div class="row no-gutters justify-content-center"> <!-- Added justify-content-center -->
				<div class="col-lg-7">
					<div class="map mb_30">
						<iframe 
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63507.257278097655!2d102.33472917910156!3d5.826894799999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31b693953c6dbc1d%3A0xf55bd15d13ab4fc1!2sInstitut%20Latihan%20Lembaga%20Kenaf%20Dan%20Tembakau%20Negara!5e0!3m2!1sen!2smy!4v1728435565934!5m2!1sen!2smy" 
							width="600" 
							height="450" 
							style="border:0;" 
							allowfullscreen="" 
							loading="lazy" 
							referrerpolicy="no-referrer-when-downgrade">
						</iframe>
					</div>
				</div>
			</div>
		</div>
	</section>
	
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