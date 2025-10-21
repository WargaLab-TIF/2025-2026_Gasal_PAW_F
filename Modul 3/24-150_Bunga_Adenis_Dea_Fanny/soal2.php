<?php
// 3.2 — Deklarasi awal
$fruits = array("Avocado", "Blueberry", "Cherry");

// 3.2.1 — Tambahkan 5 data baru
$buahBaru = array("Pineapple", "Banana", "Papaya", "Watermelon", "Strawberry");

for ($i = 0; $i < count($buahBaru); $i++) {
    $fruits[] = $buahBaru[$i]; 
}
//panjang (jumlah data) array $fruits
$arrlength = count($fruits);
echo "3.2.1 — Setelah tambah 5 data<br>";
for ($x = 0; $x < $arrlength; $x++) {
    echo $fruits[$x];
    echo "<br>";
}

echo "Panjang array fruits saat ini: {$arrlength}";
echo "<br>";

// 3.2.2 — array baru dengan nama $veggies
$veggies = array("Carrot", "Broccoli", "Spinach");
// Tampilkan seluruh data dari array $veggies dengan menggunakan struktur perulangan FOR!
echo "<br>3.2.2 — menampilkan array veggies<br>";
for ($i = 0; $i < count($veggies); $i++) {
    echo $veggies[$i];
    echo "<br>";
}
?>