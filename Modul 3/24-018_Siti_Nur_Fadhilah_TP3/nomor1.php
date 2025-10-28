<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

// Tambahkan 5 data baru.
array_push($fruits, "Durian", "Mango", "Orange", "Pineapple", "Strawberry");

echo"Nomor 3.1.1 :<br>";
echo "Daftar buah saat ini:<br>";
print_r($fruits);
echo "<br><br>";

// Tampilkan nilai dengan indeks tertinggi
$indeks_tertinggi = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi adalah: " . $fruits[$indeks_tertinggi] . "<br>";

// Tampilkan indeks tertinggi
echo "Indeks tertinggi dari array fruits adalah: " . $indeks_tertinggi . "<br>";
echo "<br><br>";

$fruits = array("Avocado", "Blueberry", "Cherry", "Durian", "Mango", "Orange", "Pineapple", "Strawberry");

unset($fruits[2]);

// Reset ulang indeks agar berurutan kembali
$fruits = array_values($fruits);

echo "Nomor 3.1.2:<br>";
echo "Daftar buah setelah dihapus satu data:<br>";
print_r($fruits);
echo "<br><br>";

// Indeks tertinggi baru
$indeks_tertinggi = count($fruits) - 1;

// Tampilkan nilai dengan indeks tertinggi
echo "Nilai dengan indeks tertinggi sekarang adalah: " . $fruits[$indeks_tertinggi] . "<br>";
echo "Indeks tertinggi dari array fruits sekarang adalah: " . $indeks_tertinggi . "<br>";
echo "<br>";

$veggies = array("Carrot", "Broccoli", "Spinach");

//buat Array Baru
echo "Nomor 3.1.3 :<br>";
echo "Daftar sayuran:<br>";
foreach ($veggies as $sayur) {
    echo $sayur . "<br>";
}

?>

