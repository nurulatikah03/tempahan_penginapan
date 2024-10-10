<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>INSTITUT LATIHAN KENAF DAN TEMBAKAU NEGARA (INSKET)</title>
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
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<link rel="shortcut icon" href="assets/images/lktnIcon.png" type="image/x-icon" >
<link rel="icon" href="assets/images/lktnIcon.png" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head><style>
.footer-1-middle {
    position: relative;
    padding: 120px 0 60px;
    background: #254222;
}

body {
	font-size: 14px;
	color: #6E6E6E;
	line-height: 1.7em;
	font-weight: 400;
	-webkit-font-smoothing: antialiased;
	background: rgb(255, 255, 255);
	font-family: 'Poppins';
}

.btn-1 {
    position: relative;
    display: inline-flex;
    overflow: hidden;
    padding: 17px 35px 16px;
    text-align: center;
    z-index: 1;
    letter-spacing: 1px;
    color: white;
    font-weight: 500;
    text-transform: uppercase;
    transition: .5s;
    background-color: #c77a63;
}


.btn-1 span {
	position: absolute;
	display: block;
	width: 0;
	height: 0;
	border-radius: 50%;
	background-color: #fff;
	transition: width 0.4s ease-in-out, height 0.4s ease-in-out;
	transform: translate(-50%, -50%);
}

.btn-1:hover {
	color: black;
}


.dark-bg {
	background-color: #254222 !important;
}

.loader-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full screen height */
    background-color: white;
}

.spinner {
    width: 60px; /* Adjust size as needed */
    height: 60px;
    border: 8px solid #cae4c5;
    border-top: 8px solid #254222;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}


</style>

<body>

<div class="page-wrapper">

    <div class="loader-wrap">
		<div class="spinner"></div>
	</div>

    
	<?php include'partials/header.php'; ?>

    <section class="banner-section">
        <div class="swiper-container banner-slider">
            <div class="swiper-wrapper">                
                <!-- Slide Item -->
                <div class="swiper-slide" style="background-image: url(assets/images/dewan1.png);">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h4>Kemudahan</h4>
                                <h1>DEWAN</h1>
                                <div class="link-box">
                                    <a href="kemudahanDewan.php" class="btn-1">Tempah Sekarang <span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide Item -->
                <div class="swiper-slide" style="background-image: url(assets/images/background/blok_asarama.webp);">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h4>Kemudahan</h4>
                                <h1>Penginapan</h1>
                                <div class="link-box">
                                    <a href="room_selection.php" class="btn-1">Tempah Sekarang <span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="swiper-slide" style="background-image: url(assets/images/resource/teambuilding.jpg);">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h4>Pakej</h4>
                                <h1>Aktiviti</h1>
                                <div class="link-box">
                                    <a href="pakejAktiviti.php" class="btn-1">Tempah Sekarang <span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="swiper-slide" style="background-image: url(assets/images/pakejPerkahwinan.jpeg);">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h4>Pakej</h4>
                                <h1>Perkahwinan</h1>
                                <div class="link-box">
                                    <a href="pakejPerkahwinan.php" class="btn-1">Tempah Sekarang <span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-slider-nav">
            <div class="banner-slider-control banner-slider-button-prev"><span><i class="icon-3"></i></span></div>
            <div class="banner-slider-control banner-slider-button-next"><span><i class="icon-2"></i></span> </div>
        </div>
    </section>
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













