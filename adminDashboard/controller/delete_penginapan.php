<?php

include '../db-connect.php';

$penginapan_id = mysqli_real_escape_string($conn, $_GET['penginapan_id']);
$sql = "DELETE FROM penginapan WHERE penginapan_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $penginapan_id);

if ($stmt->execute()) {
    header('Location: ../penginapan.php'); // Redirect if the delete was successful
} else {
    die("Error: " . $conn->error); // Show error if the query fails
}

$stmt->close();
$conn->close();

?>
