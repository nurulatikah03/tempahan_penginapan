<?php
include '../../database/DBConnec.php';
$conn = DBConnection::getConnection();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_dewan = mysqli_real_escape_string($conn, $_POST['id_dewan']);
    $nama_dewan = mysqli_real_escape_string($conn, $_POST['nama_dewan']);
    $kadar_sewa = (float) $_POST['kadar_sewa'];
    $bilangan_muatan = (int) $_POST['bilangan_muatan'];
    $status_dewan = mysqli_real_escape_string($conn, $_POST['status_dewan']);
    $penerangan = mysqli_real_escape_string($conn, $_POST['penerangan']);
    $penerangan_ringkas = mysqli_real_escape_string($conn, $_POST['penerangan_ringkas']);
    $penerangan_kemudahan = mysqli_real_escape_string($conn, $_POST['penerangan_kemudahan']);
    $max_capacity = (int) $_POST['max_capacity'];

    if (isset($_POST['kemudahan'])) {
        $selected_kemudahan = $_POST['kemudahan'];
    } else {
        $selected_kemudahan = [];
    }

    mysqli_begin_transaction($conn);

    try {
        $query = "UPDATE dewan 
                  SET nama_dewan = '$nama_dewan',
                      kadar_sewa = $kadar_sewa,
                      bilangan_muatan = $bilangan_muatan,
                      penerangan = '$penerangan',
                      penerangan_ringkas = '$penerangan_ringkas',
                      penerangan_kemudahan = '$penerangan_kemudahan',
                      max_capacity = '$max_capacity',
                      status_dewan = '$status_dewan'
                  WHERE id_dewan = $id_dewan";

        if (!mysqli_query($conn, $query)) {
            throw new Exception('Failed to update dewan table');
        }

        $delete_query = "DELETE FROM dewan_kemudahan WHERE id_dewan = $id_dewan";
        if (!mysqli_query($conn, $delete_query)) {
            throw new Exception('Failed to delete existing kemudahan for dewan');
        }

        foreach ($selected_kemudahan as $kemudahan_id) {
            $kemudahan_id = (int) $kemudahan_id;
            $insert_query = "INSERT INTO dewan_kemudahan (id_dewan, id_kemudahan) VALUES ($id_dewan, $kemudahan_id)";
            if (!mysqli_query($conn, $insert_query)) {
                throw new Exception('Failed to insert kemudahan into dewan_kemudahan table');
            }
        }
        mysqli_commit($conn);

		$_SESSION['statusKemaskini'] = 'Dewan berjaya dikemaskini.';
		header("Location: ../dewan.php");
		exit;
    } catch (Exception $e) {
		mysqli_rollback($conn);
		$_SESSION['statusKemaskini'] = 'Ralat semasa mengemaskini dewan: ' . $e->getMessage();
		header("Location: ../dewan.php");
		exit;
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

