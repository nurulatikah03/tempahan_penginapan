<?php
session_start();
include_once '../Models/tempahanDewan.php';
include_once __DIR__ . '/../database/DBConnec.php';
$conn = DBConnection::getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	if (isset($_SESSION['id_dewan']) && !empty($_SESSION['id_dewan'])) {
		$id_dewan = htmlspecialchars($_SESSION['id_dewan']);
	} elseif (isset($_GET['id_dewan']) && !empty($_GET['id_dewan'])) {
		$id_dewan = htmlspecialchars($_GET['id_dewan']);
		$_SESSION['id_dewan'] = $id_dewan; 
	} else {
		echo "ID Dewan tidak ditemukan.";
		exit();
	}

    // Retrieve and validate input dates
    $checkInDate = isset($_POST['checkInDate']) ? htmlspecialchars($_POST['checkInDate']) : '';
    $checkOutDate = isset($_POST['checkOutDate']) ? htmlspecialchars($_POST['checkOutDate']) : '';

    if (empty($checkInDate) || empty($checkOutDate)) {
        echo "Tanggal check-in atau check-out kosong.";
        exit();
    }

    $check_in_date = DateTime::createFromFormat('Y-m-d', $checkInDate);
	$check_out_date = DateTime::createFromFormat('Y-m-d', $checkOutDate);

    // Check for invalid dates
    if (!$check_in_date || !$check_out_date) {
        echo "Format tarikh tidak sah. Sila masukkan tarikh dalam format dd/mm/yyyy.";
        exit();
    }

    // Format dates for database comparison
    $formatted_check_in = $check_in_date->format('Y-m-d');
    $formatted_check_out = $check_out_date->format('Y-m-d');

    $query = "SELECT status_dewan, mula_tidak_tersedia, tamat_tidak_tersedia 
              FROM dewan 
              WHERE id_dewan = $id_dewan";
    $result = mysqli_query($conn, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        echo "Dewan dengan ID $id_dewan tidak ditemukan.";
        exit();
    }

    // Retrieve hall data
    $row = mysqli_fetch_assoc($result);
    $status_dewan = $row['status_dewan'];
    $mula_tidak_tersedia = !empty($row['mula_tidak_tersedia']) ? date('Y-m-d', strtotime($row['mula_tidak_tersedia'])) : null;
    $tamat_tidak_tersedia = !empty($row['tamat_tidak_tersedia']) ? date('Y-m-d', strtotime($row['tamat_tidak_tersedia'])) : null;

    // Check availability status
    if ($status_dewan === 'Tidak Tersedia') {
        if ($mula_tidak_tersedia && $tamat_tidak_tersedia) {
            if (($formatted_check_in >= $mula_tidak_tersedia && $formatted_check_in <= $tamat_tidak_tersedia) ||
                ($formatted_check_out >= $mula_tidak_tersedia && $formatted_check_out <= $tamat_tidak_tersedia) ||
                ($formatted_check_in <= $mula_tidak_tersedia && $formatted_check_out >= $tamat_tidak_tersedia)) {
                $_SESSION['err01'] = "Maaf, dewan ini tidak tersedia pada tarikh yang dipilih.";
                echo "<script>window.history.back();</script>";
                exit();
            }
        } else {
            $_SESSION['err01'] = "Maaf, dewan ini tidak tersedia buat masa sekarang.";
            echo "<script>window.history.back();</script>";
            exit();
        }
    }

    // Calculate booking details
    $kadar_sewa = getKadarSewa($id_dewan);
    if ($kadar_sewa === null) {
        echo "Kadar sewa untuk ID Dewan $id_dewan tidak ditemukan.";
        exit();
    }

    $_SESSION['checkInDate'] = isset($_POST['checkInDate']) ? htmlspecialchars($_POST['checkInDate']) : '';
    $_SESSION['checkOutDate'] = isset($_POST['checkOutDate']) ? htmlspecialchars($_POST['checkOutDate']) : '';

    if (!empty($_SESSION['checkInDate']) && !empty($_SESSION['checkOutDate'])) {
        $check_in_date = DateTime::createFromFormat('Y-m-d', $_SESSION['checkInDate']);
        $check_out_date = DateTime::createFromFormat('Y-m-d', $_SESSION['checkOutDate']);

        if ($check_in_date && $check_out_date) {
            $availableRooms = countRoomAvailable($id_dewan, $_SESSION['checkInDate'], $_SESSION['checkOutDate']);
            if ($availableRooms <= 0) {
                $_SESSION['err02'] = "Maaf, tiada dewan ini pada hari yang diminta. <strong>Sila pilih hari lain.</strong>";
                echo "<script>window.history.back();</script>";
                exit();
            }

            $interval = $check_in_date->diff($check_out_date);
            $num_of_night = ($interval->days) + 1;

            $price_per_night = $kadar_sewa;
            $total_price = $num_of_night * $price_per_night;

            $_SESSION['num_of_night'] = $num_of_night;
            $_SESSION['total_price'] = $total_price;

            header("Location: ../tempah_dewan.php");
			exit();

            exit();
        } else {
            echo "Format tanggal tidak valid.";
            exit();
        }
    } else {
        echo "Tanggal check-in atau check-out kosong.";
        exit();
    }
} else {
    echo "Tiada data yang dihantar.";
    exit();
}
?>

