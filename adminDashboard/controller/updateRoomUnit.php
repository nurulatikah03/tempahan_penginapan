<?php
session_start();

include('../../Models/room.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['csrf_token']) && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if ($_POST['process'] == 'updateRoomUnit') {

        $UB_ids = is_array($_POST['UB_id']) ? $_POST['UB_id'] : [htmlspecialchars($_POST['UB_id'], ENT_QUOTES, 'UTF-8')];
        $nameBiliks = is_array($_POST['nombor_bilik']) ? $_POST['nombor_bilik'] : [htmlspecialchars($_POST['nombor_bilik'], ENT_QUOTES, 'UTF-8')];
        $arass = is_array($_POST['aras']) ? $_POST['aras'] : [htmlspecialchars($_POST['aras'], ENT_QUOTES, 'UTF-8')];
        $statuses = is_array($_POST['status']) ? $_POST['status'] : [htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8')];
        $tarikhMulaAktifs = is_array($_POST['tarikh_aktif_semula']) ?
            array_map(function ($date) {
                return empty($date) ? 'NULL' : htmlspecialchars($date, ENT_QUOTES, 'UTF-8');
            }, $_POST['tarikh_aktif_semula']) : (empty($_POST['tarikh_aktif_semula']) ? ['NULL'] : [htmlspecialchars($_POST['tarikh_aktif_semula'], ENT_QUOTES, 'UTF-8')]);

        foreach ($UB_ids as $index => $UB_id) {
            $unitName = $nameBiliks[$index] ?? '';
            $aras = $arass[$index] ?? '';
            $status = $statuses[$index] ?? '';
            $tarikh_aktif_semula = $tarikhMulaAktifs[$index] ?? '';

            if (!empty($UB_id) && !empty($unitName) && !empty($aras) && !empty($status)) {
                Room::updateRoomUnit($UB_id, $unitName, $aras, $status, $tarikh_aktif_semula);
            }
        }
        $_SESSION['status'] = 'Berjaya mengemaskini semua maklumat Unit bilik.';
        header("Location: ../penginapan.php");
        exit;
    }
    elseif ($_POST['process'] == 'delRoom') {
        $room_id = htmlspecialchars($_POST['roomId'], ENT_QUOTES, 'UTF-8');
        $ubid = htmlspecialchars($_POST['UB_idDel'], ENT_QUOTES, 'UTF-8');
        Room::delRoomUnitById($ubid);
        $_SESSION['status'] = 'Berjaya memadam Unit bilik.';
        header("Location: ../kemaskini_penginapan.php?penginapan_id=" . $room_id);
    }
}

else {
    echo 'Invalid process or no csrf token';
}