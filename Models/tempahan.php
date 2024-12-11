<?php
require_once __DIR__ . '/../database/DBConnec.php';


class Reservation
{
    protected $id;
    protected $bookingNumber;
    protected $cust_name;
    protected $phone_number;
    protected $email;
    protected $num_of_Pax;
    protected $reservationDate;
    protected $checkInDate;
    protected $checkOutDate;
    protected $total_price;
    protected $payment_method;

    // Constructor
    public function __construct($id, $bookingNumber, $cust_name, $phone_number, $email, $num_of_Pax ,$reservationDate, $checkInDate, $checkOutDate, $total_price, $payment_method)
    {
        $this->id = $id;
        $this->bookingNumber = $bookingNumber;
        $this->cust_name = $cust_name;
        $this->phone_number = $phone_number;
        $this->email = $email;
        $this->num_of_Pax = $num_of_Pax;
        $this->reservationDate = $reservationDate;
        $this->checkInDate = $checkInDate;
        $this->checkOutDate = $checkOutDate;
        $this->total_price = $total_price;
        $this->payment_method = $payment_method;
    }

    // Getters and setters
    public function getId()
    {
        return $this->id;
    }

    public function getBookingNumber()
    {
        return $this->bookingNumber;
    }

    public function getCustName()
    {
        return $this->cust_name;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNumOfPax()
    {
        return $this->num_of_Pax;
    }

    public function getReservationDate()
    {
        return $this->reservationDate;
    }

    public function getCheckInDate()
    {
        return $this->checkInDate;
    }

    public function getCheckOutDate()
    {
        return $this->checkOutDate;
    }

    public function getTotalPrice()
    {
        return $this->total_price;
    }

    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    public function calculateDuration()
    {
        $checkIn = new DateTime($this->checkInDate);
        $checkOut = new DateTime($this->checkOutDate);
        return $checkIn->diff($checkOut)->days;
    }
}

function formatDateFromSQL($date) {
    $dateObj = DateTime::createFromFormat('Y-m-d', $date);
    return $dateObj->format('d/m/Y');
}
