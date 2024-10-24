<?php
// Include the TCPDF library
require_once('C:\xampp\htdocs\tempahan_penginapan\assets\inc\TCPDF\tcpdf.php');

// Sample customer and booking data
$customerName = "John Doe";
$customerEmail = "johndoe@example.com";
$invoiceDate = date("d-m-Y");
$bookingNumber = "INV-20241020-1234";
$checkInDate = "2024-11-05";
$checkOutDate = "2024-11-10";
$roomType = "Deluxe Suite";
$roomRate = 150; // per night
$numNights = (strtotime($checkOutDate) - strtotime($checkInDate)) / (60 * 60 * 24);
$totalAmount = $roomRate * $numNights;
$additionalCharges = 50; // For example, service or cleaning fees
$taxRate = 0.1; // 10% tax
$taxAmount = ($totalAmount + $additionalCharges) * $taxRate;
$grandTotal = $totalAmount + $additionalCharges + $taxAmount;

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
$pdf->Write(0, 'Room Booking Invoice', '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(5);

// Customer details
$html = '
    <table cellpadding="5">
        <tr>
            <td><strong>Customer Name:</strong> ' . $customerName . '</td>
            <td><strong>Email:</strong> ' . $customerEmail . '</td>
        </tr>
        <tr>
            <td><strong>Invoice Date:</strong> ' . $invoiceDate . '</td>
            <td><strong>Booking Number:</strong> ' . $bookingNumber . '</td>
        </tr>
        <tr>
            <td><strong>Check-in Date:</strong> ' . $checkInDate . '</td>
            <td><strong>Check-out Date:</strong> ' . $checkOutDate . '</td>
        </tr>
    </table>';

// Output customer details
$pdf->writeHTML($html, true, false, false, false, '');

// Booking details
$pdf->Ln(5);
$html = '
    <h3>Booking Details</h3>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th width="10%"><strong>Bil</strong></th>
                <th><strong>Jenis bilik</strong></th>
                <th><strong>Harga semalaman</strong></th>
                <th><strong>Bilangan malam</strong></th>
                <th><strong>Harga</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="10%">1</td>
                <td>' . $roomType . '</td>
                <td>RM' . number_format($roomRate, 2) . '</td>
                <td>' . $numNights . '</td>
                <td>RM' . number_format($totalAmount, 2) . '</td>
            </tr>
        </tbody>
    </table>';

// Output booking details
$pdf->writeHTML($html, true, false, false, false, '');

// Summary
$pdf->Ln(5);
$html = '
    <h3>Summary</h3>
    <table cellpadding="5">
        <tr>
            <td><strong>Room Total</strong></td>
            <td align="right">RM' . number_format($totalAmount, 2) . '</td>
        </tr>
        <tr>
            <td><strong>Additional Charges</strong></td>
            <td align="right">RM' . number_format($additionalCharges, 2) . '</td>
        </tr>
        <tr>
            <td><strong>Tax (' . ($taxRate * 100) . '%)</strong></td>
            <td align="right">RM' . number_format($taxAmount, 2) . '</td>
        </tr>
        <tr>
            <td><strong>Grand Total</strong></td>
            <td align="right"><strong>RM' . number_format($grandTotal, 2) . '</strong></td>
        </tr>
    </table>
    <p>If you have any questions regarding this invoice, please contact us at admin@lktn.gov.my.</p>
';

// Output summary
$pdf->writeHTML($html, true, false, false, false, '');

// Close and output PDF document
$pdf->Output('room_booking_invoice.pdf', 'I');
?>
