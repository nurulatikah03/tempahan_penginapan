<?php
session_start();
include_once '../Models/tempahanBilik.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pakejPenginapan.php");
    exit();
}

if ($_POST['process'] == 'penginapan') {
    //Check availability
    $availableRooms = countRoomAvailable($_SESSION['room_id'], $_POST['check_in'], $_POST['check_out']);
    if ($availableRooms <= 0) {
        $_SESSION['err'] = "Maaf, tiada penginapan ini pada hari yang diminta.";
        echo "<script>window.history.back();</script>";
        exit;
    }
    $_SESSION['checkInDate'] = $_POST['check_in'];
    $_SESSION['checkOutDate'] = $_POST['check_out'];
    $_SESSION['roomsNum'] = $_POST['rooms'];
    $_SESSION['adultsNum'] = $_POST['adults'];
    $_SESSION['childrenNum'] = $_POST['children'];
    header("Location: ../booking_confirmation.php");
    exit();
}
