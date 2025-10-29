<?php
    $matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT", 
    "JARKOM", "PAW", "PSBF", "RPL");
    $praktikum = array("JARKOM", "PAW");

    for ($i = 0; $i < 8; $i++) {
        $nama = $matkul[$i];

        if ($nama == "JARKOM" || $nama == "PAW") {
            echo "Saya sedang mengambil matkul $nama termasuk praktikumnya <br>";

        } elseif ($i == 6 || $i == 7) {
            echo "Saya belum mengambil matkul $nama <br>";

        } else {
            echo "Saya sudah mengambil matkul $nama semester lalu <br>";
        }
    }
?>