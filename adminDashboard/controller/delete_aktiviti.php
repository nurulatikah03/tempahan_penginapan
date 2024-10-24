<?php

include '../db-connect.php';

$id_aktiviti = mysqli_real_escape_string($conn, $_GET['id_aktiviti']);
$sql = "DELETE FROM aktiviti WHERE id_aktiviti = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_aktiviti);

if ($stmt->execute()) {
    header('Location: ../aktiviti.php'); // Redirect if the delete was successful
} else {
    die("Error: " . $conn->error); // Show error if the query fails
}

$stmt->close();
$conn->close();

?>
