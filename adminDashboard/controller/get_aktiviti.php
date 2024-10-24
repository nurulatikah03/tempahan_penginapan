<?php
// Fetch data from the database using prepared statements
$id_aktiviti = $_GET['id_aktiviti']; // Make sure to retrieve the actual id_aktiviti

// Prepare the statement
$query = "SELECT id_aktiviti, nama_aktiviti, kadar_harga, kemudahan, penerangan, status_aktiviti, gambar FROM aktiviti WHERE id_aktiviti = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_aktiviti);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc();
    
    $nama_aktiviti = $row['nama_aktiviti'];
    $kadar_harga = $row['kadar_harga'];
    $kemudahan = $row['kemudahan'];
    $penerangan = $row['penerangan'];
    $status_aktiviti = $row['status_aktiviti'];
    $gambar = $row['gambar'];
    $id_aktiviti = $row['id_aktiviti'];
} else {
    echo "<tr><td colspan='8'>Tiada data untuk dipaparkan.</td></tr>";
}

// Close the statement
$stmt->close();
?>