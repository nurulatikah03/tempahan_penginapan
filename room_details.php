<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
    <meta charset="utf-8">
    <title>INSKET Booking</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logoLKTN.png">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Responsive File -->
    <link href="assets/css/responsive.css" rel="stylesheet">

    <!-- Color File -->
    <link href="assets/css/color.css" rel="stylesheet">
    <link href="assets/css/preloader.css" rel="stylesheet">


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


        <?php
        include 'partials/header.php';
        include_once 'Models/room.php';

        $room_details = Room::getRoomById($_GET['room_id']);
        if (empty($room_details)) {
        ?>
            <div class="page-title" style="background-image: url(assets/images/background/blok_asarama.webp);">
            <div class="auto-container">
                <h1>Pakej Penginapan</h1>
            </div>
        </div>
            <?php
            include 'partials/404 barang tak jumpa.php';
        } else {
            $_SESSION['room_id'] = $_GET['room_id'];
            $_SESSION['room_name'] = $room_details->getName();
            $_SESSION['room_type'] = $room_details->getType();
            $_SESSION['room_price'] = $room_details->getPrice();
            $_SESSION['room_imgMain'] = $room_details->getImgMain();
            $_SESSION['room_imgBanner'] = $room_details->getImgBanner();
            $_SESSION['room_max_capacity'] = $room_details->getMaxCapacity();

        ?>

            <div class="page-title" style="background-image: url(<?php echo $room_details->getImgBanner() ?>);">
                <div class="auto-container">
                    <h1><?php echo $room_details->getName() ?></h1>
                </div>
            </div>
            <div class="bredcrumb-wrap">
                <div class="auto-container">
                    <ul class="bredcrumb-list">
                        <li><a href="index.php">Laman Utama</a></li>
                        <li><a href="pakejPenginapan.php">Penginapan</a></li>
                        <li><?php echo $room_details->getName() ?></li>
                    </ul>
                </div>
            </div>

            <section class="section-padding">
                <div class="auto-container">
                    <div class="row">
                        <div class="col-lg-8 pe-lg-35">
                            <div class="single-post">
                                <h2 class="mb_10"><?php echo $room_details->getName() ?></h2>
                                <span class="section_heading_title_small" style="font-size: 25px;">RM<?php echo $room_details->getPrice() ?></span>
                                <p class="mb_20 mt_20"><?php echo $room_details->getLongDesc(); ?></p>

                                <!--picture slider-->
                                <div class="slider-container" style="width: 100%; max-width: 828px; height: 450px; position: relative; overflow: hidden; margin-bottom: 20px;">
                                    <div class="slider-wrapper" style="display: flex; transition: transform 0.5s ease;">
                                        <?php
                                        $roomImgs = $room_details->getImgList();
                                        $roomImgs[] = $room_details->getImgMain();

                                        $slideCount = count($roomImgs) > 0 ? count($roomImgs) : 1;
                                        while ($slideCount > 0) {
                                            echo '<div class="slider-slide" style="min-width: 100%; box-sizing: border-box;">';
                                            echo '<img src="' . $roomImgs[$slideCount - 1] . '" alt="Slide image" style="width: 100%; height: 450px; object-fit: cover;">';
                                            echo '</div>';
                                            $slideCount--;
                                        }
                                        ?>
                                    </div>

                                    <button id="prev" style="position: absolute; top: 90%; left: 10px; z-index: 10; transform: translateY(-50%); background: rgba(0, 0, 0, 0.8); color: white; border-radius: 25%; padding: 20px;">
                                        <span><i class="icon-3"></i></span>
                                    </button>
                                    <button id="next" style="position: absolute; top: 90%; right: 10px; z-index: 10; transform: translateY(-50%); background: rgba(0, 0, 0, 0.8); color: white; border-radius: 25%; padding: 20px;">
                                        <span><i class="icon-2"></i></span>
                                    </button>
                                </div>

                                <!-- Pagination dots--->
                                <div class="pagination" style="display: flex; justify-content: center;">
                                    <?php
                                    $slideCount = count($roomImgs) > 0 ? count($roomImgs) : 1;
                                    $dotCount = 0;

                                    while ($slideCount > 0) {
                                        echo '<span class="dot" style="height: 15px; width: 15px; margin: 0 5px; cursor: pointer; background-color: #bbb; border-radius: 50%; display: inline-block;"></span>';
                                        $slideCount--;
                                        $dotCount++;
                                    }
                                    ?>
                                </div>
                                <!--picture slider END-->


                                <!-- Kemudahan -->
                                <h3 class="fs_40 mb_30">Kemudahan</h3>
                                <p class="mb_50"><?php echo $room_details->getAmenDesc() ?></p>
                                <div class="row mb_30">

                                    <?php
                                    $amenities = $room_details->getAminitiesList();
                                    if (empty($amenities)) {
                                        echo '<p>No amenities available.</p>';
                                    } else {
                                        foreach ($amenities as $row) {
                                            echo '<div class="col-md-4 col-sm-6 mb_45">';
                                            echo '<div class="d-flex align-items-center">';
                                            echo '<img src="' . $row['icon_url'] . '" alt="' . $row['name'] . ' icon" class="theme-color fs_40 w_55 mr_25">';
                                            echo '<p class="fw_medium mb_0">' . $row['name'] . '</p>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="widget mb_40 gray-bg p_40" style="border: #254222 solid 2px;">
                                <h4 class="mb_20"><u>Matlumat Tempahan</u></h4>
                                <div class="booking-form-3">

                                    <form class="hotel-booking-form-1-form d-block" action="Controller/1_reserve.php" method="POST">
                                        <div class="form-group">
                                            <p class="hotel-booking-form-1-label">TARIKH MASUK:</p>
                                            <input placeholder="17 Sep, 2022" type="text" name="check_in" id="nd_booking_archive_form_date_range_from" value="" />
                                        </div>
                                        <div class="form-group">
                                            <p class="hotel-booking-form-1-label">TARIKH KELUAR:</p>
                                            <input placeholder="21 Sep, 2022" type="text" name="check_out" id="nd_booking_archive_form_date_range_to" value="" />
                                        </div>
                                        <?php if (!strcasecmp($room_details->getType(), 'homestay') == 0): ?>

                                            <div class="form-group">
                                                <p class="hotel-booking-form-1-label">BILIK:</p>
                                                <select name="rooms">
                                                    <option value="1">1 BILIK</option>
                                                    <option value="2">2 BILIK</option>
                                                    <option value="3">3 BILIK</option>
                                                    <option value="4">4 BILIK</option>
                                                    <option value="5">5 BILIK</option>
                                                </select>
                                            </div>

                                        <?php else: ?>
                                            <input type="hidden" name="rooms" value="1">
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <p class="hotel-booking-form-1-label">DEWASA:</p>
                                            <select name="adults">
                                                <option value="2">2 DEWASA</option>
                                                <option value="1">1 DEWASA</option>
                                                <option value="3">3 DEWASA</option>
                                                <option value="4">4 DEWASA</option>
                                                <option value="5">5 DEWASA</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb_50">
                                            <p class="hotel-booking-form-1-label">KANAK-KANAK:</p>
                                            <select name="children">
                                                <option value="0">TIADA KANAK-KANAK</option>
                                                <option value="1">1 KANAK-KANAK</option>
                                                <option value="2">2 KANAK-KANAK</option>
                                                <option value="3">3 KANAK-KANAK</option>
                                                <option value="4">4 KANAK-KANAK</option>
                                                <option value="5">5 KANAK-KANAK</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <button type="submit" name="submit" class="btn-1">Tempah Sekarang<span></span></button>
                                            <input type="hidden" name="process" value="penginapan">
                                        </div>
                                    </form>
                                    <?php
                                    if (isset($_SESSION['err'])) {
                                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['err'] . '</div>';
                                        unset($_SESSION['err']);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script>
                let currentIndex = 0;

                const slides = document.querySelectorAll('.slider-slide');
                const totalSlides = slides.length;
                const dots = document.querySelectorAll('.dot');

                document.getElementById('next').addEventListener('click', function() {
                    if (currentIndex < totalSlides - 1) {
                        currentIndex++;
                    } else {
                        currentIndex = 0;
                    }
                    updateSlider();
                });

                document.getElementById('prev').addEventListener('click', function() {
                    if (currentIndex > 0) {
                        currentIndex--;
                    } else {
                        currentIndex = totalSlides - 1;
                    }
                    updateSlider();
                });

                function updateSlider() {
                    const sliderWrapper = document.querySelector('.slider-wrapper');
                    const newTranslateValue = -currentIndex * 100 + '%';
                    sliderWrapper.style.transform = 'translateX(' + newTranslateValue + ')';

                    dots.forEach(dot => dot.style.backgroundColor = '#bbb');

                    dots[currentIndex].style.backgroundColor = '#717171';
                }

                dots.forEach((dot, index) => {
                    dot.addEventListener('click', function() {
                        currentIndex = index;
                        updateSlider();
                    });
                });

                updateSlider();
            </script>


        <?php
            include 'partials/additional_room.php';
        }
        include 'partials/footer.php'; ?>

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
        window.addEventListener("load", function() {
            setTimeout(function() {
                document.querySelector(".js-preloader").classList.add("loaded");
            }, 1000);
        });
    </script>




</body>

</html>