<?php
include("database/database.php");

$stmt = "SELECT * FROM room WHERE room_id = '" . $_GET['room_id'] . "'";
try {
    $result = mysqli_query($conn, $stmt);
    $row = mysqli_fetch_assoc($result);
    
    session_start();
    $_SESSION['room_id'] = $_GET['room_id'];
    $_SESSION['room_name'] = $row['room_name'];
    $_SESSION['room_type'] = $row['room_type'];
    $_SESSION['room_price'] = $row['price_per_day'];
    $_SESSION['room_short_desc'] =$row['short_description'];
    $_SESSION['room_long_desc'] = $row['long_description'];

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>INSKET Booking</title>
<link rel="icon" type="image/x-icon" href="assets/images/logo2.png">
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

<body>

<div class="page-wrapper">

	
	<?php include 'partials/header.php';
    
    $stmt2 = "SELECT image_url FROM room_img WHERE room_id = '" . $_GET['room_id'] . "' AND image_type = 'banner'";
    try {
        $result2 = mysqli_query($conn, $stmt2);
        $row2 = mysqli_fetch_assoc($result2);
        $imgt = $row2['image_url'];
        $_SESSION['room_banner'] = $imgt;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

    <div class="page-title" style="background-image: url(<?php echo $_SESSION['room_banner']; ?>);">
        <div class="auto-container">
            <h1><?php echo $row['room_name'] ?></h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.php">Laman Utama</a></li>
                <li><a href="room_selection.php">Penginapan</a></li>
                <li><?php echo $_SESSION['room_name'] ?></li>
            </ul>
        </div>
    </div>

    <section class="section-padding">
        <div class="auto-container">
            <div class="row">                
                <div class="col-lg-8 pe-lg-35">
                    <div class="single-post"> 
                        <h2 class="mb_10"><?php echo $row['room_name'] ?></h2>
                        <span class="section_heading_title_small" style="font-size: 25px;" >RM<?php echo $row['price_per_day'] ?></span>
                        <p class="mb_20 mt_20"><?php echo $row['long_description'];?></p>
                        <!--picture slider-->
                        <div class="slider-container" style="width: 100%; max-width: 828px; height: 450px; position: relative; overflow: hidden; margin-bottom: 20px;">
                            <div class="slider-wrapper" style="display: flex; transition: transform 0.5s ease;">
                                    <?php 
                                    // Loop through your image data (e.g., from database or an array)
                                    $images = ['assets/images/resource/room-1_normal.jpg', 'assets/images/resource/room-2_VIP.jpg', 'assets/images/resource/room-3_homestay.jpg']; // Example images
                                    foreach ($images as $image) {
                                        echo '<div class="slider-slide" style="min-width: 100%; box-sizing: border-box;">
                                                <div class="room-1-image hvr-img-zoom-1">
                                                    <img src="'.$image.'" alt="Slide image" style="width: 100%; height: 450px; object-fit: cover;">
                                                </div>
                                            </div>';
                                    }
                                    ?>
                            </div>

                            <!-- Navigation buttons -->
                            <button id="prev" style="position: absolute; top: 90%; left: 10px; z-index: 10; transform: translateY(-50%); background: rgba(0, 0, 0, 0.8); color: white; border-radius: 25%; padding: 20px;"><span><i class="icon-3"></i></span></button>
                            <button id="next" style="position: absolute; top: 90%; right: 10px; z-index: 10; transform: translateY(-50%); background: rgba(0, 0, 0, 0.8); color: white; border-radius: 25%; padding: 20px;"><span><i class="icon-2"></i></span></button>
                        </div>

                        <!-- amenities -->
                        <h3 class="fs_40 mb_30">Amenities</h3>
                        <p class="mb_50">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing integer ultrices suspendisse varius etiam est. Est, felis, tempus nec vitae orci sodales Metus, velit nec at diam in sed. Massa dui ipsum ornare sagittis dolor sagittis amet odio est. Sit semper et velit fusce.</p>

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
                    <div class="widget mb_40 gray-bg p_40" style="border: #254222 solid 2px;">
                        <h4 class="mb_20"><u>Matlumat Tempahan</u></h4>
                        <div class="booking-form-3">
                            
                            <form class="hotel-booking-form-1-form d-block" action="booking_confirmation.php" method="POST">
                                <div class="form-group">
                                    <p class="hotel-booking-form-1-label">TARIKH MASUK:</p>
                                    <input placeholder="17 Sep, 2022" type="text" name="check_in" id="nd_booking_archive_form_date_range_from" value="" />
                                </div>
                                <div class="form-group">
                                    <p class="hotel-booking-form-1-label">TARIKH KELUAR:</p>
                                    <input placeholder="21 Sep, 2022" type="text" name="check_out" id="nd_booking_archive_form_date_range_to" value="" />
                                </div>
                                <?php if ($row['room_type'] == 'room'): ?>
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
                                        <option value="1">1 KANAK-KANAK</option>
                                        <option value="0">TIADA KANAK-KANAK</option>
                                        <option value="2">2 KANAK-KANAK</option>
                                        <option value="3">3 KANAK-KANAK</option>
                                        <option value="4">4 KANAK-KANAK</option>
                                        <option value="5">5 KANAK-KANAK</option>
                                    </select>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn-1">Tempah Sekarang<span></span></button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related room -->
    <section class="section-padding">
        <div class="auto-container">
            <div class="section_heading text-left mb_30 mt_30">
                <h3 class="section_heading_title_big">Pilihan bilik lain</h3>
            </div>
            <div class="row">
                <?php
                $selected_room_id = isset($_GET['room_id']) ? (int)$_GET['room_id'] : 0;
                $stmt = "SELECT * FROM room r LEFT JOIN room_img ri ON r.room_id = ri.room_id WHERE image_type = 'main';";
                $result = $conn->query($stmt);

                // Check if there are rooms available
                if ($result->num_rows > 0) {
                    // Loop through each room and display it
                    while ($room = $result->fetch_assoc()) {
                        // Get room details from the current row
                        $room_id = $room['room_id'];
                        
                        // Skip the room with room_id = 1 if the selected room_id from GET is also 1
                        if ($room_id == $selected_room_id) {
                            continue; // Skip this iteration
                        }

                        $room_name = $room['room_name'];
                        $short_description = $room['short_description'];
                        $price = $room['price_per_day'];
                        $main_img = $room['image_url']; 
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
let currentIndex = 0;

const slides = document.querySelectorAll('.slider-slide');
const totalSlides = slides.length;

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
}
</script>


</body>
</html>
