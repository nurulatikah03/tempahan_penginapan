<?php
class Reservation
{
    protected $id;
    protected $bookingNumber;
    protected $cust_name;
    protected $phone_number;
    protected $email;
    protected $reservationDate;
    protected $checkInDate;
    protected $checkOutDate;
    protected $total_price;

    // Constructor
    public function __construct($id, $bookingNumber, $cust_name, $phone_number, $email, $reservationDate, $checkInDate, $checkOutDate, $total_price)
    {
        $this->id = $id;
        $this->bookingNumber = $bookingNumber;
        $this->cust_name = $cust_name;
        $this->phone_number = $phone_number;
        $this->email = $email;
        $this->reservationDate = $reservationDate;
        $this->checkInDate = $checkInDate;
        $this->checkOutDate = $checkOutDate;
        $this->total_price = $total_price;
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
