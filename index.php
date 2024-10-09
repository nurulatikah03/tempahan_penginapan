<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Royalking Hotel & Resort HTML Template</title>
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

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

<div class="page-wrapper">

    <div class="loader-wrap">
        <div class="preloader"><div class="preloader-close">Preloader Close</div></div>
        <div class="layer layer-one"><span class="overlay"></span></div>
        <div class="layer layer-two"><span class="overlay"></span></div>        
        <div class="layer layer-three"><span class="overlay"></span></div>        
    </div>

    <header class="main-header header-style-two">
        <div class="header-upper">
            <div class="auto-container">
                <div class="inner-container d-flex align-items-center justify-content-between">
                    <div class="logo-box">
                        <div class="logo" style="width: 240px;"><a href="index.html"><img src="assets/images/logo-light.png" alt=""></a></div>
                    </div>
                    <div class="middle-column">
                        <div class="nav-outer">
                            <div class="mobile-nav-toggler"><img src="assets/images/icons/icon-bar.png" alt=""></div>
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation">
                                        <li><a href="index.php">Laman Utama</a></li>   
                                        <li><a href="kemudahanDewan.php">Dewan</a></li>   
                                        <li><a href="index-3.html">Penginapan</a></li> 
                                        <li><a href="index-3.html">Pakej</a></li> 
                                        <li><a href="index-3.html">Pakej Perkahwinan</a></li>         
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="right-column d-flex align-items-center">
                        <button type="button" class="theme-btn search-toggler"><i class="icon-1"></i></button>                        
                        <div class="header-link-btn"><a href="javascript:void(0);" class="btn-1 btn-small btn-alt">Book Your Stay <span></span></a></div>
                    </div>                      
                </div>
            </div>
        </div>
        <div class="sticky-header dark-bg">
            <div class="header-upper">
                <div class="auto-container">
                    <div class="inner-container d-flex align-items-center justify-content-between">
                        <!--Logo-->
                        <div class="logo-box">
                            <div class="logo" style="width: 240px;"><a href="index.html"><img src="assets/images/logo-light.png" alt=""></a></div>
                        </div>
                        <div class="middle-column">
                            <!--Nav Box-->
                            <div class="nav-outer">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler"><img src="assets/images/icons/icon-bar-2.png" alt=""></div>
    
                                <!-- Main Menu -->
                                <nav class="main-menu navbar-expand-md navbar-light">
                                </nav>
                            </div>
                        </div>
                        <div class="right-column d-flex align-items-center">                        
                            <div class="header-link-btn"><a href="javascript:void(0);" class="btn-1 btn-small btn-alt">Book Your Stay <span></span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><span class="fal fa-times"></span></div>
            
            <nav class="menu-box">
                <div class="nav-logo"><a href="index.html"><img src="assets/images/logo-light.png" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
				<!--Social Links-->
				<div class="social-links">
					<ul class="clearfix">
						<li><a href="#"><span class="fab fa-twitter"></span></a></li>
						<li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
						<li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
						<li><a href="#"><span class="fab fa-instagram"></span></a></li>
						<li><a href="#"><span class="fab fa-youtube"></span></a></li>
					</ul>
                </div>
            </nav>
        </div>

        <div class="nav-overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div>
    </header>

    <div id="search-popup" class="search-popup">
        <div class="close-search theme-btn"><span class="fal fa-times"></span></div>
        <div class="popup-inner">
            <div class="overlay-layer"></div>
            <div class="search-form">
                <form method="post" action="index.html">
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

    <section class="banner-section">
        <div class="swiper-container banner-slider">
            <div class="swiper-wrapper">                
                <!-- Slide Item -->
                <div class="swiper-slide" style="background-image: url(assets/images/main-slider/banner-2.jpg);">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h4>Kemudahan</h4>
                                <h1>Dewan</h1>
                                <div class="link-box">
                                    <a href="room-1.html" class="btn-1">Book Room <span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slide Item -->
                <div class="swiper-slide" style="background-image: url(assets/images/main-slider/banner-1.jpg);">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h4>Kemudahan</h4>
                                <h1>Penginapan</h1>
                                <div class="link-box">
                                    <a href="room-1.html" class="btn-1">Book Room <span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="swiper-slide" style="background-image: url(assets/images/main-slider/banner-1.jpg);">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h4>Kemudahan</h4>
                                <h1>Pakej</h1>
                                <div class="link-box">
                                    <a href="room-1.html" class="btn-1">Book Room <span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="swiper-slide" style="background-image: url(assets/images/main-slider/banner-1.jpg);">
                    <div class="content-outer">
                        <div class="content-box">
                            <div class="inner">
                                <h4>Pakej</h4>
                                <h1>Perkahwinan</h1>
                                <div class="link-box">
                                    <a href="room-1.html" class="btn-1">Book Room <span></span></a>
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













