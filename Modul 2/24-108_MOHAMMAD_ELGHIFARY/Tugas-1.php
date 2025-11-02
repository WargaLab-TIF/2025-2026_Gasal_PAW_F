<?php
    $matkul=array("PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL");
    $praktikum=array("JARKOM","PAW");
    for($i=0;$i<=7;$i++){
        if($matkul[$i]==$praktikum[0] || $matkul[$i]==$praktikum[1] ){
            echo "Saya sedang mengambil matkul $matkul[$i] termasuk praktikumnya<br>";
        }elseif ($i==6 || $i==7){
            echo "Saya belum mengambil matkul $matkul[$i]<br>";
        }else{
            echo "Saya sudah mengambil matkul $matkul[$i] semester lalu<br>";
        }
    }
?>