<?php
session_start();
include '../../database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['process']) && $_POST['process'] === 'deleteDewan') {
    $id_dewan = isset($_POST['id_dewan']) ? intval($_POST['id_dewan']) : 0;

    if ($id_dewan > 0) {
        mysqli_begin_transaction($conn);

        try {
            $get_images_query = "SELECT url_gambar FROM dewan_pic WHERE id_dewan = ?";
            $stmt_get_images = $conn->prepare($get_images_query);
            $stmt_get_images->bind_param("i", $id_dewan);
            $stmt_get_images->execute();
            $result = $stmt_get_images->get_result();
            
            $delete_kemudahan_query = "DELETE FROM dewan_kemudahan WHERE id_dewan = ?";
            $stmt_kemudahan = $conn->prepare($delete_kemudahan_query);
            $stmt_kemudahan->bind_param("i", $id_dewan);
            if (!$stmt_kemudahan->execute()) {
                throw new Exception('Failed to delete kemudahan records.');
            }
            $stmt_kemudahan->close();

            $delete_gambar_query = "DELETE FROM dewan_pic WHERE id_dewan = ?";
            $stmt_gambar = $conn->prepare($delete_gambar_query);
            $stmt_gambar->bind_param("i", $id_dewan);
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

            $sql = "DELETE FROM dewan WHERE id_dewan = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_dewan);
            if ($stmt->execute()) {
                $_SESSION['statusDelete'] = 'Dewan berjaya dipadam.';
            } else {
                throw new Exception('Failed to delete dewan record.');
            }
            $stmt->close();

            mysqli_commit($conn);

        } catch (Exception $e) {
            mysqli_rollback($conn);
            $_SESSION['statusDelete'] = 'Ralat: ' . $e->getMessage();
        }

    } else {
        $_SESSION['statusDelete'] = 'ID dewan tidak sah.';
    }

    header('Location: ../dewan.php');
    exit();
} else {
    $_SESSION['statusDelete'] = 'Permintaan tidak sah.';
    header('Location: ../dewan.php');
    exit();
}

$conn->close();
?>
