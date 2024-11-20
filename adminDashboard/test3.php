<?php
// test2.php
include_once '../Models/room.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>File Upload Information</h2>";

$imgType = $_POST['imgType'];
$roomId = $_POST['roomId'];

// Check if files were uploaded
if(isset($_FILES['images'])) {
    echo "<h3>Files Received:</h3>";
    
    // Loop through each uploaded file
    foreach($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['images']['name'][$key];
        $file_size = $_FILES['images']['size'][$key];
        $file_type = $_FILES['images']['type'][$key];
        $file_tmp = $_FILES['images']['tmp_name'][$key];
        
        echo "<div style='margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;'>";
        echo "<p><strong>File Name:</strong> " . htmlspecialchars($file_name) . "</p>";
        echo "<p><strong>File Size:</strong> " . number_format($file_size / 1024, 2) . " KB</p>";
        echo "<p><strong>File Type:</strong> " . htmlspecialchars($file_type) . "</p>";
        echo "<p><strong>Temporary Path:</strong> " . htmlspecialchars($file_tmp) . "</p>";
        // Define the upload directory
        $upload_dir ='../assets/images/resource/';
        
        // Check if the upload directory exists, if not, create it
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Define the path to save the uploaded file
        $file_path = $upload_dir . basename($file_name);
        $urlToAdd = 'assets/images/resource/' . basename($file_name);
        
        // Move the uploaded file to the upload directory
        if (move_uploaded_file($file_tmp, $file_path)) {
            echo "<p><strong>Uploaded to:</strong> " . htmlspecialchars($file_path) . "</p>";
            Room::addImage($roomId, $urlToAdd, $imgType);
        } else {
            echo "<p style='color: red;'><strong>Error:</strong> Failed to upload file.</p>";
        }
        echo "</div>";
    }
}

// Display all POST data
echo "<h3>POST Data:</h3>";
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Display all FILES data structure
echo "<h3>FILES Array Structure:</h3>";
echo "<pre>";
print_r($_FILES);
echo "</pre>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    line-height: 1.6;
}
pre {
    background: #f5f5f5;
    padding: 10px;
    border-radius: 5px;
    overflow-x: auto;
}
</style>