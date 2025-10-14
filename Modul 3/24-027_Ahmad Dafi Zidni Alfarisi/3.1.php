<?php

$fruits = array("Avocado", "Blueberry", "Cherry");

$fruits[] = "Dragonfruit";
$fruits[] = "Elderberry";
$fruits[] = "Fig";
$fruits[] = "Grape";
$fruits[] = "Honeydew";

$highestIndex = count($fruits) - 1;
echo "Nilai dengan indeks tertinggi adalah: " . $fruits[$highestIndex];

echo "<br><br>";
?>

<?php
$fruits = array("Avocado", "Blueberry", "Cherry", "Dragonfruit", "Elderberry", "Fig", "Grape", "Honeydew");

unset($fruits[1]);

$highestIndex = count($fruits) - 1;
end($fruits);
$lastKey = key($fruits);
echo "Nilai dengan indeks tertinggi yang tersisa adalah: " . $fruits[$lastKey];

echo "<br><br>";
?>

<?php
$veggies = array("Carrot", "Broccoli", "Spinach");

echo "Data dari array veggies: ";
echo $veggies[0] . ", " . $veggies[1] . ", " . $veggies[2] . ".";
?>

