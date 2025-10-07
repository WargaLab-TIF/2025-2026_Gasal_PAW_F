<?php
$matkul = array("PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL");
foreach($matkul as $m){
    switch($m){
        case "PTI":
            echo "Saya Suka ". $m;
            echo "<br>";
            break;
        case "ALPRO":
            echo "Saya Suka ". $m;
            echo "<br>";
            break;
        case "DPW":
            echo "Saya Suka ". $m;
            echo "<br>";
            break;
        case "STRUKDAT":
            echo "Saya Suka ". $m;
            echo "<br>";
            break;
        case "JARKOM":
            echo "Saya Suka ". $m;
            echo "<br>";
            break;
        case "PAW":
            echo "Saya Suka ". $m;
            echo "<br>";
            break;
        default:
            echo "Saya Tidak Mengambil Matkul ". $m;
            echo "<br>";
            break;
    }
}
?>