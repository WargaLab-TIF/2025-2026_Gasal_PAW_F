<?php
$matkul = ['PTI', 'ALPRO', 'DPW', 'STRUKDAT', 'JARKOM', 'PAW', 'PSBF', 'RPL'];

foreach ($matkul as $x) {
    switch($x){
        case "PTI":
            echo ("Saya suka $x <br>");
            break;
        case "ALPRO":
            echo ("Saya suka $x <br>");
            break;
        case "DPW":
            echo ("Saya suka $x <br>");
            break;
        case "STRUKDAT":
            echo ("Saya suka $x <br>");
            break;
        case "JARKOM":
            echo ("Saya suka $x <br>");
            break;
        case "PAW":
            echo ("Saya suka $x <br>");
            break;
        default:
            echo ("Saya tidak mengambil matkul $x <br>");    
    }
}
?>