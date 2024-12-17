<?php
include '../../database/DBConnec.php';
session_start();

header('Content-Type: application/json');
$conn = DBConnection::getConnection();
$data = json_decode(file_get_contents("php://input"), true);

try {
    if (isset($data['image'])) {
        $imagePath = $data['image'];

        // Sanitize input
        $imagePath = basename($imagePath); // Prevent directory traversal
        $filePath = "assets/images/resource/" . $imagePath; // Correct the file path to the relative location

        error_log("Received image path: " . $filePath);

        // Instead of deleting the file, just delete from the database
        $stmt = $conn->prepare("DELETE FROM url_gambar WHERE url_gambar = ?");
        $stmt->bind_param("s", $filePath);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
			$_SESSION['statusDelete'] = 'Gambar berjaya dihapus.';
        } else {
            error_log("Database Error: " . $stmt->error);
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus dari database.']);
        }
        $stmt->close();

    } else {
        error_log("No Image Provided");
        echo json_encode(['success' => false, 'message' => 'Tiada nama gambar yang dihantar.']);
    }
} catch (Exception $e) {
    error_log("Exception: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Terjadi masalah pada server.']);
}

$conn->close();
?>
