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

<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
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
	
	<?php include 'partials/header.php';?>

    <div class="page-title" style="background-image: url(assets/images/background/page-title-4.jpg);">
        <div class="auto-container">
            <h1>Dewan Jubli</h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.php">Laman Utama</a></li>
                <li><a href="kemudahanDewan.php">Dewan</a></li>
                <li>Dewan Jubli</li>
            </ul>
        </div>
    </div>

    <section class="section-padding">
        <div class="auto-container">
            <div class="row">                
                <div class="col-lg-8 pe-lg-35">
                    <div class="single-post"> 
                        <span class="section_heading_title_small">Kadar Sewa RM500.00/hari</span>
                        <h2 class="mb_40">Dewan Jubli</h2>
                        <p class="mb_20">Description. </p>
						<div class="mb_60"><img src="assets/images/resource/event-1.jpg" alt="" style="width: 828px; height :450px;"></div>
                        <h3 class="fs_40 mb_30">Kemudahan</h3>

                        <div class="row mb_30">
                            <div class="col-md-4 col-sm-6 mb_45">
                                <div class="d-flex align-items-center">
                                    <i class="icon-8 theme-color fs_40 w_55 mr_25"></i>
                                    <p class="fw_medium mb_0">Fast wifi</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb_45">
                                <div class="d-flex align-items-center">
                                    <i class="icon-9 theme-color fs_40 w_55 mr_25"></i>
                                    <p class="fw_medium mb_0">Coffee</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb_45">
                                <div class="d-flex align-items-center">
                                    <i class="icon-10 theme-color fs_40 w_55 mr_25"></i>
                                    <p class="fw_medium mb_0">Bath</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb_45">
                                <div class="d-flex align-items-center">
                                    <i class="icon-11 theme-color fs_40 w_55 mr_25"></i>
                                    <p class="fw_medium mb_0">Parking Space​</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb_45">
                                <div class="d-flex align-items-center">
                                    <i class="icon-12 theme-color fs_40 w_55 mr_25"></i>
                                    <p class="fw_medium mb_0">Swimming Pool</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb_45">
                                <div class="d-flex align-items-center">
                                    <i class="icon-14 theme-color fs_40 w_55 mr_25"></i>
                                    <p class="fw_medium mb_0">Breakfast</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb_45">
                                <div class="d-flex align-items-center">
                                    <i class="icon-15 theme-color fs_40 w_55 mr_25"></i>
                                    <p class="fw_medium mb_0">Spa & Wellness</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb_45">
                                <div class="d-flex align-items-center">
                                    <i class="icon-16 theme-color fs_40 w_55 mr_25"></i>
                                    <p class="fw_medium mb_0">Meeting Room</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb_45">
                                <div class="d-flex align-items-center">
                                    <i class="icon-17 theme-color fs_40 w_55 mr_25"></i>
                                    <p class="fw_medium mb_0">Drink</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget mb_40 gray-bg p_40">
                        <h4 class="mb_20">Buat Tempahan Anda</h4>
                        <div class="booking-form-3">
                            <form class="hotel-booking-form-1-form d-block">
                                <div class="form-group">
                                    <p class="hotel-booking-form-1-label">Check - in:</p>
                                    <input placeholder="17 Sep, 2022" class="" type="text" name="form-name" id="nd_booking_archive_form_date_range_from" value="" />
                                </div>
                                <div class="form-group">        
                                    <p class="hotel-booking-form-1-label">Check - Out:</p>
                                    <input placeholder="21 Sep, 2022" class="" type="text" name="form-name" id="nd_booking_archive_form_date_range_to" value="" />                            
                                </div>
                                <div class="form-group mt-4">                                    
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb_20">Jumlah Bayaran</h4>
                                        <p>RM500.00</p>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn-1">Tempah<span></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Room -->
    <section class="section-padding">
        <div class="auto-container">
            <div class="row">
            <div class="col-lg-4 col-md-6">
                    <div class="room-1-block wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1.2s">
                        <div class="room-1-image hvr-img-zoom-1">
                            <img src="assets/images/resource/event-1.jpg" alt="">
                        </div>
                        <div class="room-1-content">
                            <p class="room-1-meta-info">Kadar Sewa <span class="theme-color">RM350.00</span>/hari</p>
                            <h4 class="room-1-title mb_20"><a href="dewanFiber.php">DEWAN FIBER</a></h4>
                            <p class="room-1-text mb_30">Bilangan Muatan sebanyak 250 orang</p>
                            <div class="link-btn"><a href="dewanFiber.php" class="btn-1 btn-alt">Tempah Sekarang <span></span></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-1-block wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1.2s">
                        <div class="room-1-image hvr-img-zoom-1">
                            <img src="assets/images/resource/event-1.jpg" alt="">
                        </div>
                        <div class="room-1-content">
                            <p class="room-1-meta-info">Kadar Sewa <span class="theme-color">RM200.00</span>/hari</p>
                            <h4 class="room-1-title mb_20"><a href="dewanKuliahKenaf.php">DEWAN KULIAH KENAF</a></h4>
                            <p class="room-1-text mb_30">Bilangan Muatan sebanyak 40 orang</p>
                            <div class="link-btn"><a href="dewanKuliahKenaf.php" class="btn-1 btn-alt">Tempah Sekarang <span></span></a></div>
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











