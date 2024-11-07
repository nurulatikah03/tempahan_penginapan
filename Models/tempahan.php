<?php
    include_once __DIR__ . '/../database/database.php';

    class RoomReservation{
        private $id;
        private $bookingNumber;
        private $cust_name;
        private $phone_number;
        private $email;
        private $reservationDate;
        private $checkInDate;
        private $checkOutDate;
        private $total_price;
        private $room_id;

        public function __construct($id, $bookingNumber, $cust_name, $phone_number, $email, $reservationDate, $checkInDate, $checkOutDate, $total_price, $room_id){
            $this->id = $id;
            $this->bookingNumber = $bookingNumber;
            $this->cust_name = $cust_name;
            $this->phone_number = $phone_number;
            $this->email = $email;
            $this->reservationDate = $reservationDate;
            $this->checkInDate = $checkInDate;
            $this->checkOutDate = $checkOutDate;
            $this->total_price = $total_price;
            $this->room_id = $room_id;
        }

        public function setName($name){
            $this->cust_name = $name;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setPhoneNumber($phone_number){
            $this->phone_number = $phone_number;
        }

        public function getId(){
            return $this->id;
        }

        public function getBookingNumber(){
            return $this->bookingNumber;
        }

        public function getRoomId(){
            return $this->room_id;
        }

        public function getCustName(){
            return $this->cust_name;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getPhoneNumber(){
            return $this->phone_number;
        }

        public function getReservationDate(){
            return $this->reservationDate;
        }

        public function getCheckInDate(){
            return $this->checkInDate;
        }

        public function getCheckOutDate(){
            return $this->checkOutDate;
        }

        public function getTotalPrice(){
            return $this->total_price;
        }

        public function getReservationById($id){
            global $conn;
            $sql = "SELECT * FROM tempahan WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $reservation = new RoomReservation($row['id'], $row['nombor_tempahan'], $row['nama_penuh'], $row['numbor_fon'], $row['email'], $row['tarikh_tempahan'], $row['tarikh_daftar_masuk'], $row['tarikh_daftar_keluar'], $row['harga_keseluruhan'], $row['id_bilik']);
            return $reservation;
        }

        public function insertReservation(){
            global $conn;
            $sql = "INSERT INTO tempahan (nombor_tempahan, nama_penuh, numbor_fon, email, tarikh_tempahan, tarikh_daftar_masuk, tarikh_daftar_keluar, harga_keseluruhan, id_bilik) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssss", $this->bookingNumber, $this->cust_name, $this->phone_number, $this->email, $this->reservationDate, $this->checkInDate, $this->checkOutDate, $this->total_price, $this->room_id);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }


    }


    //additonal functions
    function checkRoomAvailability($room_id, $checkInDate, $checkOutDate) {
        global $conn;
        $checkInDateObj = DateTime::createFromFormat('d/m/Y', $checkInDate);
        $checkOutDateObj = DateTime::createFromFormat('d/m/Y', $checkOutDate);
    
        if ($checkInDateObj === false || $checkOutDateObj === false) {
            return "Invalid date format. Please enter dates in DD/MM/YYYY format.";
        }
    
        $formattedCheckInDate = $checkInDateObj->format('Y-m-d');
        $formattedCheckOutDate = $checkOutDateObj->format('Y-m-d');
    
        $sql = "SELECT * FROM tempahan 
                WHERE id_bilik = ? 
                AND (
                    (tarikh_daftar_masuk <= ? AND tarikh_daftar_keluar >= ?) 
                    OR (tarikh_daftar_masuk <= ? AND tarikh_daftar_keluar >= ?) 
                    OR (tarikh_daftar_masuk >= ? AND tarikh_daftar_keluar <= ?)
                )";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssss", 
            $room_id, 
            $formattedCheckOutDate, $formattedCheckInDate, 
            $formattedCheckInDate, $formattedCheckOutDate, 
            $formattedCheckInDate, $formattedCheckOutDate
        );
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $availability = false;
        } else {
            $availability = true;
        }
    
        $stmt->close();
        $conn->close();
    
        return $availability;
    }

    function generateBookingNumber($conn) {
        global $conn;
        $yearMonth = date("Ym");
        $unique = false;
        $bookingNumber = "";
    
        while (!$unique) {
            $randomDigits = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
            $bookingNumber = "BOOK-" . $yearMonth . "-" . $randomDigits;
    
            $query = "SELECT COUNT(*) FROM tempahan WHERE nombor_tempahan = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $bookingNumber);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            
            if ($count == 0) {
                $unique = true; // Booking number is unique
            }
            
            $stmt->close();
        }
    
        return $bookingNumber;
    }

    function calcNumOfNight($checkInDate, $checkOutDate) {
        if (strpos($checkInDate, '/') !== false) {
            $checkInDate = DateTime::createFromFormat('d/m/Y', $checkInDate);
            $checkOutDate = DateTime::createFromFormat('d/m/Y', $checkOutDate);
        } else {
            $checkInDate = DateTime::createFromFormat('Y-m-d', $checkInDate);
            $checkOutDate = DateTime::createFromFormat('Y-m-d', $checkOutDate);
        }
    
        $interval = $checkInDate->diff($checkOutDate);
        $num_of_night = $interval->days; 
    
        return $num_of_night;
    }