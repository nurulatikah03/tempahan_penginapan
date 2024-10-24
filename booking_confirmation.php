<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>INSKET Room Booking</title>
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

<body>

<div class="page-wrapper">
	
	<?php include 'partials/header.php';?>

    <div class="page-title" style="background-image: url(<?php echo $_SESSION['room_banner']; ?>);">
        <div class="auto-container">
            <h1><?php echo $_SESSION['room_name']?></h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.php">Laman Utama</a></li>
                <li><a href="room_selection.php">Penginapan</a></li>
                <li><?php echo $_SESSION['room_name']?></li>
            </ul>
        </div>
    </div>
    <?php
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];

        $checkInDate = DateTime::createFromFormat('d/m/Y', $check_in);
        $checkOutDate = DateTime::createFromFormat('d/m/Y', $check_out);
        $_SESSION["checkInDate"] = $checkInDate->format('d-m-Y');
        $_SESSION["checkOutDate"] = $checkOutDate->format('d-m-Y');
        $interval = $checkInDate->diff($checkOutDate);
        $num_of_night = $interval->days; 
        $room_num = $_POST['rooms'];
        $price = $room_num * $_SESSION['room_price'] * $num_of_night;
        ?>
    <section class="section-padding">
        <div class="auto-container">
            <div class="row">
            <div class="col-lg-4">
                    <div class="widget mb_40 gray-bg p_40" style="padding-top: 10px;">
                        <u><h4 class="mb_20">Pengesahan Tempahan</h4></u>
                            <p><strong>Tarikh Masuk:</strong> <?php echo htmlspecialchars($_POST['check_in']); ?></p>
                            <p><strong>Tarikh Keluar:</strong> <?php echo htmlspecialchars($_POST['check_out']); ?></p>
                            <p><strong>Bilangan Hari:</strong> <?php echo $num_of_night; ?></p>
                            <?php
                            if ($_SESSION['room_type'] !== "homestay") {
                                echo "<p><strong>Bilangan Bilik:</strong> " . htmlspecialchars($_POST['rooms']) . "</p>";
                            }
                            ?>
                            <p><strong>Bilangan Orang Dewasa:</strong> <?php echo htmlspecialchars($_POST['adults']); ?></p>
                            <p><strong>Bilangan Kanak-kanak:</strong> <?php echo htmlspecialchars($_POST['children']); ?></p>
                            <p><strong>Harga keseluruhan: </strong>RM<?php echo htmlspecialchars($price); ?></p>
                            <a href="room_details.php?room_id=<?php echo $_SESSION["room_id"]?>" class="btn-1">Ubah matlumat<span></span></a>
                        </div>
                </div>                
                <div class="col-lg-8 pe-lg-35">
                    <div class="single-post"> 
                        <h3 class="mb_40">Masukkan maklumat peribadi anda</h3>
                            <form class="hotel-booking-form-1-form d-block" action="payment_page.php" method="POST">
                                        <div class="form-group">
                                        <p class="hotel-booking-form-1-label">Nama Penuh: </p>
                                            <div class="form-floating">
                                                <input class="form-control" type="text" name="full_name" value="" placeholder="Nama"  required/>
                                                <label for = "text">Nama</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="hotel-booking-form-1-label">Alamat Email: </p>
                                                    <div class="form-floating">
                                                        <input class="form-control" type="email" name="form-email" value="" placeholder="" required />
                                                        <label for="email">E-mail</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <p class="hotel-booking-form-1-label">Nombor telefon:</p>
                                                    <div class="form-floating">
                                                        <input class="form-control" type="text" name="phone_number" id="phone_number" placeholder="" value="" required />
                                                        <label for="phone_number">Nombor fon</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="price" value ="<?php echo $price ?>">
                                        <input type="hidden" name="num_of_night" value ="<?php echo $num_of_night ?>">
                                        
                                        <div class="form-group mb-0 text-end">
                                            <button type="submit" class="btn-1" >Bayar<span></span></button>
                                        </div>
                                </form>
                </div>
                
            </div>
        </div>
    </section>

    <!-- Room Selection -->
    <section class="section-padding">
    <div class="auto-container">
        <div class="section_heading text-left mb_30 mt_30">
            <h3 class="section_heading_title_big">Pilihan bilik lain</h3>
        </div>
        <div class="row">
            <?php
            include("database/database.php");

            $selected_room_id = $_SESSION['room_id'];
            $stmt = "SELECT * FROM room r LEFT JOIN room_img ri ON r.room_id = ri.room_id WHERE image_type = 'main';"; // Only available rooms
            $result = $conn->query($stmt);

            if ($result->num_rows > 0) {
                while ($room = $result->fetch_assoc()) {
                    $room_id = $room['room_id'];
                    
                    if ($room_id == $selected_room_id) {
                        continue;
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
                    echo "<p>No rooms available at the moment.</p>";
                }
                ?>
            </div>
        </div>
    </section>


    
    <?php include 'partials/footer.php';
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


</body>
</html>