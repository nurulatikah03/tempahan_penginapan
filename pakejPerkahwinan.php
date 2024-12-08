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
	<link rel="shortcut icon" href="assets/images/lktnIcon.png" type="image/x-icon">
	<link rel="icon" href="assets/images/lktnIcon.png" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
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
		z-index: -1;
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
		height: 100vh;
		/* Full screen height */
		background-color: white;
	}

	.spinner {
		width: 60px;
		/* Adjust size as needed */
		height: 60px;
		border: 8px solid #cae4c5;
		border-top: 8px solid #254222;
		border-radius: 50%;
		animation: spin 1s linear infinite;
	}

	@keyframes spin {
		0% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(360deg);
		}
	}

	.section-padding {
		padding: 40px 0;
		/* Adjust padding as needed */
	}

	.text-center {
		text-align: center;
		/* Centers text within the container */
	}

	.contact-info-1 {
		display: flex;
		flex-wrap: wrap;
		justify-content: center;
		/* Centers the list items */
	}

	.map {
		display: flex;
		justify-content: center;
		/* Centers the map */
	}

	.contact-info-1 {
		display: flex;
		flex-direction: column;
		/* Change to column for vertical alignment */
		align-items: center;
		/* Center the items horizontally */
		list-style: none;
		/* Remove default list styling */
		padding: 0;
		/* Remove default padding */
	}

	.contact-info-1 li {
		text-align: center;
		/* Center text within each list item */
		margin: 10px 0;
		/* Add margin between list items */
	}
</style>

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

		<div class="loader-wrap">
			<div class="spinner"></div>
		</div>


		<?php include 'partials/header.php';
		include_once 'Models/pekejPerkahwinan.php' ?>

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
		<section class="section-padding">
			<div class="auto-container">
				<div class="section_heading text-center mb_30 mt_30">
					<span class="section_heading_title_small">TAWARAN ISTIMEWA</span>
					<h2 class="section_heading_title_big">Pilihan Perkahwinan</h2>
				</div>
				<div class="row">
					<?php $semuaPekej = PekejPerkahwinan::getAllPekejPerkahwinan();
					$wowDelay = 1.0;
					foreach ($semuaPekej as $pekej) { ?>
						<div class="col-lg-6 col-md-6">
							<div class="room-1-block wow fadeInUp" data-wow-delay="<?php echo $wowDelay; ?>s" data-wow-duration=".8s">
								<div class="room-1-image hvr-img-zoom-1">
									<img src="<?php echo $pekej->getGambarPekej(); ?>" alt="<?php echo $pekej->getNamaPekej(); ?>" style="width: 100%; height: 300px; object-fit: cover;">
								</div>
								<div class="room-1-content">
									<p class="room-1-meta-info">Kadar Harga <span class="theme-color">RM<?php echo $pekej->getHargaPekej(); ?></span>/hari</p>
									<h4 class="room-1-title mb_20">
										<a href="perkahwinanDetail.php?id_perkahwinan=<?php echo $pekej->getIdPekej(); ?>"><?php echo $pekej->getNamaPekej(); ?></a>
									</h4>
									<p class="room-1-text mb_30"><?php echo $pekej->getPeneranganPendek(); ?></p>
									<div class="link-btn">
										<a href="perkahwinanDetail.php?id_perkahwinan=<?php echo $pekej->getIdPekej(); ?>" class="btn-1 btn-alt">Tempah Sekarang <span></span></a>
									</div>
								</div>
							</div>
						</div>
					<?php
						$wowDelay += 0.2;
					}
					?>

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