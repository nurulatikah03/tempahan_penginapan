<?php
session_start();
include '../../database/DBConnec.php';
$conn = DBConnection::getConnection();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['process']) && $_POST['process'] === 'deleteAktiviti') {
    $id_aktiviti = isset($_POST['id_aktiviti']) ? intval($_POST['id_aktiviti']) : 0;

    if ($id_aktiviti > 0) {

        mysqli_begin_transaction($conn);

        try {
        
            $get_images_query = "SELECT url_gambar FROM aktiviti_pic WHERE id_aktiviti = ?";
            $stmt_get_images = $conn->prepare($get_images_query);
            $stmt_get_images->bind_param("i", $id_aktiviti);
            $stmt_get_images->execute();
            $result = $stmt_get_images->get_result();
            
            
            $delete_kemudahan_query = "DELETE FROM aktiviti_kemudahan WHERE id_aktiviti = ?";
            $stmt_kemudahan = $conn->prepare($delete_kemudahan_query);
            $stmt_kemudahan->bind_param("i", $id_aktiviti);
            if (!$stmt_kemudahan->execute()) {
                throw new Exception('Failed to delete kemudahan records.');
            }
            $stmt_kemudahan->close();

            
            $delete_gambar_query = "DELETE FROM aktiviti_pic WHERE id_aktiviti = ?";
            $stmt_gambar = $conn->prepare($delete_gambar_query);
            $stmt_gambar->bind_param("i", $id_aktiviti);
            if (!$stmt_gambar->execute()) {
                throw new Exception('Failed to delete gambar records.');
            }

            
            while ($row = $result->fetch_assoc()) {
                $file_path = '' . $row['url_gambar'];  
                if (file_exists($file_path)) {
                    unlink($file_path);  
                }
            }

            $stmt_gambar->close();

            $sql = "DELETE FROM aktiviti WHERE id_aktiviti = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_aktiviti);
            if ($stmt->execute()) {
                $_SESSION['statusDelete'] = 'Aktiviti berjaya dipadam.';
            } else {
                throw new Exception('Failed to delete aktiviti record.');
            }
            $stmt->close();

            mysqli_commit($conn);

        } catch (Exception $e) {
            mysqli_rollback($conn);
            $_SESSION['statusDelete'] = 'Ralat: ' . $e->getMessage();
        }

    } else {
        $_SESSION['statusDelete'] = 'ID aktiviti tidak sah.';
    }

    header('Location: ../aktiviti.php');
    exit();
} else {
    $_SESSION['statusDelete'] = 'Permintaan tidak sah.';
    header('Location: ../aktiviti.php');
    exit();
}

$conn->close();
?>

