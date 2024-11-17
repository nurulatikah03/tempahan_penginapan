<?php
session_start();
include_once '../../Models/tempahan.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Submit'])) {
    $nombor_tempahan = $_POST['nombor_tempahan'];
    $tempahan = RoomReservation::delReservationByBookingNum($nombor_tempahan);
    $_SESSION['status'] = 'success';
    header("Location: ../tempahan.php");
}
?>
