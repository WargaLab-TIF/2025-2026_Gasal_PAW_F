<?php
    $matkul = ["PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL"];

    foreach ($matkul as $i) {
        switch ($i) {
            case "PTI" :
                echo "Saya suka $i <br>";
                break;
            case "ALPRO":
                echo "Saya suka $i<br>";
                break;
            case "DPW" :
                echo "Saya suka $i <br>";
                break;
            case "STRUKDAT" :
                echo "Saya suka $i <br>";
                break;
            case "JARKOM" :
                echo "Saya suka $i <br>";
                break;
            case "PAW" :
                echo "Saya suka $i <br>";
                break;
            default :
                echo "Saya tidak mengambil $i <br>";
                break;
        }
    }
?>