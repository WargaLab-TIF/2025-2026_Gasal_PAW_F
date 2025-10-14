<?php
$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];
foreach ($matkul as $mt) {
    switch ($mt) {
        case "PTI":
            echo "saya suka $mt<br>";
            break;
        case "ALPRO": 
            echo "saya suka $mt<br>";
            break;
        case "DPW": 
            echo "saya suka $mt<br>";
            break;
        case "STRUKDAT": 
            echo "saya suka $mt<br>";
            break;
        case "JARKOM": 
            echo "saya suka $mt<br>";
            break;
        case "PAW": 
            echo "saya suka $mt<br>";
            break;
        default:
            echo "saya belum mengambil $mt<br>";
    }
}

?>