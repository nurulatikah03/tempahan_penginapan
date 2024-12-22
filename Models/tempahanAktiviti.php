<?php
require_once "tempahan.php";

class AktivitiReservation extends Reservation
{
    private $id_aktiviti;

    public function __construct(
        $id,
        $bookingNumber,
        $cust_name,
        $phone_number,
        $email,
        $num_of_Pax,
        $reservationDate,
        $checkInDate,
        $checkOutDate,
        $total_price,
        $payment_method,
        $id_aktiviti
    ) {
        parent::__construct($id, $bookingNumber, $cust_name, $phone_number, $email, $num_of_Pax, $reservationDate, $checkInDate, $checkOutDate, $total_price, $payment_method);
        $this->id_aktiviti = $id_aktiviti;
    }

    public function getAktivitiId()
    {
        return $this->id_aktiviti;
    }

    public function setName($name)
    {
        $this->cust_name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function insertReservation()
{
    $conn = DBConnection::getConnection();

    $sql = "INSERT INTO tempahan (
        nombor_tempahan, 
        nama_penuh, 
        numbor_fon, 
        email, 
        bilangan_pax,
        tarikh_tempahan, 
        tarikh_daftar_masuk, 
        tarikh_daftar_keluar, 
        harga_keseluruhan, 
        cara_bayar, 
        id_dewan
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssssssssi",
        $this->bookingNumber,
        $this->cust_name,
        $this->phone_number,
        $this->num_of_Pax,
        $this->email,
        $this->reservationDate,
        $this->checkInDate,
        $this->checkOutDate,
        $this->total_price,
        $this->payment_method,
        $this->id_aktiviti
    );

    if (!$stmt->execute()) {
        $stmt->close();  // Close the statement if execution fails
        throw new Exception("Failed to insert reservation: " . $stmt->error);
    }

    $reservationId = $conn->insert_id;  // Retrieve the inserted record's ID

    // Return the reservation ID to make sure the execution is finished before closing
    $stmt->close();  // Only close the statement after execution and returning the result
    return $reservationId;
}

}

function generateBookingNumber($conn)
{
    $yearMonthDay = date("ymd");
    $unique = false;
    $bookingNumber = "";
    $count = 0;

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

function getKadarHarga($id_aktiviti)
{
    $conn = DBConnection::getConnection();

    $query = "SELECT kadar_harga FROM aktiviti WHERE id_aktiviti = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_aktiviti);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['kadar_harga'];
    } else {
        throw new Exception("Price for activity with ID $id_aktiviti not found.");
    }
}

function getStatusAktiviti($id_aktiviti)
{
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
?>
