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

    // Get unavailable dates if provided
    $mula_tidak_tersedia = isset($_POST['mula_tidak_tersedia']) ? $_POST['mula_tidak_tersedia'] : null;
    $tamat_tidak_tersedia = isset($_POST['tamat_tidak_tersedia']) ? $_POST['tamat_tidak_tersedia'] : null;

    if (isset($_POST['kemudahan'])) {
        $selected_kemudahan = $_POST['kemudahan'];
    } else {
        $selected_kemudahan = [];
    }

    mysqli_begin_transaction($conn);

    try {
        // Update dewan details
        $query = "UPDATE dewan 
                  SET nama_dewan = '$nama_dewan',
                      kadar_sewa = $kadar_sewa,
                      bilangan_muatan = $bilangan_muatan,
                      penerangan = '$penerangan',
                      penerangan_ringkas = '$penerangan_ringkas',
                      penerangan_kemudahan = '$penerangan_kemudahan',
                      max_capacity = $max_capacity,
                      status_dewan = '$status_dewan'
                  WHERE id_dewan = $id_dewan";

        if (!mysqli_query($conn, $query)) {
            throw new Exception('Failed to update dewan table');
        }

        // Update unavailable dates if status is "tidak tersedia"
        if ($status_dewan === 'tidak tersedia') {
            if ($mula_tidak_tersedia && $tamat_tidak_tersedia) {
                $start_datetime = mysqli_real_escape_string($conn, $mula_tidak_tersedia);
                $end_datetime = mysqli_real_escape_string($conn, $tamat_tidak_tersedia);

                // Check if an entry for the hall already exists
                $check_query = "SELECT * FROM dewan WHERE id_dewan = $id_dewan";
                $result = mysqli_query($conn, $check_query);

                if (mysqli_num_rows($result) > 0) {
                    // Update existing entry
                    $update_unavailable_query = "
                        UPDATE dewan
                        SET mula_tidak_tersedia = '$start_datetime', tamat_tidak_tersedia = '$end_datetime'
                        WHERE id_dewan = $id_dewan";
                    if (!mysqli_query($conn, $update_unavailable_query)) {
                        throw new Exception('Failed to update unavailable dates');
                    }
                } else {
                    // Insert new entry
                    $insert_unavailable_query = "
                        INSERT INTO dewan (id_dewan, mula_tidak_tersedia, tamat_tidak_tersedia)
                        VALUES ($id_dewan, '$start_datetime', '$end_datetime')";
                    if (!mysqli_query($conn, $insert_unavailable_query)) {
                        throw new Exception('Failed to insert unavailable dates');
                    }
                }
            } else {
                throw new Exception('Unavailable start and end dates are required for non-available status');
            }
        } else {
			// If status is not "tidak tersedia", set unavailable dates to NULL
			$delete_unavailable_query = "UPDATE dewan
										 SET mula_tidak_tersedia = NULL, tamat_tidak_tersedia = NULL
										 WHERE id_dewan = $id_dewan";
			if (!mysqli_query($conn, $delete_unavailable_query)) {
				throw new Exception('Failed to reset unavailable dates for dewan');
			}
		}

        // Update facilities
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
