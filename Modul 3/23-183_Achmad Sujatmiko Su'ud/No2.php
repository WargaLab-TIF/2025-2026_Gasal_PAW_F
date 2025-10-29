<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
$arrLength = count($fruits);
// Menampilkan data awal
for ($x = 0; $x < $arrLength; $x++) {
    echo "[$x] " . $fruits[$x] . "<br>";
}
// Tambah 5 data baru
for ($i = 0; $i < 5; $i++) {
    $fruits[] = "Fruit" . ($i + 1);
}
// Hitung panjang baru array
$arrLength = count($fruits);

echo "Jumlah data dalam array \$fruits saat ini: $arrLength<br>";
echo "Menampilkan semua data buah:<br>";

// Tampilkan seluruh isi array setelah penambahan
for ($x = 0; $x < $arrLength; $x++) {
    echo "[$x] " . $fruits[$x] . "<br>";
}
$veggies = array("Carrot", "Cabbage", "Lettuce");
$arrVegLength = count($veggies);

echo "Daftar sayuran:<br>";
for ($x = 0; $x < $arrVegLength; $x++) {
    echo "[$x] " . $veggies[$x] . "<br>";
}
