<?php
include '../../database/DBConnec.php';
$conn = DBConnection::getConnection();
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_aktiviti = $_POST['nama_aktiviti'] ?? '';
    $kadar_harga = $_POST['kadar_harga'] ?? 0.00;
    $penerangan_kemudahan = $_POST['penerangan_kemudahan'] ?? '';
    $penerangan = $_POST['penerangan'] ?? '';
    $status_aktiviti= $_POST['status_aktiviti'] ?? '';

    // Validate status
    $validStatus = ['tersedia', 'tidak tersedia'];
    if (!in_array($status_aktiviti, $validStatus)) {
        echo "Status bilik tidak sah. Pilih 'tersedia' atau 'tidak tersedia'.";
        exit;
    }

    // Get selected kemudahan
    $selected_kemudahan = isset($_POST['kemudahan']) ? $_POST['kemudahan'] : [];

    // File upload directories
    $uploadFileDirUtama = 'assets/images/resource/';
    $uploadFileDirBanner = 'assets/images/background/';
    $uploadFileDirTambahan = 'assets/images/resource/';

    // Ensure directories exist
    if (!is_dir($uploadFileDirUtama)) mkdir($uploadFileDirUtama, 0777, true);
    if (!is_dir($uploadFileDirBanner)) mkdir($uploadFileDirBanner, 0777, true);
    if (!is_dir($uploadFileDirTambahan)) mkdir($uploadFileDirTambahan, 0777, true);

    // File upload functions
    function handleFileUpload($fileInputName, $uploadFileDir) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$fileInputName]['tmp_name'];
            $fileName = time() . '_' . basename($_FILES[$fileInputName]['name']);
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                return $fileName;
            } else {
                echo "Terdapat ralat mengalihkan fail " . htmlspecialchars($_FILES[$fileInputName]['name']) . "<br>";
                return null;
            }
        } else {
            return null;
        }
    }

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
			echo "Input fail tidak berstruktur seperti yang dijangkakan atau tiada fail dipilih.";
		}
		return $uploadedFiles;
	}


    // Process file uploads
    $fileUtama = handleFileUpload('fileinputUtama', $uploadFileDirUtama);
    $fileBanner = handleFileUpload('fileinputBanner', $uploadFileDirBanner);
	$fileTambahan = handleMultipleFileUpload('fileinputTambahan', $uploadFileDirTambahan);

    // Insert into aktiviti table
	
    $stmt = $conn->prepare("INSERT INTO aktiviti (nama_aktiviti, kadar_harga, penerangan_kemudahan, penerangan, status_aktiviti) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $nama_aktiviti, $kadar_harga, $penerangan_kemudahan, $penerangan, $status_aktiviti);



    if ($stmt->execute()) {
        // Get the last inserted id_aktiviti
        $id_aktiviti= $stmt->insert_id;
			$_SESSION['statusTambah'] = 'Aktiviti berjaya ditambah.';

        // Insert images into id_aktiviti table
        $picStmt = $conn->prepare("INSERT INTO aktiviti_pic (jenis_gambar, url_gambar, id_aktiviti) VALUES (?, ?, ?)");
        if ($fileUtama) {
            $jenis_gambar = 'Utama';
            $url_gambar = $uploadFileDirUtama . $fileUtama;
            $picStmt->bind_param("ssi", $jenis_gambar, $url_gambar, $id_aktiviti);
            $picStmt->execute();
        }
        if ($fileBanner) {
            $jenis_gambar = 'Banner';
            $url_gambar = $uploadFileDirBanner . $fileBanner;
            $picStmt->bind_param("ssi", $jenis_gambar, $url_gambar, $id_aktiviti);
            $picStmt->execute();
        }
        if (!empty($fileTambahanList)) {
            foreach ($fileTambahanList as $fileName) {
                $jenis_gambar = 'Tambahan';
                $url_gambar = $uploadFileDirTambahan . $fileName;
                $picStmt->bind_param("ssi", $jenis_gambar, $url_gambar, $id_aktiviti);
                $picStmt->execute();
            }
        }
        $picStmt->close();
		
		if (!empty($selected_kemudahan)) {
            $kemudahanStmt = $conn->prepare("INSERT INTO aktiviti_kemudahan (id_aktiviti, id_kemudahan) VALUES (?, ?)");
            foreach ($selected_kemudahan as $id_kemudahan) {
                $kemudahanStmt->bind_param("ii", $id_aktiviti, $id_kemudahan);
                $kemudahanStmt->execute();
            }
            $kemudahanStmt->close();
        }

        if (!empty($fileTambahan)) {
			$picStmt = $conn->prepare("INSERT INTO aktiviti_pic (jenis_gambar, url_gambar, id_aktiviti) VALUES (?, ?, ?)");
			foreach ($fileTambahan as $fileName) {
				$jenis_gambar = 'Tambahan';
				$url_gambar = $uploadFileDirTambahan . $fileName;
				$picStmt->bind_param("ssi", $jenis_gambar, $url_gambar, $id_aktiviti);
				$picStmt->execute();
			}
			$picStmt->close();
		}

        // Redirect to aktiviti.php after successful insertion
        header("Location: ../aktiviti.php");
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