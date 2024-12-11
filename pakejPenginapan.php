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

        <div class="page-title" style="background-image: url(assets/images/background/blok_asarama.webp);">
            <?php
            include 'partials/header.php';
            include("database/DBConnec.php");
            ?>
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
        <section class="section-padding" style="padding-top: 10px;">
            <div class="auto-container">
                <div class="section_heading text-center mb_30 mt_30">
                    <span class="section_heading_title_small">TAWARAN ISTIMEWA</span>
                    <h2 class="section_heading_title_big">Pilihan Penginapan</h2>
                </div>
                <div class="row">
                    <?php
                    include_once 'Models/room.php';
                    $rooms = Room::getAllRooms();
                    $delay = 0.8;
                    if (!empty($rooms)) {
                        foreach ($rooms as $room) {
                            $room_id = $room->getId();
                            $room_name = $room->getName();
                            $price = $room->getPrice();
                            $short_description = $room->getShortDesc();
                            $main_img = $room->getImgMain();
                    ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="room-1-block wow fadeInUp" data-wow-delay="<?php echo $delay; ?>s" data-wow-duration="1.2s">
                                    <div class="room-1-image hvr-img-zoom-1">
                                        <img src="<?php echo htmlspecialchars($main_img); ?>" style="height: 200px; width:425px">
                                    </div>
                                    <div class="room-1-content">
                                        <p class="room-1-meta-info">Bermula dari <span class="theme-color">RM<?php echo htmlspecialchars($price); ?></span>/malam</p>
                                        <h4 class="room-1-title mb_20">
                                            <a href="room-details?room_id=<?php echo htmlspecialchars($room_id); ?>.php">
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
                            $delay += 0.2;
                        }
                    } else {
                        // If no rooms are found
                        echo "<p>No rooms available at the moment.</p>";
                    }
                    ?>
                </div>
            </div>
        </section>

        <?php include 'partials/footer.php'; ?>

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
        window.addEventListener("load", function() {
            setTimeout(function() {
                document.querySelector(".js-preloader").classList.add("loaded");
            }, 1000);
        });
    </script>


</body>

</html>