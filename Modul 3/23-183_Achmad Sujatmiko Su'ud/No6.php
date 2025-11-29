<?php
$fruits = ["Apple", "Banana", "Orange"];
array_push($fruits, "Mango", "Watermelon");

echo "Array setelah menggunakan array_push():<br>";
print_r($fruits);
echo "<br><br>";

$fruits1 = ["Apple", "Banana"];
$fruits2 = ["Cherry", "Grape"];
$merged = array_merge($fruits1, $fruits2);

echo "Array hasil penggabungan (array_merge):<br>";
print_r($merged);
echo "<br><br>";

$assoc = ["a" => 100, "b" => 200, "c" => 300];
$values = array_values($assoc);

echo "Array asli (asosiatif): ";
print_r($assoc);
echo "<br>Array setelah array_values(): ";
print_r($values);
echo "<br><br>";

$numbers = [10, 20, 30, 40, 50];
$searchValue = 30;
$key = array_search($searchValue, $numbers);

echo "Mencari nilai $searchValue dalam array: ditemukan pada indeks ke-$key<br><br>";

$numbers = [5, 10, 15, 20, 25, 30];

// Filter hanya angka > 15
$filtered = array_filter($numbers, function($num) {
    return $num > 15;
});

echo "Array asli: ";
print_r($numbers);
echo "<br>Array hasil filter (nilai > 15): ";
print_r($filtered);
echo "<br><br>";

$sortArray = [40, 10, 50, 20, 30];

echo "Array awal: ";
print_r($sortArray);

// Fungsi sort() - mengurutkan nilai dari kecil ke besar
sort($sortArray);
echo "<br><br>sort(): ";
print_r($sortArray);

// Fungsi rsort() - dari besar ke kecil
rsort($sortArray);
echo "<br>rsort(): ";
print_r($sortArray);

// Fungsi asort() - sort berdasarkan nilai, mempertahankan key
$assocSort = ["a"=>40, "b"=>10, "c"=>50, "d"=>20];
asort($assocSort);
echo "<br><br>asort() (urut nilai, simpan key): ";
print_r($assocSort);

// Fungsi ksort() - sort berdasarkan key (huruf)
ksort($assocSort);
echo "<br>ksort() (urut berdasarkan key): ";
print_r($assocSort);

// Fungsi arsort() - nilai descending, tetap simpan key
arsort($assocSort);
echo "<br>arsort() (nilai descending): ";
print_r($assocSort);

// Fungsi krsort() - urutkan key descending
krsort($assocSort);
echo "<br>krsort() (key descending): ";
print_r($assocSort);
?>
