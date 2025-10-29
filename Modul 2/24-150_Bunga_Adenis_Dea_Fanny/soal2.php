<?php

$matkul= array("PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL");

foreach($matkul as $b){
    switch($b){
        case "PTI":
            echo "Saya suka PTI<br>";
            break;
        case "ALPRO":
            echo "Saya suka ALPRO<br>";
            break;
        case "DPW":
            echo "Saya suka DPW<br>";
            break;
        case "STRUKDAT":
            echo "Saya suka STRUKDAT<br>";
            break;
        case "JARKOM":
            echo "Saya suka JARKOM<br>";
            break;
        case "PAW":
            echo "Saya suka PAW<br>";
            break;
        default:
            echo "saya tidak mengambil matkul $b<br>";
    }
} 

?>