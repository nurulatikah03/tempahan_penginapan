<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $tarikh_tempahan = date("Y-m-d H:i:s");
    if ($_POST['submit'] == 'room') {
        include '..\Models\tempahanBilik.php';
        $_SESSION['booking_number'] = generateBookingNumber($conn);
        $tarikhMasukSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkInDate"])->format('Y-m-d');
        $tarikhKeluarSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkOutDate"])->format('Y-m-d');


        $tempahan = new RoomReservation(null, $_SESSION['booking_number'], $_SESSION['cust_name'], $_SESSION['phone_number'], $_SESSION['form-email'], $tarikh_tempahan, $tarikhMasukSQL, $tarikhKeluarSQL, $_SESSION['total_price'], $_SESSION['room_id']);

        $tempahan->insertReservation();

        header("Location: ../success.php");
        //send email to customer
        //include '../testEMAIL.php';
        exit();
    } elseif ($_POST['submit'] == 'kahwin') {
        include '..\Models/tempahanPerkahwinan.php';
        $tarikhKenduriSQL = DateTime::createFromFormat('d/m/Y', $_SESSION['tarikh_kenduri'])->format('Y-m-d');
        $tarikhKendurNextDay = date('Y-m-d', strtotime($tarikhKenduriSQL . ' +1 day'));

        $_SESSION['booking_number'] = generateBookingNumberWed($tarikhKenduriSQL);
        $tempahan = new WeddingReservation(null, $_SESSION['booking_number'], $_SESSION['cust_name'], $_SESSION['phone_number'], $_SESSION['form-email'], $tarikh_tempahan, $tarikhKenduriSQL, $tarikhKendurNextDay, $_SESSION['total_price_kahwin'], $_SESSION["id_perkahwinan"]);
        if (isset($_SESSION['addons']) && !empty($_SESSION['addons'])) {
            
            $addons = $_SESSION['addons'];
            $ids = [];
            $names = [];
            $quantities = [];
        
            foreach ($addons as $addon) {
                $ids[] = $addon['id'];
                $names[] = $addon['name'];
                $quantities[] = $addon['quantity'];
            }

            $tempahan->insertReservationWithAddOns($ids, $quantities);
        } else {
            $tempahan->insertReservation();
        }
        
        echo "hello";
    }
}
