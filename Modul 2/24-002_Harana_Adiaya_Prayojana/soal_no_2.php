<!-- Foreach & switch -->
<?php
    $matkul=array("PTI","ALPRO","DPW","STRUKDAT","JARKOM","PAW","PSBF","RPL");
    foreach($matkul as $i){
        switch($i){
            case "PTI":
                echo "<br> Saya suka PTI";
                break;
            case "ALPRO":
                echo "<br> Saya suka ALPRO";
                break;
            case "DPW":
                echo "<br> Saya suka DPW";
                break;
            case "STRUKDAT":
                echo "<br> Saya suka STRUKDAT";
                break;
            case "JARKOM":
                echo "<br> Saya suka JARKOM";
                break;
            case "PAW":
                echo "<br> Saya suka PAW";
                break;
            default :
            echo "<br>Saya tidak mengambil matkul $i";
        }
    }
?>