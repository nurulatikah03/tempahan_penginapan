<?php
include '../db-connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve and sanitize form inputs
    $penginapan_id = mysqli_real_escape_string($conn, $_POST['penginapan_id']);
    $jenis_bilik = mysqli_real_escape_string($conn, $_POST['jenis_bilik']);
    $jumlah_bilik = (int) $_POST['jumlah_bilik'];
    $kadar_sewa = (float) $_POST['kadar_sewa'];
    $bilanganPenyewa = (int) $_POST['bilanganPenyewa'];
    $penerangan = mysqli_real_escape_string($conn, $_POST['penerangan']);
    $statusBilik = mysqli_real_escape_string($conn, $_POST['statusBilik']);

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

