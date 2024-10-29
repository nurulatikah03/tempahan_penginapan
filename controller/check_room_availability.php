<?php 

function checkRoomAvailability($room_id, $checkInDate, $checkOutDate) {
    include 'database/database.php';

    // Convert dates from DD/MM/YYYY to YYYY-MM-DD for SQL compatibility
    $checkInDateObj = DateTime::createFromFormat('d/m/Y', $checkInDate);
    $checkOutDateObj = DateTime::createFromFormat('d/m/Y', $checkOutDate);

    if ($checkInDateObj === false || $checkOutDateObj === false) {
        return "Invalid date format. Please enter dates in DD/MM/YYYY format.";
    }

    $formattedCheckInDate = $checkInDateObj->format('Y-m-d');
    $formattedCheckOutDate = $checkOutDateObj->format('Y-m-d');

    $sql = "SELECT * FROM tempahan 
            WHERE id_bilik = ? 
            AND (
                (tarikh_daftar_masuk <= ? AND tarikh_daftar_keluar >= ?) 
                OR (tarikh_daftar_masuk <= ? AND tarikh_daftar_keluar >= ?) 
                OR (tarikh_daftar_masuk >= ? AND tarikh_daftar_keluar <= ?)
            )";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", 
        $room_id, 
        $formattedCheckOutDate, $formattedCheckInDate, 
        $formattedCheckInDate, $formattedCheckOutDate, 
        $formattedCheckInDate, $formattedCheckOutDate
    );

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $availability = false;
    } else {
        $availability = true;
    }

    $stmt->close();
    $conn->close();

    return $availability;
}
?>