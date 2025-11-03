<?php
// Data awal
echo "<h4>Implementasi awal</h4>";

$fruits = array("Avocado", "Blueberry", "Cherry");
print_r($fruits);
echo "<br><br>";
// 3.2.1 Tambah 5 data baru
echo "<h4>Implementasi menambah 5 data baru</h4>";
array_push($fruits, "Banana", "Papaya", "Mango", "Grape", "Apple");
$arrlenght = count($fruits);
for($x = 0; $x < $arrlenght; $x++){
    echo $fruits[$x];
    echo "<br>";
}
echo "<br>Jumlah data array \$fruits saat ini: " . $arrlenght . "<br><br>";

echo "<br>";

// 3.2.2 Buat array baru 
echo "<h4>Implementasi buat array baru</h4>";

$veggies = array("Spinach", "Tomato", "Carrot");
$arrlenght = count($veggies);
for ($x = 0; $x < $arrlenght; $x++){
    echo $veggies[$x];
    echo "<br>";
}
echo "<br>Jumlah data array \$veggies saat ini: " . $arrlenght . "<br><br>";
?>