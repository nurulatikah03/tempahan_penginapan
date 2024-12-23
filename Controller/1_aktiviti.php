<?php
session_start();
include_once '../Models/tempahanAktiviti.php';
include_once __DIR__ . '/../database/DBConnec.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['id_aktiviti']) && !empty($_GET['id_aktiviti'])) {
        $id_aktiviti = htmlspecialchars($_GET['id_aktiviti']);
    } else {
        echo "ID Aktiviti tidak ditemukan di URL.";
        exit();
    }

    // Get the status of the aktiviti
    $status_aktiviti = getStatusAktiviti($id_aktiviti);
    if ($status_aktiviti === null) {
        echo "Aktiviti dengan ID $id_aktiviti tidak ditemukan.";
        exit();
    } elseif ($status_aktiviti === 'Tidak Tersedia') {
        $_SESSION['err01'] = "Maaf, aktiviti ini tidak tersedia buat masa sekarang.</strong>";
        echo "<script>window.history.back();</script>";
        exit();
    }

    // Retrieve the price per person (kadar_harga)
    $kadar_harga = getKadarHarga($id_aktiviti);
    if ($kadar_harga === null || !is_numeric($kadar_harga)) {
        echo "Kadar harga tidak valid untuk ID Aktiviti $id_aktiviti.";
        exit();
    }

	$_SESSION['id_dewan'] = isset($_POST['id_dewan']) ? htmlspecialchars($_POST['id_dewan']) : '';

    $_SESSION['checkInDate'] = isset($_POST['checkInDate']) ? htmlspecialchars($_POST['checkInDate']) : '';
    $_SESSION['checkOutDate'] = isset($_POST['checkOutDate']) ? htmlspecialchars($_POST['checkOutDate']) : '';
	$_SESSION['total_person'] = isset($_POST['num_of_person']) ? htmlspecialchars($_POST['num_of_person']) : '';

    if (!empty($_SESSION['checkInDate']) && !empty($_SESSION['checkOutDate'])) {
        $check_in_date = DateTime::createFromFormat('d/m/Y', $_SESSION['checkInDate']);
        $check_out_date = DateTime::createFromFormat('d/m/Y', $_SESSION['checkOutDate']);

        if ($check_in_date && $check_out_date) {
            $interval = $check_in_date->diff($check_out_date);
            $num_of_person = $interval->days;
			$total_person=$_POST['num_of_person'];

            if ($num_of_person > 0) {
                $price_per_person = $kadar_harga;
                $total_price = $num_of_person * $price_per_person * $total_person ;

                // Store results in session variables
                $_SESSION['num_of_person'] = $num_of_person;
                $_SESSION['total_price'] = $total_price;

                echo "Number of Days: $num_of_person<br>";
                echo "Price per Day: $price_per_person<br>";
                echo "Total Price: $total_price<br>";

                // Redirect to another page if needed
                $redirectUrl = "../tempah_aktiviti.php?id_aktiviti=" . $id_aktiviti;
                header("Location: $redirectUrl");
                exit();
            } else {
                echo "Jumlah hari tidak valid.";
            }
        } else {
            echo "Format tanggal tidak valid.";
        }
    } else {
        echo "Tanggal check-in atau check-out kosong.";
    }
} else {
    echo "Tiada data yang dihantar.";
}
?>
