<?php 

include 'db-connect.php';
include 'adminDashboard/controller/get_penginapan.php';

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

</style>

<body>

<div class="page-wrapper">

    <div class="loader-wrap">
		<div class="spinner"></div>
	</div>
	
	<?php include 'partials/header.php';?>

    <div class="page-title" style="background-image: url(adminDashboard/controller/uploads/<?php echo $row['gambar']; ?>);">
        <div class="auto-container">
            <h1><?php echo $jenis_bilik; ?></h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.php">Laman Utama</a></li>
                <li><a href="pakejPenginapan.php">Penginapan</a></li>
                <li><?php echo $jenis_bilik; ?></li>
            </ul>
        </div>
    </div>

    <section class="section-padding">
        <div class="auto-container">
            <div class="row">                
                <div class="col-lg-8 pe-lg-35">
                    <div class="single-post"> 
                        <span class="section_heading_title_small">Kadar Sewa RM<?php echo number_format($row['kadar_sewa'], 2); ?>/hari</span>
                        <h2 class="mb_40"><?php echo $jenis_bilik; ?></h2>
                        <p class="mb_20">Bilangan penyewa sebanyak <?php echo $row['bilanganPenyewa']; ?> orang</p>
                        <p class="mb_40"><?php echo $penerangan; ?></p>
                        <div class="mb_60"><img src="adminDashboard/controller/uploads/<?php echo $row['gambar']; ?>" alt="" style="width: 828px; height :450px;"></div>
                        <h3 class="fs_40 mb_30">Kemudahan</h3>
                        <p class="mb_50"></p>

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
                                    <p class="hotel-booking-form-1-label">Tarikh masuk:</p>
                                    <input placeholder="17 Sep, 2022" class="" type="text" name="form-name" id="nd_booking_archive_form_date_range_from" value="" />
                                </div>
                                <div class="form-group">        
                                    <p class="hotel-booking-form-1-label">Tarikh keluar:</p>
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
                                <div class="form-group mt-4">                                    
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb_20">Jumlah Harga</h4>
                                        <p>$9.0</p>
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

    <?php
	$counter = 1;

	if (isset($_GET['penginapan_id'])) {
		$current_penginapan_id = $_GET['penginapan_id'];
		$sql = "SELECT penginapan_id, jenis_bilik, kadar_sewa, bilanganPenyewa, jumlah_bilik, gambar FROM penginapan WHERE penginapan_id != $current_penginapan_id";
		$result = $conn->query($sql);
	}

	if ($result->num_rows > 0) {
		?>
		<section class="section-padding">
			<div class="auto-container">
				<div class="row">
					<?php
					while($row = $result->fetch_assoc()) {
						$animation_delay = 0.2 * $counter;
						?>
						<div class="col-lg-4 col-md-6">
							<div class="room-1-block wow fadeInUp" data-wow-delay="<?php echo $animation_delay; ?>s" data-wow-duration=".8s">
								<div class="room-1-image hvr-img-zoom-1">
									<img src="adminDashboard/controller/uploads/<?php echo $row['gambar']; ?>" 
										 alt="<?php echo $row['jenis_bilik']; ?>" 
										 style="width: 100%; height: 250px; object-fit: cover;">
								</div>
								<div class="room-1-content">
									<p class="room-1-meta-info">Kadar Sewa <span class="theme-color">RM<?php echo number_format($row['kadar_sewa'], 2); ?></span>/hari</p>
									<h4 class="room-1-title mb_20">
										<a href="penginapanDetail.php?penginapan_id=<?php echo $row['penginapan_id']; ?>"><?php echo strtoupper($row['jenis_bilik']); ?></a>
									</h4>
									<p class="room-1-text mb_30">Bilangan penyewa sebanyak <?php echo $row['bilanganPenyewa']; ?> orang</p>
									<div class="link-btn">
										<a href="penginapanDetail.php?penginapan_id=<?php echo $row['penginapan_id']; ?>" class="btn-1 btn-alt">Tempah Sekarang <span></span></a>
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











