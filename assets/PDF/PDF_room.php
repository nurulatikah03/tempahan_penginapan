<?php
require_once('..\inc\TCPDF\tcpdf.php');
include_once '../../Models/tempahanBilik.php';
include_once '../../Models/room.php';
session_start();
$nomborTempahan = filter_input(INPUT_GET, 'viewInvoice', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $_SESSION['booking_number'];
$booking = RoomReservation::getReservationByBookId($nomborTempahan);
$room = Room::getRoomById($booking->getRoomId());


// Sample customer and booking data
$customerName = $booking->getCustName();
$customerEmail = $booking->getEmail();
$invoiceDate = $booking->getReservationDate();
$bookingNumber = $booking->getBookingNumber();
$checkInDate = $booking->getCheckInDate();
$checkOutDate = $booking->getCheckOutDate();
$roomName = $room->getName();
$roomType = $room->getType();
$numOfPax = $booking->getNumOfPax();
$roomRate = $room->getPrice();
$numNights = calcNumOfNight($checkInDate,$checkOutDate);
$totalAmount = $roomRate * $numNights * $numOfPax;
$taxRate = 0.06; // tax
$roomRate = $roomRate * (1 - $taxRate);
$grandTotal = $totalAmount;
$taxAmount = $grandTotal * $taxRate;
$totalAmount = $grandTotal - $taxAmount;

// Create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('LKTN');
$pdf->SetTitle('Invoice tempahan bilik');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('TCPDF, PDF, invoice, room booking');

// Set margins
$pdf->SetMargins(15, 27, 15);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(10);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 25);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Title
//$pdf->Write(0, 'Room Booking Invoice', '', 0, '', true, 0, false, false, 0);
//$pdf->Ln(5);

// Customer details
$html = '
    <h2>Invoice tempahan penginapan</h2>
    <table cellpadding="5">
        <tr>
            <td><strong>Nama penyewa:</strong> ' . $customerName . '</td>
            <td><strong>Nombor tempahan:</strong> ' . $bookingNumber . '</td>
        </tr>
        <tr>
            <td><strong>Email:</strong> ' . $customerEmail . '</td>
        </tr>
    </table>

    <table cellpadding="5">
        <tr>
            <td><strong>Tarikh Invoice:</strong> ' . $invoiceDate . '</td>
            <td></td>
        </tr>
        <tr>
            <td><strong>Tarikh masuk:</strong> ' . $checkInDate . '</td>
            <td><strong>Tarikh keluar:</strong> ' . $checkOutDate . '</td>
        </tr>
    </table>';

// Output customer details
$pdf->writeHTML($html, true, false, false, false, '');

// Booking details
$pdf->Ln(5);
$html = '
    <h3>Butiran Tempahan</h3>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th width="10%"><strong>Bil</strong></th>
                <th><strong>Nama Bilik</strong></th>
                <th><strong>Harga semalaman</strong></th>
                <th><strong>Bilangan malam</strong></th>
                ' . ($roomType !== 'homestay' ? '<th><strong>Bilangan Bilik</strong></th>' : '') . '
                <th><strong>Harga</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="10%">1</td>
                <td>' . $roomName . '</td>
                <td>RM' . number_format($roomRate, 2) . '</td>
                <td>' . $numNights . '</td>
                ' . ($roomType !== 'homestay' ? '<td>' . $numOfPax . '</td>' : '') . '
                <td>RM' . number_format($totalAmount, 2) . '</td>
            </tr>
        </tbody>
    </table>';

// Output booking details
$pdf->writeHTML($html, true, false, false, false, '');

// Summary
$pdf->Ln(5);
$html = '
    <h3>Ringkasan</h3>
    <table cellpadding="5">
        <tr>
            <td><strong>Total harga bilik</strong></td>
            <td align="right">RM' . number_format($totalAmount, 2) . '</td>
        </tr>
        <tr>
            <td><strong>Tax (' . ($taxRate * 100) . '%)</strong></td>
            <td align="right">RM' . number_format($taxAmount, 2) . '</td>
        </tr>
        <tr>
            <td><strong>Harga total</strong></td>
            <td align="right"><strong>RM' . number_format($grandTotal, 2) . '</strong></td>
        </tr>
    </table>
    <p>If you have any questions regarding this invoice, please contact us at admin@lktn.gov.my.</p>
';

// Output summary
$pdf->writeHTML($html, true, false, false, false, '');

// Close and output PDF document

if (isset($_GET['viewInvoice'])) {
    $pdf->Output('room_booking_invoice.pdf', 'I');
}else {
    //$pdfContent = $pdf->Output('', 'S');
    echo 'send pdf as string';
}
?>
