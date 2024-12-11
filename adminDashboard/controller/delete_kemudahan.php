<?php

include '../../database/DBConnec.php';

$conn = DBConnection::getConnection();

$id_kemudahan = mysqli_real_escape_string($conn, $_GET['id_kemudahan']);
$sql = "DELETE FROM kemudahan WHERE id_kemudahan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_kemudahan);

if ($stmt->execute()) {
    header('Location: ../kemudahan.php'); 
} else {
    die("Error: " . $conn->error);
}

$stmt->close();
$conn->close();

?>
