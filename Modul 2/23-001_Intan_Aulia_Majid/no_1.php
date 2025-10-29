<?php
$matkul=["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];
$praktikum=["JARKOM","PAW"];

for($i = 0 ; $i <=7 ; $i++){
    if($matkul[$i] == $praktikum[0] || $matkul[$i] == $praktikum[1]){
        echo "saya sedang mengambil matkul $matkul[$i] termasuk praktikum nya <br>";
    }elseif($i == 6 || $i == 7){
        echo "saya belum mengambil matkul ".  $matkul[$i] . "<br>";
    }else {
        echo "saya sudah mengambil matkul " . $matkul[$i] . " semester lalu <br>";
    }
}
?>