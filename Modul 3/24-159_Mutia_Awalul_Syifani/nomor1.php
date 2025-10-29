<?php
// Data Awal
echo "<h4>Implementasi awal</h4>";
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".";
echo "<br><br>";

// Menampilkan Data Awal
echo "Data awal : ";
print_r($fruits);
echo "<br><br>";


// 3.1.1 Tambahkan 5 data baru ke array $fruits
echo "<h4>Implementasi menambah 5 data baru</h4>";
array_push($fruits, "Banana", "Papaya", "Mango", "Grape", "Apple");
print_r($fruits);
echo "<br>";

// Mencari indeks tertinggi
$indeks_tertinggi = count($fruits) - 1;
echo "Nilai indeks tertinggi : " . $fruits[$indeks_tertinggi] . "<br>";
echo "Indeks tertinggi : " . $indeks_tertinggi . "<br>";
echo "<br>";

// 3.1.2 Menghapus data 
echo "<h4>Implementasi menghapus data</h4>";
unset($fruits[3]);
echo "Data setelah penghapusan indeks 3 (Banana) : <br>";
print_r($fruits);
echo "<br>";

// Indeks tertinggi setelah di hapus
$indeks_tertinggi_new = array_key_last($fruits);
echo "Nilai indeks tertinggi setelah dihapus : " . $fruits[$indeks_tertinggi_new] . "<br>";
echo "Indeks tertinggi setelah dihapus : " . $indeks_tertinggi_new . "<br>";
echo "<br>";
// Pengurutan dengan indeks baru
$fruits = array_values($fruits);
echo "Pengurutan data dengan indeks baru : <br>";
print_r($fruits);
echo "<br>";

// Indeks tertinggi dengan indeks baru (setelah pengurutan)
$indeks_tertinggi_urut = array_key_last($fruits);
echo "Nilai indeks tertinggi setelah pengurutan : " . $fruits[$indeks_tertinggi_urut] . "<br>";
echo "Indeks tertinggi setelah pengurutan : " . $indeks_tertinggi_urut . "<br>";
echo "<br>";

// 3.1.3 Membuat data baru dengan nama $veggies
echo "<h4>Implementasi array baru</h4>";
$veggies = array("Spinach", "Tomato", "Carrot");
echo "Data baru : <br>";
print_r($veggies);

?>