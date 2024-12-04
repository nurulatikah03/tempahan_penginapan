<?php
include '../db-connect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_dewan = $_POST['nama_dewan'] ?? '';
    $kadar_sewa = $_POST['kadar_sewa'] ?? 0.00;
    $bilangan_muatan = $_POST['bilangan_muatan'] ?? 0;
    $penerangan = $_POST['penerangan'] ?? '';
    $penerangan_ringkas = $_POST['penerangan_ringkas'] ?? '';
    $penerangan_kemudahan = $_POST['penerangan_kemudahan'] ?? '';
    $status_dewan = $_POST['status_dewan'] ?? '';
    $max_capacity = $_POST['max_capacity'] ?? 0;
    
    // Validate status
    $validStatus = ['tersedia', 'tidak_tersedia'];
    if (!in_array($status_dewan, $validStatus)) {
        echo "Status bilik tidak sah. Pilih 'tersedia' atau 'tidak tersedia'.";
        exit;
    }

    // Get selected kemudahan
    $selected_kemudahan = isset($_POST['kemudahan']) ? $_POST['kemudahan'] : [];

    // File upload directory
    $uploadFileDirUtama = 'assets/images/resource/';
    $uploadFileDirBanner = 'assets/images/background/';
    $uploadFileDirTambahan = 'assets/images/resource/';

    if (!is_dir($uploadFileDirUtama)) {
		mkdir($uploadFileDirUtama, 0777, true);
	}

	if (!is_dir($uploadFileDirBanner)) {
		mkdir($uploadFileDirBanner, 0777, true);
	}

	if (!is_dir($uploadFileDirTambahan)) {
		mkdir($uploadFileDirTambahan, 0777, true);
	}

    // Function to handle file upload
    function handleFileUploadUtama($fileInputName, $uploadFileDirUtama) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
            $fileName = time() . '_' . basename($_FILES[$fileInputName]['name']); // Unique filename
            $dest_path = $uploadFileDirUtama . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                return $fileName; // Return the uploaded file name
            } else {
                echo "Terdapat ralat mengalihkan fail " . htmlspecialchars($_FILES[$fileInputName]['name']) . "<br>";
                return null;
            }
        } else {
            return null;
        }
    }
	
	function handleFileUploadBanner($fileInputName, $uploadFileDirBanner) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
            $fileName = time() . '_' . basename($_FILES[$fileInputName]['name']); // Unique filename
            $dest_path = $uploadFileDirBanner . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                return $fileName; // Return the uploaded file name
            } else {
                echo "Terdapat ralat mengalihkan fail " . htmlspecialchars($_FILES[$fileInputName]['name']) . "<br>";
                return null;
            }
        } else {
            return null;
        }
    }
	
	function handleFileUploadTambahan($fileInputName, $uploadFileDirTambahan) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
            $fileName = time() . '_' . basename($_FILES[$fileInputName]['name']); // Unique filename
            $dest_path = $uploadFileDirTambahan . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                return $fileName; // Return the uploaded file name
            } else {
                echo "Terdapat ralat mengalihkan fail " . htmlspecialchars($_FILES[$fileInputName]['name']) . "<br>";
                return null;
            }
        } else {
            return null;
        }
    }

    // Process file uploads
    $fileUtama = handleFileUploadUtama('fileinputUtama', $uploadFileDirUtama);
    $fileBanner = handleFileUploadBanner('fileinputBanner', $uploadFileDirBanner);
    $fileTambahan = handleFileUploadTambahan('fileinputTambahan', $uploadFileDirTambahan);

    // Insert into dewan table
    $stmt = $conn->prepare("INSERT INTO dewan (nama_dewan, kadar_sewa, bilangan_muatan, penerangan, penerangan_ringkas, penerangan_kemudahan, status_dewan, max_capacity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sidssssi", $nama_dewan, $kadar_sewa, $bilangan_muatan, $penerangan, $penerangan_ringkas, $penerangan_kemudahan, $status_dewan, $max_capacity);

    if ($stmt->execute()) {
        // Get the last inserted id_dewan
        $id_dewan = $stmt->insert_id;

        // Insert images into dewan_pic table
        $picStmt = $conn->prepare("INSERT INTO dewan_pic (jenis_gambar, url_gambar, id_dewan) VALUES (?, ?, ?)");
        if ($fileUtama) {
            $jenis_gambar = 'Utama';
            $url_gambar = $uploadFileDirUtama . $fileUtama;
            $picStmt->bind_param("ssi", $jenis_gambar, $url_gambar, $id_dewan);
            $picStmt->execute();
        }
        if ($fileBanner) {
            $jenis_gambar = 'Banner';
            $url_gambar = $uploadFileDirBanner . $fileBanner;
            $picStmt->bind_param("ssi", $jenis_gambar, $url_gambar, $id_dewan);
            $picStmt->execute();
        }
        if ($fileTambahan) {
            $jenis_gambar = 'Tambahan';
            $url_gambar = $uploadFileDirTambahan . $fileTambahan;
            $picStmt->bind_param("ssi", $jenis_gambar, $url_gambar, $id_dewan);
            $picStmt->execute();
        }
        $picStmt->close();

        // Insert into dewan_kemudahan table (link selected kemudahan with dewan)
        if (!empty($selected_kemudahan)) {
            $kemudahanStmt = $conn->prepare("INSERT INTO dewan_kemudahan (id_dewan, id_kemudahan) VALUES (?, ?)");
            foreach ($selected_kemudahan as $id_kemudahan) {
                $kemudahanStmt->bind_param("ii", $id_dewan, $id_kemudahan);
                $kemudahanStmt->execute();
            }
            $kemudahanStmt->close();
        }

        // Redirect to dewan.php after successful insertion
        header("Location: ../dewan.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Kaedah permintaan tidak sah.";
}
?>
