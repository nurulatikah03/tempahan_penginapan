<?php 

include 'db-connect.php';
include 'adminDashboard/controller/get_dewan.php';

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
	<link href="assets/css/color.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
	<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
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

/* General form styling */

.form-group {
    margin-bottom: 20px;
}

.form-group input[type="date"] {
    width: 100%;
    padding: 12px;
    font-size: 14px;
    color: #555;
    border: 1px solid #ccc;
    border-radius: 5px; /* Rounded input fields */
    background-color: #fff;
    box-shadow: none;
    transition: border-color 0.3s ease;
}

.form-group input[type="date"]:focus {
    border-color: #c77a63; /* Change border color on focus */
    outline: none;
}

.widget {
    background-color: #e6e6e6; /* Light gray background */
    border-radius: 10px;
    padding: 40px;
}

</style>

<body>

<div class="page-wrapper">

    <div class="loader-wrap">
		<div class="spinner"></div>
	</div>
	
	<?php include 'partials/header.php';?>

    <div class="page-title" style="background-image: url(adminDashboard/controller/uploads/<?php echo $row['gambar']; ?>);">
        <div class="auto-container">
            <h1><?php echo $nama_dewan; ?></h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.php">Laman Utama</a></li>
                <li><a href="kemudahanDewan.php">Dewan</a></li>
                <li><?php echo $nama_dewan; ?></li>
            </ul>
        </div>
    </div>

    <section class="section-padding">
        <div class="auto-container">
            <div class="row">                
                <div class="col-lg-8 pe-lg-35">
                    <div class="single-post"> 
                        <span class="section_heading_title_small">Kadar Sewa <?php echo $kadar_sewa; ?>/hari</span>
                        <h2 class="mb_40"><?php echo $nama_dewan; ?></h2>
                        <p class="mb_20">Bilangan muatan: <?php echo $bilangan_muatan; ?> Orang</p>
                        <p class="mb_20"><?php echo $penerangan; ?></p>
						<div class="mb_60"><img src="adminDashboard/controller/uploads/<?php echo $row['gambar']; ?>" alt="" style="width: 828px; height :450px;"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget mb_40 gray-bg p_40">
                        <h4 class="mb_20">Buat Tempahan Anda</h4>
                        <div class="booking-form-3">
                           <form class="hotel-booking-form-1-form" method="post" action="tempahan.php">
								<div class="form-group">
									<p class="hotel-booking-form-1-label">Tarikh masuk:</p>
									<input type="date" name="tarikh_masuk" id="" required />
								</div>
								<div class="form-group">        
									<p class="hotel-booking-form-1-label">Tarikh keluar:</p>
									<input type="date" name="tarikh_keluar" id="" required />                            
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
    <?php
	$counter = 1; // Initialize a counter to create variations

	// Fetch data from the dewan table
	if (isset($_GET['id_dewan'])) {
		$current_id_dewan = $_GET['id_dewan']; // Get id_dewan from URL
		$sql = "SELECT id_dewan, nama_dewan, kadar_sewa, bilangan_muatan, penerangan, status_dewan, gambar FROM dewan WHERE id_dewan != $current_id_dewan";
		$result = $conn->query($sql);
	}

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











