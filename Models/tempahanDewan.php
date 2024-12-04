<?php
include_once "tempahan.php";
include_once __DIR__ . '/../database/DBConnec.php';

class DewanReservation extends Reservation
{
    private $id_dewan;

    public function __construct(
        $id, 
        $booking_number, 
        $cust_name, 
        $phone_number, 
        $email, 
        $num_of_Pax, 
        $reservationDate, 
        $checkInDate, 
        $checkOutDate, 
        $total_price, 
		$payment_method,
        $id_dewan
    ) {
		parent::__construct($id, $booking_number, $cust_name, $phone_number, $email, $num_of_Pax ,$reservationDate, $checkInDate, $checkOutDate, $total_price, $payment_method);
        $this->id_dewan = $id_dewan;
    }

    // Getter for Dewan ID
    public function getDewanId()
    {
        return $this->id_dewan;
    }

    // Setter for Customer Name
    public function setName($name)
    {
        $this->cust_name = $name;
    }

    // Setter for Email
    public function setEmail($email)
    {
        $this->email = $email;
    }

    // Setter for Phone Number
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    /**
     * Insert reservation data into the database.
     *
     * @return int Reservation ID of the newly inserted record.
     * @throws Exception if the insertion fails.
     */
    public function insertReservation()
    {
        $conn = DBConnection::getConnection();

        $sql = "INSERT INTO tempahan 
                (nombor_tempahan, nama_penuh, numbor_fon, email, bilangan_pax, tarikh_tempahan, tarikh_daftar_masuk, tarikh_daftar_keluar, harga_keseluruhan, cara_bayar, id_dewan) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Database preparation failed: " . $conn->error);
        }

        $stmt->bind_param(
            "ssssssssssi", 
            $this->id,
            $this->booking_number, 
            $this->cust_name, 
            $this->phone_number, 
            $this->email, 
            $this->num_of_Pax, 
            $this->reservationDate, 
            $this->checkInDate, 
            $this->checkOutDate, 
            $this->total_price, 
			$this->payment_method,
            $this->id_dewan
        );

        if (!$stmt->execute()) {
            $stmt->close();
            throw new Exception("Failed to insert reservation: " . $stmt->error);
        }

        $reservationId = $conn->insert_id; // Retrieve the inserted record's ID
        $stmt->close();

        return $reservationId;
    }
}
function generateBookingNumber($conn) {
    $yearMonthDay = date("ymd");
    $unique = false;
    $booking_number = "";

    while (!$unique) {
        $randomDigits = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $booking_number = "DEWAN-" . $yearMonthDay . "-" . $randomDigits;

        $query = "SELECT COUNT(*) FROM tempahan WHERE nombor_tempahan = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $booking_number);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();

        if ($count == 0) {
            $unique = true;
        }

        $stmt->close();
    }

    return $booking_number;
}

function getKadarSewa($id_dewan) {
    $conn = new mysqli('localhost', 'root', '', 'tempahan_penginapan');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $query = "SELECT kadar_sewa FROM dewan WHERE id_dewan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_dewan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['kadar_sewa'];
    } else {
        return null;
    }
}

function getStatusDewan($id_dewan) {
    $conn = DBConnection::getConnection();

    $query = "SELECT status_dewan FROM dewan WHERE id_dewan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_dewan);
    $stmt->execute();
    $result = $stmt->get_result(); 

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['status_dewan'];
    } else {
        return null; 
    }
}


function countRoomAvailable($id_dewan, $start_date, $end_date) {
    $conn = DBConnection::getConnection(); // Database connection

    $checkInDateObj = DateTime::createFromFormat('d/m/Y', $start_date);
    $checkOutDateObj = DateTime::createFromFormat('d/m/Y', $end_date);
    $formattedCheckInDate = $checkInDateObj->format('Y-m-d');
    $formattedCheckOutDate = $checkOutDateObj->format('Y-m-d');

    // Step 1: Get max_available_room for the room
    $roomQuery = "SELECT max_capacity FROM dewan WHERE id_dewan = ?";
    $roomStmt = $conn->prepare($roomQuery);
    $roomStmt->bind_param("i", $id_dewan);
    $roomStmt->execute();
    $roomResult = $roomStmt->get_result();
    if ($roomResult->num_rows > 0) {
        $roomData = $roomResult->fetch_assoc();
        $maxAvailable = $roomData['max_capacity'];
    } else {
        return 0; // Jika tidak ada data dewan
    }

    // Step 2: Count the number of rooms occupied in the given date range
    $countQuery = "
        SELECT COUNT(*) AS occupied_count 
        FROM tempahan 
        WHERE id_dewan = ? 
        AND tarikh_daftar_masuk <= ? 
        AND tarikh_daftar_keluar >= ?
    ";
    $countStmt = $conn->prepare($countQuery);
    $countStmt->bind_param("iss", $id_dewan, $formattedCheckOutDate, $formattedCheckInDate);
    $countStmt->execute();
    $countResult = $countStmt->get_result();
    $occupiedData = $countResult->fetch_assoc();
    $occupiedCount = $occupiedData['occupied_count'];

    // Step 3: Calculate available rooms
    $availableRooms = $maxAvailable - $occupiedCount;

    // Ensure we don't return a negative number if overbooked
    return max(0, $availableRooms);
}
?>
