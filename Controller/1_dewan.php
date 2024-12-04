<?php
session_start();
include_once '../Models/tempahanDewan.php';
include_once __DIR__ . '/../database/DBConnec.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['id_dewan']) && !empty($_GET['id_dewan'])) {
		$id_dewan = htmlspecialchars($_GET['id_dewan']); // Retrieve id_dewan from URL
	} else {
		echo "ID Dewan tidak ditemukan di URL.";
		exit();  // Exit if 'id_dewan' is not found in the URL
	}

	// Get the status of the dewan
	$status_dewan = getStatusDewan($id_dewan);

	// Check the status of the dewan
	if ($status_dewan === null) {
		echo "Dewan dengan ID $id_dewan tidak ditemukan.";
		exit();  // Exit if no dewan found with the given ID
	} elseif ($status_dewan === 'Tidak Tersedia') {
		// Alert and redirect if the dewan is not available
		$_SESSION['err01'] = "Maaf, dewan ini tidak tersedia buat masa sekarang.</strong>";
        echo "<script>window.history.back();</script>";
        exit();
	}


    $kadar_sewa = getKadarSewa($id_dewan);
    if ($kadar_sewa === null) {
        echo "Kadar sewa untuk ID Dewan $id_dewan tidak ditemukan.";
        exit();
    }

    $_SESSION['checkInDate'] = isset($_POST['checkInDate']) ? htmlspecialchars($_POST['checkInDate']) : '';
    $_SESSION['checkOutDate'] = isset($_POST['checkOutDate']) ? htmlspecialchars($_POST['checkOutDate']) : '';

    if (!empty($_SESSION['checkInDate']) && !empty($_SESSION['checkOutDate'])) {
        $check_in_date = DateTime::createFromFormat('d/m/Y', $_SESSION['checkInDate']);
        $check_out_date = DateTime::createFromFormat('d/m/Y', $_SESSION['checkOutDate']);

        if ($check_in_date && $check_out_date) {
            $availableRooms = countRoomAvailable($id_dewan, $_SESSION['checkInDate'], $_SESSION['checkOutDate']);
            if ($availableRooms <= 0) {
                $_SESSION['err02'] = "Maaf, tiada dewan ini pada hari yang diminta. <strong>Sila pilih hari lain.</strong>";
                echo "<script>window.history.back();</script>";
                exit();
            }

            $interval = $check_in_date->diff($check_out_date);
            $num_of_night = $interval->days;

            $price_per_night = $kadar_sewa;
            $total_price = $num_of_night * $price_per_night;

            $_SESSION['num_of_night'] = $num_of_night;
            $_SESSION['total_price'] = $total_price;

            $redirectUrl = "../tempah_dewan.php?id_dewan=" . $id_dewan;
            header("Location: $redirectUrl");
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
