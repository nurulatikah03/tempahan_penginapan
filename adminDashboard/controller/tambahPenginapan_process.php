<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../../Models/room.php';

    // Sanitize and collect the input data
    $nama_bilik = htmlspecialchars($_POST['nama_bilik']);
    $jenis_bilik = htmlspecialchars($_POST['jenis_bilik']);
    $bilangan_penyewa = intval($_POST['bilanganPenyewa']);
    $jumlah_bilik = intval($_POST['jumlah_bilik']);
    $kadar_sewa = floatval($_POST['kadar_sewa']);
    $penerangan_panjang = htmlspecialchars($_POST['penerangan_panjang']);
    $penerangan_pendek = htmlspecialchars($_POST['penerangan_pendek']);
    $penerangan_kemudahan = htmlspecialchars($_POST['penerangan_kemudahan']);
    $kemudahan = isset($_POST['kemudahan']) ? $_POST['kemudahan'] : [];
    $nomborUnitBilik = $_POST['nomborUnitBilik'];
    $aras_bilik = $_POST['aras'];

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

    foreach ($nomborUnitBilik as $index => $unit) {
        $aras = $aras_bilik[$index];
        Room::addRoomUnit($roomId, $unit, $aras);
    }

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
            $urlToAddrUtama = 'assets/images/resource/' . basename($_FILES['fileinput_utama']['name']);
            Room::addImage($roomId, $urlToAddrUtama, 'main');
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
            Room::addImage($roomId, $urlToAddBanner, 'banner');
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
                    Room::addImage($roomId, $urlToAddrTambahan, 'add');
                    $_SESSION['status'] = 'Penginapan berjaya ditambah.';
                    header("Location: ../penginapan.php");
                } else {
                    $_SESSION['error'] = "Terdapat ralat semasa memuat naik gambar tambahan.";
                    echo "Ralat semasa memuat naik Gambar Tambahan " . ($i + 1) . ".<br>";
                }
            }
        }
    }
} else {
    echo "Kaedah permintaan tidak sah.";
}
