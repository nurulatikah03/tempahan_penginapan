<?php
session_start();
include_once '../../Models/pekejPerkahwinan.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['process'] == 'tambah_pekej') {
        $nama_pekej = $_POST['nama_Pekej'];
        $id_dewan = $_POST['id_dewan'];
        $kadar_harga = $_POST['kadar_harga'];
        $penerangan_pendek = $_POST['penerangan_pendek'];
        $penerangan_panjang = $_POST['penerangan_panjang'];
        $gambar_pekej_main = $_FILES['fileinput']['name'];
        $gambar_pekej_main_temp = $_FILES['fileinput']['tmp_name'];

        if ($kadar_harga < 1) {
            $_SESSION['error'] = "Kadar harga tidak boleh kurang daripada 1.";
            echo "<script>window.history.back();</script>";
        } else {
            $target_dir = '../../assets/images/resource/';
            $target_dir_database = 'assets/images/resource/' . basename($gambar_pekej_main);
            $target_file = $target_dir . basename($gambar_pekej_main);

            if (move_uploaded_file($gambar_pekej_main_temp, $target_file)) {
                PekejPerkahwinan::addPekejPerkahwinan($id_dewan, $nama_pekej, $kadar_harga, $penerangan_pendek, $penerangan_panjang, $target_dir_database);
                $_SESSION['success'] = "Pekej Perkahwinan telah berjaya ditambah.";
                header("Location: ../perkahwinan.php");
            } else {
                $_SESSION['error'] = "Terdapat ralat semasa memuat naik gambar.";
                echo "Terdapat ralat semasa memuat naik gambar";
            }
        }
    } elseif ($_POST['process'] == 'delete_pekej') {
        $id_pekej = $_POST['id_pekej'];
        $gambar = $_POST['gambar_url'];
        $target_file = '../../' . $gambar;

        if (file_exists($target_file)) {
            unlink($target_file);
        }

        PekejPerkahwinan::deletePekejPerkahwinan($id_pekej);
        $_SESSION['success'] = "Pekej Perkahwinan telah berjaya dipadamkan.";
        header("Location: ../perkahwinan.php");
    } elseif ($_POST['process'] == 'delAddon') {
        $id_addon = $_POST['addon_id'];
        PekejPerkahwinan::deleteAddon($id_addon);
        $_SESSION['success'] = "Addon telah berjaya dipadamkan.";
        header("Location: ../perkahwinan.php");
    } elseif ($_POST['process'] == 'addAddon') {
        $nama_addon = $_POST['add_on_nama'];
        $harga_addon = $_POST['harga'];
        $id_pekej = $_POST['id_pekej'];
        PekejPerkahwinan::addAddon($nama_addon, $harga_addon);
        $_SESSION['success'] = "Addon telah berjaya ditambah.";
        header("Location: ../perkahwinan.php");
    } elseif ($_POST['process'] == 'kemaskiniAddOn') {
        $ids = isset($_POST['id_addon']) ? $_POST['id_addon'] : [];
        $names = isset($_POST['add_on_nama']) ? $_POST['add_on_nama'] : [];
        $prices = isset($_POST['harga']) ? $_POST['harga'] : [];

        if (count($ids) === count($names) && count($names) === count($prices)) {
            for ($i = 0; $i < count($ids); $i++) {
                $id_addon = $ids[$i];
                $nama_addon = $names[$i];
                $harga_addon = $prices[$i];

                if (!empty($id_addon) && !empty($nama_addon) && $harga_addon >= 0) {
                    try {
                        PekejPerkahwinan::updateAddOn($id_addon, $nama_addon, $harga_addon);
                    } catch (Exception $e) {
                        echo "Error updating add-on ID $id_addon: " . $e->getMessage();
                        exit;
                    }
                } else {
                    echo "Invalid data for add-on ID $id_addon.";
                    exit;
                }
            }

            $_SESSION['success'] = "Add on berjaya dikemaskini.";
            header("Location: ../perkahwinan.php");
            exit;
        } else {
            echo "Mismatched input arrays.";
            exit;
        }
    } elseif ($_POST['process'] == 'kemaskiniPerkahwinan') {
        $id_pekej = $_POST['id_perkahwinan'];
        $nama_pekej = $_POST['nama_Pekej'];
        $id_dewan = $_POST['id_dewan'];
        $kadar_harga = $_POST['kadar_harga'];
        $penerangan_pendek = $_POST['penerangan_pendek'];
        $penerangan_panjang = $_POST['penerangan_panjang'];
        $URL_gambar_lama = $_POST['URL_gambar_lama'];
        $gambar_pekej = $_FILES['fileinput']['name'];
        $gambar_pekej_temp = $_FILES['fileinput']['tmp_name'];
        // Check if the file is empty
        if (empty($gambar_pekej)) {
            $gambar_pekej = $URL_gambar_lama;
            PekejPerkahwinan::updatePekejPerkahwinan($id_pekej, $nama_pekej, $kadar_harga, $penerangan_pendek, $penerangan_panjang, $id_dewan, $URL_gambar_lama);
            $_SESSION['success'] = "Pekej Perkahwinan telah berjaya dikemaskini.";
            header("Location: ../perkahwinan.php");
            exit;
        } else {
            $target_dir = 'assets/images/resource/';
            $target_dir_database = dirname($URL_gambar_lama) . '/' . basename($gambar_pekej);
            $target_file = $target_dir . basename($gambar_pekej);

            if (move_uploaded_file($gambar_pekej_temp, $target_file)) {
                if (file_exists($URL_gambar_lama)) {
                    unlink($URL_gambar_lama);
                }
                PekejPerkahwinan::updatePekejPerkahwinan($id_pekej, $nama_pekej, $kadar_harga, $penerangan_panjang, $penerangan_pendek, $id_dewan, $target_file);
                $_SESSION['success'] = "Pekej Perkahwinan telah berjaya dikemaskini.";
                header("Location: ../perkahwinan.php");
                exit;
            } else {
                $_SESSION['error'] = "Terdapat ralat semasa memuat naik gambar.";
                echo "Terdapat ralat semasa memuat naik gambar";
            }
        }
    }
} else {
    echo "Kaedah permintaan tidak sah.";
}
