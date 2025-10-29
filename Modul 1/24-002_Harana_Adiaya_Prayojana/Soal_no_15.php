<?php
function familyName($fname,$year){
    echo $fname." born in ".$year;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Soal no 15</title>
</head>
<body>
    <p><?php familyName("Hege",1975); ?></p>
    <p><?php familyName("Stale",1978); ?></p>
    <p><?php familyName("Kai Jim",1983); ?></p>
</body>
</html>