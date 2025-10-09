<?php

$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT","JARKOM", "PAW", "PSBF", "RPL"];

foreach($matkul as $M){
    switch ($M){
        case "PTI":
            echo "Saya suka $M <br>";
            break;
        case "ALPRO":
            echo "Saya suka $M <br>";
            break;
        case "DPW":
            echo "Saya suka $M <br>";
            break;
        case "STRUKDAT":
            echo "Saya suka $M <br>";
            break;
        case "JARKOM":
            echo "Saya suka $M <br>";
            break;
        case "PAW":
            echo "Saya suka $M <br>";
            break;
        default:
            echo "Saya tidak mengambil matkul $M <br>";
    }
}

?>