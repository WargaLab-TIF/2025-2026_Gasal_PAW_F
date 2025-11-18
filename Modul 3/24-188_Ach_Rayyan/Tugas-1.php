<?php
echo "<h2>3.1 Deklarasi dan Akses Array Terindeks</h2>";

$fruits = ["Apple", "Banana", "Cherry", "Durian", "Mango"];
print_r($fruits);

array_push($fruits, "Orange", "Pear", "Watermelon", "Grapes", "Melon");
echo "<br><br> ";
print_r($fruits);
echo "<br>" . $fruits[max(array_keys($fruits))];

unset($fruits[2]); 
echo "<br><br>";
print_r($fruits);
echo "<br>" . max(array_keys($fruits));

$veggies = ["Kubis", "Tomat", "Selada"];
echo "<br><br>Array veggies: ";
print_r($veggies);
?>
