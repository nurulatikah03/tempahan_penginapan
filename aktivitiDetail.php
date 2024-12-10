<?php
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
	<link href="assets/css/preloader.css" rel="stylesheet">
	<link href="assets/css/color.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap"
		rel="stylesheet">
	<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
	<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<style>
	.form-group {
		margin-bottom: 20px;
	}

	.form-group input[type="date"] {
		width: 100%;
		padding: 12px;
		font-size: 14px;
		color: #555;
		border: 1px solid #ccc;
		border-radius: 5px;
		/* Rounded input fields */
		background-color: #fff;
		box-shadow: none;
		transition: border-color 0.3s ease;
	}

	.form-group input[type="date"]:focus {
		border-color: #c77a63;
		/* Change border color on focus */
		outline: none;
	}

	.widget {
		background-color: #e6e6e6;
		/* Light gray background */
		border-radius: 10px;
		padding: 40px;
	}

	.carousel-control-prev {
		left: 10px;
		/* Positioned to the left */
	}

	.carousel-control-next {
		right: 10px;
		/* Positioned to the right */
	}

	.carousel-control-prev,
	.carousel-control-next {
		position: absolute;
		background-color: rgba(0, 0, 0, 1);
		/* Darker background (higher alpha value) */
		border-radius: 5px;
		/* Slightly rounded corners */
		padding: 8px;
		top: 80%;
		/* Position near the bottom */
		z-index: 10;
		width: 70px;
		/* Width of the button */
		height: 70px;
		/* Height of the button */
		box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.4);
	}

	.carousel-control-prev {
		left: 10px;
	}

	.carousel-control-next {
		right: 10px;
	}

	.carousel-control-prev-icon,
	.carousel-control-next-icon {
		font-size: 30px;
		color: white;
	}


	.carousel-control-prev:hover,
	.carousel-control-next:hover {
		background-color: rgba(0, 0, 0, 0.5);
	}

	/* Style the pagination dots */
	.carousel-indicators button {
		background-color: rgba(255, 255, 255, 0.6);
		border-radius: 50%;
		width: 15px;
		height: 15px;
		border: none;
		transition: all 0.3s ease;
	}

	.carousel-indicators .active {
		background-color: #007bff;
		transform: scale(1.2);
	}

	.carousel-indicators button:hover {
		background-color: #007bff;
		transform: scale(1.2);
	}

	.carousel-indicators {
		bottom: 10px;
	}
</style>

