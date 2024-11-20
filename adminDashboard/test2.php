<?php
// Display the submitted form data for debugging
echo "<h1>Uploaded Image Data</h1>";
echo "<pre>";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Display submitted data
    echo "Room ID: " . htmlspecialchars($_POST['roomId']) . "\n";
    echo "Process: " . htmlspecialchars($_POST['process']) . "\n";
    echo "Image Type: " . htmlspecialchars($_POST['imgType']) . "\n";
    echo "Path: " . htmlspecialchars($_POST['path']) . "\n";
    echo "<h2>Debugging \$_FILES:</h2>";
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    // Display existing images
    echo "\nExisting Images:\n";
    if (!empty($_POST['existing_images'])) {
        print_r($_POST['existing_images']);
    } else {
        echo "No existing images provided.\n";
    }

    // Display uploaded image files
    echo "\nUploaded Files:\n";
    if (!empty($_FILES['images'])) {
        foreach ($_FILES['images']['name'] as $index => $name) {
            if (!empty($name)) {
                echo "Image at index $index:\n";
                echo "  Name: " . htmlspecialchars($name) . "\n";
                echo "  Temp Path: " . $_FILES['images']['tmp_name'][$index] . "\n";
                echo "  Size: " . $_FILES['images']['size'][$index] . " bytes\n";
                echo "  Error: " . $_FILES['images']['error'][$index] . "\n";
            }
        }
    } else {
        echo "No new images uploaded.\n";
    }

    // Display new image URLs (after upload preview)
    echo "\nNew Image URLs:\n";
    if (!empty($_POST['image_urls'])) {
        print_r($_POST['image_urls']);
    } else {
        echo "No new image URLs provided.\n";
    }
} else {
    echo "No form data submitted.\n";
}

echo "</pre>";
