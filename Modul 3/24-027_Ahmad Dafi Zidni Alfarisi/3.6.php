<?php
$angka = [5, 2, 9, 1, 7];
print_r($angka);
echo "<br><br>";

array_push($angka, 3, 10);
print_r($angka);
echo "<br><br>";

$tambahan = [20, 15];
$gabung = array_merge($angka, $tambahan);
print_r($gabung);
echo "<br><br>";

$asosiatif = ["a" => 100, "b" => 200, "c" => 300];
$nilai = array_values($asosiatif);
print_r($nilai);
echo "<br><br>";

$cari = 9;
$hasilCari = array_search($cari, $angka);
if ($hasilCari !== false) {
    echo "<b>Nilai $cari ditemukan pada indeks ke-$hasilCari.</b><br>";
} else {
    echo "<b>Nilai $cari tidak ditemukan.</b><br>";
}
echo "<br><br>";

$genap = array_filter($angka, function($n) {
    return $n % 2 == 0;
});
print_r($genap);
echo "<br><br>";

$unsorted = [5, 2, 9, 1, 7];
print_r($unsorted);
echo "<br><br>";

sort($unsorted);
print_r($unsorted);
echo "<br><br>";

rsort($unsorted);
print_r($unsorted);
echo "<br><br>";

$data = ["b" => 50, "a" => 90, "c" => 10];
print_r($data);
echo "<br><br>";

asort($data);
print_r($data);
echo "<br><br>";

arsort($data);
print_r($data);
echo "<br><br>";

ksort($data);
print_r($data);
echo "<br><br>";

krsort($data);
print_r($data);
echo "<br><br>";
?>
