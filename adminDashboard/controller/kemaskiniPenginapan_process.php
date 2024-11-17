<?php
include_once '../../Models/room.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Submit'])) {
    if ($_POST['process'] == 'UpdateMetaData') {
        $roomId = $_POST['penginapan_id'];
        $name = $_POST['nama_penginapan'];
        $type = $_POST['jenis_bilik'];
        $jumlahBilik = $_POST['jumlah_bilik'];
        $price = $_POST['kadar_sewa'];
        $capacity = $_POST['bilanganPenyewa'];
        $longDesc = $_POST['penerangan_panjang'];
        $shortDesc = $_POST['penerangan_pendek'];
        $amenDesc = $_POST['penerangan_kemudahan'];
        $aminitiesList = $_POST['kemudahan'];
        $room = Room::setRoomById($roomId, $name, $capacity, $type, $price, $amenDesc, $shortDesc, $longDesc, $jumlahBilik, $aminitiesList);
        $_SESSION['status'] = 'success';

        header("Location: ../tempahan.php");
    } else if ($_POST['process'] == 'delete') {
        $nombor_tempahan = $_POST['nombor_tempahan'];
        $tempahan = RoomReservation::delReservationByBookingNum($nombor_tempahan);
        $_SESSION['status'] = 'success';
        header("Location: ../tempahan.php");
    }
    $nombor_tempahan = $_POST['nombor_tempahan'];
    $tempahan = RoomReservation::delReservationByBookingNum($nombor_tempahan);
    $_SESSION['status'] = 'success';
    header("Location: ../tempahan.php");
}
