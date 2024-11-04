<?php
include("database/database.php");

$stmt = "SELECT * FROM bilik WHERE id_bilik = '" . $_GET['room_id'] . "'";
try {
    $result = mysqli_query($conn, $stmt);
    $row = mysqli_fetch_assoc($result);
    
    session_start();
    $_SESSION['room_id'] = $_GET['room_id'];
    $_SESSION['room_name'] = $row['nama_bilik'];
    $_SESSION['room_type'] = $row['jenis_bilik'];
    $_SESSION['room_price'] = $row['harga_semalaman'];
    $_SESSION['room_short_desc'] =$row['huraian_pendek'];
    $_SESSION['room_long_desc'] = $row['huraian'];

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
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
    
    $stmt2 = "SELECT url_gambar FROM bilik_pic WHERE id_bilik = '" . $_GET['room_id'] . "' AND jenis_gambar = 'banner'";
    try {
        $result2 = mysqli_query($conn, $stmt2);
        $row2 = mysqli_fetch_assoc($result2);
        $imgt = $row2['url_gambar'];
        $_SESSION['room_banner'] = $imgt;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

    <div class="page-title" style="background-image: url(<?php echo $_SESSION['room_banner']; ?>);">
        <div class="auto-container">
            <h1><?php echo $_SESSION['room_name'] ?></h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.php">Laman Utama</a></li>
                <li><a href="pakejPenginapan.php">Penginapan</a></li>
                <li><?php echo $_SESSION['room_name'] ?></li>
            </ul>
        </div>
    </div>

    <section class="section-padding">
        <div class="auto-container">
            <div class="row">                
                <div class="col-lg-8 pe-lg-35">
                    <div class="single-post"> 
                        <h2 class="mb_10"><?php echo $_SESSION['room_name'] ?></h2>
                        <span class="section_heading_title_small" style="font-size: 25px;" >RM<?php echo $_SESSION['room_price'] ?></span>
                        <p class="mb_20 mt_20"><?php echo $_SESSION['room_long_desc'];?></p>

                        <!--picture slider-->
                        <div class="slider-container" style="width: 100%; max-width: 828px; height: 450px; position: relative; overflow: hidden; margin-bottom: 20px;">
                            <div class="slider-wrapper" style="display: flex; transition: transform 0.5s ease;">
                                <?php
                                $stmt3 = "SELECT url_gambar FROM bilik_pic WHERE id_bilik = ? AND jenis_gambar IN ('main', 'add')";
                                $stmt = mysqli_prepare($conn, $stmt3);
                                mysqli_stmt_bind_param($stmt, "i", $_GET['room_id']);

                                try {
                                    mysqli_stmt_execute($stmt);
                                    $result3 = mysqli_stmt_get_result($stmt);
                                    $slideCount = mysqli_num_rows($result3); // Count the total slides
                                    $slideIndex = 0; // To assign unique data attribute

                                    while ($row2 = mysqli_fetch_assoc($result3)) {
                                        $imageUrl = $row2['url_gambar'];
                                        echo '<div class="slider-slide" style="min-width: 100%; box-sizing: border-box;" data-slide="' . $slideIndex . '">
                                                <img src="' . $imageUrl . '" alt="Slide image" style="width: 100%; height: 450px; object-fit: cover;">
                                            </div>';
                                        $slideIndex++;
                                    }
                                } catch (mysqli_sql_exception $e) {
                                    echo "Error: " . $e->getMessage();
                                }

                                mysqli_stmt_close($stmt);
                                ?>
                            </div>

                            <button id="prev" style="position: absolute; top: 90%; left: 10px; z-index: 10; transform: translateY(-50%); background: rgba(0, 0, 0, 0.8); color: white; border-radius: 25%; padding: 20px;">
                                <span><i class="icon-3"></i></span>
                            </button>
                            <button id="next" style="position: absolute; top: 90%; right: 10px; z-index: 10; transform: translateY(-50%); background: rgba(0, 0, 0, 0.8); color: white; border-radius: 25%; padding: 20px;">
                                <span><i class="icon-2"></i></span>
                            </button>
                        </div>

                        <div class="pagination-dots" style="text-align: center; margin-top: 10px; color:black">
                            <?php for ($i = 0; $i < $slideCount; $i++): ?>
                                <span class="dot" data-slide="<?= $i ?>" style="display: inline-block; width: 10px; height: 10px; margin: 0 5px; background-color: #bbb; border-radius: 50%; cursor: pointer;"></span>
                            <?php endfor; ?>
                        </div>
                        <!--picture slider END-->


                        <!-- Kemudahan -->
                        <h3 class="fs_40 mb_30">Kemudahan</h3>
                        <p class="mb_50"><?php echo $row['huraian_kemudahan']?></p>

                        <?php
                        $stmt4 = "SELECT k.nama, k.icon FROM kemudahan k LEFT JOIN bilik_kemudahan b ON k.id_kemudahan = b.id_bilik_kemudahan WHERE b.id_bilik = $_GET[room_id]";
                        
                        try {
                        $result4 = mysqli_query($conn, $stmt4);

                        if ($result4->num_rows > 0) {
                            echo '<div class="row mb_30">';
                            while($row4 = $result4->fetch_assoc()) {
                                echo '<div class="col-md-4 col-sm-6 mb_45">';
                                echo '<div class="d-flex align-items-center">';
                                echo '<i class="' . $row4['icon'] . ' theme-color fs_40 w_55 mr_25"></i>';
                                echo '<p class="fw_medium mb_0">' . $row4['nama'] . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                            echo '</div>';
                            } else {
                                echo '<p>Tiada Kemudahan disediakan.</p>';
                            }
                        } catch (Exception $e) {
                        echo 'Error: ' . $e->getMessage();
                        }

                        ?>
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
                                <?php if ($_SESSION['room_type'] == 'room'): ?>
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
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn-1">Tempah Sekarang<span></span></button>
                                </div>
                            </form>
                            <?php
                            if (isset($_SESSION['availability_error'])) {
                                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['availability_error'] . '</div>';
                                unset($_SESSION['availability_error']);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <?php 
    include 'partials/additional_room.php';
    include 'partials/footer.php';
    mysqli_close($conn);?>
	
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
const dots = document.querySelectorAll('.dot'); // Get all pagination dots

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

// Update slider position and highlight active dot
function updateSlider() {
    const sliderWrapper = document.querySelector('.slider-wrapper');
    const newTranslateValue = -currentIndex * 100 + '%';
    sliderWrapper.style.transform = 'translateX(' + newTranslateValue + ')';

    // Reset all dots' background color
    dots.forEach(dot => dot.style.backgroundColor = '#bbb');
    
    // Highlight the active dot
    dots[currentIndex].style.backgroundColor = '#717171';
}

// Add click event for each dot to navigate to the corresponding slide
dots.forEach((dot, index) => {
    dot.addEventListener('click', function() {
        currentIndex = index;
        updateSlider();
    });
});

// Initial state
updateSlider();
</script>




</body>
</html>
