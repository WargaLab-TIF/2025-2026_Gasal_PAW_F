<?php
$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];

for ($i = 0; $i < 8; $i++) {   
    if ($matkul[$i] == "JARKOM" || $matkul[$i] == "PAW") {
        echo "Saya sedang mengambil matkul $matkul[$i] termasuk praktikumnya <br>";
    } elseif ($i == 6 || $i == 7) {
        echo "Saya belum mengambil matkul $matkul[$i] <br>";
    } else {
        echo "Saya sudah mengambil matkul $matkul[$i] semester lalu <br>";
    }
}
?>
