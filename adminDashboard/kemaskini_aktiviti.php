<?php
include '../database/DBConnec.php';
include 'controller/get_aktiviti.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>eTempahan INSKET</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo/logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: 'Poppins';
        }

        body[data-leftbar-theme=dark] {
            --ct-bg-leftbar: #254222;
        }

        .end-bar .rightbar-title {

            background-color: #254222;
        }

        .img-modal {
            max-width: 200px;
            height: 150px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 25px;
        }

        .img-modal:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .image-wrapper {
            position: relative;
        }

        .delete-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            z-index: 10;
            padding: 5px 15px;
            font-size: 14px;
            background-color: rgba(255, 0, 0, 0.9);
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .image-container:hover .delete-btn {
            display: block;
        }

        .image-container:hover .img-tambahan {
            filter: brightness(70%);
        }

        .image-container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px;
        }
		
		.img-overlay {
			position: absolute;
			border-radius: 25px;
			font-size: 25px;
			background-color: rgba(0, 0, 0, 0.6);
			width: 88%;
			height: 95%;
		}
		
		.img-content-text {
			position: relative;
		}
    </style>
</head>

<body class="" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid"
    data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">

        <?php include 'partials/left-sidemenu.php'; ?>

        <div class="content-page">
            <div class="content">

                <?php include 'partials/topbar.php'; ?>

                <!-- Start Content-->
                <div class="container-fluid">

                    <?php
                    if (isset($_GET['id_aktiviti'])) {
                        $id_aktiviti = $_GET['id_aktiviti']; // Capture the id_aktiviti from the URL
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
							WHERE aktiviti.id_aktiviti = ?";


                    $conn = DBConnection::getConnection();
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $id_aktiviti);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo '<div class="row">';
                        $main_image = '';
                        $banner_image = '';
                        $add_images = [];

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
                                $main_image = $url_gambar;
                            } elseif ($jenis_gambar == 'banner') {
                                $banner_image = $url_gambar;
                            } elseif ($jenis_gambar == 'add') {
                                $add_images[] = $url_gambar;
                            }
                        }
                        echo '</div>';
                    } else {
                        echo '<div class="alert alert-info">Tiada rekod aktiviti ditemui untuk ID Aktiviti: ' . $id_aktiviti . '.</div>';
                    }

                    $stmt->close();
                    ?>


                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="aktiviti.php">Aktiviti</a></li>
                                        <li class="breadcrumb-item">
                                            <?php echo $nama_aktiviti; ?></a>
                                        </li>
                                        <li class="breadcrumb-item active">Kemaskini</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Kemaskini Kemudahan Aktiviti</h4>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h3 class="text-center"><label class="col-3 col-form-label">Gambar Aktiviti</label>
                                        </h3>
                                        <div class="images">
                                            <div class="row mb-3">
                                                <!-- Gambar Utama -->
                                                <div class="col-4 img-content-text" style="height: 425px;">
                                                    <h3>Gambar Utama</h3>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#uploadModal-main">
                                                        <div class="action-icon swap">
                                                            <img src="assets/icon-svg/swap.svg" alt="swap Icon"
                                                                style="height: 30px;">
                                                        </div>
                                                        <?php if (!empty($main_image)): ?>

                                                            <img src="controller/<?php echo $main_image; ?>"
                                                                alt="Gambar Utama" class="img-fluid"
                                                                style="border-radius:25px; height: 100%; width: 100%; object-fit: cover;"
                                                                onclick="showImage('controller/<?php echo $main_image; ?>', 'Gambar Utama')">
                                                        <?php endif; ?>
                                                    </a>
                                                </div>

                                                <!-- Gambar Banner dan Tambahan -->
                                                <div class="col-8">
                                                    <div class="row" style="height: 200px; width:auto">
                                                        <div class="col-12 img-content-text">
                                                            <h3>Gambar Banner</h3>
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#uploadModal-banner">
                                                                <div class="action-icon swap">
                                                                    <img src="assets/icon-svg/swap.svg" alt="swap Icon"
                                                                        style="height: 30px;">
                                                                </div>
                                                                <?php if (!empty($banner_image)): ?>
                                                                    <img src="controller/<?php echo $banner_image; ?>"
                                                                        alt="Gambar Banner" class="img-fluid"
                                                                        style="border-radius:25px; height: 200px; width: 100%; object-fit: cover;"
                                                                        onclick="showImage('controller/<?php echo $banner_image; ?>', 'Gambar Banner')">
                                                                <?php endif; ?>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <!-- Gambar Tambahan -->

                                                    <div class="row">
														<?php if (!empty($add_images) && is_array($add_images)): ?>
															<?php 
															// Limit the number of images to 3 to display them in the first row
															$totalImages = count($add_images);
															$imagesToShow = min($totalImages, 3); 
															?>
															
															<?php for ($i = 0; $i < $imagesToShow; $i++): ?>
																<div class="col-6 col-md-4 col-lg-3 pt-2 img-content-text" style="height: 225px;">
																	<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-add">
																		<div class="action-icon swap">
																			<img src="assets/icon-svg/swap.svg" alt="swap Icon" style="height: 30px;">
																		</div>
																		<img src="controller/<?php echo $add_images[$i]; ?>"
																			alt="Gambar Tambahan" class="img-fluid"
																			style="border-radius:25px; height: 100%; width: 100%; object-fit: cover;"
																			onclick="showImage('controller/<?php echo $add_images[$i]; ?>', 'Gambar Tambahan')">
																	</a>
																</div>
															<?php endfor; ?>

															<!-- If there are more than 3 images, show the 4th image with a count on it -->
															<?php if ($totalImages > 3): ?>
																<div class="col-6 col-md-4 col-lg-3 pt-2 img-content-text" style="height: 225px;">
																	<a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-add">
																		<div class="action-icon swap">
																			<img src="assets/icon-svg/swap.svg" alt="swap Icon" style="height: 30px;">
																		</div>
																		<?php if ($totalImages - 3 > 1): ?>
																		<div class="img-overlay d-flex justify-content-center align-items-center">
																			
																				<span class="text-white">+<?php echo $totalImages - 4; ?> gambar</span>
																			
																		</div>
																		<?php endif; ?>
																		<img src="controller/<?php echo $add_images[3]; ?>"
																			alt="Gambar Tambahan" class="img-fluid"
																			style="border-radius:25px; height: 100%; width: 100%; object-fit: cover;">
																	</a>
																</div>
															<?php endif; ?>
														<?php else: ?>
															<p class="text-center">Tiada gambar tambahan tersedia.</p>
														<?php endif; ?>
													</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for uploading the image -->
                                        <div class="modal fade" id="uploadModal-main" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="imageModalLabel">
                                                            <p class="mt-2">Gambar Utama</p>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img id="modalImage-main"
                                                            src="controller/<?php echo $main_image; ?>"
                                                            alt="Gambar Utama" class="img-modal"
                                                            style="max-width: auto; height: auto; object-fit: full;">
                                                        <p id="imageDescription-main" class="mt-2"></p>

                                                        <!-- Input untuk memuat naik gambar baru -->
                                                        <div class="mt-3">
                                                            <label for="imageUpload-main" class="form-label">Kemaskini
                                                                Gambar Utama</label>
                                                            <input type="file" id="imageUpload-main" name="imageUpload"
                                                                class="form-control" accept="image/*">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="updateImage('main')">Kemas Kini Gambar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Banner Image -->
                                        <div class="modal fade" id="uploadModal-banner" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="imageModalLabel">
                                                            <p class="mt-2">Gambar Banner</p>
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img id="modalImage-banner"
                                                            src="controller/<?php echo $banner_image; ?>"
                                                            alt="Gambar Banner" class="img-modal"
                                                            style="max-width: auto; height: auto; object-fit: full;">
                                                        <p id="imageDescription-banner" class="mt-2"></p>

                                                        <!-- Input untuk memuat naik gambar baru -->
                                                        <div class="mt-3">
                                                            <label for="imageUpload-banner" class="form-label">Kemaskini
                                                                Gambar Banner</label>
                                                            <input type="file" id="imageUpload-banner"
                                                                name="imageUpload" class="form-control"
                                                                accept="image/*">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="updateImage('banner')">Kemas Kini Gambar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="uploadModal-add" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Gambar Tambahan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div
                                                            class="d-flex justify-content-center align-items-center flex-wrap">
                                                            <?php if (!empty($add_images) && is_array($add_images)): ?>
                                                                <div class="row justify-content-center">
                                                                    <?php foreach ($add_images as $add): ?>
                                                                        <div class="col-6 col-md-4 col-lg-3 mb-3 image-container"
                                                                            id="image-<?php echo md5($add); ?>">
                                                                            <div class="image-wrapper">
                                                                                <img src="controller/<?php echo $add; ?>"
                                                                                    alt="Gambar Tambahan"
                                                                                    class="img-modal rounded img-fluid"
                                                                                    onclick="showImage('controller/<?php echo $add; ?>', 'Gambar Tambahan')">
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm delete-btn"
                                                                                    onclick="deleteImage('<?php echo $add; ?>', '<?php echo md5($add); ?>')">Padam
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php else: ?>
                                                                <p class="text-center">Tiada gambar tambahan tersedia.</p>
                                                            <?php endif; ?>
                                                        </div>

                                                        <!-- Input untuk memuat naik gambar baru -->
                                                        <div class="mt-4">
                                                            <label for="imageUpload-add" class="form-label">Kemaskini
                                                                Gambar Tambahan</label>
                                                            <input type="file" id="imageUpload-add" name="imageUpload[]"
                                                                class="form-control" accept="image/*" multiple>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="button" class="btn btn-primary"
                                                            onclick="uploadImages()">Muat Naik Gambar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-main">
                                                <button type="button" class="btn btn-primary rounded-button">Kemaskini
                                                    Gambar Utama</button>
                                            </a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-banner">
                                                <button type="button" class="btn btn-primary rounded-button">Kemaskini
                                                    Gambar Banner</button>
                                            </a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal-add">
                                                <button type="button" class="btn btn-primary rounded-button">Kemaskini
                                                    Gambar Tambahan</button>
                                            </a>
                                        </div>

                                    </div>
									<?php
									if (isset($_SESSION['statusDelete'])) {
										echo '<div class="alert alert-success" role="alert">' . $_SESSION['statusDelete'] . '.</div>';
										unset($_SESSION['statusDelete']);
									} elseif (isset($_SESSION['statusUpdate'])) {
										echo '<div class="alert alert-success" role="alert">' . $_SESSION['statusUpdate'] . '.</div>';
										unset($_SESSION['statusUpdate']);
									} elseif (isset($_SESSION['statusTambah'])) {
										echo '<div class="alert alert-success" role="alert">' . $_SESSION['statusTambah'] . '.</div>';
										unset($_SESSION['statusTambah']);
									}
									?>
                                    <br>
                                    <hr>
                                    <h3 class="text-center"><label class="col-3 col-form-label">Maklumat Aktiviti</label>
                                    </h3>
                                    <form class="form-horizontal" method="post"
                                        action="controller/kemaskiniAktiviti_process.php" enctype="multipart/form-data">


                                        <div class="row mb-3 mt-5">
                                            <label for="id_aktiviti" class="col-3 col-form-label">ID Aktiviti</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="id_aktiviti" name="id_aktiviti"
                                                    value="<?php echo $id_aktiviti; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="nama_aktiviti" class="col-3 col-form-label">Nama Aktiviti</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="nama_aktiviti"
                                                    name="nama_aktiviti" value="<?php echo $nama_aktiviti;?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="kadar_harga" class="col-3 col-form-label">Kadar Harga (RM)</label>
                                            <div class="col-9">
                                                <input type="number" step="0.01" class="form-control" id="kadar_harga"
                                                    name="kadar_harga" value="<?php echo $kadar_harga;?>" min="1"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="penerangan" class="col-3 col-form-label">Penerangan</label>
                                            <div class="col-9">
                                                <textarea class="form-control" id="penerangan" name="penerangan"
                                                    rows="4" required><?php echo $penerangan; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="penerangan_kemudahan" class="col-3 col-form-label">Penerangan Kemudahan</label>
                                            <div class="col-9">
                                                <textarea class="form-control" id="penerangan_kemudahan" name="penerangan_kemudahan"
                                                    rows="3" required><?php echo $penerangan_kemudahan; ?></textarea>
                                            </div>
                                        </div>
										<div class="row mb-3">
											<label class="col-3 col-form-label">Kemudahan</label>
											<div class="col-9">
												<div class="row g-2">
													<?php
													$id_aktiviti = $_GET['id_aktiviti'];

													$selected_kemudahan_query = "
														SELECT id_kemudahan 
														FROM aktiviti_kemudahan 
														WHERE id_aktiviti = '$id_aktiviti'
													";
													$selected_kemudahan_result = $conn->query($selected_kemudahan_query);

													$selected_kemudahan = [];
													if ($selected_kemudahan_result->num_rows > 0) {
														while ($row = $selected_kemudahan_result->fetch_assoc()) {
															$selected_kemudahan[] = $row['id_kemudahan'];
														}
													}

                                                    $query = "SELECT id_kemudahan, nama, icon_url FROM kemudahan";
                                                    $result = $conn->query($query);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $id_kemudahan = $row['id_kemudahan'];
                                                            $nama = $row['nama'];
                                                            $icon_url = $row['icon_url'];

                                                            $checked = in_array($id_kemudahan, $selected_kemudahan) ? 'checked' : '';

                                                            echo '<div class="col-md-4">';
                                                            echo '<div class="form-check">';
                                                            echo '<input class="form-check-input" type="checkbox" name="kemudahan[]" value="' . $id_kemudahan . '" id="kemudahan_' . $id_kemudahan . '" ' . $checked . '>';
                                                            echo '<label class="form-check-label d-flex align-items-center" for="kemudahan_' . $id_kemudahan . '">';

                                                            if ($icon_url) {
                                                                echo '<img src="../' . $icon_url . '" alt="' . $nama . '" style="height: 25px; margin-right: 10px;">';
                                                            }

                                                            echo $nama;
                                                            echo '</label>';
                                                            echo '</div>';
                                                            echo '</div>';
                                                        }
                                                    } else {
                                                        echo '<div class="col-12">No kemudahan available.</div>';
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
										<div class="row mb-5">
                                            <label for="status_aktiviti" class="col-3 col-form-label">Status</label>
                                            <div class="col-9">
                                                <select class="form-control" id="status_aktiviti" name="status_aktiviti" value="<?php echo $status_aktiviti;?>" required>
													<option value="tersedia" <?php echo ($status_aktiviti == 'tersedia') ? 'selected' : ''; ?>>Tersedia</option>
													<option value="tidak tersedia" <?php echo ($status_aktiviti == 'tidak tersedia') ? 'selected' : ''; ?>>Tidak Tersedia</option>
												</select>
                                            </div>
                                        </div>

                                        <div class="justify-content-end row text-end mt-3">
                                            <div class="col-9">
                                                <button type="submit" class="btn btn-info">Kemaskini</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'partials/footer.php'; ?>
        </div>
        <?php include 'partials/right-sidemenu.php'; ?>
    </div>

    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/vendor/jquery.dataTables.min.js"></script>
    <script src="assets/js/vendor/dataTables.bootstrap5.js"></script>
    <script src="assets/js/vendor/dataTables.responsive.min.js"></script>
    <script src="assets/js/vendor/responsive.bootstrap5.min.js"></script>
    <script src="assets/js/vendor/dataTables.checkboxes.min.js"></script>
    <script src="assets/js/pages/demo.products.js"></script>

    <script>
        function showImage(imageUrl, description) {
            const modalImage = document.getElementById('modalImage-' + description.toLowerCase());
            const imageDescription = document.getElementById('imageDescription-' + description.toLowerCase());

            modalImage.src = imageUrl;
            imageDescription.textContent = description;

            document.getElementById('imageUpload-' + description.toLowerCase()).setAttribute('name', description.toLowerCase());
        }
    </script>

    <script>
    function updateImage(imageType) {
        // Get the file input element dynamically based on imageType
        const fileInput = document.getElementById(`imageUpload-${imageType}`);
        const imageFile = fileInput.files[0];

        // Validate if the file is selected
        if (!imageFile) {
            alert('Sila pilih gambar terlebih dahulu.');
            return;
        }

        // Create a FormData object to send the image file and image type
        const formData = new FormData();
        formData.append('imageUpload', imageFile); // Append the image file
        formData.append('image_type', imageType);  // Append image type

        // Get id_aktiviti dynamically from the URL or hidden input
        const idAktiviti = <?php echo json_encode($_GET['id_aktiviti']); ?>;

        // Send the AJAX request using fetch API
        fetch(`controller/imageUpdated.php?id_aktiviti=${idAktiviti}`, {
            method: 'POST',
            body: formData,
        })
            .then(response => response.text()) // Handle response as text
            .then(data => {
                if (data.trim() === "success") {
                    // Close the modal dynamically based on imageType
                    const modalId = `uploadModal-${imageType}`;
                    const modal = document.getElementById(modalId);
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide();

                    // Reload the page after a slight delay
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                } else {
                    // Display the error message returned from the server
                    alert('Ralat: ' + data);
                }
            })
            .catch(error => {
                // Handle any network or server errors
                console.error('Error:', error);
                alert('Ralat semasa mengemas kini gambar. Sila cuba lagi.');
            });
    }
</script>

	<script>
	function deleteImage(imagePath, elementId) {
		if (confirm("Adakah anda pasti ingin menghapus gambar ini?")) {
			console.log("Image Path Sent:", imagePath); // Debugging: Log the image path

			// Optionally show a loading indicator here

			fetch('controller/delete_image.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({ image: imagePath })
			})
			.then(response => {
				if (!response.ok) {
					throw new Error(`HTTP error! status: ${response.status}`);
				}
				return response.json();
			})
			.then(data => {
				if (data.success) {
					document.getElementById(`image-${elementId}`).remove();
                    location.reload(); 
				} else {
					console.error("Backend Error Message:", data.message);
					alert("Gagal menghapus gambar: " + data.message);
				}
			})
			.catch(error => {
				console.error('Network or Fetch Error:', error);
				alert("Terjadi masalah saat menghapus gambar.");
			});
		}
	}
	</script>

    <script>
        function uploadImages() {
            const fileInput = document.getElementById("imageUpload-add");
            const files = fileInput.files;

            if (files.length === 0) {
                alert("Sila pilih gambar untuk dimuat naik.");
                return;
            }

            const formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append("images[]", files[i]);
            }

            fetch('controller/upload_images.php?id_aktiviti=<?php echo isset($id_aktiviti) ? $id_aktiviti : '0'; ?>', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); 
                    } else {
                        alert("Gagal memuat naik gambar: " + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Terjadi masalah saat memuat naik gambar.");
                });
        }
    </script>
	<script>
	function toggleUnavailableDateRange(status) {
		const dateRangeSection = document.getElementById('unavailable-date-range');
		if (status === 'tidak tersedia') {
			dateRangeSection.style.display = 'block';
		} else {
			dateRangeSection.style.display = 'none';
		}
	}

	// On page load, ensure correct visibility
	document.addEventListener('DOMContentLoaded', function () {
		const statusDropdown = document.getElementById('status_aktiviti');
		toggleUnavailableDateRange(statusDropdown.value);
	});
	</script>
	




</body>

</html>