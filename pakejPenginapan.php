<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>INSKEP Room</title>
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
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<style>

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
	
	<?php 
    include 'partials/header.php';
    include("database/database.php");

    $stmt = "SELECT * FROM room";
    try {
        $result = mysqli_query($conn, $stmt);
        $row = mysqli_fetch_assoc($result);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

    <div class="page-title" style="background-image: url(assets/images/background/blok_asarama.webp);">
        <div class="auto-container">
            <h1>Pakej Penginapan</h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.php">Laman Utama</a></li>
                <li>Penginapan</li>
            </ul>
        </div>
    </div>

    <!-- Room -->
    <section class="section-padding">
        <div class="auto-container">
            <div class="section_heading text-center mb_30 mt_30">
                <span class="section_heading_title_small">TAWARAN ISTIMEWA</span>
                <h2 class="section_heading_title_big">Pilihan bilik</h2>
            </div>
            <div class="row">
                <?php
                $stmt = "SELECT r.room_id,r.room_name,r.price_per_day, r.short_description,ri.image_url FROM room r LEFT JOIN room_img ri ON r.room_id = ri.room_id WHERE image_type = 'main';"; 
                $result = $conn->query($stmt);

                // Check if there are rooms available
                if ($result->num_rows > 0) {
                    // Loop through each room and display it
                    while ($room = $result->fetch_assoc()) {

                        $room_name = $room['room_name'];
                        $short_description = $room['short_description'];
                        $price = $room['price_per_day'];
                        $main_img = $room['image_url']; 
                        $room_id = $room['room_id']; 
                ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="room-1-block wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1.2s">
                                <div class="room-1-image hvr-img-zoom-1">
                                    <img src="<?php echo htmlspecialchars($main_img); ?>" alt="">
                                </div>
                                <div class="room-1-content">
                                    <p class="room-1-meta-info">Bermula dari <span class="theme-color">RM<?php echo htmlspecialchars($price); ?></span>/malam</p>
                                    <h4 class="room-1-title mb_20">
                                        <a href="room-details_<?php echo htmlspecialchars($room_id); ?>.php">
                                            <?php echo htmlspecialchars($room_name); ?>
                                        </a>
                                    </h4>
                                    <p class="room-1-text mb_30"><?php echo htmlspecialchars($short_description); ?></p>
                                    <div class="link-btn">
                                        <a href="room_details.php?room_id=<?php echo htmlspecialchars($room_id); ?>" class="btn-1 btn-alt">Tempah Sekarang <span></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                } else {
                    // If no rooms are found
                    echo "<p>No rooms available at the moment.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <?php include 'partials/footer.php';
    mysqli_close($conn)?>
	
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