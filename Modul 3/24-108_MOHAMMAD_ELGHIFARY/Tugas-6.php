<?php
$fruits= array("Avocado", "Blueberry", "Cherry");
$age= array("ahmad"=>19, "Budi"=>20, "Celiboy"=>16);
// 3.6.1.
echo '<br>3.6.1';
echo "<br><br>";
echo "array_push()<br>";
array_push($fruits,"Durian");
var_dump($fruits);
// 3.6.2.
echo '<br>3.6.2';
echo "<br><br>";
echo "array_merge()<br>";
$fruitsBaru=array("Apple","Alpukat");
$fruits = array_merge($fruits, $fruitsBaru);
var_dump($fruits);
// 3.6.3.
echo '<br>3.6.3';
echo "<br><br>";
echo "array_values()<br>";
$ageValues=array_values($age);
var_dump($ageValues);
// 3.6.4.
echo '<br>3.6.4';
echo "<br><br>";
echo "array_search()<br>";
echo array_search("Apple",$fruits);
// 3.6.5.
echo '<br>3.6.5';
echo "<br><br>";
echo "array_filter()<br>";
$dewasa=array_filter($age, function($i){
    return $i > 18;
});
var_dump($dewasa);
// 3.6.6.
echo '<br>3.6.6';
echo "<br><br>";
echo "sort()<br>";
$angka = [5, 1, 8, 3, 2, 7, 7];
sort($angka);
var_dump($angka);
echo "<br>rsort()<br>";
$angka = [5, 1, 8, 3, 2, 7, 7];
rsort($angka);
var_dump($angka);
echo "<br>asort()<br>";
$nilai = [
    "Rendi" => 77,
    "Lemonaru" => 99,
    "Senku" => 45,
    "Gara" => 72,
    "Nobita" => 60
];
asort($nilai);
var_dump($nilai);
echo "<br>arsort()<br>";
$nilai = [
    "Rendi" => 77,
    "Lemonaru" => 99,
    "Senku" => 45,
    "Gara" => 72,
    "Nobita" => 60
];
arsort($nilai);
var_dump($nilai);
echo "<br>ksort()<br>";
$nilai = [
    "Rendi" => 77,
    "Lemonaru" => 99,
    "Senku" => 45,
    "Gara" => 72,
    "Nobita" => 60
];

ksort($nilai);
var_dump($nilai);
echo "<br>krsort()<br>";
$nilai = [
    "Rendi" => 77,
    "Lemonaru" => 99,
    "Senku" => 45,
    "Gara" => 72,
    "Nobita" => 60
];

krsort($nilai);
var_dump($nilai);
$umur = [15, 22, 17, 30, 19];
echo "<br>usort()<br>";
usort($umur, function($a, $b) {
    return $a <=> $b;
});
var_dump($umur);
echo "<br>uasort()<br>";
$nilai = [
    "Rendi" => 77,
    "Lemonaru" => 99,
    "Senku" => 45,
    "Gara" => 72
];

uasort($nilai, function($a, $b) {
    return $a <=> $b;
});
var_dump($nilai);
?>