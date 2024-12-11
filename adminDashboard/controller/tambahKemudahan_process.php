<?php
include '../../database/DBConnec.php';

$conn = DBConnection::getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'] ?? '';

    $icon_url = '';
    if (isset($_FILES['icon_file']) && $_FILES['icon_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['icon_file']['tmp_name'];
        $fileName = $_FILES['icon_file']['name'];
        $fileType = $_FILES['icon_file']['type'];

        $allowedFileTypes = ['image/svg+xml'];
        if (in_array($fileType, $allowedFileTypes)) {
            $uploadDir = '../../assets/icons/';
            $destinationFilePath = $uploadDir . $fileName;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (move_uploaded_file($fileTmpPath, $destinationFilePath)) {
                $icon_url = 'assets/icons/' . $fileName;
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

    $stmt = $conn->prepare("INSERT INTO kemudahan (nama, icon_url) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $icon_url);

    if ($stmt->execute()) {
        header("Location: ../kemudahan.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
