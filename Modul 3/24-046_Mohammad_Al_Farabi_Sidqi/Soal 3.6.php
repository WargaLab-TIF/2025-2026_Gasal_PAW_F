<?php
#3.6.1
$fruits = ["Apple", "Banana"];
array_push($fruits, "Mango", "Papaya");
var_dump($fruits);

#3.6.2 
echo "<br>";echo "<br>";
$veggies = ["Carrot", "Broccoli"];
$merged = array_merge($fruits, $veggies);
var_dump($merged);

#3.6.3
echo "<br>";echo "<br>";
$height = ["Alex" => 170, "Bianca" => 165, "Candice" => 160];
$values = array_values($height);
var_dump($values);

#3.6.4
echo "<br>";echo "<br>";
$height = ["Alex" => 170, "Bianca" => 165, "Candice" => 160];
$key = array_search(165, $height);
echo $key;

#3.6.5 
echo "<br>";echo "<br>";
$height = ["Alex" => 170, "Bianca" => 165, "Candice" => 160, "Diana" => 175];
$filtered = array_filter($height, fn($h) => $h > 165);
var_dump($filtered);


#3.6.7 
echo "<br>";
$fruits = ["Mango", "Apple", "Banana"];
sort($fruits);
var_dump($fruits);

echo "<br>";
$fruits = ["Mango", "Apple", "Banana"];
rsort($fruits);
var_dump($fruits);

echo "<br>";
$height = ["Alex" => 170, "Bianca" => 165, "Candice" => 160];
asort($height);
var_dump($height);

echo "<br>";
ksort($height);
var_dump($height);
