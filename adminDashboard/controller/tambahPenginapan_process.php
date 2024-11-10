<?php
include '../db-connect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$jenis_bilik = $_POST['jenis_bilik'] ?? '';
	$jumlah_bilik = $_POST['jumlah_bilik'] ?? 0;
	$kadar_sewa = $_POST['kadar_sewa'] ?? 0.00;
	$bilanganPenyewa = $_POST['bilanganPenyewa'] ?? 0;
	$penerangan = $_POST['penerangan'] ?? '';
	$statusBilik = $_POST['statusBilik'] ?? '';

	// Validate statusBilik (must be 'tersedia' or 'tidak tersedia')
	$validStatus = ['tersedia', 'tidak_tersedia'];
	if (!in_array($statusBilik, $validStatus)) {
		echo "Status bilik tidak sah. Pilih 'tersedia' atau 'tidak tersedia'.";
		exit; // Stop execution if the status is invalid
	}

    // Handle file upload
    if (isset($_FILES['fileinput']) && $_FILES['fileinput']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['fileinput']['tmp_name'];
        $fileName = $_FILES['fileinput']['name'];
        $fileSize = $_FILES['fileinput']['size'];
        $fileType = $_FILES['fileinput']['type'];

        // Specify the directory where you want to save the uploaded file
        $uploadFileDir = 'uploads/';
        $dest_path = $uploadFileDir . $fileName;

        // Check if the upload directory exists, if not create it
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            echo "Fail berjaya dimuat naik.<br>";
        } else {
            echo "Terdapat ralat mengalihkan fail yang dimuat naik.<br>";
        }
    } else {
        echo "Ralat muat naik fail: " . $_FILES['fileinput']['error'] . "<br>";
    }

    // Prepare SQL statement to prevent SQL injection$stmt = 
	$stmt = $conn->prepare("INSERT INTO penginapan (jenis_bilik, jumlah_bilik, kadar_sewa, bilanganPenyewa, penerangan, statusBilik, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("sidssss", $jenis_bilik, $jumlah_bilik, $kadar_sewa, $bilanganPenyewa, $penerangan, $statusBilik, $fileName);
	
    // Execute the statement
    if ($stmt->execute()) {
        header("Location: ../penginapan.php");
		
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Kaedah permintaan tidak sah.";
}

?>