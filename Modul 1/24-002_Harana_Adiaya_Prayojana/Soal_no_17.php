<?php
function sum($x,$y){
    $z=$x + $y;
    echo $x." + ".$y." = ".$z;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Soal no 17</title>
</head>
<body>
    <p><?php sum(5,10); ?></p>
    <p><?php sum(7,13); ?></p>
    <p><?php sum(2,4); ?></p>
</body>
</html>