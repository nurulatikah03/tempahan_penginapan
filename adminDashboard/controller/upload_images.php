<?php
include '../../database/DBConnec.php';
session_start();

$conn = DBConnection::getConnection();
$response = ['success' => true, 'errors' => []];

// Dapatkan `id_dewan` dari URL
if (isset($_GET['id_dewan']) && is_numeric($_GET['id_dewan'])) {
    $id_dewan = intval($_GET['id_dewan']); // Sanitasi input

    // Fungsi untuk memuat naik fail
    function handleMultipleFileUpload($fileInputName, $uploadFileDir) {
        $uploadedFiles = [];
        if (isset($_FILES[$fileInputName]) && is_array($_FILES[$fileInputName]['name'])) {
            $fileCount = count($_FILES[$fileInputName]['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                if ($_FILES[$fileInputName]['error'][$i] == UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES[$fileInputName]['tmp_name'][$i];
                    $fileName = time() . '_' . $i . '_' . basename($_FILES[$fileInputName]['name'][$i]);
                    $dest_path = $uploadFileDir . $fileName;

                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $uploadedFiles[] = $fileName;
                    } else {
                        echo "Terdapat ralat mengalihkan fail " . htmlspecialchars($_FILES[$fileInputName]['name'][$i]) . "<br>";
                    }
                }
            }
        } else {
            echo "File input is not structured as expected or no files selected.";
        }
        return $uploadedFiles;
    }

    // Memuat naik gambar
    if (!empty($_FILES['images']['name'][0])) {
        $targetDir = "assets/images/resource/";
        $uploadedFiles = handleMultipleFileUpload('images', $targetDir);

        // Jika tiada fail yang dimuat naik
        if (empty($uploadedFiles)) {
            $response['success'] = false;
            $_SESSION['statusTambah'] = 'Tiada fail yang berjaya dimuat naik.';
        } else {
            // Memasukkan URL gambar ke dalam database
            foreach ($uploadedFiles as $fileName) {
                $jenis_gambar = "add";
                $url_gambar = $targetDir . $fileName;

                // Simpan URL gambar dalam pangkalan data
                $stmt = $conn->prepare("INSERT INTO url_gambar (jenis_gambar, url_gambar, id_dewan) VALUES (?, ?, ?)");
                $stmt->bind_param("ssi", $jenis_gambar, $url_gambar, $id_dewan);

                if (!$stmt->execute()) {
                    $response['success'] = false;
                    $response['errors'][] = "Gagal menyimpan $fileName ke dalam pangkalan data.";
                }
                $stmt->close();
            }

            if ($response['success']) {
                $_SESSION['statusTambah'] = 'Gambar berjaya ditambah.';
            } else {
                $_SESSION['statusTambah'] = 'Sebahagian gambar gagal disimpan ke dalam pangkalan data.';
            }
        }
    } else {
        $response['success'] = false;
        $_SESSION['statusTambah'] = 'Tiada fail dipilih.';
    }
} else {
    $response['success'] = false;
    $_SESSION['statusTambah'] = 'Parameter `id_dewan` tidak sah atau tidak wujud.';
}

// Output response as JSON
echo json_encode($response);
$conn->close();
