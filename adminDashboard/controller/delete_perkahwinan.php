<?php

include '../db-connect.php';

$id_perkahwinan = mysqli_real_escape_string($conn, $_GET['id_perkahwinan']);
$sql = "DELETE FROM perkahwinan WHERE id_perkahwinan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_perkahwinan);

if ($stmt->execute()) {
    header('Location: ../perkahwinan.php'); // Redirect if the delete was successful
} else {
    die("Error: " . $conn->error); // Show error if the query fails
}

$stmt->close();
$conn->close();

?>
