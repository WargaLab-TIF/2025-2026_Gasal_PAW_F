<?php
$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
$praktikum = ["JARKOM", "PAW"];
for ($i = 0; $i < count($matkul); $i++) {
    $mat = $matkul[$i];
    if ($i === 6 || $i === 7) {
        echo "Saya belum mengambil matkul $mat" . "<br>"; 
    } elseif (in_array($mat, $praktikum)) {
        echo "Saya sedang mengambil matkul $mat termasuk praktikumnya" . "<br>";
    } else {
        echo "Saya sudah mengambil matkul $mat semester lalu" . "<br>";
    }
}
?>