<?php
    $matkul = ["PTI", "Alpro", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
    $praktikum = ["JARKOM", "PAW"];
 
    for($i = 0; $i < 8; $i++) {
        $ValPraktikum = false;
        for($j = 0; $j < 2; $j++) {
            if($matkul[$i] == $praktikum[$j]) {
                $ValPraktikum = true;
            }
        }

        if($ValPraktikum == true) {
            echo "Saya sedang mengambil matkul $matkul[$i] termasuk praktikumnya";
            echo "<br>";
        } elseif ($i == 6 || $i == 7) {
            echo "Saya belum mengambil matkul $matkul[$i]";
            echo "<br>";
        } else {
            echo "Saya sudah mengambil matkul $matkul[$i] semester lalu";
            echo "<br>";
        }
    }
?>