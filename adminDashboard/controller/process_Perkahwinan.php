<?php
session_start();
include_once '../../Models/pekejPerkahwinan.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['process'] == 'tambah_pekej') {


        $nama_pekej = htmlspecialchars($_POST['nama_Pekej']);
        $id_dewan = $_POST['id_dewan'];
        $kadar_harga = $_POST['kadar_harga'];
        $penerangan_pendek = htmlspecialchars($_POST['penerangan_pendek']);
        $penerangan_panjang = htmlspecialchars($_POST['penerangan_panjang']);

        if ($kadar_harga < 1) {
            $_SESSION['error'] = "Kadar harga tidak boleh kurang daripada 1.";
            echo "<script>window.history.back();</script>";
        } else {

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

            $newWedId = PekejPerkahwinan::addPekejPerkahwinan($id_dewan, $nama_pekej, $kadar_harga, $penerangan_pendek, $penerangan_panjang);

            // Define the upload directory
            $uploadDirUtama = '../../assets/images/resource/';
            $uploadDirBanner = '../../assets/images/background/';
            $uploadDirTambahan = '../../assets/images/resource/';

            // Upload Gambar Utama
            if (isset($uploadedFiles['Gambar Utama'])) {
                $targetFile = $uploadDirUtama . basename($_FILES['fileinput_utama']['name']);
                if (move_uploaded_file($_FILES['fileinput_utama']['tmp_name'], $targetFile)) {
                    $urlToAddrUtama = 'assets/images/resource/' . basename($_FILES['fileinput_utama']['name']);
                    PekejPerkahwinan::addPerkahwinanImage($newWedId, $urlToAddrUtama, 'main');
                } else {
                    $_SESSION['error'] = "Terdapat ralat semasa memuat naik gambar utama.";
                    echo "Ralat semasa memuat naik Gambar Utama.<br>";
                }
            }

            // Upload Gambar Banner
            if (isset($uploadedFiles['Gambar Banner'])) {
                $targetFile = $uploadDirBanner . basename($_FILES['fileinput_banner']['name']);
                if (move_uploaded_file($_FILES['fileinput_banner']['tmp_name'], $targetFile)) {
                    $urlToAddBanner = 'assets/images/background/' . basename($_FILES['fileinput_banner']['name']);
                    PekejPerkahwinan::addPerkahwinanImage($newWedId, $urlToAddBanner, 'banner');
                } else {
                    $_SESSION['error'] = "Terdapat ralat semasa memuat naik gambar banner.";
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
                            PekejPerkahwinan::addPerkahwinanImage($newWedId, $urlToAddrTambahan, 'add');
                            $_SESSION['status'] = 'Penginapan berjaya ditambah.';
                            header("Location: ../penginapan.php");
                        } else {
                            $_SESSION['error'] = "Terdapat ralat semasa memuat naik gambar tambahan.";
                            echo "Ralat semasa memuat naik Gambar Tambahan " . ($i + 1) . ".<br>";
                        }
                    }
                }
            }
        }
    } elseif ($_POST['process'] == 'delete_pekej') {
        $id_pekej = $_POST['id_pekej'];
        $gambar = $_POST['gambar_url'];
        $target_file = '../../' . $gambar;

        if (file_exists($target_file)) {
            unlink($target_file);
        }

        PekejPerkahwinan::deletePekejPerkahwinan($id_pekej);
        $_SESSION['success'] = "Pekej Perkahwinan telah berjaya dipadamkan.";
        header("Location: ../perkahwinan.php");
    }
} else {
    echo "Kaedah permintaan tidak sah.";
}
