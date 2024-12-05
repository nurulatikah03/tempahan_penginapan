<?php

include '../db-connect.php';

$id_kemudahan = mysqli_real_escape_string($conn, $_GET['id_kemudahan']);
$sql = "DELETE FROM kemudahan WHERE id_kemudahan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_kemudahan);

if ($stmt->execute()) {
    header('Location: ../kemudahan.php'); // Redirect if the delete was successful
} else {
    die("Error: " . $conn->error); // Show error if the query fails
}

$stmt->close();
$conn->close();

?>
