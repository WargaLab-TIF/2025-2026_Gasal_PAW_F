<?php
$fruits= array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".";
echo "<br>";
// 3.1.1
echo '3.1.1';
echo "<br>";
array_push($fruits,"Apple","Lemon","Manggo","Grape","Lecy");
echo "<br> Nilai dengan indeks tertinggi : ".$fruits[array_key_last($fruits)];
echo "<br> Indeks tertinggi : " . array_key_last($fruits);
// 3.1.2
echo '3.1.2';
echo "<br>";
unset($fruits[2]);
echo "<br> Nilai dengan indeks tertinggi : ".$fruits[array_key_last($fruits)];
echo "<br> Indeks tertinggi : " . array_key_last($fruits);

// 3.1.3
echo '3.1.3';
echo "<br><br>";
$veggies=["Carrot","Broccoli","cabbage"];
var_dump($veggies);
?>