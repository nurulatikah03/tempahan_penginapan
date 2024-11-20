<?php
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

    // Display all the collected data
    echo "<h2>Maklumat Penginapan</h2>";
    echo "<strong>Nama Bilik:</strong> $nama_bilik<br>";
    echo "<strong>Jenis Bilik:</strong> $jenis_bilik<br>";
    echo "<strong>Bilangan Penyewa:</strong> $bilangan_penyewa orang<br>";
    echo "<strong>Jumlah Bilik:</strong> $jumlah_bilik<br>";
    echo "<strong>Kadar Sewa:</strong> RM $kadar_sewa<br>";
    echo "<strong>Penerangan Panjang:</strong><br>$penerangan_panjang<br>";
    echo "<strong>Penerangan Pendek:</strong><br>$penerangan_pendek<br>";
    echo "<strong>Penerangan Kemudahan:</strong><br>$penerangan_kemudahan<br>";

    echo "<strong>Kemudahan:</strong><ul>";
    foreach ($kemudahan as $item) {
        echo "<li>" . htmlspecialchars($item) . "</li>";
    }
    echo "</ul>";

    if (!empty($uploadedFiles)) {
        echo "<strong>Fail Dimuat Naik:</strong><ul>";
        foreach ($uploadedFiles as $key => $file) {
            if (is_array($file)) {
                foreach ($file as $f) {
                    echo "<li>$key: $f</li>";
                }
            } else {
                echo "<li>$key: $file</li>";
            }
        }
        echo "</ul>";
    }
} else {
    echo "Invalid request method.";
}
