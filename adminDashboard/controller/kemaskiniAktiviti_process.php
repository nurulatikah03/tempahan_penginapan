<?php
include '../../database/DBConnec.php';
$conn = DBConnection::getConnection();
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $id_aktiviti = mysqli_real_escape_string($conn, $_POST['id_aktiviti']);
    $nama_aktiviti = mysqli_real_escape_string($conn, $_POST['nama_aktiviti']);
    $kadar_harga = (float) $_POST['kadar_harga'];
    $penerangan_kemudahan = mysqli_real_escape_string($conn, $_POST['penerangan_kemudahan']);
    $penerangan = mysqli_real_escape_string($conn, $_POST['penerangan']);
    $status_aktiviti = mysqli_real_escape_string($conn, $_POST['status_aktiviti']);


    if (isset($_POST['kemudahan'])) {
        $selected_kemudahan = $_POST['kemudahan']; 
    } else {
        $selected_kemudahan = [];
    }

    mysqli_begin_transaction($conn);

    try {
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

        $delete_query = "DELETE FROM aktiviti_kemudahan WHERE id_aktiviti = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param('s', $id_aktiviti);
        
        if (!$delete_stmt->execute()) {
            throw new Exception('Failed to delete existing kemudahan for aktiviti');
        }

        $insert_query = "INSERT INTO aktiviti_kemudahan (id_aktiviti, id_kemudahan) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_query);

        foreach ($selected_kemudahan as $kemudahan_id) {
            $kemudahan_id = (int) $kemudahan_id; // Ensure it's an integer
            $insert_stmt->bind_param('si', $id_aktiviti, $kemudahan_id);
            if (!$insert_stmt->execute()) {
                throw new Exception('Failed to insert kemudahan into aktiviti_kemudahan table');
            }
        }

        mysqli_commit($conn);

        $_SESSION['statusKemaskini'] = 'Aktiviti berjaya dikemaskini.';
        header("Location: ../aktiviti.php");
        exit;
        
    } catch (Exception $e) {
        mysqli_rollback($conn);

        $_SESSION['statusKemaskini'] = 'Ralat semasa mengemaskini aktiviti: ' . $e->getMessage();
        header("Location: ../aktiviti.php");
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
