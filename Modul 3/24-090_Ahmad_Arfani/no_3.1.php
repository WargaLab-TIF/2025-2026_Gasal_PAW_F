<?php
$fruits = array("Avocado", "Blueberry", "Cherry");
echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . "." . "<br>";

echo "<br>" . "3.1.1" . "<br>";
array_push($fruits, "Manggis", "Markisa", "Melon", "Mangga", "Kelapa");
print_r($fruits);
echo "<br>" . "Nilai dengan indeks tertinggi: " . end($fruits) . "<br>";
echo "Indeks tertinggi: " . array_key_last(($fruits)) . "<br>";

echo "<br>" . "3.1.2" . "<br>";
unset($fruits[7]);
print_r($fruits);
echo "<br>" . "Nilai dengan indeks tertinggi: " . end($fruits) . "<br>";
echo "Indeks tertinggi sekarang: " . array_key_last(($fruits)) . "<br>";
echo "<br>" . "3.1.3" . "<br>";
$veggies = array("Carrot", "Tomato", "Onion");
print_r($veggies);
?>