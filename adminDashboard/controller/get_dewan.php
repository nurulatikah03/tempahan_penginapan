<?php
// Fetch data from the database using prepared statements
$id_dewan = $_GET['id_dewan']; // Make sure to retrieve the actual id_dewan

// Prepare the statement
$query = "SELECT nama_dewan, kadar_sewa, bilangan_muatan, penerangan, status_dewan, id_dewan, gambar FROM dewan WHERE id_dewan = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_dewan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc();
    
    $nama_dewan = $row['nama_dewan'];
    $kadar_sewa = $row['kadar_sewa'];
    $bilangan_muatan = $row['bilangan_muatan'];
    $penerangan = $row['penerangan'];
    $status_dewan = $row['status_dewan'];
    $gambar = $row['gambar'];
    $id_dewan = $row['id_dewan'];
} else {
    echo "<tr><td colspan='8'>Tiada data untuk dipaparkan.</td></tr>";
}

// Close the statement
$stmt->close();
?>