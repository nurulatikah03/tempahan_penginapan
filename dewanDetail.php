<?php

include 'database/DBConnec.php';

session_start();
$_SESSION['id_dewan'] = $_GET['id_dewan'];
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
    <link href="assets/css/preloader.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;500;600;700&family=DM+Sans:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<style>
    .form-group {
        margin-bottom: 20px;
    }

    .form-group input[type="date"] {
        width: 100%;
        padding: 12px;
        font-size: 14px;
        color: #555;
        border: 1px solid #ccc;
        border-radius: 5px;
        /* Rounded input fields */
        background-color: #fff;
        box-shadow: none;
        transition: border-color 0.3s ease;
    }

    .form-group input[type="date"]:focus {
        border-color: #c77a63;
        /* Change border color on focus */
        outline: none;
    }

    .widget {
        background-color: #e6e6e6;
        /* Light gray background */
        border-radius: 10px;
        padding: 40px;
    }

    .carousel-control-prev {
        left: 10px;
        /* Positioned to the left */
    }

    .carousel-control-next {
        right: 10px;
        /* Positioned to the right */
    }

    .carousel-control-prev,
    .carousel-control-next {
        position: absolute;
        background-color: rgba(0, 0, 0, 1);
        /* Darker background (higher alpha value) */
        border-radius: 5px;
        /* Slightly rounded corners */
        padding: 8px;
        top: 80%;
        /* Position near the bottom */
        z-index: 10;
        width: 70px;
        /* Width of the button */
        height: 70px;
        /* Height of the button */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.4);
    }

    .carousel-control-prev {
        left: 10px;
    }

    .carousel-control-next {
        right: 10px;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        font-size: 30px;
        color: white;
    }


    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background-color: rgba(0, 0, 0, 0.5);
    }

    /* Style the pagination dots */
    .carousel-indicators button {
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        width: 15px;
        height: 15px;
        border: none;
        transition: all 0.3s ease;
    }

    .carousel-indicators .active {
        background-color: #007bff;
        transform: scale(1.2);
    }

    .carousel-indicators button:hover {
        background-color: #007bff;
        transform: scale(1.2);
    }

    .carousel-indicators {
        bottom: 10px;
    }
</style>

