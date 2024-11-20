<?php
include_once '../../Models/room.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Submit'])) {
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
        $_SESSION['status'] = 'success';
        header("Location: ../penginapan.php");

    } else if ($_POST['process'] == 'UpdateImageMainAndBanner') {
        $URLgambarLama = $_POST['URLgambarLama'];
        $imgType = $_POST['imgType'];
        $roomID = $_POST['roomId'];
        $pathInfo = pathinfo($URLgambarLama);
        $filepath = $pathInfo['dirname'];
        $filename = $_FILES['file']['name'];
        $newFilename = $filepath . '/' . $filename;

        if (!empty($_FILES['file']['name'])) {
            $targetDir = "../../" . $filepath . "/";
            $targetFilePath = $targetDir . $filename;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Allow certain file formats
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array(strtolower($fileType), $allowedTypes)) {
                // Move uploaded file to server
                if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                    // Assign the file name to the variable to be saved in the database
                    Room::updateImageByType($roomID, $newFilename, $imgType);
                    echo "File uploaded successfully at " . $targetFilePath;
                } else {
                    // Error handling if the image upload fails
                    echo "Error uploading file.";
                    exit;
                }
            } else {
                echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
                exit;
            }
        } else {
            echo "No file selected.";
            exit;
        }
    }

    elseif ($_POST['process'] == 'DeleteImage') {
        $roomId = $_POST['roomId'];
        $URLGambar = $_POST['URLgambar'];
        $imgType = $_POST['imgType'];
        Room::delImgAddByURL($roomId, $imgType, $URLGambar);
        header("Location: ../kemaskini_penginapan.php?penginapan_id=" . $roomId);
        exit;
    }
}

else {
    echo "No form submitted.";
    exit;
}