<?php
require_once "tempahan.php";

class AktivitiReservation extends Reservation
{
    private $id_aktiviti;
	private $id_dewan;
	private $id_bilik;

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
        $id_aktiviti,
		$id_dewan,
		$id_bilik,
		
    ) {
        parent::__construct($id, $bookingNumber, $cust_name, $phone_number, $email, $num_of_Pax, $reservationDate, $checkInDate, $checkOutDate, $total_price, $payment_method);
        $this->id_aktiviti = $id_aktiviti;
		$this->id_dewan = $id_dewan;
		$this->id_bilik = $id_bilik;
    }

    public function getAktivitiId()
    {
        return $this->id_aktiviti;
    }
	
	public function getDewanId()
    {
        return $this->id_dewan;
    }
	
	public function getBilikId()
    {
        return $this->id_bilik;
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
        id_aktiviti, 
		id_dewan,
		id_bilik
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
	 $stmt->bind_param(
        "ssssssssssiii",
        $this->bookingNumber,
        $this->cust_name,
        $this->phone_number,
        $this->email,
        $this->num_of_Pax,
        $this->reservationDate,
        $this->checkInDate,
        $this->checkOutDate,
        $this->total_price,
        $this->payment_method,
        $this->id_aktiviti,
		$this->id_dewan,
		$this->id_bilik
    );

    if (!$stmt->execute()) {
        $stmt->close();  // Close the statement if execution fails
        throw new Exception("Failed to insert reservation: " . $stmt->error);
    }

    $reservationId = $conn->insert_id;  // Retrieve the inserted record's ID
	$stmt->close();
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
        return null;
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
function countRoomAvailable($id_aktiviti, $start_date, $end_date) {
    $conn = DBConnection::getConnection(); // Database connection

    $checkInDateObj = DateTime::createFromFormat('Y-m-d', $start_date);
    $checkOutDateObj = DateTime::createFromFormat('Y-m-d', $end_date);
    $formattedCheckInDate = $checkInDateObj->format('Y-m-d');
    $formattedCheckOutDate = $checkOutDateObj->format('Y-m-d');

    // Step 2: Count the number of rooms occupied in the given date range
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

    // Return the occupied count (assuming that's the "available" count)
    return max(0, $occupiedCount);
}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the input fields
        const checkInDate = document.getElementById('nd_booking_archive_form_date_range_from');
        const checkOutDate = document.getElementById('nd_booking_archive_form_date_range_to');

        // Add an event listener to validate on form submission
        checkOutDate.addEventListener('blur', function () {
            const checkInValue = new Date(checkInDate.value);
            const checkOutValue = new Date(checkOutDate.value);

            // Check if the dates are the same
            if (checkInValue.getTime() === checkOutValue.getTime()) {
                alert('Check-out date cannot be the same as check-in date. Please select a different date.');
                checkOutDate.value = ''; // Clear the invalid date
            }
        });
    });
</script>

?>
