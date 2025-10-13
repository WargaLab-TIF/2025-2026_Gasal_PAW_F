<?php

# 3.6.1 Implementasi array_push()
$fruits = ["apple", "banana"];
echo "Array awal: " . $fruits[0] . " " . $fruits[1] . "<br>";

# Menambahkan elemen baru
array_push($fruits, "cherry", "date");
echo "Setelah array_push: ";
echo "Array awal: " . $fruits[0] . " " . $fruits[1] . " " . $fruits[2] . " " . $fruits[3] . "<br>";



# 3.6.2 Implementasi array_merge()
$array1 = ["red", "green"];
$array2 = ["blue", "yellow"];
echo "Array1 awal: " . $array1[0] . " " . $array1[1] . "<br>";
echo "Array2 awal: " . $array2[0] . " " . $array2[1] . "<br>";

# Menggabungkan array
$merged = array_merge($array1, $array2);
echo "Setelah array_merge: " . $merged[0] . " " . $merged[1] . " " . $merged[2] . " " . $merged[3] . "<br>";



# 3.6.3 Implementasi array_values()
$assocArray = ["x" => 10, "y" => 20, "z" => 30];
echo "Array awal: x=" . $assocArray["x"] . " y=" . $assocArray["y"] . " z=" . $assocArray["z"] . "<br>";

# Mengambil semua nilai
$values = array_values($assocArray);
echo "Setelah array_values: " . $values[0] . " " . $values[1] . " " . $values[2] . "<br>";



# 3.6.4 Implementasi array_search()
$colors = ["red", "green", "blue", "yellow"];
echo "Array awal: " . $colors[0] . " " . $colors[1] . " " . $colors[2] . " " . $colors[3] . "<br>";

# Mencari posisi elemen
$searchColor = "blue";
$keyFound = array_search($searchColor, $colors);

if ($keyFound !== false) {
    echo "Hasil array_search: '$searchColor' ditemukan di kunci $keyFound<br>";
} else {
    echo "Hasil array_search: '$searchColor' tidak ditemukan<br>";
}