<body>

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

    <div class="page-wrapper">

        <?php include 'partials/header.php'; ?>
        <?php
        $conn = DBConnection::getConnection();

        if (isset($_GET['id_dewan'])) {
            $id_dewan = $_GET['id_dewan'];
        } else {
            echo '<div class="alert alert-danger">ID Dewan tidak ditemui.</div>';
            exit;
        }

        $query = "
			SELECT 
				dewan.id_dewan, 
				dewan.nama_dewan, 
				dewan.kadar_sewa, 
				dewan.bilangan_muatan, 
				dewan.penerangan, 
				dewan.penerangan_ringkas, 
				dewan.penerangan_kemudahan, 
				dewan.status_dewan, 
				dewan.max_capacity, 
				url_gambar.url_gambar,
				url_gambar.jenis_gambar
			FROM dewan
				LEFT JOIN url_gambar ON dewan.id_dewan = url_gambar.id_dewan
				WHERE dewan.id_dewan = ?
				";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_dewan);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<div class="row">';
            $utama_image = '';
            $banner_image = '';
            $tambahan_images = [];

            while ($row = $result->fetch_assoc()) {
                $id_dewan = $row['id_dewan'];
                $nama_dewan = $row['nama_dewan'];
                $kadar_sewa = $row['kadar_sewa'];
                $bilangan_muatan = $row['bilangan_muatan'];
                $penerangan = $row['penerangan'];
                $penerangan_ringkas = $row['penerangan_ringkas'];
                $penerangan_kemudahan = $row['penerangan_kemudahan'];
                $max_capacity = $row['max_capacity'];
                $status_dewan = $row['status_dewan'];
                $url_gambar = $row['url_gambar'];
                $jenis_gambar = $row['jenis_gambar'];

                if ($jenis_gambar == 'main') {
                    $utama_image = $url_gambar;
                } elseif ($jenis_gambar == 'banner') {
                    $banner_image = $url_gambar;
                } elseif ($jenis_gambar == 'add') {
                    $tambahan_images[] = $url_gambar;
                }
            }
            echo '</div>';
            ?>
            <div class="page-title" style="
                    background-image: url('adminDashboard/controller/<?php echo $banner_image; ?>');
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                ">
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
            <?php
        } else {
            echo "<p>No details found for the selected hall.</p>";
        }
        ?>

        <section class="section-padding">
            <div class="auto-container">
                <div class="row">
                    <div class="col-lg-8 pe-lg-35">
                        <div class="single-post">
                            <h2 class="mb_10"><?php echo $nama_dewan; ?></h2>
                            <span class="section_heading_title_small" style="font-size: 25px;">Kadar Sewa
                                RM<?php echo htmlspecialchars(number_format($kadar_sewa, 2)); ?>/hari</span>
                            <p class="mb_20 mt_20"><strong>Bilangan muatan</strong>:
                                <?php echo htmlspecialchars($bilangan_muatan); ?> Orang</p>

                            <p class="mb_20"><?php echo htmlspecialchars($penerangan); ?></p>

                            <div id="imageCarousel" class="carousel slide mb_60" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php if (!empty($utama_image)) { ?>
                                        <div class="carousel-item active">
                                            <img src="adminDashboard/controller/<?php echo $utama_image; ?>"
                                                alt="Gambar Utama" class="d-block w-100"
                                                style="height: 450px; object-fit: cover;">
                                        </div>
                                    <?php } ?>

                                    <?php
                                    if (!empty($tambahan_images)) {
                                        foreach ($tambahan_images as $index => $image) {
                                            ?>
                                            <div class="carousel-item">
                                                <img src="adminDashboard/controller/<?php echo $image; ?>"
                                                    alt="Gambar Tambahan <?php echo $index + 1; ?>" class="d-block w-100"
                                                    style="height: 450px; object-fit: cover;">
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <div class="carousel-indicators">
                                    <?php if (!empty($utama_image)) { ?>
                                        <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="0"
                                            class="active" aria-label="Slide 1"></button>
                                    <?php } ?>

                                    <?php
                                    if (!empty($tambahan_images)) {
                                        foreach ($tambahan_images as $index => $image) {
                                            $active_class = ($index == 0 && empty($utama_image)) ? 'active' : '';
                                            ?>
                                            <button type="button" data-bs-target="#imageCarousel"
                                                data-bs-slide-to="<?php echo $index + 1; ?>"
                                                class="<?php echo $active_class; ?>"
                                                aria-label="Slide <?php echo $index + 1; ?>"></button>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="widget mb_40 gray-bg p_40" style="border: #254222 solid 2px;">
                            <h4 class="mb_20"><u>Maklumat Tempahan</u></h4>
                            <div class="booking-form-3">

                                <form class="hotel-booking-form-1-form d-block"
									action="Controller/1_dewan.php"
									method="POST">
									<div class="form-group">
										<p class="hotel-booking-form-1-label">TARIKH MASUK:</p>
										<input type="date" name="checkInDate" id="checkInDate" min="<?php echo date('Y-m-d'); ?>" required/>
									</div>
									<div class="form-group">
										<p class="hotel-booking-form-1-label">TARIKH KELUAR:</p>
										<input type="date" name="checkOutDate" id="checkOutDate" min="<?php echo date('Y-m-d'); ?>" required/>
									</div>
									<div class="form-group mb-3">
										<button type="submit" class="btn-1">Buat Tempahan<span></span></button>
										<input type="hidden" name="process" value="dewan">
									</div>
								</form>

                                <?php
                                if (isset($_SESSION['err01'])) {
                                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['err01'] . '</div>';
                                    unset($_SESSION['err01']);
                                } elseif (isset($_SESSION['err02'])) {
                                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['err02'] . '</div>';
                                    unset($_SESSION['err02']);
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <h3 class="fs_40 mb_30">Kemudahan</h3>
                    <p class="mb_20"><?php echo htmlspecialchars($penerangan_kemudahan); ?></p>

                    <div class="row">
                        <?php

                        $query = "
							SELECT k.nama, k.icon_url
							FROM kemudahan k
							JOIN dewan_kemudahan dk ON k.id_kemudahan = dk.id_kemudahan
							WHERE dk.id_dewan = ?
						";

                        if ($stmt = $conn->prepare($query)) {
                            $stmt->bind_param("i", $id_dewan);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $nama_kemudahan = $row['nama'];
                                    $icon_url = $row['icon_url'];
                                    echo '<div class="col-4">';
                                    echo '<div class="kemudahan-item">';

                                    if ($icon_url) {
                                        echo '<img src="' . $icon_url . '" alt="' . $nama_kemudahan . '" style="height: 50px; margin-right: 30px;">';
                                    }

                                    echo $nama_kemudahan;
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<div class="col-12">Tiada kemudahan tersedia.</div>';
                            }

                            $stmt->close();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <?php include 'partials/additional_dewan.php'; ?>
        <?php include 'partials/footer.php'; ?>

    </div>

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
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tarikh_masuk').setAttribute('min', today);
        document.getElementById('tarikh_keluar').setAttribute('min', today);

        document.getElementById('tarikh_masuk').addEventListener('change', function () {
            const masukDate = this.value;
            document.getElementById('tarikh_keluar').setAttribute('min', masukDate);
        });
    </script>
    <script>
        window.addEventListener("load", function () {
            setTimeout(function () {
                document.querySelector(".js-preloader").classList.add("loaded");
            }, 1000);
        });
    </script>
	<script>
	// JavaScript untuk mengawal tarikh keluar
	document.getElementById('checkInDate').addEventListener('change', function () {
		// Ambil nilai tarikh masuk
		let checkInDate = document.getElementById('checkInDate').value;

		// Tetapkan 'min' untuk tarikh keluar berdasarkan tarikh masuk
		document.getElementById('checkOutDate').min = checkInDate;

		// Jika tarikh keluar kurang daripada tarikh masuk, kosongkan nilai tarikh keluar
		if (document.getElementById('checkOutDate').value < checkInDate) {
			document.getElementById('checkOutDate').value = checkInDate;
		}
	});
</script>


</body>

</html>