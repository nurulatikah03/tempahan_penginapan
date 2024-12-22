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
            t.id_dewan, 
            t.nombor_tempahan, 
			t.cara_bayar,
            d.nama_dewan,
            d.kadar_sewa
          FROM tempahan t
          JOIN dewan d ON t.id_dewan = d.id_dewan
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
    $bilangan_hari = ($interval->days) + 1;
	
	$taxRate = 0.06;
	$grandTotal = htmlspecialchars($row['harga_keseluruhan']);
	$taxAmount = $grandTotal * $taxRate;
	$totalAmount = $grandTotal + $taxAmount;

    // Buat dokumen PDF baru
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Tetapan dokumen
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('LKTN');
    $pdf->SetTitle('Invoice Tempahan Dewan');
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
        <h2>Invoice Tempahan Dewan</h2>
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
				<td><strong>Tarikh Tempahan:</strong> ' . date('d/m/Y H:i:s', strtotime($row['tarikh_tempahan'])) . '</td>
			</tr>
            <tr>
                <td><strong>Tarikh Masuk:</strong> ' . date('d/m/Y', strtotime($row['tarikh_daftar_masuk'])) . '</td>
                <td><strong>Tarikh Keluar:</strong> ' . date('d/m/Y', strtotime($row['tarikh_daftar_keluar'])) . '</td>
            </tr>
        </table>
        <br/>
        <h3>Butiran Tempahan</h3>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th width="20%"><strong>Bil</strong></th>
                    <th><strong>Nama Dewan</strong></th>
                    <th><strong>Harga Semalaman</strong></th>
                    <th><strong>Bilangan Hari</strong></th>
                    <th><strong>Jumlah Harga</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="20%">1</td>
                    <td>' . htmlspecialchars($row['nama_dewan']) . '</td>
                    <td>RM ' . number_format($row['kadar_sewa'], 2) . '</td>
                    <td>' . $bilangan_hari . '</td>
                    <td>RM ' . number_format($row['harga_keseluruhan'], 2) . '</td>
                </tr>
            </tbody>
        </table>';


    // Tambah HTML ke PDF
    $pdf->writeHTML($html, true, false, true, false, '');
	
	// Summary
$pdf->Ln(5);
$html = '
    <h3>Ringkasan</h3>
    <table cellpadding="5">
        <tr>
            <td><strong>Harga keseluruhan dewan</strong></td>
            <td align="right">RM' .number_format($row['harga_keseluruhan'], 2) . '</td>
        </tr>
        <tr>
			
            <td><strong>Tax (' . ($taxRate * 100) . '%)</strong></td>
            <td align="right">RM' . number_format($taxAmount, 2) . '</td>
        </tr>
        <tr>
            <td><strong>Harga Keseluruhan</strong></td>
            <td align="right"><strong>RM' . number_format($totalAmount, 2) . '</strong></td>
        </tr>
        <tr>
            <td><strong>Cara Pembayaran</strong></td>
            <td align="right">' . htmlspecialchars($row['cara_bayar']) . '</td>
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
