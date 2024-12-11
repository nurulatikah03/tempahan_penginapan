<?php
include '../../database/DBConnec.php';
$conn = DBConnection::getConnection();
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve and sanitize form inputs
    $id_aktiviti = mysqli_real_escape_string($conn, $_POST['id_aktiviti']);
    $nama_aktiviti = mysqli_real_escape_string($conn, $_POST['nama_aktiviti']);
    $kadar_harga = (float) $_POST['kadar_harga'];
    $penerangan_kemudahan = mysqli_real_escape_string($conn, $_POST['penerangan_kemudahan']);
    $penerangan = mysqli_real_escape_string($conn, $_POST['penerangan']);
    $status_aktiviti = mysqli_real_escape_string($conn, $_POST['status_aktiviti']);

    // Fetch the selected kemudahan IDs from the form
    if (isset($_POST['kemudahan'])) {
        $selected_kemudahan = $_POST['kemudahan']; // Array of selected kemudahan IDs
    } else {
        $selected_kemudahan = [];
    }

    // Begin transaction to ensure data integrity
    mysqli_begin_transaction($conn);

    try {
        // Update the aktiviti table using prepared statement
        $query = "UPDATE aktiviti 
                  SET nama_aktiviti = ?, 
                      kadar_harga = ?, 
                      penerangan_kemudahan = ?, 
                      penerangan = ?, 
                      status_aktiviti = ? 
                  WHERE id_aktiviti = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sdssss', $nama_aktiviti, $kadar_harga, $penerangan_kemudahan, $penerangan, $status_aktiviti, $id_aktiviti);
        
        if (!$stmt->execute()) {
            throw new Exception('Failed to update aktiviti table');
        }

        // Delete existing entries in the aktiviti_kemudahan table for the current aktiviti
        $delete_query = "DELETE FROM aktiviti_kemudahan WHERE id_aktiviti = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param('s', $id_aktiviti);
        
        if (!$delete_stmt->execute()) {
            throw new Exception('Failed to delete existing kemudahan for aktiviti');
        }

        // Insert new selected kemudahan into the aktiviti_kemudahan table
        $insert_query = "INSERT INTO aktiviti_kemudahan (id_aktiviti, id_kemudahan) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_query);

        foreach ($selected_kemudahan as $kemudahan_id) {
            $kemudahan_id = (int) $kemudahan_id; // Ensure it's an integer
            $insert_stmt->bind_param('si', $id_aktiviti, $kemudahan_id);
            if (!$insert_stmt->execute()) {
                throw new Exception('Failed to insert kemudahan into aktiviti_kemudahan table');
            }
        }

        // Commit the transaction if all queries are successful
        mysqli_commit($conn);

        // Set session and redirect on success
        $_SESSION['statusKemaskini'] = 'Aktiviti berjaya dikemaskini.';
        header("Location: ../aktiviti.php");
        exit;
        
    } catch (Exception $e) {
        // Rollback transaction on failure
        mysqli_rollback($conn);

        // Set error message and redirect
        $_SESSION['statusKemaskini'] = 'Ralat semasa mengemaskini aktiviti: ' . $e->getMessage();
        header("Location: ../aktiviti.php");
        exit;
    }
}
?>

<?php
// Display success or error messages if set in the URL
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
