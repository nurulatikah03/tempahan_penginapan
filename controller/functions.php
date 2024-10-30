<?php 

function checkRoomAvailability($room_id, $checkInDate, $checkOutDate) {
    include_once 'database/database.php';
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

function calcNumOfNight($checkInDate, $checkOutDate) {
    if (strpos($checkInDate, '/') !== false) {
        $checkInDate = DateTime::createFromFormat('d/m/Y', $checkInDate);
        $checkOutDate = DateTime::createFromFormat('d/m/Y', $checkOutDate);
    } else {
        $checkInDate = DateTime::createFromFormat('Y-m-d', $checkInDate);
        $checkOutDate = DateTime::createFromFormat('Y-m-d', $checkOutDate);
    }

    $interval = $checkInDate->diff($checkOutDate);
    $num_of_night = $interval->days; 

    return $num_of_night;
}

function generateBookingNumber($conn) {
    $yearMonth = date("Ym");
    $unique = false;
    $bookingNumber = "";

    // Loop to ensure the booking number is unique
    while (!$unique) {
        // Generate a random 5-digit number to append
        $randomDigits = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $bookingNumber = "BOOK-" . $yearMonth . "-" . $randomDigits;

        // Check if the booking number already exists in the database
        $query = "SELECT COUNT(*) FROM tempahan WHERE nombor_tempahan = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $bookingNumber);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        
        if ($count == 0) {
            $unique = true; // Booking number is unique
        }
        
        $stmt->close();
    }

    return $bookingNumber;
}


?>