<?php
include_once "tempahan.php";
include_once __DIR__ . '/../database/DBConnec.php';

class WeddingReservation extends Reservation
{
    private $wedding_id;

    public function __construct($id, $bookingNumber, $cust_name, $phone_number, $email, $reservationDate, $checkInDate, $checkOutDate, $total_price, $wedding_id)
    {
        parent::__construct($id, $bookingNumber, $cust_name, $phone_number, $email, $reservationDate, $checkInDate, $checkOutDate, $total_price);
        $this->wedding_id = $wedding_id;
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

    public function getWeddingId()
    {
        return $this->wedding_id;
    }

    public function insertReservation()
    {
        $conn = DBConnection::getConnection();
        $sql = "INSERT INTO tempahan (nombor_tempahan, nama_penuh, numbor_fon, email, tarikh_tempahan, tarikh_daftar_masuk, harga_keseluruhan, id_perkahwinan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssdi", $this->bookingNumber, $this->cust_name, $this->phone_number, $this->email, $this->reservationDate, $this->checkInDate, $this->total_price, $this->wedding_id);

        if (!$stmt->execute()) {
            $stmt->close();
            throw new Exception("Failed to insert reservation: " . $stmt->error);
        }

        $reservationId = $conn->insert_id;
        $stmt->close();

        return $reservationId;
    }

    public function insertReservationWithAddOns($addOns, $quantity)
    {
        $conn = DBConnection::getConnection();
        $sql = "INSERT INTO tempahan (nombor_tempahan, nama_penuh, numbor_fon, email, tarikh_tempahan, tarikh_daftar_masuk, harga_keseluruhan, id_perkahwinan) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssdi", $this->bookingNumber, $this->cust_name, $this->phone_number, $this->email, $this->reservationDate, $this->checkInDate, $this->total_price, $this->wedding_id);

        if (!$stmt->execute()) {
            $stmt->close();
            throw new Exception("Failed to insert reservation: " . $stmt->error);
        }

        $reservationId = $conn->insert_id;
        $stmt->close();

        if (!empty($addOns) && !empty($quantity)) {
            $sql = "INSERT INTO tempahan_perkahwinan_addons (id_tempahan, add_on_id, quantity) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);

            foreach ($addOns as $index => $addOnId) {
                $qty = $quantity[$index];
                $stmt->bind_param("iii", $reservationId, $addOnId, $qty);

                if (!$stmt->execute()) {
                    $stmt->close();
                    throw new Exception("Failed to insert add-on: " . $stmt->error);
                }
            }

            $stmt->close();
        }

        return $reservationId;
    }

    public static function getAllReservations()
    {
        $conn = DBConnection::getConnection();
        $sql = "SELECT * FROM tempahan WHERE id_perkahwinan IS NOT NULL";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $reservations = [];
            while ($row = $result->fetch_assoc()) {
                $reservation = new WeddingReservation(
                $row['id_tempahan'], 
                $row['nombor_tempahan'], 
                $row['nama_penuh'], 
                $row['numbor_fon'], 
                $row['email'], 
                $row['tarikh_tempahan'], 
                $row['tarikh_daftar_masuk'], 
                $row['tarikh_daftar_keluar'], 
                $row['harga_keseluruhan'], 
                $row['id_perkahwinan']);
                $reservations[] = $reservation;
            }
            return $reservations;
        } else {
            return [];
        }
    }
}
function generateBookingNumberWed($date)
{
    $random_number = mt_rand(100, 999);
    $booking_number = 'WED-' . $date . '-' . $random_number;
    return $booking_number;
}
