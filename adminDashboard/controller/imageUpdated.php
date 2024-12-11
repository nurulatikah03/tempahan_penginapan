<?php
// Include your database connection file
include('../../database/DBConnec.php'); 
$conn = DBConnection::getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure the correct image type and destination path
    $id_aktiviti= $_GET['id_aktiviti']; // Get id_aktiviti from the URL
    $image_type = $_POST['image_type']; // This will be "utama", "banner", or "tambahan"

    // Determine the correct upload path
    if ($image_type == 'utama' || $image_type == 'tambahan') {
        $upload_dir = 'assets/images/resource/';
    } elseif ($image_type == 'banner') {
        $upload_dir = 'assets/images/background/';
    }

    // Handle file upload
    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
        // Get file details
        $file_tmp = $_FILES['imageUpload']['tmp_name'];
        $file_name = $_FILES['imageUpload']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . '.' . $file_ext; // Generate a unique name for the file

        // Move the file to the upload directory
        if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
            // Update database with new image URL
            $image_url = $upload_dir . $new_file_name;

            // Delete old image file
            $sql_select = "SELECT url_gambar FROM aktiviti_pic WHERE jenis_gambar = ? AND id_aktiviti = ?";
            $stmt_select = $conn->prepare($sql_select);
            $stmt_select->bind_param("si", $image_type, $id_aktiviti);
            $stmt_select->execute();
            $stmt_select->bind_result($old_image_url);
            if ($stmt_select->fetch() && file_exists($old_image_url)) {
                unlink($old_image_url); // Delete the old image file
            }
            $stmt_select->close();

            // Update new image URL in the database
            $sql = "UPDATE aktiviti_pic SET url_gambar = ? WHERE jenis_gambar = ? AND id_aktiviti = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $image_url, $image_type, $id_aktiviti);
            if ($stmt->execute()) {
                echo "success"; // Indicate success
            } else {
                echo "Failed to update the database.";
            }

            $stmt->close();
        } else {
            echo "Failed to upload the image.";
        }
    } else {
        echo "No file uploaded or there was an error.";
    }
    $conn->close();
}
?>
