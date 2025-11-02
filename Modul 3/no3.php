<?php

$height = [
  "Andy" => 176,
  "Barry" => 165,
  "Charlie" => 170
];

// 3.3.1 Tambah 5 data baru
$height["David"] = "180";
$height["Ella"] = "160";
$height["Frank"] = "175";
$height["Grace"] = "162";
$height["Helen"] = "168";

echo "Indeks terakhir: " . array_key_last($height);
echo "<br>Nilainya: " . end($height) . " cm";
echo "<br>";

// 3.3.2 Hapus Barry
unset($height["Barry"]);

echo "<br>Indeks terakhir: " . array_key_last($height);
echo "<br>Nilainya: " . end($height) . " cm";
echo "<br>";

// 3.3.3 Data berat
$weight = [
  "Andy" => 65,
  "Charlie" => 70,
  "Evan" => 68
];

$keys = array_keys($weight);
echo "<br>Data ke-2 dari \$weight:<br>";
echo $keys[1] . " = " . $weight[$keys[1]] . " kg";

?>