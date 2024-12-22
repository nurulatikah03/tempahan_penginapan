<?php
require_once 'Models/tempahanBilik.php';

$data = json_decode(file_get_contents('php://input'), true);

$roomId = $data['room_id'] ?? null;
$checkIn = $data['check_in'] ?? null;
$checkOut = $data['check_out'] ?? null;

if ($roomId && $checkIn && $checkOut) {
    $roomAvailability = countRoomAvailable($roomId, $checkIn, $checkOut, 1);
    $roomCount = $roomAvailability['available_rooms'];

    if ($roomCount > 0) {
        echo '<select name="rooms">';
        for ($i = 1; $i <= $roomCount; $i++) {
            echo "<option value=\"$i\">$i BILIK</option>";
        }
        echo '</select>';
    } else {
        echo "<p>Tiada Bilik Tersedia hari diminta</p>";
    }
} else {
    echo "<p>Sila pilih tarikh masuk dan keluar</p>";
}
