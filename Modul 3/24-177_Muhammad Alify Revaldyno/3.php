<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Height</title>
</head>
<body>

<?php
$height = array(176, 165, 170);

echo "Data awal array height:<br>";
foreach ($height as $h) {
    echo $h . " cm<br>";
}

array_push($height, 180, 172, 168, 177, 169);

$lastIndex = count($height) - 1;
echo "<br> Nilai dengan indeks terakhir adalah: " . $height[$lastIndex] . " cm<br>";

unset($height[1]);

$lastIndex2 = count($height) - 1;
echo "<br> Setelah menghapus 1 data, nilai indeks terakhir: " . $height[$lastIndex2] . " cm<br>";

$weight = array(45, 52, 60);

echo "<br> Data ke-2 dari array weight adalah: " . $weight[1] . " kg<br>";

?>
</body>
</html>
