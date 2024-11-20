<?php
include_once '../../Models\room.php';
if (isset($_FILES['file'])) {
    foreach ($_FILES['file'] as $key => $value) {
        echo $key . ': ' . $value . '<br>';
    }
    echo ($_POST['URLgambarLama'] . '<br>');
} else {
    echo 'No file uploaded.';
    exit;
}

$URLgambarLama = $_POST['URLgambarLama'];
$roomID = $_POST['roomId'];
$pathInfo = pathinfo($URLgambarLama);
$filepath = $pathInfo['dirname']; 
$filename = $_FILES['file']['name'];
$newFilename = $filepath . '/' . $filename;
$imgType = $_POST['imgType'];

if (!empty($_FILES['file']['name'])) {
    $targetDir = "../../" . $filepath . "/";
    $targetFilePath = $targetDir . $filename;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array(strtolower($fileType), $allowedTypes)) {
        // Move uploaded file to server
        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            // Assign the file name to the variable to be saved in the database
            Room::updateImageByType($roomID, $newFilename, $imgType);
            echo "File uploaded successfully at " . $targetFilePath;
        } else {
            // Error handling if the image upload fails
            echo "Error uploading file.";
            exit;
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
        exit;
    }
} else {
    echo "No file selected.";
    exit;
}