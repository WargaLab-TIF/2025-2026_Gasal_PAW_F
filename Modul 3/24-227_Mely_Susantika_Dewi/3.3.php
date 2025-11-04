<?php
$height = ["Andy" => 176, "Barry" => 165, "Charlie" => 170];

// tambah 5 data baru
$height["Deni"] = 172;
$height["Eka"] = 168;
$height["Feri"] = 175;
$height["Gita"] = 158;
$height["Hana"] = 162;

print_r($height);

echo "<br>Kunci terakhir: " . array_key_last($height);
echo "<br>Nilai terakhir: " . $height[array_key_last($height)];
echo "<br>";
?>

<?php
unset($height["Eka"]); // hapus Eka
print_r($height);
echo "<br>Kunci terakhir sekarang: " . array_key_last($height);
echo "<br>";
?>

<?php
$weight = ["Andy" => 65, "Barry" => 55, "Charlie" => 60];
$values = array_values($weight);
echo "Data ke-2: " . $values[1]; // 55
?>
