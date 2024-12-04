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
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<body>
    <div class="page-wrapper">
        <div class="page-title" style="background-image: url(assets/images/dewan-1.png);">
            <?php
            include 'partials/header.php';
            include("database/database.php");
            ?>
            <div class="auto-container">
                <h1>Kemudahan Dewan</h1>
            </div>
        </div>
        <div class="bredcrumb-wrap">
            <div class="auto-container">
                <ul class="bredcrumb-list">
                    <li><a href="index.php">Laman Utama</a></li>
                    <li>Kemudahan Dewan</li>
                </ul>
            </div>
        </div>

        <!-- Room -->
        <section class="section-padding" style="padding-top: 10px;">
            <div class="auto-container">
                <div class="section_heading text-center mb_30 mt_30">
                    <span class="section_heading_title_small">TAWARAN ISTIMEWA</span>
                    <h2 class="section_heading_title_big">Pilihan Dewan</h2>
                </div>
                <div class="row">
					<?php
					$counter = 1; // Initialize a counter to create variations

					// Fetch data from the dewan table and join with dewan_pic for the "Utama" image
					$sql = "
						SELECT 
							d.id_dewan, 
							d.nama_dewan, 
							d.kadar_sewa, 
							d.bilangan_muatan, 
							d.penerangan_ringkas, 
							d.status_dewan, 
							dp.url_gambar AS gambar_utama
						FROM 
							dewan d
						LEFT JOIN 
							dewan_pic dp ON d.id_dewan = dp.id_dewan AND dp.jenis_gambar = 'Utama'
					";

					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							// Set a unique animation delay for each block
							$animation_delay = 0.2 * $counter; // Increase delay by 0.2s for each iteration
							?>
							<div class="col-lg-4 col-md-6">
								<div class="room-1-block wow fadeInUp" data-wow-delay="<?php echo htmlspecialchars($animation_delay); ?>s" data-wow-duration=".8s">
									<div class="room-1-image hvr-img-zoom-1">
										<?php if (!empty($row['gambar_utama'])): ?>
											<img src="adminDashboard/controller/<?php echo htmlspecialchars($row['gambar_utama']); ?>" alt="<?php echo htmlspecialchars($row['nama_dewan']); ?>" style="width: 100%; height: 250px; object-fit: cover;">
										<?php else: ?>
											<img src="default-image.jpg" alt="Default Image" style="width: 100%; height: 250px; object-fit: cover;">
										<?php endif; ?>
									</div>
									<div class="room-1-content">
										<p class="room-1-meta-info">Kadar Sewa <span class="theme-color">RM<?php echo number_format($row['kadar_sewa'], 2); ?></span>/hari</p>
										<h4 class="room-1-title mb_20">
											<a href="dewanDetail.php?id_dewan=<?php echo htmlspecialchars($row['id_dewan']); ?>"><?php echo strtoupper(htmlspecialchars($row['nama_dewan'])); ?></a>
										</h4>
										<p class="room-1-text mb_30"><?php echo htmlspecialchars($row['penerangan_ringkas']); ?></p>
										<div class="link-btn">
											<a href="dewanDetail.php?id_dewan=<?php echo htmlspecialchars($row['id_dewan']); ?>" class="btn-1 btn-alt">Lihat Butiran <span></span></a>
										</div>
									</div>
								</div>
							</div>
							<?php
							$counter++; // Increment the counter for the next iteration
						}
					} else {
						echo "<p>No dewan available.</p>";
					}

					$conn->close();
					?>
				</div>
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



</body>

</html>