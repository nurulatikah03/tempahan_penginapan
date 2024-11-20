<?php
    include_once "tempahan.php";
    include_once __DIR__ . '/../database/database.php';

    class RoomReservation extends Reservation{
        private $room_id;

        public function __construct($id, $bookingNumber, $cust_name, $phone_number, $email, $reservationDate, $checkInDate, $checkOutDate, $total_price, $room_id){
            parent::__construct($id, $bookingNumber, $cust_name, $phone_number, $email, $reservationDate, $checkInDate, $checkOutDate, $total_price);
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

        public function getRoomId(){
            return $this->room_id;
        }

        public static function getAllReservation(){
            global $conn;
            $sql = "SELECT * FROM tempahan";
            $result = $conn->query($sql);
            $reservations = [];
            while($row = $result->fetch_assoc()){
                $reservation = new RoomReservation($row['id_tempahan'], $row['nombor_tempahan'], $row['nama_penuh'], $row['numbor_fon'], $row['email'], $row['tarikh_tempahan'], $row['tarikh_daftar_masuk'], $row['tarikh_daftar_keluar'], $row['harga_keseluruhan'], $row['id_bilik']);
                array_push($reservations, $reservation);
            }
            return $reservations;
        }

        public static function getReservationByBookId($bookingNumber){
            global $conn;
            $sql = "SELECT t.*, b.jenis_bilik, b.harga_semalaman 
                    FROM tempahan t 
                    INNER JOIN bilik b ON t.id_bilik = b.id_bilik 
                    WHERE t.nombor_tempahan = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $bookingNumber);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $reservation = new RoomReservation($row['id_tempahan'], $row['nombor_tempahan'], $row['nama_penuh'], $row['numbor_fon'], $row['email'], $row['tarikh_tempahan'], $row['tarikh_daftar_masuk'], $row['tarikh_daftar_keluar'], $row['harga_keseluruhan'], $row['id_bilik']);
            $stmt->close();
            $conn->close();
            return $reservation;
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
            $stmt->close();
            $conn->close();
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


    //fxs
    function countRoomAvailable($room_id, $start_date, $end_date) {
        global $conn; // Database connection

        $checkInDateObj = DateTime::createFromFormat('d/m/Y', $start_date);
        $checkOutDateObj = DateTime::createFromFormat('d/m/Y', $end_date);
        $formattedCheckInDate = $checkInDateObj->format('Y-m-d');
        $formattedCheckOutDate = $checkOutDateObj->format('Y-m-d');
        
        // Step 1: Get max_available_room for the room
        $roomQuery = "SELECT max_capacity FROM bilik WHERE id_bilik = ?";
        $roomStmt = $conn->prepare($roomQuery);
        $roomStmt->bind_param("i", $room_id);
        $roomStmt->execute();
        $roomResult = $roomStmt->get_result();
        $roomData = $roomResult->fetch_assoc();
        $maxAvailable = $roomData['max_capacity'];
        
        // Step 2: Count the number of rooms occupied in the given date range
        $countQuery = "
            SELECT COUNT(*) AS occupied_count 
            FROM tempahan 
            WHERE id_bilik = ? AND (tarikh_daftar_masuk <= ? AND tarikh_daftar_keluar >= ?)
        ";
        $countStmt = $conn->prepare($countQuery);
        $countStmt->bind_param("iss", $room_id, $formattedCheckOutDate, $formattedCheckInDate);
        $countStmt->execute();
        $countResult = $countStmt->get_result();
        $occupiedData = $countResult->fetch_assoc();
        $occupiedCount = $occupiedData['occupied_count'];
    
        // Step 3: Calculate available rooms
        $availableRooms = $maxAvailable - $occupiedCount;
    
        // Ensure we don't return a negative number if overbooked
        return max(0, $availableRooms);
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

    function formatDateFromSQL($date) {
        $dateObj = DateTime::createFromFormat('Y-m-d', $date);
        return $dateObj->format('d/m/Y');
    }