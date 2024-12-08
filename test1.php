<?php
// test1.php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Form Submission Details</h2>";

// Display date and capacity
echo "<div class='details-section'>";
echo "<h3>Basic Details:</h3>";
echo "<p><strong>Tarikh Kenduri:</strong> " . htmlspecialchars($_POST['tarikh_kenduri']) . "</p>";
echo "<p><strong>Jumlah Pax:</strong> " . htmlspecialchars($_POST['kapasiti']) . "</p>";
echo "</div>";

// Display selected add-ons with quantities
if (isset($_POST['addon']) && is_array($_POST['addon'])) {
    echo "<div class='details-section'>";
    echo "<h3>Selected Add-ons:</h3>";
    foreach ($_POST['addon'] as $addonId) {
        echo "<div class='addon-item'>";
        // Get quantity if exists
        $quantity = isset($_POST['quantity_' . $addonId]) ? $_POST['quantity_' . $addonId] : 1;
        echo "<p><strong>Add-on name:</strong> " . htmlspecialchars($addonId) . 
             " <br><strong>Quantity:</strong> " . htmlspecialchars($quantity) . "</p>";
        echo "</div>";
    }
    echo "</div>";
}

// Display raw POST data for debugging
echo "<div class='details-section'>";
echo "<h3>Raw Form Data:</h3>";
echo "<pre>";
print_r($_POST);
echo "</pre>";
echo "</div>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    line-height: 1.6;
}

.details-section {
    margin-bottom: 30px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

h2, h3 {
    color: #333;
}

pre {
    background: #f5f5f5;
    padding: 10px;
    border-radius: 5px;
    overflow-x: auto;
}

.addon-item {
    margin-bottom: 10px;
    padding: 10px;
    background: #f9f9f9;
    border-radius: 3px;
}
</style>