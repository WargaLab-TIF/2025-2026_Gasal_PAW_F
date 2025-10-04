<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modul 2</title>
</head>
<body>
    <?php
    $matkul = ['PTI', 'ALPRO', 'DPW', 'STRUKDAT', 'JARKOM', 'PAW', 'PSBF', 'RPL'];
    foreach ($matkul as $i){
        switch($i){
            case ('PTI'):
                echo "Saya suka PTI <br>";
                break;
            case ('ALPRO'):
                echo "Saya suka ALPRO <br>";
                break;
            case ('DPW'):
                echo "Saya suka DPW <br>";
                break;
            case ('STRUKDAT'):
                echo "Saya suka STRUKDAT <br>";
                break;
            case ('JARKOM'):
                echo "Saya suka JARKOM <br>";
                break;
            case ('PAW'):
                echo "Saya suka PAW <br>";
                break;
            default:
                echo "Saya tidak mengambil matkul $i <br>";
                break;
        }
    }
    ?>
</body>
</html>
