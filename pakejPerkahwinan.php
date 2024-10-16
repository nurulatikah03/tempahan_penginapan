<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>INSKET Booking</title>
<link rel="icon" type="image/x-icon" href="assets/images/logo2.png">
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<!-- Responsive File -->
<link href="assets/css/responsive.css" rel="stylesheet">
<!-- Color File -->
<link href="assets/css/color.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

<link rel="shortcut icon" href="assets/images/lktnIcon.png" type="image/x-icon" >
<link rel="icon" href="assets/images/lktnIcon.png" type="image/x-icon">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>
<style>
.footer-1-middle {
    position: relative;
    padding: 120px 0 60px;
    background: #254222;
}

.footer-bottom {
    position: relative;
    background: #fff;
    text-align: center;
    padding: 15px 0;
    color: black;
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
	z-i
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

.section-padding {
    padding: 40px 0; /* Adjust padding as needed */
}

.text-center {
    text-align: center; /* Centers text within the container */
}

.contact-info-1 {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Centers the list items */
}

.map {
    display: flex;
    justify-content: center; /* Centers the map */
}

.contact-info-1 {
    display: flex;
    flex-direction: column; /* Change to column for vertical alignment */
    align-items: center; /* Center the items horizontally */
    list-style: none; /* Remove default list styling */
    padding: 0; /* Remove default padding */
}

.contact-info-1 li {
    text-align: center; /* Center text within each list item */
    margin: 10px 0; /* Add margin between list items */
}

</style>

<body>

<div class="page-wrapper">

    <div class="loader-wrap">
		<div class="spinner"></div>
	</div>

    
	<?php include'partials/header.php'; ?>

    <div id="search-popup" class="search-popup">
        <div class="close-search theme-btn"><span class="fal fa-times"></span></div>
        <div class="popup-inner">
            <div class="overlay-layer"></div>
            <div class="search-form">
                <form method="post" action="index.php">
                    <div class="form-group">
                        <fieldset>
                            <input type="search" class="form-control" name="search-input" value="" placeholder="Search Here" required >
                            <input type="submit" value="Search Now!" class="theme-btn">
                        </fieldset>
                    </div>
                </form>
                <br>
                <h3>Recent Search Keywords</h3>
                <ul class="recent-searches">
                    <li><a href="#">Finance</a></li>
                    <li><a href="#">Idea</a></li>
                    <li><a href="#">Service</a></li>
                    <li><a href="#">Growth</a></li>
                    <li><a href="#">Plan</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="page-title" style="background-image: url(assets/images/background/pakejPerkahwinan.jpg);">
        <div class="auto-container">
            <h1>Pakej Perkahwinan 'Raikan Cinta'</h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.php">Laman Utama</a></li>
                <li>Pakej Perkahwinan</li>
            </ul>
        </div>
    </div>

    <!-- Room -->
    <section class="section-padding">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="room-1-block wow fadeInUp" data-wow-delay=".2s" data-wow-duration=".8s">
                        <div class="room-1-image hvr-img-zoom-1">
                            <img src="assets/images/resource/dewanFiber.jpg" alt="">
                        </div>
                        <div class="room-1-content">
                            <p class="room-1-meta-info">Kadar harian <span class="theme-color">RM500.00 </span></p>
                            <h4 class="room-1-title mb_20"><a href="pakejPerkahwinanFiber.php">Dewan Fiber</a></h4>
                            <p class="room-1-text mb_30">Dewan Fiber adalah tempat yang popular untuk majlis perkahwinan, 
									menawarkan reka bentuk elegan dan kemudahan lengkap seperti sistem pencahayaan dan 
									audio yang baik. </p>
                            <div class="link-btn"><a href="pakejPerkahwinanFiber.php" class="btn-1 btn-alt">Tempah Sekarang <span></span></a></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6">
                    <div class="room-1-block wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1.5s">
                        <div class="room-1-image hvr-img-zoom-1">
                            <img src="assets/images/resource/dewanJubli.jpg" alt="">
                        </div>
                        <div class="room-1-content">
                            <p class="room-1-meta-info">Kadar Harian <span class="theme-color">RM600.00 </span></p>
                            <h4 class="room-1-title mb_20"><a href="pakejPerkahwinanJubli.php">Dewan Jubli</a></h4>
                           <p class="room-1-text mb_30">Dewan Jubli adalah tempat yang popular untuk majlis perkahwinan, 
									menawarkan reka bentuk elegan dan kemudahan lengkap seperti sistem pencahayaan dan 
									audio yang baik.<br></p>
                            <div class="link-btn"><a href="pakejPerkahwinanJubli.php" class="btn-1 btn-alt">Tempah Sekarang<span></span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<?php include 'partials/footer.php';?>
	
</div>

<!--Scroll to top-->
<div class="scroll-to-top">
    <div>
        <div class="scroll-top-inner">
            <div class="scroll-bar">
                <div class="bar-inner"></div>
            </div>
            <div class="scroll-bar-text">Go To Top</div>
        </div>
    </div>
</div>
<!-- Scroll to top end -->

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












