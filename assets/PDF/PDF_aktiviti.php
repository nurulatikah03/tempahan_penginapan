<?php
require_once('..\inc\TCPDF\tcpdf.php');
session_start();
include '../../database/DBConnec.php';

// Ambil nombor tempahan dari URL
$nombor_tempahan = filter_input(INPUT_GET, 'booking_number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!$nombor_tempahan) {
    die("Nombor tempahan tidak ditemukan. Pastikan URL mengandung parameter nombor_tempahan.");
}

// Query untuk mendapatkan data tempahan
$query = "SELECT 
            t.nama_penuh, 
            t.numbor_fon, 
            t.email, 
            t.tarikh_tempahan, 
            t.tarikh_daftar_masuk, 
            t.tarikh_daftar_keluar, 
            t.harga_keseluruhan, 
            t.id_aktiviti, 
            t.nombor_tempahan, 
            a.nama_aktiviti,
            a.kadar_harga
          FROM tempahan t
          JOIN aktiviti a ON t.id_aktiviti = a.id_aktiviti
          WHERE t.nombor_tempahan = ?";

$conn = DBConnection::getConnection();
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $nombor_tempahan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Ambil data
    $row = $result->fetch_assoc();

    // Kira bilangan malam
    $datetime1 = new DateTime($row['tarikh_daftar_masuk']);
    $datetime2 = new DateTime($row['tarikh_daftar_keluar']);
    $interval = $datetime1->diff($datetime2);
    $bilangan_hari = $interval->days;
	
    // Check if "total_person" is set in the session, default to 0 if not set
    $total_person = isset($_SESSION["total_person"]) ? $_SESSION["total_person"] : 0;

    $taxRate = 0.06;
    $grandTotal = htmlspecialchars($row['harga_keseluruhan']);
    $taxAmount = $grandTotal * $taxRate;
    $totalAmount = $grandTotal + $taxAmount;

    // Buat dokumen PDF baru
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Tetapan dokumen
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('LKTN');
    $pdf->SetTitle('Invoice Tempahan Aktiviti');
    $pdf->SetSubject('Invoice');
    $pdf->SetKeywords('TCPDF, PDF, invoice, hall booking');

    // Tetapan margin dan halaman
    $pdf->SetMargins(15, 27, 15);
    $pdf->SetHeaderMargin(5);
    $pdf->SetFooterMargin(10);
    $pdf->SetAutoPageBreak(TRUE, 25);
    $pdf->AddPage();

    // Tetapkan font
    $pdf->SetFont('helvetica', '', 12);

    // Kandungan HTML untuk invois
    $html = '
        <h2>Invoice Tempahan Aktiviti</h2>
        <table cellpadding="5">
            <tr>
                <td><strong>Nama Penyewa:</strong> ' . htmlspecialchars($row['nama_penuh']) . '</td>
                <td><strong>Nombor Tempahan:</strong> ' . htmlspecialchars($row['nombor_tempahan']) . '</td>
            </tr>
            <tr>
                <td><strong>Email:</strong> ' . htmlspecialchars($row['email']) . '</td>
                <td><strong>Nombor Tel:</strong> ' . htmlspecialchars($row['numbor_fon']) . '</td>
            </tr>
            <tr>
                <td><strong>Tarikh Tempahan:</strong> ' . htmlspecialchars($row['tarikh_tempahan']) . '</td>
            </tr>
            <tr>
                <td><strong>Tarikh Masuk:</strong> ' . htmlspecialchars($row['tarikh_daftar_masuk']) . '</td>
                <td><strong>Tarikh Keluar:</strong> ' . htmlspecialchars($row['tarikh_daftar_keluar']) . '</td>
            </tr>
        </table>
        <br/>
        <h3>Butiran Tempahan</h3>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th width="20%"><strong>Bil</strong></th>
                    <th><strong>Nama Aktiviti</strong></th>
                    <th><strong>Harga Semalaman</strong></th>
                    <th><strong>Bilangan Peserta</strong></th>
                    <th><strong>Bilangan Malam</strong></th>
                    <th><strong>Jumlah Harga</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="20%">1</td>
                    <td>' . htmlspecialchars($row['nama_aktiviti']) . '</td>
                    <td>RM ' . number_format($row['kadar_harga'], 2) . '</td>
                    <td>' . $total_person . '</td>
                    <td>' . $bilangan_hari . '</td>
                    <td>RM ' . number_format($row['harga_keseluruhan'], 2) . '</td>
                </tr>
            </tbody>
        </table>';

    // Tambah HTML ke PDF
    $pdf->writeHTML($html, true, false, true, false, '');
    
    // Ringkasan
    $pdf->Ln(5);
    $html = '
        <h3>Ringkasan</h3>
        <table cellpadding="5">
            <tr>
                <td><strong>Jumlah harga aktiviti</strong></td>
                <td align="right">RM ' . number_format($row['harga_keseluruhan'], 2) . '</td>
            </tr>
            <tr>
                <td><strong>Tax (' . ($taxRate * 100) . '%)</strong></td>
                <td align="right">RM ' . number_format($taxAmount, 2) . '</td>
            </tr>
            <tr>
                <td><strong>Harga total</strong></td>
                <td align="right"><strong>RM ' . number_format($totalAmount, 2) . '</strong></td>
            </tr>
        </table>
        <p>If you have any questions regarding this invoice, please contact us at admin@lktn.gov.my.</p>
    ';

    // Output summary
    $pdf->writeHTML($html, true, false, false, false, '');

    // Output PDF ke browser
    $pdf->Output('invoice_' . $nombor_tempahan . '.pdf', 'I');
} else {
    echo "Data tidak ditemukan untuk nombor tempahan: " . htmlspecialchars($nombor_tempahan);
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
