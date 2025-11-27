<?php
echo "<h2>3.6 Eksplorasi Lanjut Fungsi Array</h2>";

$arr1 = ["A", "B", "C"];
array_push($arr1, "D", "E");
echo "array_push: ";
print_r($arr1);

$arr2 = ["X", "Y"];
$merged = array_merge($arr1, $arr2);
echo "<br><br>array_merge: ";
print_r($merged);

$assoc = ["nama" => "Rayyan", "umur" => 20, "jurusan" => "Informatika"];
$vals = array_values($assoc);
echo "<br><br>array_values: ";
print_r($vals);

$index = array_search("Y", $merged);
echo "<br><br>array_search  : indeks $index";

$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9];
$even = array_filter($numbers, fn($n) => $n % 2 == 0);
echo "<br><br>array_filter (bilangan genap): ";
print_r($even);

$sortArr = ["Lemon", "Apple", "Orange", "Banana"];
sort($sortArr);
echo "<br><br>sort(): ";
print_r($sortArr);

rsort($sortArr);
echo "<br>rsort(): ";
print_r($sortArr);

$assocSort = ["a" => 3, "c" => 1, "b" => 2];
asort($assocSort);
echo "<br>asort(): ";
print_r($assocSort);

ksort($assocSort);
echo "<br>ksort(): ";
print_r($assocSort);
?>
