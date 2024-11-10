<?php include'db-connect.php'; ?>

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
<link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
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

body {
	font-size: 14px;
	color: #6E6E6E;
	line-height: 1.7em;
	font-weight: 400;
	-webkit-font-smoothing: antialiased;
	background: rgb(255, 255, 255);
	font-family: 'Poppins';
}

.footer-bottom {
    position: relative;
    background: #fff;
    text-align: center;
    padding: 15px 0;
    color: black;
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


</style>

<body>

<div class="page-wrapper">

    <div class="loader-wrap">
		<div class="spinner"></div>
	</div>

	<?php include'partials/header.php'; ?>

    <div class="page-title" style="background-image: url(assets/images/dewan-1.png);">
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

    <?php
	$counter = 1; // Initialize a counter to create variations

	// Fetch data from the dewan table
	$sql = "SELECT id_dewan, nama_dewan, kadar_sewa, bilangan_muatan, penerangan, status_dewan, gambar FROM dewan";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// Output the data for each dewan
		?>
		<section class="section-padding">
			<div class="auto-container">
				<div class="row">
					<?php
					while($row = $result->fetch_assoc()) {
						// Set a unique animation delay for each block
						$animation_delay = 0.2 * $counter; // Increase delay by 0.2s for each iteration
						?>
						<div class="col-lg-4 col-md-6">
							<div class="room-1-block wow fadeInUp" data-wow-delay="<?php echo $animation_delay; ?>s" data-wow-duration=".8s">
								<div class="room-1-image hvr-img-zoom-1">
									<img src="adminDashboard/controller/uploads/<?php echo $row['gambar']; ?>" 
										 alt="<?php echo $row['nama_dewan']; ?>" 
										 style="width: 100%; height: 250px; object-fit: cover;">
								</div>
								<div class="room-1-content">
									<p class="room-1-meta-info">Kadar Sewa <span class="theme-color">RM<?php echo number_format($row['kadar_sewa'], 2); ?></span>/hari</p>
									<h4 class="room-1-title mb_20">
										<a href="dewanDetail.php?id_dewan=<?php echo $row['id_dewan']; ?>"><?php echo strtoupper($row['nama_dewan']); ?></a>
									</h4>
									<p class="room-1-text mb_30">Bilangan Muatan sebanyak <?php echo $row['bilangan_muatan']; ?> orang</p>
									<div class="link-btn">
										<a href="dewanDetail.php?id_dewan=<?php echo $row['id_dewan']; ?>" class="btn-1 btn-alt">Tempah Sekarang <span></span></a>
									</div>
								</div>
							</div>
						</div>
						<?php
						$counter++; // Increment the counter for the next iteration
					}
					?>
				</div>
			</div>
		</section>
		<?php
	} else {
		echo "<p>No dewan available.</p>";
	}

	$conn->close();
	?>

	
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











