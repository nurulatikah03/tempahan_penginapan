<?php

include 'database/DBConnec.php';

session_start();

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

        <?php include 'partials/header.php'; ?>
        <?php
        $conn = DBConnection::getConnection();

        if (isset($_GET['id_aktiviti'])) {
            $id_aktiviti = $_GET['id_aktiviti'];
        } else {
            echo '<div class="alert alert-danger">ID Aktiviti tidak ditemui.</div>';
            exit;
        }

        $query = "
			SELECT 
				aktiviti.id_aktiviti, 
				aktiviti.nama_aktiviti, 
				aktiviti.kadar_harga, 
				aktiviti.penerangan_kemudahan,
				aktiviti.penerangan, 
				aktiviti.status_aktiviti, 
				url_gambar.url_gambar,
				url_gambar.jenis_gambar
			FROM aktiviti
				LEFT JOIN url_gambar ON aktiviti.id_aktiviti = url_gambar.id_aktiviti
				WHERE aktiviti.id_aktiviti = ?
				";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_aktiviti);
        $stmt->execute();
        $result = $stmt->get_result();        

        if ($result->num_rows > 0) {
            echo '<div class="row">';
            $utama_image = '';
            $banner_image = '';
            $tambahan_images = [];

        while ($row = $result->fetch_assoc()) {
			$id_aktiviti = $row['id_aktiviti'];
            $nama_aktiviti = $row['nama_aktiviti'];
			$kadar_harga = $row['kadar_harga'];
            $penerangan_kemudahan = $row['penerangan_kemudahan'];
            $penerangan = $row['penerangan'];
            $status_aktiviti = $row['status_aktiviti'];
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
            <!-- Page Title -->
            <div class="page-title" style="
                    background-image: url('adminDashboard/controller/<?php echo $banner_image; ?>');
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                ">
                <div class="auto-container">
                    <h1><?php echo $nama_aktiviti; ?></h1>
                </div>
            </div>

            <!-- Breadcrumb -->
            <div class="bredcrumb-wrap">
                <div class="auto-container">
                    <ul class="bredcrumb-list">
                        <li><a href="index.php">Laman Utama</a></li>
                        <li><a href="pakejAktiviti.php">Aktiviti</a></li>
                        <li><?php echo $nama_aktiviti; ?></li>
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
                           <h2 class="mb_10"><?php echo $nama_aktiviti; ?></h2>
								<span class="section_heading_title_small" style="font-size: 25px;" >Kadar Sewa
									RM<?php echo htmlspecialchars(number_format($kadar_harga, 2)); ?></span>	
								<p class="mb_20"><?php echo htmlspecialchars($penerangan); ?></p>

                            <div id="imageCarousel" class="carousel slide mb_60" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <!-- Gambar Utama (Main Image) -->
                                    <?php if (!empty($utama_image)) { ?>
                                        <div class="carousel-item active">
                                            <img src="adminDashboard/controller/<?php echo $utama_image; ?>"
                                                alt="Gambar Utama" class="d-block w-100"
                                                style="height: 450px; object-fit: cover;">
                                        </div>
                                    <?php } ?>

                                    <!-- Loop through the tambahan images (Additional Images) -->
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

                                <!-- Carousel Indicators (Pagination Dots) -->
                                <div class="carousel-indicators">
                                    <!-- Indicator for the Main Image -->
                                    <?php if (!empty($utama_image)) { ?>
                                        <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="0"
                                            class="active" aria-label="Slide 1"></button>
                                    <?php } ?>

                                    <!-- Indicators for the Additional Images -->
                                    <?php
                                    if (!empty($tambahan_images)) {
                                        foreach ($tambahan_images as $index => $image) {
                                            $active_class = ($index == 0 && empty($utama_image)) ? 'active' : ''; // Set first image as active
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

                                <!-- Carousel Controls -->
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
								action="Controller/1_aktiviti.php?id_aktiviti=<?php echo htmlspecialchars($id_aktiviti); ?>"
								method="POST" onsubmit="return validateBooking();">
								<div class="form-group">
									<p class="hotel-booking-form-1-label">TARIKH MASUK:</p>
									<input type="text" placeholder="dd/mm/yyyy" name="checkInDate" id="nd_booking_archive_form_date_range_from" value="" />
								</div>
								<div class="form-group">
									<p class="hotel-booking-form-1-label">TARIKH KELUAR:</p>
									<input type="text" placeholder="dd/mm/yyyy" name="checkOutDate" id="nd_booking_archive_form_date_range_to" value="" />
								</div>
								<div class="form-group">
									<p class="hotel-booking-form-1-label">BILANGAN PESERTA:</p>
									<input type="number" min="1" placeholder="Masukkan jumlah peserta" name="num_of_person"
										id="nd_booking_archive_form_participants_count" value="" required onchange="updateRooms();" />
								</div>

								<div class="form-group">
									<p class="hotel-booking-form-1-label">JUMLAH BILIK:</p>
									<input type="number" min="1" placeholder="Jumlah bilik akan dikira" name="num_of_rooms" id="num_of_rooms" value="" required readonly />
								</div>

								<div class="form-group">
									<p class="hotel-booking-form-1-label">NAMA BILIK:</p>
									<?php 
									// Query untuk mendapatkan data bilik berdasarkan kapasitas maksimum
									$query = "SELECT nama_bilik, max_capacity FROM bilik WHERE id_bilik = 1";
									$result = $conn->query($query);

									if ($result && $result->num_rows > 0) {
										$row = $result->fetch_assoc();
										$nama_bilik = $row['nama_bilik'];
										$max_capacity = $row['max_capacity'];
									} else {
										$nama_bilik = "Tidak dapat memaparkan nama bilik.";
										$max_capacity = 0;
									}
									?>
									<input type="text" id="nama_bilik" placeholder="Nama bilik akan dipaparkan" readonly value="<?php echo htmlspecialchars($nama_bilik); ?>" />
								</div>

								<div class="form-group">
									<p class="hotel-booking-form-1-label">NAMA DEWAN:</p>
									<?php 
									$query = "SELECT nama_dewan FROM dewan WHERE id_dewan = 16";
									$result = $conn->query($query);

									if ($result && $result->num_rows > 0) {
										$row = $result->fetch_assoc();
										$nama_dewan = $row['nama_dewan'];
									} else {
										$nama_dewan = "Tidak dapat memaparkan nama dewan.";
									}
									?>
									<input type="text" id="nama_dewan" placeholder="Nama Dewan akan dipaparkan" readonly value="<?php echo htmlspecialchars($nama_dewan); ?>" />
								</div>

								<div class="form-group">
								<div class="form-group mb-3">
									<button type="submit" class="btn-1" id="bookingButton" disabled>Buat Tempahan<span></span></button>
									<input type="hidden" name="process" value="aktiviti">
								</div>
							</div>
							</form>
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
								JOIN aktiviti_kemudahan ak ON k.id_kemudahan = ak.id_kemudahan
								WHERE ak.id_aktiviti = ?
							";

							if ($stmt = $conn->prepare($query)) {
							$stmt->bind_param('i', $id_aktiviti);  // Bind id_aktiviti to the query
							$stmt->execute();
							$result = $stmt->get_result();

							if ($result->num_rows > 0) {
								// Loop through the results and display each kemudahan
								while ($row = $result->fetch_assoc()) {
									$nama_kemudahan = $row['nama'];
									$icon_url = $row['icon_url'];
									echo '<div class="col-4">';
									echo '<div class="kemudahan-item">';
									
									// Display icon if available
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

		<?php
		
		include 'partials/additional_aktiviti.php';
		include 'partials/footer.php'; ?>

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
	
	<script>
// Fungsi untuk mengupdate jumlah bilik dan memeriksa ketersediaan bilik
function updateRooms() {
    const participantsCount = document.getElementById('nd_booking_archive_form_participants_count').value;
    const roomsCountInput = document.getElementById('num_of_rooms');
    const maxCapacity = <?php echo $max_capacity; ?>;
    const bookingButton = document.getElementById('bookingButton'); // Tombol buat tempahan

    if (participantsCount && maxCapacity) {
        // Hitung jumlah bilik (2 peserta per bilik)
        const requiredRooms = Math.ceil(participantsCount / 2);

        // Periksa ketersediaan bilik
        if (requiredRooms <= maxCapacity) {
            roomsCountInput.value = requiredRooms;

            // Enable button if room count is sufficient
            bookingButton.disabled = false; 
        } else {
            alert(`Maaf, hanya ${maxCapacity} bilik yang tersedia.`);
            roomsCountInput.value = maxCapacity;

            // Disable button if room count exceeds available capacity
            bookingButton.disabled = true;
        }
    }
}

// Fungsi untuk validasi tempahan sebelum dihantar
function validateBooking() {
    const participantsCount = document.getElementById('nd_booking_archive_form_participants_count').value;
    const roomsCount = document.getElementById('num_of_rooms').value;
    const maxCapacity = <?php echo $max_capacity; ?>;

    // Jika jumlah bilik tidak mencukupi
    if (roomsCount > maxCapacity) {
        alert('Maaf, jumlah bilik tidak mencukupi.');
        return false; // Menghalang form dari dihantar
    }

    return true; // Teruskan penghantaran form
}
</script>
	<script>
    document.addEventListener("DOMContentLoaded", function () {
        const idDewan = "<?= isset($_POST['id_dewan']) ? $_POST['id_dewan'] : ''; ?>";
        
        if (idDewan) {
            fetch('get_nama_dewan.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id_dewan: idDewan }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.nama_dewan) {
                        document.getElementById('nama_dewan').value = data.nama_dewan;
                    } else {
                        console.error('No results found for the given ID.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
	</script>

	<script>
		// Set today's date as the minimum date
		const today = new Date().toISOString().split('T')[0];
		document.getElementById('tarikh_masuk').setAttribute('min', today);
		document.getElementById('tarikh_keluar').setAttribute('min', today);

		// Set minimum date for 'tarikh_keluar' based on 'tarikh_masuk' selection
		document.getElementById('tarikh_masuk').addEventListener('change', function() {
			const masukDate = this.value;
			document.getElementById('tarikh_keluar').setAttribute('min', masukDate);
		});
	</script>
	<script>
		document.getElementById('nd_booking_archive_form_participants_count').addEventListener('input', function() {
			// Get the number of participants
			const numParticipants = parseInt(this.value, 10);

			// Calculate the number of rooms (round up, because 2 participants per room)
			const numRooms = Math.ceil(numParticipants / 2);

			// Set the calculated value to the 'num_of_rooms' field
			document.getElementById('num_of_rooms').value = numRooms;
		});
	</script>

	<script>
		window.addEventListener("load", function() {
			setTimeout(function() {
				document.querySelector(".js-preloader").classList.add("loaded");
			}, 1000);
		});
	</script>
</body>

</html>