<?php
    include_once "tempahan.php";
    include_once __DIR__ . '/../database/DBConnec.php';

    class WeddingReservation extends Reservation{
        private $wedding_id;

        public function __construct($id, $bookingNumber, $cust_name, $phone_number, $email, $reservationDate, $checkInDate, $checkOutDate, $total_price, $wedding_id){
            parent::__construct($id, $bookingNumber, $cust_name, $phone_number, $email, $reservationDate, $checkInDate, $checkOutDate, $total_price);
            $this->wedding_id = $wedding_id;
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

        public function getWeddingId(){
            return $this->wedding_id;
        }
    }