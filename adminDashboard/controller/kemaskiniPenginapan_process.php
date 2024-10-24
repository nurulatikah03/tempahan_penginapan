<?php
include '../db-connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve and sanitize form inputs
    $penginapan_id = mysqli_real_escape_string($conn, $_POST['penginapan_id']);
    $jenis_bilik = mysqli_real_escape_string($conn, $_POST['jenis_bilik']);
    $jumlah_bilik = (int) $_POST['jumlah_bilik'];
    $kadar_sewa = (float) $_POST['kadar_sewa'];
    $bilanganPenyewa = (int) $_POST['bilanganPenyewa'];
    $penerangan = mysqli_real_escape_string($conn, $_POST['penerangan']);
    $statusBilik = mysqli_real_escape_string($conn, $_POST['statusBilik']);
    
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
    $query = "UPDATE penginapan 
              SET jenis_bilik = '$jenis_bilik',
                  jumlah_bilik = $jumlah_bilik,
                  kadar_sewa = $kadar_sewa,
                  bilanganPenyewa = $bilanganPenyewa,
                  penerangan = '$penerangan',
                  statusBilik = '$statusBilik'";

    // If a new image is uploaded, include it in the query
    if ($gambar !== '') {
        $query .= ", gambar = '$gambar'";
    }

    $query .= " WHERE penginapan_id = $penginapan_id";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Redirect with success message
        header("Location: ../penginapan.php");
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

