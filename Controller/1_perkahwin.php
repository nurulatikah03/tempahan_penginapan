<?php
session_start();
include_once __DIR__ . '/../Models/pekejPerkahwinan.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pakejPenginapan.php");
    exit();
}

function validateKapasiti($kapasiti)
{
    // Assuming reasonable limits for wedding capacity
    return is_numeric($kapasiti) && $kapasiti >= 50 && $kapasiti <= 1000;
}

$quantityMejaDanAlas = $_POST['quantity_Meja_dan_alas'];
$quantityKerusi = $_POST['quantity_Kerusi'];
$quantityMejaBanquet = $_POST['quantity_Meja_Banquet'];

// Main validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    if (!checkAvailabilityWed($_POST['id_perkahwinan'], $_POST['tarikh_kenduri'])) {
        $errors[] = "Tarikh kenduri telah ditempah. Sila pilih tarikh yang lain.";
    }

    if (!validateKapasiti($_POST['kapasiti'])) {
        $errors[] = "Kapasiti mesti antara 50 hingga 1000 orang.";
    }

    if ($quantityMejaDanAlas > 15) {
        $errors[] = "Meja dan alas makanan tidak boleh melebihi 15 unit.";
    }

    if ($quantityKerusi > 50) {
        $errors[] = "Kerusi tidak boleh melebihi 50 unit.";
    }

    if ($quantityMejaBanquet > 10) {
        $errors[] = "Meja banquet tidak boleh melebihi 10 unit.";
    }

    if (!empty($errors)) {
        // Store errors in session and redirect back
        $_SESSION['booking_errors'] = $errors;
        header("Location: ../perkahwinanDetail.php?id_perkahwinan=" . $_POST['id_perkahwinan']);
        exit();
    }

    // If validation passes, proceed with booking
    $addons = [];
    if (isset($_POST['addon']) && is_array($_POST['addon'])) {
        foreach ($_POST['addon'] as $index => $addon) {
            $quantity = isset($_POST['quantity'][$index]) ? $_POST['quantity'][$index] : 1;
            $addons[] = [
                'id' => isset($_POST['addOnID_' . str_replace(' ', '_', $addon)]) ? $_POST['addOnID_' . str_replace(' ', '_', $addon)] : 0,
                'name' => $addon,
                'quantity' => isset($_POST['quantity_' . str_replace(' ', '_', $addon)]) ? $_POST['quantity_' . str_replace(' ', '_', $addon)] : 0
            ];
        }
    }


    try {
        // Store booking details in session
        $_SESSION['id_perkahwinan'] = $_POST['id_perkahwinan'];
        $_SESSION['nama_pekej'] = $_POST['nama_pekej'];
        $_SESSION['tarikh_kenduri'] = $_POST['tarikh_kenduri'];
        $_SESSION['tarikh_kenduri_end'] = $_POST['tarikh_kenduri_end'];
        $_SESSION['addons'] = $addons;
        $_SESSION['kapasiti'] = $_POST['kapasiti'];
        $_SESSION['nama_dewan'] = $_POST['nama_dewan'];
        $_SESSION['id_dewan_kahwin'] = $_POST['id_dewan'];
        $_SESSION['total_price_kahwin'] = $_POST['total_price_kahwin'];
        $_SESSION['gambar_pekej'] = $_POST['gambar_pekej'];

        header('Location: ../booking_confirmation_perkahwinan.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['booking_errors'] = ["Ralat sistem: " . $e->getMessage()];
        header("Location: ../perkahwinanDetail.php?id_perkahwinan=" . $_POST['id_perkahwinan']);
        exit();
    }
}
