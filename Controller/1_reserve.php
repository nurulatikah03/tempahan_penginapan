<?php
session_start();
include_once '../Models/tempahanBilik.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pakejPenginapan.php");
    exit();
}

if ($_POST['process'] == 'penginapan') {

    $checkInDate = $_POST['check_in'];
    $checkOutDate = $_POST['check_out'];
    $rooms = ($_POST['rooms'] < 1) ? 1 : $_POST['rooms'];

    //Check availability
    $availableRooms = countRoomAvailable($_SESSION['room_id'], $checkInDate, $checkOutDate, $rooms);
    if (!$availableRooms['available']) {
        $_SESSION['err'] = $availableRooms['message'];
        echo $checkInDate . " " . $checkOutDate . " " . $rooms;
        //echo "<script>window.history.back();</script>";
        exit;
    }
    $_SESSION['checkInDate'] = $checkInDate;
    $_SESSION['checkOutDate'] = $checkOutDate;


    $_SESSION['roomsNum'] = $rooms;
    $_SESSION['adultsNum'] = $_POST['adults'];
    $_SESSION['childrenNum'] = $_POST['children'];
    header("Location: ../booking_confirmation.php");
    exit();
}
