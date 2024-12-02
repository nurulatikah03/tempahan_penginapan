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
        // Step 1: Insert the reservation
        $conn = DBConnection::getConnection();
        $sql = "INSERT INTO tempahan (nombor_tempahan, nama_penuh, numbor_fon, email, tarikh_tempahan, tarikh_daftar_masuk, harga_keseluruhan, id_perkahwinan) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssdi", $this->bookingNumber, $this->cust_name, $this->phone_number, $this->email, $this->reservationDate, $this->checkInDate, $this->total_price, $this->wedding_id);

        if (!$stmt->execute()) {
            $stmt->close();
            throw new Exception("Failed to insert reservation: " . $stmt->error);
        }

        // Get the last inserted reservation ID
        $reservationId = $conn->insert_id;
        $stmt->close();

        // Step 2: Insert add-ons
        if (!empty($addOns) && !empty($quantity)) {
            $sql = "INSERT INTO tempahan_perkahwinan_addons (id_tempahan, add_on_id, quantity) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Loop through the add-ons and insert each one
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

        // Return the reservation ID for further use if needed
        return $reservationId;
    }
}
//generate booking number
function generateBookingNumberWed($date)
{
    $random_number = mt_rand(100, 999);
    $booking_number = 'WED-' . $date . '-' . $random_number;
    return $booking_number;
}
