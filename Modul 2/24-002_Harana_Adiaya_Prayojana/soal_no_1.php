<!-- if,elseif,else & for -->
<?php
    $matkul=array("PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL");
    $praktikum=array("JARKOM","PAW");
    $totMatkul=count($matkul)-1;
    $totpraktikum=count($praktikum)-1;

    for($i=0;$i<=$totMatkul;$i++){
        if ($i==6){
            echo "<br>Saya belum mengambil matkul $matkul[$i]";
        }
        else if ($i==7){
            echo "<br>Saya belum mengambil matkul $matkul[$i]";
        }
        else if (in_array($matkul[$i],$praktikum)){
            echo "<br>Saya sedang mengambil matkul $matkul[$i] termasuk praktikumnya";
        }
        else{
            echo "<br>Saya sudah mengambil matkul $matkul[$i] semester lalu";
        }
        
    }
?>