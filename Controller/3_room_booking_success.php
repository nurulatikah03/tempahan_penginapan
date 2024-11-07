<?php 
    session_start();
    include '..\Models\tempahan.php';
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $tarikh_tempahan = date("Y-m-d H:i:s");
    $_SESSION['booking_number'] = generateBookingNumber($conn);
    $tarikhMasukSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkInDate"])->format('Y-m-d');
    $tarikhKeluarSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkOutDate"])->format('Y-m-d');
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $tempahan = new RoomReservation(null, $_SESSION['booking_number'], $_SESSION['cust_name'], $_SESSION['phone_number'], $_SESSION['form-email'], $tarikh_tempahan, $tarikhMasukSQL, $tarikhKeluarSQL, $_SESSION['total_price'], $_SESSION['room_id']);
        
        $tempahan->insertReservation();

        include '../testEMAIL.php'; //send email to customer
        header("Location: success.php");
        exit();
}
?>