<?php
include('../../database/DBConnec.php'); 
$conn = DBConnection::getConnection();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_dewan = $_GET['id_dewan'];
    $image_type = $_POST['image_type'];

    if ($image_type == 'main' || $image_type == 'add') {
        $upload_dir = 'assets/images/resource/';
    } elseif ($image_type == 'banner') {
        $upload_dir = 'assets/images/background/';
    }

    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
        $file_tmp = $_FILES['imageUpload']['tmp_name'];
        $file_name = $_FILES['imageUpload']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_file_name = uniqid() . '.' . $file_ext;

        if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
            $image_url = $upload_dir . $new_file_name;

            $sql_select = "SELECT url_gambar FROM url_gambar WHERE jenis_gambar = ? AND id_dewan = ?";
            $stmt_select = $conn->prepare($sql_select);
            $stmt_select->bind_param("si", $image_type, $id_dewan);
            $stmt_select->execute();
            $stmt_select->bind_result($old_image_url);
            if ($stmt_select->fetch() && file_exists($old_image_url)) {
                unlink($old_image_url);
            }
            $stmt_select->close();

            $sql = "UPDATE url_gambar SET url_gambar = ? WHERE jenis_gambar = ? AND id_dewan = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $image_url, $image_type, $id_dewan);
            if ($stmt->execute()) {
				$_SESSION['statusUpdate'] = 'Gambar berjaya dikemaskini.';
				echo "success";
            } else {
                echo "Failed to update the database.";
            }

            $stmt->close();
        } else {
            echo "Failed to upload the image.";
        }
    } else {
        echo "No file uploaded or there was an error.";
    }
    $conn->close();
}
?>
