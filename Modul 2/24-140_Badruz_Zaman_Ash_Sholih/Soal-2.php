<?php
    $matkul = ["PTI", "ALPRO", "DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL"];

    foreach($matkul as $mk) {
        switch($mk) {
            case "PTI":
                echo "Saya suka $mk";
                echo "<br>";
                break;
            case "ALPRO":
                echo "Saya suka $mk";
                echo "<br>";
                break;
            case "DPW":
                echo "Saya suka $mk";
                echo "<br>";
                break;
            case "STRUKDAT":
                echo "Saya suka $mk";
                echo "<br>";
                break;
            case "JARKOM":
                echo "Saya suka $mk";
                echo "<br>";
                break;
            case "PAW":
                echo "Saya suka $mk";
                echo "<br>";
                break;
            default:
                echo "Saya tidak mengambil matkul $mk";
                echo "<br>";
                break;
        }
    }
?>