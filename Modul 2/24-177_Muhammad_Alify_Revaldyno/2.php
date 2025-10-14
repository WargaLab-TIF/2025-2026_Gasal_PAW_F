<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    
<?php

$matkul = array("PTI","ALPRO","DPW", "STRUKDAT", "JARKOM", "PAW", "PSBF", "RPL");

foreach($matkul as $x){
    switch($x){
        case "PTI":
            echo "Saya suka $x <br>";
            break;
        case "ALPRO":
            echo "Saya suka $x <br>";
            break;
        case "DPW":
            echo "Saya suka $x <br>";
            break;
        case "STRUKDAT":
            echo "Saya suka $x <br>";
            break;
        case "JARKOM":
            echo "Saya suka $x <br>";
            break;
        case "PAW":
            echo "Saya suka $x <br>";
            break;
        default :
            echo"saya tidak mengambil matkul $x <br>";
    } 


}


?>

</body>
</html>