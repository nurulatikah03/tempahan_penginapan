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

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

<div class="page-wrapper">


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
                                        <li><a href="room_selection.php">Penginapan</a></li> 
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

    <div class="page-title" style="background-image: url(assets/images/background/page-title-4.jpg);">
        <div class="auto-container">
            <h1>Bilik biasa</h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.html">Home</a></li>
                <li><a href="room_selection.php"> Selection</a></li>
                <li>Bilik biasa</li>
            </ul>
        </div>
    </div>

    <section class="section-padding">
        <div class="auto-container">
            <div class="row">                
                <div class="col-lg-8 pe-lg-35">
                    <div class="single-post"> 
                        <span class="section_heading_title_small">RM70.00 table</span>
                        <h2 class="mb_40">Bilik biasa</h2>
                        <p class="mb_20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisl turpis cum tempor vitae. Curabitur at amet, enim sit commodo semper lectus phasellus. Non egestas ultrices magna gravida est sociis non ornare bibendum. tellus Dignissim ornare metus, interdum et, tellus justo. Urna libero, in scelerisque porttitor et, sagittis, et ut. Eget quam at at etiam accumsan integer facilisi justo. Lorem ut tempus cursus fames ultrices nisl, laoreet tortor, blandit. Leo diam, donec pretium, massa pellentesque et eleifend ut. Porta proin malesuada volutpat purus. </p>
                        <p class="mb_40">At quam ac ipsum volutpat non. Duis sagittis, sollicitudin eget tristique consectetur et facilisi. Viverra sit non sed orci magna venenatis. Magna pharetra non ornare lectus sed risus maecenas adipiscing. Cras pretium vivamus nunc posuere.</p>
                        <div class="mb_60"><img src="assets/images/resource/dalambilik-scaled.jpg" alt="" style="width: 828px; height :450px;"></div>
                        <h3 class="fs_40 mb_30">Amenities</h3>
                        <p class="mb_50">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing integer ultrices suspendisse varius etiam est. Est, felis, tempus nec vitae orci sodales Metus, velit nec at diam in sed. Massa dui ipsum ornare sagittis dolor sagittis amet odio est. Sit semper et velit fusce.</p>

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
                        <h3 class="fs_40 mb_30">Room Rules</h3>
                        <p class="mb_30">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing integer ultrices suspendisse varius etiam est. Est, felis, tempus nec vitae orci sodales Metus, velit nec at diam in sed. Massa dui ipsum ornare sagittis dolor sagittis amet odio est. Sit semper et velit fusce.</p>
                        <ul class="list-2 mb_70">
                            <li><i class="icon-23"></i>Check-in: 3:00 PM - 9:00 PM</li>
                            <li><i class="icon-23"></i>Check-ouy: 10:30 AM</li>
                            <li><i class="icon-23"></i>No Pets</li>
                            <li><i class="icon-23"></i>No Smoking</li>
                        </ul>
                        <h3 class="fs_40 mb_30">Cancellation</h3>
                        <p class="mb_70">Est felis tempus nec vitae orci sodales Metus, velit nec at diam in sed. Massa dui ipsum ornare sagittis dolor sagittis amet odio est. Sit semper et velit fusce.</p>
                        <h3 class="fs_40 mb_30">Location</h3>
                        <p class="mb_30">Est felis tempus nec vitae orci sodales Metus, velit nec at diam in sed. Massa dui ipsum ornare sagittis dolor sagittis amet odio est. Sit semper et velit fusce.</p>
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55945.16225505631!2d-73.90847969206546!3d40.66490264739892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1601263396347!5m2!1sen!2sbd" width="600" height="450" frameborder="0" style="border:0; width: 100%" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget mb_40 gray-bg p_40">
                        <h4 class="mb_20">Your Reservation</h4>
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
                                <div class="form-group">
                                    <p class="hotel-booking-form-1-label">Rooms:</p>
                                    <select>
                                        <option data-display="1 Room">1 Room</option>
                                        <option value="2 Rooms">2 Rooms</option>
                                        <option value="3 Rooms">3 Rooms</option>
                                        <option value="4 Rooms">4 Rooms</option>
                                        <option value="5 Rooms">5 Rooms</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p class="hotel-booking-form-1-label">Adults:</p>
                                    <select>
                                        <option data-display="2 Adults">2 Adults</option>
                                        <option value="1 Adult">1 Adult</option>
                                        <option value="3 Adults">3 Adults</option>
                                        <option value="4 Adults">4 Adults</option>
                                        <option value="5 Adults">5 Adults</option>
                                    </select>
                                </div>
                                <div class="form-group mb_50">
                                    <p class="hotel-booking-form-1-label">Child:</p>
                                    <select>
                                        <option data-display="1 Children">1 Children</option>
                                        <option value="0 Children">0 Children</option>
                                        <option value="2 Childrens">2 Childrens</option>
                                        <option value="3 Childrens">3 Childrens</option>
                                        <option value="4 Childrens">4 Childrens</option>
                                        <option value="5 Childrens">5 Childrens</option>
                                    </select>
                                </div>
                                <div class="form-group mt-5">
                                    <h4 class="mb_20">Extra Services</h4>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p><input type="checkbox" name="vehicle1" value="Bike"> Cleaning Fee</p>
                                        <p>$9.0</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p><input type="checkbox" name="vehicle1" value="Bike"> Free</p>
                                        <p>$9.0</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p><input type="checkbox" name="vehicle1" value="Bike"> Parking</p>
                                        <p>$7.0</p>
                                    </div>
                                </div>
                                <div class="form-group mt-4">                                    
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb_20">Your Price</h4>
                                        <p>$9.0</p>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn-1">Book Now<span></span></button>
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
                            <img src="assets/images/resource/room-2.jpg" alt="">
                        </div>
                        <div class="room-1-content">
                            <p class="room-1-meta-info">Bermula dari <span class="theme-color">RM150.00</span>/malam</p>
                            <div class="room-1-rating">
                                <i class="icon-6"></i>
                                <i class="icon-6"></i>
                                <i class="icon-6"></i>
                                <i class="icon-6"></i>
                                <i class="icon-6"></i>
                            </div>
                            <h4 class="room-1-title mb_20"><a href="room-details_2.html">Bilik VIP</a></h4>
                            <p class="room-1-text mb_30">Disediakan dengan 2 katil super single and televisyen.</p>
                            <div class="link-btn"><a href="room-details_2.php" class="btn-1 btn-alt">Tempah Sekarang <span></span></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="room-1-block wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1.5s">
                        <div class="room-1-image hvr-img-zoom-1">
                            <img src="assets/images/resource/room-3.jpg" alt="">
                        </div>
                        <div class="room-1-content">
                            <p class="room-1-meta-info">Bermula dari <span class="theme-color">dari RM199 hingga RM399</span>/malam</p>
                            <div class="room-1-rating">
                                <i class="icon-6"></i>
                                <i class="icon-6"></i>
                                <i class="icon-6"></i>
                                <i class="icon-6"></i>
                                <i class="icon-7"></i>
                            </div>
                            <h4 class="room-1-title mb_20"><a href="room-details_3.html">Home Stay INSKET</a></h4>
                            <p class="room-1-text mb_30">Sesuai untuk keluarga besar.</p>
                            <div class="link-btn"><a href="room-details_3.php" class="btn-1 btn-alt">Tempah Sekarang <span></span></a></div>
                        </div>
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
                            <div class="footer-widget-title"><h4>Contact Us</h4></div>
                            <ul class="contact-widget-1-list">
                                <li><span>Add:</span> New Hyde Park, NY 11040</li>
                                <li><span>Email:</span><a href="mailto:example@royalking.com">example@royalking.com</a></li>
                                <li><span>Phone:</span><a href="tel:3336660000">333 666 0000</a></li>
                            </ul>
                            <ul class="footer-social-icon d-flex align-items-center">
                                <li><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="link-widget-1 mb_30">
                            <div class="footer-widget-title"><h4>Links</h4></div>
                            <ul class="link-widget-1-list">
                                <li><a href="javascript:void(0);">About Us</a></li>
                                <li><a href="javascript:void(0);">Services</a></li>
                                <li><a href="javascript:void(0);">Case</a></li>
                                <li><a href="javascript:void(0);">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="link-widget-1 mb_30">
                            <div class="footer-widget-title"><h4>Hours</h4></div>
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
        <div class="footer-bottom">
            <div class="auto-container">    
                <div class="footer-bottom-row">
                    <div class="footer-bottom-text">Copyright 2022 by <a href="javascript:void(0);">royalking</a> theme All Right Reserved.</div>
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











