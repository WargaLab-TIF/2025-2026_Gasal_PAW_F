<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eksplorasi Array PHP</title>
</head>
<body>

<?php

$fruits = ["Apple", "Banana", "Mango"];
array_push($fruits, "Orange", "Grapes");
echo "Isi array fruits setelah array_push():<br>";
foreach($fruits as $f){
    echo $f . "<br>";
}

$veggies = ["Carrot", "Tomato", "Spinach"];
$merged = array_merge($fruits, $veggies);
echo "<br>Hasil penggabungan fruits + veggies:<br>";
foreach($merged as $m){
    echo $m . "<br>";
}

$person = ["name" => "Andi", "age" => 21, "city" => "Malang"];
$values = array_values($person);
echo "<br>Hasil array_values dari array person:<br>";
print_r($values);
echo "<br><br>";

$search = array_search("Mango", $fruits);
if($search !== false){
    echo "Data 'Mango' ditemukan pada indeks ke-$search<br>";
} else {
    echo "'Mango' tidak ditemukan.<br>";
}

$numbers = [10, 25, 30, 5, 40, 18];
$filtered = array_filter($numbers, function($num){
    return $num > 20;
});
echo "<br>Angka yang lebih dari 20:<br>";
print_r($filtered);
echo "<br><br>";

$sortNumbers = [5, 3, 8, 1, 9];

sort($sortNumbers);
echo "sort() - Ascending: ";
print_r($sortNumbers);
echo "<br>";

rsort($sortNumbers);
echo "rsort() - Descending: ";
print_r($sortNumbers);
echo "<br>";

$studentScore = ["Andi" => 80, "Budi" => 75, "Cici" => 90];
asort($studentScore);
echo "asort() - Berdasarkan nilai (ascending): ";
print_r($studentScore);
echo "<br>";

arsort($studentScore);
echo "arsort() - Berdasarkan nilai (descending): ";
print_r($studentScore);
echo "<br>";

ksort($studentScore);
echo "ksort() - Berdasarkan key (A-Z): ";
print_r($studentScore);
echo "<br>";

krsort($studentScore);
echo "krsort() - Berdasarkan key (Z-A): ";
print_r($studentScore);
?>

</body>
</html>
