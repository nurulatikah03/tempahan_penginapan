<?php 
    session_start();
    include 'database/database.php';
    include 'controller/functions.php';
    $tarikh_tempahan = date("Y-m-d"); 
    $_SESSION['booking_number'] = generateBookingNumber($conn);
    $tarikhMasukSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkInDate"])->format('Y-m-d');
    $tarikhKeluarSQL = DateTime::createFromFormat('d/m/Y', $_SESSION["checkOutDate"])->format('Y-m-d');
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {

            $sql = "INSERT INTO `tempahan` (nombor_tempahan, nama_penuh, numbor_fon, email, tarikh_tempahan, tarikh_daftar_masuk, tarikh_daftar_keluar, harga_keseluruhan, id_bilik) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Error preparing statement: " . $conn->error);
            }

            $stmt->bind_param("sssssssdi", 

            $_SESSION['booking_number'],
            $_SESSION['cust_name'], 
            $_SESSION['phone_number'], 
            $_SESSION['form-email'], 
            $tarikh_tempahan, 
            $tarikhMasukSQL, 
            $tarikhKeluarSQL, 
            $_SESSION['total_price'], 
            $_SESSION['room_id']);
        
        if ($stmt->execute()) {
            // Successful execution
        } else {
            echo "Error executing statement: " . $stmt->error;
            header("Location: room_details.php"); 
            exit; // Terminate script execution to prevent further errors
        }
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Close statement and connection
            if ($stmt) {
                $stmt->close();
            }
            if ($conn) {
                $conn->close();
            }
        }
        header("Location: success.php"); 
        exit();
}
?>