<?php
session_start();
include_once '../../Models/pekejPerkahwinan.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //update metadata
    if ($_POST['process'] == 'delAddon') {
        $id_addon = $_POST['addon_id'];
        PekejPerkahwinan::deleteAddon($id_addon);
        $_SESSION['success'] = "Addon telah berjaya dipadamkan.";
        header("Location: ../perkahwinan.php");

        //update image main or banner
    } else if ($_POST['process'] == 'UpdateImageMainAndBanner') {
        $URLgambarLama = $_POST['URLgambarLama'];
        $imgType = $_POST['imgType'];
        $idPekej = $_POST['idPekej'];
        $pathInfo = pathinfo($URLgambarLama);
        $filepath = $pathInfo['dirname'];
        $oldFilename = "../../" . $URLgambarLama; 
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
                    PekejPerkahwinan::updateImageKahwinByType($idPekej, $newFilename, $imgType);
                    $_SESSION['status'] = 'Kemaskini gambar Berjaya';
                    header("Location: ../kemaskini_perkahwinan.php?id_perkahwinan=" . $idPekej);
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
    } elseif ($_POST['process'] == 'addAddon') {
        $nama_addon = $_POST['add_on_nama'];
        $harga_addon = $_POST['harga'];
        $id_pekej = $_POST['id_pekej'];
        PekejPerkahwinan::addAddon($nama_addon, $harga_addon);
        $_SESSION['success'] = "Addon telah berjaya ditambah.";
        header("Location: ../perkahwinan.php");
    } elseif ($_POST['process'] == 'kemaskiniAddOn') {
        $ids = isset($_POST['id_addon']) ? $_POST['id_addon'] : [];
        $names = isset($_POST['add_on_nama']) ? $_POST['add_on_nama'] : [];
        $prices = isset($_POST['harga']) ? $_POST['harga'] : [];

        if (count($ids) === count($names) && count($names) === count($prices)) {
            for ($i = 0; $i < count($ids); $i++) {
                $id_addon = $ids[$i];
                $nama_addon = $names[$i];
                $harga_addon = $prices[$i];

                if (!empty($id_addon) && !empty($nama_addon) && $harga_addon >= 0) {
                    try {
                        PekejPerkahwinan::updateAddOn($id_addon, $nama_addon, $harga_addon);
                    } catch (Exception $e) {
                        echo "Error updating add-on ID $id_addon: " . $e->getMessage();
                        exit;
                    }
                } else {
                    echo "Invalid data for add-on ID $id_addon.";
                    exit;
                }
            }

            $_SESSION['success'] = "Add on berjaya dikemaskini.";
            header("Location: ../perkahwinan.php");
            exit;
        } else {
            echo "Mismatched input arrays.";
            exit;
        }
    } elseif ($_POST['process'] == 'kemaskiniDetailPerkahwinan') {
        $id_pekej = $_POST['id_perkahwinan'];
        $nama_pekej = $_POST['nama_Pekej'];
        $id_dewan = $_POST['id_dewan'];
        $kadar_harga = $_POST['kadar_harga'];
        $penerangan_pendek = $_POST['penerangan_pendek'];
        $penerangan_panjang = $_POST['penerangan_panjang'];
        // Check if the file is empty
        if (empty($gambar_pekej)) {
            PekejPerkahwinan::updatePekejPerkahwinan($id_pekej, $nama_pekej, $kadar_harga, $penerangan_pendek, $penerangan_panjang, $id_dewan);
            $_SESSION['success'] = "Pekej Perkahwinan telah berjaya dikemaskini.";
            header("Location: ../perkahwinan.php");
            exit;
        }
    } elseif ($_POST['process'] == 'DeleteImage') {
        $idPekej = $_POST['idPekej'];
        $URLGambar = $_POST['URLgambar'];
        $imgType = $_POST['imgType'];

        $filePath = "../../" . $URLGambar;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        PekejPerkahwinan::delImgKahwinAddByURL($idPekej, $imgType, $URLGambar);

        $_SESSION['status'] = 'Padam gambar berjaya.';
        header("Location: ../kemaskini_perkahwinan.php?id_perkahwinan=" . $idPekej);
        exit;
    }elseif ($_POST['process'] == 'UpdateImageAdd') {

        if (isset($_FILES['images'])) {

            $imgType = $_POST['imgType'];
            $idPekej = $_POST['idPekej'];

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
                    PekejPerkahwinan::addPerkahwinanImage($idPekej, $urlToAdd, $imgType);
                    $_SESSION['status'] = 'Kemaskini gambar tambahan Berjaya';
                    header("Location: ../kemaskini_perkahwinan.php?id_perkahwinan=" . $idPekej);
                    exit;
                } else {
                    echo "<p style='color: red;'><strong>Error:</strong> Failed to upload file.</p>";
                }
                echo "</div>";
            }
        }
    }else {
        echo "Invalid process.";
        exit;
    }
} else {
    echo "No form submitted.";
    exit;
}
