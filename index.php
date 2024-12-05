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
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<style>

</style>

<body>

	<!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->
	
    <div class="page-wrapper">
	
		<?php include'partials/header.php'; ?>

		<section class="banner-section">
			<div class="swiper-container banner-slider">
				<div class="swiper-wrapper">                
					<!-- Slide Item -->
					<div class="swiper-slide" style="background-image: url(assets/images/background/dewan.webp);">
						<div class="content-outer">
							<div class="content-box">
								<div class="inner">
									<h4><b>Kemudahan</b></h4>
									<h1>Dewan</h1>
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
									<h4><b>Kemudahan</b></h4>
									<h1>Penginapan</h1>
									<div class="link-box">
										<a href="pakejPenginapan.php" class="btn-1">Tempah Sekarang <span></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="swiper-slide" style="background-image: url(assets/images/resource/teambuilding.jpg);">
						<div class="content-outer">
							<div class="content-box">
								<div class="inner">
									<h4><b>Pakej</b></h4>
									<h1>Aktiviti</h1>
									<div class="link-box">
										<a href="pakejAktiviti.php" class="btn-1">Tempah Sekarang <span></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="swiper-slide" style="background-image: url(assets/images/resource/pakejPerkahwinan.jpg);">
						<div class="content-outer">
							<div class="content-box">
								<div class="inner">
									<h4><b>Pakej</b></h4>
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

        <?php include 'partials/footer.php'; ?>
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
	<script>
	window.addEventListener("load", function () {
		setTimeout(function () {
			document.querySelector(".js-preloader").classList.add("loaded");
		}, 1000);
	});
	</script>



</body>

</html>