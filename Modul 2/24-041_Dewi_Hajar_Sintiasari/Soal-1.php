<?php
$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL");
$praktikum = array("JARKOM", "PAW");

for ($i = 0; $i <= 7; $i++){
    $mk = $matkul[$i];
    if ($mk == "JARKOM" || $mk == "PAW") {
        echo "Saya sedang mengambil matkul $mk termasuk praktikumnya <br>";
    } elseif ($i == 6 || $i == 7 ) {
        echo "Saya belum mengambil matkul $mk <br> ";
    } else {
        echo "Saya sudah mengambil matkul $mk semester lalu <br>";
    }
}
?>