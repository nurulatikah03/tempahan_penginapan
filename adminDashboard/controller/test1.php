<?php

$nomborUnitBilik = $_POST['nomborUnitBilik'];
$aras_bilik = $_POST['aras'];
echo "Nombor Unit Bilik: ";
print_r($nomborUnitBilik);
echo "<br>Aras Bilik: ";
print_r($aras_bilik);

// foreach ($nomborUnitBilik as $index => $unit) {
//     $aras = isset($aras_bilik[$index]) ? intval($aras_bilik[$index]) : 0;
//     Room::addRoomUnit($roomId, $unit, $aras);
// }
