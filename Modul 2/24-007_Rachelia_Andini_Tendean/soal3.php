<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modul 2</title>
</head>
<body>
    <?php
    $angka = 0;
    do{
        if ($angka % 4 == 0){
            echo ("$angka <br>");
        }
        $angka++;
    }while($angka <= 20);
    ?>
</body>
</html>
