<?php
session_start();
include '../../database/DBConnec.php';
$conn = DBConnection::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['process']) && $_POST['process'] === 'deleteDewan') {
    $id_dewan = isset($_POST['id_dewan']) ? intval($_POST['id_dewan']) : 0;

    if ($id_dewan > 0) {
        mysqli_begin_transaction($conn);

        try {
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
