<?php
$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL");
$Praktikum = array("JARKOM", "PAW");
for ($i = 0; $i < count($matkul); $i++) {
    if (in_array($matkul[$i], $Praktikum)) {
        echo "Saya sedang mengambil matkul " . $matkul[$i] . " termasuk praktikumnya";
        echo "<br>";
    }elseif($matkul[$i] == $matkul[6]){
        echo "saya belum mengambil matkul " . $matkul[6];
        echo "<br>";
    }elseif($matkul[$i] == $matkul[7]){
        echo "saya belum mengambil matkul " . $matkul[7];
        echo "<br>";
    }else{
        echo "Saya sudah mengambil matkul " . $matkul[$i] . " semester lalu";
        echo "<br>";
    }
}
?>