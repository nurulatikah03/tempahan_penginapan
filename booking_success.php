<?php session_start()?>

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
                    <li><a href="pakejPenginapan.php">Penginapan</a></li>
                    <li><a href="room_details.php?room_id=<?php echo htmlspecialchars($_SESSION["room_id"]); ?>"><?php echo $_SESSION['room_name']?></a></li>
                    <li>Pengesahan Berjaya</li>
                </ul>
            </div>
        </div>
        
        <div class="container-md mt-5" style="max-width: 800px;">
            <h2 class="text-center mb-4">Your Booking is Successful!</h2>
            
            <!-- Booking Summary -->
            <div class="card">
                <div class="card-header">
                    <h4>Your Booking Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Room name:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["room_name"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Full Name:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["cust_name"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Email Address:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["form-email"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Phone Number:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["phone_number"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Check-in Date:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["checkInDate"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Check-out Date:</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["checkOutDate"]?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Bilangan Hari</strong>
                        </div>
                        <div class="col-sm-8">
                            <?php echo $_SESSION["num_of_night"]?> Hari
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <strong>Total Price:</strong>
                        </div>
                        <div class="col-sm-8">
                            RM<?php echo $_SESSION["total_price"]?>
                        </div>
                    </div>
                </div>
            </div>
            <div style="margin: 50px;"><h3>Check your email for your booking confirmation</h3></div>
        </div>
        <!-- Booking Summary END -->

        
        <?php 
            include 'database/database.php';

            try {
                // Prepare the SQL statement
                $sql = "INSERT INTO tempahan (nama_penuh, numbor_fon, email, tarikh_tempahan, tarikh_daftar_masuk, tarikh_daftar_keluar, harga_keseluruhan, id_bilik) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                
                // Set the current date
                $tarikh_tempahan = date("Y-m-d"); 

                // Prepare the statement
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    throw new Exception("Error preparing statement: " . $conn->error);
                }

                $checkInDate = $_SESSION["checkInDate"];
                $dateTime = DateTime::createFromFormat('d-m-Y', $checkInDate);
                $_SESSION["checkInDate"] = $dateTime->format('Y-m-d');
                $checkOutDate = $_SESSION["checkOutDate"];
                $dateTime = DateTime::createFromFormat('d-m-Y', $checkOutDate);
                $_SESSION["checkOutDate"] = $dateTime->format('Y-m-d');

                // Bind parameters (ensure data types match)
                $stmt->bind_param("ssssssdi", 
                    $_SESSION['cust_name'], 
                    $_SESSION['phone_number'], 
                    $_SESSION['form-email'], 
                    $tarikh_tempahan, 
                    $_SESSION["checkInDate"], 
                    $_SESSION["checkOutDate"], 
                    $_SESSION['total_price'], 
                    $_SESSION['room_id']
                );

                // Execute the statement
                if ($stmt->execute()) {
                } else {
                    throw new Exception("Error executing statement: " . $stmt->error);
                }
                
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                // Close statement and connection
                if ($stmt) {
                    $stmt->close();
                }
                if ($conn) {
                    $conn->close();
                }
            }
        include 'partials/footer.php';?>
        
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