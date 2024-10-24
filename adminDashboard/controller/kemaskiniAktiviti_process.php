<?php
include '../db-connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve and sanitize form inputs
    $id_aktiviti = mysqli_real_escape_string($conn, $_POST['id_aktiviti']);
    $nama_aktiviti = mysqli_real_escape_string($conn, $_POST['nama_aktiviti']);
    $kadar_harga = (float) $_POST['kadar_harga'];
    $kemudahan = mysqli_real_escape_string($conn, $_POST['kemudahan']);
    $penerangan = mysqli_real_escape_string($conn, $_POST['penerangan']);
    $status_aktiviti = mysqli_real_escape_string($conn, $_POST['status_aktiviti']);
    
    // Image upload handling
    $gambar = '';
    if (!empty($_FILES['fileinput']['name'])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['fileinput']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array(strtolower($fileType), $allowedTypes)) {
            // Move uploaded file to server
            if (move_uploaded_file($_FILES['fileinput']['tmp_name'], $targetFilePath)) {
                // Assign the file name to the variable to be saved in the database
                $gambar = $fileName;
            } else {
                // Error handling if the image upload fails
                echo "Error uploading file.";
                exit;
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
            exit;
        }
    }

    // Build the SQL query for updating the accommodation
    $query = "UPDATE aktiviti 
              SET nama_aktiviti = '$nama_aktiviti',
                  kadar_harga = $kadar_harga,
                  kemudahan = '$kemudahan', 
                  penerangan = '$penerangan',
                  status_aktiviti = '$status_aktiviti'";

    // If a new image is uploaded, include it in the query
    if ($gambar !== '') {
        $query .= ", gambar = '$gambar'";
    }

    $query .= " WHERE id_aktiviti = $id_aktiviti";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Redirect with success message
        header("Location: ../aktiviti.php");
    } else {
        // Redirect with error message
        echo "gagal: " . mysqli_error($conn); // Display the SQL error for debugging
    }
}
?>


