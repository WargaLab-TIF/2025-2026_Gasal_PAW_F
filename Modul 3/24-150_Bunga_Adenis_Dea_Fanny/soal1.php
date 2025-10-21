<?php
// 3.1 — Deklarasi awal
$fruits = array("Avocado", "Blueberry", "Cherry");

// 3.1.1 — Tambahkan 5 data baru
array_push($fruits, "Avocado", "Banana", "Apple", "Mango", "Orange");

echo "3.1.1 — Setelah tambah 5 data<br>";
echo "Nilai dengan indeks tertinggi adalah: " . $fruits[count($fruits)-1] . "<br>";
echo "Indeks tertinggi dari array fruits adalah: " . (count($fruits)-1);
echo "<br>";

// 3.1.2 — Hapus 1 data tertentu 
unset($fruits[7]);                
$fruits = array_values($fruits);  


echo "<br>3.1.2 — Setelah hapus 1 data (Blueberry)<br>";
echo "Nilai dengan indeks tertinggi sekarang adalah: " . $fruits[count($fruits)-1] . "<br>";
echo "Indeks tertinggi sekarang: " . (count($fruits)-1);
echo "<br>";

// 3.1.3 — Array baru $veggies (3 data) & tampilkan seluruhnya
$veggies = array("Carrot", "Broccoli", "Spinach");

echo "<br>3.1.3 — Isi array veggies<br>";
echo "I like " . $veggies[0] . ", " . $veggies[1] . " and " . $veggies[2] . ".";
?>
