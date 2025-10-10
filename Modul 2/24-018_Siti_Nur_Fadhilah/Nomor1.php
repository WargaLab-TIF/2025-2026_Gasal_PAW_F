<?php
$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
$praktikum = ["JARKOM", "PAW"];

for ($i = 0; $i < count($matkul); $i++) {
    $nama = $matkul[$i];
    if (in_array($nama, $praktikum)) {
        echo "Saya sedang mengambil matkul $nama termasuk praktikum nya <br>";
    }
    elseif ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul $nama <br>";
    }
    else {
        echo "Saya sudah mengambil matkul $nama semester lalu <br>";
    }
}

?>
