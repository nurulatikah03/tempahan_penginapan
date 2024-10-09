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

<link rel="shortcut icon" href="assets/images/lktnIcon.png" type="image/x-icon" >
<link rel="icon" href="assets/images/lktnIcon.png" type="image/x-icon">

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
                        <div class="logo" style="width: 240px;"><a href="index.php"><img src="assets/images/logo-light.png" alt=""></a></div>
                    </div>
                    <div class="middle-column">
                        <div class="nav-outer">
                            <div class="mobile-nav-toggler"><img src="assets/images/icons/icon-bar.png" alt=""></div>
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                    <ul class="navigation">
                                        <li><a href="index.php">Laman Utama</a></li>   
                                        <li><a href="kemudahanDewan.php">Dewan</a></li>   
                                        <li><a href="penginapan.php">Penginapan</a></li> 
                                        <li><a href="pakej.php">Pakej</a></li> 
                                        <li><a href="pakejPerkahwinan.php">Pakej Perkahwinan</a></li>
										<li><a href="contact.php"><i class="fas fa-phone" style="font-size: 20px; color:white;"></i></a></li>									
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
                            <div class="logo" style="width: 240px;"><a href="index.php"><img src="assets/images/logo-light.png" alt=""></a></div>
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
                <div class="nav-logo"><a href="index.php"><img src="assets/images/logo-light.png" alt="" title=""></a></div>
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
                    
    <div class="page-title" style="background-image: url(assets/images/background/page-title-6.jpg);">
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


    <section class="section-padding ">
        <div class="auto-container">  
            <div class="section_heading mb_40">
                <span class="section_heading_title_small">Untuk Maklumat Lanjut:- <br> Sila Hubungi:</span>
                <h2 class="section_heading_title_big">Institut Latihan Kenaf dan Tembakau Negara (INSKET)</h2>
            </div>
            <ul class="contact-info-1 d-flex flex-wrap mb_40">
                <li>
                    <h4 class="fs_20 mb_10"><i class="icon-27 mr_10 fs_18"></i>Location</h4>
                    <p>Padang Pak Amat, Pasir Puteh</p>
                </li>
                <li>
                    <h4 class="fs_20 mb_10"><i class="icon-28 mr_10 fs_18"></i>No. Telefon</h4>
                    <p><a href="tel: 013-999 6121">013-999 6121</a></p>
                </li>
                <li>
                    <h4 class="fs_20 mb_10"><i class="icon-29 mr_10 fs_15"></i>E-mel</h4>
                    <p><a href="mailto:chehafizah@lktn.gov.my">chehafizah@lktn.gov.my</a></p>
                </li>
            </ul>
            <div class="row no-gutters">
                
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

    <footer class="main-footer">
        <div class="footer-1-middle">
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="contact-widget-1 mb_30">
                            <div class="footer-widget-title"><h4>Hubungi Kami</h4></div>
                            <ul class="contact-widget-1-list">
                                <li>Lembaga Kenaf dan Tembakau Negara,
									<br>Kubang Kerian,<br>16150 Kota Bharu,
									<br>Kelantan Darul Naim<br>
								</li>
                                <li><span>Emel:</span><a href="mailto:chehafizah@lktn.gov.my">chehafizah@lktn.gov.my</a></li>
                                <li><span>Tel:</span><a href="tel:6097668000">+609-766 8000</a></li>
								<li><span>Fax:</span><a href="tel:6097668071">+609-766 8071</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="link-widget-1 mb_30">
                            <div class="footer-widget-title"><h4>PAUTAN</h4></div>
                            <ul class="link-widget-1-list">
                                <li><a href="javascript:void(0);">PENAFIAN</a></li>
                                <li><a href="javascript:void(0);">DASAR KESELAMATAN</a></li>
                                <li><a href="javascript:void(0);">DASAR PRIVASI</a></li>
                                <li><a href="javascript:void(0);">BANTUAN PENGGUNA</a></li>
								<li><a href="javascript:void(0);">SOALAN LAZIM</a></li>
								<li><a href="javascript:void(0);">PETA LAMAN</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="link-widget-1 mb_30">
                            <div class="footer-widget-title"><h4>JUMLAH PELAWAT</h4></div>
                            <p class="mb_25">Tincidunt neque pretium lectus <br>
                                donec risus.</p>
                            <p>Mon - Fri: 9:00AM - 6:00PM <br> Sat - Sun: 8:00AM - 4:00PM</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="about-widget-1 mb_30">
                            <div class="footer-widget-title"><h4>Newsletter</h4></div>
                            <div class="about-widget-1-text">
                                <p class="mb_30">Tincidunt neque pretium lectus <br>
                                    donec risus.</p>
                                <div class="footer-newsletter">
                                    <form>
                                        <input type="email" placeholder="Email address">
                                        <button class="btn-1">Subscribe <span></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
	
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











