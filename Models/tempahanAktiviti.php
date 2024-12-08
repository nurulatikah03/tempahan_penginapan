<?php
include_once "tempahan.php";
include_once __DIR__ . '/../database/DBConnec.php';

class AktivitiReservation extends Reservation
{
    private $id_aktiviti;

    /**
     * Constructor to initialize AktivitiReservation object.
     */
    public function __construct(
        $id, 
        $bookingNumber, 
        $cust_name, 
        $phone_number, 
        $email, 
		$num_of_person,
        $reservationDate, 
        $checkInDate, 
        $checkOutDate, 
        $total_price, 
		$payment_method,
        $id_aktiviti
    ) {
        parent::__construct($id, $bookingNumber, $cust_name, $phone_number, $email, $num_of_person, $reservationDate, $checkInDate, $checkOutDate, $total_price, $payment_method);
        $this->id_aktiviti = $id_aktiviti;
    }

    // Getter for Aktiviti ID
    public function getAktivitiId()
    {
        return $this->id_aktiviti;
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

    $sql = "INSERT INTO tempahan (
        nombor_tempahan, 
        nama_penuh, 
        numbor_fon, 
        bilangan_pax,
        email,
        tarikh_tempahan, 
        tarikh_daftar_masuk, 
        tarikh_daftar_keluar, 
        harga_keseluruhan,
        cara_bayar,            
        id_aktiviti
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssi",
        $this->bookingNumber, 
        $this->cust_name, 
        $this->phone_number, 
        $this->num_of_person,
        $this->email, 
        $this->reservationDate, 
        $this->checkInDate, 
        $this->checkOutDate, 
        $this->total_price, 
        $this->payment_method,
        $this->id_aktiviti
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
    $bookingNumber = "";

    while (!$unique) {
        $randomDigits = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $bookingNumber = "AKTIVITI-" . $yearMonthDay . "-" . $randomDigits;

        $query = "SELECT COUNT(*) FROM tempahan WHERE nombor_tempahan = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $bookingNumber);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();

        if ($count == 0) {
            $unique = true;
        }

        $stmt->close();
    }

    return $bookingNumber;
}

function getKadarHarga($id_aktiviti) {
    $conn = new mysqli('localhost', 'root', '', 'tempahan_penginapan');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $query = "SELECT kadar_harga FROM aktiviti WHERE id_aktiviti = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_aktiviti);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['kadar_harga'];
    } else {
        return null;
    }
}

function getStatusAktiviti($id_aktiviti) {
    $conn = DBConnection::getConnection();

    $query = "SELECT status_aktiviti FROM aktiviti WHERE id_aktiviti = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_aktiviti);
    $stmt->execute();
    $result = $stmt->get_result(); 

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['status_aktiviti'];
    } else {
        return null; 
    }
}


function countRoomAvailable($id_aktiviti, $start_date, $end_date) {
    $conn = DBConnection::getConnection(); // Sambungan pangkalan data

    $checkInDateObj = DateTime::createFromFormat('d/m/Y', $start_date);
    $checkOutDateObj = DateTime::createFromFormat('d/m/Y', $end_date);
    $formattedCheckInDate = $checkInDateObj->format('Y-m-d');
    $formattedCheckOutDate = $checkOutDateObj->format('Y-m-d');

    // Kueri untuk mengira tempahan dalam julat tarikh yang diberikan
    $countQuery = "
        SELECT COUNT(*) AS occupied_count 
        FROM tempahan 
        WHERE id_aktiviti = ? 
        AND tarikh_daftar_masuk <= ? 
        AND tarikh_daftar_keluar >= ?
    ";

    $countStmt = $conn->prepare($countQuery);
    $countStmt->bind_param("iss", $id_aktiviti, $formattedCheckOutDate, $formattedCheckInDate);
    $countStmt->execute();
    $countResult = $countStmt->get_result();
	$occupiedData = $countResult->fetch_assoc();
    $occupiedCount = $occupiedData['occupied_count'];
        return $occupiedCount;
    } 

?>
