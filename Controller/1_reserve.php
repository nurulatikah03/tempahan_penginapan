<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header("Location: ../pakejPenginapan.php");
    exit();
}

$_SESSION['checkInDate'] = $_POST['check_in'];
$_SESSION['checkOutDate'] = $_POST['check_out'];
$_SESSION['roomsNum'] = $_POST['rooms'];
$_SESSION['adultsNum'] = $_POST['adults'];
$_SESSION['childrenNum'] = $_POST['children'];
header("Location: ../booking_confirmation.php");