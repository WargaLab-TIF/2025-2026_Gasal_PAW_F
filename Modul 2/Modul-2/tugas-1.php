<?php
    $matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
    $praktikum = ["JARKOM", "PAW"];

    for($i=0; $i < count($matkul); $i++) {
        if ($i==6 or $i==7){
            echo "saya belum mengambil matkul ".$matkul[$i]."<br>";
        }
        elseif(in_array($matkul[$i],$praktikum)){
            echo "saya sedang mengambil matkul ".$matkul[$i]." termasuk praktikumya <br>";
        }
        else{
            echo "saya sudah mengambil $matkul[$i] semester lalu <br>";
        }
    }