<body>


	<div class="page-wrapper">

		<?php include 'partials/header.php';
		include_once 'Models/aktiviti.php';
		$id_aktiviti = $_GET['id_aktiviti'];
		$aktiviti = Aktiviti::getAktivitiById($id_aktiviti);

		if (empty($aktiviti)) { ?>
			<div class="page-title"
				style="
					background-image: url('assets/images/background/pakejj.jpg');
					background-repeat: no-repeat;
					background-size: cover;
					background-position: center;
				">
			</div>
			<?php
			include 'partials/404 barang tak jumpa.php';
			} else {
			?>
			<!-- Page Title -->
			<div class="page-title"
				style="
					background-image: url('adminDashboard/controller/<?php echo $aktiviti->getGambarBanner(); ?>');
					background-repeat: no-repeat;
					background-size: cover;
					background-position: center;
				">
				<div class="auto-container">
					<h1><?php echo $aktiviti->getNamaAktiviti(); ?></h1>
				</div>
			</div>

			<!-- Breadcrumb -->
			<div class="bredcrumb-wrap">
				<div class="auto-container">
					<ul class="bredcrumb-list">
						<li><a href="index.php">Laman Utama</a></li>
						<li><a href="pakejAktiviti.php">Aktiviti</a></li>
						<li><?php echo $aktiviti->getNamaAktiviti(); ?></li>
					</ul>
				</div>
			</div>

		<section class="section-padding">
			<div class="auto-container">
				<div class="row">
					<div class="col-lg-8 pe-lg-35">
						<div class="single-post">
							<h2 class="mb_10"><?php echo $aktiviti->getNamaAktiviti(); ?></h2>
							<span class="section_heading_title_small" style="font-size: 25px;">Kadar Sewa
								RM<?php echo htmlspecialchars(number_format($aktiviti->getKadarHarga(), 2)); ?>/seorang/sehari</span>
							<p class="mb_20"><?php echo htmlspecialchars($aktiviti->getPenerangan()); ?></p>


							<div id="imageCarousel" class="carousel slide mb_60" data-bs-ride="carousel">
								<div class="carousel-inner">
									<!-- Gambar Utama -->
									<div class="carousel-item active">
										<img src="adminDashboard/controller/<?php echo $aktiviti->getGambarUtama(); ?>"
											alt="Gambar Utama"
											class="d-block w-100"
											style="height: 450px; object-fit: cover;">
									</div>
									<!-- Gambar Banner -->
									<div class="carousel-item">
										<img src="adminDashboard/controller/<?php echo $aktiviti->getGambarBanner(); ?>"
											alt="Gambar Banner"
											class="d-block w-100"
											style="height: 450px; object-fit: cover;">
									</div>
									<!-- Gambar Tambahan -->
									<?php
									$lisGambarLain = $aktiviti->getGambarLain();
									if (!empty($lisGambarLain)) {
										foreach ($lisGambarLain as $pic) { ?>
											<div class="carousel-item">
												<img src="adminDashboard/controller/<?php echo $pic; ?>"
													alt="Gambar Tambahan"
													class="d-block w-100"
													style="height: 450px; object-fit: cover;">
											</div>
									<?php }
									} ?>
								</div>

								<!-- Carousel Indicators -->
								<div class="carousel-indicators">
									<?php
									$totalSlides = 2 + (!empty($lisGambarLain) ? count($lisGambarLain) : 0);
									for ($i = 0; $i < $totalSlides; $i++) { ?>
										<button type="button" data-bs-target="#imageCarousel"
											data-bs-slide-to="<?php echo $i; ?>"
											class="<?php echo $i === 0 ? 'active' : ''; ?>"
											aria-label="Slide <?php echo $i + 1; ?>">
										</button>
									<?php } ?>
								</div>

								<!-- Carousel Controls -->
								<button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Sebelumnya</span>
								</button>
								<button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="visually-hidden">Seterusnya</span>
								</button>
							</div>

						</div>
					</div>

					<div class="col-lg-4">
						<div class="widget mb_40 gray-bg p_40" style="border: #254222 solid 2px;">
							<h4 class="mb_20"><u>Maklumat Tempahan</u></h4>
							<div class="booking-form-3">

								<form class="hotel-booking-form-1-form d-block" action="Controller/1_aktiviti.php?id_aktiviti=<?php echo htmlspecialchars($aktiviti->getId()); ?>" method="POST">
									<div class="form-group">
										<p class="hotel-booking-form-1-label">TARIKH MASUK:</p>
										<input type="text" placeholder="dd/mm/yyyy" name="checkInDate" id="nd_booking_archive_form_date_range_from" value="" />
									</div>
									<div class="form-group">
										<p class="hotel-booking-form-1-label">TARIKH KELUAR:</p>
										<input type="text" placeholder="dd/mm/yyyy" name="checkOutDate" id="nd_booking_archive_form_date_range_to" value="" />
									</div>
									<div class="form-group">
										<p class="hotel-booking-form-1-label">BILANGAN PESERTA:</p>
										<input type="number" min=1 placeholder="Masukkan jumlah peserta" name="num_of_person" id="nd_booking_archive_form_participants_count" value="" required />
									</div>
									<div class="form-group mb-3">
										<button type="submit" class="btn-1">Buat Tempahan<span></span></button>
										<input type="hidden" name="process" value="aktiviti">
									</div>
								</form>
							</div>
						</div>
					</div>

					<h3 class="fs_40 mb_30">Kemudahan</h3>
					<p class="mb_20"><?php echo htmlspecialchars($aktiviti->getPeneranganKemudahan()); ?></p>

					<div class="row">
						<?php
						// Get the list of kemudahan for the aktiviti
						$lisKemudahan = $aktiviti->getLisKemudahan();
						if (!empty($lisKemudahan)) {
							foreach ($lisKemudahan as $kemudahan) {
								$nama_kemudahan = $kemudahan['name'];
								$icon_url = $kemudahan['icon_url'];
								echo '<div class="col-4">';
								echo '<div class="kemudahan-item">';

								// Display icon if available
								if ($icon_url) {
									echo '<img src="' . $icon_url . '" alt="' . $nama_kemudahan . '" style="height: 50px; margin-right: 30px;">';
								}

								echo $nama_kemudahan;
								echo '</div>';
								echo '</div>';
							}
						} else {
							echo '<div class="col-12">Tiada kemudahan tersedia.</div>';
						}
						?>
					</div>
				</div>
			</div>
		</section>

		<?php 
			}
		include 'partials/additional_aktiviti.php';
		include 'partials/footer.php'; ?>

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
		// Set today's date as the minimum date
		const today = new Date().toISOString().split('T')[0];
		document.getElementById('tarikh_masuk').setAttribute('min', today);
		document.getElementById('tarikh_keluar').setAttribute('min', today);

		// Set minimum date for 'tarikh_keluar' based on 'tarikh_masuk' selection
		document.getElementById('tarikh_masuk').addEventListener('change', function() {
			const masukDate = this.value;
			document.getElementById('tarikh_keluar').setAttribute('min', masukDate);
		});
	</script>
	<script>
		window.addEventListener("load", function() {
			setTimeout(function() {
				document.querySelector(".js-preloader").classList.add("loaded");
			}, 1000);
		});
	</script>


</body>

</html>