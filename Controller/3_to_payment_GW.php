<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $tarikh_tempahan = date("Y-m-d H:i:s");


    // elseis starts here
    if ($_POST['submit'] == 'room') {
        include_once '..\Models\tempahanBilik.php';
        $conn = DBConnection::getConnection();
        $_SESSION['booking_number'] = generateBookingNumber($conn);
        $_SESSION['payment_method'] = $_POST['payment_method'];
        $tarikhMasukSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkInDate"])->format('Y-m-d');
        $tarikhKeluarSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkOutDate"])->format('Y-m-d');


        $tempahan = new RoomReservation(null, $_SESSION['booking_number'], $_SESSION['cust_name'], $_SESSION['phone_number'], $_SESSION['form-email'], $_SESSION['roomsNum'] ,$tarikh_tempahan, $tarikhMasukSQL, $tarikhKeluarSQL, $_SESSION['total_price'], $_POST['payment_method'] ,$_SESSION['room_id']);

        $tempahan->insertReservation();

        header("Location: ../success.php");
        //send email to customer
        //include '../testEMAIL.php';

        exit();
    } elseif ($_POST['submit'] == 'kahwin') {
        include '..\Models/tempahanPerkahwinan.php';
        $tarikhKenduriSQL = DateTime::createFromFormat('d/m/Y', $_SESSION['tarikh_kenduri'])->format('Y-m-d');
        $tarikhKenduriENDSQL = DateTime::createFromFormat('d/m/Y', $_SESSION['tarikh_kenduri_end'])->format('Y-m-d');

        $_SESSION['booking_number'] = generateBookingNumberWed($tarikhKenduriSQL);
        $_SESSION['payment_method'] = $_POST['payment_method'];
        $tempahan = new WeddingReservation(null, $_SESSION['booking_number'], $_SESSION['cust_name'], $_SESSION['phone_number'], $_SESSION['form-email'], $_SESSION['kapasiti'], $tarikh_tempahan, $tarikhKenduriSQL, $tarikhKenduriENDSQL, $_SESSION['total_price_kahwin'], $_POST['payment_method'], $_SESSION['id_dewan_kahwin'] ,$_SESSION["id_perkahwinan"]);
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
        
        header("Location: ../success_kahwin.php");
        exit();
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
		$tarikhMasukSQL = DateTime::createFromFormat('Y-m-d', $_SESSION["checkInDate"])->format('Y-m-d');
		$tarikhKeluarSQL = DateTime::createFromFormat('Y-m-d', $_SESSION["checkOutDate"])->format('Y-m-d');

		// Create the reservation object and insert it into the database
		$tempahan = new DewanReservation(
			null,
			$booking_number,
			$_SESSION['cust_name'],
			$_SESSION['phone_number'],
			$_SESSION['form-email'],
            0,
			$tarikh_tempahan,
			$tarikhMasukSQL,
			$tarikhKeluarSQL,
			$_SESSION['total_price'],
			$_POST['payment_method'],
			$id_dewan 
		);
		$tempahan->insertReservation();

		// Redirect to success_dewan.php with the id_dewan parameter
		$redirectUrl = "../success_dewan.php?id_dewan=" . $id_dewan;

		header("Location: $redirectUrl");
		exit();
	}	elseif ($_POST['submit'] == 'aktiviti') {
        include_once '../Models/tempahanAktiviti.php';
        include_once __DIR__ . '/../database/DBConnec.php';

        $conn = DBConnection::getConnection();

        if (isset($_GET['id_aktiviti']) && !empty($_GET['id_aktiviti'])) {
            $id_aktiviti = htmlspecialchars($_GET['id_aktiviti']);
        } else {
            echo "Error: 'id_aktiviti' not found in the URL.";
            exit();
        }

        // Generate booking number
        $booking_number = generateBookingNumber($conn);
        $_SESSION['booking_number'] = $booking_number;
        echo "Generated Booking Number: $booking_number";

        $tarikhMasukSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkInDate"])->format('Y-m-d');
        $tarikhKeluarSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkOutDate"])->format('Y-m-d');

        $tempahan = new AktivitiReservation(
            null,
            $booking_number,
            $_SESSION['cust_name'],
            $_SESSION['phone_number'],
            $_SESSION['form-email'],
            $_SESSION['total_person'],
            $tarikh_tempahan,
            $tarikhMasukSQL,
            $tarikhKeluarSQL,
            $_SESSION['total_price'],
            $_POST['payment_method'],
            $id_aktiviti,
			$_SESSION['id_dewan'],
			$_SESSION['id_bilik']
        );

        try {
            $tempahan->insertReservation();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            exit();
        }

        $redirectUrl = "../success_aktiviti.php?id_aktiviti=" . $id_aktiviti;
        header("Location: $redirectUrl");
        exit();
    }
}
?>
