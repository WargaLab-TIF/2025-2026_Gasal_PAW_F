<?php
$fruits = ["Apple", "Banana", "Cherry"];

// Tambah 5 data baru
array_push($fruits, "Durian", "Mango", "Orange", "Grape", "Melon");

// Tampilkan seluruh isi
print_r($fruits);

// Indeks tertinggi (karena mulai dari 0)
$max_index = count($fruits) - 1;
echo "<br>Indeks tertinggi: $max_index";
echo "<br>Nilai di indeks tertinggi: " . $fruits[$max_index];
echo "<br>";
?>

<?php
unset($fruits[2]); // hapus "Cherry"
$fruits = array_values($fruits); // reindex ulang biar 0,1,2,...

print_r($fruits);
$max_index = count($fruits) - 1;
echo "<br>Indeks tertinggi sekarang: $max_index";
echo "<br>Nilai di indeks tertinggi: " . $fruits[$max_index];
echo "<br>"
?>

<?php
$veggies = ["Carrot", "Spinach", "Broccoli"];
foreach ($veggies as $v) {
    echo $v . "<br>";
}
?>
