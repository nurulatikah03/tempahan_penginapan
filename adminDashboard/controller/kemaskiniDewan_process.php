<?php
include '../db-connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve and sanitize form inputs
    $id_dewan = mysqli_real_escape_string($conn, $_POST['id_dewan']);
    $nama_dewan = mysqli_real_escape_string($conn, $_POST['nama_dewan']);
    $kadar_sewa = (float) $_POST['kadar_sewa'];
    $bilangan_muatan = (int) $_POST['bilangan_muatan'];
    $status_dewan = mysqli_real_escape_string($conn, $_POST['status_dewan']);
    $penerangan = mysqli_real_escape_string($conn, $_POST['penerangan']);
    
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
    $query = "UPDATE dewan 
              SET nama_dewan = '$nama_dewan',
                  kadar_sewa = $kadar_sewa,
                  bilangan_muatan = $bilangan_muatan,
                  penerangan = '$penerangan',
                  status_dewan = '$status_dewan'";

    // If a new image is uploaded, include it in the query
    if ($gambar !== '') {
        $query .= ", gambar = '$gambar'";
    }

    $query .= " WHERE id_dewan = $id_dewan";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Redirect with success message
        header("Location: ../dewan.php");
    } else {
        // Redirect with error message
        header("Location: ../dewan.php");
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

