<?php
require_once "tempahan.php";


class WeddingReservation extends Reservation
{
    private $dewan_id;
    private $wedding_id;

    public function __construct($id, $bookingNumber, $cust_name, $phone_number, $email, $num_of_Pax ,$reservationDate, $checkInDate, $checkOutDate, $total_price, $payment_method, $dewan_id, $wedding_id)
    {
        parent::__construct($id, $bookingNumber, $cust_name, $phone_number, $email, $num_of_Pax ,$reservationDate, $checkInDate, $checkOutDate, $total_price, $payment_method);
        $this->wedding_id = $wedding_id;
        $this->dewan_id = $dewan_id;
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

    public function getDewanId()
    {
        return $this->dewan_id;
    }

    public function getWeddingId()
    {
        return $this->wedding_id;
    }
    

    public function insertReservation(){
        $conn = DBConnection::getConnection();
        $sql = "INSERT INTO tempahan (
        nombor_tempahan, 
        nama_penuh, 
        numbor_fon, 
        email, 
        bilangan_pax,
        tarikh_tempahan, 
        tarikh_daftar_masuk, 
        harga_keseluruhan, 
        cara_bayar, 
        id_dewan, 
        id_perkahwinan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssdsii", $this->bookingNumber, $this->cust_name, $this->phone_number, $this->email, $this->num_of_Pax, $this->reservationDate, $this->checkInDate, $this->total_price, $this->payment_method, $this->dewan_id, $this->wedding_id);

        if (!$stmt->execute()) {
            $stmt->close();
            throw new Exception("Failed to insert reservation: " . $stmt->error);
        }

        $stmt->close();
    }

    public function insertReservationWithAddOns($addOns, $quantity)
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
        harga_keseluruhan, 
        cara_bayar, 
        id_dewan, 
        id_perkahwinan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssdsii", $this->bookingNumber, $this->cust_name, $this->phone_number, $this->email, $this->num_of_Pax, $this->reservationDate, $this->checkInDate, $this->total_price, $this->payment_method, $this->dewan_id, $this->wedding_id);

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

    public static function getAddOnsByReservationId($reservationId)
    {
        $conn = DBConnection::getConnection();
        $sql = "SELECT a.*, tpa.quantity FROM tempahan_perkahwinan_addons tpa
                INNER JOIN add_on_perkahwinan a ON tpa.add_on_id = a.add_on_id
                WHERE tpa.id_tempahan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $reservationId);
        $stmt->execute();
        $result = $stmt->get_result();
        $addons = [];
        while ($row = $result->fetch_assoc()) {
            $addons[] = [
                'id' => $row['add_on_id'],
                'name' => $row['add_on_nama'],
                'price' => $row['harga'],
                'quantity' => $row['quantity']
            ];
        }
        $stmt->close();
        return $addons;
    }

    public static function getWedReservationByBookingId($bookingId){
        $conn = DBConnection::getConnection();
        $sql = "SELECT * FROM tempahan WHERE nombor_tempahan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $bookingId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $reservation = new WeddingReservation(
            $row['id_tempahan'], 
            $row['nombor_tempahan'], 
            $row['nama_penuh'], 
            $row['numbor_fon'], 
            $row['email'], 
            $row['bilangan_pax'],
            $row['tarikh_tempahan'], 
            $row['tarikh_daftar_masuk'], 
            $row['tarikh_daftar_keluar'], 
            $row['harga_keseluruhan'], 
            $row['cara_bayar'],
            $row['id_dewan'],
            $row['id_perkahwinan']);
        $stmt->close();
        return $reservation;
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
                $row['bilangan_pax'],
                $row['tarikh_tempahan'], 
                $row['tarikh_daftar_masuk'], 
                $row['tarikh_daftar_keluar'], 
                $row['harga_keseluruhan'], 
                $row['cara_bayar'],
                $row['id_dewan'],
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
    $random_number = mt_rand(1000, 9999);
    $booking_number = 'WED-' . $date . '-' . $random_number;
    return $booking_number;
}
