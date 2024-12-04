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
    } elseif ($_POST['submit'] == 'dewan') {
		include_once '../Models/tempahanDewan.php';
		include_once __DIR__ . '/../database/DBConnec.php';

		$conn = DBConnection::getConnection();

		// Check if 'id_dewan' exists in the URL
		if (isset($_GET['id_dewan']) && !empty($_GET['id_dewan'])) {
			$id_dewan = htmlspecialchars($_GET['id_dewan']); // Ambil id_dewan dari URL
		} else {
			echo "Error: 'id_dewan' not found in the URL.";
			exit();
		}

		// Generate booking number
		$booking_number = generateBookingNumber($conn);
		$_SESSION['booking_number'] = $booking_number; // Simpan booking_number ke dalam session
		echo "Generated Booking Number: $booking_number";

		// Format the dates from session data
		$tarikhMasukSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkInDate"])->format('Y-m-d');
		$tarikhKeluarSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkOutDate"])->format('Y-m-d');

		// Create the reservation object and insert it into the database
		$tempahan = new DewanReservation(
			null,
			$booking_number,
			$_SESSION['cust_name'],
			$_SESSION['phone_number'],
			$_SESSION['form-email'],
			$tarikh_tempahan,
			$tarikhMasukSQL,
			$tarikhKeluarSQL,
			$_SESSION['total_price'],
			$id_dewan // Gunakan id_dewan langsung dari URL
		);
		$tempahan->insertReservation();

		// Redirect to success_dewan.php with the id_dewan parameter
		$redirectUrl = "../success_dewan.php?id_dewan=" . $id_dewan;

		header("Location: $redirectUrl");
		exit();
	}
}
