<?php
$matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];

foreach ($matkul as $MataKuliah) {
    switch ($MataKuliah) {
        case "PTI":
            echo "Saya suka $MataKuliah <br>";
            break;
        case "ALPRO":
            echo "Saya suka $MataKuliah <br>";
            break;
        case "DPW":
            echo "Saya suka $MataKuliah <br>";
            break;
        case "STRUKDAT":
            echo "Saya suka $MataKuliah <br>";
            break;
        case "JARKOM":
            echo "Saya suka $MataKuliah <br>";
            break;
        case "PAW":
            echo "Saya suka $MataKuliah <br>";
            break;
        default:
            echo "Saya tidak mengambil matkul $MataKuliah <br>";
    }
}
?>
