<?php
session_start();
include 'database/DBConnec.php'; 

try {
    $conn = DBConnection::getConnection();

    // Debugging: Output the provided id_dewan
    $id_dewan = isset($_GET['id_dewan']) ? (int) $_GET['id_dewan'] : 0;
    echo "Provided id_dewan: $id_dewan<br>";

    if ($id_dewan > 0) {
        $sql = "SELECT nama_dewan FROM dewan WHERE id_dewan = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $conn->error);
        }

        $stmt->bind_param("i", $id_dewan);
        $stmt->execute();
        $stmt->bind_result($nama_dewan);

        // Debugging: Check if rows are fetched
        if ($stmt->fetch()) {
            echo "Nama Dewan: $nama_dewan";
        } else {
            echo "No data found. Query executed but no rows matched.";
        }

        $stmt->close();
    } else {
        echo "Invalid ID";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    DBConnection::closeConnection();
}
?>
