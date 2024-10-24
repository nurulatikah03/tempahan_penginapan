<?php

include '../db-connect.php';

$id_dewan = mysqli_real_escape_string($conn, $_GET['id_dewan']);
$sql = "DELETE FROM dewan WHERE id_dewan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_dewan);

if ($stmt->execute()) {
    header('Location: ../dewan.php'); // Redirect if the delete was successful
} else {
    die("Error: " . $conn->error); // Show error if the query fails
}

$stmt->close();
$conn->close();

?>
