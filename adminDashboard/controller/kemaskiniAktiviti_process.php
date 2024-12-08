<?php
include '../../database/database.php';

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
        // Build the SQL query for updating the aktiviti table
        $query = "UPDATE aktiviti 
                  SET nama_aktiviti = '$nama_aktiviti',
                      kadar_harga = $kadar_harga,
                      penerangan_kemudahan = '$penerangan_kemudahan', 
                      penerangan = '$penerangan',
                      status_aktiviti = '$status_aktiviti'
                  WHERE id_aktiviti = $id_aktiviti"; // Removed the trailing comma

        // Execute the update query for the aktiviti table
        if (!mysqli_query($conn, $query)) {
            throw new Exception('Failed to update aktiviti table');
        }

        // Delete existing entries in the aktiviti_kemudahan table for the current aktiviti
        $delete_query = "DELETE FROM aktiviti_kemudahan WHERE id_aktiviti = $id_aktiviti";
        if (!mysqli_query($conn, $delete_query)) {
            throw new Exception('Failed to delete existing kemudahan for aktiviti');
        }

        // Insert new selected kemudahan into the aktiviti_kemudahan table
        foreach ($selected_kemudahan as $kemudahan_id) {
            $kemudahan_id = (int) $kemudahan_id; // Ensure it's an integer
            $insert_query = "INSERT INTO aktiviti_kemudahan (id_aktiviti, id_kemudahan) VALUES ($id_aktiviti, $kemudahan_id)";
            if (!mysqli_query($conn, $insert_query)) {
                throw new Exception('Failed to insert kemudahan into aktiviti_kemudahan table');
            }
        }

        // Commit the transaction if all queries are successful
        mysqli_commit($conn);

        // Redirect with success message
        header("Location: ../aktiviti.php?status=success&message=Update%20successful");
        exit;
    } catch (Exception $e) {
        // Rollback the transaction if any query fails
        mysqli_rollback($conn);
        
        // Redirect with error message
        header("Location: ../aktiviti.php?status=error&message=" . urlencode($e->getMessage()));
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
