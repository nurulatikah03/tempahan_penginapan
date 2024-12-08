<?php
require_once('../inc\TCPDF\tcpdf.php');
include_once '../../Models/tempahanPerkahwinan.php';
include_once '../../Models/pekejPerkahwinan.php';
session_start();
$nomborTempahan = filter_input(INPUT_GET, 'viewInvoice', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: $_SESSION['booking_number'];
$booking = WeddingReservation::getWedReservationByBookingId($nomborTempahan);
$package = PekejPerkahwinan::getPekejPerkahwinanById($booking->getWeddingId());
$addons = WeddingReservation::getAddOnsByReservationId($booking->getId());


// Sample customer and booking data
$customerName = $booking->getCustName();
$customerEmail = $booking->getEmail();
$invoiceDate = $booking->getReservationDate();
$bookingNumber = $booking->getBookingNumber();
$tarikhKenduri = $booking->getCheckInDate();
$checkOutDate = $booking->getCheckOutDate();

function beforeTax($totalAmount, $taxRate)
{
    return $totalAmount - ($totalAmount * $taxRate);
}

$packageName = $package->getNamaPekej();
$numOfPax = $booking->getNumOfPax();
$packageRate = $package->getHargaPekej();
$totalAmount = $packageRate;
$taxRate = 0.06; // tax


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
    <h2>Invoice tempahan Pekej Perkahwinan</h2>
    <table cellpadding="5">
        <tr>
            <td><strong>Nama:</strong> ' . $customerName . '</td>
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
            <td><strong>Tarikh Kenduri:</strong> ' . $tarikhKenduri . '</td>
            <td><strong>Bilangan Pax:</strong> ' . $numOfPax . '</td>
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
                <th><strong>Nama</strong></th>
                <th><strong>Harga</strong></th>
                <th><strong>Bilangan</strong></th>
                <th><strong>Harga Total</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="10%">1</td>
                <td>' . $packageName . '</td>
                <td>' . number_format($packageRate, 2) . '</td>
                <td>1</td>
                <td>' . number_format($packageRate, 2) . '</td>
            </tr>';
            $cumAddOnPrice = 0; 
            if (!empty($addons)) {
                $count = 2; 
            
                foreach ($addons as $addon) {
                    $cumAddOnPrice += $addon['price'] * $addon['quantity']; 
            
                    $html .= '
                        <tr>
                            <td width="10%">' . $count++ . '</td>
                            <td>' . htmlspecialchars($addon['name']) . '</td>
                            <td>' . number_format($addon['price'], 2) . '</td>
                            <td>' . htmlspecialchars($addon['quantity']) . '</td>
                            <td>' . number_format(($addon['price'] * $addon['quantity']), 2) . '</td>
                        </tr>';
                }
            }
            $html .= '
                    </tbody>
                </table>';

// Output booking details
$pdf->writeHTML($html, true, false, false, false, '');

// Tax calculation
$grandTotal = $totalAmount + $cumAddOnPrice;
$taxAmount = $grandTotal - beforeTax($grandTotal, $taxRate);
$totalAmount = $grandTotal - $taxAmount;

// Summary
$pdf->Ln(5);
$html = '
    <h3>Ringkasan</h3>
    <table cellpadding="5">
        <tr>
            <td><strong>Total harga</strong></td>
            <td align="right">RM' . number_format(beforeTax($grandTotal, $taxRate), 2) . '</td>
        </tr>
        <tr>
            <td><strong>Tax (' . ($taxRate * 100) . '%)</strong></td>
            <td align="right">RM' . number_format($taxAmount, 2) . '</td>
        </tr>
        <tr>
            <td><strong>Harga terakhir</strong></td>
            <td align="right"><strong>RM' . number_format($grandTotal, 2) . '</strong></td>
        </tr>
        <tr>
            <td><strong>Cara Pembayaran</strong></td>
            <td align="right">' . $booking->getPaymentMethod() . '</td>
        </tr>
    </table>
    <p>If you have any questions regarding this invoice, please contact us at admin@lktn.gov.my.</p>
';

// Output summary
$pdf->writeHTML($html, true, false, false, false, '');

// Close and output PDF document

if (isset($_GET['viewInvoice'])) {
    $pdf->Output('room_booking_invoice.pdf', 'I');
} else {
    //$pdfContent = $pdf->Output('', 'S');
    echo 'send pdf as string';
}
