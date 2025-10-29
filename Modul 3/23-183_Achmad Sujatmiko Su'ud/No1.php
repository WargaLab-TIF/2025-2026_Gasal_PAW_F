<?php

$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".<br><br>";

array_push($fruits, "Apple", "Banana", "Mango", "Orange", "Watermelon");

echo "Daftar buah saat ini:<br>";
foreach ($fruits as $index => $value) {
    echo "[$index] $value<br>";
}

$lastIndex = count($fruits) - 1;
echo "<br>Nilai dengan indeks tertinggi: " . $fruits[$lastIndex];
echo "<br>Indeks tertinggi: $lastIndex<br><br>";

unset($fruits[2]); // Menghapus "Cherry"
$fruits = array_values($fruits); // Menata ulang indeks agar berurutan

echo "Daftar buah setelah menghapus satu data:<br>";
foreach ($fruits as $index => $value) {
    echo "[$index] $value<br>";
}

$lastIndex = count($fruits) - 1;
echo "<br>Nilai dengan indeks tertinggi: " . $fruits[$lastIndex];
echo "<br>Indeks tertinggi: $lastIndex<br><br>";

$veggies = array("Carrot", "Broccoli", "Spinach");

echo "Daftar sayuran:<br>";
foreach ($veggies as $index => $v) {
    echo "[$index] $v<br>";
}
