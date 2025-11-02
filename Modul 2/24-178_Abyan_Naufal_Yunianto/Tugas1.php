<?php
    $matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
    $praktikum = ["JARKOM","PAW"];
    
    for ($i = 0; $i < count($matkul) ; $i++) {
        $nama_matkul = $matkul[$i];
        $cek_praktikum = false;
        
        for ($j = 0; $j < count($praktikum) ; $j++) {
            if($nama_matkul == $praktikum[$j]) {
                $cek_praktikum = true;
                break;
            }
        }

        if ($cek_praktikum) {
            echo "Saya sedang mengambil matkul $nama_matkul termasuk praktikumnya<br>";
        } else if ($i == 6 || $i == 7 ) {
            echo "Saya belum mengambil matkul $nama_matkul<br>";
        } else {
            echo "Saya sudah mengambil matkul $nama_matkul semester lalu<br>";
        }
    }
?>