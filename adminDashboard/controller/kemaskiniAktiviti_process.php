<?php
include '../../database/database.php';
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
        // Build the SQL query for updating the aktiviti table
        $query = "UPDATE aktiviti 
          SET nama_aktiviti = ?, kadar_harga = ?, penerangan_kemudahan = ?, penerangan = ?, status_aktiviti = ? 
          WHERE id_aktiviti = ?";

		$stmt = mysqli_prepare($conn, $query);
		mysqli_stmt_bind_param($stmt, 'sdssss', $nama_aktiviti, $kadar_harga, $penerangan_kemudahan, $penerangan, $status_aktiviti, $id_aktiviti);
		if (!mysqli_stmt_execute($stmt)) {
			throw new Exception('Gagal mengemas kini jadual aktiviti');
		}

        // Delete existing entries in the aktiviti_kemudahan table for the current aktiviti
        $delete_query = "DELETE FROM aktiviti_kemudahan WHERE id_aktiviti = $id_aktiviti";
        if (!mysqli_query($conn, $delete_query)) {
            throw new Exception('Gagal memadam kemudahan sedia ada untuk aktiviti');
        }

        // Insert new selected kemudahan into the aktiviti_kemudahan table
        foreach ($selected_kemudahan as $kemudahan_id) {
            $kemudahan_id = (int) $kemudahan_id; // Ensure it's an integer
            $insert_query = "INSERT INTO aktiviti_kemudahan (id_aktiviti, id_kemudahan) VALUES ($id_aktiviti, $kemudahan_id)";
            if (!mysqli_query($conn, $insert_query)) {
                throw new Exception('Gagal memasukkan kemudahan ke dalam jadual aktiviti_kemudahan');
            }
        }

        // Commit the transaction if all queries are successful
        mysqli_commit($conn);
		
			// **Set session and redirect here**
			$_SESSION['statusKemaskini'] = 'Aktiviti berjaya dikemaskini';
			header("Location: ../aktiviti.php");
			exit;
	} catch (Exception $e){
		mysqli_rollback($conn);
		$_SESSION['statusKemaskini'] = 'Ralat semasa mengemaskini aktiviti: ' .$e->getMessage();
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
