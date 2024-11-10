<?php
// Fetch data from the database using prepared statements
$id_perkahwinan = $_GET['id_perkahwinan'];

// Prepare the statement
$query = "SELECT id_perkahwinan, nama_dewan, kadar_harga, penerangan, tambahan, status_perkahwinan, gambar FROM perkahwinan WHERE id_perkahwinan = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_perkahwinan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc();
    
    $nama_dewan = $row['nama_dewan'];
    $kadar_harga = $row['kadar_harga'];
    $penerangan = $row['penerangan'];
    $tambahan = $row['tambahan'];
    $status_perkahwinan = $row['status_perkahwinan'];
    $gambar = $row['gambar'];
    $id_perkahwinan = $row['id_perkahwinan'];
} else {
    echo "<tr><td colspan='8'>Tiada data untuk dipaparkan.</td></tr>";
}

// Close the statement
$stmt->close();
?>