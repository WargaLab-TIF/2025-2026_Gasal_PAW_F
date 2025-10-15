<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Asosiatif dan Multidimensi</title>
</head>
<body>

<?php

$height = [176, 165, 170];

array_push($height, 180, 172, 168, 177, 169);

echo " Nilai dengan indeks terakhir";
echo "Nilai terakhir dari array height adalah: " . $height[count($height)-1] . "<br><br>";

unset($height[1]);

echo "3.4.2 Setelah dihapus 1 data";
echo "Nilai terakhir sekarang: " . $height[array_key_last($height)] . "<br><br>";

$weight = [60, 72, 68];

echo "3.4.3 Data ke-2 dari array weight";
echo "Data ke-2 dari weight adalah: " . $weight[1] . "<br>";

?>

</body>
</html>
