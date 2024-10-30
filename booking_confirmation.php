<script>
  window.onload = function() {
    window.scrollTo(0, 480); 
  };
</script>
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

<link rel="shortcut icon" href="assets/images/logoLKTN.png" type="image/x-icon">
<link rel="icon" href="assets/images/logoLKTN.png" type="image/x-icon">
<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

<div class="page-wrapper">

    <div class="page-title" style="background-image: url(<?php echo $_SESSION['room_banner']; ?>);">
    <?php include 'partials/header.php';?>
        <div class="auto-container">
            <h1><?php echo $_SESSION['room_name']?></h1>
        </div>
    </div>
    <div class="bredcrumb-wrap">
        <div class="auto-container">
            <ul class="bredcrumb-list">
                <li><a href="index.php">Laman Utama</a></li>
                <li><a href="pakejPenginapan.php">Penginapan</a></li>
                <li><?php echo $_SESSION['room_name']?></li>
            </ul>
        </div>
    </div>
    <?php
        include 'controller/functions.php';

        if (!checkRoomAvailability($_SESSION['room_id'],$_POST['check_in'], $_POST['check_out'])) {
            $_SESSION['availability_error'] = "Maaf, tiada penginapan ini pada hari yang diminta.";
            echo "<script>window.history.back();</script>";
            exit;} 
        else {
        $num_of_night = calcNumOfNight($_POST['check_in'],$_POST['check_out']);
        $room_num = $_POST['rooms'];
        $price = $room_num * $_SESSION['room_price'] * $num_of_night;
        
        $_SESSION["checkInDate"] = $_POST['check_in'];
        $_SESSION["checkOutDate"] = $_POST['check_out'];
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

    
    <?php 
    }
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


</body>
</html>