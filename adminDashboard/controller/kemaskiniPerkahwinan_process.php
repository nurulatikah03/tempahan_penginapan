<?php
include '../db-connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve and sanitize form inputs
    $id_perkahwinan = mysqli_real_escape_string($conn, $_POST['id_perkahwinan']);
    $nama_dewan = mysqli_real_escape_string($conn, $_POST['nama_dewan']);
    $kadar_harga = (float) $_POST['kadar_harga'];
    $tambahan = mysqli_real_escape_string($conn, $_POST['tambahan']);
    $penerangan = mysqli_real_escape_string($conn, $_POST['penerangan']);
    $status_perkahwinan = mysqli_real_escape_string($conn, $_POST['status_perkahwinan']);
    
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
    $query = "UPDATE perkahwinan 
              SET nama_dewan = '$nama_dewan',
                  kadar_harga = '$kadar_harga',
                  tambahan = '$tambahan',
                  penerangan = '$penerangan',
                  status_perkahwinan = '$status_perkahwinan'";

    // If a new image is uploaded, include it in the query
    if ($gambar !== '') {
        $query .= ", gambar = '$gambar'";
    }

    $query .= " WHERE id_perkahwinan = $id_perkahwinan";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Redirect with success message
        header("Location: ../perkahwinan.php");
    } else {
        // Redirect with error message
        echo "gagal";
    }
}
?>

<?php
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $message = $_GET['message'];

    if ($status == 'success') {
        echo "<div class='alert alert-success'>$message</div>";
    } else if ($status == 'error') {
        echo "<div class='alert alert-danger'>$message</div>";
    }
}
?>

