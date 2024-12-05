<?php
include '../db-connect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'] ?? '';

    // File upload logic
    $icon_url = '';
    if (isset($_FILES['icon_file']) && $_FILES['icon_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['icon_file']['tmp_name'];
        $fileName = $_FILES['icon_file']['name'];
        $fileType = $_FILES['icon_file']['type'];

        // Allow only SVG files
        $allowedFileTypes = ['image/svg+xml'];
        if (in_array($fileType, $allowedFileTypes)) {
            $uploadDir = '../../assets/icons/';
            $destinationFilePath = $uploadDir . $fileName;

            // Create the directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Move the uploaded file to the destination directory
            if (move_uploaded_file($fileTmpPath, $destinationFilePath)) {
                $icon_url = 'assets/icons/' . $fileName; // Relative path to the uploaded file
            } else {
                echo "Error: Failed to upload the file.";
                exit;
            }
        } else {
            echo "Error: Only SVG files are allowed.";
            exit;
        }
    } else {
        echo "Error: No file was uploaded.";
        exit;
    }

    // Insert the data into the database
    $stmt = $conn->prepare("INSERT INTO kemudahan (nama, icon_url) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $icon_url);

    if ($stmt->execute()) {
        // Redirect to kategori.php after successful insertion
        header("Location: ../kemudahan.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
