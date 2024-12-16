<?php
include_once '../../Models/room.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Submit'])) {
    //update metadata
    if ($_POST['process'] == 'UpdateMetaData') {
        $roomId = $_POST['penginapan_id'];
        $name = $_POST['nama_penginapan'];
        $type = $_POST['jenis_bilik'];
        $jumlahBilik = $_POST['jumlah_bilik'];
        $price = $_POST['kadar_sewa'];
        $capacity = $_POST['bilanganPenyewa'];
        $longDesc = $_POST['penerangan_panjang'];
        $shortDesc = $_POST['penerangan_pendek'];
        $amenDesc = $_POST['penerangan_kemudahan'];
        $aminitiesList = $_POST['kemudahan'];
        $room = Room::setRoomById($roomId, $name, $capacity, $type, $price, $amenDesc, $shortDesc, $longDesc, $jumlahBilik, $aminitiesList);
        $_SESSION['status'] = 'Kemaskini maklumat berjaya.';
        header("Location: ../penginapan.php");
        exit;

        //update image main or banner
    } else if ($_POST['process'] == 'UpdateImageMainAndBanner') {
        $URLgambarLama = $_POST['URLgambarLama'];
        $imgType = $_POST['imgType'];
        $roomID = $_POST['roomId'];
        $pathInfo = pathinfo($URLgambarLama);
        $filepath = $pathInfo['dirname'];
        $oldFilename = "../../" . $URLgambarLama; // Full path to the old image
        $filename = $_FILES['file']['name'];
        $newFilename = $filepath . '/' . $filename;

        if (!empty($_FILES['file']['name'])) {
            $targetDir = "../../" . $filepath . "/";
            $targetFilePath = $targetDir . $filename;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Allow certain file formats
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array(strtolower($fileType), $allowedTypes)) {

                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {

                    if (file_exists($oldFilename)) {
                        unlink($oldFilename);
                    }
                    Room::updateImageByType($roomID, $newFilename, $imgType);
                    $_SESSION['status'] = 'Kemaskini gambar Berjaya';
                    header("Location: ../kemaskini_penginapan.php?penginapan_id=" . $roomID);
                }
            } else {
                // Error handling if the image upload fails
                echo "Error uploading file.";
                exit;
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
            exit;
        }
    } elseif ($_POST['process'] == 'DeleteImage') {
        $roomId = $_POST['roomId'];
        $URLGambar = $_POST['URLgambar'];
        $imgType = $_POST['imgType'];

        $filePath = "../../" . $URLGambar;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        Room::delImgAddByURL($roomId, $imgType, $URLGambar);

        $_SESSION['status'] = 'Padam gambar berjaya.';
        header("Location: ../kemaskini_penginapan.php?penginapan_id=" . $roomId);
        exit;
    } elseif ($_POST['process'] == 'deleteRoom') {
        $roomId = $_POST['room_id'];
        try {
            Room::delRoomById($roomId);
        } catch (Exception $e) {
            $_SESSION['error'] = 'Terdapat tempahan yang menggunakan bilik ni. Hanya boleh nyahaktif bilik ini.';
            header("Location: ../penginapan.php");
            exit;
        }
        Room::delImgByRoomId($roomId);
        Room::delAmenByRoomId($roomId);
        $_SESSION['status'] = 'Penginapan berjaya dipadam.';
        header("Location: ../penginapan.php");
        exit;
    } elseif ($_POST['process'] == 'addRoom') {

        $nama_bilik = htmlspecialchars($_POST['nama_bilik']);
        $jenis_bilik = htmlspecialchars($_POST['jenis_bilik']);
        $bilangan_penyewa = intval($_POST['bilanganPenyewa']);
        $jumlah_bilik = intval($_POST['jumlah_bilik']);
        $kadar_sewa = floatval($_POST['kadar_sewa']);
        $penerangan_panjang = htmlspecialchars($_POST['penerangan_panjang']);
        $penerangan_pendek = htmlspecialchars($_POST['penerangan_pendek']);
        $penerangan_kemudahan = htmlspecialchars($_POST['penerangan_kemudahan']);
        $kemudahan = isset($_POST['kemudahan']) ? $_POST['kemudahan'] : [];
        $roomId = Room::addNewRoom(
            $nama_bilik,
            $bilangan_penyewa,
            $jenis_bilik,
            $kadar_sewa,
            $penerangan_kemudahan,
            $penerangan_pendek,
            $penerangan_panjang,
            $jumlah_bilik,
            $kemudahan
        );
        // Handle file uploads
        $uploadedFiles = [];
        if (isset($_FILES['fileinput_utama']) && $_FILES['fileinput_utama']['error'] === UPLOAD_ERR_OK) {
            $uploadedFiles['Gambar Utama'] = $_FILES['fileinput_utama']['name'];
        }
        if (isset($_FILES['fileinput_banner']) && $_FILES['fileinput_banner']['error'] === UPLOAD_ERR_OK) {
            $uploadedFiles['Gambar Banner'] = $_FILES['fileinput_banner']['name'];
        }
        if (isset($_FILES['fileinput_tambahan']) && !empty($_FILES['fileinput_tambahan']['name'][0])) {
            foreach ($_FILES['fileinput_tambahan']['name'] as $key => $value) {
                if ($_FILES['fileinput_tambahan']['error'][$key] === UPLOAD_ERR_OK) {
                    $uploadedFiles['Gambar Tambahan'][] = $value;
                }
            }
        }
        // Define the upload directory
        $uploadDirUtama = '../../assets/images/resource/';
        $uploadDirBanner = '../../assets/images/background/';
        $uploadDirTambahan = '../../assets/images/resource/';

        // Upload Gambar Utama
        if (isset($uploadedFiles['Gambar Utama'])) {
            $targetFile = $uploadDirUtama . basename($_FILES['fileinput_utama']['name']);
            if (move_uploaded_file($_FILES['fileinput_utama']['tmp_name'], $targetFile)) {
                echo "Gambar Utama berjaya dimuat naik.<br>";
                $urlToAddrUtama = 'assets/images/resource/' . basename($_FILES['fileinput_utama']['name']);
                Room::addImage($roomId, $urlToAddrUtama, 'main');
            } else {
                echo "Ralat semasa memuat naik Gambar Utama.<br>";
            }
        }

        // Upload Gambar Banner
        if (isset($uploadedFiles['Gambar Banner'])) {
            $targetFile = $uploadDirBanner . basename($_FILES['fileinput_banner']['name']);
            if (move_uploaded_file($_FILES['fileinput_banner']['tmp_name'], $targetFile)) {
                $urlToAddBanner = 'assets/images/background/' . basename($_FILES['fileinput_banner']['name']);
                Room::addImage($roomId, $urlToAddBanner, 'banner');
                echo "Gambar Banner berjaya dimuat naik.<br>";
            } else {
                echo "Ralat semasa memuat naik Gambar Banner.<br>";
            }
        }

        // Upload Gambar tambahan
        if (isset($_FILES['fileinput_tambahan'])) {
            $fileCount = count($_FILES['fileinput_tambahan']['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                if ($_FILES['fileinput_tambahan']['error'][$i] === UPLOAD_ERR_OK) {
                    $targetFile = $uploadDirTambahan . basename($_FILES['fileinput_tambahan']['name'][$i]);

                    if (move_uploaded_file($_FILES['fileinput_tambahan']['tmp_name'][$i], $targetFile)) {
                        $urlToAddrTambahan = 'assets/images/resource/' . basename($_FILES['fileinput_tambahan']['name'][$i]);
                        Room::addImage($roomId, $urlToAddrTambahan, 'add');
                        echo "Gambar Tambahan " . ($i + 1) . " berjaya dimuat naik.<br>";
                    } else {
                        echo "Ralat semasa memuat naik Gambar Tambahan " . ($i + 1) . ".<br>";
                    }
                }
            }
        }
        $_SESSION['status'] = 'Penginapan berjaya ditambah.';
        header("Location: ../penginapan.php");
        exit;

    } elseif ($_POST['process'] == 'addUnitBilik') {
        $roomId = $_POST['roomId'];
        $nomborUnitBilik = $_POST['nomborUnitBilikAdd'];
        $aras_bilik = $_POST['arasAdd'];
        foreach ($nomborUnitBilik as $index => $unit) {
            $aras = $aras_bilik[$index];
            Room::addRoomUnit($roomId, $unit, $aras);
        }
        $_SESSION['status'] = 'Unit bilik berjaya ditambah.';
        header("Location: ../kemaskini_penginapan.php?penginapan_id=" . $roomId);

    } elseif ($_POST['process'] == 'UpdateImageAdd') {

        if (isset($_FILES['images'])) {

            $imgType = $_POST['imgType'];
            $roomId = $_POST['roomId'];

            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['images']['name'][$key];
                $file_size = $_FILES['images']['size'][$key];
                $file_type = $_FILES['images']['type'][$key];
                $file_tmp = $_FILES['images']['tmp_name'][$key];

                $upload_dir = '../../assets/images/resource/';


                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $file_path = $upload_dir . basename($file_name);
                $urlToAdd = 'assets/images/resource/' . basename($file_name);

                if (move_uploaded_file($file_tmp, $file_path)) {
                    echo "<p><strong>Uploaded to:</strong> " . htmlspecialchars($file_path) . "</p>";
                    Room::addImage($roomId, $urlToAdd, $imgType);
                    $_SESSION['status'] = 'Kemaskini gambar tambahan Berjaya';
                    header("Location: ../kemaskini_penginapan.php?penginapan_id=" . $roomId);
                    exit;
                } else {
                    echo "<p style='color: red;'><strong>Error:</strong> Failed to upload file.</p>";
                }
                echo "</div>";
            }
        }
    } else {
        echo "Invalid process.";
        exit;
    }
} else {
    echo "No form submitted.";
    exit;
}
