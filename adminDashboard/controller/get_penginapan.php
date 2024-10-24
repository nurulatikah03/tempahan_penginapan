<?php
// Fetch data from the database using prepared statements
$penginapan_id = $_GET['penginapan_id']; // Make sure to retrieve the actual penginapan_id

// Prepare the statement
$query = "SELECT jenis_bilik, jumlah_bilik, kadar_sewa, bilanganPenyewa, penerangan, statusBilik, penginapan_id, gambar FROM penginapan WHERE penginapan_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $penginapan_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc();
    
    $jenis_bilik = $row['jenis_bilik'];
    $kadar_sewa = $row['kadar_sewa'];
    $jumlah_bilik = $row['jumlah_bilik'];
    $bilanganPenyewa = $row['bilanganPenyewa'];
    $penerangan = $row['penerangan'];
    $statusBilik = $row['statusBilik'];
    $gambar = $row['gambar'];
    $penginapan_id = $row['penginapan_id'];
} else {
    echo "<tr><td colspan='8'>Tiada data untuk dipaparkan.</td></tr>";
}

// Close the statement
$stmt->close();
?>